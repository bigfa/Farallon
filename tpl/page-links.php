<?php
/*
Template Name: Links
Template Post Type: page
*/
get_header();
?>


<main class="site--main">
    <article class="page--single" itemscope="itemscope" itemtype="http://schema.org/Article">
        <?php while (have_posts()) : the_post(); ?>
            <header class="u-textAlignCenter">
                <h2 class="post--single__title" itemprop="headline"><?php the_title(); ?></h2>
            </header>
            <?php echo get_link_items(); ?>
        <?php endwhile; ?>
    </article>
</main>

<?php get_footer(); ?>