<?php
// Our custom post type function
function create_posttypeTwo() {

	register_post_type( 'Slideshow',
		// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Slideshow' ),
				'singular_name' => __( 'Slideshow' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'Slideshow'),
		)
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttypeTwo' );

/*
* Creating a function to create our CPT
*/

function custom_post_type_Two() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Slideshow', 'Post Type General Name', 'rtcamp' ),
		'singular_name'       => _x( 'Slideshow', 'Post Type Singular Name', 'rtcamp' ),
		'menu_name'           => __( 'Slideshow', 'rtcamp' ),
		'parent_item_colon'   => __( 'Parent Slideshow', 'rtcamp' ),
		'all_items'           => __( 'All Slideshow', 'rtcamp' ),
		'view_item'           => __( 'View Slideshow', 'rtcamp' ),
		'add_new_item'        => __( 'Add New Slideshow', 'rtcamp' ),
		'add_new'             => __( 'Add New', 'rtcamp' ),
		'edit_item'           => __( 'Edit Slideshow', 'rtcamp' ),
		'update_item'         => __( 'Update Slideshow', 'rtcamp' ),
		'search_items'        => __( 'Search Slideshow', 'rtcamp' ),
		'not_found'           => __( 'Not Found', 'rtcamp' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'rtcamp' ),
	);

// Set other options for Custom Post Type

	$args = array(
		'label'               => __( 'Slideshow', 'rtcamp' ),
		'description'         => __( 'Slideshow For rtcamp', 'rtcamp' ),
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
	register_post_type( 'Slideshow', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type_Two', 0 );



