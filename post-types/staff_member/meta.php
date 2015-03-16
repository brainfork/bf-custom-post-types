<?php

if ( ! function_exists( 'bf_cpt_staff_register_meta' ) ) {
	function bf_cpt_staff_register_meta() {

		/* Register post meta (note: you might want to alter the callbacks). */

		register_meta( 'post', '_project_url',        'esc_url_raw', '__return_true' );
		register_meta( 'post', '_project_client',     'strip_tags',  '__return_true' );
		register_meta( 'post', '_project_location',   'strip_tags',  '__return_true' );
		register_meta( 'post', '_project_start_date', 'strip_tags',  '__return_true' );
		register_meta( 'post', '_project_end_date',   'strip_tags',  '__return_true' );
	}
	add_action( 'init', 'bf_cpt_staff_register_meta' );
}