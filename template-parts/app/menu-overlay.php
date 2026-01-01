<?php if (!defined('ABSPATH')) exit; ?>

<div
  x-show="$store.portfolio.menuOpen"
  x-transition:enter="transition ease-out duration-500"
  x-transition:enter-start="transform translate-y-full"
  x-transition:enter-end="transform translate-y-0"
  x-transition:leave="transition ease-in duration-400"
  x-transition:leave-start="transform translate-y-0"
  x-transition:leave-end="transform translate-y-full"
  class="fixed inset-0 bg-surface-900/98 backdrop-blur-md z-30 overflow-y-auto"
  style="display:none;"
>
  <div class="min-h-full flex flex-col py-20 md:py-24 px-6 md:px-12">
    <div class="max-w-2xl mx-auto w-full">

      <div class="text-center mb-8 md:mb-12">
        <h2 class="text-text-base text-xl md:text-2xl tracking-[0.3em] uppercase mb-2 font-light">Portfolio</h2>
        <p class="text-text-faint text-sm md:text-base tracking-[0.2em] uppercase font-light">Navigation Menu</p>
      </div>

      <div class="space-y-1">
        <template x-for="(item, idx) in $store.portfolio.menuItems" :key="item.id">
          <div
            @click="$store.portfolio.setSection(item.id)"
            class="px-4 md:px-6 py-4 md:py-5 flex items-center gap-4 md:gap-6 border-b border-border hover:bg-surface-800/30 transition-all cursor-pointer group rounded-lg"
          >
            <span class="text-text-faint text-lg md:text-xl w-10 text-center group-hover:text-brand-orange transition-colors font-light"
                  x-text="String(idx + 1).padStart(2,'0')"></span>

            <span class="flex-1 text-text-strong text-lg md:text-xl font-medium group-hover:text-brand-orange transition-colors"
                  :class="$store.portfolio.isActive(item.id) ? 'text-brand-orange' : ''"
                  x-text="item.label"></span>

            <span class="text-text-faint text-sm md:text-base group-hover:text-brand-blue transition-colors tracking-wider"
                  x-text="item.meta"></span>

            <span class="text-2xl md:text-3xl group-hover:scale-110 transition-transform"
                  x-text="item.icon"></span>
          </div>
        </template>
      </div>
    </div>
  </div>
</div>
