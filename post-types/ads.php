<?php

/**
 * Registers the `ads` post type.
 */
function ads_init() {
	register_post_type(
		'ads',
		[
			'labels'                => [
				'name'                  => __( 'Advertisings', 'wp-ads' ),
				'singular_name'         => __( 'Advertising', 'wp-ads' ),
				'all_items'             => __( 'All Advertisings', 'wp-ads' ),
				'archives'              => __( 'Advertising Archives', 'wp-ads' ),
				'attributes'            => __( 'Advertising Attributes', 'wp-ads' ),
				'insert_into_item'      => __( 'Insert into Advertising', 'wp-ads' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Advertising', 'wp-ads' ),
				'featured_image'        => _x( 'Featured Image', 'ads', 'wp-ads' ),
				'set_featured_image'    => _x( 'Set featured image', 'ads', 'wp-ads' ),
				'remove_featured_image' => _x( 'Remove featured image', 'ads', 'wp-ads' ),
				'use_featured_image'    => _x( 'Use as featured image', 'ads', 'wp-ads' ),
				'filter_items_list'     => __( 'Filter Advertisings list', 'wp-ads' ),
				'items_list_navigation' => __( 'Advertisings list navigation', 'wp-ads' ),
				'items_list'            => __( 'Advertisings list', 'wp-ads' ),
				'new_item'              => __( 'New Advertising', 'wp-ads' ),
				'add_new'               => __( 'Add New', 'wp-ads' ),
				'add_new_item'          => __( 'Add New Advertising', 'wp-ads' ),
				'edit_item'             => __( 'Edit Advertising', 'wp-ads' ),
				'view_item'             => __( 'View Advertising', 'wp-ads' ),
				'view_items'            => __( 'View Advertisings', 'wp-ads' ),
				'search_items'          => __( 'Search Advertisings', 'wp-ads' ),
				'not_found'             => __( 'No Advertisings found', 'wp-ads' ),
				'not_found_in_trash'    => __( 'No Advertisings found in trash', 'wp-ads' ),
				'parent_item_colon'     => __( 'Parent Advertising:', 'wp-ads' ),
				'menu_name'             => __( 'Advertisings', 'wp-ads' ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => [ 'title', 'editor' ],
			'has_archive'           => true,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_rest'          => true,
			'rest_base'             => 'ads',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
	);

}

add_action( 'init', 'ads_init' );

/**
 * Sets the post updated messages for the `ads` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `ads` post type.
 */
function ads_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['ads'] = [
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Advertising updated. <a target="_blank" href="%s">View Advertising</a>', 'wp-ads' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'wp-ads' ),
		3  => __( 'Custom field deleted.', 'wp-ads' ),
		4  => __( 'Advertising updated.', 'wp-ads' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Advertising restored to revision from %s', 'wp-ads' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Advertising published. <a href="%s">View Advertising</a>', 'wp-ads' ), esc_url( $permalink ) ),
		7  => __( 'Advertising saved.', 'wp-ads' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Advertising submitted. <a target="_blank" href="%s">Preview Advertising</a>', 'wp-ads' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Advertising scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Advertising</a>', 'wp-ads' ), date_i18n( __( 'M j, Y @ G:i', 'wp-ads' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Advertising draft updated. <a target="_blank" href="%s">Preview Advertising</a>', 'wp-ads' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	];

	return $messages;
}

add_filter( 'post_updated_messages', 'ads_updated_messages' );

/**
 * Sets the bulk post updated messages for the `ads` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `ads` post type.
 */
function ads_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['ads'] = [
		/* translators: %s: Number of Advertisings. */
		'updated'   => _n( '%s Advertising updated.', '%s Advertisings updated.', $bulk_counts['updated'], 'wp-ads' ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Advertising not updated, somebody is editing it.', 'wp-ads' ) :
						/* translators: %s: Number of Advertisings. */
						_n( '%s Advertising not updated, somebody is editing it.', '%s Advertisings not updated, somebody is editing them.', $bulk_counts['locked'], 'wp-ads' ),
		/* translators: %s: Number of Advertisings. */
		'deleted'   => _n( '%s Advertising permanently deleted.', '%s Advertisings permanently deleted.', $bulk_counts['deleted'], 'wp-ads' ),
		/* translators: %s: Number of Advertisings. */
		'trashed'   => _n( '%s Advertising moved to the Trash.', '%s Advertisings moved to the Trash.', $bulk_counts['trashed'], 'wp-ads' ),
		/* translators: %s: Number of Advertisings. */
		'untrashed' => _n( '%s Advertising restored from the Trash.', '%s Advertisings restored from the Trash.', $bulk_counts['untrashed'], 'wp-ads' ),
	];

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'ads_bulk_updated_messages', 10, 2 );
