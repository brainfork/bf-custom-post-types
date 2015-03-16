<?php
/**
 * Admin Page for netFORK Custom Post Types
 *
 * @package WordPress
 * @subpackage bf-cpt
 */
?>

<div class="wrap">
	<h2>netFORK Custom Post Types</h2>

	<div id="bf-cpt" class="bf-cpt">
		<form id="bf-cpt-form" method="POST">
			<fieldset>
				<legend>Select Post Types to Include:</legend>
				<?php
				$path = plugin_dir_path( __FILE__ ) . 'post-types';
				$results = scandir($path);

				$post_types = array();
				foreach ($results as $result) {
				    if ($result === '.' or $result === '..') { 
				    	continue;
				    } else if( is_dir( trailingslashit( $path ) . $result ) ) {
				        $post_types[] = $result;
				    }
				}

				$current = get_option( 'bf_cpt_types' );

				foreach ($post_types as $post_type) {
					$checked = ( ! empty( $current ) && in_array( $post_type, $current ) ) ? ' checked' : '';

					echo '<input type="checkbox" id="post_type_' . $post_type . '" class="post_type" name="post_types[]" value="' . $post_type . '"' . $checked . '>';
					echo '<label for="post_type_' . $post_type . '">' . ucwords( str_replace( '_', ' ', $post_type ) ) . '</label>';
					echo '</br>';
				}
				?>
			</fieldset>

			<?php submit_button( 'Submit', 'primary', 'submit', FALSE ) ?>

		</form>
	</div>
</div>