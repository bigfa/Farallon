<?php

class farallonComment
{

    public function __construct()
    {
        add_action('rest_api_init', array($this, 'register_routes'));
    }

    function register_routes()
    {
        register_rest_route('farallon/v1', '/comment', array(
            'methods' => 'POST',
            'callback' => array($this, 'handle_coment_post'),
            'permission_callback' => '__return_true',
        ));

        register_rest_route('farallon/v1', '/post/view', array(
            'methods' => 'POST',
            'callback' => array($this, 'hanle_post_view'),
            'permission_callback' => '__return_true',
        ));
    }

    function hanle_post_view($data)
    {
        $post_id = $data['id'];
        $post_views = (int)get_post_meta($post_id, 'views', true);
        $post_views++;
        update_post_meta($post_id, 'views', $post_views);
        return [
            'code' => 200,
            'message' => '浏览成功',
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

        //$comment['author_avatar_urls'] = get_avatar_url($comment->comment_author_email, array('size' => 64));

        return [
            'code' => 200,
            'message' => '评论成功',
            'data' =>  [
                'author_avatar_urls' => get_avatar_url($comment->comment_author_email, array('size' => 64)),
                'comment_author' => $comment->comment_author,
                'comment_author_email' => $comment->comment_author_email,
                'comment_author_url' => $comment->comment_author_url,
                'comment_content' => $comment->comment_content,
                'comment_date' => $comment->comment_date,
                'comment_date_gmt' => $comment->comment_date_gmt,
                'comment_ID' => $comment->comment_ID,
            ]
        ];
    }
}

new farallonComment();
