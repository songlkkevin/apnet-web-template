<ul data-role="listview" data-inset="true" data-theme="a" data-content-theme="a" class="datetbl">
  <?php render_date_item('Workshop', $site['dates']); ?>
<?php foreach ($content['dates'] as $date): ?>
  <?php render_date_item($date['label'], $date['date'] . (!empty($date['show_timezone']) ? ' ' . $site['timezone'] : '')); ?>
<?php endforeach; ?>
</ul>
