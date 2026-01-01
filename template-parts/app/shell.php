<?php if (!defined('ABSPATH')) exit; ?>

<div
  class="fixed inset-0 overflow-hidden bg-gradient-to-br from-surface-950 via-brand-blue/30 to-surface-850"
  x-data
  x-init="$store.portfolio.init()"
>
  <div
    class="h-screen w-screen flex flex-col bg-gradient-to-b from-surface-850 to-surface-950 transition-all duration-500"
    :class="$store.portfolio.menuOpen ? 'scale-[0.15] opacity-60 origin-top' : ''"
  >
    <?php get_template_part('template-parts/app/topbar'); ?>
    <?php get_template_part('template-parts/app/album-grid'); ?>

    <main class="flex-1 overflow-y-auto px-6 md:px-12 pb-6">
      <div class="max-w-4xl mx-auto">
        <?php get_template_part('template-parts/sections/home'); ?>
        <?php 
        // Only include sections that exist
        $sections = ['jobs', 'skills', 'education', 'certificates', 'contact'];
        foreach ($sections as $section) {
          $file = get_template_directory() . '/template-parts/sections/' . $section . '.php';
          if (file_exists($file)) {
            get_template_part('template-parts/sections/' . $section);
          }
        }
        ?>
      </div>
    </main>

    <?php get_template_part('template-parts/app/player-controls'); ?>
    <?php get_template_part('template-parts/app/footer-nav'); ?>
  </div>

  <?php get_template_part('template-parts/app/menu-overlay'); ?>
</div>
