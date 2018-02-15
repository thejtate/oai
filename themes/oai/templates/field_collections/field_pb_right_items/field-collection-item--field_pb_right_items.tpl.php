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
$image = (isset($content['field_pb_right_items_image']) && isset($content['field_pb_right_items_image']['#items'][0]['uri'])) ?
  file_create_url($content['field_pb_right_items_image']['#items'][0]['uri']) : '';
$hover_image = (isset($content['field_pb_right_items_hover_image']) && isset($content['field_pb_right_items_hover_image']['#items'][0]['uri'])) ?
  file_create_url($content['field_pb_right_items_hover_image']['#items'][0]['uri']) : '';
$link = (isset($content['field_pb_right_items_link']) && isset($content['field_pb_right_items_link']['#items'][0]['url'])) ?
  $content['field_pb_right_items_link']['#items'][0]['url'] : '';
$link_title = (isset($content['field_pb_right_items_link']) && isset($content['field_pb_right_items_link']['#items'][0]['title'])) ?
  $content['field_pb_right_items_link']['#items'][0]['title'] : '';
?>

<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>

    <div class="inner">
      <a class="link" href="<?php print $link; ?>">
        <span class="link-text"><?php print $link_title; ?></span>
        <span class="link-content valign">
          <?php print render($content['field_pb_right_items_hover_desc']); ?>
        </span>
      </a>

      <?php if ($hover_image): ?>
        <div style="background-image: url('<?php print $hover_image; ?>');" class="bg-hover"></div>
      <?php endif; ?>

      <?php if ($image): ?>
      <div style="background-image: url('<?php print $image; ?>');" class="bg"></div>
      <?php endif; ?>

      <div class="item-content">
        <div class="valign">
          <header>
            <h2><?php print render($content['field_pb_right_items_title']); ?></h2>
            <h3><?php print render($content['field_pb_right_items_subtitle']); ?></h3>
          </header>
          <div class="body">
            <?php print render($content['field_pb_right_items_desc']); ?>
          </div>
        </div>
      </div>
    </div>


    <?php hide($content['field_pb_right_items_image']); ?>
    <?php hide($content['field_pb_right_items_hover_image']); ?>
    <?php hide($content['field_pb_right_items_hover_color']); ?>
    <?php hide($content['field_pb_right_items_hover_type']); ?>
    <?php hide($content['field_pb_right_items_link']); ?>
    <?php hide($content['field_overlay_color']); ?>
    <?php print render($content); ?>
  </div>
</div>
