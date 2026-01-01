<?php if (!defined('ABSPATH')) exit; ?>

<div class="pt-4 pb-2 text-center flex-shrink-0">
  <div class="grid grid-cols-3 gap-3 md:gap-5 max-w-md mx-auto mb-8">
    <div class="aspect-square rounded-2xl overflow-hidden bg-gradient-to-br from-surface-700 to-surface-800 shadow-lg"></div>
    <div class="aspect-square rounded-2xl overflow-hidden bg-gradient-to-br from-surface-700 to-surface-800 shadow-lg"></div>
    <div class="aspect-square rounded-2xl overflow-hidden bg-gradient-to-br from-brand-blue to-brand-blue/80 shadow-lg shadow-brand-blue/40"></div>

    <div class="aspect-square rounded-2xl overflow-hidden bg-gradient-to-br from-surface-700 to-surface-800 shadow-lg"></div>
    <div class="aspect-square rounded-2xl overflow-hidden bg-gradient-to-br from-surface-700 to-surface-800 shadow-lg"></div>
    <div class="aspect-square rounded-2xl overflow-hidden bg-gradient-to-br from-surface-700 to-surface-800 shadow-lg"></div>

    <div class="aspect-square rounded-2xl overflow-hidden bg-gradient-to-br from-surface-700 to-surface-800 shadow-lg"></div>
    <div class="aspect-square rounded-2xl overflow-hidden bg-gradient-to-br from-brand-orange to-brand-orange/80 shadow-lg shadow-brand-orange/40"></div>
    <div class="aspect-square rounded-2xl overflow-hidden bg-gradient-to-br from-surface-700 to-surface-800 shadow-lg"></div>
  </div>

  <div>
    <h2 class="text-text-base text-sm md:text-base tracking-[0.3em] uppercase mb-2 font-light"
        x-text="$store.portfolio.currentItem()?.label || ''"></h2>
    <p class="text-text-faint text-xs md:text-sm tracking-[0.2em] uppercase font-light"
       x-text="$store.portfolio.currentItem()?.meta || ''"></p>
  </div>
</div>
