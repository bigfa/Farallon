<?php get_header(); ?>

<main class="site--main">
    <article class="post--single" itemscope="itemscope" itemtype="http://schema.org/Article">
        <?php while (have_posts()) : the_post(); ?>
            <h2 class="post--single__title" itemprop="headline"><?php the_title(); ?></h2>
            <div class="post__single__content graph" itemprop="articleBody">
                <?php the_content(); ?>
            </div>
            <?php wp_link_pages(array(
                'before'      => '<div class="nav-links nav-links__comment">',
                'after'       => '</div>',
                'link_before' => '<span class="page-numbers">',
                'link_after'  => '</span>',
                'pagelink'    => '%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            )); ?>
            <?php if ($farallonSetting->get_setting('update_time')) : ?>
                <div class="post--single__update">
                    <span class="text"><?php _e('Updated on', 'Farallon') ?></span>
                    <time datetime="<?php echo get_the_modified_time('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_time('Y-m-d'); ?></time>
                </div>
            <?php endif; ?>
            <div class="post__single__comments">
                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </div>
        <?php endwhile; ?>
    </article>
</main>

<?php get_footer(); ?>