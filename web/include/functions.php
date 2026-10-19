<?php
$site = require __DIR__ . '/../config/site.php';
$content = require __DIR__ . '/../data/content.php';

function e(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function event_name(): string
{
    global $site;
    return 'APNet ' . $site['year'];
}

function page_url(string $page): string
{
    return $page . (getenv('APNET_STATIC') === '1' ? '.html' : '.php');
}

function link_html(string $label, string $url = ''): string
{
    if (trim($url) === '') {
        return e($label);
    }
    if (getenv('APNET_STATIC') === '1') {
        $url = preg_replace('/^([a-zA-Z0-9_-]+)\.php(?=[?#]|$)/', '$1.html', $url);
    }
    $path = parse_url($url, PHP_URL_PATH) ?: '';
    // jQuery Mobile must leave documents and other resources to the browser.
    $attributes = $path !== '' && !preg_match('/\.(?:php|html?)$/i', $path) ? ' data-ajax="false"' : '';
    return '<a href="' . e($url) . '"' . $attributes . '>' . e($label) . '</a>';
}

function action_link(string $key, string $label): void
{
    global $site;
    $url = $site['links'][$key] ?? '';
    if ($url !== '') {
        echo '<p class="action-link">' . link_html($label, $url) . '</p>';
    } else {
        echo '<p class="notice">' . e($label) . ': to be announced.</p>';
    }
}

function render_sections(string $page): void
{
    global $content;
    foreach ($content['sections'][$page] ?? [] as $section) {
        echo '<section><h2>' . e($section['title']) . '</h2>';
        foreach ($section['paragraphs'] as $paragraph) {
            echo '<p' . ($page === 'registration' ? ' style="text-align: justify;"' : '') . '>' . e($paragraph) . '</p>';
        }
        if (!empty($section['links'])) {
            echo '<ul class="section-links">';
            foreach ($section['links'] as $link) {
                echo '<li>' . link_html($link['label'], $link['url']) . '</li>';
            }
            echo '</ul>';
        }
        echo '</section>';
    }
}

function render_person_rows(array $people): void
{
    if (!$people) {
        echo '<li data-icon="false"><p>To be announced.</p></li>';
        return;
    }
    foreach ($people as $person) {
        $linked = trim($person['url']) !== '';
        $open = $linked ? '<a href="' . e($person['url']) . '" target="_blank" rel="external noopener" class="nodecor">' : '';
        $close = $linked ? '</a>' : '';
        echo '<li data-icon="false"' . ($linked ? ' style="background-color: var(--color-surface);"' : '') . '><div class="ui-grid-a">';
        echo '<div class="ui-block-a">' . $open . '<p>' . e($person['name']) . '</p>' . $close . '</div>';
        echo '<div class="ui-block-b">' . $open . '<p>' . e($person['affiliation']) . '</p>' . $close . '</div>';
        echo '</div></li>';
    }
}

function render_date_item(string $label, string $date): void
{
    echo '<li data-icon="false"><div class="ui-grid-a"><div class="ui-block-a"><h2>' . e($label) . '</h2></div><div class="ui-block-b"><p>' . e($date) . '</p></div></div></li>';
}
