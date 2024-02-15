<?php
/*
Template Name: Terms
*/
get_header(); ?>
<div class="template--terms">
    <?php while (have_posts()) : the_post(); ?>
        <header class="page--header">
            <h2 class="hero--title"><?php the_title(); ?></h2>
        </header>
        <div class="collectionCard">
            <?php $categories = get_terms([
                'taxonomy' => 'category',
                'hide_empty' => false,
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'meta_key' => '_views',
            ]);
            foreach ($categories as $category) {
                $link = get_term_link($category, 'category')
            ?>
                <div class="collectionCard--item">
                    <?php if (get_term_meta($category->term_id, '_thumb', true)) : ?>
                        <img class="collectionCard--image" alt="<?php echo $category->name; ?>" aria-label="<?php echo $category->name; ?>" src="<?php echo get_term_meta($category->term_id, '_thumb', true); ?>">
                    <?php endif ?>
                    <div class="collectionCard--meta">
                        <div class="collectionCard--title"><a title="<?php echo $category->name; ?>" aria-label="<?php echo $category->name; ?>" href="<?php echo $link; ?>"><?php echo $category->name; ?></a>
                        </div>
                        <div class="collectionCard--description"><?php echo $category->description; ?></div>

                    </div>
                    <!-- <div class="collectionCard--count"><?php echo $category->count; ?></div> -->
                </div>
            <?php } ?>
        </div>
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>