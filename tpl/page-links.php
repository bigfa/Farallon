<?php
/*
Template Name: Links
Template Post Type: page
*/
get_header();
?>
<div class="layoutMultiColumn-container u-paddingTop50 article--double">
    <div class="layoutMultiColumn layoutMultiColumn--primary">
        <?php while (have_posts()) : the_post(); ?>
            <h2><?php the_title(); ?></h2>
            <div class="graph">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php get_footer(); ?>