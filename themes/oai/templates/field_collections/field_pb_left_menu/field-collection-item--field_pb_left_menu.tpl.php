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
$url = isset($content['field_pb_left_menu_image']['#items'][0]['uri']) ?
  file_create_url($content['field_pb_left_menu_image']['#items'][0]['uri']) : '';
$hover_url = isset($content['field_pb_left_menu_hov_image']['#items'][0]['uri']) ?
  file_create_url($content['field_pb_left_menu_hov_image']['#items'][0]['uri']) : '';
?>

<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>

    <div class="inner">
      <?php print render($content['field_pb_left_menu_link']); ?>
      <?php if ($url): ?>
      <div style="background-image: url('<?php print $url; ?>');" class="bg"></div>
      <?php endif; ?>
      <?php if ($hover_url): ?>
      <div style="background-image: url('<?php print $hover_url; ?>');" class="bg-hover"></div>
      <?php endif; ?>
      <div class="item-content">
        <div class="valign <?php print isset($content['field_pb_left_items_list_icon']) ? '' : 'pull-center'; ?>">
          <header>
            <?php if ($url): ?>
              <h3><?php print render($content['field_pb_left_menu_title']); ?></h3>
            <?php else: ?>
              <h2>
                <?php print render($content['field_pb_left_menu_title']); ?>
                <?php print render($content['field_pb_left_items_list_icon']); ?>
              </h2>
            <?php endif; ?>
          </header>
        </div>
      </div>
    </div>

    <?php hide($content['field_pb_left_menu_image']); ?>
    <?php hide($content['field_pb_left_menu_hov_image']); ?>
    <?php print render($content); ?>
  </div>
</div>
