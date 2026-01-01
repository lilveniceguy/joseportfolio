<?php
/**
 * ACF Block: Job Detail
 * Fields are attached via ACF Field Group location rule: Block == acf/job-detail
 */

// If you used Option 2 (Group field), uncomment this and use $job['...'] below.
// $job = get_field('job');

$company    = get_the_title();
$position   = get_field('position');
$location   = get_field('location');
$start_date = get_field('start_date');
$end_date   = get_field('end_date');
$is_current = (bool) get_field('is_current');
$highlights = get_field('highlights'); // repeater

$tags = get_the_tags() ?: []; // WP tags = skills

?>
<section class="rounded-2xl border border-slate-700/60 bg-slate-900/40 p-5">
  <header class="flex items-start justify-between gap-4">
    <div class="min-w-0">
      <h3 class="text-lg font-semibold text-slate-100">
        <?php echo esc_html($company ?: 'Company'); ?>
      </h3>

      <p class="text-sm text-slate-300">
        <?php echo esc_html($position ?: 'Position'); ?>
        <?php if ($location) : ?>
          <span class="text-slate-500">•</span> <?php echo esc_html($location); ?>
        <?php endif; ?>
      </p>
    </div>

    <div class="shrink-0 text-right text-xs text-slate-400">
      <?php if ($start_date) : ?>
        <div>
          <?php echo esc_html($start_date); ?>
          <span class="text-slate-500">→</span>
          <?php echo esc_html($is_current ? 'Present' : ($end_date ?: '')); ?>
        </div>
      <?php endif; ?>
    </div>
  </header>

  <?php if (!empty($highlights)) : ?>
    <ul class="mt-4 space-y-2 text-sm text-slate-200">
      <?php foreach ($highlights as $row) :
        $bullet = $row['bullet'] ?? '';
        if (!$bullet) continue;
      ?>
        <li class="flex gap-2">
          <span class="mt-[6px] h-1.5 w-1.5 shrink-0 rounded-full bg-orange-400"></span>
          <span><?php echo esc_html($bullet); ?></span>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <?php if (!empty($tags)) : ?>
    <div class="mt-4 flex flex-wrap gap-2">
      <?php foreach ($tags as $tag) : ?>
        <span class="rounded-full bg-slate-800 px-3 py-1 text-xs text-slate-200 border border-slate-700/60">
          <?php echo esc_html($tag->name); ?>
        </span>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>
