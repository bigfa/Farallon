<?php
global $farallonSetting;
global $wp_query;
if (!$farallonSetting->get_setting('loadmore')) {
    if ($wp_query->max_num_pages <= 1) {
        return;
    } else {
        echo '<div class="nav-links">
        <span class="loadmore">加载更多</span>
        </div>';
    }
} else {
    echo get_the_posts_pagination(
        array(
            'mid_size'  => 1,
            'class' => '',
            'prev_next' => false
        )
    );
}
