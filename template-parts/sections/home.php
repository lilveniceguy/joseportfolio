<?php if (!defined('ABSPATH')) exit; ?>
<?php get_template_part('template-parts/app/album-grid'); ?>
<section x-show="$store.portfolio.currentSection === 'home'" style="display:none;" class="mt-4 flex flex-col items-center justify-center">
  <div class="text-center w-full max-w-2xl mx-auto px-4">
    <!-- Circular graphic with gradient border -->
    <div class="w-32 h-32 md:w-40 md:h-40 mx-auto mb-6 md:mb-8 relative">
      <!-- Gradient border circle -->
      <div class="absolute inset-0 rounded-full bg-gradient-to-r from-brand-blue via-brand-blue to-brand-orange p-[3px]">
        <div class="w-full h-full rounded-full bg-surface-850 flex items-center justify-center">
          <!-- House icon inside -->
          <svg class="w-14 h-14 md:w-20 md:h-20" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Roof (red) -->
            <path d="M50 20 L20 45 L80 45 Z" fill="#EF4444"/>
            <!-- House body (brown) -->
            <rect x="30" y="45" width="40" height="35" fill="#92400E"/>
            <!-- Window (blue) -->
            <rect x="40" y="52" width="12" height="12" fill="#3B82F6"/>
            <!-- Door -->
            <rect x="58" y="60" width="8" height="20" fill="#78350F"/>
            <!-- Grass (green) -->
            <rect x="20" y="80" width="60" height="5" fill="#22C55E"/>
          </svg>
        </div>
      </div>
    </div>
</section>
