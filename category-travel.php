<?php get_header(); ?>

<header class="archive-header">
    <?php if (get_term_meta(get_queried_object_id(), '_thumb', true)) : ?>
        <img src="<?php echo get_term_meta(get_queried_object_id(), '_thumb', true); ?>" alt="<?php single_term_title('', true); ?>" class="archive-header-image">
    <?php endif; ?>
    <div class="archive-header-content">
        <h1 class="archive-title"><?php single_term_title('', true); ?></h1>
        <?php the_archive_description('<div class="taxonomy-description">', '</div>'); ?>
    </div>
</header>
<main class="site--main">
    <?php if (have_posts()) : ?>
        <div class="post--cards">
            <?php while (have_posts()) : the_post();
                get_template_part('template-parts/content', 'card');
            endwhile; ?>
        </div>
    <?php get_template_part('template-parts/pagination');
    endif; ?>
</main>

<?php get_footer(); ?>