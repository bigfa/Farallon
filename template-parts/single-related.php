<h3 class="related--posts__title">Related Posts</h3>
<div class="post--single__related">
    <?php $the_query = new WP_Query(array(
        'post_type' => 'post',
        'post__not_in' => array(get_the_ID()),
        'posts_per_page' => 6,
        'category__in' => wp_get_post_categories(get_the_ID())
    )); ?>
    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <div class="post--single__related__item">
            <a href="<?php the_permalink(); ?>">
                <div class="post--single__related__item__img">
                    <?php if (aladdin_is_has_image(get_the_ID())) : ?>
                        <img src="<?php echo aladdin_get_background_image(get_the_ID()); ?>!/both/400x200" class="cover" />
                    <?php endif; ?>
                </div>
                <div class="post--single__related__item__title">
                    <?php the_title(); ?>
                </div>
                <div class="meta">
                    <?php echo get_the_date(); ?>
                </div>
            </a>
        </div>
    <?php endwhile;
    wp_reset_postdata();
    ?>
</div>