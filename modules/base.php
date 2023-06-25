<?php
class farallonBase
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_filter('excerpt_length', array($this, 'excerpt_length'));
        add_filter('excerpt_more', array($this, 'excerpt_more'));
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));
        add_theme_support('title-tag');
        register_nav_menu('farallon', 'farallon');
        register_nav_menu('farallon_footer', 'farallon_footer');
        add_theme_support('post-formats', array('status'));
    }


    function excerpt_more($more)
    {
        return '...';
    }

    function excerpt_length($length)
    {
        return 80;
    }

    function enqueue_styles()
    {
        wp_dequeue_style('global-styles');
        wp_enqueue_style('farallon-style', get_template_directory_uri() . '/build/css/app.min.css', array(), FARALLON_VERSION, 'all');
    }

    function enqueue_scripts()
    {
        wp_enqueue_script('farallon-script', get_template_directory_uri() . '/build/js/app.min.js', [], FARALLON_VERSION, true);
        wp_localize_script(
            'farallon-script',
            'obvInit',
            [
                'is_single' => is_singular(),
                'post_id' => get_the_ID(),
            ]
        );
    }
}

new farallonBase();
