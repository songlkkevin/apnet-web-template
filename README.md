# apent web template

A reusable website template for APNet conferences. Conference details and content are configured separately from the shared PHP layout. The site can run with PHP or be built as static HTML for GitHub Pages and other static hosts.

## Requirements

- PHP 8.1 or later
- Python 3.9 or later

No npm installation is required. jQuery 1.11.2, jQuery Mobile 1.4.5, and their styles and icons are included. Raleway is loaded from Google Fonts over HTTPS, with a sans-serif fallback.

## Quick start

1. Create a repository from this template or copy the source.
2. Update `web/config/site.php` with the conference details.
3. Replace the example content in `web/data/content.php` and `web/data/calls.php`.
4. Add conference images to `web/images/` and public downloads to `web/files/`.
5. Preview the site, then build and validate it before publishing.

Run the PHP preview from the repository root:

```sh
php -S 127.0.0.1:8000 -t web
```

Open <http://127.0.0.1:8000>. Refresh the browser after editing files. Press `Ctrl+C` to stop the server.

## Configuration

Edit `web/config/site.php` to set the year, edition, conference name, dates, location, venue, deadline time zone, contact email, and navigation.

| Setting | Usage |
| --- | --- |
| `base_url` | Full public HTTPS URL, including any project subpath, without a trailing slash. Leave empty to omit canonical and `og:url` metadata. |
| `logo`, `banner` | Image paths relative to `web/`, such as `images/conference-logo.png`. Empty values use the included SVG placeholders. |
| `banner_alt` | Alternative text for the conference banner. |
| `links` | Submission, registration, proceedings, and other conference links. Leave unavailable links empty. |
| `navigation` | Page identifiers, menu labels, optional page `heading`, and visibility. Setting `visible` to `false` hides a menu entry; the page remains accessible and is still built. |

## Content

Edit `web/data/content.php` to manage the conference content. Copy the existing array structures to add entries. Text is escaped automatically, so use plain text rather than HTML. Empty arrays represent lists that have not been announced.

| Field | Content |
| --- | --- |
| `welcome`, `notice`, `news`, `dates`, `topics` | Introduction, announcements, deadlines, and research topics |
| `organization`, `program_committee` | Committee roles, names, affiliations, and links |
| `program`, `program_session_times`, `program_note` | Conference days, sessions, presentations, and schedule notes |
| `talks` | Keynote, industry, and academic talks |
| `papers`, `posters` | Accepted work, authors, and materials |
| `registration` | Registration information, currency, and fees |
| `sponsors`, `past_events` | Supporters and links to previous conferences |
| `visa` | Invitation letter introduction and required information |
| `sections` | Page-specific headings, paragraphs, and supporting links |

Edit `web/data/calls.php` for paper, poster, travel grant, and award calls. Paragraphs accept plain text or arrays of text segments with an optional `bold` flag, as shown in the examples.

Registration uses four `categories` and fee rows with an `amounts` value for each category, preserving the original five-column layout. Speaker photos and sponsor logos fall back to generic images when their paths are empty. The optional Supporters page groups sponsors by `tier`; an optional numeric `display_width` controls each logo’s percentage width on that page.

Sections can include optional links:

```php
[
    'title' => 'Author Guidance',
    'paragraphs' => ['Confirmed author instructions.'],
    'links' => [
        ['label' => 'Submission instructions', 'url' => 'cfp.php'],
    ],
],
```

Links can use HTTPS URLs, `mailto:` addresses, or relative paths. Links to top-level `.php` pages are converted to `.html` during the static build. Additional homepage sections belong in `sections['index']`.

Replace `YYYY`, bracketed examples, and placeholder text with confirmed details. Leave optional URLs empty until available. Review submission requirements, publication policies, registration fees, refund terms, and visa information for each conference.

## Project structure

| Path | Purpose |
| --- | --- |
| `web/config/site.php` | Conference configuration and navigation |
| `web/data/content.php` | Conference content |
| `web/data/calls.php` | Paper, poster, travel grant, and award calls |
| `web/*.php` | Public page entry points |
| `web/include/` | Shared layout and content rendering |
| `web/css/` | Site styles, jQuery Mobile styles, and required icons |
| `web/js/` | Local JavaScript libraries and page interactions |
| `web/images/` | Logos, banners, speaker photos, and sponsor images |
| `web/files/` | Public downloads |
| `scripts/` | Static build and validation tools |
| `tests/` | Build and template tests |
| `static_site/` | Generated output; do not edit directly |

Keep the interface icons in `web/css/images/`. Add only public assets to `css/`, `js/`, `images/`, and `files/`, as these directories are copied into the static output.

## Build and validate

Run from the repository root:

```sh
bash scripts/generate_static.sh
python3 scripts/check_site.py static_site
python3 -m unittest discover -s tests -v
```

The build renders all top-level PHP pages, copies public assets, and validates local links, fragments, and CSS asset references. It does not require a running preview server. PHP source, configuration files, and data files are excluded from the output; their rendered content remains public.

A successful build replaces the previous generated output and removes stale files. The builder refuses to overwrite an unrelated nonempty directory. To choose another output directory:

```sh
python3 scripts/build_site.py --output /tmp/apnet-preview
```

Preview the static site:

```sh
python3 -m http.server 8001 --directory static_site
```

Open <http://127.0.0.1:8001> and check desktop and mobile layouts. External links and factual conference details require manual review.

## Deployment

For GitHub Pages, select **GitHub Actions** as the source in the repository's Pages settings. The included workflow validates pull requests, pushes to `main`, and manual runs. Deployment runs only from `main`.

For a custom domain, add a root-level `CNAME` file containing the domain, configure the domain in GitHub Pages and DNS, and update `base_url`. Otherwise, omit `CNAME`.

For other static hosting services, upload the contents of `static_site/`.

To make this repository available through GitHub's **Use this template** button, enable **Template repository** in the repository settings.

## License and attribution

Licensed under [Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported](https://creativecommons.org/licenses/by-nc-sa/3.0/). See [LICENSE.md](LICENSE.md).

Based on the [ACM SIGCOMM 2012 website](https://conferences.sigcomm.org/sigcomm/2012/) ([source](https://github.com/ryanrhymes/SIGCOMM2012)), with contributions from [SIGCOMM 2014](https://github.com/brighten/SIGCOMM2014), [SIGCOMM 2016](https://github.com/apietila/SIGCOMM2016), and APNet websites. Retain the license and source attribution when reusing the template.

Included jQuery and jQuery Mobile libraries retain their MIT license notices. Conference images, logos, and uploaded materials may have separate licenses.
