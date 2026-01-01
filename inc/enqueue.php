<?php
if (!defined('ABSPATH')) exit;

require_once get_template_directory() . '/inc/config.php';

add_action('wp_enqueue_scripts', function () {
  $dir = get_stylesheet_directory();
  $uri = get_stylesheet_directory_uri();

  // Tailwind (compiled locally)
  $tailwind = $dir . '/dist/tailwind.css';
  if (file_exists($tailwind)) {
    wp_enqueue_style('jose-tailwind', $uri . '/dist/tailwind.css', [], filemtime($tailwind));
  }

  // App JS (Alpine store) - load FIRST to register store before Alpine initializes
  $app = $dir . '/dist/app.js';
  if (file_exists($app)) {
    // Load in head so store registration happens before Alpine processes DOM
    wp_enqueue_script('jose-app', $uri . '/dist/app.js', [], filemtime($app), false);

    // Inject PHP config into window.JOSE_PORTFOLIO
    $config = jose_portfolio_get_config();
    wp_localize_script('jose-app', 'JOSE_PORTFOLIO', $config);
  }

  // Alpine (local) - load after app.js so store is already registered
  $alpine = $dir . '/dist/alpine.min.js';
  if (file_exists($alpine)) {
    wp_enqueue_script('jose-alpine', $uri . '/dist/alpine.min.js', [], filemtime($alpine), true);
  }
});
