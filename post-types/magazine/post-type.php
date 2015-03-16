<?php

if ( ! function_exists( 'magazine_post_type' ) ) {
	function magazine_post_type() {

		/* Register the Magazine post type. */

		register_post_type(
			'magazine',
			array(
				'description'         => '',
				'public'              => true,
				'publicly_queryable'  => true,
				'show_in_nav_menus'   => false,
				'show_in_admin_bar'   => true,
				'exclude_from_search' => false,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 6,
				'menu_icon'           => 'dashicons-book',
				'can_export'          => true,
				'delete_with_user'    => false,
				'hierarchical'        => false,
				'has_archive'         => 'magazines',
				'query_var'           => 'magazine',
				'capability_type'     => 'magazine',
				'map_meta_cap'        => true,

				/* Capabilities. */
				'capabilities' => array(

					// meta caps (don't assign these to roles)
					'edit_post'              => 'edit_magazine',
					'read_post'              => 'read_magazine',
					'delete_post'            => 'delete_magazine',

					// primitive/meta caps
					'create_posts'           => 'create_magazines',

					// primitive caps used outside of map_meta_cap()
					'edit_posts'             => 'edit_magazines',
					'edit_others_posts'      => 'manage_magazine',
					'publish_posts'          => 'manage_magazine',
					'read_private_posts'     => 'read',

					// primitive caps used inside of map_meta_cap()
					'read'                   => 'read',
					'delete_posts'           => 'manage_magazine',
					'delete_private_posts'   => 'manage_magazine',
					'delete_published_posts' => 'manage_magazine',
					'delete_others_posts'    => 'manage_magazine',
					'edit_private_posts'     => 'edit_magazines',
					'edit_published_posts'   => 'edit_magazines'
				),

				/* The rewrite handles the URL structure. */
				'rewrite' => array(
					'slug'       => 'magazine',
					'with_front' => false,
					'pages'      => true,
					'feeds'      => true,
					'ep_mask'    => EP_PERMALINK,
				),

				/* What features the post type supports. */
				'supports' => array(
					'title',
					'editor',
				),

				/* Labels used when displaying the posts. */
				'labels' => array(
					'name'               => 'Magazines',
					'singular_name'      => 'Magazine',
					'menu_name'          => 'Magazines',
					'name_admin_bar'     => 'Magazine',
					'add_new'            => 'Add New',
					'add_new_item'       => 'Add New Magazine',
					'edit_item'          => 'Edit Magazine',
					'new_item'           => 'New Magazine',
					'view_item'          => 'View Magazine',
					'search_items'       => 'Search Magazines',
					'not_found'          => 'No magazines found',
					'not_found_in_trash' => 'No magazines found in trash',
					'all_items'          => 'All Magazines',
				)
			)
		);
	}
	add_action( 'init', 'magazine_post_type' );
}