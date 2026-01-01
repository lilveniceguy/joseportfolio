<?php if (!defined('ABSPATH')) exit; 

// Get all tags from posts
$tags = get_terms(array(
  'taxonomy' => 'post_tag',
  'hide_empty' => true,
));
$tag_names = array();
if (!is_wp_error($tags) && !empty($tags)) {
  foreach ($tags as $tag) {
    $tag_names[] = $tag->name;
  }
}
// If no tags, use placeholder
if (empty($tag_names)) {
  $tag_names = array('Tag 1', 'Tag 2', 'Tag 3', 'Tag 4', 'Tag 5');
}
?>

<div class="pt-4 pb-2 text-center flex-shrink-0" 
     x-data
     data-tags="<?php echo esc_attr(json_encode($tag_names)); ?>"
     x-init="
       $store.portfolio.albumGrid.tagNames = JSON.parse($el.dataset.tags);
       $store.portfolio.initAlbumGrid();
     ">
  <div class="grid grid-cols-3 gap-3 md:gap-5 max-w-md mx-auto mb-8">
    <template x-for="i in Array.from({length: 9}, (_, i) => i)" :key="i">
      <div class="aspect-square rounded-2xl overflow-hidden flex items-center justify-center relative">
        <!-- Base gray background -->
        <div class="absolute inset-0 bg-gradient-to-br from-surface-700 to-surface-800 rounded-2xl"></div>
        <!-- Colored overlay with opacity transition -->
        <div class="absolute inset-0 rounded-2xl transition-opacity duration-700 ease-in-out"
             :class="$store.portfolio.getSquareClass(i)"
             :style="`opacity: ${$store.portfolio.getSquareOpacity(i)}`"></div>
        <!-- Text -->
        <span class="relative text-text-strong text-xs md:text-sm font-medium px-2 text-center transition-opacity duration-500 z-10"
              :class="$store.portfolio.isTextVisible(i) ? 'opacity-100' : 'opacity-0'"
              x-text="$store.portfolio.getRandomTag(i)"></span>
      </div>
    </template>
  </div>
