<div class="post--single__meta">
    <time itemprop="datePublished" datetime="<?php echo get_the_date('c'); ?>"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .  __('ago', 'Farallon'); ?></time> / <?php the_category(',') ?> / <?php echo farallon_get_post_views_text(false, false, false, get_the_ID()); ?> / <?php echo farallon_get_post_read_time_text(get_the_ID()); ?>
</div>
<h2 class="post--single__title" itemprop="headline"><?php the_title(); ?></h2>