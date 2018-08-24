<?php
// Our custom post type function
function create_posttypeOne() {

	register_post_type( 'Partners',
		// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Partners' ),
				'singular_name' => __( 'Partner' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'Partners'),
		)
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttypeOne' );

/*
* Creating a function to create our CPT
*/

function custom_post_type_One() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Partners', 'Post Type General Name', 'rtcamp' ),
		'singular_name'       => _x( 'Partner', 'Post Type Singular Name', 'rtcamp' ),
		'menu_name'           => __( 'Partners', 'rtcamp' ),
		'parent_item_colon'   => __( 'Parent Partner', 'rtcamp' ),
		'all_items'           => __( 'All Partners', 'rtcamp' ),
		'view_item'           => __( 'View Partner', 'rtcamp' ),
		'add_new_item'        => __( 'Add New Partner', 'rtcamp' ),
		'add_new'             => __( 'Add New', 'rtcamp' ),
		'edit_item'           => __( 'Edit Partner', 'rtcamp' ),
		'update_item'         => __( 'Update Partner', 'rtcamp' ),
		'search_items'        => __( 'Search Partner', 'rtcamp' ),
		'not_found'           => __( 'Not Found', 'rtcamp' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'rtcamp' ),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'Partners', 'rtcamp' ),
		'description'         => __( 'Partner news and reviews', 'rtcamp' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	// Registering your Custom Post Type
	register_post_type( 'Partners', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type_One', 2 );



