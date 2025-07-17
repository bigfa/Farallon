<article class="post--item post--item__status" itemtype="http://schema.org/Article" itemscope="itemscope">
    <div class="content">
        <header>
            <?php echo get_avatar(get_the_author_meta('ID'), 48); ?>
            <a itemprop="datePublished" datetime="<?php echo get_the_date('c'); ?>" href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .  __('ago', 'Farallon'); ?>
            </a>
        </header>
        <?php if (get_the_excerpt()) : ?>
            <div class="description" itemprop="about"><?php the_excerpt(); ?></div>
        <?php endif; ?>
    </div>
</article>