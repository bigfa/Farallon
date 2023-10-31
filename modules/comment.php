<?php

class farallonComment
{

    public function __construct()
    {
        global $farallonSetting;
        add_action('rest_api_init', array($this, 'register_routes'));
        if ($farallonSetting->get_setting('show_parent'))
            add_filter('get_comment_text',  array($this, 'hack_get_comment_text'), 0, 2);
    }

    function register_routes()
    {
        register_rest_route('farallon/v1', '/comment', array(
            'methods' => 'POST',
            'callback' => array($this, 'handle_coment_post'),
            'permission_callback' => '__return_true',
        ));

        register_rest_route('farallon/v1', '/view', array(
            'methods' => 'get',
            'callback' => array($this, 'handle_post_view'),
            'permission_callback' => '__return_true',
        ));

        register_rest_route('farallon/v1', '/like', array(
            'methods' => 'POST',
            'callback' => array($this, 'handle_post_like'),
            'permission_callback' => '__return_true',
        ));

        register_rest_route('farallon/v1', '/archive/(?P<id>\d+)', array(
            'methods' => 'POST',
            'callback' => array($this, 'handle_archive_view'),
            'permission_callback' => '__return_true',
        ));

        register_rest_route('farallon/v1', '/posts', array(
            'methods' => 'get',
            'callback' => array($this, 'handle_posts_request'),
            'permission_callback' => '__return_true',
        ));
    }

    function handle_posts_request($request)
    {
        $page = $request['page'];
        $query_args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => $page,
            'posts_per_page' => get_option('posts_per_page'),
        );
        $the_query = new WP_Query($query_args);
        $data = [];
        while ($the_query->have_posts()) {
            $the_query->the_post();
            global $post;
            $data[] = [
                'id' => get_the_ID(),
                'post_title' => get_the_title(),
                'date' => get_the_date(),
                'excerpt' => mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 150, "..."),
                'author' => get_the_author(),
                'author_avatar_urls' => get_avatar_url(get_the_author_meta('ID'), array('size' => 64)),
                'comment_count' => get_comments_number(),
                'view_count' => (int)get_post_meta(get_the_ID(), FARALLON_POST_VIEW_KEY, true),
                'like_count' => (int)get_post_meta(get_the_ID(), FARALLON_POST_LIKE_KEY, true),
                'thumbnail' => farallon_get_background_image(get_the_ID(), 300, 200),
                'permalink' => get_permalink(),
                'categories' => get_the_category(),
                'tags' => get_the_tags(),
                'has_image' => farallon_is_has_image(get_the_ID()),
            ];
        }


        return [
            'code' => 200,
            'message' => __('Success', 'Farallon'),
            'data' => $data
        ];
    }

    function handle_archive_view($request)
    {
        $term = get_term($request['id']);
        if (is_wp_error($term)) {
            return [
                'code' => 500,
                'message' => $term->get_error_message()
            ];
        }
        $views = (int)get_term_meta($request['id'], FARALLON_ARCHIVE_VIEW_KEY, true);
        $views++;
        update_term_meta($request['id'], FARALLON_ARCHIVE_VIEW_KEY, $views);
        return [
            'code' => 200,
            'message' => __('Success', 'Farallon'),
            'data' => $views
        ];
    }


    function hack_get_comment_text($comment_text, $comment)
    {
        if (!is_comment_feed() && $comment->comment_parent) {
            $parent = get_comment($comment->comment_parent);
            if ($parent) {
                $parent_link = esc_url(get_comment_link($parent));
                $name        = get_comment_author($parent);

                $comment_text =
                    '<a href="' . $parent_link . '" class="comment--parent__link">@' . $name . '</a>'
                    . $comment_text;
            }
        }
        return $comment_text;
    }

    function handle_post_view($data)
    {
        $post_id = $data['id'];
        $post_views = (int)get_post_meta($post_id, FARALLON_POST_VIEW_KEY, true);
        $post_views++;
        update_post_meta($post_id, FARALLON_POST_VIEW_KEY, $post_views);
        return [
            'code' => 200,
            'message' => __('Success', 'Farallon'),
            'data' => $post_views
        ];
    }

    function handle_post_like($request)
    {
        $post_id = $request['id'];
        $post_views = (int)get_post_meta($post_id, FARALLON_POST_LIKE_KEY, true);
        $post_views++;
        update_post_meta($post_id, FARALLON_POST_LIKE_KEY, $post_views);
        return [
            'code' => 200,
            'message' => __('Success', 'Farallon'),
            'data' => $post_views
        ];
    }

    function handle_coment_post($request)
    {
        $comment = wp_handle_comment_submission(wp_unslash($request));
        if (is_wp_error($comment)) {
            $data = $comment->get_error_data();
            if (!empty($data)) {
                return [
                    'code' => 500,
                    'message' => $data
                ];
            } else {
                return [
                    'code' => 500
                ];
            }
        }
        $user = wp_get_current_user();
        do_action('set_comment_cookies', $comment, $user);
        $GLOBALS['comment'] = $comment;
        return [
            'code' => 200,
            'message' => __('Success', 'Farallon'),
            'data' =>  [
                'author_avatar_urls' => get_avatar_url($comment->comment_author_email, array('size' => 64)),
                'comment_author' => $comment->comment_author,
                'comment_author_email' => $comment->comment_author_email,
                'comment_author_url' => $comment->comment_author_url,
                'comment_content' => get_comment_text($comment->comment_ID),
                'comment_date' => date('Y-m-d', strtotime($comment->comment_date)),
                'comment_date_gmt' => $comment->comment_date_gmt,
                'comment_ID' => $comment->comment_ID,
            ]
        ];
    }
}

new farallonComment();
