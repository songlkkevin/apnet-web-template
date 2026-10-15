<?php if ($page === 'visa'): ?>
<style>
ul {
  list-style-type: disc;
  padding-left: 20px;
}
</style>
<p><?= e($content['visa']['intro']) ?></p>
<?php if ($content['visa']['fields']): ?>
<ul>
<?php foreach ($content['visa']['fields'] as $field): ?>
  <li><?= e($field) ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<?php render_sections('visa'); ?>

<?php elseif ($page === 'supporters'): ?>
<?php
$supporter_tiers = [];
foreach ($content['sponsors'] as $sponsor) {
    $supporter_tiers[$sponsor['tier']][] = $sponsor;
}
foreach ($supporter_tiers as $tier => $sponsors):
?>
<h2><?= e($tier) ?></h2>
<div class="sponsors">
<?php foreach (array_chunk($sponsors, 2) as $row): ?>
  <center>
    <table width="100%" border="0">
      <tr>
<?php foreach ($row as $sponsor):
    $display_width = max(1, min(100, (float) ($sponsor['display_width'] ?? 75)));
?>
        <td align="center" width="<?= count($row) === 2 ? '50%' : '100%' ?>">
          <?php if (trim($sponsor['url']) !== ''): ?><a href="<?= e($sponsor['url']) ?>"><?php endif; ?>
            <img src="<?= e($sponsor['logo'] ?: 'images/sponsor-placeholder.svg') ?>" alt="<?= e($sponsor['name']) ?>" style="width: <?= e((string) $display_width) ?>%"/>
          <?php if (trim($sponsor['url']) !== ''): ?></a><?php endif; ?>
        </td>
<?php endforeach; ?>
      </tr>
    </table>
  </center>
<?php endforeach; ?>
</div>
<?php endforeach; ?>
<?php render_sections('supporters'); ?>

<?php elseif ($page === 'pastevent'): ?>
<style>
        .custom-list {
            list-style-type: none;
            padding: 0;
        }
        .custom-list li {
            font-style: italic;
            position: relative;
            padding-left: 20px;
        }
        .custom-list li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: black;
        }
</style>
<?php if ($content['past_events']): ?>
<ul class="custom-list">
<?php foreach ($content['past_events'] as $event): ?>
  <li><?= link_html($event['name'], $event['url']) ?><?php if ($event['location'] !== ''): ?> · <?= e($event['location']) ?><?php endif; ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<?php endif; ?>
