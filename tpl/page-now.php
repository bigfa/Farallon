<?php
/*
Template Name: Now
Template Post Type: page
*/
get_header(); ?>

<main class="site--main">
    <article class="post--single template--now" itemscope="itemscope" itemtype="http://schema.org/Article">
        <?php while (have_posts()) : the_post(); ?>
            <header class="u-textAlignCenter">
                <h2 class="post--single__title" itemprop="headline"><?php the_title(); ?></h2>
            </header>
            <div class="post__single__content graph" itemprop="articleBody">
                <?php the_content(); ?>
                <div class="last--update">
                    <p>Last updated: <?php the_modified_date('F j, Y'); ?></p>
                </div>
            </div>
            <?php wp_link_pages(array(
                'before'      => '<div class="nav-links nav-links__comment">',
                'after'       => '</div>',
                'link_before' => '<span class="page-numbers">',
                'link_after'  => '</span>',
                'pagelink'    => '%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            )); ?>
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