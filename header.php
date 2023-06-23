<!DOCTYPE html>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <?php wp_head(); ?>
    <link type="image/vnd.microsoft.icon" href="<?php echo get_template_directory_uri(); ?>/build/images/favicon.png" rel="shortcut icon">
</head>

<body <?php body_class(); ?>>
    <div class="main">
        <header class="site--header">
            <div class="container">
                <a href="/" class="site--url"><img src="https://static.woshipm.com/view/woshipm_api_def_20230522185548_8178.png" class="avatar" />
                    <span class="u-xs-show">Fatesinger</span>
                </a>
                <nav>
                    <?php wp_nav_menu(array('theme_location' => 'farallon', 'menu_class' => 'topNav-items', 'container' => 'ul', 'fallback_cb' => 'link_to_menu_editor')); ?>
                </nav>
            </div>
        </header>