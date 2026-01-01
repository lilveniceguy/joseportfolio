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

/**
 * Output JSON-encoded data (similar to Sage's @json directive)
 * Usage: <?php json($data); ?> instead of <?php echo json_encode($data); ?>
 * 
 * @param mixed $data Data to encode
 * @param int $flags Optional JSON encoding flags (default: JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT for HTML safety)
 * @return void
 */
if (!function_exists('json')) {
    function json($data, $flags = null) {
        if ($flags === null) {
            // Default flags for safe HTML attribute output
            $flags = JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE;
        }
        echo json_encode($data, $flags);
    }
}