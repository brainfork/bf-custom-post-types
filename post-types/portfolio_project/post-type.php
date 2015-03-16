<?php

if ( ! function_exists( 'bf_cpt_portfolio_register_post_types' ) ) {
	function bf_cpt_portfolio_register_post_types() {

		/* Get theme text domain. */

		$text_domain = wp_get_theme()->get( 'TextDomain' );

		/* Register the Portfolio Project post type. */

		register_post_type(
			'portfolio_project',
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
				'menu_icon'           => 'dashicons-portfolio',
				'can_export'          => true,
				'delete_with_user'    => false,
				'hierarchical'        => false,
				'has_archive'         => 'portfolio',
				'query_var'           => 'portfolio_project',
				'capability_type'     => 'portfolio_project',
				'map_meta_cap'        => true,

				/* Capabilities. */
				'capabilities' => array(

					// meta caps (don't assign these to roles)
					'edit_post'              => 'edit_portfolio_project',
					'read_post'              => 'read_portfolio_project',
					'delete_post'            => 'delete_portfolio_project',

					// primitive/meta caps
					'create_posts'           => 'create_portfolio_projects',

					// primitive caps used outside of map_meta_cap()
					'edit_posts'             => 'edit_portfolio_projects',
					'edit_others_posts'      => 'manage_portfolio',
					'publish_posts'          => 'manage_portfolio',
					'read_private_posts'     => 'read',

					// primitive caps used inside of map_meta_cap()
					'read'                   => 'read',
					'delete_posts'           => 'manage_portfolio',
					'delete_private_posts'   => 'manage_portfolio',
					'delete_published_posts' => 'manage_portfolio',
					'delete_others_posts'    => 'manage_portfolio',
					'edit_private_posts'     => 'edit_portfolio_projects',
					'edit_published_posts'   => 'edit_portfolio_projects'
				),

				/* The rewrite handles the URL structure. */
				'rewrite' => array(
					'slug'       => 'portfolio',
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
					'name'               => __( 'Projects',                   $text_domain ),
					'singular_name'      => __( 'Project',                    $text_domain ),
					'menu_name'          => __( 'Portfolio',                  $text_domain ),
					'name_admin_bar'     => __( 'Portfolio Project',          $text_domain ),
					'add_new'            => __( 'Add New',                    $text_domain ),
					'add_new_item'       => __( 'Add New Project',            $text_domain ),
					'edit_item'          => __( 'Edit Project',               $text_domain ),
					'new_item'           => __( 'New Project',                $text_domain ),
					'view_item'          => __( 'View Project',               $text_domain ),
					'search_items'       => __( 'Search Projects',            $text_domain ),
					'not_found'          => __( 'No projects found',          $text_domain ),
					'not_found_in_trash' => __( 'No projects found in trash', $text_domain ),
					'all_items'          => __( 'Projects',                   $text_domain ),
				)
			)
		);
	}
	add_action( 'init', 'bf_cpt_portfolio_register_post_types' );
}