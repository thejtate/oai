<?php
/**
 * @file
 * acomp-blog--news-sidebar.tpl.php
 * theme sidebar blog
 */
?>

<div class="info-item">
  <?php if (isset($filter)): ?>
    <h5><?php print t('Filter Stories By:'); ?></h5>
    <?php print $filter; ?>
  <?php endif; ?>

  <?php if (isset($search_form)): ?>
    <div class="form form-search">
      <?php print $search_form; ?>
    </div>
  <?php endif; ?>
</div>