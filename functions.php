<?php
define('FARALLON_VERSION', wp_get_theme()->get('Version'));
define('FARALLO_SETTING_KEY', 'farallon_setting');
define('FARALLON_POST_LIKE_KEY', '_postlike');
define('FARALLON_POST_VIEW_KEY', 'views');
define('FARALLON_ARCHIVE_VIEW_KEY', 'views');

function farallon_setup()
{
    load_theme_textdomain('Farallon', get_template_directory() . '/languages');
}


add_action('after_setup_theme', 'farallon_setup');

include_once('modules/setting.php');
include_once('modules/base.php');
include_once('modules/comment.php');
include_once('modules/widget.php');
include_once('modules/shortcode.php');
include_once('modules/update.php');

function farallon_get_post_image_count($post_id)
{
    $content = get_post_field('post_content', $post_id);
    preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
    return count($strResult[1]);
}

function farallon_get_background_image($post_id, $width = null, $height = null)
{
    global $farallonSetting;
    if (has_post_thumbnail($post_id)) {
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
        $output = $timthumb_src[0];
    } elseif (get_post_meta($post_id, '_banner', true)) {
        $output = get_post_meta($post_id, '_banner', true);
    } else {
        $content = get_post_field('post_content', $post_id);
        $defaltthubmnail = $farallonSetting->get_setting('default_thumbnail');
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
        $n = count($strResult[1]);
        if ($n > 0) {
            $output = $strResult[1][0];
        } else {
            $output = $defaltthubmnail;
        }
    }
    if ($height && $width) {
        if ($farallonSetting->get_setting('upyun')) {
            $output = $output . "!/both/{$width}x{$height}";
        }

        if ($farallonSetting->get_setting('oss')) {
            $output = $output . "?x-oss-process=image/crop,w_{$width},h_{$height}";
        }

        if ($farallonSetting->get_setting('qiniu')) {
            $output = $output . "?imageView2/1/w/{$width}/h/{$height}";
        }
    }

    return $output;
}


function farallon_is_has_image($post_id)
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
        echo '<ul></ul>';
        return;
    }

    extract($args);

    $link = $link_before . '<a href="' . admin_url('nav-menus.php') . '">' . $before .  __('Add a menu', 'Farallon') . $after . '</a>' . $link_after;

    if (FALSE !== stripos($items_wrap, '<ul') or FALSE !== stripos($items_wrap, '<ol')) {
        $link = "<li>$link</li>";
    }

    $output = sprintf($items_wrap, $menu_id, $menu_class, $link);
    // if (!empty($container)) {
    //     $output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
    // }

    if ($echo) {
        echo $output;
    }

    return $output;
}


function farallon_post_view()
{
    return (int)get_post_meta(get_the_ID(), FARALLON_POST_VIEW_KEY, true);
}

/**
 * Get link items by categroy id
 *
 * @since Farallon 0.1.0
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
        $output = __('No links yet', 'Farallon');
    }
    return $output;
}

/**
 * Get link items
 *
 * @since Farallon 0.1.0
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

function farallon_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type):
        case 'pingback':
        case 'trackback':
?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <div class="pingback-content"><svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 9.68l.6-.6a5 5 0 0 1 1.02 7.87l-2.83 2.83a5 5 0 0 1-7.07-7.07l2.38-2.38c0 .43.05.86.12 1.3l-1.8 1.79a4 4 0 0 0 5.67 5.65l2.82-2.83a4 4 0 0 0-1.04-6.4l.14-.16zm-1 4.64l-.6.6a5 5 0 0 1-1.02-7.87l2.83-2.83a5 5 0 0 1 7.07 7.07l-2.38 2.39c0-.43-.05-.87-.12-1.3l1.8-1.8a4 4 0 1 0-5.67-5.65L10.6 7.76a4 4 0 0 0 1.04 6.4l-.13.16z" fill="currentColor"></path>
                    </svg><?php comment_author_link(); ?></div>
            <?php
            break;
        default:
            global $post;
            ?>
            <li class="comment<?php if (!$comment->comment_parent) echo ' parent'; ?>" itemtype="http://schema.org/Comment" data-id="<?php comment_ID() ?>" itemscope="" itemprop="comment" id="comment-<?php comment_ID() ?>">
                <div class="comment-body">
                    <div class="comment-meta">
                        <div class="comment--avatar">
                            <img height=42 width=42 alt="<?php echo $comment->comment_author; ?>" aria-label="<?php echo $comment->comment_author; ?>" src="<?php echo get_avatar_url($comment, array('size' => 96)); ?>" class="avatar avatar--lazy" />
                        </div>
                        <div class="comment--meta">
                            <div class="comment--author" itemprop="author"><?php echo get_comment_author_link(); ?><span class="dot"></span>
                                <div class="comment--time humane--time" itemprop="datePublished" datetime="<?php echo get_comment_date('c'); ?>"><?php echo get_comment_date('Y-m-d'); ?></div>
                                <?php echo '<span class="comment-reply-link u-cursorPointer " onclick="return addComment.moveForm(\'comment-' . $comment->comment_ID . '\', \'' . $comment->comment_ID . '\', \'respond\', \'' . $post->ID . '\')"><svg viewBox="0 0 24 24" width="14" height="14"  aria-hidden="true" class="" ><g><path d="M12 3.786c-4.556 0-8.25 3.694-8.25 8.25s3.694 8.25 8.25 8.25c1.595 0 3.081-.451 4.341-1.233l1.054 1.7c-1.568.972-3.418 1.534-5.395 1.534-5.661 0-10.25-4.589-10.25-10.25S6.339 1.786 12 1.786s10.25 4.589 10.25 10.25c0 .901-.21 1.77-.452 2.477-.592 1.731-2.343 2.477-3.917 2.334-1.242-.113-2.307-.74-3.013-1.647-.961 1.253-2.45 2.011-4.092 1.78-2.581-.363-4.127-2.971-3.76-5.578.366-2.606 2.571-4.688 5.152-4.325 1.019.143 1.877.637 2.519 1.342l1.803.258-.507 3.549c-.187 1.31.761 2.509 2.079 2.629.915.083 1.627-.356 1.843-.99.2-.585.345-1.224.345-1.83 0-4.556-3.694-8.25-8.25-8.25zm-.111 5.274c-1.247-.175-2.645.854-2.893 2.623-.249 1.769.811 3.143 2.058 3.319 1.247.175 2.645-.854 2.893-2.623.249-1.769-.811-3.144-2.058-3.319z"></path></g></svg></span>'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="comment-content" itemprop="description">
                        <?php comment_text(); ?>
                    </div>
                </div>
    <?php
            break;
    endswitch;
}
