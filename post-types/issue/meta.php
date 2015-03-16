<?php

if ( ! function_exists( 'remove_issue_meta_boxes' ) ) {
	function remove_issue_meta_boxes() {
		remove_meta_box( 'slugdiv', 'issue', 'normal' );
	}
	add_action( 'admin_menu', 'remove_issue_meta_boxes' );
}

if ( ! function_exists( 'add_issue_meta_boxes' ) ) {
	function add_issue_meta_boxes() {
		add_meta_box( 'issue_parent', 'Magazine', 'issue_parent_meta', 'issue' );
		add_meta_box( 'issue_release', 'Release Information', 'issue_release_meta', 'issue' );
		add_meta_box( 'issue_contents', 'Table of Contents', 'issue_contents_meta', 'issue' );
		add_meta_box( 'issue_buy', 'Buy Issue Link', 'issue_buy_meta', 'issue' );
	}
	add_action( 'add_meta_boxes', 'add_issue_meta_boxes' );

	function issue_parent_meta( $post ) {
		$magazines = get_posts( array( 'post_type' => 'magazine', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1 ) );

		if ( !empty( $magazines ) ) {
			echo '<select name="parent_id" class="widefat">';
				echo '<option value="0"' . selected( '0', $post->post_parent, false ) . '>Select Magazine</option>';
				foreach ( $magazines as $magazine ) {
					echo '<option value="' . esc_attr( $magazine->ID ) . '"' . selected( $magazine->ID, $post->post_parent, false ) . '>' . esc_html( $magazine->post_title ) . '</option>';
				}
			echo '</select>';
		}
	}

	function issue_release_meta( $post ) {
		wp_nonce_field( 'issue_release_meta', 'issue_release_meta_nonce' );

		echo '<h4>Release Title: ' . ( !empty( $post->post_title ) ? $post->post_title : 'Not Set' ) . '</h4>';

		echo '<div class="meta-field">';
			echo '<label for="label">Release Label</label><br/>';
			echo '<input type="text" class="label" name="label" value="' . esc_attr( get_post_meta( $post->ID, '_label', true ) ) . '" placeholder="Release Label" />';
			echo '<span class="howto">Optional label; replaces the month in release title</span>';
		echo '</div>';

		echo '<div class="meta-field">';
			echo '<label for="month">Release Month</label><br/>'; 
			echo '<select class="month" name="month">';
				echo '<option value="0"' . selected( '', esc_attr( get_post_meta( $post->ID, '_month', true ) ), false ) . ' disabled>Select Month</option>';
				for ( $m = 1; $m <= 12; $m++ ) {
					echo '<option value="' . $m . '"' . selected( $m, esc_attr( get_post_meta( $post->ID, '_month', true ) ), false ) . '>' . date( 'F', mktime( 0, 0, 0, $m, 1 ) ) . '</option>';
				}
			echo '</select>';
			echo '<span class="howto">Release month; used for sorting and in the title if no label is set</span>';
		echo '</div>';

		echo '<div class="meta-field">';
			echo '<label for="year">Release Year</label><br/>'; 
			echo '<select class="year" name="year">';
				echo '<option value="0"' . selected( '', esc_attr( get_post_meta( $post->ID, '_year', true ) ), false ) . ' disabled>Select Year</option>';
				for( $y = date( 'Y' ) + 1; $y >= 1988 ; $y-- ) {
					echo '<option value="' . $y . '"' . selected( $y, esc_attr( get_post_meta( $post->ID, '_year', true ) ), false ) . '>' . $y . '</option>';
				}
			echo '</select>';
			echo '<span class="howto">Release year; used for sorting and in the title</span>';
		echo '</div>';
	}

	function save_issue_release_meta( $post_id ) {
		if ( !isset( $_POST['issue_release_meta_nonce'] ) && !wp_verify_nonce( $_POST['issue_release_meta_nonce'], 'issue_release_meta' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		write_log($_POST, "$_POST");

		if ( isset( $_POST['label'] ) ) {
			update_post_meta( $post_id, '_label', sanitize_text_field( $_POST['label'] ) );
		}

		if ( isset( $_POST['month'] ) ) {
			update_post_meta( $post_id, '_month', sanitize_text_field( $_POST['month'] ) );
		}

		if ( isset( $_POST['year'] ) ) {
			update_post_meta( $post_id, '_year', sanitize_text_field( $_POST['year'] ) );
		}

		if ( isset( $_POST['month'] ) && isset( $_POST['year'] ) ) {
			global $wpdb;

			if ( !empty( $_POST['label'] ) ) {
				$title = $_POST['label'] . ' ' . $_POST['year'];
			} else {
				$title = date( 'F', mktime( 0, 0, 0, $_POST['month'], 1 ) ) . ' ' . $_POST['year'];
			}
			$wpdb->update( $wpdb->posts, array( 'post_title' => sanitize_text_field( $title ), 'post_name' => sanitize_title( $title ) ), array( 'ID' => $post_id ) );
			add_post_meta( $post_id, '_contents', array( 'features' => array(), 'departments' => array(), 'other' => array() ), true );
		}
	}
	add_action( 'save_post', 'save_issue_release_meta' );

	function issue_contents_meta( $post ) {
		wp_nonce_field( 'issue_contents_meta', 'issue_contents_meta_nonce' );

		$issue = set_postdata();

		if ( empty( $issue->issue_contents ) ) {
			echo '<p>Issue must be published before contents can be added.</p>';
		} else {
			foreach ( $issue->issue_contents as $section => $contents ) {
				echo '<h4>' . ucwords( $section ) . '</h4>';

				if ( !empty( $contents ) ) {
					echo '<div class="meta-field">';
						echo '<table class="issue-contents-sort">';
							echo '<thead>';
								echo '<tr>';
									echo '<th>Headline</th>';
									echo '<th>Byline</th>';
									echo '<th>Copy</th>';
									echo '<th colspan="2">Actions</th>';
								echo '</tr>';
							echo '</thead>';
							echo '<tbody data-post="' . $post->ID . '" data-section="' . $section . '">';
							foreach ( $contents as $key => $content ) {
								echo '<tr id="' . $key . '">';
									echo '<td><input type="text" class="headline" name="headline" value="' .  esc_attr( $content['headline'] ) . '" /></td>';
									echo '<td><input type="text" class="byline" name="byline" value="' .  esc_attr( $content['byline'] ) . '" /></td>';
									echo '<td><textarea class="copy" name="copy" />' . esc_textarea( $content['copy'] ) . '</textarea></td>';
									echo '<td><a class="issue-contents-update">Update</a></td>';
									echo '<td><a class="issue-contents-delete">Delete</a></td>';
								echo '</tr>';
							}
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
				}

				echo '<div class="meta-field">';
					echo '<input type="text" class="headline" name="headline" placeholder="Headline" />';
					echo '<input type="text" class="byline" name="byline" placeholder="Byline" />';
					echo '<textarea class="copy" name="copy" placeholder="Copy" /></textarea>';
					echo '<input type="button" class="issue-contents-add" data-post="' . $post->ID . '" data-section="' . $section . '" value="Add" />';
					echo '<div class="spinner"></div><br/>';
					echo '<span class="howto">Enter a label in the first input; Upload a file or type a URL in the second input</span>';
				echo '</div>';
			}
		}
	}

	function add_issue_contents_meta() {
		if( $_POST['action'] = 'add_issue_contents_meta' && $_POST['headline'] != '' ) {
			$contents = get_post_meta( $_POST['post_id'], '_contents', true );

			$content = array(
				'headline' => $_POST['headline'],
				'byline' => $_POST['byline'],
				'copy' => $_POST['copy']
			);

			$contents[$_POST['section']][] = $content;
			update_post_meta( $_POST['post_id'], '_contents', $contents);
		}
		die();
	}
	add_action('wp_ajax_add_issue_contents_meta','add_issue_contents_meta');
	add_action('wp_ajax_nopriv_add_issue_contents_meta','add_issue_contents_meta');

	function update_issue_contents_meta() {
		write_log($_POST, '$_POST');
		if( $_POST['action'] = 'update_issue_contents_meta' && $_POST['headline'] != '' ) {
			$contents = get_post_meta( $_POST['post_id'], '_contents', true );

			$content = array(
				'headline' => $_POST['headline'],
				'byline' => $_POST['byline'],
				'copy' => $_POST['copy']
			);

			$contents[$_POST['section']][$_POST['content']] = $content;
			update_post_meta( $_POST['post_id'], '_contents', $contents);
		}
		die();
	}
	add_action('wp_ajax_update_issue_contents_meta','update_issue_contents_meta');
	add_action('wp_ajax_nopriv_update_issue_contents_meta','update_issue_contents_meta');

	function delete_issue_contents_meta() {
		if( $_POST['action'] = 'delete_issue_contents_meta' ) {
			$contents = get_post_meta( $_POST['post_id'], '_contents', true );
			unset( $contents[$_POST['section']][$_POST['content']] );
			update_post_meta( $_POST['post_id'], '_contents', $contents );
		}
	}
	add_action('wp_ajax_delete_issue_contents_meta','delete_issue_contents_meta');
	add_action('wp_ajax_nopriv_delete_issue_contents_meta','delete_issue_contents_meta');

	function sort_issue_contents_meta() {
		if( $_POST['action'] = 'sort_issue_contents_meta' ) {
			$contents = get_post_meta( $_POST['post_id'], '_contents', true );
			$contents[$_POST['section']] = array_replace( array_flip( $_POST['order'] ), $contents[$_POST['section']] );
			update_post_meta( $_POST['post_id'], '_contents', $contents );
		}
	}
	add_action('wp_ajax_sort_issue_contents_meta','sort_issue_contents_meta');
	add_action('wp_ajax_nopriv_sort_issue_contents_meta','sort_issue_contents_meta');

	function issue_buy_meta( $post ) {
		wp_nonce_field( 'issue_buy_meta', 'issue_buy_meta_nonce' );
		
		echo '<div class="meta-field">';
			echo '<label for="buy">Buy Issue</label><br/>';
			echo '<input type="text" class="buy" name="buy" value="' . esc_attr( get_post_meta( $post->ID, '_buy', true ) ) . '" /><br/>';
			echo '<span class="howto">Optional buy issue link, displayed with subscription links on issue</span>';
		echo '</div>';
	}

	function save_issue_buy_meta( $post_id ) {
		if ( !isset( $_POST['issue_buy_meta_nonce'] ) && !wp_verify_nonce( $_POST['issue_buy_meta_nonce'], 'issue_buy_meta' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( isset( $_POST['buy'] ) ) {
			update_post_meta( $post_id, '_buy', sanitize_text_field( $_POST['buy'] ) );
		}
	}
	add_action( 'save_post', 'save_issue_buy_meta' );
}