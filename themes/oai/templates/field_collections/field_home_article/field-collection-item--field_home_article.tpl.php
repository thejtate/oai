<?php

/**
 * @file
 * Default theme implementation for field collection items.
 *
 * Available variables:
 * - $content: An array of comment items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $title: The (sanitized) field collection item label.
 * - $url: Direct url of the current entity if specified.
 * - $page: Flag for the full page state.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. By default the following classes are available, where
 *   the parts enclosed by {} are replaced by the appropriate values:
 *   - entity-field-collection-item
 *   - field-collection-item-{field_name}
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
$link_text = isset($field_ha_link[0]['title']) ? $field_ha_link[0]['title'] : '';
$link_path = isset($field_ha_link[0]['url']) ? $field_ha_link[0]['url'] : '';
$hover_type = isset($field_ha_hover_type[0]['value']) ? $field_ha_hover_type[0]['value'] : '';
$image = isset($field_ha_image[0]['uri']) ? file_create_url($field_ha_image[0]['uri']) : '';
$hover_image = isset($field_ha_hover_image[0]['uri']) ? file_create_url($field_ha_hover_image[0]['uri']) : '';
$title = isset($field_ha_title[0]['value']) ? $field_ha_title[0]['value'] : '';
?>

<?php if ($hover_type): ?>
  <a class="link" href="<?php print $link_path; ?>">
    <span class="link-text"><?php print $link_text; ?></span>
  <span
    class="link-content valign <?php print ($hover_type == 'logo') ? 'pull-center' : ''; ?>">
    <?php switch ($hover_type):
      case 'text': ?>
        <?php print render($content['field_ha_hover_desc']); ?>
        <?php break; ?>
      <?php case 'logo': ?>
        <?php print render($content['field_ha_hover_logo']); ?>
        <?php break; ?>
      <?php endswitch; ?>
  </span>
  </a>
<?php endif; ?>

<?php if ($hover_image): ?>
  <div style="background-image: url('<?php print $hover_image; ?>');"
       class="bg-hover"></div>
<?php endif; ?>
<div style="background-image: url('<?php print $image; ?>');"
     class="bg"></div>

<div class="item-content">
  <div class="valign">
    <header>
      <h2><?php print $title; ?></h2>
      <?php if (isset($content['field_ha_subtitle'])): ?>
        <h3><?php print render($content['field_ha_subtitle']); ?></h3>
      <?php endif; ?>
    </header>
    <div class="body">
      <?php print render($content['field_ha_description']); ?>
    </div>
  </div>
</div>

<?php hide($content['field_ha_image']); ?>
<?php hide($content['field_ha_hover_type']); ?>
<?php hide($content['field_ha_hover_image']); ?>
<?php hide($content['field_ha_link']); ?>
<?php hide($content['field_ha_title']); ?>
<?php hide($content['field_ha_hover_logo']); ?>
<?php hide($content['field_ha_hover_desc']); ?>
<?php print render($content); ?>


