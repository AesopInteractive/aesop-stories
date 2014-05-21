<?php

class aseStoriesType{

	function __construct(){

		add_action('init', array($this,'do_type'));

	}

	function do_type() {

		$labels = array(
			'name'                => _x( 'Stories', 'Post Type General Name', 'ase_stories' ),
			'singular_name'       => _x( 'Stories Item', 'Post Type Singular Name', 'ase_stories' ),
			'menu_name'           => __( 'Stories', 'ase_stories' ),
			'parent_item_colon'   => __( 'Parent Stories:', 'ase_stories' ),
			'all_items'           => __( 'All Storiess', 'ase_stories' ),
			'view_item'           => __( 'View Stories', 'ase_stories' ),
			'add_new_item'        => __( 'Add New Stories', 'ase_stories' ),
			'add_new'             => __( 'Add New', 'ase_stories' ),
			'edit_item'           => __( 'Edit Stories', 'ase_stories' ),
			'update_item'         => __( 'Update Stories', 'ase_stories' ),
			'search_items'        => __( 'Search Stories', 'ase_stories' ),
			'not_found'           => __( 'Not found', 'ase_stories' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'ase_stories' ),
		);
		$args = array(
			'label'               => __( 'ase_stories', 'ase_stories' ),
			'description'         => __( 'Aesop Stories', 'ase_stories' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_icon'           => '',
			'can_export'          => true,
			'has_archive'		=> 'stories',
			'rewrite'			=> array('slug' => 'story'),
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'ase_stories', $args );

	}

}
new aseStoriesType;