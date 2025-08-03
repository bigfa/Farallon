<header class="fArticle--header">
    <h2 class="fArticle--headline" itemprop="headline"><?php the_title(); ?></h2>
    <div class="fArticle--meta">
        <time itemprop="datePublished" datetime="<?php echo get_the_date('c'); ?>"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .  __(' ago', 'Farallon'); ?></time>
        <span class="sep"></span>
        <?php the_category(',') ?>
        <span class="sep"></span>
        <?php echo farallon_get_post_views_text(false, false, false, get_the_ID()); ?>
    </div>
</header>