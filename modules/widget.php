<?php
class pure_widget3 extends WP_Widget

{


    function __construct()
    {
        // Instantiate the parent object
        $widget_ops = array('description' => '关于站长小工具');
        parent::__construct('about', '关于站长', $widget_ops);
    }

    function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']) ? strip_tags($instance['limit']) : 5;
        echo $before_widget;
        if ($title) echo $before_title . $title . $after_title;
        $user = get_user_by('ID', 1);

?>
        <div class="widget-card">
            <div class="widget-card-content"><?php echo $user->display_name; ?></div>
            <div class="widget-card-description">
                <p><?php echo $user->description; ?></p>
            </div>
            <div class="author--sns">
                <svg class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1951" width="32" height="32">
                    <path d="M679.424 746.862l84.005-395.996c7.424-34.852-12.581-48.567-35.438-40.009L234.277 501.138c-33.72 13.13-33.134 32-5.706 40.558l126.282 39.424 293.156-184.576c13.714-9.143 26.295-3.986 16.018 5.157L426.898 615.973l-9.143 130.304c13.13 0 18.871-5.706 25.71-12.581l61.696-59.429 128 94.282c23.442 13.129 40.01 6.29 46.3-21.724zM1024 512c0 282.843-229.157 512-512 512S0 794.843 0 512 229.157 0 512 0s512 229.157 512 512z" fill="#1296DB" p-id="1952"></path>
                </svg>
                <svg t="1687673277217" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1774" width="32" height="32">
                    <path d="M962.267 233.18q-38.253 56.027-92.598 95.45 0.585 7.973 0.585 23.992 0 74.313-21.724 148.26t-65.975 141.97-105.398 120.32T529.7 846.63t-184.54 31.158q-154.843 0-283.428-82.87 19.968 2.267 44.544 2.267 128.585 0 229.156-78.848-59.977-1.17-107.447-36.864t-65.17-91.136q18.87 2.853 34.89 2.853 24.575 0 48.566-6.29-64-13.166-105.984-63.708T98.304 405.797v-2.268q38.839 21.724 83.456 23.406-37.742-25.161-59.977-65.682t-22.309-87.991q0-50.323 25.161-93.111 69.12 85.138 168.302 136.265t212.26 56.832q-4.534-21.723-4.534-42.277 0-76.58 53.98-130.56t130.56-53.979q80.018 0 134.875 58.295 62.317-11.996 117.175-44.544-21.139 65.682-81.116 101.742 53.175-5.706 106.277-28.6z" fill="#00ACED" p-id="1775"></path>
                </svg>
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
        $instance['limit'] = strip_tags($new_instance['limit']);

        return $instance;
    }
    function form($instance)
    {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title' => '', 'limit' => ''));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label>
        </p>
        <input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php
    }
}
add_action('widgets_init', 'pure_widget3_init');
function pure_widget3_init()
{
    register_widget('pure_widget3');
}
