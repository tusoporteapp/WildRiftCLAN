<?php

/* Theme Scripts
---------------------------------------------------------------------------------------------------- */

function theme_scripts() {

    // Deregister some scripts.
    wp_deregister_script('jquery');
    wp_deregister_script('wp-embed');


	wp_enqueue_script(
		'all',
		get_template_directory_uri() . '/js/all.js',
		array(),
		'614', true
	);

}
add_action('wp_enqueue_scripts', 'theme_scripts');
