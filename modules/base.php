<?php
class farallonBase
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }


    function enqueue_styles()
    {
        wp_enqueue_style('farallon-style', get_template_directory_uri() . '/build/css/app.min.css', array(), FARALLON_VERSION, 'all');
    }

    function enqueue_scripts()
    {
        wp_enqueue_script('farallon-script', get_template_directory_uri() . '/build/js/app.js', array(''), FARALLON_VERSION, true);
    }
}

new farallonBase();
