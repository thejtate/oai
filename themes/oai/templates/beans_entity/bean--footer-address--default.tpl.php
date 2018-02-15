<?php
/**
 * @file
 * Default theme implementation for beans.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) entity label.
 * - $url: Direct url of the current entity if specified.
 * - $page: Flag for the full page state.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-{ENTITY_TYPE}
 *   - {ENTITY_TYPE}-{BUNDLE}
 *
 * Other variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess()
 * @see template_preprocess_entity()
 * @see template_process()
 */
?>

<div class="<?php print $classes; ?> "<?php print $attributes; ?>>

  <div class="info-item">
    <h6><?php print t('Oklahoma Arts Institute
      Administrative Offices'); ?></h6>
    <h4><?php print render($content['field_fa_address']); ?></h4>
    <h4>
      <?php if(!empty($content['field_fa_phone'])): ?>
        <?php print render($content['field_fa_phone']); ?>  <span><?php print t('PHONE'); ?></span> <br>
      <?php endif; ?>
      <?php if(!empty($content['field_fa_fax'])): ?>
      <?php print render($content['field_fa_fax']); ?>  <span><?php print t('FAX'); ?></span> <br>
      <?php endif; ?>
      <?php print render($content['field_fa_email']); ?>
    </h4>
  </div>
  <div class="info-item">
    <h6><?php print t('Media Contact'); ?></h6>
    <?php print render($content['field_fa_media_info']);?>
  </div>


    <?php print render($content); ?>

</div>
