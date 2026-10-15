<style>
        .custom-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            /* width: 100%; */
        }
        .custom-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px; /* 增加图片间的间距 */
            /* flex-wrap: wrap; */
        }
        .custom-row img {
            height: auto;
            max-width: 1000px; /* 设置默认宽度大20% */
        }
        .custom-row.first-row img {
            max-height: 60px; /* 保持第一行图片宽度 */
            width: auto;
        }
        .custom-row img.first-img {
            max-height: 60px;
            width: auto;
        }
        .custom-row img.second-img {
            max-height: 50px;
            width: auto;
        }
        .custom-row img.third-img {
            max-height: 75px;
            width: auto;
        }
        .custom-row img.four-img {
            max-height: 45px;
            width: auto;
        }
        .custom-row img.five-img {
            max-height: 60px;
            width: auto;
        }
        .custom-row img.six-img {
            max-height: 60px;
            width: auto;
        }
        @media screen and (max-width: 768px) {
            .custom-row img {
                max-width: 300px; /* 调整小屏幕时的宽度 */
            }
            .custom-row.first-row img {
                max-height: 30px;
                width: auto; 
            }
            .custom-row img.first-img {
                max-height: 30px;
                width: auto;
            }
            .custom-row img.second-img {
                max-height: 30px;
                width: auto;
            }
            .custom-row img.third-img {
                max-height: 30px;
                width: auto;
            }
            .custom-row img.four-img {
                max-height: 30px;
                width: auto;
            }
            .custom-row img.five-img {
                max-height: 20px;
                width: auto;
            }
            .custom-row img.six-img {
                max-height: 35px;
                width: auto;
            }
        }
    </style>
<?php if (!$content['sponsors']): ?>
<p>Supporters will be announced here.</p>
<?php else: ?>
<div class="custom-container">
<?php foreach (array_chunk($content['sponsors'], 3) as $row_index => $row): ?>
  <div class="custom-row">
<?php foreach ($row as $column_index => $sponsor):
    $classes = ['first-img', 'second-img', 'third-img', 'four-img', 'five-img', 'six-img'];
    $image_class = $classes[($row_index * 3 + $column_index) % count($classes)];
?>
    <?php if ($sponsor['url'] !== ''): ?><a href="<?= e($sponsor['url']) ?>"><?php else: ?><span><?php endif; ?>
      <img class="<?= e($image_class) ?>" src="<?= e($sponsor['logo'] ?: 'images/sponsor-placeholder.svg') ?>" alt="<?= e($sponsor['name']) ?>">
    <?php if ($sponsor['url'] !== ''): ?></a><?php else: ?></span><?php endif; ?>
<?php endforeach; ?>
  </div>
<?php endforeach; ?>
</div>
<?php endif; ?>
