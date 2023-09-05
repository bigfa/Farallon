<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <?php wp_head(); ?>
    <link type="image/vnd.microsoft.icon" href="<?php echo get_template_directory_uri(); ?>/build/images/favicon.png" rel="shortcut icon">
</head>

<body <?php body_class(); ?>>
    <div class="main">
        <header class="site--header">
            <a href="/" class="site--url" aria-label="<?php bloginfo('sitename'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/build/images/avatar.jpeg" class="avatar" alt="<?php bloginfo('sitename'); ?>" />
                <span class="u-xs-show"><?php bloginfo('sitename'); ?></span>
            </a>
            <div class="site--header__center">
                <div class="inner">
                    <?php wp_nav_menu(array('theme_location' => 'farallon', 'menu_class' => 'topNav-items', 'container' => 'ul', 'fallback_cb' => 'link_to_menu_editor')); ?>
                    <div class="search--area">
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </div>
            <svg class="svgIcon" width="25" height="25" data-action="show-search">
                <path d="M20.067 18.933l-4.157-4.157a6 6 0 1 0-.884.884l4.157 4.157a.624.624 0 1 0 .884-.884zM6.5 11c0-2.62 2.13-4.75 4.75-4.75S16 8.38 16 11s-2.13 4.75-4.75 4.75S6.5 13.62 6.5 11z">
                </path>
            </svg>
        </header>