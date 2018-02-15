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
global $base_url;
$theme_path = base_path() . drupal_get_path('theme', 'oai');
?>

<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <div class="content"<?php print $content_attributes; ?>>
    <div class="logo">
      <a href="<?php print $base_url; ?>">
        <img src="<?php print $theme_path; ?>/images/logo-a.png"
             alt="">
      </a>
    </div>
    <address>
      <?php print render($content['field_fa_address']); ?>
      <?php print render($content['field_fa_phone']); ?>
      <?php print render($content['field_fa_email']); ?>
    </address>
    <?php print render($content['field_fa_copyright']); ?>

    <?php print render($content); ?>
  </div>
</div>
