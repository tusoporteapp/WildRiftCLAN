<?php



// Add Featured Image Support
add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );


/* Add HTML5 Custom Theme Support
---------------------------------------------------------------------------------------------------- */
function custom_theme_setup() {
	add_theme_support( 'html5', array( 'comment-list' ) );
}
add_action( 'after_setup_theme', 'custom_theme_setup' );


// Stop wrapping archive descriptions in tags
remove_filter('term_description','wpautop');

// Get Post tag links
function get_post_tag_links($seperator){
	$tags = wp_get_post_tags(get_the_ID());
	$html = '';
	$lastTag = end($tags);
	foreach ( $tags as $tag ){
	$tag_link = get_tag_link( $tag->term_id );
	$html .= "<a href='{$tag_link}' class='wordpress-post-tag'>{$tag->name}</a>";
		if ($tag != $lastTag) {
			$html .= $seperator;
		}
	}
	return $html;
}

// Get Template Asset
function get_template_asset_path($path){

	$assetPath = get_template_directory_uri();
	$assetPath .= $path;
	return $assetPath;
}

// Add Logo Customizer Function
function customise_theme_logo( $wp_customize ) {
	$wp_customize->add_section( 'theme_logo_img_section' , array(
	'title'       => __( 'Logo', 'themeslug' ),
	'priority'   => 30,
	'description' => 'Select a logo image to replace the default one'));
	$wp_customize->add_setting( 'theme_logo_img' );
	$wp_customize->add_control( new WP_Customize_Image_Control(
	$wp_customize, 'theme_logo_img', array(
	'label'   => __( 'Logo', 'themeslug' ),
	'section' => 'theme_logo_img_section',
	'settings' => 'theme_logo_img',
	)));
}
add_action( 'customize_register', 'customise_theme_logo' );