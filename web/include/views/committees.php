<ul data-role="listview" data-inset="true" data-theme="a" data-content-theme="a" class="tbl">
<?php if ($page === 'organization'): ?>
<?php foreach ($content['organization'] as $role => $people): if ($role === 'Steering Committee') { continue; } ?>
  <li data-role="list-divider"><?= e($role) ?></li>
  <?php render_person_rows($people); ?>
<?php endforeach; ?>
<?php else: ?>
  <li data-role="list-divider">PC Co-Chairs</li>
  <?php render_person_rows($content['organization']['Program Chairs'] ?? []); ?>
  <li data-role="list-divider">PC Members</li>
  <?php render_person_rows($content['program_committee']); ?>
<?php endif; ?>
</ul>
<?php if ($page === 'organization' && array_key_exists('Steering Committee', $content['organization'])): ?>
<h2>Steering Committee</h2>
<ul data-role="listview" data-inset="true" data-theme="a" data-content-theme="a" class="tbl">
  <li data-role="list-divider"></li>
  <?php render_person_rows($content['organization']['Steering Committee']); ?>
</ul>
<?php endif; ?>
