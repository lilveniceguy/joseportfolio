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

  // Alpine (local)
  $alpine = $dir . '/dist/alpine.min.js';
  if (file_exists($alpine)) {
    wp_enqueue_script('jose-alpine', $uri . '/dist/alpine.min.js', [], filemtime($alpine), true);
  }

  // App JS (Alpine store)
  $app = $dir . '/dist/app.js';
  if (file_exists($app)) {
    wp_enqueue_script('jose-app', $uri . '/dist/app.js', ['jose-alpine'], filemtime($app), true);

    // Inject PHP config into window.JOSE_PORTFOLIO
    $config = jose_portfolio_get_config();
    wp_localize_script('jose-app', 'JOSE_PORTFOLIO', $config);
  }
});
