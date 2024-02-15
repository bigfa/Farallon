<?php get_header(); ?>
<?php $user = get_user_by('ID', 1);
?>
<div class="status--archive">
    <header class="status--header">
        <div class="widget-card-content"><?php echo $user->display_name; ?></div>
        <div class="widget-card-description">
            <p><?php echo $user->description; ?></p>
        </div>
    </header>
    <main class="site--main">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                get_template_part('template-parts/content', get_post_format());
            endwhile;
            get_template_part('template-parts/pagination');
        endif;
        ?>
    </main>
</div>
<?php get_footer(); ?>