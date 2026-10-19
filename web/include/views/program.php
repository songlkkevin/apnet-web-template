<style>
table, th, td {
  border: 1px solid var(--color-border);
  border-collapse: collapse;
}
th, td {
  padding: 10px;
  text-align: left;
}
</style>

<h2>Session Time</h2>
<table border="1">
<?php foreach ($content['program_session_times'] ?? [
    ['title' => 'Keynote Talk', 'duration' => '[Talk duration]'],
    ['title' => 'Regular Paper', 'duration' => '[Talk duration and Q&A]'],
    ['title' => 'Academic Insight Talk', 'duration' => '[Talk duration]'],
    ['title' => 'Industry Spotlight Talk', 'duration' => '[Talk duration]'],
] as $session_time): ?>
  <tr>
    <td><b><?= e($session_time['title']) ?></b></td>
    <td><?= e($session_time['duration']) ?></td>
  </tr>
<?php endforeach; ?>
</table>

<?php if (!$content['program']): ?>
<p>The schedule will be announced here.</p>
<?php endif; ?>

<?php foreach ($content['program'] as $day): ?>
<h2><?= e($day['day']) ?></h2>
<table border="1" cellpadding="10px">
  <tr>
    <td width="120px"><b><big>Time</big></b></td>
    <td><b><big>Event</big></b></td>
  </tr>
<?php foreach ($day['sessions'] as $session): ?>
  <tr>
    <td width="120px"><b><?= e($session['time']) ?></b></td>
    <td><b><?= e($session['title']) ?></b><?php foreach (['url' => '[paper]', 'slides' => '[Slides]', 'video' => '[Video]'] as $field => $label): ?><?php if (!empty($session[$field])): ?> <?= link_html($label, $session[$field]) ?><?php endif; ?><?php endforeach; ?>
<?php if (!empty($session['speaker'])): ?>
      <br><?= e($session['speaker']) ?>
<?php endif; ?>
<?php if (!empty($session['chair'])): ?>
      <br>Session Chair: <?= e($session['chair']) ?>
<?php endif; ?>
<?php if (!empty($session['room'])): ?>
      <br>Room: <?= e($session['room']) ?>
<?php endif; ?>
    </td>
  </tr>
<?php foreach ($session['items'] as $item): ?>
  <tr>
    <td width="120px"></td>
    <td><?= e($item['title']) ?><?php foreach (['url' => '[paper]', 'slides' => '[Slides]', 'video' => '[Video]'] as $field => $label): ?><?php if (!empty($item[$field])): ?> <?= link_html($label, $item[$field]) ?><?php endif; ?><?php endforeach; ?>
      <br><i><small><?= e($item['authors']) ?></small></i>
    </td>
  </tr>
<?php endforeach; ?>
<?php endforeach; ?>
</table>
<?php endforeach; ?>

<?php if (!empty($content['program_note'])): ?>
<p style="margin-top: 1em;"><?= e($content['program_note']) ?></p>
<?php endif; ?>
