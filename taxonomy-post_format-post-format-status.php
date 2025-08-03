<?php get_header(); ?>

<main class="site--main">
    <?php if (have_posts()) :
        echo '<div class="fStatus--list">';
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', get_post_format());
        endwhile;
        echo '</div>';
        get_template_part('template-parts/pagination');
    endif; ?>
</main>

<?php get_footer(); ?>