<?php
$call = $content['calls'][$page];

// Text segments retain inline emphasis without accepting HTML in editable data.
$call_text = static function ($value): string {
    if (is_string($value)) {
        return e($value);
    }
    $html = '';
    foreach ($value as $segment) {
        $text = e($segment['text']);
        $html .= !empty($segment['bold']) ? '<b>' . $text . '</b>' : $text;
    }
    return $html;
};
$call_link = static function (string $label, string $url, string $attributes = ''): string {
    $html = link_html($label, $url);
    return trim($url) === '' || $attributes === '' ? $html : str_replace('<a ', '<a ' . $attributes . ' ', $html);
};
$call_portal = static function (string $label, string $url, string $attributes = '') use ($call_link): string {
    return trim($url) === '' ? e($label) . ': to be announced.' : $call_link($label, $url, $attributes) . '.';
};
?>
<?php if ($page === 'cfp' || $page === 'grant'): ?>
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
<?php endif; ?>

<?php if ($page === 'cfp'): ?>
<br>
<p style="text-align: justify; text-indent: 2em;"><?= $call_text($call['intro']) ?></p>
<br>
<p style="text-align: justify; text-indent: 2em;"><?= $call_text($call['invitation']) ?></p>
<ul class="custom-list">
<?php foreach ($content['topics'] as $topic): ?>
  <li style="font-style: italic;"><?= e($topic) ?></li>
<?php endforeach; ?>
</ul>
<br>
<h2><?= e($call['submission_title']) ?></h2>
<br>
<?php foreach ($call['submission'] as $index => $paragraph): ?>
<p style="text-align: justify; text-indent: 2em;"><?= $call_text($paragraph) ?><?php if ($index === 0): ?> <?= $call_portal($call['template_label'], $site['links']['paper_template'], 'download target="_blank"') ?><?php endif; ?></p>
<?php endforeach; ?>
<p style="text-indent: 2em;"><?= $call_portal($call['submission_label'], $site['links']['submission']) ?></p>
<br>
<h2><?= e($call['ai_title']) ?></h2>
<br>
<p style="text-align: justify; text-indent: 2em;"><?= $call_text($call['ai']) ?></p>
<br>
<h2><?= e($call['publication']['title']) ?></h2>
<br>
<p style="text-align: justify; text-indent: 2em; overflow-wrap: anywhere; word-break: break-word;"><?= $call_text($call['publication']['intro']) ?> <?= $call_link($call['publication']['guidance_label'], $call['publication']['guidance_url'], 'target="_blank" style="white-space: normal !important; overflow-wrap: anywhere; word-break: break-word;"') ?>.</p>
<p style="text-align: justify; text-indent: 2em;"><?= $call_text($call['publication']['resources_intro']) ?></p>
<?php foreach ($call['publication']['resources'] as $index => $resource): ?>
<p style="text-align: justify; text-indent: 2em; overflow-wrap: anywhere; word-break: break-word;"><?= e($resource['label']) ?>: <?= $call_link($resource['link_label'], $resource['url'], $index === 0 ? 'target="_blank" style="white-space: nowrap !important; overflow-wrap: normal; word-break: normal;"' : 'target="_blank" style="white-space: normal !important; overflow-wrap: anywhere; word-break: break-word;"') ?><?php if ($index === 0): ?><br><?php endif; ?></p>
<?php endforeach; ?>
<p style="text-align: justify; text-indent: 2em; overflow-wrap: anywhere; word-break: break-word;"><?= e($call['publication']['contact_intro']) ?> <?= $call_link($call['publication']['contact_label'], $call['publication']['contact_url'], 'style="white-space: normal !important; overflow-wrap: anywhere; word-break: break-word;"') ?>.</p>
<br>
<h2><?= e($call['camera_ready_title']) ?></h2>
<br>
<?php foreach ($call['camera_ready'] as $paragraph): ?>
<p style="text-align: justify; text-indent: 2em;"><?= $call_text($paragraph) ?></p>
<?php endforeach; ?>
<br>
<h2>Important Dates</h2>
<?php require __DIR__ . '/../dates.php'; ?>

<?php elseif ($page === 'cfposter'): ?>
<br>
<p style="text-align: justify; text-indent: 2em;"><b><?= $call_text($call['intro']) ?></b></p>
<br>
<p style="text-align: justify; text-indent: 2em;"><?= $call_text($call['overview']) ?></p>
<br><h2><?= e($call['motivation_title']) ?></h2><br>
<p style="text-align: justify; text-indent: 2em;"><?= $call_text($call['motivation']) ?></p>
<br>
<p style="text-align: justify; text-indent: 2em;"><b><?= $call_text($call['publication_notice']) ?></b></p>
<br><h2><?= e($call['format_title']) ?></h2><br>
<p style="text-align: justify; text-indent: 2em;"><?= $call_text($call['format']) ?></p>
<br><h2><?= e($call['submission_title']) ?></h2><br>
<p style="text-align: justify; text-indent: 2em;"><?= $call_portal($call['submission_label'], $site['links']['poster_submission']) ?> <?= $call_text($call['submission_note']) ?></p>
<br><h2><?= e($call['presentation_title']) ?></h2><br>
<p style="text-align: justify; text-indent: 2em;"><?= e($call['presentation_before']) ?><span class="highlighttext"><?= e($call['presentation_emphasis']) ?></span><?= e($call['presentation_after']) ?></p>
<br>
<p style="text-align: justify; text-indent: 2em;"><b><?= $call_text($call['presentation_notice']) ?></b></p>
<h2>Important Dates</h2>
<ul data-role="listview" data-inset="true" data-theme="a" data-content-theme="a" class="datetbl">
<?php foreach ($call['dates'] as $date): ?>
  <?php render_date_item($date['date'], $date['label']); ?>
<?php endforeach; ?>
</ul>
<h2>Poster Chairs</h2>
<ul data-role="listview" data-inset="true" data-theme="a" data-content-theme="a" class="datetbl">
<?php foreach ($content['organization']['Poster Chairs'] ?: [['name' => '[Poster chair name]', 'affiliation' => '[Institution]', 'url' => '']] as $person): ?>
  <li data-icon="false"<?= trim($person['url']) !== '' ? ' style="background-color: var(--color-surface);"' : '' ?>>
    <div class="ui-grid-a">
      <div class="ui-block-a">
        <?php if (trim($person['url']) !== ''): ?><a href="<?= e($person['url']) ?>" target="_blank" rel="external" class="nodecor"><?php endif; ?>
          <p><?= e($person['name']) ?></p>
        <?php if (trim($person['url']) !== ''): ?></a><?php endif; ?>
      </div>
      <div class="ui-block-b">
        <?php if (trim($person['url']) !== ''): ?><a href="<?= e($person['url']) ?>" target="_blank" rel="external" class="nodecor"><?php endif; ?>
          <p><?= e($person['affiliation']) ?></p>
        <?php if (trim($person['url']) !== ''): ?></a><?php endif; ?>
      </div>
    </div>
  </li>
<?php endforeach; ?>
</ul>

<?php elseif ($page === 'grant'): ?>
<?php foreach ($call['intro'] as $paragraph): ?>
<p style="text-align: justify; text-indent: 2em;"><?= $call_text($paragraph) ?></p>
<?php endforeach; ?>
<ul class="custom-list">
<?php foreach ($call['programs'] as $program): ?>
  <li><strong><?= e($program['title']) ?></strong></li>
<?php endforeach; ?>
</ul>
<p style="text-align: justify; text-indent: 2em;"><?= $call_text($call['program_note']) ?></p>
<h2>Important dates</h2>
<ul class="custom-list">
<?php foreach ($call['dates'] as $date): ?>
  <li><strong><?= e($date['label']) ?></strong> <span class="highlighttext"><?= e($date['date']) ?></span></li>
<?php endforeach; ?>
</ul>
<?php foreach ($call['programs'] as $index => $program): ?>
<h2><?= e($program['title']) ?></h2>
<h3>Eligibility</h3>
<p style="text-align: justify; text-indent: 2em;"><?= $call_text($program['eligibility_intro']) ?></p>
<ul<?= $index === 0 ? ' class="custom-list"' : '' ?>>
<?php foreach ($program['eligibility'] as $criterion): ?>
  <li><?= $call_text($criterion) ?></li>
<?php endforeach; ?>
</ul>
<h3>Application</h3>
<p style="text-align: justify; text-indent: 2em;"><?= $call_text($program['application_intro']) ?> <?= $call_portal($call['application_label'], $program['application_url'] ?: $site['links']['grant_application']) ?></p>
<?php if ($program['application']): ?>
<ul class="custom-list">
<?php foreach ($program['application'] as $requirement): ?>
  <li><?= $call_text($requirement) ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<?php endforeach; ?>
<h2>Selection Process</h2>
<ul class="custom-list">
<?php foreach ($call['selection'] as $criterion): ?>
  <li><?= $call_text($criterion) ?></li>
<?php endforeach; ?>
</ul>
<h2>Note</h2>
<?php foreach ($call['notes'] as $paragraph): ?>
<p style="text-align: justify; text-indent: 2em;"><?= $call_text($paragraph) ?></p>
<?php endforeach; ?>

<?php elseif ($page === 'awards-nomination'): ?>
<?php foreach ($call['intro'] as $paragraph): ?>
<p><?= $call_text($paragraph) ?></p>
<?php endforeach; ?>
<h2>Awards</h2>
<?php foreach ($call['awards'] as $index => $award): ?>
<h3><?= $index + 1 ?>. <?= e($award['title']) ?></h3>
<p><b>Purpose and significance:</b> <?= $call_text($award['purpose']) ?></p>
<p><b>Eligibility and criteria:</b> <?= $call_text($award['eligibility']) ?></p>
<p><b>Selection:</b> <?= $call_text($award['selection']) ?></p>
<?php endforeach; ?>
<h2>Nomination and Selection Process</h2>
<ol>
<?php foreach ($call['process'] as $index => $step): ?>
  <li><?= $call_text($step) ?><?php if ($index === 0): ?> <?= $call_portal($call['nomination_label'], $site['links']['award_nomination'], 'target="_blank" rel="noopener"') ?><?php endif; ?></li>
<?php endforeach; ?>
</ol>
<p><b>Nomination deadline:</b> <?= e($call['deadline']) ?></p>
<h2><?= e($call['committee_title']) ?></h2>
<p><b>Chair:</b> <?= e($call['chair']) ?></p>
<p><b>Members:</b></p>
<ul>
<?php foreach ($call['members'] as $member): ?>
  <li><?= e($member) ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
