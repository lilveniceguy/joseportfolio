<?php if (!defined('ABSPATH')) exit; ?>

<header class="bg-surface-900/50 backdrop-blur-sm p-5 md:p-6 flex justify-between items-center relative z-20">
  <!-- Menu -->
  <button
    @click="$store.portfolio.toggleMenu()"
    class="text-text-muted hover:text-brand-orange transition-colors"
    aria-label="Open menu"
    type="button"
  >
    <svg class="w-7 h-7 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
  </button>

  <!-- Search -->
  <button
    class="text-text-muted hover:text-brand-blue transition-colors"
    type="button"
    aria-label="Search"
  >
    <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
    </svg>
  </button>
</header>
