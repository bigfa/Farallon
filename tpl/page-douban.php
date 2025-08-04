<?php
/*
Template Name: Douban
Template Post Type: page
*/
get_header(); ?>

<main class="site--main">
    <?php while (have_posts()) : the_post(); ?>
        <article class="fArticle fArticle--wide" itemscope="itemscope" itemtype="http://schema.org/Article">
            <header class="fArticle--header">
                <h2 class="fArticle--headline" itemprop="headline"><?php the_title(); ?></h2>
            </header>
            <div class="fArticle--content">
                <?php the_content(); ?>
            </div>
            <?php if (comments_open() || get_comments_number()) :
                comments_template();
            endif; ?>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>