<?php
// Add to admin_init function
add_filter('manage_edit-issue_columns', 'add_new_issue_columns');

function add_new_issue_columns($issue_columns) {
    write_log($issue_columns, '$issue_columns');

    $new_columns['id'] = __('ID');

    write_log($new_columns, '$new_columns');
    
    foreach ($new_columns as $key => $value) {
        $issue_columns[$key] = $value;
    }
    write_log($issue_columns, 'updated $issue_columns');

    return $issue_columns;
}

// Add to admin_init function
add_action('manage_issue_posts_custom_column', 'manage_issue_columns', 10, 2);
 
function manage_issue_columns($column_name, $id) {
    switch ($column_name) {
    case 'id':
        echo $id;
            break;
    default:
        break;
    } // end switch
}   
?>