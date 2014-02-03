<?php
   /*
   Plugin Name: SG Campus stuff
   Plugin URI: http://sgcampus.com.mx
   Description: Plugin for SG Campus specific stuff
   Version: 0.10
   Author: Pedro Galvan
   Author URI: http://sg.com.mx
   License: MIT
   */

add_action( 'init', 'create_post_type' );

function create_post_type() {
	register_post_type( 'webinar',
		array(
			'labels' => array(
				'name' => __( 'Webinars' ),
				'singular_name' => __( 'Webinar' )
			),
		'public' => true,
		'has_archive' => true,
		'taxonomies' => array( 'category', 'post_tag' ),
		)
	);
	register_taxonomy_for_object_type( 'category', 'webinar' );
	register_taxonomy_for_object_type( 'post_tag', 'webinar' );
}

add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
/*
function add_my_post_types_to_query( $query ) {
	if ( is_home() && $query->is_main_query() )
			$query->set( 'post_type', array( 'post', 'webinar' ) );
	if ( ! is_admin() && ! is_home() && $query->is_main_query() )
			$query->set( 'post_type', array( 'post', 'webinar' ) );
	return $query;
}
*/
?>
