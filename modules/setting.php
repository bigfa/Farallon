<?php

class farallonSetting
{
    public $config;

    function __construct($config = [])
    {
        $this->config = $config;
        add_action('admin_menu', [$this, 'setting_menu']);
        add_action('admin_enqueue_scripts', [$this, 'setting_scripts']);
        add_action('wp_ajax_farallon_setting', array($this, 'setting_callback'));
        //add_action('wp_ajax_nopriv_farallon_setting', array($this, 'setting_callback'));
    }


    function setting_callback()
    {
        $data = $_POST[FARALLO_SETTING_KEY];
        $this->update_setting($data);
        return wp_send_json([
            'code' => 200,
            'message' => '保存成功',
            'data' => $this->get_setting()
        ]);
    }

    function setting_scripts()
    {
        if (isset($_GET['page']) && $_GET['page'] == 'farallon') {
            wp_enqueue_style('farallon-setting', get_template_directory_uri() . '/build/css/setting.min.css', array(), FARALLON_VERSION, 'all');
            wp_enqueue_script('farallon-setting', get_template_directory_uri() . '/build/js/setting.min.js', ['jquery'], FARALLON_VERSION, true);
            wp_localize_script(
                'farallon-setting',
                'obvInit',
                [
                    'is_single' => is_singular(),
                    'post_id' => get_the_ID(),
                    'restfulBase' => esc_url_raw(rest_url()),
                    'nonce' => wp_create_nonce('wp_rest'),
                    'ajaxurl' => admin_url('admin-ajax.php'),
                ]
            );
        }
    }

    function setting_menu()
    {
        add_menu_page('主题设置', '主题设置', 'manage_options', 'farallon', [$this, 'setting_page'], '', 59);
    }

    function setting_page()
    { ?>
        <div class="wrap">
            <h2>主题设置</h2>
            <div class="pure-wrap">
                <div class="leftpanel">
                    <ul class="nav">
                        <?php foreach ($this->config['header'] as $val) {
                            $id = $val['id'];
                            $title = $val['title'];
                            $icon = $val['icon'];
                            $class = ($id == "basic") ? "active" : "";
                            echo "<li class=\"$class\"><span id=\"tab-title-$id\"><i class=\"dashicons-before dashicons-$icon\"></i>$title</span></li>";
                        } ?>
                    </ul>
                </div>
                <form id="pure-form" method="POST" action="options.php">
                    <?php
                    foreach ($this->config['body'] as $val) {
                        $id = $val['id'];
                        $class = $id == "basic" ? "div-tab" : "div-tab hidden";
                    ?>
                        <div id="tab-<?php echo $id; ?>" class="<?php echo $class; ?>">
                            <table class="form-table">
                                <tbody>
                                    <?php
                                    $content = $val['content'];
                                    foreach ($content as $k => $row) {
                                        switch ($row['type']) {
                                            case 'textarea':
                                                $this->setting_textarea($row);
                                                break;

                                            case 'switch':
                                                $this->setting_switch($row);
                                                break;

                                            case 'input':
                                                $this->setting_input($row);
                                                break;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                    <div class="pure-save"><span id="pure-save" class="button--save">保存设置</span></div>
                </form>
            </div>
        </div>
    <?php }

    function get_setting($key = null)
    {
        $setting = get_option(FARALLO_SETTING_KEY);

        if (!$setting) {
            return false;
        }

        if ($key) {
            if (array_key_exists($key, $setting)) {
                return $setting[$key];
            } else {
                return false;
            }
        } else {
            return $setting;
        }
    }

    function update_setting($setting)
    {
        update_option(FARALLO_SETTING_KEY, $setting);
    }

    function empty_setting()
    {
        delete_option(FARALLO_SETTING_KEY);
    }

    function setting_input($params)
    {
        $default = $this->get_setting($params['name']);
    ?>
        <tr>
            <th scope="row">
                <label for="pure-setting-<?php echo $params['name']; ?>"><?php echo $params['label']; ?></label>
            </th>
            <td>
                <input type="text" id="pure-setting-<?php echo $params['name']; ?>" name="<?php printf('%s[%s]', FARALLO_SETTING_KEY, $params['name']); ?>" value="<?php echo $default; ?>" class="regular-text">
                <?php printf('<br /><br />%s', $params['description']); ?>
            </td>
        </tr>
    <?php }

    function setting_textarea($params)
    { ?>
        <tr>
            <th scope="row">
                <label for="pure-setting-<?php echo $params['name']; ?>"><?php echo $params['label']; ?></label>
            </th>
            <td>
                <textarea name="<?php printf('%s[%s]', FARALLO_SETTING_KEY, $params['name']); ?>" id="pure-setting-<?php echo $params['name']; ?>" class="large-text code" rows="5" cols="50"><?php echo $this->get_setting($params['name']); ?></textarea>
                <?php printf('<br />%s', $params['description']); ?>
            </td>
        </tr>
    <?php }

    function setting_switch($params)
    {
        $val = $this->get_setting($params['name']);
        $val = $val ? 1 : 0;
    ?>
        <tr>
            <th scope="row">
                <label for="pure-setting-<?php echo $params['name']; ?>"><?php echo $params['label']; ?></label>
            </th>
            <td>
                <a class="pure-setting-switch<?php if ($val) echo ' active'; ?>" href="javascript:;" data-id="pure-setting-<?php echo $params['name']; ?>">
                    <i></i>
                </a>
                <br />
                <input type="hidden" id="pure-setting-<?php echo $params['name']; ?>" name="<?php printf('%s[%s]', FARALLO_SETTING_KEY, $params['name']); ?>" value="<?php echo $val; ?>" class="regular-text">
                <?php printf('<br />%s', $params['description']); ?>
            </td>
        </tr>
<?php }
}
global $farallonSetting;
$farallonSetting = new farallonSetting(
    [
        "header" => [
            [
                'id' => 'basic',
                'title' => '基础设置',
                'icon' => 'basic'
            ],
            [
                'id' => 'feature',
                'title' => '功能设置',
                'icon' => 'slider'

            ],
            [
                'id' => 'singluar',
                'title' => '单页设置',
                'icon' => 'feature'
            ],
            [
                'id' => 'meta',
                'title' => '个人信息',
                'icon' => 'interface'
            ],
            [
                'id' => 'custom',
                'title' => '自定义',
                'icon' => 'social-contact'
            ]
        ],
        "body" => [
            [
                'id' => 'basic',
                'content' => [
                    [
                        'type' => 'textarea',
                        'name' => 'description',
                        'label' => '网站描述',
                        'description' => '用简洁凝练的话对你的网站进行描述'
                    ],
                    [
                        'type' => 'textarea',
                        'name' => 'headcode',
                        'label' => '头部代码',
                        'description' => '可以向head标签中加入内容，如站点验证标签等'
                    ],
                    [
                        'type' => 'input',
                        'name' => 'title_sep',
                        'label' => '标题分隔符',
                        'description' => '一经输入请勿修改，默认为<code>-</code>'
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'disable_block_css',
                        'label' => '禁用区块样式',
                        'description' => '不加载区块样式文件'
                    ],
                ]
            ],
            [
                'id' => 'feature',
                'content' => [
                    [
                        'type' => 'switch',
                        'name' => 'upyun',
                        'label' => '又拍云',
                        'description' => '确保所有图片均已上传至又拍云，否则缩略图可能无法正常显示。'
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'oss',
                        'label' => '阿里云OSS',
                        'description' => '确保所有图片均已上传至阿里云OSS，否则缩略图可能无法正常显示。'
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'qiniu',
                        'label' => '七牛云',
                        'description' => '确保所有图片均已上传至阿里云七牛云，否则缩略图可能无法正常显示。'
                    ],
                    // [
                    //     'type' => 'switch',
                    //     'name' => 'darkmode',
                    //     'label' => '暗黑模式',
                    //     'description' => '暗黑模式'
                    // ],
                    [
                        'type' => 'input',
                        'name' => 'default_thumbnail',
                        'label' => '默认缩略图',
                        'description' => '文章没有图片时的默认缩略图'
                    ],
                    // [
                    //     'type' => 'input',
                    //     'name' => 'format_time',
                    //     'label' => '格式化时间',
                    //     'description' => '时间多久以前显示为几天前，几小时前，几分钟前，几秒前'
                    // ],
                    [
                        'type' => 'switch',
                        'name' => 'home_cat',
                        'label' => '分类信息',
                        'description' => '首页分类信息展示'
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'home_author',
                        'label' => '作者信息',
                        'description' => '首页作者信息展示'
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'home_cat',
                        'label' => '分类信息',
                        'description' => '首页分类信息展示'
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'home_like',
                        'label' => '文章点赞',
                        'description' => '首页文章点赞信息展示'
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'hide_home_cover',
                        'label' => '缩略图',
                        'description' => '不展示首页缩略图'
                    ],
                ]
            ],

            [
                'id' => 'singluar',
                'content' => [
                    [
                        'type' => 'switch',
                        'name' => 'bio',
                        'label' => '作者信息',
                        'description' => '侧边栏作者信息展示'
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'related',
                        'label' => '相关文章',
                        'description' => '文章内容尾部相关文章展示'
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'postlike',
                        'label' => '文章点赞',
                        'description' => '文章内容尾部文章点赞按钮展示'
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'post_navigation',
                        'label' => '上下文导航',
                        'description' => '展示前一篇后一篇文章'
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'show_copylink',
                        'label' => '分享链接',
                        'description' => '是否展示复制链接分享'
                    ],
                ]
            ],
            [
                'id' => 'meta',
                'content' => [
                    [
                        'type' => 'input',
                        'name' => 'telegram',
                        'label' => 'telegram',
                        'description' => 'telegram链接'
                    ],
                    [
                        'type' => 'input',
                        'name' => 'telegram_group',
                        'label' => 'telegram 组群',
                        'description' => 'telegram链接'
                    ],
                    [
                        'type' => 'input',
                        'name' => 'telegram_channel',
                        'label' => 'telegram 频道',
                        'description' => 'telegram链接'
                    ],
                    [
                        'type' => 'input',
                        'name' => 'instagram',
                        'label' => 'instagram',
                        'description' => 'instagram'
                    ],
                    [
                        'type' => 'input',
                        'name' => 'twitter',
                        'label' => 'twitter',
                        'description' => 'twitter'
                    ],
                    [
                        'type' => 'input',
                        'name' => 'rss',
                        'label' => 'RSS地址',
                        'description' => 'RSS地址'
                    ],
                ]
            ],
            [
                'id' => 'custom',
                'content' => [
                    [
                        'type' => 'textarea',
                        'name' => 'css',
                        'label' => 'CSS变量',
                        'description' => 'CSS变量'
                    ],
                    [
                        'type' => 'textarea',
                        'name' => 'javascript',
                        'label' => 'JS 模块',
                        'description' => '自定义JS脚本'
                    ],
                    [
                        'type' => 'textarea',
                        'name' => 'copyright',
                        'label' => '版权信息',
                        'description' => '修改版权信息'
                    ],
                ]
            ],
        ]
    ]
);
