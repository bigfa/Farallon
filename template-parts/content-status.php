<article class="post--item post--item__status" itemtype="http://schema.org/Article" itemscope="itemscope">
    <div class="content">
        <header><?php echo get_avatar(get_the_author_meta('ID'), 48); ?><time itemprop="datePublished" datetime="<?php echo get_the_date('c'); ?>"><svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                    <path d="M512 97.52381c228.912762 0 414.47619 185.563429 414.47619 414.47619s-185.563429 414.47619-414.47619 414.47619S97.52381 740.912762 97.52381 512 283.087238 97.52381 512 97.52381z m0 73.142857C323.486476 170.666667 170.666667 323.486476 170.666667 512s152.81981 341.333333 341.333333 341.333333 341.333333-152.81981 341.333333-341.333333S700.513524 170.666667 512 170.666667z m36.571429 89.697523v229.86362h160.865523v73.142857H512a36.571429 36.571429 0 0 1-36.571429-36.571429V260.388571h73.142858z"></path>
                </svg><?php echo get_the_date('Y-m-d'); ?></time></header>
        <?php if (get_the_excerpt()) : ?>
            <div class="description" itemprop="about"><?php the_excerpt(); ?></div>
        <?php endif; ?>
    </div>
</article>