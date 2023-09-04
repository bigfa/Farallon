<?php
class Farallon_Widget extends WP_Widget

{
    function __construct()
    {
        $widget_ops = array('description' => '关于站长小工具');
        parent::__construct('about', '关于站长', $widget_ops);
    }

    function widget($args, $instance)
    {
        extract($args);
        echo $before_widget;
        $user = get_user_by('ID', 1);
?>
        <div class="widget-card">
            <div class="widget-card-content"><?php echo $user->display_name; ?></div>
            <div class="widget-card-description">
                <p><?php echo $user->description; ?></p>
            </div>
        </div>
<?php echo $after_widget;
    }
}
add_action('widgets_init', 'farallon_widget_init');
function farallon_widget_init()
{
    register_widget('Farallon_Widget');
}
