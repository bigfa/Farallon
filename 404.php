<?php get_header(); ?>

<section class="template--404">
    <div class="error--text">404</div>
    <div class="error--posts">
        <?php $the_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 6));
        while ($the_query->have_posts()) : $the_query->the_post();
            get_template_part('template-parts/content', 'error');
        endwhile; ?>
    </div>
</section>

<?php get_footer(); ?>