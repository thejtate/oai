<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php
$title_icon = explode('|', $title);
$title = !empty($title_icon[0]) ? $title_icon[0] : '';
$icon = !empty($title_icon[1]) ? $title_icon[1] : '';
?>
<div class="item-content type-info <?php print empty($icon) ? 'without-ico' : ''; ?>">
  <?php if (!empty($title)): ?>
    <div class="item-hd color-g">
      <h3 <?php print isset($title_id) ? 'id = ' . $title_id : ''; ?>><?php print $title; ?></h3>
      <?php print $icon; ?>
    </div>
  <?php endif; ?>
  <div class="item-bd">
    <?php foreach ($rows as $id => $row): ?>
      <div<?php if ($classes_array[$id]) {
        print ' class="' . $classes_array[$id] . '"';
      } ?>>
        <?php print $row; ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>