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
<?php
$style_class = isset($style_class) ? $style_class : '';
$popup_button_text = isset($popup_button_text) ? $popup_button_text : '';
$description = isset($description) ? $description : '';
?>

<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <div class="content"<?php print $content_attributes; ?>>

    <div class="notice <?php print $style_class;?>">
      <p>
        <span><?php print $description; ?></span>
        <?php print render($content['field_enrollment_link']); ?>

        <?php if ($popup_button_text): ?>
          <a href="#" data-toggle="modal" class="link" data-target="#modal-image">
            <?php print $popup_button_text; ?>
          </a>
        <?php endif; ?>
      </p>
    </div>

    <?php hide($content['field_enrollment_description']); ?>
    <?php print render($content); ?>
  </div>
</div>
