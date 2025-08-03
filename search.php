<?php get_header(); ?>

<header class="fSearch--header">
    <?php get_search_form(); ?>
</header>
<main class="site--main">
    <?php if (have_posts()) :
        echo '<div class="fBlock--list js-post-list">';
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', get_post_format());
        endwhile;
        echo '</div>';
    endif; ?>
    <?php get_template_part('template-parts/pagination'); ?>
</main>

<?php get_footer(); ?>