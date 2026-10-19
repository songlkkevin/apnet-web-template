<?php $edition_html = preg_replace('/^(\d+)(st|nd|rd|th)$/', '$1<sup>$2</sup>', e($site['edition'])); ?>
<div class="home-hero">
  <img src="<?= e($site['banner'] ?: 'images/banner-placeholder.svg') ?>" alt="<?= e($site['banner'] !== '' ? $site['banner_alt'] : 'Host city / conference image placeholder') ?>" class="center-image home-banner" width="100%">
</div>

<div class="home-welcome">
  <p class="welcome-lead">The <strong><?= $edition_html !== '' ? $edition_html . ' ' : '' ?><?= e($site['name']) ?> (<?= e(event_name()) ?>)</strong> will take place on <strong><?= e($site['dates']) ?></strong>, in <strong><?= e($site['location']) ?></strong>.</p>
  <p><?= e($content['welcome']) ?></p>
</div>

<?php if (!empty($content['notice']['text'])): ?>
<aside class="home-notice" aria-label="Important notice">
  <strong class="notice-badge">Important Notice</strong>
  <p><?= link_html($content['notice']['text'], $content['notice']['url']) ?></p>
</aside>
<?php endif; ?>

<div class="home-grid">
  <section class="home-panel">
    <h2>News</h2>
    <?php require __DIR__ . '/../news.php'; ?>
  </section>
  <section class="home-panel">
    <h2>Important Dates</h2>
    <?php require __DIR__ . '/../dates.php'; ?>
  </section>
</div>

<section class="home-sponsors-section">
  <h2>Sponsors</h2>
  <?php require __DIR__ . '/sponsors.php'; ?>
</section>
<?php render_sections('index'); ?>
