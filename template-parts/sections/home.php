<?php if (!defined('ABSPATH')) exit; ?>
<?php get_template_part('template-parts/app/album-grid'); ?>
<section x-show="$store.portfolio.currentSection === 'home'" style="display:none;" class="mt-4 flex flex-col items-center justify-center">
  <?php
    // Get home section info from PHP config (album-grid is always on home section)
    $config = jose_portfolio_get_config();
    $home_item = null;
    foreach ($config['menuItems'] as $item) {
      if ($item['id'] === 'home') {
        $home_item = $item;
        break;
      }
    }
  ?>
  <div>
    <?php if ($home_item): ?>
      <h2 class="text-text-base text-sm md:text-base tracking-[0.3em] uppercase mb-2 font-light">
        <?php echo esc_html($home_item['label']); ?>
      </h2>
      <p class="text-text-faint text-xs md:text-sm tracking-[0.2em] uppercase font-light">
        <?php echo esc_html($home_item['meta']); ?>
      </p>
    <?php endif; ?>
  </div>
</section>
