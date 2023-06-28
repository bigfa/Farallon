<?php
/*
Template Name: Douban
Template Post Type: page
*/
get_header();
?>
<div class="template--douban">
    <?php while (have_posts()) : the_post(); ?>
        <h2 class="hero--title"><?php the_title(); ?></h2>
        <div class="graph">
            <?php the_content(); ?>
        </div>
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>