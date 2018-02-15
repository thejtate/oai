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
$icon = render($content['field_top_menu_items_icon']);
$url = '';
$title = '';

if (isset($content['field_top_menu_items_link']) && !empty($content['field_top_menu_items_link']['#items'])) {
  $url = $content['field_top_menu_items_link']['#items'][0]['url'];
  $title = $content['field_top_menu_items_link']['#items'][0]['title'];

  $path = parse_url($url);
  if (isset($path['path']) && ($path['path'] != '/')) {
    $path = ltrim($path['path'], '/');
  }
  else {
    $path = $url;
  }
  $url = drupal_get_normal_path($path);
}
?>

<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>

    <?php if ($url && $title): ?>
      <?php print l($icon . $title, $url, array('html' => TRUE)); ?>
    <?php endif; ?>

    <?php hide($content['field_top_menu_items_icon']); ?>
    <?php hide($content['field_top_menu_items_link']); ?>
    <?php hide($content['field_sl_color']); ?>
    <?php print render($content); ?>

  </div>
</div>
