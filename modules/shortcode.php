<?php

class farallonShortcode
{
    public function __construct()
    {
        add_shortcode('farallon_list_item', array($this, 'farallon_shortcode'));
        add_shortcode('farallon_list', array($this, 'farallon_shortcode_list'));
    }

    public function register_shortcodes()
    {
        add_shortcode('farallon_list_item', array($this, 'farallon_shortcode'));
    }

    function farallon_shortcode($atts, $content = null)
    {
        $a = shortcode_atts(array(
            'checked' => false,
        ), $atts);
        $checked = $a['checked'] ? '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" role="presentation" aria-hidden="true" focusable="false"><path d="M3 8.79L7.1 13 13 3" stroke="#1A8917" stroke-linecap="round" stroke-linejoin="round"></path></svg>' : '';
        $html = '<div class="now--item">' . $checked . $content . '</div>';

        return $html;
    }

    function farallon_shortcode_list($atts, $content = null)
    {
        // remove the <br> tag from content

        $content = do_shortcode($content);
        $Old     = array('<br />', '<br>');
        $New     = array('', '');
        $content = str_replace($Old, $New, $content);
        $html = '<div class="now--list">' . $content . '</div>';

        return $html;
    }
}

new farallonShortcode();
