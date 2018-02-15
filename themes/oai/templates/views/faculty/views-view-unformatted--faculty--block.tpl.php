<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>

<div class="item-content type-info">
  <?php if (!empty($title)): ?>
    <div class="item-hd color-i">
      <?php print $title; ?>
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