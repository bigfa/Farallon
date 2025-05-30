<?php global $farallonSetting; ?>
<article class="post--card" itemtype="http://schema.org/Article" itemscope="itemscope">
    <?php if (farallon_is_has_image(get_the_ID())  || $farallonSetting->get_setting('always_home_cover')) : ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>" class="cover--link">
            <?php do_action('marker_pro_post_meta'); ?>
            <img src="<?php echo farallon_get_background_image(get_the_ID(), 600, 360); ?>" class="cover" alt="<?php the_title(); ?>" />
        </a>
    <?php endif; ?>
    <div class="content">
        <div class="date">
            <?php echo get_the_date('d'); ?>
        </div>
        <h2 class="post--title" itemprop="headline">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>"><?php the_title(); ?></a>
        </h2>
        <div class="description" itemprop="about">
            <?php
            if (has_excerpt()) {
                echo get_the_excerpt();
            } else {
                echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 90, "...");
            } ?>
        </div>
        <div class="meta">
            <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                <path d="M512 97.52381c228.912762 0 414.47619 185.563429 414.47619 414.47619s-185.563429 414.47619-414.47619 414.47619S97.52381 740.912762 97.52381 512 283.087238 97.52381 512 97.52381z m0 73.142857C323.486476 170.666667 170.666667 323.486476 170.666667 512s152.81981 341.333333 341.333333 341.333333 341.333333-152.81981 341.333333-341.333333S700.513524 170.666667 512 170.666667z m36.571429 89.697523v229.86362h160.865523v73.142857H512a36.571429 36.571429 0 0 1-36.571429-36.571429V260.388571h73.142858z"></path>
            </svg>
            <time itemprop="datePublished" datetime="<?php echo get_the_date('c'); ?>" class="humane--time">
                <?php echo get_the_date('Y-m-d'); ?>
            </time>
            <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                <path d="M669.013333 596.21181l194.389334 226.791619A77.433905 77.433905 0 0 1 804.59581 950.857143H212.016762a77.433905 77.433905 0 0 1-58.782476-127.853714l194.413714-226.791619c22.918095 13.897143 47.737905 24.941714 74.044952 32.597333l-209.67619 244.614095h592.579048l-209.676191-244.614095a308.102095 308.102095 0 0 0 74.069333-32.597333zM508.294095 73.142857c142.57981 0 258.145524 115.565714 258.145524 258.145524 0 142.57981-115.565714 258.145524-258.145524 258.145524-142.57981 0-258.145524-115.565714-258.145524-258.145524C250.148571 188.732952 365.714286 73.142857 508.318476 73.142857z m0 77.433905a180.711619 180.711619 0 1 0 0 361.423238 180.711619 180.711619 0 0 0 0-361.423238z"></path>
            </svg>
            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a>
            <?php if (!is_category()) : ?>
                <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                    <path d="M408.551619 97.52381a73.142857 73.142857 0 0 1 51.736381 21.430857L539.306667 197.973333A73.142857 73.142857 0 0 0 591.067429 219.428571H804.571429a73.142857 73.142857 0 0 1 73.142857 73.142858v560.761904a73.142857 73.142857 0 0 1-73.142857 73.142857H219.428571a73.142857 73.142857 0 0 1-73.142857-73.142857V170.666667a73.142857 73.142857 0 0 1 73.142857-73.142857h189.123048z m0 73.142857H219.428571v682.666666h585.142858V292.571429h-213.504a146.285714 146.285714 0 0 1-98.499048-38.13181L487.619048 249.734095 408.551619 170.666667zM365.714286 633.904762v73.142857h-73.142857v-73.142857h73.142857z m365.714285 0v73.142857H414.47619v-73.142857h316.952381z m-365.714285-195.047619v73.142857h-73.142857v-73.142857h73.142857z m365.714285 0v73.142857H414.47619v-73.142857h316.952381z"></path>
                </svg>
                <?php the_category(','); ?>
            <?php endif; ?>
        </div>
    </div>
</article>