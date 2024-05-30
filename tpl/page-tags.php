<?php
/*
Template Name: Tags
*/
get_header(); ?>

<div class="template--terms">
    <?php while (have_posts()) : the_post(); ?>
        <article class="post--single__douban">
            <header class="u-textAlignCenter">
                <h2 class="post--single__title"><?php the_title(); ?></h2>
            </header>
            <div class="tagCard">
                <?php $categories = get_terms([
                    'taxonomy' => 'post_tag',
                    'hide_empty' => false,
                    // 'orderby' => 'meta_value_num',
                    'order' => 'DESC',
                    // 'meta_key' => '_views',
                ]);
                foreach ($categories as $category) {
                    $link = get_term_link($category, 'category')
                ?>
                    <a class="tagCard--item" title="<?php echo $category->name; ?>" aria-label="<?php echo $category->name; ?>" href="<?php echo $link; ?>" data-count="<?php echo $category->count; ?>">
                        <div class="tagCard--title"><?php echo $category->name; ?></div>
                    </a>
                <?php } ?>
            </div>
        </article>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>