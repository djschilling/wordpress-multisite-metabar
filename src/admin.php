<?php

add_action( 'admin_menu', 'my_plugin_menu' );
function my_plugin_menu() {
	add_options_page( 'Multisite Metabar', 'Multisite Metabar', 'manage_options', 'multisite-metabar-settings', 'render_metabar_settings' );
	add_action('admin_init', 'custom_settings');
}

function custom_settings() {
	register_setting('mm-settings-group', 'sites_shown');
	add_settings_section('mm-general-section', 'General', 'mm_print_general_options_heading', 'multisite-metabar-settings');
	add_settings_field('field-sites-shown', 'Sites Shown', 'mm_print_field_sites_shown', 'multisite-metabar-settings', 'mm-general-section');
}

function mm_print_general_options_heading() {
	echo 'Change the general settings';
}

function mm_print_field_sites_shown() {
	$sitesShown = esc_attr(get_option('sites_shown'));
	echo '<input type="text" name="sites_shown" value="'.$sitesShown.'" placeholder="Sites shown"/>';
}
function render_metabar_settings() {
    $sites = wp_get_sites();
    foreach ($sites as $site) {
?>
       <div><?php $site['blog_id']; ?></div>
<?php
    }
?>
	<h1>Multisite Metabar Settings</h1>
	<form method="post" action ="options.php">
		<?php settings_fields('mm-settings-group'); ?>
<?php
    foreach ($sites as $site) {
?>
    <div><?php echo $site['blog_id']; ?></div>
<?php
    }
?>
		<?php do_settings_sections('multisite-metabar-settings'); ?>
		<?php submit_button(); ?>
	</form>
<?php
}
?>
