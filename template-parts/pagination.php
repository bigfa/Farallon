<?php
global $farallonSetting;
global $wp_query;
if ($farallonSetting->get_setting('loadmore')) {
    if ($wp_query->max_num_pages <= 1) {
        return;
    } else {
        $data = '';
        if (is_category()) {
            $data .= 'data-category="' . get_queried_object()->term_id . '"';
        }

        if (is_tag()) {
            $data .= 'data-tag="' . get_queried_object()->term_id . '"';
        }

        if (is_author()) {
            $data .= 'data-author="' . get_queried_object()->ID . '"';
        }

        echo '<div class="nav-links">
        <span class="loadmore"' . $data . '>' . __('loadmore', 'Farallon') . '</span>
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
