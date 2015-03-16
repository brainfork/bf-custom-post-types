<?php

if ( ! function_exists( 'bf_cpt_staff_register_meta' ) ) {
	function bf_cpt_staff_register_post_types() {

		/* Get theme text domain. */

		$text_domain = wp_get_theme()->get( 'TextDomain' );

		/* Register the Staff Member post type. */

		register_post_type(
			'staff_member',
			array(
				'description'         => '',
				'public'              => true,
				'publicly_queryable'  => true,
				'show_in_nav_menus'   => false,
				'show_in_admin_bar'   => true,
				'exclude_from_search' => false,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 12,
				'menu_icon'           => 'dashicons-businessman',
				'can_export'          => true,
				'delete_with_user'    => false,
				'hierarchical'        => false,
				'has_archive'         => 'staff',
				'query_var'           => 'staff_member',
				'capability_type'     => 'staff_member',
				'map_meta_cap'        => true,

				/* Capabilities. */
				'capabilities' => array(

					// meta caps (don't assign these to roles)
					'edit_post'              => 'edit_staff_member',
					'read_post'              => 'read_staff_member',
					'delete_post'            => 'delete_staff_member',

					// primitive/meta caps
					'create_posts'           => 'create_staff_members',

					// primitive caps used outside of map_meta_cap()
					'edit_posts'             => 'edit_staff_members',
					'edit_others_posts'      => 'manage_staff',
					'publish_posts'          => 'manage_staff',
					'read_private_posts'     => 'read',

					// primitive caps used inside of map_meta_cap()
					'read'                   => 'read',
					'delete_posts'           => 'manage_staff',
					'delete_private_posts'   => 'manage_staff',
					'delete_published_posts' => 'manage_staff',
					'delete_others_posts'    => 'manage_staff',
					'edit_private_posts'     => 'edit_staff_members',
					'edit_published_posts'   => 'edit_staff_members'
				),

				/* The rewrite handles the URL structure. */
				'rewrite' => array(
					'slug'       => 'staff',
					'with_front' => false,
					'pages'      => true,
					'feeds'      => true,
					'ep_mask'    => EP_PERMALINK,
				),

				/* What features the post type supports. */
				'supports' => array(
					'title',
					'editor',
					'excerpt',
					'author',
					'thumbnail'
				),

				/* Labels used when displaying the posts. */
				'labels' => array(
					'name'               => __( 'Staff',                   $text_domain ),
					'singular_name'      => __( 'Staff Member',            $text_domain ),
					'menu_name'          => __( 'Staff Member',            $text_domain ),
					'name_admin_bar'     => __( 'Staff Member',            $text_domain ),
					'add_new'            => __( 'Add New',                 $text_domain ),
					'add_new_item'       => __( 'Add New Staff Member',    $text_domain ),
					'edit_item'          => __( 'Edit Staff Member',       $text_domain ),
					'new_item'           => __( 'New Staff Member',        $text_domain ),
					'view_item'          => __( 'View Staff Member',       $text_domain ),
					'search_items'       => __( 'Search Staff',            $text_domain ),
					'not_found'          => __( 'No staff found',          $text_domain ),
					'not_found_in_trash' => __( 'No staff found in trash', $text_domain ),
					'all_items'          => __( 'All Staff',               $text_domain ),
				)
			)
		);
	}
	add_action( 'init', 'bf_cpt_staff_register_post_types' );
}