#!/usr/bin/env python3
"""Validate a static site without fetching external links or installing packages."""

import argparse
from html.parser import HTMLParser
from pathlib import Path
import re
import sys
from urllib.parse import unquote, urljoin, urlsplit


CSS_URL = re.compile(r"url\(\s*(['\"]?)(.*?)\1\s*\)", re.IGNORECASE)
PHP_DIAGNOSTIC = r"(?:Warning|Fatal error|Parse error|Notice|Deprecated|Strict Standards|Recoverable fatal error)"
# Announcement labels such as "Important Notice:" are ordinary page content.
# Match PHP's prefix, HTML diagnostic markup, or a diagnostic with a file/line.
PHP_ERROR = re.compile(
    rf"\bPHP\s+{PHP_DIAGNOSTIC}\s*:"
    rf"|<b>\s*{PHP_DIAGNOSTIC}\s*</b>\s*:"
    rf"|\b{PHP_DIAGNOSTIC}:\s*[^\r\n<]*\bin\s+"
    r"(?:/[^\r\n<>]+|[A-Za-z]:[\\/][^\r\n<>]+|[^\s<>]+\.php)"
    r"(?:\s+on line\s+\d+|:\d+)\b",
    re.IGNORECASE,
)


class Page(HTMLParser):
    def __init__(self, content):
        super().__init__(convert_charrefs=True)
        self.links = []
        self.ids = set()
        self.styles = []
        self.in_style = False
        self.has_base_href = False
        self.feed(content)

    def handle_starttag(self, tag, attributes):
        attrs = dict(attributes)
        if tag == "base" and "href" in attrs:
            self.has_base_href = True
        for key in ("href", "src"):
            if attrs.get(key):
                self.links.append(attrs[key])
        if attrs.get("id"):
            self.ids.add(attrs["id"])
        if tag == "a" and attrs.get("name"):
            self.ids.add(attrs["name"])
        if attrs.get("style"):
            self.styles.append(attrs["style"])
        if tag == "style":
            self.in_style = True

    def handle_endtag(self, tag):
        if tag == "style":
            self.in_style = False

    def handle_data(self, data):
        if self.in_style:
            self.styles.append(data)


def css_links(content):
    content = re.sub(r"/\*.*?\*/", "", content, flags=re.DOTALL)
    return [match.group(2).strip() for match in CSS_URL.finditer(content)]


def check_site(root, base_path="/apnet-template/"):
    """Return problems, resolving every local URL as if hosted under base_path."""
    root = Path(root).resolve()
    base_path = "/" + base_path.strip("/") + "/"
    if base_path == "//":
        base_path = "/"
    origin = "https://static-check.invalid"
    errors, pages, references = [], {}, []
    if not (root / "index.html").is_file():
        errors.append("Missing index.html")
    for path in sorted(root.rglob("*")):
        if not path.is_file():
            continue
        if path.suffix.lower() == ".php":
            errors.append("PHP source was published: " + str(path.relative_to(root)))
        if path.suffix.lower() not in (".html", ".htm", ".css"):
            continue
        content = path.read_text(encoding="utf-8")
        relative = path.relative_to(root).as_posix()
        if path.suffix.lower() == ".css":
            references.extend((relative, url) for url in css_links(content))
            continue
        if "<?php" in content or "<?=" in content or PHP_ERROR.search(content):
            errors.append(relative + ": contains PHP source or a PHP diagnostic")
        page = Page(content)
        if page.has_base_href:
            errors.append(relative + ": base href overrides are unsupported; use relative links")
        pages[relative] = page
        references.extend((relative, url) for url in page.links)
        references.extend((relative, url) for url in css_links("\n".join(page.styles)))

    for relative, url in references:
        url = url.strip()
        parsed = urlsplit(url)
        context = "{}: {}".format(relative, url)
        if parsed.hostname in ("localhost", "127.0.0.1", "::1"):
            errors.append(context + " points to a local development server")
            continue
        if parsed.scheme or parsed.netloc:
            continue
        if parsed.path.startswith("/"):
            errors.append(context + " must be relative for GitHub Pages project paths")
            continue
        if unquote(parsed.path).lower().endswith(".php"):
            errors.append(context + " must link to a rendered .html page")
            continue
        resolved = urlsplit(urljoin(origin + base_path + relative, url))
        resolved_path = unquote(resolved.path)
        if not resolved_path.startswith(base_path):
            errors.append(context + " escapes the site base path")
            continue
        target_name = resolved_path[len(base_path):]
        target = (root / target_name).resolve()
        if root != target and root not in target.parents:
            errors.append(context + " escapes the output directory")
            continue
        if target.is_dir():
            target /= "index.html"
        if not target.is_file():
            errors.append(context + " refers to a missing local file")
            continue
        fragment = unquote(parsed.fragment)
        target_page = pages.get(target.relative_to(root).as_posix())
        if fragment and target_page is not None and fragment not in target_page.ids:
            errors.append(context + " refers to a missing fragment")
    return errors


def main():
    parser = argparse.ArgumentParser(description=__doc__)
    parser.add_argument("directory", nargs="?", type=Path,
                        default=Path(__file__).resolve().parents[1] / "static_site")
    parser.add_argument("--base-path", default="/apnet-template/",
                        help="Simulated deployment prefix (default: /apnet-template/)")
    args = parser.parse_args()
    try:
        errors = check_site(args.directory, args.base_path)
    except (OSError, ValueError) as error:
        errors = [str(error)]
    if errors:
        print("Static site validation failed:\n- " + "\n- ".join(errors), file=sys.stderr)
        return 1
    print("Validated local links, fragments, and CSS assets under " + args.base_path)
    return 0


if __name__ == "__main__":
    sys.exit(main())
