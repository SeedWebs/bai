<?php

if ( ! function_exists( 'bai_support' ) ) :
	function bai_support()  {
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 600, 450);
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
	$url =  get_template_directory_uri() . '/assets/css/';
	wp_enqueue_style( 'b-seed', $url . 'seed.css', array(), $ver );
	wp_enqueue_style( 'b-header', $url . 'header.css', array(), $ver );
	if (is_front_page() || is_archive()) {
		wp_enqueue_style( 'b-loop', $url . 'loop.css', array(), $ver );
	}
	if (is_archive()) {
		wp_enqueue_style( 'b-archive', $url . 'archive.css', array(), $ver );
	}
	if (is_single()) {
		wp_enqueue_style( 'b-single', $url . 'single.css', array(), $ver );
	}
	if (is_page()) {
		wp_enqueue_style( 'b-page', $url . 'page.css', array(), $ver );
	}
	
	wp_enqueue_script('b-main', get_template_directory_uri() . '/assets/js/main.js', array(), $ver, true);
}
add_action( 'wp_enqueue_scripts', 'bai_scripts' );

/**
 * Remove "Category: ", "Tag: ", "Taxonomy: " from archive title
 */
add_filter('get_the_archive_title', 'seed_get_the_archive_title');
function seed_get_the_archive_title($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    }
    return $title;
}

require get_template_directory() . '/assets/shortcode/s_shortcode.php';