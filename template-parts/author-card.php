<?php
global $farallonSetting; ?>
<div class="author--card">
    <?php echo get_avatar(get_the_author_meta('ID'), 64); ?>
    <div class="author--name"><?php the_author(); ?></div>
    <div class="author--description"><?php the_author_meta('description'); ?></div>
    <?php
    if ($farallonSetting->get_setting('author_sns')) : ?>
        <div class="author--sns">
            <?php get_template_part('template-parts/sns'); ?>
        </div>
    <?php endif; ?>
</div>