<?php if (!defined('ABSPATH')) exit; ?>

<footer class="bg-surface-950/80 px-6 md:px-8 py-4 md:py-5 border-t border-border flex-shrink-0">
  <div class="flex justify-around mb-3 max-w-md mx-auto">

    <button @click="$store.portfolio.setSection('home')"
      class="text-text-faint hover:text-white transition-colors"
      :class="$store.portfolio.isActive('home') ? 'text-white' : ''"
      type="button" aria-label="Home">
      <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
      </svg>
    </button>

    <button @click="$store.portfolio.setSection('about')"
      class="text-text-faint hover:text-white transition-colors"
      :class="$store.portfolio.isActive('about') ? 'text-white' : ''"
      type="button" aria-label="About">
      <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
      </svg>
    </button>

    <button @click="$store.portfolio.setSection('jobs')"
      class="text-text-faint hover:text-brand-orange transition-colors"
      :class="$store.portfolio.isActive('jobs') ? 'text-brand-orange' : ''"
      type="button" aria-label="Jobs">
      <svg class="w-6 h-6 md:w-7 md:h-7" fill="currentColor" viewBox="0 0 24 24">
        <path d="M20 6h-4V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-6 0h-4V4h4v2z"/>
      </svg>
    </button>

    <button @click="$store.portfolio.setSection('contact')"
      class="text-text-faint hover:text-white transition-colors"
      :class="$store.portfolio.isActive('contact') ? 'text-white' : ''"
      type="button" aria-label="Contact">
      <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
      </svg>
    </button>
  </div>

  <p class="text-center text-text-faint text-xs md:text-sm">
    © <?php echo esc_html(date('Y')); ?> Portfolio. All rights reserved.
  </p>
</footer>
