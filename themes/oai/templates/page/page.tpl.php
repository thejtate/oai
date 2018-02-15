<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
$theme_path = base_path() . path_to_theme();
$top_image = (isset($top_image) && !empty($top_image)) ? $top_image : '';
$top_logo = (isset($top_logo) && !empty($top_logo)) ? $top_logo : '';
$youtube_id = isset($youtube_id) ? $youtube_id : '';
?>
<div id="page-wrapper" class="outer-wrapper">
  <div id="page">

    <header id="site-header" class="site-header">
      <div class="container">

        <?php if ($logo): ?>
          <div class="logo">
            <a href="<?php print $front_page; ?>"
               title="<?php print t('Home'); ?>" rel="home" id="logo">
              <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"/>
            </a>
          </div>
        <?php endif; ?>

        <div class="control">
          <?php print render($page['top_header']); ?>
          <?php if(isset($top_search_block)): ?>
            <div class="search">
              <a href="#" class="top-search-button"></a>
              <?php print $top_search_block; ?>
            </div>
          <?php endif; ?>
        </div>

        <nav class="nav">
          <a class="btn-mobile" href="#"></a>
          <?php print render($page['header']); ?>
        </nav>

        <?php print render($page['after_header']); ?>

      </div>
    </header>
    <!-- /.section, /#header -->

    <div id="main-wrapper">
      <div id="main" class="clearfix">

        <div id="content" class="content-wrapper">
          <?php if (!empty($page['button_to_top'])):
            print render($page['button_to_top']);
            ?>
          <?php endif; ?>
          <?php if ($top_image): ?>
            <section class="section section-media item item-style-a">
              <div class="img">
                <?php print $top_image; ?>
              </div>
              <?php if ($top_logo): ?>
                <div class="logo">
                  <span class="logo-wrapper"><?php print $top_logo; ?></span>
                </div>
              <?php endif; ?>

              <?php if ($youtube_id): ?>
                <a class="btn-play" data-toggle="modal" data-target="#modal-video"
                   href="<?php print '#media-youtube-' . $youtube_id; ?>"><?php print t('WATCH VIDEO'); ?></a>
              <?php endif; ?>
            </section>
          <?php endif; ?>

          <?php print render($title_prefix); ?>
          <?php if ($title): ?>
            <header class="title">
              <h1 id="page-title"><?php print $title; ?></h1>
            </header>
          <?php endif; ?>
          <?php print render($title_suffix); ?>

          <?php print $messages; ?>

          <?php print render($page['content_top']); ?>

          <a id="main-content"></a>

          <?php if ($tabs): ?>
            <div class="tabs">
              <?php print render($tabs); ?>
            </div>
          <?php endif; ?>

          <?php print render($page['help']); ?>
          <?php if ($action_links): ?>
            <ul class="action-links">
              <?php print render($action_links); ?>
            </ul>
          <?php endif; ?>

          <div class="row <?php print ($page['sidebar_right']) ? 'content-inner' : ''; ?>">

            <?php if ($page['sidebar_left']): ?>
              <div class="<?php print (isset($left_sidebar_class)) ? implode(' ', $left_sidebar_class) : ''; ?>">
                <?php print render($page['sidebar_left']); ?>
              </div>
            <?php endif; ?>

            <div class="<?php print (isset($content_class) && is_array($content_class)) ? implode(' ', $content_class) : ''; ?>">
              <?php print render($page['content']); ?>
              <?php print render($page['content_bottom']); ?>

              <?php if (isset($show_return_to_top) && $show_return_to_top): ?>
                <div class="btn-to-top">
                  <a href="#start-page"><?php print t('Return to top'); ?></a>
                </div>
              <?php endif; ?>
            </div>

            <?php if ($page['sidebar_right']): ?>
              <div class="sidebar <?php print (isset($sidebar_class) && is_array($sidebar_class)) ? implode(' ', $sidebar_class) : ''; ?>">
                <?php print render($page['sidebar_right']); ?>
              </div>
            <?php endif; ?>

            <?php print $feed_icons; ?>
          </div>


        </div>
        <!-- /.section, /#content -->

      </div>
    </div>
    <!-- /#main, /#main-wrapper -->

    <footer id="site-footer" class="site-footer">
      <div class="section">
        <div class="top-footer">
          <div class="container">
            <?php print render($page['top_footer']); ?>
          </div>
        </div>
        <div class="container">
          <div class="middle-footer">
            <?php print render($page['middle_footer']); ?>
          </div>
          <div class="bottom-footer">
            <?php print render($page['footer']); ?>
          </div>
        </div>

      </div>
    </footer>
    <!-- /.section, /#footer -->

  </div>
</div> <!-- /#page, /#page-wrapper -->
