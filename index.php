<?php get_header(); ?>

<main class="site--main">
    <?php if (is_active_sidebar('topbar')) : ?>
        <section class="top--bar">
            <?php dynamic_sidebar('topbar'); ?>
        </section>
    <?php endif; ?>
    <?php if (have_posts()) :
        echo '<div class="fBlock--list js-post-list">';
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', get_post_format());
        endwhile;
        echo '</div>';
        get_template_part('template-parts/pagination');
    endif; ?>
    <?php if (is_active_sidebar('footerbar')) : ?>
        <section class="footer--bar">
            <?php dynamic_sidebar('footerbar'); ?>
        </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>