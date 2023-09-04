<?php global $farallonSetting; ?>
<footer class="site--footer">
    <nav>
        <?php wp_nav_menu(array('theme_location' => 'farallon_footer', 'menu_class' => 'footer--nav', 'container' => 'ul', 'fallback_cb' => 'link_to_menu_editor')); ?>
    </nav>
    <div class="copyright">
        <?php if ($farallonSetting->get_setting('copyright')) : ?>
            <?php echo $farallonSetting->get_setting('copyright'); ?>
        <?php else : ?>
            © <?php echo date('Y'); ?> . All rights reserved.
        <?php endif; ?>
    </div>
</footer>
<div class="fixed--theme u-hide">
    <span class="is-active">
        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24" style="color: currentcolor; width: 16px; height: 16px;">
            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
        </svg>
    </span>
    <span>
        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24" style="color: currentcolor; width: 16px; height: 16px;">
            <circle cx="12" cy="12" r="5"></circle>
            <path d="M12 1v2"></path>
            <path d="M12 21v2"></path>
            <path d="M4.22 4.22l1.42 1.42"></path>
            <path d="M18.36 18.36l1.42 1.42"></path>
            <path d="M1 12h2"></path>
            <path d="M21 12h2"></path>
            <path d="M4.22 19.78l1.42-1.42"></path>
            <path d="M18.36 5.64l1.42-1.42"></path>
        </svg>
    </span>
    <span>
        <svg fill="none" height="24" shape-rendering="geometricPrecision" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" width="24" style="color: currentcolor; width: 16px; height: 16px;">
            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
            <path d="M8 21h8"></path>
            <path d="M12 17v4"></path>
        </svg>
    </span>
</div>
</div>
</body>
<?php wp_footer(); ?>

</html>