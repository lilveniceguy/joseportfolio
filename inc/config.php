<?php
if (!defined('ABSPATH')) exit;

function jose_portfolio_get_config(): array {
  return [
    'defaultSection' => 'home',
    'menuItems' => [
      ['id' => 'home',         'label' => 'Home',          'icon' => '🏠', 'meta' => 'Main'],
      ['id' => 'jobs',         'label' => 'Work Exp',      'icon' => '💼', 'meta' => 'Work Experience'],
      ['id' => 'skills',       'label' => 'Skills',        'icon' => '🎯', 'meta' => 'Tech'],
      ['id' => 'education',    'label' => 'Education',     'icon' => '🎓', 'meta' => 'Study'],
      ['id' => 'certificates', 'label' => 'Certificates',  'icon' => '✅', 'meta' => 'Proof'],
      ['id' => 'contact',      'label' => 'Contact',       'icon' => '✉️', 'meta' => 'Reach'],
    ],
  ];
}
