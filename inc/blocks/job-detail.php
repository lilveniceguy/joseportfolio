<?php
/**
 * Job Detail block + Post Meta (no ACF)
 *
 * Data model:
 * - Company = post_title (native)
 * - Description = post_content (native)
 * - Skills = post tags (native)
 * - Extra job fields = post meta (registered, REST-enabled)
 */

if (!defined('ABSPATH')) exit;

add_action('init', function () {

  // 1) Register post meta fields (single source of truth)
  $meta_keys = [
    'jp_position_title'  => ['type' => 'string',  'default' => ''],
    'jp_employment_type' => ['type' => 'string',  'default' => 'remote'], // remote|hybrid|onsite
    'jp_location'        => ['type' => 'string',  'default' => ''],
    'jp_date_start'      => ['type' => 'string',  'default' => ''],       // Y-m-d
    'jp_is_current'      => ['type' => 'boolean', 'default' => false],
    'jp_date_end'        => ['type' => 'string',  'default' => ''],       // Y-m-d
  ];

  foreach ($meta_keys as $key => $schema) {
    register_post_meta('post', $key, [
      'type'              => $schema['type'],
      'single'            => true,
      'default'           => $schema['default'],
      'show_in_rest'      => true, // required so Gutenberg can edit it
      'sanitize_callback' => function ($value) use ($schema, $key) {
        if ($schema['type'] === 'boolean') return (bool) $value;

        $value = is_string($value) ? trim($value) : '';

        // very light validation for dates
        if (in_array($key, ['jp_date_start', 'jp_date_end'], true)) {
          // allow empty
          if ($value === '') return '';
          // accept YYYY-MM-DD only
          if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) return '';
        }

        // employment type guard
        if ($key === 'jp_employment_type') {
          $allowed = ['remote', 'hybrid', 'onsite'];
          return in_array($value, $allowed, true) ? $value : 'remote';
        }

        return sanitize_text_field($value);
      },
      'auth_callback' => function () {
        return current_user_can('edit_posts');
      },
    ]);
  }

  // 2) Register block editor script (no build tools, plain JS)
  $handle = 'jose-portfolio-block-job-detail';

  wp_register_script(
    $handle,
    get_template_directory_uri() . '/assets/js/blocks/job-detail.js',
    ['wp-blocks', 'wp-element', 'wp-i18n', 'wp-components', 'wp-block-editor', 'wp-data', 'wp-core-data'],
    filemtime(get_template_directory() . '/assets/js/blocks/job-detail.js')
  );

  // 3) Register the block (dynamic render so front-end uses latest meta/tags/content)
  register_block_type('jose-portfolio/job-detail', [
    'editor_script'   => $handle,
    'render_callback' => 'jose_portfolio_render_job_detail_block',
  ]);
});

/**
 * Render callback for frontend.
 * Uses post title + post meta + tags, and leaves description to post content (separate block).
 */
function jose_portfolio_render_job_detail_block($attributes, $content, $block) {
  $post_id = get_the_ID();
  if (!$post_id) return '';

  $position   = get_post_meta($post_id, 'jp_position_title', true);
  $emp_type   = get_post_meta($post_id, 'jp_employment_type', true);
  $location   = get_post_meta($post_id, 'jp_location', true);
  $start      = get_post_meta($post_id, 'jp_date_start', true);
  $is_current = (bool) get_post_meta($post_id, 'jp_is_current', true);
  $end        = get_post_meta($post_id, 'jp_date_end', true);

  $tags = get_the_tags($post_id) ?: [];

  // Format dates as "Mon YYYY"
  $fmt = function ($ymd) {
    if (!$ymd) return '';
    $t = strtotime($ymd);
    if (!$t) return '';
    return date('M Y', $t);
  };

  $date_label = '';
  if ($start) {
    $date_label = $fmt($start) . ' → ' . ($is_current ? 'Present' : $fmt($end));
  }

  $emp_label = '';
  if ($emp_type === 'remote') $emp_label = 'Remote';
  elseif ($emp_type === 'hybrid') $emp_label = 'Hybrid';
  elseif ($emp_type === 'onsite') $emp_label = 'Onsite';

  ob_start(); ?>
  <section class="rounded-2xl border border-slate-700/60 bg-slate-900/40 p-5">
    <header class="flex items-start justify-between gap-4">
      <div class="min-w-0">
        <h3 class="text-lg font-semibold text-slate-100">
          <?php echo esc_html(get_the_title($post_id)); ?>
        </h3>

        <p class="text-sm text-slate-300">
          <?php if ($position) : ?>
            <span><?php echo esc_html($position); ?></span>
          <?php endif; ?>

          <?php if ($position && ($location || $emp_label)) : ?>
            <span class="text-slate-500">•</span>
          <?php endif; ?>

          <?php if ($location) : ?>
            <span><?php echo esc_html($location); ?></span>
          <?php endif; ?>

          <?php if ($location && $emp_label) : ?>
            <span class="text-slate-500">•</span>
          <?php endif; ?>

          <?php if ($emp_label) : ?>
            <span><?php echo esc_html($emp_label); ?></span>
          <?php endif; ?>
        </p>
      </div>

      <?php if ($date_label) : ?>
        <div class="shrink-0 text-right text-xs text-slate-400">
          <?php echo esc_html($date_label); ?>
        </div>
      <?php endif; ?>
    </header>

    <?php if (!empty($tags)) : ?>
      <div class="mt-4 flex flex-wrap gap-2">
        <?php foreach ($tags as $tag) : ?>
          <span class="rounded-full border border-slate-700/60 bg-slate-800 px-3 py-1 text-xs text-slate-200">
            <?php echo esc_html($tag->name); ?>
          </span>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </section>
  <?php
  return ob_get_clean();
}
