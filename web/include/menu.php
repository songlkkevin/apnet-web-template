<?php
$visible_navigation = array_values(array_filter($site['navigation'], static function (array $item): bool {
    return $item['visible'];
}));
$primary_navigation = array_slice($visible_navigation, 0, 4);
$more_navigation = array_slice($visible_navigation, 4);
$more_is_current = in_array($page, array_column($more_navigation, 'page'), true);
?>
<nav class="leftnav topnav" id="navigation" aria-label="Main navigation">
  <ul class="nav-list" data-role="none">
<?php foreach ($primary_navigation as $item): ?>
    <li<?= $page === $item['page'] ? ' class="navselected"' : '' ?>><a class="nav-link" href="<?= e(page_url($item['page'])) ?>"<?= $page === $item['page'] ? ' aria-current="page"' : '' ?>><?= e($item['label']) ?></a></li>
<?php endforeach; ?>
<?php if ($more_navigation): ?>
    <li class="nav-more">
      <details class="nav-dropdown<?= $more_is_current ? ' nav-has-current' : '' ?>">
        <summary class="nav-link">More</summary>
        <ul class="nav-submenu" data-role="none">
<?php foreach ($more_navigation as $item): ?>
          <li<?= $page === $item['page'] ? ' class="navselected"' : '' ?>><a class="nav-link" href="<?= e(page_url($item['page'])) ?>"<?= $page === $item['page'] ? ' aria-current="page"' : '' ?>><?= e($item['label']) ?></a></li>
<?php endforeach; ?>
        </ul>
      </details>
    </li>
<?php endif; ?>
  </ul>
</nav>
