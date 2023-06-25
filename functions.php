<?php
define('FARALLON_VERSION', '0.0.5');

include_once('modules/base.php');

function aladdin_get_background_image($post_id, $width = null, $height = null)
{
    if (has_post_thumbnail($post_id)) {
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
        $output = $timthumb_src[0];
    } elseif (get_post_meta($post_id, '_banner', true)) {
        $output = get_post_meta($post_id, '_banner', true);
    } else {
        $content = get_post_field('post_content', $post_id);
        $defaltthubmnail = '//static.fatesinger.com/2018/05/q3wyes7va2ehq59y.JPG';
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
        $n = count($strResult[1]);
        if ($n > 0) {
            $output = $strResult[1][0];
        } else {
            $output = $defaltthubmnail;
        }
    }
    if ($height && $width) {
        $result = $output . "!/both/{$width}x{$height}";
    } else {

        $result = $output;
    }

    return  $result;
}


function aladdin_is_has_image($post_id)
{
    static $has_image;
    if (has_post_thumbnail($post_id)) {
        $has_image = true;
    } elseif (get_post_meta($post_id, '_banner', true)) {
        $has_image = true;
    } else {
        $content = get_post_field('post_content', $post_id);
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
        $n = count($strResult[1]);
        if ($n > 0) {
            $has_image = true;
        } else {
            $has_image = false;
        }
    }

    return $has_image;
}

function link_to_menu_editor($args)
{
    if (!current_user_can('manage_options')) {
        return;
    }

    extract($args);

    $link = $link_before . '<a href="' . admin_url('nav-menus.php') . '">' . $before . 'Add a menu' . $after . '</a>' . $link_after;

    if (FALSE !== stripos($items_wrap, '<ul') or FALSE !== stripos($items_wrap, '<ol')) {
        $link = "<li>$link</li>";
    }

    $output = sprintf($items_wrap, $menu_id, $menu_class, $link);
    if (!empty($container)) {
        $output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
    }

    if ($echo) {
        echo $output;
    }

    return $output;
}


function farallon_post_view()
{
    return 100;
}
