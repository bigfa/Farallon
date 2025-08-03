<h3 class="fRelated--heroTitle"><?php _e('Related Posts', 'Farallon'); ?></h3>
<div class="fRelated--list">
    <?php
    global $farallonSetting;
    // get same format related posts
    $the_query = new WP_Query(array(
        'post_type' => 'post',
        'post__not_in' => array(get_the_ID()),
        'posts_per_page' => apply_filters('farallon_related_posts_count', 4),
        'category__in' => wp_get_post_categories(get_the_ID()),
        'tax_query' => get_post_format(get_the_ID()) ? array( // same post format
            array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => array('post-format-' . get_post_format(get_the_ID())),
                'operator' => 'IN'
            )
        ) : array()
    ));
    while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <?php if (get_post_format(get_the_ID()) == 'status') : ?>
            <div class="fRelated--status">
                <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>" class="fRelated--snippet">
                    <?php the_excerpt(); ?>
                </a>
                <div class="fRelated--meta">
                    <time itemprop="datePublished" datetime="<?php echo get_the_date('c'); ?>">
                        <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .  __(' ago', 'Farallon'); ?>
                    </time>
                    <span class="sep"></span>
                    <?php echo farallon_get_post_read_time_text(get_the_ID()); ?>
                </div>
            </div>
        <?php else : ?>
            <div class="fRelated--item">
                <?php if (farallon_is_has_image(get_the_ID()) || $farallonSetting->get_setting('always_home_cover')) : ?>
                    <a class="fRelated--cover" href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                        <img src="<?php echo farallon_get_background_image(get_the_ID(), 400, 200); ?>" class="cover" alt="<?php the_title(); ?>" />
                    </a>
                <?php endif; ?>
                <div class="fRelated--title">
                    <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>"><?php the_title(); ?></a>
                </div>
                <div class="fRelated--meta">
                    <time datetime="<?php echo get_the_date('c'); ?>">
                        <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .  __(' ago', 'Farallon'); ?>
                    </time>
                    <span class="sep"></span>
                    <?php echo farallon_get_post_read_time_text(get_the_ID()); ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endwhile;
    wp_reset_postdata(); ?>
</div>