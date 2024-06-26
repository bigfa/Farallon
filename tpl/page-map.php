<?php
/*
Template Name: Map
Template Post Type: page
*/
get_header(); ?>

<main class="site--main site--main__map">
    <?php while (have_posts()) : the_post(); ?>
        <article class="post--single__douban">
            <header class="u-textAlignCenter">
                <h2 class="post--single__title"><?php the_title(); ?></h2>
            </header>
            <div class="post__single__content">
                <?php the_content(); ?>
            </div>
            <div class="post__single__comments">
                <?php if (comments_open() || get_comments_number()) :
                    comments_template();
                endif; ?>
            </div>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>