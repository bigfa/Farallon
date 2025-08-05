<?php

class farallonComment
{

    public function __construct()
    {
        global $farallonSetting;
        add_action('rest_api_init', array($this, 'register_routes'));
        if ($farallonSetting->get_setting('show_author') &&  !is_admin())
            add_filter('get_comment_author', array($this, 'get_comment_author_hack'), 10, 3);
        if ($farallonSetting->get_setting('show_parent'))
            add_filter('get_comment_text',  array($this, 'hack_get_comment_text'), 0, 2);
        if ($farallonSetting->get_setting('disable_comment_link'))
            add_filter('get_comment_author_link', array($this, 'get_comment_author_link_hack'), 10, 3);
        if ($farallonSetting->get_setting('friend_icon') && !is_admin())
            add_filter('get_comment_author', array($this, 'show_friend_icon'), 10, 3);
    }

    function is_friend($url = '')
    {
        if (empty($url)) {
            return false;
        }
        $urls = get_bookmarks();
        foreach ($urls as $bookmark) {
            // check if the url is contained in the bookmark
            if (strpos($bookmark->link_url, $url) !== false) {
                return true;
            }
        }
    }

    function show_friend_icon($comment_author, $comment_id, $comment)
    {
        $comment_author_url = $comment->comment_author_url;
        // get domain name
        $comment_author_url = parse_url($comment_author_url, PHP_URL_HOST);

        $is_friend = $this->is_friend($comment_author_url);
        // apply filter to allow customization
        $is_friend = apply_filters('farallon_is_friend', $is_friend, $comment_author_url, $comment_author, $comment_id);

        return $is_friend ?  $comment_author . '<svg viewBox="0 0 64 64" fill="none" role="presentation" aria-hidden="true" focusable="false" class="friend--icon" title="' . __('Friend of author.', 'Farallon') . '"><path fill-rule="evenodd" clip-rule="evenodd" d="M56.48 38.3C58.13 36.58 60 34.6 60 32c0-2.6-1.88-4.57-3.52-6.3-.95-.97-1.98-2.05-2.3-2.88-.33-.82-.35-2.17-.38-3.49-.02-2.43-.07-5.2-2-7.13-1.92-1.92-4.7-1.97-7.13-2h-.43c-1.17-.02-2.29-.04-3.07-.38-.87-.37-1.9-1.35-2.87-2.3C36.58 5.89 34.6 4 32 4c-2.6 0-4.57 1.88-6.3 3.53-.97.94-2.05 1.97-2.88 2.3-.82.32-2.17.34-3.49.37-2.43.03-5.2.08-7.13 2-1.92 1.93-1.97 4.7-2 7.13v.43c-.02 1.17-.04 2.29-.38 3.06-.37.88-1.35 1.9-2.3 2.88C5.89 27.43 4 29.4 4 32c0 2.6 1.88 4.58 3.53 6.3.94.98 1.97 2.05 2.3 2.88.32.82.34 2.17.37 3.49.03 2.43.08 5.2 2 7.13 1.93 1.93 4.7 1.98 7.13 2h.43c1.17.02 2.29.04 3.06.38.88.37 1.9 1.34 2.88 2.3C27.43 58.13 29.4 60 32 60c2.6 0 4.58-1.88 6.3-3.52.98-.95 2.05-1.98 2.88-2.3.82-.33 2.17-.35 3.49-.38 2.43-.02 5.2-.07 7.13-2 1.93-1.92 1.98-4.7 2-7.13v-.43c.02-1.17.04-2.29.38-3.07.37-.87 1.34-1.9 2.3-2.87zM33.1 45.15c-.66.47-1.55.47-2.22 0C27.57 42.8 18 35.76 18 28.9c0-6.85 6.5-10.25 13.26-4.45.43.37 1.05.37 1.48 0 6.76-5.8 13.27-2.4 13.26 4.45 0 6.56-9.57 13.9-12.89 16.24z" fill="#FFC017"></path></svg>' : $comment_author;
    }

    function get_comment_author_link_hack($comment_author_link, $comment_author, $comment_id)
    {
        return $comment_author;
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

    function get_comment_author_hack($comment_author, $comment_id, $comment)
    {
        $post = get_post($comment->comment_post_ID);
        if ($comment->user_id == $post->post_author) {
            $comment_author = $comment_author . '<span class="fComment--tag">' . __('Author', 'Farallon') . '</span>';
        }
        return $comment_author;
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

        if ($request['category']) {
            $query_args['category__in'] = $request['category'];
        }

        if ($request['tag']) {
            $query_args['tag__in'] = $request['tag'];
        }

        if ($request['author']) {
            $query_args['author'] = $request['author'];
        }

        if ($request['search']) {
            $query_args['s'] = $request['search'];
        }

        $the_query = new WP_Query($query_args);
        $data = [];
        while ($the_query->have_posts()) {
            $the_query->the_post();
            global $post;
            $data[] = [
                'id' => get_the_ID(),
                'post_title' => get_the_title(),
                'date' => human_time_diff(get_the_time('U'), current_time('timestamp')) . __(' ago', 'Farallon'),
                'excerpt' => mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 150, "..."),
                'author' => get_the_author(),
                'author_avatar_urls' => get_avatar_url(get_the_author_meta('ID'), array('size' => 64)),
                'author_posts_url' => get_author_posts_url(get_the_author_meta('ID')),
                'comment_count' => get_comments_number(),
                'view_count' => (int)get_post_meta(get_the_ID(), FARALLON_POST_VIEW_KEY, true),
                'like_count' => (int)get_post_meta(get_the_ID(), FARALLON_POST_LIKE_KEY, true),
                'thumbnail' => farallon_get_background_image(get_the_ID(), 600, 360),
                'permalink' => get_permalink(),
                'categories' => get_the_category_list(','),
                'tags' => get_the_tags(),
                'has_image' => farallon_is_has_image(get_the_ID()),
                'day' => get_the_date('d'),
                'post_format' => get_post_format(),
                'read_time' => farallon_get_post_read_time_text(get_the_ID()),
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
                $name        = $parent->comment_author;

                $comment_text =
                    '<a href="' . $parent_link . '" class="fComment--parent">@' . $name . '</a>'
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
