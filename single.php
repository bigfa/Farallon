<?php get_header(); ?>

<main class="site--main">
    <?php while (have_posts()) : the_post(); ?>
        <article class="post--single">
            <div class="post--single__meta"><?php the_time(); ?></div>
            <h2 class="post--single__title"><?php the_title(); ?></h2>
            <div class="post__single__content graph">
                <?php the_content(); ?>
            </div>
            <div class="post__single__comments">
                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </div>
        </article>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>