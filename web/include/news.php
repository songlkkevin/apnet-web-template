<?php if (!$content['news']): ?>
<p>News will be announced here.</p>
<?php else: ?>
<ul data-role="listview" data-inset="true" data-theme="a" data-content-theme="a" class="datetbl">
<?php foreach ($content['news'] as $news): ?>
  <li data-icon="false"><div class="ui-grid-a"><div class="ui-block-a"><h2><?= e($news['date']) ?></h2></div><div class="ui-block-b"><p><?= link_html($news['text'], $news['url']) ?></p></div></div></li>
<?php endforeach; ?>
<?php if (count($content['news']) > 6): ?>
  <li class="newslibtn ui-btn ui-li" data-theme="a" onclick="showall();"><div><a>Older News</a><span class="ui-icon ui-btn-icon-right ui-icon-plus ui-icon-shadow">&nbsp;</span></div></li>
<?php endif; ?>
</ul>
<?php endif; ?>
