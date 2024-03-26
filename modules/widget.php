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

class Farallon_Widget_Category extends WP_Widget

{
    function __construct()
    {
        $widget_ops = array('description' => __('show your category card', 'Farallon'));
        parent::__construct('about', __('Categories', 'Farallon'), $widget_ops);
    }

    function widget($args, $instance)
    {
        extract($args);
        echo $before_widget;
        $categories = get_terms([
            'taxonomy' => 'category',
            'hide_empty' => false,
            // 'orderby' => 'meta_value_num',
            'order' => 'DESC',
            // 'meta_key' => '_views',
        ]);
        echo '<div class="widget--category">';
        foreach ($categories as $category) {
            $link = get_term_link($category, 'category')
        ?>
            <a class="widget--category--item" title="<?php echo $category->name; ?>" aria-label="<?php echo $category->name; ?>" href="<?php echo $link; ?>" data-count="<?php echo $category->count; ?>">
                <?php if (get_term_meta($category->term_id, '_thumb', true)) : ?>
                    <img class="widget--category--image" alt="<?php echo $category->name; ?>" aria-label="<?php echo $category->name; ?>" src="<?php echo get_term_meta($category->term_id, '_thumb', true); ?>">
                <?php endif ?>
                <div class="widget--category--meta">
                    <div class="widget--category--title"><?php echo $category->name; ?></div>
                </div>
            </a>
<?php }
        echo '</div>';
        echo $after_widget;
    }
}

add_action('widgets_init', 'farallon_widget_init');
function farallon_widget_init()
{
    register_widget('Farallon_Widget');
    register_widget('Farallon_Widget_Category');
}
