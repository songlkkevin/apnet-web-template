<p>&nbsp;</p>
<?php action_link('registration', 'Registration portal'); ?>
<p>Early-bird registration deadline: <?= e($content['registration']['early_deadline']) ?>.</p>
<p>Registration deadline: <?= e($content['registration']['deadline']) ?>.</p>
<p>&nbsp;</p>
<p style="text-align: justify;"><?= e($content['registration']['intro']) ?></p>
<ul data-role="listview" data-inset="true" data-theme="a" data-content-theme="a" class="registration">
  <li data-role="list-divider">Registration fee (<?= e($content['registration']['currency']) ?>)</li>
  <li data-icon="false"><div class="ui-grid-a">
    <div class="ui-block-a"><p><b>Event</b></p></div>
<?php foreach ($content['registration']['categories'] as $category): ?>
    <div class="ui-block-b"><p><b><?= e($category) ?></b></p></div>
<?php endforeach; ?>
  </div></li>
<?php foreach ($content['registration']['fees'] as $fee): ?>
  <li data-icon="false"><div class="ui-grid-a">
    <div class="ui-block-a"><p><?= e($fee['category']) ?></p></div>
<?php foreach ($fee['amounts'] as $amount): ?>
    <div class="ui-block-b"><p><?= e($amount) ?></p></div>
<?php endforeach; ?>
  </div></li>
<?php endforeach; ?>
</ul>
<?php render_sections('registration'); ?>
