<footer class="site--footer">
    <nav>
        <nav>
            <?php wp_nav_menu(array('theme_location' => 'farallon_footer', 'menu_class' => 'footer--nav', 'container' => 'ul', 'fallback_cb' => 'link_to_menu_editor')); ?>
        </nav>
    </nav>
    <div class="copyright">
        © <?php echo date('Y'); ?> . All rights reserved.
    </div>
</footer>
</div>
</body>
<?php wp_footer(); ?>

</html>