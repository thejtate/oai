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
if($content['field_participant_block_bg']['#items'][0]['value'] == 'image' &&
!empty($content['field_participant_block_bg_img']['#items'][0]['uri'])) {
  $img_url = file_create_url($content['field_participant_block_bg_img']['#items'][0]['uri']);
} else {
  $img_url = FALSE;
}
?>
<?php if($img_url): ?>
  <div style="background-image: url('<?php print $img_url;?>');" class="bg"></div>
<?php endif; ?>
<?php if(!empty($content['field_participant_block_link'])): ?>
    <?php $content['field_participant_block_link'][0]['#element']['title']= ' ';?>
  <?php print render($content['field_participant_block_link']);?>
<?php endif; ?>
<div class="item-content">
  <div class="valign">
    <?php if(!empty($content['field_participant_block_title'])): ?>
      <header>
        <h2><?php print render($content['field_participant_block_title']);?></h2>
      </header>
    <?php endif; ?>
    <?php if(!empty($content['field_participant_block_text'])): ?>
    <div class="body">
        <?php print render($content['field_participant_block_text']);?>
    </div>
    <?php endif; ?>
  </div>
  <?php
  hide($content['field_sl_color']);
  hide($content['field_participant_block_bg']);
  //print render($content);
  ?>

</div>

