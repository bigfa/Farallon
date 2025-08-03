<?php get_header(); ?>

<header class="fTerm--header" data-id="<?php echo get_queried_object()->term_id; ?>">
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
    endif; ?>
    <?php get_template_part('template-parts/pagination'); ?>
</main>

<?php get_footer(); ?>