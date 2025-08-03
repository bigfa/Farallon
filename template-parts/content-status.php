<article class="fStatus--item" itemtype="http://schema.org/Article" itemscope="itemscope">
    <header class="fStatus--header">
        <?php echo get_avatar(get_the_author_meta('ID'), 48); ?>
        <a itemprop="datePublished" datetime="<?php echo get_the_date('c'); ?>" href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
            <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .  __(' ago', 'Farallon'); ?>
        </a>
    </header>
    <div class="fStatus--snippet" itemprop="about">
        <p>
            <?php
            if (has_excerpt()) {
                echo get_the_excerpt();
            } else {
                echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 150, "...");
            } ?>
        </p>
    </div>
</article>