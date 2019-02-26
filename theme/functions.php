<?php
/**
 * Functions for the Funny Colors Theme
 *
 * The file contains the definitions  of the theme features, menus, sidebars and custimizable options
 *
 * @package SWTK
 * @subpackage blue_pines
 * @since Funny Colors 1.0
 */

// define content width

if ( ! isset( $content_width ) ) {
	$content_width = 1024;
}

// textdomain

function blue_pines_register_textdomain() {
  load_theme_textdomain('blue-pines', get_template_directory()."/languages");
}

add_action('after_setup_theme','blue_pines_register_textdomain');

// add theme support

function blue_pines_setup() {
	add_theme_support('custom-header');
	add_theme_support('title-tag');
	add_theme_support('automatic-feed-links');
	add_theme_support('post-formats');
	add_theme_support('custom-logo', array(
	    'height'      => 200,
	    'width'       => 200,
	    'flex-height' => true,
	    'flex-width'  => true,
	    'header-text' => array( 'site-title', 'site-description' ),
	));

	add_theme_support( "post-thumbnails" );
	add_theme_support( "custom-background" );

}

add_action('after_setup_theme', 'blue_pines_setup');

// add editor style for old versions

add_editor_style();

// add editor style for Gutenberg

function blue_pines_block_editor_styles() {
    wp_enqueue_style(
		'blue-pines-block-editor-styles',
		get_theme_file_uri( 'editor-style.css' ),
		false
	);
}

add_action( 'enqueue_block_editor_assets', 'blue_pines_block_editor_styles' );

// enqueue styles and scripts

function blue_pines_enqueue_styles_scripts() {
	wp_enqueue_style('swtk-style', get_stylesheet_uri(), [], wp_get_theme()->get('Version') );
	wp_enqueue_style('swtk-style-all', get_theme_file_uri('/css/style.css'), ['swtk-style'], wp_get_theme()->get('Version') );

    wp_enqueue_script('swtk-jquery', get_theme_file_uri('/js/jquery-3.3.1.js'), [], null, true );
	wp_enqueue_script('swtk-script', get_theme_file_uri('/js/index.js'), ['swtk-jquery'], wp_get_theme()->get('Version'), true );

	if( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action('wp_enqueue_scripts', 'blue_pines_enqueue_styles_scripts');

// menus

function blue_pines_register_menus() {
  register_nav_menus(
    [
        'primary' => __('Primary Menu', 'blue-pines'),
        'secondary' => __('Secondary Menu', 'blue-pines'),
    ]
  );
}

add_action('init','blue_pines_register_menus');

function blue_pines_register_widget_areas() {
  register_sidebar([
    'name' => __('Right sidebar','blue-pines'),
    'id' => 'right-sidebar',
  ]);
  register_sidebar([
    'name' => __('Footer left sidebar','blue-pines'),
    'id' => 'footer-left-sidebar',
  ]);
  register_sidebar([
    'name' => __('Footer center sidebar','blue-pines'),
    'id' => 'footer-center-sidebar',
  ]);
  register_sidebar([
    'name' => __('Footer right sidebar','blue-pines'),
    'id' => 'footer-right-sidebar',
  ]);
  register_sidebar([
    'name' => __('Header sidebar','blue-pines'),
    'id' => 'header-sidebar',
  ]);
}

add_action('widgets_init', 'blue_pines_register_widget_areas');


// add footer text option

function blue_pines_register_footer_text_option ($wp_customize) {
    $wp_customize->add_setting('footer_text', [
        'default' => '',
        'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_section('footer_text_section', [
        'title' => __('Footer text','blue-pines'),
        'priority' => 100,
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'footer_text',[
        'label' => __('Footer text','blue-pines'),
        'type'  => 'textarea',
        'section' => 'footer_text_section',
        'setting' => 'footer_text',
    ]));
}

add_action('customize_register', 'blue_pines_register_footer_text_option');

// add social buttons for footer

function blue_pines_sanitize_image_files($file, $setting) {
	$mimes = [
		'jpg|jpeg|jpe' => 'image/jpeg',
		'png'          => 'image/png',
	];

	//check file type from file name
	$file_ext = wp_check_filetype( $file, $mimes );

	//if file has a valid mime type return it, otherwise return default
	return ( $file_ext['ext'] ? $file : $setting->default );
}

function blue_pines_register_footer_socials($wp_customize) {
    $wp_customize->add_setting('social_link_1', [
        'default' => '',
        'transport' => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_setting('social_icon_1', [
        'default' => '',
        'transport' => 'refresh',
		'sanitize_callback' => 'blue_pines_sanitize_image_files',
    ]);

    $wp_customize->add_setting('social_link_2', [
        'default' => '',
        'transport' => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_setting('social_icon_2', [
        'default' => '',
        'transport' => 'refresh',
		'sanitize_callback' => 'blue_pines_sanitize_image_files',
    ]);

    $wp_customize->add_setting('social_link_3', [
        'default' => '',
        'transport' => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_setting('social_icon_3', [
        'default' => '',
        'transport' => 'refresh',
		'sanitize_callback' => 'blue_pines_sanitize_image_files',
    ]);

    $wp_customize->add_section('footer_socials_section', [
        'title' => __('Footer social buttons','blue-pines'),
        'priority' => 110,
    ]);

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'social_link_1',[
        'label' => __('Social link 1','blue-pines'),
        'type'  => 'url',
        'section' => 'footer_socials_section',
        'setting' => 'social_link_1',
    ]));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'social_icon_1',[
        'label' => __('Social icon 1','blue-pines'),
        'section' => 'footer_socials_section',
        'setting' => 'social_icon_1',
    ]));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'social_link_2',[
        'label' => __('Social link 2','blue-pines'),
        'type'  => 'url',
        'section' => 'footer_socials_section',
        'setting' => 'social_link_2',
    ]));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'social_icon_2',[
        'label' => __('Social icon 2','blue-pines'),
        'section' => 'footer_socials_section',
        'setting' => 'social_icon_2',
    ]));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'social_link_3',[
        'label' => __('Social link 3','blue-pines'),
        'type'  => 'url',
        'section' => 'footer_socials_section',
        'setting' => 'social_link_3',
    ]));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'social_icon_3',[
        'label' => __('Social icon 3','blue-pines'),
        'section' => 'footer_socials_section',
        'setting' => 'social_icon_3',
    ]));
}

add_action('customize_register', 'blue_pines_register_footer_socials');


?>
