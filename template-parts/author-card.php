<?php
global $farallonSetting; ?>
<div class="author--card">
    <?php echo get_avatar(get_the_author_meta('ID'), 64); ?>
    <div class="author--name"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a></div>
    <div class="author--description"><?php the_author_meta('description'); ?></div>
    <?php
    if ($farallonSetting->get_setting('author_sns')) : ?>
        <div class="author--sns">
            <?php get_template_part('template-parts/sns'); ?>
        </div>
    <?php endif; ?>
</div>