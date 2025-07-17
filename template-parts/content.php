<?php global $farallonSetting; ?>
<article class="post--item" itemtype="http://schema.org/Article" itemscope="itemscope">
    <div class="content">
        <h2 class="post--title" itemprop="headline">
            <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                <?php the_title(); ?>
                <?php if (is_sticky()) : ?>
                    <span class="sticky--post"><?php _e('Sticky', 'Farallon'); ?></span>
                <?php endif; ?>
            </a>
        </h2>
        <div class="description" itemprop="about">
            <?php
            if (has_excerpt()) {
                echo get_the_excerpt();
            } else {
                echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 150, "...");
            } ?>
        </div>
        <div class="meta">
            <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                <path d="M512 97.52381c228.912762 0 414.47619 185.563429 414.47619 414.47619s-185.563429 414.47619-414.47619 414.47619S97.52381 740.912762 97.52381 512 283.087238 97.52381 512 97.52381z m0 73.142857C323.486476 170.666667 170.666667 323.486476 170.666667 512s152.81981 341.333333 341.333333 341.333333 341.333333-152.81981 341.333333-341.333333S700.513524 170.666667 512 170.666667z m36.571429 89.697523v229.86362h160.865523v73.142857H512a36.571429 36.571429 0 0 1-36.571429-36.571429V260.388571h73.142858z"></path>
            </svg>
            <time itemprop="datePublished" datetime="<?php echo get_the_date('c'); ?>">
                <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .  __('ago', 'Farallon'); ?>
            </time>
            <?php if ($farallonSetting->get_setting('home_author')) : ?>
                <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                    <path d="M669.013333 596.21181l194.389334 226.791619A77.433905 77.433905 0 0 1 804.59581 950.857143H212.016762a77.433905 77.433905 0 0 1-58.782476-127.853714l194.413714-226.791619c22.918095 13.897143 47.737905 24.941714 74.044952 32.597333l-209.67619 244.614095h592.579048l-209.676191-244.614095a308.102095 308.102095 0 0 0 74.069333-32.597333zM508.294095 73.142857c142.57981 0 258.145524 115.565714 258.145524 258.145524 0 142.57981-115.565714 258.145524-258.145524 258.145524-142.57981 0-258.145524-115.565714-258.145524-258.145524C250.148571 188.732952 365.714286 73.142857 508.318476 73.142857z m0 77.433905a180.711619 180.711619 0 1 0 0 361.423238 180.711619 180.711619 0 0 0 0-361.423238z"></path>
                </svg><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a>
            <?php endif; ?>
            <?php if ($farallonSetting->get_setting('home_cat')) : ?>
                <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                    <path d="M408.551619 97.52381a73.142857 73.142857 0 0 1 51.736381 21.430857L539.306667 197.973333A73.142857 73.142857 0 0 0 591.067429 219.428571H804.571429a73.142857 73.142857 0 0 1 73.142857 73.142858v560.761904a73.142857 73.142857 0 0 1-73.142857 73.142857H219.428571a73.142857 73.142857 0 0 1-73.142857-73.142857V170.666667a73.142857 73.142857 0 0 1 73.142857-73.142857h189.123048z m0 73.142857H219.428571v682.666666h585.142858V292.571429h-213.504a146.285714 146.285714 0 0 1-98.499048-38.13181L487.619048 249.734095 408.551619 170.666667zM365.714286 633.904762v73.142857h-73.142857v-73.142857h73.142857z m365.714285 0v73.142857H414.47619v-73.142857h316.952381z m-365.714285-195.047619v73.142857h-73.142857v-73.142857h73.142857z m365.714285 0v73.142857H414.47619v-73.142857h316.952381z"></path>
                </svg>
                <?php the_category(','); ?>
            <?php endif; ?>
            <?php if ($farallonSetting->get_setting('home_like') && get_post_meta(get_the_ID(), FARALLON_POST_LIKE_KEY, true)) : ?>
                <svg class="icon" viewBox="0 0 1024 1024" width="16" height="16">
                    <path d="M885.9 533.7c16.8-22.2 26.1-49.4 26.1-77.7 0-44.9-25.1-87.4-65.5-111.1a67.67 67.67 0 0 0-34.3-9.3H572.4l6-122.9c1.4-29.7-9.1-57.9-29.5-79.4-20.5-21.5-48.1-33.4-77.9-33.4-52 0-98 35-111.8 85.1l-85.9 311H144c-17.7 0-32 14.3-32 32v364c0 17.7 14.3 32 32 32h601.3c9.2 0 18.2-1.8 26.5-5.4 47.6-20.3 78.3-66.8 78.3-118.4 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7 0-12.6-1.8-25-5.4-37 16.8-22.2 26.1-49.4 26.1-77.7-0.2-12.6-2-25.1-5.6-37.1zM184 852V568h81v284h-81z m636.4-353l-21.9 19 13.9 25.4c4.6 8.4 6.9 17.6 6.9 27.3 0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4c4.6 8.4 6.9 17.6 6.9 27.3 0 16.5-7.2 32.2-19.6 43l-21.9 19 13.9 25.4c4.6 8.4 6.9 17.6 6.9 27.3 0 22.4-13.2 42.6-33.6 51.8H329V564.8l99.5-360.5c5.2-18.9 22.5-32.2 42.2-32.3 7.6 0 15.1 2.2 21.1 6.7 9.9 7.4 15.2 18.6 14.6 30.5l-9.6 198.4h314.4C829 418.5 840 436.9 840 456c0 16.5-7.2 32.1-19.6 43z"></path>
                </svg>
                <?php echo (int)get_post_meta(get_the_ID(), FARALLON_POST_LIKE_KEY, true); ?>
            <?php endif; ?>
        </div>
    </div>
    <?php if ((farallon_is_has_image(get_the_ID()) && !$farallonSetting->get_setting('hide_home_cover')) || $farallonSetting->get_setting('always_home_cover')) : ?>
        <a href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>" class="cover--link">
            <img src="<?php echo farallon_get_background_image(get_the_ID(), 300, 200); ?>" class="cover" alt="<?php the_title(); ?>" />
            <?php do_action('marker_pro_post_meta'); ?>
            <?php if ($farallonSetting->get_setting('home_image_count') && farallon_get_post_image_count(get_the_ID()) > 1) : ?>
                <div class="cover--count"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 14 14">
                        <rect width="11.976" height="11.944" x="1.362" y="1.276" fill-opacity="0.96" stroke="#ffffff" rx="1.5"></rect>
                        <path fill="#ffffff" stroke="#ffffff" d="M5.904 10.746 9.67 6.98l2.757 2.758.657 2.382c-.02.178-.135.393-.355.585-.241.21-.536.326-.77.326H2.55c-.206 0-.448-.112-.652-.332a1.17 1.17 0 0 1-.308-.614l.707-1.394 1.421-1.422 1.477 1.478.354.354zM6.192 6.461a.856.856 0 1 1-1.712 0 .856.856 0 0 1 1.712 0Z"></path>
                    </svg><?php echo farallon_get_post_image_count(get_the_ID()); ?></div>
            <?php endif; ?>
        </a>
    <?php endif; ?>
</article>