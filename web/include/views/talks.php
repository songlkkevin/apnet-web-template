<?php
// The three original talk pages shared this card layout and inline stylesheet.
$talks = $content['talks'][$page] ?? [];
?>
<style>
  /* 基础样式 */
  .container {
    background-color: #eaeaea;
    margin: 2em;
    border-radius: 10px;
    display: flex;
    align-items: center;
    padding: 20px;
    box-sizing: border-box;
  }
  .image-container {
    flex: 0 0 200px; /* 固定图片区域的宽度为200px */
  }
  .image-container img {
    width: 100%;
    height: auto;
    border: none; /* 移除边框 */
    max-height: 200px; /* 限制图片的最大高度 */
    object-fit: contain; /* 保持图片的宽高比 */
  }
  .text-container {
    flex-grow: 1; /* 文字区域占据剩余空间 */
    padding-left: 20px;
    overflow: hidden; /* 防止内容溢出 */
  }

  /* 媒体查询，用于小屏幕设备 */
  @media (max-width: 600px) {
    .container {
      flex-direction: column; /* 在小屏幕上将布局调整为垂直堆叠 */
    }
    .image-container {
      flex: 0 0 auto; /* 图片容器宽度自适应 */
    }
    .text-container {
      padding-left: 0;
      padding-top: 20px; /* 在图片下方增加一些间隔 */
    }
  }
</style>

<?php if (!$talks): ?>
<p>Speakers and talks will be announced here.</p>
<?php else: ?>
<?php foreach ($talks as $talk): ?>
<div class="container">
  <div class="image-container">
    <img src="<?= e(($talk['photo'] ?? '') ?: 'images/speaker-placeholder.svg') ?>" alt="<?= e($talk['name'] ?? '[Speaker name]') ?>">
  </div>
  <div class="text-container">
    <h2><?= link_html($talk['name'] ?? '[Speaker name]', $talk['url'] ?? '') ?></h2>
    <p><?= e($talk['affiliation'] ?? '[Position and institution]') ?></p>
    <h2>Talk Title:</h2>
    <p><?= e($talk['title'] ?? '[Talk title]') ?><?php foreach (['slides' => 'Slides', 'video' => 'Video'] as $key => $label): ?><?php if (!empty($talk[$key])): ?> <?= link_html('[' . $label . ']', $talk[$key]) ?><?php endif; ?><?php endforeach; ?></p>
  </div>
</div>
<p style="text-align: justify;"><b>Abstract:</b> <?= e($talk['abstract'] ?? 'To be announced.') ?></p>
<p style="text-align: justify;"><b>Speaker Bio:</b> <?= e($talk['bio'] ?? 'To be announced.') ?></p>
<?php endforeach; ?>
<?php endif; ?>
