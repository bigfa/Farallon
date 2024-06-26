<?php get_header(); ?>

<header class="archive-header">
    <div class="archive-header-content">
        <h1 class="archive-title"><?php single_term_title('', true); ?></h1>
        <?php the_archive_description('<div class="taxonomy-description">', '</div>'); ?>
    </div>
</header>
<main class="site--main">
    <?php if (have_posts()) :
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', get_post_format());
        endwhile;
        get_template_part('template-parts/pagination');
    endif; ?>
</main>

<?php get_footer(); ?>