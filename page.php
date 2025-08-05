<?php get_header(); ?>

<main class="site--main">
    <article class="fArticle" itemscope="itemscope" itemtype="http://schema.org/Article">
        <?php while (have_posts()) : the_post(); ?>
            <h2 class="fArticle--headline" itemprop="headline"><?php the_title(); ?></h2>
            <div class="fArticle--content fGraph" itemprop="articleBody">
                <?php the_content(); ?>
            </div>
            <?php wp_link_pages(array(
                'before'      => '<div class="nav-links nav-links__comment">',
                'after'       => '</div>',
                'link_before' => '<span class="page-numbers">',
                'link_after'  => '</span>',
                'pagelink'    => '%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            )); ?>
            <?php if ($farallonSetting->get_setting('update_time') && get_the_modified_time('c') != get_post_time('c')) : ?>
                <footer class="fArticle--footer">
                    <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                        <path d="M512 97.52381c228.912762 0 414.47619 185.563429 414.47619 414.47619s-185.563429 414.47619-414.47619 414.47619S97.52381 740.912762 97.52381 512 283.087238 97.52381 512 97.52381z m0 73.142857C323.486476 170.666667 170.666667 323.486476 170.666667 512s152.81981 341.333333 341.333333 341.333333 341.333333-152.81981 341.333333-341.333333S700.513524 170.666667 512 170.666667z m36.571429 89.697523v229.86362h160.865523v73.142857H512a36.571429 36.571429 0 0 1-36.571429-36.571429V260.388571h73.142858z">
                        </path>
                    </svg>
                    <span class="text"><?php _e('Updated on', 'Farallon') ?></span>
                    <time datetime="<?php echo get_the_modified_time('c'); ?>" itemprop="dateModified"><?php echo get_the_modified_time('Y-m-d'); ?></time>
                </footer>
            <?php endif; ?>
            <?php
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
        <?php endwhile; ?>
    </article>
</main>

<?php get_footer(); ?>