<?php
class Farallon_Widget extends WP_Widget

{
    function __construct()
    {
        $widget_ops = array('description' => __('show auhor info', 'Farallon'));
        parent::__construct('about', __('About', 'Farallon'), $widget_ops);
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
