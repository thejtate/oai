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
$image_url = isset($content['field_sb_image']['#items'][0]['uri']) ?
  file_create_url($content['field_sb_image']['#items'][0]['uri']) : '';
$url = isset($content['field_sb_link']['#items'][0]['url']) ?
  $content['field_sb_link']['#items'][0]['url'] : '';
?>

<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <div class="content"<?php print $content_attributes; ?>>

    <div class="box">
      <div class="bg" style="background-image: url('<?php print $image_url; ?>');"></div>
      <a href="<?php print $url; ?>">
        <div class="valign">
          <?php print render($content['field_sb_desc']); ?>
        </div>
      </a>

      <?php hide($content['field_sb_image']); ?>
      <?php hide($content['field_sb_link']); ?>
      <?php print render($content); ?>
    </div>

  </div>
</div>
