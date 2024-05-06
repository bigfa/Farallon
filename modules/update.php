<?php
global $farallonSetting;
function farallon_is_get_new()
{
    if (get_transient('farallon_latest')) {
        $latest = get_transient('farallon_latest');
    } else {
        delete_transient('farallon_latest');
        $response = wp_remote_get('https://v.wpista.com/latest?theme=farallon', array(
            'sslverify' => false
        ));
        if (is_wp_error($response)) {
            return false;
        }
        $res = $response['body'];
        $latest = json_decode($res, true)['version'];
        set_transient('farallon_latest', $latest, 60 * 60 * 24);
    }
    return version_compare(FARALLON_VERSION, $latest, '<');
}

function farallon_update_notice()
{
    add_thickbox();
    echo '<div class="updated">
    <p>主题最新版为 ' . get_transient('farallon_latest') . '，当前版本 ' . FARALLON_VERSION . '。请备份好所有文件，主题升级过程中会删掉原有文件。<a class="thickbox" href="' . admin_url() . 'admin-ajax.php?action=farallon_theme_update&TB_iframe=true&width=772&height=312">确认升级</a>
    </p></div>';
}
if ($farallonSetting->get_setting('auto_update') && farallon_is_get_new()) add_action('admin_notices', 'farallon_update_notice');

add_action('wp_ajax_farallon_theme_update', 'farallon_theme_update_callback');
function farallon_theme_update_callback()
{

    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

    $update_data = array(
        'theme_version' => get_transient('farallon_latest'),
        'update_link' => 'https://github.com/bigfa/Farallon/archive/refs/tags/v' . get_transient('farallon_latest') . '.zip'
    );

    $name          = "Farallon";
    $slug          = "Farallon";
    $version       = $update_data['theme_version'];
    $download_link = $update_data['update_link'];

    delete_site_transient('update_themes');

    $themes = wp_get_themes();
    $current = (object) array(
        "last_checked" => time(),
        "checked" => array(),
        "response" => array(),
        "translations" => array()
    );

    foreach ($themes as $theme) {
        $current->checked[$theme->get('Slug')] = $theme->get('Version');
    }

    $current->response[$slug] = array(
        'theme' => $slug,
        'new_version' => $version,
        'url' => '',
        'package' => $download_link
    );

    set_site_transient('update_themes', $current);

    $title = __('Update Theme');
    $nonce = 'upgrade-theme_' . $slug;
    $url = 'update.php?action=upgrade-theme&theme=' . urlencode($slug);

    $upgrader = new Theme_Upgrader(new Theme_Upgrader_Skin(compact('title', 'nonce', 'url', 'theme')));
    $upgrader->upgrade($slug);

    exit;
}
