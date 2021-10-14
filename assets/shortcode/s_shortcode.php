<?php
/**
 * Shortcode by Seed Webs
 */

// TIME AGO
function s_time_ago() {
	
	return  sprintf( esc_html__( '%s ago', 'bai' ), human_time_diff(get_the_time( 'U' ), current_time( 'timestamp' ) ) );
}
add_shortcode('s_time_ago', 's_time_ago'); 

// MAIN CATEGORY
function s_main_category() {
	$cats = wp_get_post_terms(get_the_ID(),'category', ['fields' => 'all']);
	$main_cat_id = intval(get_post_meta( get_the_ID(), '_primary_term_' . 'category', true ));
	$main_cat_link = false;
	foreach($cats as $cat) {
   		if( $main_cat_id == $cat->term_id ) {
			$main_cat_link = get_category_link($main_cat_id);
			$main_cat_name = $cat->name;
			break;
   		}
	}
	if ($main_cat_link == false) {
		$category = get_the_category();
		$main_cat_link = get_category_link( $category[0]->term_id );
		$main_cat_name = $category[0]->cat_name;
	}
	return '<a class="cat" href="' . $main_cat_link . '">' . $main_cat_name . '</a>';
}
add_shortcode('s_main_category', 's_main_category'); 


// FULL FEATURED IMAGE
function s_featured_img() {
	if(has_post_thumbnail()) {
		$output  = '<div class="entry-image"><div class="bg"></div>';
		$output .= '<div class="img">' . get_the_post_thumbnail( get_the_ID(), 'full' ) . '</div>'; 
		$output .= '</div>';
		return $output;
	}
}
add_shortcode('s_featured_img', 's_featured_img'); 