<?php if (!defined('ABSPATH')) exit; ?>

<section class="bg-surface-950/60 backdrop-blur-sm px-6 md:px-8 py-5 md:py-6 border-t border-border flex-shrink-0">
  <div class="text-center mb-4 md:mb-5">
    <h3 class="text-text-strong text-lg md:text-xl font-semibold uppercase tracking-wider"
        x-text="$store.portfolio.currentItem()?.label || ''"></h3>
    <p class="text-text-faint text-xs tracking-wide">Current Section</p>
  </div>

  <div class="flex justify-center items-center gap-6 md:gap-10">
    <button
      class="text-text-muted hover:text-brand-orange transition-all hover:scale-110"
      type="button"
      aria-label="Previous section"
      @click="
        const items = $store.portfolio.menuItems;
        const idx = items.findIndex(i => i.id === $store.portfolio.currentSection);
        if (idx > 0) $store.portfolio.setSection(items[idx - 1].id);
      "
    >
      <svg class="w-7 h-7 md:w-9 md:h-9" fill="currentColor" viewBox="0 0 24 24">
        <path d="M6 6h2v12H6zm3.5 6l8.5 6V6z"/>
      </svg>
    </button>

    <button
      class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-gradient-to-br from-brand-blue to-brand-blue/80 hover:from-brand-orange hover:to-brand-orange/80 text-white shadow-lg hover:shadow-brand-orange/50 transition-all hover:scale-105 flex items-center justify-center"
      type="button"
      aria-label="Main action"
    >
      <svg class="w-7 h-7 md:w-8 md:h-8 ml-1" fill="currentColor" viewBox="0 0 24 24">
        <path d="M8 5v14l11-7z"/>
      </svg>
    </button>

    <button
      class="text-text-muted hover:text-brand-orange transition-all hover:scale-110"
      type="button"
      aria-label="Next section"
      @click="
        const items = $store.portfolio.menuItems;
        const idx = items.findIndex(i => i.id === $store.portfolio.currentSection);
        if (idx >= 0 && idx < items.length - 1) $store.portfolio.setSection(items[idx + 1].id);
      "
    >
      <svg class="w-7 h-7 md:w-9 md:h-9" fill="currentColor" viewBox="0 0 24 24">
        <path d="M16 18h2V6h-2zm-8.5-6L0 6v12z"/>
      </svg>
    </button>
  </div>
</section>
