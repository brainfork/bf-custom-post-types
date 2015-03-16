<?php

if ( ! function_exists( 'bf_cpt_staff_taxonomies' ) ) {
	function bf_cpt_staff_taxonomies() {

		/* Get theme text domain. */

		$text_domain= wp_get_theme()->get( 'TextDomain' );

		/* Register the Portfolio Category taxonomy. */

		register_taxonomy(
			'staff_category',
			array( 'staff_members' ),
			array(
				'public'			=> true,
				'show_ui'			=> true,
				'show_in_nav_menus'	=> true,
				'show_tagcloud'		=> true,
				'show_admin_column'	=> true,
				'hierarchical'		=> true,
				'query_var'			=> 'staff_category',

				/* Capabilities. */
				'capabilities' => array(
					'manage_terms'	=> 'manage_staff',
					'edit_terms'	=> 'manage_staff',
					'delete_terms'	=> 'manage_staff',
					'assign_terms'	=> 'edit_staff_members',
				),

				/* The rewrite handles the URL structure. */
				'rewrite' => array(
					'slug'			=> 'staff/category',
					'with_front'	=> false,
					'hierarchical'	=> true,
					'ep_mask'		=> EP_NONE
				),

				/* Labels used when displaying taxonomy and terms. */
				'labels' => array(
					'name'							=> __( 'Staff Categories',		$text_domain ),
					'singular_name'					=> __( 'Staff Category',		$text_domain ),
					'menu_name'						=> __( 'Categories',			$text_domain ),
					'name_admin_bar'				=> __( 'Category',				$text_domain ),
					'search_items'					=> __( 'Search Categories',		$text_domain ),
					'popular_items'					=> __( 'Popular Categories',	$text_domain ),
					'all_items'						=> __( 'All Categories',		$text_domain ),
					'edit_item'						=> __( 'Edit Category',			$text_domain ),
					'view_item'						=> __( 'View Category',			$text_domain ),
					'update_item'					=> __( 'Update Category',		$text_domain ),
					'add_new_item'					=> __( 'Add New Category',		$text_domain ),
					'new_item_name'					=> __( 'New Category Name',		$text_domain ),
					'parent_item'					=> __( 'Parent Category',		$text_domain ),
					'parent_item_colon'				=> __( 'Parent Category:',		$text_domain ),
					'separate_items_with_commas'	=> null,
					'add_or_remove_items'			=> null,
					'choose_from_most_used'			=> null,
					'not_found'						=> null,
				)
			)
		);

		/* Register the Portfolio Tag taxonomy. */

		register_taxonomy(
			'staff_tag',
			array( 'staff_members' ),
			array(
				'public'			=> true,
				'show_ui'			=> true,
				'show_in_nav_menus'	=> true,
				'show_tagcloud'		=> true,
				'show_admin_column'	=> true,
				'hierarchical'		=> false,
				'query_var'			=> 'staff_tag',

				/* Capabilities. */
				'capabilities' => array(
					'manage_terms'	=> 'manage_staff',
					'edit_terms'	=> 'manage_staff',
					'delete_terms'	=> 'manage_staff',
					'assign_terms'	=> 'edit_staff_members',
				),

				/* The rewrite handles the URL structure. */
				'rewrite' => array(
					'slug'			=> 'staff/tag',
					'with_front'	=> false,
					'hierarchical'	=> false,
					'ep_mask'		=> EP_NONE
				),

				/* Labels used when displaying taxonomy and terms. */
				'labels' => array(
					'name'							=> __( 'Staff Tags',						$text_domain ),
					'singular_name'					=> __( 'Staff Tag',							$text_domain ),
					'menu_name'						=> __( 'Tags',								$text_domain ),
					'name_admin_bar'				=> __( 'Tag',								$text_domain ),
					'search_items'					=> __( 'Search Tags',						$text_domain ),
					'popular_items'					=> __( 'Popular Tags',						$text_domain ),
					'all_items'						=> __( 'All Tags',							$text_domain ),
					'edit_item'						=> __( 'Edit Tag',							$text_domain ),
					'view_item'						=> __( 'View Tag',							$text_domain ),
					'update_item'					=> __( 'Update Tag',						$text_domain ),
					'add_new_item'					=> __( 'Add New Tag',						$text_domain ),
					'new_item_name'					=> __( 'New Tag Name',						$text_domain ),
					'separate_items_with_commas'	=> __( 'Separate tags with commas',			$text_domain ),
					'add_or_remove_items'			=> __( 'Add or remove tags',				$text_domain ),
					'choose_from_most_used'			=> __( 'Choose from the most used tags',	$text_domain ),
					'not_found'						=> __( 'No tags found',						$text_domain ),
					'parent_item'					=> null,
					'parent_item_colon'				=> null,
				)
			)
		);
	}
	add_action( 'init',	'bf_cpt_staff_taxonomies' );
}