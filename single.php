<?php get_header();
global $farallonSetting;
?>

<main class="site--main">
    <?php while (have_posts()) : the_post(); ?>
        <article class="post--single" itemscope="itemscope" itemtype="http://schema.org/Article">
            <div class="post--single__meta"><time class="humane--time" itemprop="datePublished" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('Y-m-d'); ?></time> / <?php the_category(',') ?> / <?php echo (int)get_post_meta(get_the_ID(), FARALLON_POST_VIEW_KEY, true); ?> 浏览</div>
            <h2 class="post--single__title" itemprop="headline"><?php the_title(); ?></h2>
            <div class="post--single__content graph" itemprop="articleBody">
                <?php the_content(); ?>
            </div>
            <div class="post--single__action">
                <button class="button--like like-btn" aria-label="like the post">
                    <svg class="icon--active" viewBox="0 0 1024 1024" width="32" height="32">
                        <path d="M780.8 204.8c-83.2-44.8-179.2-19.2-243.2 44.8L512 275.2 486.4 249.6c-64-64-166.4-83.2-243.2-44.8C108.8 275.2 89.6 441.6 185.6 537.6l32 32 153.6 153.6 102.4 102.4c25.6 25.6 57.6 25.6 83.2 0l102.4-102.4 153.6-153.6 32-32C934.4 441.6 915.2 275.2 780.8 204.8z"></path>
                    </svg>
                    <svg class="icon--default" viewBox="0 0 1024 1024" width="32" height="32">
                        <path d="M332.8 249.6c38.4 0 83.2 19.2 108.8 44.8L467.2 320 512 364.8 556.8 320l25.6-25.6c32-32 70.4-44.8 108.8-44.8 19.2 0 38.4 6.4 57.6 12.8 44.8 25.6 70.4 57.6 76.8 108.8 6.4 44.8-6.4 89.6-38.4 121.6L512 774.4 236.8 492.8C204.8 460.8 185.6 416 192 371.2c6.4-44.8 38.4-83.2 76.8-108.8C288 256 313.6 249.6 332.8 249.6L332.8 249.6M332.8 185.6C300.8 185.6 268.8 192 243.2 204.8 108.8 275.2 89.6 441.6 185.6 537.6l281.6 281.6C480 832 499.2 838.4 512 838.4s32-6.4 38.4-19.2l281.6-281.6c96-96 76.8-262.4-57.6-332.8-25.6-12.8-57.6-19.2-89.6-19.2-57.6 0-115.2 25.6-153.6 64L512 275.2 486.4 249.6C448 211.2 390.4 185.6 332.8 185.6L332.8 185.6z"></path>
                    </svg>
                </button>
            </div>
            <div class="share--action">
                复制本文链接 <span><?php the_permalink(); ?></span>
            </div>
            <div class="tag--list">
                <?php the_tags('', '') ?>
            </div>
            <?php if ($farallonSetting->get_setting('bio')) get_template_part('template-parts/author', 'card'); ?>
            <?php if ($farallonSetting->get_setting('related')) get_template_part('template-parts/single', 'related'); ?>
            <div class="post--ingle__comments">
                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </div>
            <?php //get_template_part('template-parts/post', 'navigation'); 
            ?>
        </article>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>