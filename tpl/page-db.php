<?php
/*
Template Name: Double Column
Template Post Type: post,page
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
            <?php
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
        <?php endwhile; ?>
    </div>
    <?php get_sidebar('single'); ?>
</div>
<?php get_footer(); ?>