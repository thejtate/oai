<?php

/**
 * @file field.tpl.php
 * Default template implementation to display the value of a field.
 *
 * This file is not used and is here as a starting point for customization only.
 * @see theme_field()
 *
 * Available variables:
 * - $items: An array of field values. Use render() to output them.
 * - $label: The item label.
 * - $label_hidden: Whether the label display is set to 'hidden'.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - field: The current template type, i.e., "theming hook".
 *   - field-name-[field_name]: The current field name. For example, if the
 *     field name is "field_description" it would result in
 *     "field-name-field-description".
 *   - field-type-[field_type]: The current field type. For example, if the
 *     field type is "text" it would result in "field-type-text".
 *   - field-label-[label_display]: The current label position. For example, if
 *     the label position is "above" it would result in "field-label-above".
 *
 * Other variables:
 * - $element['#object']: The entity to which the field is attached.
 * - $element['#view_mode']: View mode, e.g. 'full', 'teaser'...
 * - $element['#field_name']: The field name.
 * - $element['#field_type']: The field type.
 * - $element['#field_language']: The field language.
 * - $element['#field_translatable']: Whether the field is translatable or not.
 * - $element['#label_display']: Position of label display, inline, above, or
 *   hidden.
 * - $field_name_css: The css-compatible field name.
 * - $field_type_css: The css-compatible field type.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess_field()
 * @see theme_field()
 *
 * @ingroup themeable
 */
?>
<div class="section section-content">
  <div class="row text-blocks-wrapper">
    <div class="col-md-9">
      <div class="row">
        <div class="item text-block col-sm-6 <?php print render($items_classes[0]);?>">
          <?php print render($items[0]); ?>
        </div>
        <div class="item text-block col-sm-6 <?php print render($items_classes[1]);?>">
          <?php print render($items[1]); ?>
        </div>
      </div>
    </div>
    <div class="item text-block col-md-3 <?php print render($items_classes[2]);?>">
      <?php print render($items[2]); ?>
    </div>
  </div>
  <div class="row text-blocks-wrapper">
    <div class="item text-block col-sm-6 <?php print render($items_classes[3]);?>">
      <?php print render($items[3]); ?>
    </div>
    <div class="item text-block col-sm-3 <?php print render($items_classes[4]);?>">
      <?php print render($items[4]); ?>
    </div>
    <div class="item text-block col-sm-3 <?php print render($items_classes[5]);?>">
      <?php print render($items[5]); ?>
    </div>
  </div>
  <div class="row text-blocks-wrapper">
    <div class="item col-md-3 text-block <?php print render($items_classes[6]);?>">
      <?php print render($items[6]); ?>
    </div>
    <div class="col-md-9">
      <div class="row">
        <div class="item text-block col-sm-6 <?php print render($items_classes[7]);?>">
          <?php print render($items[7]); ?>
        </div>
        <div class="item text-block col-sm-6 <?php print render($items_classes[8]);?>">
          <?php print render($items[8]); ?>
        </div>
      </div>
    </div>
  </div>

  <?php foreach ($items as $delta => $item): ?>
    <?php print $delta > 9 ? render($item) : ''; ?>
  <?php endforeach; ?>


</div>