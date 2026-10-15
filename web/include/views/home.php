<img src="<?= e($site['banner'] ?: 'images/banner-placeholder.svg') ?>" alt="<?= e($site['banner'] !== '' ? $site['banner_alt'] : 'Host city / conference image placeholder') ?>" class="center-image" width="100%">
<p style="text-align: justify; text-indent: 2em;">The <?= e($site['edition']) ?> <?= e($site['name']) ?> (<?= e(event_name()) ?>) will take place on <?= e($site['dates']) ?>, in <?= e($site['location']) ?>. <?= e($content['welcome']) ?></p>
<br>
<?php if (!empty($content['notice']['text'])): ?>
<p style="text-align: justify;"><b>Important Notice:</b> <?= link_html($content['notice']['text'], $content['notice']['url']) ?></p>
<?php endif; ?>
<h2>News</h2>
<?php require __DIR__ . '/../news.php'; ?>
<h2>Important Dates</h2>
<?php require __DIR__ . '/../dates.php'; ?>
<h2>Sponsors</h2>
<?php require __DIR__ . '/sponsors.php'; ?>
<?php render_sections('index'); ?>
