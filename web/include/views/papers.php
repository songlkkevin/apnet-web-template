<?php
$is_poster_list = $page === 'acceptposters';
$accepted_items = $content[$is_poster_list ? 'posters' : 'papers'];
?>

<p style="text-align: justify;">
    We are delighted to announce the following list of accepted <?= $is_poster_list ? 'posters' : 'papers' ?> for <?= e(event_name()) ?>.
</p>

<?php if ($accepted_items): ?>
<?php foreach ($accepted_items as $accepted_item): ?>
<div>
<b><?php if ($is_poster_list): ?><?= e($accepted_item['title']) ?><?php else: ?><?= link_html($accepted_item['title'], $accepted_item['url'] ?? '') ?><?php endif; ?></b>
<br>
<i style="font-size: smaller;"><?= e($accepted_item['authors']) ?></i>
<br><br>
</div>

<?php endforeach; ?>
<?php else: ?>
<p style="text-align: justify;">
    <?= $is_poster_list ? 'Poster' : 'Paper' ?> list coming soon.
</p>
<?php endif; ?>
