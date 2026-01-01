<?php
/**
 * Achievement Detail block (Education + Certificates) - no ACF.
 *
 * Data model:
 * - Post Title = Achievement name (degree/cert name)
 * - Post Content = description/notes
 * - Type (education/certificate) stored in post meta (used for filtering)
 * - Skills = tags (optional)
 */

if (!defined('ABSPATH')) exit;

add_action('init', function () {
  // Register post meta
  $meta_keys = [
    'jp_ach_type'        => ['type' => 'string', 'default' => 'education'], // education|certificate
    'jp_ach_issuer'      => ['type' => 'string', 'default' => ''],          // school/issuer
    'jp_ach_location'    => ['type' => 'string', 'default' => ''],
    'jp_ach_date_start'  => ['type' => 'string', 'default' => ''],          // Y-m-d (optional)
    'jp_ach_date_end'    => ['type' => 'string', 'default' => ''],          // Y-m-d (optional)
    'jp_ach_verify_url'  => ['type' => 'string', 'default' => ''],          // URL
  ];

  foreach ($meta_keys as $key => $schema) {
    register_post_meta('post', $key, [
      'type'         => $schema['type'],
      'single'       => true,
      'default'      => $schema['default'],
      'show_in_rest' => true,
      'sanitize_callback' => function ($value) use ($key) {
        $value = is_string($value) ? trim($value) : '';

        if ($key === 'jp_ach_type') {
          return in_array($value, ['education', 'certificate'], true) ? $value : 'education';
        }

        if (in_array($key, ['jp_ach_date_start', 'jp_ach_date_end'], true)) {
          if ($value === '') return '';
          return preg_match('/^\d{4}-\d{2}-\d{2}$/', $value) ? $value : '';
        }

        if ($key === 'jp_ach_verify_url') {
          return $value === '' ? '' : esc_url_raw($value);
        }

        return sanitize_text_field($value);
      },
      'auth_callback' => function () {
        return current_user_can('edit_posts');
      },
    ]);
  }

  // Editor script
  $handle = 'jose-portfolio-block-achievement-detail';
  wp_register_script(
    $handle,
    get_template_directory_uri() . '/assets/js/blocks/achievement-detail.js',
    ['wp-blocks', 'wp-element', 'wp-i18n', 'wp-components', 'wp-block-editor', 'wp-data', 'wp-core-data'],
    filemtime(get_template_directory() . '/assets/js/blocks/achievement-detail.js')
  );

  // Block registration (dynamic)
  register_block_type('jose-portfolio/achievement-detail', [
    'editor_script'   => $handle,
    'render_callback' => 'jose_portfolio_render_achievement_detail_block',
  ]);
});

function jose_portfolio_render_achievement_detail_block($attributes, $content, $block) {
  $post_id = get_the_ID();
  if (!$post_id) return '';

  $type     = get_post_meta($post_id, 'jp_ach_type', true) ?: 'education';
  $issuer   = get_post_meta($post_id, 'jp_ach_issuer', true);
  $location = get_post_meta($post_id, 'jp_ach_location', true);
  $start    = get_post_meta($post_id, 'jp_ach_date_start', true);
  $end      = get_post_meta($post_id, 'jp_ach_date_end', true);
  $verify   = get_post_meta($post_id, 'jp_ach_verify_url', true);

  $fmt = function ($ymd) {
    if (!$ymd) return '';
    $t = strtotime($ymd);
    return $t ? date('M Y', $t) : '';
  };

  $date_label = '';
  if ($start || $end) {
    $date_label = trim($fmt($start) . ($start && $end ? ' → ' : '') . $fmt($end));
  }

  $badge = ($type === 'certificate') ? 'Certificate' : 'Education';

  ob_start(); ?>
  <section class="rounded-2xl border border-slate-700/60 bg-slate-900/40 p-5">
    <header class="flex items-start justify-between gap-4">
      <div class="min-w-0">
        <div class="flex items-center gap-2">
          <?php if ($type === 'certificate') : ?>
            <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-orange-400/20 text-orange-300 border border-orange-400/30">✓</span>
          <?php else : ?>
            <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-blue-400/20 text-blue-200 border border-blue-400/30">🎓</span>
          <?php endif; ?>

          <h3 class="text-lg font-semibold text-slate-100">
            <?php echo esc_html(get_the_title($post_id)); ?>
          </h3>

          <span class="ml-auto rounded-full border border-slate-700/60 bg-slate-800 px-2.5 py-1 text-[11px] text-slate-200">
            <?php echo esc_html($badge); ?>
          </span>
        </div>

        <?php if ($issuer || $location) : ?>
          <p class="mt-1 text-sm text-slate-300">
            <?php if ($issuer) : ?><span><?php echo esc_html($issuer); ?></span><?php endif; ?>
            <?php if ($issuer && $location) : ?><span class="text-slate-500">•</span><?php endif; ?>
            <?php if ($location) : ?><span><?php echo esc_html($location); ?></span><?php endif; ?>
          </p>
        <?php endif; ?>
      </div>

      <?php if ($date_label) : ?>
        <div class="shrink-0 text-right text-xs text-slate-400">
          <?php echo esc_html($date_label); ?>
        </div>
      <?php endif; ?>
    </header>

    <?php if ($verify) : ?>
      <div class="mt-4">
        <a class="inline-flex items-center gap-2 rounded-xl border border-slate-700/60 bg-slate-800 px-3 py-2 text-xs text-slate-200 hover:bg-slate-700/60"
           href="<?php echo esc_url($verify); ?>" target="_blank" rel="noopener noreferrer">
          Verify online <span class="text-slate-500">↗</span>
        </a>
      </div>
    <?php endif; ?>
  </section>
  <?php
  return ob_get_clean();
}
