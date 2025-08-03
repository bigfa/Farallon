<?php
/*
Template Name: Links
Template Post Type: page
*/
get_header();
?>


<main class="site--main">
    <article class="fArticle" itemscope="itemscope" itemtype="http://schema.org/Article">
        <?php while (have_posts()) : the_post(); ?>
            <header class="fArticle--header">
                <h2 class="fArticle--headline" itemprop="headline"><?php the_title(); ?></h2>
            </header>
            <?php echo get_link_items(); ?>
        <?php endwhile; ?>
    </article>
</main>

<?php get_footer(); ?>