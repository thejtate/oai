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
$hover_image = (isset($content['field_tmh_items_hover_image']) &&
  !empty($content['field_tmh_items_hover_image']['#items'])) ?
  file_create_url($content['field_tmh_items_hover_image']['#items'][0]['uri']) : '';

$image = (isset($content['field_tmh_items_image']) &&
  !empty($content['field_tmh_items_image']['#items'])) ?
  file_create_url($content['field_tmh_items_image']['#items'][0]['uri']) : '';

$title = (isset($content['field_tmh_items_title']) &&
  !empty($content['field_tmh_items_title']['#items'])) ?
  $content['field_tmh_items_title']['#items'][0]['value'] : '';
?>

<div class="inner <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>
    <?php print render($content['field_tmh_items_link']); ?>

    <div style="background-image: url('<?php print $hover_image; ?>');" class="bg-hover"></div>
    <div style="background-image: url('<?php print $image; ?>');" class="bg"></div>

    <div class="item-content">
      <div class="valign">
        <div class="body pull-center">
          <p><strong><?php print $title; ?></strong></p>
        </div>
      </div>
    </div>

    <?php hide($content['field_tmh_items_hover_image']); ?>
    <?php hide($content['field_tmh_items_image']); ?>
    <?php hide($content['field_tmh_items_title']); ?>
    <?php print render($content); ?>
  </div>
</div>
