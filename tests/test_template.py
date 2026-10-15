"""Exercise the rendered template, including next-year configuration changes."""
import os
from pathlib import Path
import shutil
import subprocess
import tempfile
import unittest

ROOT = Path(__file__).resolve().parents[1]


def render(web, page="index.php", static=False):
    env = dict(os.environ, APNET_STATIC="1" if static else "0")
    code = '$_SERVER["HTTP_HOST"]="localhost"; $_SERVER["REQUEST_URI"]="/"; require $argv[1];'
    return subprocess.run(
        ["php", "-d", "display_errors=stderr", "-r", code, page],
        cwd=web, env=env, capture_output=True, text=True, check=True,
    ).stdout


class TemplateTests(unittest.TestCase):
    def test_hiding_navigation_keeps_direct_page_access(self):
        with tempfile.TemporaryDirectory() as directory:
            web = Path(directory) / "web"
            shutil.copytree(ROOT / "web", web)
            config = web / "config/site.php"
            config.rename(config.with_name("defaults.php"))
            config.write_text('''<?php
$site = require __DIR__ . '/defaults.php';
$site['navigation'] = [
    ['page' => 'index', 'label' => 'Home', 'visible' => true],
    ['page' => 'organization', 'label' => 'Hidden committee', 'visible' => false],
];
return $site;
''')
            html = render(web)
            self.assertIn('href="index.php"', html)
            self.assertNotIn('>Hidden committee</a>', html)
            self.assertIn('<h1>Hidden committee</h1>', render(web, 'organization.php'))

    def test_new_edition_propagates_and_text_is_escaped(self):
        with tempfile.TemporaryDirectory() as directory:
            web = Path(directory) / "web"
            shutil.copytree(ROOT / "web", web)
            config = web / "config/site.php"
            self.assertTrue(config.exists(), "Edition details need one editable configuration file")
            # Preserve the default schema, change only values as a future web chair would.
            config.rename(config.with_name("defaults.php"))
            config.write_text('''<?php
$site = require __DIR__ . '/defaults.php';
$site['year'] = '2099';
$site['location'] = 'City <East> & West';
$site['base_url'] = 'https://example.org/conferences/apnet2099';
$site['links']['registration'] = 'https://example.org/register?type=author&lang=en';
return $site;
''')
            home = render(web, static=True)
            self.assertIn("APNet 2099", home)
            self.assertNotIn("APNet YYYY", home)
            self.assertIn("City &lt;East&gt; &amp; West", home)
            self.assertIn('href="https://example.org/conferences/apnet2099/index.html"', home)
            registration = render(web, "registration.php", static=True)
            self.assertIn('href="https://example.org/register?type=author&amp;lang=en"', registration)

    def test_unconfigured_actions_are_not_dead_links(self):
        with tempfile.TemporaryDirectory() as directory:
            web = Path(directory) / "web"
            shutil.copytree(ROOT / "web", web)
            config = web / "config/site.php"
            config.rename(config.with_name("defaults.php"))
            config.write_text('''<?php
$site = require __DIR__ . '/defaults.php';
$site['links'] = array_fill_keys(array_keys($site['links']), '');
return $site;
''')
            for page in ("cfp.php", "registration.php", "grant.php"):
                with self.subTest(page=page):
                    html = render(web, page, static=True)
                    self.assertNotRegex(html, r'href=[\"\x27](?:#|)[\"\x27]')
                    self.assertIn('to be announced.</p>', html)

    def test_section_links_can_be_added_without_editing_the_renderer(self):
        with tempfile.TemporaryDirectory() as directory:
            web = Path(directory) / "web"
            shutil.copytree(ROOT / "web", web)
            content = web / "data/content.php"
            content.rename(content.with_name("defaults.php"))
            content.write_text('''<?php
$content = require __DIR__ . '/defaults.php';
$section = ['title' => 'Guidance <updated>', 'paragraphs' => ['Read the confirmed guidance.'],
    'links' => [
        ['label' => 'Official guidance & policies', 'url' => 'https://example.org/guidance?a=1&b=2'],
        ['label' => 'Local information', 'url' => 'local.php'],
        ['label' => 'Invitation contact', 'url' => ''],
    ]];
$content['sections']['visa'] = [$section];
$content['sections']['index'] = [$section];
return $content;
''')
            for page in ('visa.php', 'index.php'):
                with self.subTest(page=page):
                    html = render(web, page, static=True)
                    self.assertIn('Guidance &lt;updated&gt;', html)
                    self.assertIn('href="https://example.org/guidance?a=1&amp;b=2"', html)
                    self.assertIn('Official guidance &amp; policies</a>', html)
                    self.assertIn('href="local.html"', html)
                    self.assertNotIn('href=""', html)


if __name__ == "__main__":
    unittest.main()
