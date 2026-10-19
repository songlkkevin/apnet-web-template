<?php
$full_title = $page === 'index' ? event_name() : $page_title . ' — ' . event_name();
$canonical = $site['base_url'] === '' ? '' : rtrim($site['base_url'], '/') . '/' . page_url($page);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($full_title) ?></title>
  <meta name="description" content="<?= e($site['description']) ?>">
  <meta property="og:title" content="<?= e($full_title) ?>">
  <meta property="og:description" content="<?= e($site['description']) ?>">
  <meta property="og:type" content="website">
<?php if ($canonical !== ''): ?>
  <link rel="canonical" href="<?= e($canonical) ?>">
  <meta property="og:url" content="<?= e($canonical) ?>">
<?php endif; ?>
<?php if ($site['base_url'] !== '' && $site['banner'] !== ''): ?>
  <meta property="og:image" content="<?= e(rtrim($site['base_url'], '/') . '/' . $site['banner']) ?>">
<?php endif; ?>
  <link rel="icon" href="images/favicon.svg" type="image/svg+xml">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="css/jquery.mobile-1.4.5.css">
  <link rel="stylesheet" href="css/style.css">
  <!-- Original APNet paragraph styling, previously in this header. -->
  <style>
    p {
      text-indent: 0 !important;
      margin-top: 0 !important;
      margin-bottom: 0.85em !important;
      line-height: 1.65 !important;
    }
  </style>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/script.js"></script>
  <script src="js/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
<div data-role="page" data-theme="a" class="main-page">
  <div class="header topbar" data-role="header" data-theme="a" data-position="inline">
    <div class="topbar-inner">
      <div class="topbar-brand">
        <a class="brand-link" href="<?= e(page_url('index')) ?>"><img src="<?= e($site['logo'] ?: 'images/logo-placeholder.svg') ?>" alt="<?= e(event_name()) ?>"></a>
        <button type="button" class="ui-btn-right" data-corners="true" data-icon="grid" id="menu-toggle" aria-controls="navigation" aria-expanded="false">MENU</button>
      </div>
      <?php require __DIR__ . '/menu.php'; ?>
    </div>
  </div>
  <div data-role="content" class="ui-content">
    <main id="main" class="content-primary">
