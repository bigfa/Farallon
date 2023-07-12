<?php get_header(); ?>
<header class="archive-header" data-id="<?php echo get_queried_object()->term_id; ?>">
    <svg viewBox="0 0 24 24" fill="none" height="24" width="24">
        <circle cx="12" cy="12" r="10" stroke="currentColor"></circle>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20zm3.94-14.84l.14-1-.88.48-5.9 3.2-.22.12-.03.24-.99 6.64-.14.99.88-.48 5.9-3.2.22-.11.03-.25.99-6.63zM9.2 16l.72-4.85 3.59 2.51L9.2 16zm1.3-5.67l3.58 2.51L14.8 8l-4.3 2.33z" fill="currentColor"></path>
    </svg>
    <h1 class="archive-title"><?php single_term_title('', true); ?></h1>
    <?php the_archive_description('<div class="taxonomy-description">', '</div>'); ?>
</header>
<main class="site--main">
    <?php if (have_posts()) :
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', get_post_format());
        endwhile;
    endif;
    ?>
    <?php get_template_part('template-parts/pagination'); ?>
</main>

<?php get_footer(); ?>