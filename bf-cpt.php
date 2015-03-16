<?php
/**
 * Plugin Name: netFORK Custom Post Types
 * Plugin URI: http://dev.BRAINfork.net
 * Description: Standardized custom cost types for use on the netFORK multisite network
 * Version: 0.1
 * Author: Kaleb J. Barker
 * Author URI: http://BRAINfork.net
 * Text Domain: bf-cpt
 * License: GPL2
 */

/**
 * Creates plugin menu.
 * 
 * @uses bf_cpt_admin
 * @uses bf_cpt_scripts
 * @uses bf_cpt_styles
 */
function bf_cpt_menu() {
	$admin = add_submenu_page( 'options-general.php', 'netFORK Custom Post Types', 'Post Types', 'manage_options', 'bf-cpt', 'bf_cpt_admin' );
	add_action( 'admin_print_scripts-' . $admin, 'bf_cpt_scripts' );
	// add_action( 'admin_print_styles-' . $admin, 'bf_cpt_styles' );
}
add_action( 'admin_menu', 'bf_cpt_menu' );

/**
 * Creates admin page.
 */
function bf_cpt_admin() {
	include("bf-cpt-admin.php");
}

/**
 * Enqueues scripts.
 */
function bf_cpt_scripts() {
	wp_register_script( 'bf-cpt-js', plugins_url( 'bf-cpt.js', __FILE__ ), array( 'jquery' ) );
	wp_enqueue_script( 'bf-cpt-js' );
}

/**
 * Enqueues styles.
 */
function bf_cpt_styles() {
	wp_register_style( 'bf-cpt-css', plugins_url( 'bf-cpt.css', __FILE__ ) );
	wp_enqueue_style( 'bf-cpt-css' );
}


function bf_cpt_form_submit() {
	if( $_POST['action'] = 'bf_cpt_form_submit' ) {
		if ( isset( $_POST['post_types'] ) ) {
			foreach ( $_POST['post_types'] as $post_type ) {
				$update[] = $post_type;
			}
		} else {
			$update = array();
		}
		update_option( 'bf_cpt_types', $update );
	}
}
add_action('wp_ajax_bf_cpt_form_submit','bf_cpt_form_submit');
add_action('wp_ajax_nopriv_bf_cpt_form_submit','bf_cpt_form_submit');

if ( $types = get_option( 'bf_cpt_types' ) ) {
	foreach ($types as $type) {
		require plugin_dir_path( __FILE__ ) . 'post-types/' . $type . '/post-type.php';
		if ( file_exists( plugin_dir_path( __FILE__ ) . 'post-types/' . $type . '/meta.php' ) ) {
			require plugin_dir_path( __FILE__ ) . 'post-types/' . $type . '/meta.php';
		}
		if ( file_exists( plugin_dir_path( __FILE__ ) . 'post-types/' . $type . '/taxonomies.php' ) ) {
			require plugin_dir_path( __FILE__ ) . 'post-types/' . $type . '/taxonomies.php';
		}
		if ( file_exists( plugin_dir_path( __FILE__ ) . 'post-types/' . $type . '/admin.php' ) ) {
			require plugin_dir_path( __FILE__ ) . 'post-types/' . $type . '/admin.php';
		}
	}
}