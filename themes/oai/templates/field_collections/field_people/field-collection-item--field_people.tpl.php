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
<?php $color_class = isset($color_class) ? $color_class : ''; ?>

<div class="item-inner">
  <div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
    <div class="content"<?php print $content_attributes; ?>>

      <div class="part-photo">
        <?php print render($content['field_people_photo']); ?>
      </div>

      <div class="part-desc">
        <div class="item-inner-hd <?php print $color_class; ?>">
          <h4><?php print render($content['field_people_name']); ?>
            <span><?php print render($content['field_people_profession']); ?></span>
          </h4>
        </div>
        <div class="item-inner-bd">
          <?php print render($content['field_people_desc']); ?>

          <?php print render($content['field_people_link']); ?>

          <?php if (isset($content['field_people_email'])): ?>
            <div class="subtext">
              <span class="font-<?php print $color_class; ?>"><?php print t('EMAIL'); ?></span>
              <?php print render($content['field_people_email']); ?>
            </div>
          <?php endif; ?>

          <?php if (isset($content['field_people_phone'])): ?>
            <div class="subtext">
              <span class="font-<?php print $color_class; ?>"><?php print t('PHONE'); ?></span>
              <?php print render($content['field_people_phone']); ?>
              <?php if (isset($content['field_people_phone_ext'])): ?>
                <?php print ', ' . render($content['field_people_phone_ext']); ?>
              <?php endif; ?>
            </div>
          <?php endif; ?>

        </div>
        <?php
        print render($content);
        ?>
      </div>
    </div>
  </div>
</div>
