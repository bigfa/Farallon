<?php

class farallonSetting
{
    public $config;

    function __construct($config = [])
    {
        $this->config = $config;
        add_action('admin_menu', [$this, 'setting_menu']);
        add_action('admin_enqueue_scripts', [$this, 'setting_scripts']);
    }

    function setting_scripts()
    {
        wp_enqueue_style('farallon-setting', get_template_directory_uri() . '/build/css/setting.min.css', array(), FARALLON_VERSION, 'all');
        wp_enqueue_script('farallon-setting', get_template_directory_uri() . '/build/js/setting.min.js', [], FARALLON_VERSION, true);
    }

    function setting_menu()
    {
        add_menu_page('主题设置', '主题设置', 'manage_options', 'farallon', [$this, 'setting_page'], '', 59);
    }

    function setting_page()
    {

?>
        <div class="wrap">
            <h2>主题设置</h2><br>
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

new farallonSetting(
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
            ],
            [
                'id' => 'seo',
                'title' => 'SEO',
                'icon' => 'save'
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
                    ]
                ]
            ],
            [
                'id' => 'feature',
                'content' => [
                    [
                        'type' => 'switch',
                        'name' => 'pagination',
                        'label' => '分页模式',
                        'description' => '传统分页'
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'cdn',
                        'label' => '图片云服务商',
                        'description' => '确保所有图片均已上传至服务商，否则缩略图可能无法正常显示。'
                    ],
                    [
                        'type' => 'switch',
                        'name' => 'darkmode',
                        'label' => '暗黑模式',
                        'description' => '暗黑模式'
                    ],
                    [
                        'type' => 'input',
                        'name' => 'hot_num',
                        'label' => '热门浏览量',
                        'description' => '当浏览量超过该值时，文章将会显示热门标签，如未设置则不显示'
                    ],
                    [
                        'type' => 'input',
                        'name' => 'format_time',
                        'label' => '格式化时间',
                        'description' => '时间多久以前显示为几天前，几小时前，几分钟前，几秒前'
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
                        'description' => '危险'
                    ],
                    [
                        'type' => 'textarea',
                        'name' => 'copyright',
                        'label' => '版权信息',
                        'description' => '危险'
                    ],
                ]
            ],
            [
                'id' => 'seo',
                'content' => [
                    [
                        'type' => 'switch',
                        'name' => 'twitter',
                        'label' => 'twitter卡片',
                        'description' => 'twitter卡片'
                    ],
                ]
            ],
        ]
    ]
);
