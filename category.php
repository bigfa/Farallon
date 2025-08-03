<?php get_header(); ?>

<header class="fTerm--header">
    <?php if (get_term_meta(get_queried_object_id(), '_thumb', true)) : ?>
        <img src="<?php echo get_term_meta(get_queried_object_id(), '_thumb', true); ?>" alt="<?php single_term_title('', true); ?>" class="fTerm--cover">
    <?php endif; ?>
    <div class="fTerm--content">
        <h1 class="fTerm--title"><?php single_term_title('', true); ?></h1>
        <?php the_archive_description('<div class="fTerm--description">', '</div>'); ?>
    </div>
</header>
<main class="site--main">
    <?php if (have_posts()) :
        echo '<div class="fBlock--list js-post-list">';
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', get_post_format());
        endwhile;
        echo '</div>';
        get_template_part('template-parts/pagination');
    endif; ?>
</main>

<?php get_footer(); ?>