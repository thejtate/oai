<?php
/**
 * @file
 * Custom page with site settings
 */

function oai_custom_admin_settings() {
  $form = array();

  $form['social'] = array(
    '#type' => 'fieldset',
    '#title' => t('Social'),
    '#weight' => 1,
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );

  $socials = _oai_custom_admin_settings_map();

  foreach($socials as $key => $data){
    $form['social'][$key] = array(
      '#type' => 'textfield',
      '#size' => 50,
      '#title' => $data['title'],
      '#default_value' => variable_get($key, ""),
    );
  }

  return system_settings_form($form);
}