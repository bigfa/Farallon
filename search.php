<?php get_header(); ?>

<header class="archive-header archive-header__search">
    <?php get_search_form(); ?>
</header>
<main class="site--main">
    <?php if (have_posts()) :
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', get_post_format());
        endwhile;
    endif; ?>
    <?php get_template_part('template-parts/pagination'); ?>
</main>

<?php get_footer(); ?>