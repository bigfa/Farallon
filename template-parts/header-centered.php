<header class="header--centered">
    <h2 class="post--single__title" itemprop="headline"><?php the_title(); ?></h2>
    <div class="post--single__meta"><time class="humane--time" itemprop="datePublished" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('Y-m-d'); ?></time> · <?php the_category(',') ?> · <?php echo (int)get_post_meta(get_the_ID(), FARALLON_POST_VIEW_KEY, true) . __(' views', 'Farallon'); ?></div>
</header>