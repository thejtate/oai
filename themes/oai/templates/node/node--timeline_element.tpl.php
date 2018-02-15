<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<div class="section section-content">
  <div id="node-<?php print $node->nid; ?>"
       class="<?php print $classes; ?> "<?php print $attributes; ?>>

    <div class="content"<?php print $content_attributes; ?>>
      <div class="content-inner row">
        <div class="text col-md-12">
          <?php print render($content['body']); ?>
        </div>
      </div>
      <div class="content-inner row">

        <?php if (!empty($content['field_timeline_el_faculty_fc'])): ?>
          <div
            class="text col-md-6 color-<?php print (!empty($content['field_block_color_faculty']['#items'][0]['value']) ? $content['field_block_color_faculty']['#items'][0]['value'] : 'h'); ?>">
            <div class="long-text item">
              <h3><?php print t('Faculty'); ?></h3>
              <?php print render($content['field_timeline_el_faculty_fc']); ?>
            </div>
          </div>
        <?php endif; ?>

        <div class="col-md-6 color-l">
          <?php if (!empty($content['field_timeline_el_publ_downl_fc'])): ?>
            <div
              class="text long-text item color-<?php print render($content['field_block_color_publications']['#items'][0]['value']); ?>">
              <h3><?php print t('Download Publications'); ?></h3>
              <?php print render($content['field_timeline_el_publ_downl_fc']); ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($content['field_timeline_el_publ_media_fc'])): ?>
            <div
              class="text long-text item color-<?php print render($content['field_block_color_media']['#items'][0]['value']); ?>">
              <h3><?php print t('MEDIA'); ?></h3>
              <?php print render($content['field_timeline_el_publ_media_fc']); ?>
            </div>
          <?php endif; ?>

          <?php if (!empty($content['field_timeline_el_publ_photo_fc'])): ?>
            <div class="text long-text item">
              <h3><?php print t('Photos'); ?></h3>
              <div class="b-slider flexslider">
                <?php print render($content['field_timeline_el_publ_photo_fc']); ?>
              </div>
            </div>
          <?php endif; ?>
        </div>

      </div>

      <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_timeline_el_color_list']);
      hide($content['field_timeline_element_term']);
      hide($content['field_timeline_element_date']);
      hide($content['field_timeline_el_show_link_chck']);
      hide($content['field_block_color_media']);
      hide($content['field_block_color_publications']);
      hide($content['field_block_color_faculty']);
      hide($content['field_timeline_element_image']);
      hide($content['field_timeline_el_author_txt']);
      hide($content['field_timeline_element_video_emb']);
      hide($content['field_timeline_show_cont_check']);
      print render($content);
      ?>
    </div>

    <?php print render($content['links']); ?>

    <?php print render($content['comments']); ?>

  </div>
</div>
