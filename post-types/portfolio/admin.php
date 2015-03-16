<?php

function add_new_portfolio_project_columns( $portfolio_project_columns ) {
	$new_columns['id'] = __('ID');  
	
	foreach ($new_columns as $key => $value) {
		$portfolio_project_columns[$key] = $value;
	}
	
	return $portfolio_project_columns;
}
add_filter('manage_edit-portfolio_project_columns', 'add_new_portfolio_project_columns');

function manage_portfolio_project_columns( $column_name, $id ) {
	switch ( $column_name ) {
		case 'id':
			echo $id;
		break;
	}
}
add_action('manage_portfolio_project_posts_custom_column', 'manage_portfolio_project_columns', 10, 2);

function sortable_portfolio_project_columns( $columns ) {
    $columns['id'] = 'ID';
 
    return $columns;
}
add_filter( 'manage_edit-portfolio_project_sortable_columns', 'sortable_portfolio_project_columns' );
?>
