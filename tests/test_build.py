"""Exercise the public build commands against small, real PHP sites."""

from pathlib import Path
import shutil
import subprocess
import sys
import tempfile
import unittest
from urllib.parse import urljoin


ROOT = Path(__file__).resolve().parents[1]
BUILD = ROOT / "scripts" / "build_site.py"
CHECK = ROOT / "scripts" / "check_site.py"


@unittest.skipUnless(shutil.which("php"), "PHP CLI is required")
class BuildTests(unittest.TestCase):
    def setUp(self):
        self.temp = tempfile.TemporaryDirectory()
        self.addCleanup(self.temp.cleanup)
        self.root = Path(self.temp.name)
        self.source = self.root / "web"
        self.output = self.root / "static_site"
        self.source.mkdir()
        self.write("index.php", '<?php $ext = getenv("APNET_STATIC") === "1" ? "html" : "php"; ?>'
                   '<!doctype html><html><head><meta charset="utf-8">'
                   '<title>APNet</title><link rel="stylesheet" href="css/style.css"></head>'
                   '<body><a href="program.<?php echo $ext; ?>#schedule">Program</a>'
                   '<img src="images/logo.svg" alt="APNet"></body></html>')
        self.write("program.php", '<!doctype html><html><head><title>Program</title></head>'
                   '<body><h1 id="schedule">Schedule</h1><a href="index.html">Home</a></body></html>')
        self.write("css/style.css", 'body { background-image: url("../images/logo.svg"); }')
        self.write("images/logo.svg", '<svg xmlns="http://www.w3.org/2000/svg"></svg>')
        self.write("files/call.txt", "Call for papers")

    def write(self, name, text):
        path = self.source / name
        path.parent.mkdir(parents=True, exist_ok=True)
        path.write_text(text, encoding="utf-8")

    def build(self):
        return subprocess.run([sys.executable, str(BUILD), "--source", str(self.source),
                               "--output", str(self.output)], capture_output=True, text=True)

    def assert_build_ok(self):
        result = self.build()
        self.assertEqual(result.returncode, 0, result.stdout + result.stderr)

    def test_renders_public_pages_and_excludes_php_source(self):
        self.write("config/site.php", '<?php $private = "configuration";')
        self.write("data/content.php", '<?php $private = "content";')
        self.write("include/template.php", '<?php echo "private include";')
        self.write("images/secret.php", '<?php echo "not an asset";')
        self.assert_build_ok()
        self.assertIn('href="program.html#schedule"', (self.output / "index.html").read_text())
        self.assertTrue((self.output / "program.html").is_file())
        self.assertTrue((self.output / "files/call.txt").is_file())
        self.assertTrue((self.output / ".nojekyll").is_file())
        self.assertEqual(list(self.output.rglob("*.php")), [])
        for name in ("config", "data", "include"):
            self.assertFalse((self.output / name).exists())

    def test_relative_assets_and_links_work_under_nested_pages_path(self):
        self.assert_build_ok()
        result = subprocess.run([sys.executable, str(CHECK), str(self.output),
                                 "--base-path", "/conference/apnet-template/"],
                                capture_output=True, text=True)
        self.assertEqual(result.returncode, 0, result.stdout + result.stderr)
        self.assertEqual(urljoin("https://example.org/conference/apnet-template/index.html",
                                 "program.html#schedule"),
                         "https://example.org/conference/apnet-template/program.html#schedule")

    def test_render_warning_fails_without_replacing_last_good_build(self):
        self.assert_build_ok()
        previous = (self.output / "index.html").read_text()
        self.write("index.php", '<?php trigger_error("broken fixture", E_USER_WARNING); ?>')
        result = self.build()
        self.assertNotEqual(result.returncode, 0)
        self.assertIn("broken fixture", result.stderr)
        self.assertEqual((self.output / "index.html").read_text(), previous)

    def test_render_syntax_error_fails(self):
        self.write("index.php", '<?php function ( ?>')
        result = self.build()
        self.assertNotEqual(result.returncode, 0)
        self.assertIn("index.php", result.stderr)
        self.assertFalse(self.output.exists())

    def test_announcement_labels_are_not_php_diagnostics(self):
        self.write("index.php", '<p><b>Important Notice:</b> Registration opens soon.</p>'
                   '<p>Warning: The submission deadline cannot be extended.</p>'
                   '<p>Notice: Read the updated travel guidance.</p>')
        self.assert_build_ok()
        self.assertIn('Important Notice:', (self.output / "index.html").read_text())

    def test_rendered_php_diagnostics_are_rejected(self):
        diagnostics = [
            'PHP Warning: Undefined variable $name',
            '<br><b>Notice</b>: Undefined variable in <b>/tmp/index.php</b> on line <b>12</b><br>',
            'Warning: Undefined variable $name in /tmp/index.php on line 12',
            'Fatal error: Uncaught Error in /tmp/index.php:12',
        ]
        for diagnostic in diagnostics:
            with self.subTest(diagnostic=diagnostic):
                self.write("index.php", diagnostic)
                result = self.build()
                self.assertNotEqual(result.returncode, 0)
                self.assertIn("PHP diagnostic", result.stderr)

    def test_broken_local_link_fails(self):
        self.write("program.php", '<a href="missing.html">Missing page</a>')
        result = self.build()
        self.assertNotEqual(result.returncode, 0)
        self.assertIn("missing.html", result.stderr)

    def test_broken_fragment_fails(self):
        self.write("program.php", '<h1 id="changed">Schedule</h1>')
        result = self.build()
        self.assertNotEqual(result.returncode, 0)
        self.assertIn("schedule", result.stderr)

    def test_broken_css_asset_fails(self):
        self.write("css/style.css", 'body { background: url("../images/missing.svg"); }')
        result = self.build()
        self.assertNotEqual(result.returncode, 0)
        self.assertIn("missing.svg", result.stderr)

    def test_referenced_javascript_is_copied(self):
        script = 'document.documentElement.classList.add("ready");\n'
        self.write("js/script.js", script)
        self.write("program.php", '<h1 id="schedule">Schedule</h1>'
                   '<script src="js/script.js"></script>')
        self.assert_build_ok()
        self.assertEqual((self.output / "js/script.js").read_text(), script)

    def test_missing_javascript_fails(self):
        self.write("program.php", '<h1 id="schedule">Schedule</h1>'
                   '<script src="js/missing.js"></script>')
        result = self.build()
        self.assertNotEqual(result.returncode, 0)
        self.assertIn("js/missing.js", result.stderr)
        self.assertFalse(self.output.exists())

    def test_root_relative_and_php_links_fail(self):
        for target in ("/program.html", "program.php"):
            with self.subTest(target=target):
                self.write("program.php", '<a href="{}">Wrong link</a>'.format(target))
                result = self.build()
                self.assertNotEqual(result.returncode, 0)
                self.assertIn(target, result.stderr)

    def test_successful_rebuild_removes_stale_pages_and_assets(self):
        self.write("old.php", '<h1>Retired page</h1>')
        self.write("images/old.svg", '<svg></svg>')
        self.assert_build_ok()
        (self.source / "old.php").unlink()
        (self.source / "images/old.svg").unlink()
        self.write("new.php", '<h1>New page</h1>')
        self.assert_build_ok()
        self.assertFalse((self.output / "old.html").exists())
        self.assertFalse((self.output / "images/old.svg").exists())
        self.assertTrue((self.output / "new.html").is_file())

    def test_only_explicit_root_cname_is_published(self):
        self.write("CNAME", "stale-web.example.org\n")
        self.assert_build_ok()
        self.assertFalse((self.output / "CNAME").exists())
        (self.root / "CNAME").write_text("conference.example.org\n")
        self.assert_build_ok()
        self.assertEqual((self.output / "CNAME").read_text(), "conference.example.org\n")

    def test_robots_file_is_published(self):
        self.write("robots.txt", "User-agent: *\nAllow: /\n")
        self.assert_build_ok()
        self.assertTrue((self.output / "robots.txt").is_file())
        self.assertEqual((self.output / "robots.txt").read_text(), "User-agent: *\nAllow: /\n")

    def test_overlapping_output_is_rejected_without_deleting_source(self):
        self.output = self.source
        result = self.build()
        self.assertNotEqual(result.returncode, 0)
        self.assertTrue((self.source / "index.php").is_file())

    def test_existing_unrelated_directory_is_not_deleted(self):
        self.output.mkdir()
        note = self.output / "personal-notes.txt"
        note.write_text("Keep this file")
        result = self.build()
        self.assertNotEqual(result.returncode, 0)
        self.assertIn("not a generated", result.stderr)
        self.assertEqual(note.read_text(), "Keep this file")

    def test_asset_directory_symlink_cannot_publish_private_data(self):
        self.write("data/private.csv", "Private data")
        shutil.rmtree(self.source / "files")
        (self.source / "files").symlink_to(self.source / "data", target_is_directory=True)
        result = self.build()
        self.assertNotEqual(result.returncode, 0)
        self.assertIn("symbolic link", result.stderr)
        self.assertFalse(self.output.exists())

    def test_base_href_cannot_override_relative_link_validation(self):
        self.write("index.php", '<base href="files/"><img src="images/logo.svg">')
        self.write("files/index.html", '<h1>Downloads</h1>')
        result = self.build()
        self.assertNotEqual(result.returncode, 0)
        self.assertIn("base href", result.stderr)


if __name__ == "__main__":
    unittest.main()
