<?php
if (!defined('ABSPATH')) exit;
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/blocks/job-detail.php';
require_once get_template_directory() . '/inc/blocks/achievement-detail.php';

/**
 * Get portfolio sections from WordPress options
 * If the option is empty or doesn't exist, set it with default sections
 * 
 * @return array Array of section slugs
 */
function jose_portfolio_get_sections() {
    $default_sections = ['jobs', 'skills', 'education', 'certificates', 'contact'];
    $sections = get_option('jose_portfolio_sections', false);
    
    // If option doesn't exist or is empty, set it with defaults
    if ($sections === false || empty($sections) || !is_array($sections)) {
        update_option('jose_portfolio_sections', $default_sections);
        return $default_sections;
    }
    
    // Return the stored sections from WordPress
    return $sections;
}