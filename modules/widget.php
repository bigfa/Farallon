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
        $title = apply_filters('widget_title', esc_attr($instance['title']));
        echo $before_widget;
        if ($title) echo $before_title . $title . $after_title;
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
    function update($new_instance, $old_instance)
    {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }
    function form($instance)
    {
        $instance = wp_parse_args((array) $instance, array('title' => '', 'limit' => ''));
        $title = esc_attr($instance['title']);
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php
    }
}
add_action('widgets_init', 'farallon_widget_init');
function farallon_widget_init()
{
    register_widget('Farallon_Widget');
}
