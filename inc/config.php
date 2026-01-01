<?php
if (!defined('ABSPATH')) exit;

/**
 * Get default menu items configuration
 * 
 * @return array Array of menu items with id, label, icon, meta
 */
function jose_portfolio_get_default_menu_items(): array {
  return [
    ['id' => 'home',         'label' => 'Home',          'icon' => '🏠', 'meta' => 'Main'],
    ['id' => 'jobs',         'label' => 'Work Exp',      'icon' => '💼', 'meta' => 'Work Experience'],
    ['id' => 'skills',       'label' => 'Skills',        'icon' => '🎯', 'meta' => 'Tech'],
    ['id' => 'education',    'label' => 'Education',     'icon' => '🎓', 'meta' => 'Study'],
    ['id' => 'certificates', 'label' => 'Certificates',  'icon' => '✅', 'meta' => 'Proof'],
    ['id' => 'contact',      'label' => 'Contact',       'icon' => '✉️', 'meta' => 'Reach'],
  ];
}

/**
 * Get portfolio config (menuItems from WordPress options)
 * 
 * @return array Config array with defaultSection and menuItems
 */
function jose_portfolio_get_config(): array {
  $default_menu_items = jose_portfolio_get_default_menu_items();
  
  // Get menu items from WordPress options
  $stored_menu_items = get_option('jose_portfolio_menu_items', false);
  
  // If not set, use defaults and save them
  if ($stored_menu_items === false || empty($stored_menu_items) || !is_array($stored_menu_items)) {
    update_option('jose_portfolio_menu_items', $default_menu_items);
    $menu_items = $default_menu_items;
  } else {
    $menu_items = $stored_menu_items;
  }
  
  return [
    'defaultSection' => 'home',
    'menuItems' => $menu_items,
  ];
}
