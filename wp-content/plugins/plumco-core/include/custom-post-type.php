<?php

/**
 * Initialize Custom Post Type - Plumco Theme
 */

function plumco_custom_post_type() {

  $service_cpt = (plumco_framework_active()) ? cs_get_option('theme_service_name') : '';
  $service_slug = (plumco_framework_active()) ? cs_get_option('theme_service_slug') : '';
  $service_cpt_slug = (plumco_framework_active()) ? cs_get_option('theme_service_cat_slug') : '';

  $base = (isset($service_cpt_slug) && $service_cpt_slug !== '') ? sanitize_title_with_dashes($service_cpt_slug) : ((isset($service_cpt) && $service_cpt !== '') ? strtolower($service_cpt) : 'service');
  $base_slug = (isset($service_slug) && $service_slug !== '') ? sanitize_title_with_dashes($service_slug) : ((isset($service_cpt) && $service_cpt !== '') ? strtolower($service_cpt) : 'service');
  $label = ucfirst((isset($service_cpt) && $service_cpt !== '') ? strtolower($service_cpt) : 'service');

  // Register custom post type - Service
  register_post_type('service',
    array(
      'labels' => array(
        'name' => $label,
        'singular_name' => sprintf(esc_html__('%s Post', 'plumco-core' ), $label),
        'all_items' => sprintf(esc_html__('All %s', 'plumco-core' ), $label),
        'add_new' => esc_html__('Add New', 'plumco-core') ,
        'add_new_item' => sprintf(esc_html__('Add New %s', 'plumco-core' ), $label),
        'edit' => esc_html__('Edit', 'plumco-core') ,
        'edit_item' => sprintf(esc_html__('Edit %s', 'plumco-core' ), $label),
        'new_item' => sprintf(esc_html__('New %s', 'plumco-core' ), $label),
        'view_item' => sprintf(esc_html__('View %s', 'plumco-core' ), $label),
        'search_items' => sprintf(esc_html__('Search %s', 'plumco-core' ), $label),
        'not_found' => esc_html__('Nothing found in the Database.', 'plumco-core') ,
        'not_found_in_trash' => esc_html__('Nothing found in Trash', 'plumco-core') ,
        'parent_item_colon' => ''
      ) ,
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 10,
      'menu_icon' => 'dashicons-portfolio',
      'rewrite' => array(
        'slug' => $base_slug,
        'with_front' => false
      ),
      'has_archive' => true,
      'capability_type' => 'post',
      'hierarchical' => true,
      'supports' => array(
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt',
        'trackbacks',
        'custom-fields',
        'comments',
        'revisions',
        'sticky',
        'page-attributes'
      )
    )
  );
  // Registered

  // Add Category Taxonomy for our Custom Post Type - Service
  register_taxonomy(
    'service_category',
    'service',
    array(
      'hierarchical' => true,
      'public' => true,
      'show_ui' => true,
      'show_admin_column' => true,
      'show_in_nav_menus' => true,
      'labels' => array(
        'name' => sprintf(esc_html__( '%s Categories', 'plumco-core' ), $label),
        'singular_name' => sprintf(esc_html__('%s Category', 'plumco-core'), $label),
        'search_items' =>  sprintf(esc_html__( 'Search %s Categories', 'plumco-core'), $label),
        'all_items' => sprintf(esc_html__( 'All %s Categories', 'plumco-core'), $label),
        'parent_item' => sprintf(esc_html__( 'Parent %s Category', 'plumco-core'), $label),
        'parent_item_colon' => sprintf(esc_html__( 'Parent %s Category:', 'plumco-core'), $label),
        'edit_item' => sprintf(esc_html__( 'Edit %s Category', 'plumco-core'), $label),
        'update_item' => sprintf(esc_html__( 'Update %s Category', 'plumco-core'), $label),
        'add_new_item' => sprintf(esc_html__( 'Add New %s Category', 'plumco-core'), $label),
        'new_item_name' => sprintf(esc_html__( 'New %s Category Name', 'plumco-core'), $label)
      ),
      'rewrite' => array( 'slug' => $base . '_cat' ),
    )
  );

  $service_custom_taxonomies = (plumco_framework_active()) ? cs_get_option('service_custom_taxonomies') : '';
  $counter = 0;
  if ($service_custom_taxonomies) {
    foreach ($service_custom_taxonomies as $key => $custom_taxonomy) {
      $counter++;
      $heading = $custom_taxonomy['taxonomy_name'];
      $own_id = preg_replace('/[^a-z]/', "_", strtolower($heading));

      register_taxonomy(
        'service_'.$own_id,
        'service',
        array(
          'hierarchical' => true,
          'public' => true,
          'show_ui' => true,
          'show_admin_column' => true,
          'show_in_nav_menus' => true,
          'labels' => array(
            'name' => sprintf(esc_html__( '%s '.$heading, 'plumco-core' ), $label),
            'singular_name' => sprintf(esc_html__('%s '.$heading, 'plumco-core'), $label),
            'search_items' =>  sprintf(esc_html__( 'Search %s '.$heading, 'plumco-core'), $label),
            'all_items' => sprintf(esc_html__( 'All %s '.$heading, 'plumco-core'), $label),
            'parent_item' => sprintf(esc_html__( 'Parent %s '.$heading, 'plumco-core'), $label),
            'parent_item_colon' => sprintf(esc_html__( 'Parent %s :.$heading', 'plumco-core'), $label),
            'edit_item' => sprintf(esc_html__( 'Edit %s '.$heading, 'plumco-core'), $label),
            'update_item' => sprintf(esc_html__( 'Update %s '.$heading, 'plumco-core'), $label),
            'add_new_item' => sprintf(esc_html__( 'Add New %s '.$heading, 'plumco-core'), $label),
            'new_item_name' => sprintf(esc_html__( 'New %s '.$heading.' Name', 'plumco-core'), $label)
          ),
          'rewrite' => array( 'slug' => 'service_'.$own_id),
        )
      );
    }
  }


  // Project Start
  
  $project_cpt = (plumco_framework_active()) ? cs_get_option('theme_project_name') : '';
  $project_slug = (plumco_framework_active()) ? cs_get_option('theme_project_slug') : '';
  $project_cpt_slug = (plumco_framework_active()) ? cs_get_option('theme_project_cat_slug') : '';

  $base = (isset($project_cpt_slug) && $project_cpt_slug !== '') ? sanitize_title_with_dashes($project_cpt_slug) : ((isset($project_cpt) && $project_cpt !== '') ? strtolower($project_cpt) : 'project');
  $base_slug = (isset($project_slug) && $project_slug !== '') ? sanitize_title_with_dashes($project_slug) : ((isset($project_cpt) && $project_cpt !== '') ? strtolower($project_cpt) : 'project');
  $label = ucfirst((isset($project_cpt) && $project_cpt !== '') ? strtolower($project_cpt) : 'project');

  // Register custom post type - Project
  register_post_type('project',
    array(
      'labels' => array(
        'name' => $label,
        'singular_name' => sprintf(esc_html__('%s Post', 'plumco-core' ), $label),
        'all_items' => sprintf(esc_html__('All %s', 'plumco-core' ), $label),
        'add_new' => esc_html__('Add New', 'plumco-core') ,
        'add_new_item' => sprintf(esc_html__('Add New %s', 'plumco-core' ), $label),
        'edit' => esc_html__('Edit', 'plumco-core') ,
        'edit_item' => sprintf(esc_html__('Edit %s', 'plumco-core' ), $label),
        'new_item' => sprintf(esc_html__('New %s', 'plumco-core' ), $label),
        'view_item' => sprintf(esc_html__('View %s', 'plumco-core' ), $label),
        'search_items' => sprintf(esc_html__('Search %s', 'plumco-core' ), $label),
        'not_found' => esc_html__('Nothing found in the Database.', 'plumco-core') ,
        'not_found_in_trash' => esc_html__('Nothing found in Trash', 'plumco-core') ,
        'parent_item_colon' => ''
      ) ,
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 10,
      'menu_icon' => 'dashicons-portfolio',
      'rewrite' => array(
        'slug' => $base_slug,
        'with_front' => false
      ),
      'has_archive' => true,
      'capability_type' => 'post',
      'hierarchical' => true,
      'supports' => array(
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt',
        'trackbacks',
        'custom-fields',
        'comments',
        'revisions',
        'sticky',
        'page-attributes'
      )
    )
  );
  // Registered

  // Add Category Taxonomy for our Custom Post Type - Project
  register_taxonomy(
    'project_category',
    'project',
    array(
      'hierarchical' => true,
      'public' => true,
      'show_ui' => true,
      'show_admin_column' => true,
      'show_in_nav_menus' => true,
      'labels' => array(
        'name' => sprintf(esc_html__( '%s Categories', 'plumco-core' ), $label),
        'singular_name' => sprintf(esc_html__('%s Category', 'plumco-core'), $label),
        'search_items' =>  sprintf(esc_html__( 'Search %s Categories', 'plumco-core'), $label),
        'all_items' => sprintf(esc_html__( 'All %s Categories', 'plumco-core'), $label),
        'parent_item' => sprintf(esc_html__( 'Parent %s Category', 'plumco-core'), $label),
        'parent_item_colon' => sprintf(esc_html__( 'Parent %s Category:', 'plumco-core'), $label),
        'edit_item' => sprintf(esc_html__( 'Edit %s Category', 'plumco-core'), $label),
        'update_item' => sprintf(esc_html__( 'Update %s Category', 'plumco-core'), $label),
        'add_new_item' => sprintf(esc_html__( 'Add New %s Category', 'plumco-core'), $label),
        'new_item_name' => sprintf(esc_html__( 'New %s Category Name', 'plumco-core'), $label)
      ),
      'rewrite' => array( 'slug' => $base . '_cat' ),
    )
  );

  $project_custom_taxonomies = (plumco_framework_active()) ? cs_get_option('project_custom_taxonomies') : '';
  $counter = 0;
  if ($project_custom_taxonomies) {
    foreach ($project_custom_taxonomies as $key => $custom_taxonomy) {
      $counter++;
      $heading = $custom_taxonomy['taxonomy_name'];
      $own_id = preg_replace('/[^a-z]/', "_", strtolower($heading));

      register_taxonomy(
        'project_'.$own_id,
        'project',
        array(
          'hierarchical' => true,
          'public' => true,
          'show_ui' => true,
          'show_admin_column' => true,
          'show_in_nav_menus' => true,
          'labels' => array(
            'name' => sprintf(esc_html__( '%s '.$heading, 'plumco-core' ), $label),
            'singular_name' => sprintf(esc_html__('%s '.$heading, 'plumco-core'), $label),
            'search_items' =>  sprintf(esc_html__( 'Search %s '.$heading, 'plumco-core'), $label),
            'all_items' => sprintf(esc_html__( 'All %s '.$heading, 'plumco-core'), $label),
            'parent_item' => sprintf(esc_html__( 'Parent %s '.$heading, 'plumco-core'), $label),
            'parent_item_colon' => sprintf(esc_html__( 'Parent %s :.$heading', 'plumco-core'), $label),
            'edit_item' => sprintf(esc_html__( 'Edit %s '.$heading, 'plumco-core'), $label),
            'update_item' => sprintf(esc_html__( 'Update %s '.$heading, 'plumco-core'), $label),
            'add_new_item' => sprintf(esc_html__( 'Add New %s '.$heading, 'plumco-core'), $label),
            'new_item_name' => sprintf(esc_html__( 'New %s '.$heading.' Name', 'plumco-core'), $label)
          ),
          'rewrite' => array( 'slug' => 'project_'.$own_id),
        )
      );
    }
  }


}




// After Theme Setup
function plumco_custom_flush_rules() {
	// Enter post type function, so rewrite work within this function
	plumco_custom_post_type();
	// Flush it
	flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'plumco_custom_flush_rules');
add_action('init', 'plumco_custom_post_type');


/* ---------------------------------------------------------------------------
 * Custom columns - Service
 * --------------------------------------------------------------------------- */
add_filter("manage_edit-service_columns", "plumco_service_edit_columns");
function plumco_service_edit_columns($columns) {
  $new_columns['cb'] = '<input type="checkbox" />';
  $new_columns['title'] = esc_html__('Title', 'plumco-core' );
  $new_columns['thumbnail'] = esc_html__('Image', 'plumco-core' );
  $new_columns['date'] = esc_html__('Date', 'plumco-core' );

  return $new_columns;
}

add_action('manage_service_posts_custom_column', 'plumco_manage_service_columns', 10, 2);
function plumco_manage_service_columns( $column_name ) {
  global $post;

  switch ($column_name) {

    /* If displaying the 'Image' column. */
    case 'thumbnail':
      echo get_the_post_thumbnail( $post->ID, array( 100, 100) );
    break;

    /* Just break out of the switch statement for everything else. */
    default :
      break;
    break;

  }
}


/* ---------------------------------------------------------------------------
 * Custom columns - case
 * --------------------------------------------------------------------------- */
add_filter("manage_edit-project_columns", "plumco_project_edit_columns");
function plumco_project_edit_columns($columns) {
  $new_columns['cb'] = '<input type="checkbox" />';
  $new_columns['title'] = esc_html__('Title', 'plumco-core' );
  $new_columns['thumbnail'] = esc_html__('Image', 'plumco-core' );
  $new_columns['date'] = esc_html__('Date', 'plumco-core' );

  return $new_columns;
}

add_action('manage_project_posts_custom_column', 'plumco_manage_project_columns', 10, 2);
function plumco_manage_project_columns( $column_name ) {
  global $post;

  switch ($column_name) {

    /* If displaying the 'Image' column. */
    case 'thumbnail':
      echo get_the_post_thumbnail( $post->ID, array( 100, 100) );
    break;

    /* Just break out of the switch statement for everything else. */
    default :
      break;
    break;

  }
}


