<?php

if ( ! function_exists( 'issue_post_type' ) ) {
	function issue_post_type() {

		/* Register the Issue post type. */

		register_post_type(
			'issue',
			array(
				'description'         => '',
				'public'              => true,
				'publicly_queryable'  => true,
				'show_in_nav_menus'   => false,
				'show_in_admin_bar'   => true,
				'exclude_from_search' => false,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 7,
				'menu_icon'           => 'dashicons-calendar-alt',
				'can_export'          => true,
				'delete_with_user'    => false,
				'hierarchical'        => false,
				'has_archive'         => 'issues',
				'query_var'           => 'issue',
				'capability_type'     => 'issue',
				'map_meta_cap'        => true,

				/* Capabilities. */
				'capabilities' => array(

					// meta caps (don't assign these to roles)
					'edit_post'              => 'edit_issue',
					'read_post'              => 'read_issue',
					'delete_post'            => 'delete_issue',

					// primitive/meta caps
					'create_posts'           => 'create_issues',

					// primitive caps used outside of map_meta_cap()
					'edit_posts'             => 'edit_issues',
					'edit_others_posts'      => 'manage_issue',
					'publish_posts'          => 'manage_issue',
					'read_private_posts'     => 'read',

					// primitive caps used inside of map_meta_cap()
					'read'                   => 'read',
					'delete_posts'           => 'manage_issue',
					'delete_private_posts'   => 'manage_issue',
					'delete_published_posts' => 'manage_issue',
					'delete_others_posts'    => 'manage_issue',
					'edit_private_posts'     => 'edit_issues',
					'edit_published_posts'   => 'edit_issues'
				),

				/* The rewrite handles the URL structure. */
				'rewrite' => array(
					'slug'       => 'issue',
					'with_front' => false,
					'pages'      => true,
					'feeds'      => true,
					'ep_mask'    => EP_PERMALINK,
				),

				/* What features the post type supports. */
				'supports' => array(
					'thumbnail'
				),

				/* Labels used when displaying the posts. */
				'labels' => array(
					'name'               => 'Issues',
					'singular_name'      => 'Issue',
					'menu_name'          => 'Issues',
					'name_admin_bar'     => 'Issue',
					'add_new'            => 'Add New',
					'add_new_item'       => 'Add New Issue',
					'edit_item'          => 'Edit Issue',
					'new_item'           => 'New Issue',
					'view_item'          => 'View Issue',
					'search_items'       => 'Search Issues',
					'not_found'          => 'No issues found',
					'not_found_in_trash' => 'No issues found in trash',
					'all_items'          => 'All Issues',
				)
			)
		);
	}
	add_action( 'init', 'issue_post_type' );
}