<?php
/*
Template Name: Links
Template Post Type: page
*/
get_header();
?>

<div class="template--links">
    <?php while (have_posts()) : the_post(); ?>
        <h2 class="hero--title"><?php the_title(); ?></h2>
        <div class="template--linksWrap">
            <?php echo get_link_items(); ?>
        </div>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>