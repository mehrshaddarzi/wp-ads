<?php

/**
 * Registers the `city` taxonomy,
 * for use with 'ads'.
 */
function city_init() {
	register_taxonomy( 'city', [ 'ads' ], [
		'hierarchical'          => false,
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_admin_column'     => false,
		'query_var'             => true,
		'rewrite'               => true,
		'capabilities'          => [
			'manage_terms' => 'edit_posts',
			'edit_terms'   => 'edit_posts',
			'delete_terms' => 'edit_posts',
			'assign_terms' => 'edit_posts',
		],
		'labels'                => [
			'name'                       => __( 'Cities', 'wp-ads' ),
			'singular_name'              => _x( 'City', 'taxonomy general name', 'wp-ads' ),
			'search_items'               => __( 'Search Cities', 'wp-ads' ),
			'popular_items'              => __( 'Popular Cities', 'wp-ads' ),
			'all_items'                  => __( 'All Cities', 'wp-ads' ),
			'parent_item'                => __( 'Parent City', 'wp-ads' ),
			'parent_item_colon'          => __( 'Parent City:', 'wp-ads' ),
			'edit_item'                  => __( 'Edit City', 'wp-ads' ),
			'update_item'                => __( 'Update City', 'wp-ads' ),
			'view_item'                  => __( 'View City', 'wp-ads' ),
			'add_new_item'               => __( 'Add New City', 'wp-ads' ),
			'new_item_name'              => __( 'New City', 'wp-ads' ),
			'separate_items_with_commas' => __( 'Separate Cities with commas', 'wp-ads' ),
			'add_or_remove_items'        => __( 'Add or remove Cities', 'wp-ads' ),
			'choose_from_most_used'      => __( 'Choose from the most used Cities', 'wp-ads' ),
			'not_found'                  => __( 'No Cities found.', 'wp-ads' ),
			'no_terms'                   => __( 'No Cities', 'wp-ads' ),
			'menu_name'                  => __( 'Cities', 'wp-ads' ),
			'items_list_navigation'      => __( 'Cities list navigation', 'wp-ads' ),
			'items_list'                 => __( 'Cities list', 'wp-ads' ),
			'most_used'                  => _x( 'Most Used', 'city', 'wp-ads' ),
			'back_to_items'              => __( '&larr; Back to Cities', 'wp-ads' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'city',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'city_init' );

/**
 * Sets the post updated messages for the `city` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `city` taxonomy.
 */
function city_updated_messages( $messages ) {

	$messages['city'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'City added.', 'wp-ads' ),
		2 => __( 'City deleted.', 'wp-ads' ),
		3 => __( 'City updated.', 'wp-ads' ),
		4 => __( 'City not added.', 'wp-ads' ),
		5 => __( 'City not updated.', 'wp-ads' ),
		6 => __( 'Cities deleted.', 'wp-ads' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'city_updated_messages' );
