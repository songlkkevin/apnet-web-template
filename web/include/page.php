<?php
require_once __DIR__ . '/functions.php';
$page_title = ucwords(str_replace('-', ' ', $page));
$page_heading = $page_title;
foreach ($site['navigation'] as $item) {
    if ($item['page'] === $page) {
        $page_title = $item['label'];
        $page_heading = $item['heading'] ?? $item['label'];
        break;
    }
}
require __DIR__ . '/header.php';
if ($page === 'index') {
    require __DIR__ . '/views/home.php';
} else {
    echo '<h1>' . e($page_heading) . '</h1>';
    switch ($page) {
        case 'cfp':
        case 'cfposter':
        case 'grant':
        case 'awards-nomination':
            require __DIR__ . '/views/calls.php';
            break;
        case 'registration':
            require __DIR__ . '/views/registration.php';
            break;
        case 'organization':
        case 'pc':
            require __DIR__ . '/views/committees.php';
            break;
        case 'accept':
        case 'acceptposters':
            require __DIR__ . '/views/papers.php';
            if ($site['links']['proceedings'] !== '') {
                action_link('proceedings', 'Conference proceedings');
            }
            break;
        case 'apnetprogram':
            require __DIR__ . '/views/program.php';
            break;
        case 'keynote':
        case 'industry':
        case 'sigcommnsdi':
            require __DIR__ . '/views/talks.php';
            break;
        case 'local':
            echo '<h2>Venue</h2><p>' . e($site['venue']) . '<br>' . e($site['location']) . '</p>';
            action_link('venue_map', 'Venue map');
            action_link('hotel_booking', 'Hotel booking');
            render_sections($page);
            break;
        case 'supporters':
        case 'pastevent':
        case 'visa':
            require __DIR__ . '/views/optional.php';
            break;
        default:
            render_sections($page);
    }
}
require __DIR__ . '/footer.php';
