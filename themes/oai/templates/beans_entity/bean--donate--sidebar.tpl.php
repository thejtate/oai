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
<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <div class="content"<?php print $content_attributes; ?>>
    <div class="info-item">
      <h6><?php print $title; ?></h6>

      <p><?php print render($content['field_donate_block_name']); ?><br/>
        <?php print render($content['field_donate_block_position']); ?><br/>
        <a href="tel:<?php print preg_replace("/[^0-9]/", "", $content['field_donate_block_phone']['#items'][0]['value']); ?>">
          <?php print render($content['field_donate_block_phone']); ?>
        </a>
        <?php if (isset($content['field_donate_block_phone'])): ?>
          , <?php print render($content['field_donate_block_phone_ext_']); ?>
        <?php endif; ?>
        <br/>
        <?php print render($content['field_donate_block_email']); ?>
      </p>
      <?php print render($content); ?>
    </div>
  </div>
</div>
