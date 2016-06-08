<?php
function register_custom_scripts() {
	wp_register_style( 'mm_css', plugins_url('css/app.css', dirname(__FILE__)));
	wp_enqueue_style( 'mm_css' );
}

add_action('wp_enqueue_scripts','register_custom_scripts');

function insert_multisite_metabar() {
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
