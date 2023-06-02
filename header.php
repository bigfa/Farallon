<!DOCTYPE html>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <div class="main">
        <header class="site--header">
            <div class="container">
                <img src="https://static.woshipm.com/view/woshipm_api_def_20230522185548_8178.png" class="avatar" />
                <nav class="pointer-events-auto hidden md:block">
                    <ul class="flex rounded-full bg-white/90 px-3 text-sm font-medium text-zinc-800 shadow-lg shadow-zinc-800/5 ring-1 ring-zinc-900/5 backdrop-blur dark:bg-zinc-800/90 dark:text-zinc-200 dark:ring-white/10">
                        <li><a class="relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400" href="/about">About</a></li>
                        <li><a class="relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400" href="/articles">Articles</a></li>
                        <li><a class="relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400" href="/projects">Projects</a></li>
                        <li><a class="relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400" href="/speaking">Speaking</a></li>
                        <li><a class="relative block px-3 py-2 transition hover:text-teal-500 dark:hover:text-teal-400" href="/uses">Uses</a></li>
                    </ul>
                </nav>
            </div>
        </header>