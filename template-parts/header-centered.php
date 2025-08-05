<header class="fArticle--header">
    <h2 class="fArticle--headline" itemprop="headline"><?php the_title(); ?></h2>
    <div class="fArticle--meta">
        <time itemprop="datePublished" datetime="<?php echo get_the_date('c'); ?>"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .  __(' ago', 'Farallon'); ?></time>
        <span class="sep"></span>
        <?php the_category(',') ?>
        <?php echo farallon_get_post_views_text(false, false, false, get_the_ID(), '<span class="sep"></span>', ''); ?>
        <?php echo farallon_get_post_read_time_text(get_the_ID(), '<span class="sep"></span>', ''); ?>
    </div>
</header>