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
include_once('modules/update.php');
include_once('modules/scripts.php');
