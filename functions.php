<?php
define('FARALLON_VERSION', '0.0.6');

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

/**
 * Get link items by categroy id
 *
 * @since Puma 2.1.0
 *
 * @param term id
 * @return link item list
 */

function get_the_link_items($id = null)
{
    $bookmarks = get_bookmarks('orderby=date&category=' . $id);
    $output = '';
    if (!empty($bookmarks)) {
        $output .= '<ul class="link-items">';
        foreach ($bookmarks as $bookmark) {
            $output .=  '<li class="link-item"><a class="link-item-inner effect-apollo" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" ><span class="sitename"><strong>' . $bookmark->link_name . '</strong>' . $bookmark->link_description . '</span></a></li>';
        }
        $output .= '</ul>';
    } else {
        $output = '暂无链接。';
    }
    return $output;
}

/**
 * Get link items
 *
 * @since Puma 2.1.0
 *
 * @return link iterms
 */

function get_link_items()
{
    $linkcats = get_terms('link_category');
    $result = '';
    if (!empty($linkcats)) {
        foreach ($linkcats as $linkcat) {
            $result .=  '<h3 class="link-title">' . $linkcat->name . '</h3>';
            if ($linkcat->description) $result .= '<div class="link-description">' . $linkcat->description . '</div>';
            $result .=  get_the_link_items($linkcat->term_id);
        }
    } else {
        $result = get_the_link_items();
    }
    return $result;
}



include_once('modules/comment.php');
