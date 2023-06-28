<?php
/*
Template Name: Map
 */
get_header();
?>
<div class="template--map">
    <?php while (have_posts()) : the_post(); ?>
        <h2 class="hero--title"><?php the_title(); ?></h2>
        <?php if (function_exists('marker_pro_init')) marker_pro_init(); ?>
    <?php endwhile; ?>
</div>
<?php get_footer('clean'); ?>