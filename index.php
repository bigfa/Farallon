<?php get_header(); ?>

<main class="site--main">
    <?php if (is_active_sidebar('topbar')) : ?>
        <section class="top--bar">
            <?php dynamic_sidebar('topbar'); ?>
        </section>
    <?php endif; ?>
    <?php if (have_posts()) :
        while (have_posts()) : the_post();

            get_template_part('template-parts/content', get_post_format());

        endwhile;
    endif;
    ?>
    <?php get_template_part('template-parts/pagination'); ?>
</main>

<?php get_footer(); ?>