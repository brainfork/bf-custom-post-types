/**
 * JavaScript for netFORK Custom Post Types
 *
 * @package WordPress
 * @subpackage bf-cpt
 */

 jQuery( function( $ ) {
 	
 	$( document ).ready( function() {
 		
 		$('#bf-cpt-form').on('submit', function(e) {
 			e.preventDefault();
 			
 			var post_types = [];
 			$('.post_type:checked').each( function() {
 				post_types.push( $(this).val() );
 			});

 			$.post(
				ajaxurl,
				{
					action: 'bf_cpt_form_submit',
					post_types: post_types
				},
				function( response ) {
					location.reload();
				}
			)
 		});

 	});

 });