<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <div class="date" id="item-<?php print $title?>">
    <span><?php print $title; ?></span>
  </div>
<?php endif; ?>

<div class="items-wrapper">
  <?php foreach ($rows as $id => $row): ?>
    <?php print $row; ?>
  <?php endforeach; ?>
</div>
