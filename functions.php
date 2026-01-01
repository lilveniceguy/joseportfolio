<?php
if (!defined('ABSPATH')) exit;

// Load config once - available globally
require_once get_template_directory() . '/inc/config.php';

require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/blocks/job-detail.php';
require_once get_template_directory() . '/inc/blocks/achievement-detail.php';

/**
 * Get portfolio sections from WordPress options
 * Returns section IDs (excluding 'home') from menu items
 * 
 * @return array Array of section slugs
 */
function jose_portfolio_get_sections() {
    $config = jose_portfolio_get_config();
    $sections = [];
    
    // Get all section IDs except 'home'
    foreach ($config['menuItems'] as $item) {
        if ($item['id'] !== 'home') {
            $sections[] = $item['id'];
        }
    }
    
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