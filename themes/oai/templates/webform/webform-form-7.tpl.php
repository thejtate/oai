<?php

/**
 * @file
 * Customize the display of a complete webform.
 *
 * This file may be renamed "webform-form-[nid].tpl.php" to target a specific
 * webform on your site. Or you can leave it "webform-form.tpl.php" to affect
 * all webforms on your site.
 *
 * Available variables:
 * - $form: The complete form array.
 * - $nid: The node ID of the Webform.
 *
 * The $form array contains two main pieces:
 * - $form['submitted']: The main content of the user-created form.
 * - $form['details']: Internal information stored by Webform.
 *
 * If a preview is enabled, these keys will be available on the preview page:
 * - $form['preview_message']: The preview message renderable.
 * - $form['preview']: A renderable representing the entire submission preview.
 */
//subscribe webform
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
  <?php print render($form['submitted']['node_body']);?>
</div>
<div class="modal-body">
  <div class="form form-join">
    <div class="row">
        <?php print render($form['submitted']['email']);?>
    </div>
    <div class="row">
        <?php print render($form['submitted']['first_name']);?>
        <?php print render($form['submitted']['last_name']);?>

    </div>
    <div class="row">
        <?php print render($form['submitted']['city']);?>
        <?php print render($form['submitted']['state']);?>
    </div>
    <div class="row">
        <?php print render($form['submitted']['organization']);?>
    </div>
    <br>
    <div class="form-part">
      <?php print render($form['submitted']['please_check_your_areas_of_interest']);?>
      <?php print render($form['submitted']['are_you_an_alumnus_or_parent']);?>
    </div>
    <div class="form-actions content-right">
      <?php print render($form['actions']);?>
    </div>
  </div>

<?php
  // Print out the progress bar at the top of the page
  print drupal_render($form['progressbar']);

  // Print out the preview message if on the preview page.
  if (isset($form['preview_message'])) {
    print '<div class="messages warning">';
    print drupal_render($form['preview_message']);
    print '</div>';
  }

  // Print out the main part of the form.
  // Feel free to break this up and move the pieces within the array.
  print drupal_render($form['submitted']);

  // Always print out the entire $form. This renders the remaining pieces of the
  // form that haven't yet been rendered above (buttons, hidden elements, etc).
  print drupal_render_children($form);
?>
</div>
