<?php
// Add to admin_init function
add_filter('manage_edit-portfolio_project_columns', 'add_new_portfolio_project_columns');

function add_new_portfolio_project_columns($portfolio_project_columns) {
    write_log($portfolio_project_columns, '$portfolio_project_columns');

    $new_columns['id'] = __('ID');

    write_log($new_columns, '$new_columns');
    
    foreach ($new_columns as $key => $value) {
        $portfolio_project_columns[$key] = $value;
    }
    write_log($portfolio_project_columns, 'updated $portfolio_project_columns');

    return $portfolio_project_columns;
}

// Add to admin_init function
add_action('manage_portfolio_project_posts_custom_column', 'manage_portfolio_project_columns', 10, 2);
 
function manage_portfolio_project_columns($column_name, $id) {
    switch ($column_name) {
    case 'id':
        echo $id;
            break;
    default:
        break;
    } // end switch
}   
?>