<?php
/**
 * Main theme template
 */
if (!defined('ABSPATH')) exit;

get_header();

if (!is_user_logged_in()) {
  get_template_part('template-parts/app/under-construction');
} else {
  get_template_part('template-parts/app/shell');
}

get_footer();
