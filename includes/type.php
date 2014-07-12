<?php

class aseStoriesType{

	function __construct(){

		add_action('init', array($this,'do_type'));
		add_action( 'init', array($this,'do_tax'));

	}

	function do_type() {

		$slug_plural	= 	aesop_stories_get_opt('aesop_stories_domain_plural', 'aesop_story_settings_main','stories');
		$slug_single 	= 	aesop_stories_get_opt('aesop_stories_domain_singular', 'aesop_story_settings_main','story');


		$labels = array(
			'name'                => _x( ucfirst($slug_plural), 'Post Type General Name', 'aesop-stories' ),
			'singular_name'       => _x( ucfirst($slug_single).' Item', 'Post Type Singular Name', 'aesop-stories' ),
			'menu_name'           => __( ucfirst($slug_plural), 'aesop-stories' ),
			'parent_item_colon'   => __( 'Parent '.$slug_single.':', 'aesop-stories' ),
			'all_items'           => __( 'All '.$slug_plural, 'aesop-stories' ),
			'view_item'           => __( 'View '.$slug_single, 'aesop-stories' ),
			'add_new_item'        => __( 'Add New '.$slug_single, 'aesop-stories' ),
			'add_new'             => __( 'Add New', 'aesop-stories' ),
			'edit_item'           => __( 'Edit '.$slug_single, 'aesop-stories' ),
			'update_item'         => __( 'Update '.$slug_single, 'aesop-stories' ),
			'search_items'        => __( 'Search '.$slug_plural, 'aesop-stories' ),
			'not_found'           => __( 'Not found', 'aesop-stories' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'aesop-stories' ),
		);
		$args = array(
			'label'               => __( 'aesop-stories', 'aesop-stories' ),
			'description'         => __( 'Aesop Stories', 'aesop-stories' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail'),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_icon'           => 'dashicons-edit',
			'can_export'          => true,
			'has_archive'			=> $slug_plural,
			'rewrite'				=> array('slug' => __($slug_single,'aesop-stories')),
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'aesop_stories', apply_filters('aesop_stories_type_args', $args ));

	}

	function do_tax(){

		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Collections', 'taxonomy general name' ),
			'singular_name'     => _x( 'Collection', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Collections' ),
			'all_items'         => __( 'All Collections' ),
			'parent_item'       => __( 'Parent Collection' ),
			'parent_item_colon' => __( 'Parent Collection:' ),
			'edit_item'         => __( 'Edit Collection' ),
			'update_item'       => __( 'Update Collection' ),
			'add_new_item'      => __( 'Add New Collection' ),
			'new_item_name'     => __( 'New Collection Name' ),
			'menu_name'         => __( 'Collections' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'collection' ),
		);

		register_taxonomy( 'aesop_stories_collections', array( 'aesop_stories' ), apply_filters('aesop_stories_tax_args', $args ));
	}
}
new aseStoriesType;