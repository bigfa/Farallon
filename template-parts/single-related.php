<h3 class="related--posts__title"><?php _e('Related Posts', 'Farallon'); ?></h3>
<div class="post--single__related">
    <?php
    global $farallonSetting;
    // get same format related posts
    $the_query = new WP_Query(array(
        'post_type' => 'post',
        'post__not_in' => array(get_the_ID()),
        'posts_per_page' => 6,
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
            <div class="post--single__related__status">
                <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                    <?php the_excerpt(); ?>
                    <div class="meta">
                        <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                            <path d="M512 97.52381c228.912762 0 414.47619 185.563429 414.47619 414.47619s-185.563429 414.47619-414.47619 414.47619S97.52381 740.912762 97.52381 512 283.087238 97.52381 512 97.52381z m0 73.142857C323.486476 170.666667 170.666667 323.486476 170.666667 512s152.81981 341.333333 341.333333 341.333333 341.333333-152.81981 341.333333-341.333333S700.513524 170.666667 512 170.666667z m36.571429 89.697523v229.86362h160.865523v73.142857H512a36.571429 36.571429 0 0 1-36.571429-36.571429V260.388571h73.142858z"></path>
                        </svg>
                        <time itemprop="datePublished" datetime="<?php echo get_the_date('c'); ?>" class="humane--time">
                            <?php echo get_the_date('Y-m-d'); ?>
                        </time>
                    </div>
                </a>
            </div>
        <?php else : ?>
            <div class="post--single__related__item">
                <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                    <div class="post--single__related__item__img">
                        <?php if (farallon_is_has_image(get_the_ID()) || $farallonSetting->get_setting('always_home_cover')) : ?>
                            <img src="<?php echo farallon_get_background_image(get_the_ID(), 400, 200); ?>" class="cover" alt="<?php the_title(); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="post--single__related__item__title">
                        <?php the_title(); ?>
                    </div>
                    <div class="meta">
                        <time datetime="<?php echo get_the_date('c'); ?>" class="humane--time">
                            <?php echo get_the_date('Y-m-d'); ?>
                        </time>
                    </div>
                </a>
            </div>
        <?php endif; ?>
    <?php endwhile;
    wp_reset_postdata(); ?>
</div>