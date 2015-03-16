<?php

if ( ! function_exists( 'remove_magazine_meta_boxes' ) ) {
	function remove_magazine_meta_boxes() {
		remove_meta_box( 'slugdiv', 'magazine', 'normal' );
	}
	add_action( 'admin_menu', 'remove_magazine_meta_boxes' );
}

if ( ! function_exists( 'add_magazine_meta_boxes' ) ) {
	function add_magazine_meta_boxes() {
		add_meta_box( 'magazine_description', 'Magazine Description', 'magazine_description_meta', 'magazine' );
		add_meta_box( 'magazine_tag', 'Magazine Tag Line', 'magazine_tag_meta', 'magazine' );
		add_meta_box( 'magazine_discount', 'Magazine Discount', 'magazine_discount_meta', 'magazine' );
		add_meta_box( 'magazine_subscription', 'Magazine Subscription Links', 'magazine_subscription_meta', 'magazine' );
	}
	add_action( 'add_meta_boxes', 'add_magazine_meta_boxes' );

	function magazine_description_meta( $post ) {
		wp_nonce_field( 'magazine_description_meta', 'magazine_description_meta_nonce' );
		
		echo '<div class="meta-field">';
			echo '<label for="description">Magazine Description</label><br/>';
			echo '<textarea class="description" name="description" />' . esc_attr( get_post_meta( $post->ID, '_description', true ) ) . '</textarea><br/>';
			echo '<span class="howto">Description of the magazine, displayed on home page</span>';
		echo '</div>';
	}

	function save_magazine_description_meta( $post_id ) {
		if ( !isset( $_POST['magazine_description_meta_nonce'] ) && !wp_verify_nonce( $_POST['magazine_description_meta_nonce'], 'magazine_description_meta' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( isset( $_POST['description'] ) ) {
			update_post_meta( $post_id, '_description', sanitize_text_field( $_POST['description'] ) );
		}
	}
	add_action( 'save_post', 'save_magazine_description_meta' );

	function magazine_tag_meta( $post ) {
		wp_nonce_field( 'magazine_tag_meta', 'magazine_tag_meta_nonce' );
		
		echo '<div class="meta-field">';
			echo '<label for="tag">Magazine Tag Line</label><br/>';
			echo '<input type="text" class="tag" name="tag" value="' . esc_attr( get_post_meta( $post->ID, '_tag', true ) ) . '" /><br/>';
			echo '<span class="howto">Tagline for magazine, displayed on home page when magazine is dominant</span>';
		echo '</div>';
	}

	function save_magazine_tag_meta( $post_id ) {
		if ( !isset( $_POST['magazine_tag_meta_nonce'] ) && !wp_verify_nonce( $_POST['magazine_tag_meta_nonce'], 'magazine_tag_meta' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( isset( $_POST['tag'] ) ) {
			update_post_meta( $post_id, '_tag', sanitize_text_field( $_POST['tag'] ) );
		}
	}
	add_action( 'save_post', 'save_magazine_tag_meta' );

	function magazine_discount_meta( $post ) {
		wp_nonce_field( 'magazine_discount_meta', 'magazine_discount_meta_nonce' );
		
		echo '<div class="meta-field">';
			echo '<label for="discount">Magazine Discount</label><br/>';
			echo '<input type="text" class="discount" name="discount" value="' . esc_attr( get_post_meta( $post->ID, '_discount', true ) ) . '" /><br/>';
			echo '<span class="howto">Discount rate for magazine, displayed on issues</span>';
		echo '</div>';
	}

	function save_magazine_discount_meta( $post_id ) {
		if ( !isset( $_POST['magazine_discount_meta_nonce'] ) && !wp_verify_nonce( $_POST['magazine_discount_meta_nonce'], 'magazine_discount_meta' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( isset( $_POST['discount'] ) ) {
			update_post_meta( $post_id, '_discount', sanitize_text_field( $_POST['discount'] ) );
		}
	}
	add_action( 'save_post', 'save_magazine_discount_meta' );

	function magazine_subscription_meta( $post ) {
		wp_nonce_field( 'magazine_subscription_meta', 'magazine_subscription_meta_nonce' );
		
		echo '<div class="meta-field">';
			echo '<label for="subscribe">Subscribe</label><br/>';
			echo '<input type="text" class="subscribe" name="subscribe" value="' . esc_url( get_post_meta( $post->ID, '_subscribe', true ) ) . '" /><br/>';
			echo '<span class="howto">Subscribe link, displayed on issues</span>';
		echo '</div>';

		echo '<div class="meta-field">';
			echo '<label for="digital">Digital Edition</label><br/>';
			echo '<input type="text" class="digital" name="digital" value="' . esc_url( get_post_meta( $post->ID, '_digital', true ) ) . '" /><br/>';
			echo '<span class="howto">Digital editions link, displayed on issues</span>';
		echo '</div>';

		echo '<div class="meta-field">';
			echo '<label for="gift">Gift</label><br/>';
			echo '<input type="text" class="gift" name="gift" value="' . esc_url( get_post_meta( $post->ID, '_gift', true ) ) . '" /><br/>';
			echo '<span class="howto">Gift link, displayed on issues</span>';
		echo '</div>';

		echo '<div class="meta-field">';
			echo '<label for="renew">Renew</label><br/>';
			echo '<input type="text" class="renew" name="renew" value="' . esc_url( get_post_meta( $post->ID, '_renew', true ) ) . '" /><br/>';
			echo '<span class="howto">Renew link, displayed on issues</span>';
		echo '</div>';
	}

	function save_magazine_subscription_meta( $post_id ) {
		if ( !isset( $_POST['magazine_subscription_meta_nonce'] ) && !wp_verify_nonce( $_POST['magazine_subscription_meta_nonce'], 'magazine_subscription_meta' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( isset( $_POST['subscribe'] ) ) {
			update_post_meta( $post_id, '_subscribe', sanitize_text_field( $_POST['subscribe'] ) );
		}

		if ( isset( $_POST['digital'] ) ) {
			update_post_meta( $post_id, '_digital', sanitize_text_field( $_POST['digital'] ) );
		}

		if ( isset( $_POST['gift'] ) ) {
			update_post_meta( $post_id, '_gift', sanitize_text_field( $_POST['gift'] ) );
		}

		if ( isset( $_POST['renew'] ) ) {
			update_post_meta( $post_id, '_renew', sanitize_text_field( $_POST['renew'] ) );
		}
	}
	add_action( 'save_post', 'save_magazine_subscription_meta' );
}