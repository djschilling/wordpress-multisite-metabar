<?php

add_action('network_admin_menu', 'add_custom_settings');
function add_custom_settings()
{
    add_submenu_page('settings.php', 'Multisite Metabar', 'Multisite Metabar', 'manage_network_options', 'mm_menu_metabar', 'mm_print_settings_page');
    add_settings_section('default', 'Standart Einstellungen', 'mm_print_section_heading', 'mm_menu_metabar');
    register_setting('mm_settings', 'mm_metabar');
    add_settings_field("mm_metabar", "metabar", 'mm_print_field_metabar', 'mm_menu_metabar', 'default');
}

function mm_print_settings_page()
{
    if (isset($_GET['updated'])): ?>
        <div id="message" class="updated notice is-dismissible"><p><?php _e('Options saved.') ?></p></div>
    <?php endif; ?>
    <div class="wrap">
        <h1>Multisite Metabar Einstellungen</h1>
        <form method="POST" action="edit.php?action=mm_update_network_options"><?php
            settings_fields('mm_menu_metabar');
            do_settings_sections('mm_menu_metabar');
            submit_button(); ?>
        </form>
    </div>
    <?php
}

function mm_print_section_heading()
{
    $sites = wp_get_sites();
    foreach ($sites as $site) {
        ?>
        <div><?php echo $site['blog_id']; ?></div>
        <?php
    }
}

function mm_print_field_metabar()
{
    $mm_metabar_value = get_site_option('mm_metabar');
    echo '<input type="text" name="mm_metabar" value="' . $mm_metabar_value . '" />';
}

add_action('network_admin_edit_mm_update_network_options', 'mm_update_network_options');
function mm_update_network_options()
{
    check_admin_referer('mm_menu_metabar-options');

    $mm_metabar = $_POST['mm_metabar'];
    update_site_option('mm_metabar', $mm_metabar);
    wp_redirect(add_query_arg(array('page' => 'mm_menu_metabar',
        'updated' => 'true'), network_admin_url('settings.php')));
    exit;
}
