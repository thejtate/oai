<?php
/**
 * @file Social maps
 */

/**
 * Social map.
 *
 * @return array
 */
function _oai_custom_admin_settings_map() {
  return array(
    'oai_custom_social_settings_facebook' => array(
      'title' => t('Facebook'),
      'class' => 'social-1'
    ),
    'oai_custom_social_settings_twitter' => array(
      'title' => t('Twitter'),
      'class' => 'social-2'
    ),
    'oai_custom_social_settings_instagram' => array(
      'title' => t('Instagram'),
      'class' => 'social-3'
    ),
    'oai_custom_social_settings_youtube' => array(
      'title' => t('Youtube'),
      'class' => 'social-4'
    ),
  );
}