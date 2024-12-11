<?php get_header();
global $farallonSetting;
global $farallonBase;
?>

<main class="site--main">
    <?php while (have_posts()) : the_post(); ?>
        <article class="post--single" itemscope="itemscope" itemtype="http://schema.org/Article">
            <?php get_template_part('template-parts/header', 'default'); ?>
            <div class="post--single__content graph" itemprop="articleBody">
                <?php the_content(); ?>
            </div>
            <?php wp_link_pages(array(
                'before'      => '<div class="nav-links nav-links__comment">',
                'after'       => '</div>',
                'pagelink'    => '%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            )); ?>
            <?php if ($farallonSetting->get_setting('update_time')) : ?>
                <div class="post--single__update">
                    <span class="text"><?php _e('Updated on', 'Farallon') ?></span>
                    <time datetime="<?php echo get_the_modified_time('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_time('Y-m-d'); ?></time>
                </div>
            <?php endif; ?>
            <?php if ($farallonSetting->get_setting('postlike')) : ?>
                <div class="post--single__action">
                    <button class="button--like like-btn" aria-label="like the post">
                        <svg class="icon--active" viewBox="0 0 1024 1024" width="32" height="32">
                            <path d="M780.8 204.8c-83.2-44.8-179.2-19.2-243.2 44.8L512 275.2 486.4 249.6c-64-64-166.4-83.2-243.2-44.8C108.8 275.2 89.6 441.6 185.6 537.6l32 32 153.6 153.6 102.4 102.4c25.6 25.6 57.6 25.6 83.2 0l102.4-102.4 153.6-153.6 32-32C934.4 441.6 915.2 275.2 780.8 204.8z"></path>
                        </svg>
                        <svg class="icon--default" viewBox="0 0 1024 1024" width="32" height="32">
                            <path d="M332.8 249.6c38.4 0 83.2 19.2 108.8 44.8L467.2 320 512 364.8 556.8 320l25.6-25.6c32-32 70.4-44.8 108.8-44.8 19.2 0 38.4 6.4 57.6 12.8 44.8 25.6 70.4 57.6 76.8 108.8 6.4 44.8-6.4 89.6-38.4 121.6L512 774.4 236.8 492.8C204.8 460.8 185.6 416 192 371.2c6.4-44.8 38.4-83.2 76.8-108.8C288 256 313.6 249.6 332.8 249.6L332.8 249.6M332.8 185.6C300.8 185.6 268.8 192 243.2 204.8 108.8 275.2 89.6 441.6 185.6 537.6l281.6 281.6C480 832 499.2 838.4 512 838.4s32-6.4 38.4-19.2l281.6-281.6c96-96 76.8-262.4-57.6-332.8-25.6-12.8-57.6-19.2-89.6-19.2-57.6 0-115.2 25.6-153.6 64L512 275.2 486.4 249.6C448 211.2 390.4 185.6 332.8 185.6L332.8 185.6z"></path>
                        </svg>
                    </button>
                </div>
            <?php endif; ?>
            <?php if ($farallonSetting->get_setting('show_copylink')) : ?>
                <div class="post--share">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <g>
                            <path d="M18.36 5.64c-1.95-1.96-5.11-1.96-7.07 0L9.88 7.05 8.46 5.64l1.42-1.42c2.73-2.73 7.16-2.73 9.9 0 2.73 2.74 2.73 7.17 0 9.9l-1.42 1.42-1.41-1.42 1.41-1.41c1.96-1.96 1.96-5.12 0-7.07zm-2.12 3.53l-7.07 7.07-1.41-1.41 7.07-7.07 1.41 1.41zm-12.02.71l1.42-1.42 1.41 1.42-1.41 1.41c-1.96 1.96-1.96 5.12 0 7.07 1.95 1.96 5.11 1.96 7.07 0l1.41-1.41 1.42 1.41-1.42 1.42c-2.73 2.73-7.16 2.73-9.9 0-2.73-2.74-2.73-7.17 0-9.9z"></path>
                        </g>
                    </svg>
                    <span class="text"><?php _e('Copy link.', 'Farallon') ?></span> <span class="link"><?php the_permalink(); ?></span>
                </div>
            <?php endif; ?>
            <div class="tag--list">
                <?php the_tags('', '') ?>
            </div>
            <?php if ($farallonSetting->get_setting('bio')) get_template_part('template-parts/author', 'card'); ?>
            <?php if ($farallonSetting->get_setting('category_card')) get_template_part('template-parts/category', 'card'); ?>
            <?php if ($farallonSetting->get_setting('related')) get_template_part('template-parts/single', 'related'); ?>
            <div class="post--ingle__comments">
                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </div>
            <?php if ($farallonSetting->get_setting('post_navigation')) get_template_part('template-parts/post', 'navigation');
            ?>
        </article>
    <?php endwhile; ?>
    <?php if (is_active_sidebar('singlefooterbar')) : ?>
        <section class="footer--bar">
            <?php dynamic_sidebar('singlefooterbar'); ?>
        </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>