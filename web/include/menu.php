<nav class="leftnav" id="navigation" aria-label="Main navigation">
  <a href="<?= e(page_url('index')) ?>"><img src="<?= e($site['logo'] ?: 'images/logo-placeholder.svg') ?>" alt="<?= e(event_name()) ?>"></a>
  <ul data-role="listview" data-inset="true" data-theme="a" data-divider-theme="a">
<?php foreach ($site['navigation'] as $item): if (!$item['visible']) { continue; } ?>
    <li<?= $page === $item['page'] ? ' class="navselected"' : '' ?> data-icon="false"><a href="<?= e(page_url($item['page'])) ?>"<?= $page === $item['page'] ? ' aria-current="page"' : '' ?>><?= e($item['label']) ?></a></li>
<?php endforeach; ?>
  </ul>
</nav>
