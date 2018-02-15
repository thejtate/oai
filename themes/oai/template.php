<?php

/**
 * @file
 * template.php
 *
 * Contains theme override functions and preprocess functions for the theme.
 */

define('OAI_MAIN_MENU_DELTA', 1);
define('OAI_FOOTER_MAIN_MENU_DELTA', 2);
define('OAI_2016_FACULTY_NID', 20);
define('OAI_WEBFORM_CONTACT_NID', 6);
define('OAI_WEBFORM_SUBSCRIBE_NID', 7);
define('OAI_DONATE_NID', 21);
define('OAI_K12_EDUCATORS_NID', 14);
define('OAI_NEWS_LANDING_PATH', 'community-news');
define('OAI_STAFF_OPENINGS_NID', 80);
define('OAI_PERFORMANCE_DOWNLOADS_NID', 118);
define('OAI_PARTICIPANT_INFO_STUDENTS_NID', 134);

/**
 * Implements hook_preprocess_html().
 */
function oai_preprocess_html(&$vars) {

  $viewport = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'width=device-width, initial-scale=1, maximum-scale=1',
    ),
  );

  drupal_add_html_head($viewport, 'viewport');

  if ($node = menu_get_object()) {
    switch ($node->type) {
      case 'home':
        $vars['classes_array'][] = 'front';
        break;
    }
  }
}

/**
 * Implements hook_preprocess().
 */
function oai_preprocess(&$vars, $hook) {
//  dsm($hook);
  if($hook == 'block') {
    //dsm($vars);
//    dsm($vars['theme_hook_suggestions']);
  }
}

/**
 * Implements hook_preprocess_entity().
 */
function oai_preprocess_entity(&$vars) {
  if($vars['entity_type'] == 'bean') {
    $bean = $vars['bean'];

    switch($bean->type) {
      case 'enrollment':
        $vars['style_class'] = oai_get_block_scheme_from_color($bean->field_color_scheme[LANGUAGE_NONE][0]['rgb']);

        if (isset($vars['content']['field_popup_image'])
          && !empty($vars['content']['field_popup_image']['#items'])) {
          $popup_image = $vars['content']['field_popup_image']['#items'][0];
          $vars['popup_button_text'] = !empty($popup_image['field_file_image_title_text']) ?
            $popup_image['field_file_image_title_text'][LANGUAGE_NONE][0]['value'] : '';
        }

        if ($bean->delta == '2017-faculty-notice') {
          $description = isset($vars['content']['field_enrollment_description']) &&
            !empty($vars['content']['field_enrollment_description']['#items']) ?
            $vars['content']['field_enrollment_description']['#items'][0]['value'] : '';
          if ($description) {
            $description = explode('|', $description);
            foreach ($description as $key => $title) {
              $title_id = _oai_get_faq_id($title, $prefix = 'faculty-');
              $description[$key] = l($title, '', array(
                'fragment' => $title_id,
                'external' => TRUE,));
            }
            $vars['description'] = implode('|', $description);
          }
        }
        break;
      case 'donate':
        if (isset($vars['content']['field_sl_color'])) {
          $color = $vars['content']['field_sl_color']['#items'][0]['rgb'];
          $vars['color_class'] = oai_get_color_class($color);
        }
        break;
    }
  }
  if($vars['entity_type'] == 'field_collection_item') {
    $field_collection = isset($vars['field_collection_item']) ? $vars['field_collection_item'] : '';
    if (is_object($field_collection)) {
      $node = $field_collection->hostEntity();

      if (isset($node->type)) {
        switch ($node->type) {
          case 'people':
          case 'foundation':
          case 'donors_list':
            $vars['color_class'] = _oai_get_color_class_from_color_field($node, 'field_sl_color');
            break;
          case 'members':
            $color = isset($vars['field_sl_color'][0]['rgb']) ? $vars['field_sl_color'][0]['rgb'] : '';
            $vars['color_class'] = oai_get_color_class($color);
            break;
        }
      }

    }
  }
  if($vars['entity_type'] == 'paragraphs_item') {
    $bundle = isset($vars['elements']['#bundle']) ? $vars['elements']['#bundle'] : '';
    switch ($bundle) {
      case 'block_with_video':
        $youtube_uri = (isset($vars['content']['field_youtube_video']) &&
          !empty($vars['content']['field_youtube_video']['#items'])) ?
          $vars['content']['field_youtube_video']['#items'][0]['uri'] : '';
        if ($youtube_uri) {
          $youtube_url = file_create_url($youtube_uri);
          $parsed = drupal_parse_url($youtube_url);
          $youtube_id = (isset($parsed['query']) && isset($parsed['query']['v'])) ?
            strtolower($parsed['query']['v']) : '';
          $vars['youtube_id'] = str_replace('_', '-', $youtube_id);
        }
        break;
    }
  }
}

/**
 * Implements hook_preprocess_page().
 */
function oai_preprocess_page(&$vars) {

  $top_search_block = module_invoke('search','block_view','search');
  $rendered_block = render($top_search_block);
  $vars['top_search_block'] = $rendered_block;

  if (isset($vars['page']['sidebar_right']) && $vars['page']['sidebar_right']) {
    $vars['content_class'][] = 'col-lg-9 col-md-8';
    $vars['sidebar_class'][] = 'col-lg-3 col-md-4';
    $vars['left_sidebar_class'][] = 'info col-md-3';
  }

  if (isset($vars['node'])) {
    $node = $vars['node'];

    switch ($node->type) {
//      case 'participant_inf':
//        $vars['content_class'][] = 'col-md-9';
//        break;
      case 'webform':
        if($node->nid == OAI_WEBFORM_CONTACT_NID) {
          $vars['content_class'] = array('form', 'form-contact', 'col-lg-6', 'col-md-5');
        }
        break;
      case 'home':
        $vars['title'] = '';
        $vars['theme_hook_suggestions'][] = 'page__front';
        break;
      case 'timeline':
        $vars['theme_hook_suggestions'][] = 'page__timeline';
        break;
      case 'about':
        if ($node->nid != OAI_2016_FACULTY_NID) {
          $vars['content_class'][] = 'text';
        }
        break;
      case 'tour_de_quartz':
        $vars['content_class'] = array();
        break;
      case 'page_with_two_columns':
        $vars['content_class'][] = 'text';
        break;
      case 'past_faculty_artists':
        $vars['page']['button_to_top'] = '<div class="btn-to-top style-a"><a href="#block-views-featured-past-artists-block-1"></a></div>';
        break;
    }

    $top_fields = array(
      'field_top_image',
      'field_logo',
      'field_youtube_video',
      'field_common_top_title',
    );
    $top_fields_value = _oai_get_rows_from_node($node, $top_fields);
    if (isset($top_fields_value) && !empty($top_fields_value)) {
      $top_image = isset($top_fields_value['field_top_image']) ? $top_fields_value['field_top_image'] : '';
      $logo = isset($top_fields_value['field_logo']) ? $top_fields_value['field_logo'] : '';
      $youtube_video = isset($top_fields_value['field_youtube_video']) ? $top_fields_value['field_youtube_video'] : '';
      $top_title = isset($top_fields_value['field_common_top_title']) ? $top_fields_value['field_common_top_title'] : '';

      if ($top_image) {
        $image = array(
          'style_name' => 'top_image',
          'path' => $top_image['uri'],
          'alt' => $top_image['alt'],
          'title' => $top_image['title'],
          'attributes' => array('class' => array()),
        );
        $vars['top_image'] = theme('image_style', $image);
      }
      if ($logo) {
        $image = array(
          'path' => $logo['uri'],
          'alt' => $logo['alt'],
          'title' => $logo['title'],
          'attributes' => array('class' => array()),
        );
        $vars['top_logo'] = theme('image', $image);
      }
      if ($youtube_video) {
        $youtube_url = isset($youtube_video['uri']) ? file_create_url($youtube_video['uri']) : '';
        $parsed = drupal_parse_url($youtube_url);
        $vars['youtube_id'] = (isset($parsed['query']) && isset($parsed['query']['v'])) ?
          strtolower($parsed['query']['v']) : '';
      }
      if ($top_title) {
        $vars['title'] = $top_title;
      }
    }

    switch ($node->nid) {
      case OAI_STAFF_OPENINGS_NID:
        if (empty($vars['page']['sidebar_right'])) {
          $vars['content_class'][] = 'text col-lg-9 col-md-8';
          $vars['sidebar_class'][] = 'col-lg-3 col-md-4';

          $vars['page']['sidebar_right'] = array(
            'empty_block' => array(
              '#type' => 'container',
            )
          );
        }
        break;
      case OAI_PERFORMANCE_DOWNLOADS_NID:
        if (empty($vars['page']['sidebar_right'])) {
          $vars['content_class'][] = 'text col-lg-12 col-md-12';

          $vars['page']['sidebar_right'] = array(
            'empty_block' => array(
              '#type' => 'container',
            )
          );
        }
        break;
    }

    $return_to_top_content_types = array(
      'enrollment_and_workshop_rates',
      'foundation',
      'schedule',
    );

    if (in_array($node->type, $return_to_top_content_types)) {
      $vars['show_return_to_top'] = TRUE;
    }
  }

  $page_blocks = block_list('content_top');
  foreach($page_blocks as $key => $page_block){
    if ("bean_top-image" == substr($key, 0, 14)) {
      $vars['title'] = '';
    }
  }

  $user_login_form = !empty($vars['page']['content']['user_login']) ? TRUE : FALSE;

  if ($user_login_form && (arg(0) == 'node') && is_numeric(arg(1))) {
    $node_id = arg(1);
    $title = '';

    $type = db_select('node', 'n')
      ->fields('n', array('type'))
      ->condition('n.nid', $node_id)
      ->execute()
      ->fetchField();

    if ($type == 'hidden') {
      if (!empty($vars['page']['content']['system_main']['main']) &&
        !empty($vars['page']['content']['system_main']['main']['#markup'])) {
        $vars['page']['content']['system_main']['main']['#access'] = FALSE;
      }

      switch ($node_id) {
        case OAI_BOARD_NID:
          $title = t('Board portal');
          break;
        case OAI_FOUNDATION_BOARD_NID:
          $title = t('Foundation board portal');
          break;
      }
      $vars['title'] = $title . ' - ' . t('please type in !br your username and password', array('!br' => '<br>'));
    }
  }
}

/**
 * Implements hook_preprocess_node().
 */
function oai_preprocess_node(&$vars) {
  $node = $vars['node'];
  if (!$vars['page']) {
    $vars['theme_hook_suggestions'][] = 'node__' . $vars['type'] . '__' . $vars['view_mode'];
  }

  if (isset($vars['content']['field_top_image'])) {
    $vars['content']['field_top_image']['#access'] = FALSE;
  }
  if (isset($vars['content']['field_logo'])) {
    $vars['content']['field_logo']['#access'] = FALSE;
  }
  if (isset($vars['content']['field_sl_color'])) {
    $vars['content']['field_sl_color']['#access'] = FALSE;
  }
  if (isset($vars['content']['field_video'])) {
    $vars['content']['field_video']['#access'] = FALSE;
  }
  if (isset($vars['content']['field_youtube_video']) &&
    isset($vars['content']['field_youtube_video']['#items'][0]['uri'])) {
    $youtube_url = file_create_url($vars['content']['field_youtube_video']['#items'][0]['uri']);
    $parsed = drupal_parse_url($youtube_url);
    $vars['youtube_id'] = (isset($parsed['query']) && isset($parsed['query']['v'])) ?
      strtolower($parsed['query']['v']) : '';
  }

  switch ($node->type) {
    case 'artist':
      if (!empty($node->field_photo_artist_img)) {
        $vars['artist_image'] = file_create_url($node->field_photo_artist_img[LANGUAGE_NONE][0]['uri']);
      }
      break;

    case 'past_faculty_artists':
      $vars['content']['featured_artists'] = array('#markup' => oai_get_rendered_block('views', 'featured_past_artists-block'));
      $vars['content']['filters'] = array('#markup' => oai_get_rendered_block('views', 'featured_past_artists-block_1'));
      break;
    case 'home':
      $vars['news_block'] = views_embed_view('news', 'block_1');
      break;
    case 'news':
      if ($vars['view_mode'] == 'teaser') {
        if (isset($vars['content']['field_news_type']) && !empty($vars['content']['field_news_type']['#items'])) {
          $term = isset($vars['content']['field_news_type']['#items'][0]['taxonomy_term']) ?
            $vars['content']['field_news_type']['#items'][0]['taxonomy_term'] : '';
          if ($term && is_object($term)) {
            $color = isset($term->field_sl_color) ? $term->field_sl_color['und'][0]['rgb'] : '';
            $vars['classes_array'][] = oai_get_color_class($color);
          }
        }
      }
      $vars['back_button'] = l('<strong>< ' . t('View All') . '</strong>', OAI_NEWS_LANDING_PATH,
        array('attributes' => array('class' => array('btn-back')), 'html' => TRUE));
      break;
    case 'page_blocks':
      if (isset($vars['content']['field_pb_left_articles']) &&
        empty($vars['content']['field_pb_left_articles']['#items'])) {
        $vars['content']['field_pb_left_articles']['#access'] = FALSE;
      }
      if (isset($vars['content']['field_pb_left_menu']) &&
        empty($vars['content']['field_pb_left_menu']['#items'])) {
        $vars['content']['field_pb_left_menu']['#access'] = FALSE;
      }
      if (isset($vars['content']['field_pb_right_links']) &&
        empty($vars['content']['field_pb_right_links']['#items'])) {
        $vars['content']['field_pb_right_links']['#access'] = FALSE;
      }
      break;
    case 'page_sections_icons':
      if (isset($vars['content']['field_color_scheme']) && !empty($vars['content']['field_color_scheme']['#items'])) {
        $bottom_link_color = isset($vars['content']['field_color_scheme']['#items'][0]['rgb']) ?
          $vars['content']['field_color_scheme']['#items'][0]['rgb'] : '';
        $vars['bottom_link_color_class'] = oai_get_color_class($bottom_link_color);
      }
      break;
    case 'people':
      if (isset($vars['content']['field_sl_color']) && !empty($vars['content']['field_sl_color']['#items'][0]['rgb'])) {
        $vars['color_class'] = oai_get_color_class($vars['content']['field_sl_color']['#items'][0]['rgb']);
      }
      break;
    case 'donors_list':
      if (isset($vars['content']['field_dl_list'])) {
        $title_list = _oai_rows_from_field_collection($vars['content']['field_dl_list'], array('field_dl_list_title'));
        $items = array();
        $list_class_map = array(
          '#d3ae5b' => 'style-b',
          '#799c9b' => 'style-c',
        );

        $list_class = '';
        if (isset($vars['content']['field_sl_color']) &&
          !empty($vars['content']['field_sl_color']['#items'])) {
          $color = $vars['content']['field_sl_color']['#items'][0]['rgb'];
          $list_class = array_key_exists($color, $list_class_map) ?
            $list_class_map[$color] : '';
        }

        foreach($title_list as $key => $title) {
          if (isset($title['field_dl_list_title']) && $title['field_dl_list_title']) {
            $name_id = _oai_get_faq_id($title['field_dl_list_title']);

            $pos = strpos($title['field_dl_list_title'], '(');
            $sub_main = $title['field_dl_list_title'];
            $sub_add = '';
            if ($pos !== false) {
              $sub_main = substr($title['field_dl_list_title'], 0, $pos);
              $sub_add = substr($title['field_dl_list_title'], $pos, strlen($title['field_dl_list_title']));
            }

            $items[] = '<a href="#' . $name_id . '">' . $sub_main . '</a>' . $sub_add;
          }
        }
        if (!empty($items)) {
          $items_list = array(
            'items' => $items,
            'type' => 'ul',
            'attributes' => array('class' => array($list_class)),
          );
          $vars['donors_list'] = theme('item_list', $items_list);
        }
      }
      break;
    case 'page_with_two_columns':
      if (isset($vars['content']['field_sl_color']) && !empty($vars['content']['field_sl_color']['#items'][0]['rgb'])) {
        $vars['left_col_color_class'] = oai_get_color_class($vars['content']['field_sl_color']['#items'][0]['rgb']);
      }
      if (isset($vars['content']['field_color_scheme']) && !empty($vars['content']['field_color_scheme']['#items'][0]['rgb'])) {
        $vars['right_col_color_class'] = oai_get_color_class($vars['content']['field_color_scheme']['#items'][0]['rgb']);
      }
      break;
    case 'event':
      if ($vars['view_mode'] == 'teaser') {
        if (isset($vars['content']['field_event_type']) && !empty($vars['content']['field_event_type']['#items'])) {
          $term = isset($vars['content']['field_event_type']['#items'][0]['taxonomy_term']) ?
            $vars['content']['field_event_type']['#items'][0]['taxonomy_term'] : '';
          if ($term && is_object($term)) {
            $color = isset($term->field_sl_color) ? $term->field_sl_color['und'][0]['rgb'] : '';
            $vars['color_class'] = oai_get_color_class($color);
          }
        }

        if (isset($vars['content']['field_event_link']) && !empty($vars['content']['field_event_link']['#items'])) {
          $link_title = isset($vars['content']['field_event_link']['#items'][0]['title']) ?
            $vars['content']['field_event_link']['#items'][0]['title'] : '';
          $link_url = isset($vars['content']['field_event_link']['#items'][0]['url']) ?
            $vars['content']['field_event_link']['#items'][0]['url'] : '';
          if ($link_title && $link_url) {
            $link_class = isset($vars['color_class']) ? 'font-' . $vars['color_class'] : '';
            $vars['event_link'] = l($link_title, $link_url, array('attributes' => array('class' => array($link_class))));
          }
        }
      }
      break;
  }
}

/**
 * Implements hook_preprocess_field().
 */
function oai_preprocess_field(&$vars) {
  $element = $vars['element'];
  switch ($element['#field_name']) {
    case 'field_participant_blocks':
      $vars['items_classes'] = array();
      $overlay_image_classes = array(
        0 => 'overlay-style-b',
        1 => 'overlay-style-b',
        2 => 'overlay-style-b',
        3 => 'overlay-style-a',
        4 => 'overlay-style-b',
        5 => 'overlay-style-b',
        6 => 'overlay-style-b',
        7 => 'overlay-style-f',
        8 => 'overlay-style-b',
      );

      $node = isset($element['#object']) ? $element['#object'] : '';
      if (!empty($node) && is_object($node)) {
        $nid = isset($node->nid) ? $node->nid : '';
        switch ($nid) {
          case OAI_PARTICIPANT_INFO_STUDENTS_NID:
            $vars['theme_hook_suggestions'][] = 'field__field_participant_blocks__students';
            $overlay_image_classes[3] = 'overlay-style-b';
            $overlay_image_classes[5] = 'overlay-style-a';
            break;
        }
      }

      foreach ($vars['items'] as $delta => $item) {
        $fc = reset($vars['items'][$delta]['entity']['field_collection_item']);
        if($fc['field_participant_block_bg']['#items'][0]['value'] == 'image' && !empty($fc['field_participant_block_bg_img']['#items'][0]['uri']
          )) {
          $vars['items_classes'][$delta] = !empty($overlay_image_classes[$delta]) ?  $overlay_image_classes[$delta] : '';
        } else if(!empty($fc['field_sl_color']['#items'][0]['rgb'])) {
          $vars['items_classes'][$delta] = oai_get_color_class($fc['field_sl_color']['#items'][0]['rgb']);
        }
      }
      //dsm($vars);
      break;
    case 'field_home_article':
      $vars['item_class'] = array(
        'col-sm-6 item-style-b overlay-style-e',
        'col-sm-6 item-style-b overlay-style-b hover-style-a',
        'col-sm-4 item-style-c color-a',
        'col-sm-8 item-style-d overlay-style-c',
        'col-sm-8 item-style-e overlay-style-b hover-style-b',
      );
      $social_block = module_invoke('oai_custom', 'block_view', 'oai_custom_social_block');
      $vars['social_block'] = isset($social_block['content']) ? $social_block['content'] : '';
      break;
    case 'field_sl_links_link':
      $field_collection = isset($element['#object']) ? $element['#object'] : '';
      $title = isset($vars['items'][0]) ? $vars['items'][0]['#element']['title'] : '';

      if ($field_collection && is_object($field_collection)) {
        $icon_classes = (isset($field_collection->field_sl_links_icon) &&
          !empty($field_collection->field_sl_links_icon)) ?
          $field_collection->field_sl_links_icon[LANGUAGE_NONE][0]['value'] : '';
        $vars['items'][0]['#element']['title'] = $title . '<span class="ico ' . $icon_classes .'"></span>';

        $alies = (isset($field_collection->field_sl_links_alies) &&
          !empty($field_collection->field_sl_links_alies)) ?
          $field_collection->field_sl_links_alies[LANGUAGE_NONE] : array();
        foreach ($alies as $link) {
          $path = parse_url($link['url']);
          $path = isset($path['path']) ? ltrim($path['path'], '/') : '';
          $url = drupal_get_normal_path($path);
          if ($url == $_GET['q']) {
            $vars['items'][0]['#element']['attributes']['class'][] = 'active';
          }
        }
      }
      break;
    case 'field_sl_links':
      $bean_block = isset($element['#object']) ? $element['#object'] : '';
      if ($bean_block && is_object($bean_block)) {
        $color_field = $bean_block->field_sl_color;
        $color = isset($color_field[LANGUAGE_NONE][0]['rgb']) ?
          $color_field[LANGUAGE_NONE][0]['rgb'] : '';

        $vars['color_class'] = oai_get_color_class($color);
      }
      break;
    case 'field_ewr_items_title':
    case 'field_schedule_items_title':
    case 'field_psi_items_title':
    case 'field_page_images_section_title':
    case 'field_faq_faq_title':
      $vars['classes_array'][] = 'item-hd';
      $field_collection = isset($element['#object']) ? $element['#object'] : '';
      if (is_object($field_collection)) {
        $node = $field_collection->hostEntity();
        $vars['classes_array'][] = _oai_get_color_class_from_color_field($node, 'field_sl_color');

        if (isset($field_collection->field_sl_links_icon) && !empty($field_collection->field_sl_links_icon)) {
          $classes = $field_collection->field_sl_links_icon[LANGUAGE_NONE][0]['value'];
          $vars['icon'] = '<span class="ico ' . $classes .'"></span>';
        }

        if (($element['#field_name'] == 'field_faq_faq_title') && !empty($vars['items'])) {
          $title = isset($vars['items'][0]['#markup']) ? $vars['items'][0]['#markup'] : '';
          $vars['title_id'] = _oai_get_faq_id($title);
        }
        if (($element['#field_name'] == 'field_schedule_items_title') && !empty($vars['items'])) {
          $title = isset($vars['items'][0]['#markup']) ? $vars['items'][0]['#markup'] : '';
          $vars['title_id'] = _oai_get_faq_id($title, 'schedule-');
        }
      }
      break;
    case 'field_pb_left_items':
      $colors = _oai_rows_from_field_collection($vars, array('field_sl_color'));
      if ($colors) {
        $vars['color'] = array();
        foreach($colors as $key => $color) {
          $color = isset($color['field_sl_color']['rgb']) ? $color['field_sl_color']['rgb'] : '';
          $vars['color'][$key] = oai_get_color_class($color);
        }
      }
      break;
    case 'field_pb_left_menu':
      $node = isset($element['#object']) ? $element['#object'] : '';

      $vars['color'] = _oai_get_color_class_from_color_field($node, 'field_sl_color');

      $field_collection_fields = _oai_rows_from_field_collection($vars, array('field_pb_left_items_list_icon'));
      if ($field_collection_fields) {
        $vars['item_classes'] = array();
        foreach ($field_collection_fields as $key => $field) {
          if (!empty($field['field_pb_left_items_list_icon'])) {
            $vars['item_classes'][$key] = 'item-with-icon';
          }
        }
      }
      break;
    case 'field_pb_right_items':
    case 'field_pb_left_articles':
      $field_collection_fields = _oai_rows_from_field_collection($vars, array('field_pb_right_items_hover_type', 'field_pb_right_items_hover_color', 'field_overlay_color'));
      if ($field_collection_fields) {
        $vars['article_classes'] = array();
        $vars['hover_color'] = array();
        foreach ($field_collection_fields as $key => $field) {
          $hover_type = isset($field['field_pb_right_items_hover_type']) ?
            $field['field_pb_right_items_hover_type'] : '';
          if ($hover_type == 'text') {
            $vars['article_classes'][$key] = 'overlay-style-b';

            $hover_classes = _oai_get_hover_color_class_map();
            $hover_color = isset($field_collection_fields[$key]['field_pb_right_items_hover_color']['rgb']) ?
              $field_collection_fields[$key]['field_pb_right_items_hover_color']['rgb'] : '';
            $vars['hover_color'][$key] = array_key_exists($hover_color, $hover_classes) ?
              $hover_classes[$hover_color] : '';
          }
          else {
            $vars['article_classes'][$key] = isset($field['field_overlay_color']['rgb']) ?
              _oai_get_overlay_color_class($field['field_overlay_color']['rgb']) : '';
          }
        }
      }
      break;
    case 'field_pb_right_links':
      $field_collection_fields = _oai_rows_from_field_collection($vars, array('field_sl_color'));
      if ($field_collection_fields) {
        $vars['link_classes'] = array();
        foreach ($field_collection_fields as $key => $field) {
          $color = isset($field_collection_fields[$key]['field_sl_color']['rgb']) ?
            $field_collection_fields[$key]['field_sl_color']['rgb'] : '';
          $vars['link_classes'][$key] = oai_get_color_class($color);
        }
      }
      break;
    case 'field_faq_faq':
      $title_list = _oai_rows_from_field_collection($vars, array('field_faq_faq_title'));
      $questions = array();

      foreach($title_list as $key => $title) {
        if (isset($title['field_faq_faq_title']) && $title['field_faq_faq_title']) {
          $name_id = _oai_get_faq_id($title['field_faq_faq_title']);
          $questions[] = '<a href="#' . $name_id . '">' . $title['field_faq_faq_title'] . '</a>';
        }
      }
      if (!empty($questions)) {
        $question_list = array(
          'items' => $questions,
          'type' => 'ul',
          'attributes' => array('class' => array('style-a')),
        );
        $vars['question_list'] = theme('item_list', $question_list);
      }
      break;
    case 'field_psi_bottom_link':
      if (isset($vars['items']) && !empty($vars['items']) && isset($vars['items'][0]['#element']['title'])) {
        $vars['items'][0]['#element']['title'] = '<span>' . $vars['items'][0]['#element']['title'] . '</span>';
      }
      break;
    case 'field_people_link':
      foreach ($vars['items'] as $key => $item) {
        if (isset($item['#element']['title'])) {
          $vars['items'][$key]['#element']['title'] = preg_replace("/^http:\/\//i", "", $item['#element']['title']);
        }
      }
      break;
    case 'field_pbl_file':
      if (!empty($vars['items'])) {
        $file_desc = isset($vars['items'][0]['#file']->description) ?
          $vars['items'][0]['#file']->description : '';
        if ($file_desc) {
          $vars['items'][0]['#text'] = $file_desc;
        }
      }
      break;
    case 'field_found_items_block':
      $field_collection_fields = _oai_rows_from_field_collection($vars, array('field_sl_color'));
      if ($field_collection_fields) {
        $color = isset($field_collection_fields[0]['field_sl_color']['rgb']) ?
          $field_collection_fields[0]['field_sl_color']['rgb'] : '';

        $vars['color_class'] = oai_get_color_class($color);
      }
      break;
    case 'field_top_menu_items':
      $field_collection_fields = _oai_rows_from_field_collection($vars, array('field_sl_color'));
      if ($field_collection_fields) {
        foreach ($field_collection_fields as $key => $color) {
          $color = isset($color['field_sl_color']['rgb']) ?
            $color['field_sl_color']['rgb'] : '';
          $vars['color_class'][] = oai_get_color_class($color);
        }
      }
      break;
    case 'field_dl_list_title':
      if (isset($element['#items']) && !empty($element['#items'])) {
        $vars['id'] = _oai_get_faq_id($element['#items'][0]['safe_value']);
      }
      break;
    case 'field_tmh_items_link':
      if (!empty($vars['items'])) {
        $vars['items'][0]['#element']['title'] = '<span class="link-text">' .
          $vars['items'][0]['#element']['title'] . '</span>';
      }
      break;
    case 'field_pb_left_menu_link':
      if (!empty($vars['items'])) {
        $vars['items'][0]['#element']['title'] = '<span class="link-text">' .
          $vars['items'][0]['#element']['title'] . '</span>';
      }
      $parent = isset($element['#object']) ? $element['#object'] : '';
      if (isset($parent->field_pb_left_menu_image) && empty($parent->field_pb_left_menu_image)) {
        $vars['items'][0]['#element']['attributes']['class'] = 'link-type-a';
        $vars['items'][0]['#element']['title'] = '';
      }
      break;
    case 'field_pb_left_menu_title':
      foreach ($vars['items'] as &$item) {
        $item['#markup'] = html_entity_decode($item['#markup']);
      }
      break;
  }
}


/**
 * Implements hook_preprocess_block().
 */
function oai_preprocess_block(&$vars) {

  switch ($vars['block']->delta) {
    case 'menu-footer-top-menu':
      $vars['classes_array'][] = 'control';
      break;
    case 'oai_custom_social_block':
      $vars['classes_array'][] = 'social-links';
      break;
    case 'form':
      if ($vars['block']->module == 'search') {
        $vars['classes_array'][] = 'form';
        $vars['classes_array'][] = 'form-search-footer';
      }
      break;
    case OAI_FOOTER_MAIN_MENU_DELTA:
      if ($vars['block']->module == 'menu_block') {
        $vars['classes_array'][] = 'navigation';
      }
      break;
    case 'footer-address--copyright':
        $vars['classes_array'][] = 'info';
      break;
  }

  if ($vars['block']->module == 'bean') {
    $beans = $vars['elements']['bean'];
    $bean_keys = element_children($beans);
    $bean = $beans[reset($bean_keys)];
    $vars['theme_hook_suggestions'][] = 'block__bean__' . $bean['#bundle'];

    switch ($bean['#bundle']) {
      case 'sponsors':
        $vars['classes_array'][] = 'sidebar-block color-j';
        break;
    }
  }
}

/**
 * Implements hook_form_alter().
 */
function oai_form_alter(&$form, &$form_state, $form_id) {

  switch ($form_id) {
    case 'search_block_form':
      $form['search_block_form']['#attributes']['placeholder'] = t('SEARCH');
      break;
    case 'webform_client_form_' . OAI_WEBFORM_CONTACT_NID:
      $form['submitted']['node_body'] = array(
        '#markup' => !empty($form['#node']->body[LANGUAGE_NONE][0]['safe_value']) ? $form['#node']->body[LANGUAGE_NONE][0]['safe_value'] : '',
        '#weight' => -1,
      );
      oai_wrap_item($form['actions'], 'form-actions content-right');
      break;
    case 'webform_client_form_' . OAI_WEBFORM_SUBSCRIBE_NID:
      $form['submitted']['node_body'] = array(
        '#markup' => !empty($form['#node']->body[LANGUAGE_NONE][0]['safe_value']) ? $form['#node']->body[LANGUAGE_NONE][0]['safe_value'] : '',
        '#weight' => -1,
      );
      break;
    case 'user_login_block':
      $form['#attributes']['class'][] = 'form';
      $form['#attributes']['class'][] = 'form-login';
      $form['#attributes']['class'][] = 'col-lg-4';
      $form['#attributes']['class'][] = 'col-sm-5';
      $items = array();
      if (variable_get('user_register', USER_REGISTER_VISITORS_ADMINISTRATIVE_APPROVAL)) {
        $items[] = l(t('Create new account'), 'user/register', array('attributes' => array('title' => t('Create a new user account.'))));
      }
      $form['links'] = array('#markup' => theme('item_list', array('items' => $items)));
      break;
  }
}

/**
 * Implements template_preprocess_search_result().
 */
function oai_preprocess_search_result(&$vars) {
  if (isset($vars['info'])) {
    $vars['info'] = '';
  }
}

/**
 * Get color classes map.
 */
function _oai_get_color_class_map() {
  $color_classes = array(
   '#8f6fb1' => 'color-a',
   '#968a77' => 'color-b',
   '#d3ae5b' => 'color-c',
   '#b1dde5' => 'color-d',
   '#799c9b' => 'color-e',
   '#d9d9d9' => 'color-f',
   '#146fa0' => 'color-g',
   '#a4b86d' => 'color-h',
   '#772231' => 'color-i',
   '#6c6c62' => 'color-l',
   '#f2e66f' => 'color-m',
 );

  return $color_classes;
}

/**
 * @param string $color in format '#ffffff'
 *
 * @return string color class if exist
 */
function oai_get_color_class($color) {
  $classes_map = _oai_get_color_class_map();
  $color = strtolower($color);

  return (isset($classes_map[$color]) && !empty($classes_map[$color])) ? $classes_map[$color] : '';
}

/**
 * Get hover color classes map.
 */
function _oai_get_hover_color_class_map() {
 $color_classes = array(
   '#146fa0' => 'hover-style-a',
   '#d3ae5b' => 'hover-style-b',
   '#772231' => 'hover-style-c',
   '#a4b86d' => 'hover-style-d',
   '#799c9b' => 'hover-style-e',
   '#a58cc1' => 'hover-style-h',
 );

  return $color_classes;
}

/**
 * Get overlay color classes map.
 */
function _oai_get_overlay_color_class_map() {
 $color_classes = array(
   '#146fa0' => 'overlay-style-a',
   '#799c9b' => 'overlay-style-c',
   '#a4b86d' => 'overlay-style-e',
 );

  return $color_classes;
}

/**
 * Get overlay color class.
 */
function _oai_get_overlay_color_class($color) {
  $color_classes = _oai_get_overlay_color_class_map();
  $color = strtolower($color);

  return array_key_exists($color, $color_classes) ?
    $color_classes[$color] : '';
}

/**
 * Top notice block color classes map.
 */
function oai_get_block_scheme_from_color(&$color) {
  $map = array(
    '#6c6c62' => '',
    '#b1dde5' => 'style-a',
    '#d9d9d9' => 'style-b',
  );

    if(!empty($color) && !empty($map[strtolower($color)])) {
      return $map[strtolower($color)];
    } else {
      return '';
    }
}

/* main ul */
function oai_menu_tree__main_menu($variables) {
  return '<ul>' . $variables['tree'] . '</ul>';
}

/* inner ul */
function oai_menu_tree__main_menu_inner($variables) {
  return '<div class="sublevel">' . $variables['tree'] . '</div>';
}

/* inner li */
function oai_menu_link__main_menu_inner($variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  $output = '<h6>' . $element['#title'] . '</h6>';
  return '<div class="col">' . $output . $sub_menu . "</div>\n";
}

/* main li */
function oai_menu_link__main_menu(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    foreach ($element['#below'] as $key => $val) {
      if (is_numeric($key)) {
        $element['#below'][$key]['#theme'] = 'menu_link__main_menu_inner'; // 2 level
      }
    }
    $element['#below']['#theme_wrappers'][0] = 'menu_tree__main_menu_inner';  // 2 level
    $sub_menu = drupal_render($element['#below']);
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
* Add wrapper for Rander Array element in prefix and suffix.
**/
function oai_wrap_item(&$element, $classes, $tag = 'div') {
  if (!empty($element)) {
    $element['#prefix'] = '<' . $tag . (!empty($classes) ? ' class="' . $classes . '">' : '>') . (array_key_exists('#prefix', $element) ? $element['#prefix'] : '');
    $element['#suffix'] = (array_key_exists('#suffix', $element) ? $element['#suffix'] : '') . '</'. $tag . '>';
  }
}

/**
 * Creates a simple text rows array from a field collections, to be used in a
 * field_preprocess function.
 *
 * @param $vars
 * An array of variables to pass to the theme template.
 * @param $field_array
 * Array of fields to be turned into rows in the field collection.
 * @return array
 */
function _oai_rows_from_field_collection(&$vars, $field_array) {
  $rows = array();
  if (isset($vars['element']['#items'])) {
    $items = $vars['element']['#items'];
  }
  elseif (isset($vars['#items'])) {
    $items = $vars['#items'];
  }
  else {
    $items = array();
  }

  foreach ($items as $key => $item) {
    $entity_id = $item['value'];
    $entity = field_collection_item_load($entity_id);
    try {
      $wrapper = entity_metadata_wrapper('field_collection_item', $entity);
      $row = array();
      $properties = $wrapper->getPropertyInfo();

      foreach($field_array as $field) {
        if (array_key_exists($field, $properties)) {
          $row[$field] = $wrapper->$field->value();
        }
      }
      $rows[] = $row;
    }
    catch (EntityMetadataWrapperException $exc) {
      watchdog('oai', 'See ' . __FUNCTION__ . '() <pre>' . $exc->getTraceAsString() . '</pre>', NULL, WATCHDOG_ERROR);
    }
  }

  return $rows;
}

/**
 * Get color class from color field.
 *
 * @param $node
 * @param $field
 * @return string
 */
function _oai_get_color_class_from_color_field($node, $field) {
  $node_fields = _oai_get_rows_from_node($node, array($field));
  if (isset($node_fields) && !empty($node_fields)) {
    $color = (isset($node_fields[$field]) && isset($node_fields[$field]['rgb'])) ?
      $node_fields[$field]['rgb'] : '';
    $color_class = oai_get_color_class($color);

    return $color_class;
  }
}


/**
 * Get rows from node.
 *
 * @param $node
 * @param $field_array
 * @return array|void
 */
function _oai_get_rows_from_node($node, $field_array) {

  if (!is_object($node)) {
    return;
  }

  try {
    $node_wrapper = entity_metadata_wrapper('node', $node);
    $properties = $node_wrapper->getPropertyInfo();
    $rows = array();

    foreach ($field_array as $field) {
      if (array_key_exists($field, $properties)) {
        $rows[$field] = $node_wrapper->$field->value();
      }
    }
  }
  catch (EntityMetadataWrapperException $exc) {
    watchdog('oai', 'See ' . __FUNCTION__ . '() <pre>' . $exc->getTraceAsString() . '</pre>', NULL, WATCHDOG_ERROR);
  }

  return $rows;
}

/**
 * Get FAQ id.
 *
 * @param $title
 * @return string|void
 */
function _oai_get_faq_id($title, $prefix = 'faq-') {
  if (!$title) {
    return;
  }

  $title = htmlspecialchars_decode($title, ENT_QUOTES);
  $title = preg_replace('/[^A-Za-z0-9]/', ' ', $title);
  $title = trim($title);
  $title = strtolower($title);
  return $prefix . check_plain(str_replace(' ', '-', $title));
}

/**
 * Implements hook_theme().
 */
function oai_theme() {
  return array(
    'oai_pager_next' => array(
      'variables' => array(
        'text' => NULL,
        'element' => NULL,
        'interval' => NULL,
        'parameters' => NULL
      ),
    ),
    'oai_pager_last' => array(
      'variables' => array(
        'text' => NULL,
        'element' => NULL,
        'parameters' => NULL
      ),
    ),
    'oai_pager_link' => array(
      'variables' => array(
        'text' => NULL,
        'page_new' => NULL,
        'element' => NULL,
        'parameters' => NULL,
        'attributes' => NULL,
      ),
    ),
  );
}

/**
 * Implements theme_views_load_more_pager().
 */
function oai_views_load_more_pager($vars) {
  global $pager_page_array, $pager_total;

  $tags = $vars['tags'];
  $element = $vars['element'];
  $parameters = $vars['parameters'];

  $pager_classes = array('pager', 'pager-load-more');

  $li_next = theme('oai_pager_next',
    array(
      'text' => (isset($tags[3]) ? $tags[3] : t($vars['more_button_text'])),
      'element' => $element,
      'interval' => 1,
      'parameters' => $parameters,
    )
  );
  if (empty($li_next)) {
    $li_next = empty($vars['more_button_empty_text']) ? '&nbsp;' : t($vars['more_button_empty_text']);
    $pager_classes[] = 'pager-load-more-empty';
  }
  // Compatibility with tao theme's pager
  elseif (is_array($li_next) && isset($li_next['title'], $li_next['href'], $li_next['attributes'], $li_next['query'])) {
    $li_next = l($li_next['title'], $li_next['href'], array('attributes' => $li_next['attributes'], 'query' => $li_next['query']));
  }

  if ($pager_total[$element] > 1) {
    $items[] = array(
      'class' => array('pager-next'),
      'data' => $li_next,
    );
    return theme('item_list',
      array(
        'items' => $items,
        'title' => NULL,
        'type' => 'ul',
        'attributes' => array('class' => $pager_classes),
      )
    );
  }
}

/**
 * Implements theme_pager_next().
 */
function oai_oai_pager_next($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $interval = $variables['interval'];
  $parameters = $variables['parameters'];
  global $pager_page_array, $pager_total;
  $output = '';

  // If we are anywhere but the last page
  if ($pager_page_array[$element] < ($pager_total[$element] - 1)) {
    $page_new = pager_load_array($pager_page_array[$element] + $interval, $element, $pager_page_array);
    // If the next page is the last page, mark the link as such.
    if ($page_new[$element] == ($pager_total[$element] - 1)) {
      $output = theme('oai_pager_last', array('text' => $text, 'element' => $element, 'parameters' => $parameters));
    }
    // The next page is not the last page.
    else {
      $output = theme('oai_pager_link', array('text' => $text, 'page_new' => $page_new, 'element' => $element, 'parameters' => $parameters, 'attributes' => array()));
    }
  }

  return $output;
}

/**
 * Implements theme_pager_last().
 */
function oai_oai_pager_last($variables) {
  $text = $variables['text'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  global $pager_page_array, $pager_total;
  $output = '';

  // If we are anywhere but the last page
  if ($pager_page_array[$element] < ($pager_total[$element] - 1)) {
    $output = theme('oai_pager_link', array('text' => $text, 'page_new' => pager_load_array($pager_total[$element] - 1, $element, $pager_page_array), 'element' => $element, 'parameters' => $parameters));
  }

  return $output;
}

/**
 * Implements theme_pager_link().
 */
function oai_oai_pager_link($variables) {
  $text = $variables['text'];
  $page_new = $variables['page_new'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $attributes = $variables['attributes'];

  $page = isset($_GET['page']) ? $_GET['page'] : '';
  if ($new_page = implode(',', pager_load_array($page_new[$element], $element, explode(',', $page)))) {
    $parameters['page'] = $new_page;
  }

  $query = array();
  if (count($parameters)) {
    $query = drupal_get_query_parameters($parameters, array());
  }
  if ($query_pager = pager_get_query_parameters()) {
    $query = array_merge($query, $query_pager);
  }

  // Set each pager link title
  if (!isset($attributes['title'])) {
    static $titles = NULL;
    if (!isset($titles)) {
      $titles = array(
        t('« first') => t('Go to first page'),
        t('‹ previous') => t('Go to previous page'),
        t('next ›') => t('Go to next page'),
        t('last »') => t('Go to last page'),
      );
    }
    if (isset($titles[$text])) {
      $attributes['title'] = $titles[$text];
    }
    elseif (is_numeric($text)) {
      $attributes['title'] = t('Go to page @number', array('@number' => $text));
    }
  }

  $attributes['href'] = url($_GET['q'], array('query' => $query));
  return '<a' . drupal_attributes($attributes) . '><span>' . check_plain($text) . '</span></a>';
}

/**
 * Implements hook_preprocess_views_view_fields().
 */
function oai_preprocess_views_view_fields(&$vars) {
  $view = $vars['view'];
  switch ($view->name) {
    case 'audition_schedule_sidebar':
      foreach ($vars['fields'] as $id => $field) {
        if ($id == 'field_schedule_items_title') {
          $node = menu_get_object();
          if ($node) {
            $color_fields_value = _oai_get_rows_from_node($node, array('field_sl_color'));
            $color = (isset($color_fields_value['field_sl_color']) &&
              isset($color_fields_value['field_sl_color']['rgb'])) ?
              $color_fields_value['field_sl_color']['rgb'] : '';
            $content = $field->content;
            if ($content) {
              $color_style = isset($color) ? 'style="color: ' . $color . ';"' : '';
              $content = '<h4 ' . $color_style . '>' . $content . '</h4><br>';
              $vars['fields'][$id]->content = $content;
            }
          }
        }
      }
      break;
  }
}

/**
 * Implements hook_preprocess_views_view_unformatted().
 */
function oai_preprocess_views_view_unformatted(&$vars) {
  $view = $vars['view'];
  switch ($view->name) {
    case 'faculty':
      if ($view->current_display == 'block_1') {
        $title_icon = isset($vars['title']) ? $vars['title'] : '';
        $title_icon = explode('|', $title_icon);
        $title = !empty($title_icon[0]) ? $title_icon[0] : '';
        if ($title) {
          $vars['title_id'] = _oai_get_faq_id($title, $prefix = 'faculty-');
        }
      }
      break;
  }
}

/**
 * Get full block html with contextual links.
 *
 * @param $module
 *   Name of the module that implements the block to load.
 * @param $delta
 *   Unique ID of the block within the context of $module. Pass NULL to return
 *   an empty block object for $module.
 *
 * @return string Block html
 */
function oai_get_rendered_block($module, $delta) {
  $block = block_load($module, $delta);
  $render_block = _block_render_blocks(array($block));
  $render_block_array = _block_get_renderable_array($render_block);

  return !empty($block) ? drupal_render($render_block_array) : '';
}

/**
 * Implements hook_views_pre_render().
 */
function oai_views_pre_render(&$view) {
//  switch($view->name) {
//    case 'faculty':
//      if (($view->current_display == 'block') || ($view->current_display == 'block_1')) {
//        $results = &$view->result;
//        $year_field = ($view->current_display == 'block') ?
//          'field_field_fm_fall_years' : 'field_field_fm_year';
//        $year_field_data = ($view->current_display == 'block') ?
//          'field_data_field_fm_fall_years_field_fm_fall_years_value' : 'field_data_field_fm_year_field_fm_year_value';
//
//        foreach($results as &$result) {
//          if (count($result->$year_field) > 1) {
//            foreach ($result->$year_field as $year) {
//              if ($year['raw']['value'] == $result->$year_field_data) {
//                $result->$year_field = array($year);
//              }
//            }
//          }
//        }
//      }
//      break;
//  }
}
