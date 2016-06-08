<?php
/**
 * Plugin Name: Multisite Metabar
 * Plugin URI:  https://github.com/pongo710/wordpress-multisite-metabar
 * Description: Shows metabar for multisite installations
 * Author:      David Schilling
 * License:     Apache License, Version 2.0
 * License URI: http://www.apache.org/licenses/LICENSE-2.0
 */

function register_custom_scripts() {
	wp_register_style( 'mm_css', plugins_url('/css/app.css', __FILE__));
	wp_enqueue_style( 'mm_css' );
}

add_action('wp_enqueue_scripts','register_custom_scripts');

function insert_multisite_metabar() {
	$foo = 'bar';
	echo '<div id="ms_navbar">
		<ul>
			<li>Test</li>
			<li>Test</li>
			<li>Test</li>
			<li>Test</li>
		</ul>
	      </div>';
}

add_action('wp_footer', 'insert_multisite_metabar');
