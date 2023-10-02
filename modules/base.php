<?php
class farallonBase
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_filter('excerpt_length', array($this, 'excerpt_length'));
        add_filter('excerpt_more', array($this, 'excerpt_more'));
        add_filter("the_excerpt", array($this, 'custom_excerpt_length'), 999);
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));
        add_theme_support('title-tag');
        register_nav_menu('farallon', 'farallon');
        register_nav_menu('farallon_footer', 'farallon_footer');
        add_theme_support('post-formats', array('status'));
        add_filter('pre_option_link_manager_enabled', '__return_true');
        add_action('widgets_init', array($this, 'widgets_init'));
        add_action('wp_head', array($this, 'head_output'), 11);
    }

    function head_output()
    {
        global $s, $post, $farallonSetting;

        //echo '<link type="image/vnd.microsoft.icon" href="/favicon.png" rel="shortcut icon">';

        $description = '';
        $blog_name = get_bloginfo('name');
        if (is_singular()) {
            $ID = $post->ID;
            $author = $post->post_author;
            if (get_post_meta($ID, "_desription", true)) {
                $description = get_post_meta($ID, "_desription", true);
                echo '<meta name="description" content="' . $description . '">';
            } else {
                $description = $post->post_title . '，作者:' . get_the_author_meta('nickname', $author) . '，发布于' . get_the_date('Y-m-d');
                echo '<meta name="description" content="' . $description . '">';
            }
        } else {
            if (is_home()) {
                $description = $farallonSetting->get_setting('description');
            } elseif (is_category()) {
                $description = single_cat_title('', false) . " - " . trim(strip_tags(category_description()));
            } elseif (is_tag()) {
                $description = trim(strip_tags(tag_description()));
            } elseif (is_search()) {
                $description = $blog_name . ": '" . esc_html($s, 1) . "' 的搜索結果";
            } else {
                $description = $farallonSetting->get_setting('description');
            }
            $description = mb_substr($description, 0, 220, 'utf-8');
            echo '<meta name="description" content="' . $description . '">';
        }
    }

    function widgets_init()
    {

        register_sidebar(array(
            'name'          => '首页顶部',
            'id'            => 'topbar',
            'description'   => '首页',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="heading-title">',
            'after_title'   => '</h3>',
        ));
    }

    function custom_excerpt_length($excerpt)
    {
        if (has_excerpt()) {
            $excerpt = wp_trim_words(get_the_excerpt(), apply_filters("excerpt_length", 80));
        }
        return $excerpt;
    }

    function excerpt_more($more)
    {
        return '...';
    }

    function excerpt_length($length)
    {
        return 80;
    }

    function enqueue_styles()
    {
        global $farallonSetting;
        wp_dequeue_style('global-styles');
        wp_enqueue_style('farallon-style', get_template_directory_uri() . '/build/css/app.min.css', array(), FARALLON_VERSION, 'all');
        if ($farallonSetting->get_setting('css')) {
            wp_add_inline_style('farallon-style', $farallonSetting->get_setting('css'));
        }
        if ($farallonSetting->get_setting('disable_block_css')) {
            wp_dequeue_style('wp-block-library');
            wp_dequeue_style('wp-block-library-theme');
            wp_dequeue_style('wc-blocks-style');
        }
    }

    function enqueue_scripts()
    {
        global $farallonSetting;
        wp_enqueue_script('farallon-script', get_template_directory_uri() . '/build/js/app.min.js', [], FARALLON_VERSION, true);
        wp_localize_script(
            'farallon-script',
            'obvInit',
            [
                'is_single' => is_singular(),
                'post_id' => get_the_ID(),
                'restfulBase' => esc_url_raw(rest_url()),
                'nonce' => wp_create_nonce('wp_rest'),
                'darkmode' => !!$farallonSetting->get_setting('darkmode'),
                'version' => FARALLON_VERSION,
            ]
        );
        if ($farallonSetting->get_setting('javascript')) {
            wp_add_inline_script('farallon-script', $farallonSetting->get_setting('javascript'));
        }
        if (is_singular()) wp_enqueue_script("comment-reply");
    }
}

new farallonBase();
