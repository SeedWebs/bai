<?php
/**
 * Setup theme support.
 */
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
	wp_enqueue_style( 'bai-seed', $url . 'seed.css', array(), $ver );
	wp_enqueue_style( 'bai-header', $url . 'header.css', array(), $ver );
	if (is_front_page() || is_archive()) {
		wp_enqueue_style( 'bai-loop', $url . 'loop.css', array(), $ver );
	}
	if (is_archive()) {
		wp_enqueue_style( 'bai-archive', $url . 'archive.css', array(), $ver );
	}
	if (is_single()) {
		wp_enqueue_style( 'bai-single', $url . 'single.css', array(), $ver );
	}
	if (is_page()) {
		wp_enqueue_style( 'bai-page', $url . 'page.css', array(), $ver );
	}
	
	wp_enqueue_script('bai', get_template_directory_uri() . '/assets/js/bai.js', array(), $ver, true);
}
add_action( 'wp_enqueue_scripts', 'bai_scripts' );

function bai_footer_styles() {
	$ver = wp_get_theme()->get( 'Version' );
    wp_enqueue_style( 'bai-footer', get_template_directory_uri() . '/assets/css/footer.css' , array() , $ver );
};
add_action( 'wp_footer', 'bai_footer_styles' );

/**
 * Remove "Category: ", "Tag: ", "Taxonomy: " from archive title
 */
add_filter('get_the_archive_title', 'bai_get_the_archive_title');
function bai_get_the_archive_title($title) {
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

/**
 * Time Ago.
 */
function bai_time_ago($date) {
	if (!is_single()) {
		return  sprintf( esc_html__( '%s ago', 'bai' ), human_time_diff(get_the_time( 'U' ), current_time( 'timestamp' ) ) );
	}
	return $date;
}
add_filter( 'get_the_date', 'bai_time_ago' );