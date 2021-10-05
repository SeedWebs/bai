<?php

if ( ! function_exists( 'bai_support' ) ) :
	function bai_support()  {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/wp-editor.css' );
		add_theme_support( 'custom-units' );
	}
	add_action( 'after_setup_theme', 'bai_support' );
endif;

/**
 * Enqueue scripts and styles.
 */
function bai_scripts() {
	$ver = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'b-seed', get_template_directory_uri() . '/assets/css/seed.css', array(), $ver );
	wp_enqueue_style( 'b-seed', get_template_directory_uri() . '/assets/css/bai.css', array(), $ver );
	wp_enqueue_style( 'b-header', get_template_directory_uri() . '/assets/css/header.css', array(), $ver );
}

add_action( 'wp_enqueue_scripts', 'bai_scripts' );