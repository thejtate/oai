<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
//kpr($fields);die;
?>
<?php switch ($fields['field_timeline_el_color_list']->content) {
  case 'fall':
    $block_color = 'e';
    break;
  case 'summer':
    $block_color = 'h';
    break;
  case 'general':
    $block_color = 'g';
    break;
} ?>
<div class="history-item-wrapper">
  <div
    class="history-item color-<?php print !empty($block_color) ? $block_color : 'g'; ?> el-with-animation animate-opacity">
    <h5><?php print $fields['field_timeline_element_date']->content; ?>
    </h5>
    <h4><?php print $fields['title']->content; ?></h4>
    <?php if (!empty($fields['field_artist_website_link']->content)): ?>
      <?php print $fields['field_artist_website_link']->content ?>
    <?php endif; ?>
    <?php print $fields['body']->content; ?>

    <?php if (!empty($fields['field_timeline_el_show_link_chck']->content)): ?>
      <p class="rteright"><a
          href="<?php print url('node/' . $fields['nid']->content) ?>"><strong>
            <?php print t('&gt; VIEW PAGE') ?> </strong></a></p>
    <?php endif; ?>
    <?php if (!empty($fields['field_timeline_show_cont_check']->content)): ?>
      <?php if (!empty($fields['field_timeline_element_image']->content) && $fields['field_timeline_show_cont_check']->content == 'Show image'): ?>
        <div class="img">
          <?php print $fields['field_timeline_element_image']->content; ?>
        </div>
        <?php if (!empty($fields['field_timeline_el_author_txt']->content)): ?>
          <p class="rteright">
            <i><?php print $fields['field_timeline_el_author_txt']->content; ?></i>
          </p>
        <?php endif; ?>
      <?php endif; ?>

      <?php if (!empty($fields['field_timeline_element_video_emb']->content) && $fields['field_timeline_show_cont_check']->content == 'Show video'): ?>
        <div class="media-wrapper">
          <?php print $fields['field_timeline_element_video_emb']->content; ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>
    <?php if (!empty($fields['edit_node']->content)): ?>
      <div class="btn-edit">
        <?php  print $fields['edit_node']->content?>
      </div>
    <?php endif; ?>
  </div>
</div>
