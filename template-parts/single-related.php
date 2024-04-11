<h3 class="related--posts__title"><?php _e('Related Posts', 'Farallon'); ?></h3>
<div class="post--single__related">
    <?php $the_query = new WP_Query(array(
        'post_type' => 'post',
        'post__not_in' => array(get_the_ID()),
        'posts_per_page' => 6,
        'category__in' => wp_get_post_categories(get_the_ID())
    ));
    while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <div class="post--single__related__item">
            <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                <div class="post--single__related__item__img">
                    <?php if (farallon_is_has_image(get_the_ID())) : ?>
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
    <?php endwhile;
    wp_reset_postdata(); ?>
</div>