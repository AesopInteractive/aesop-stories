<?php

class aseStoriesType{

	function __construct(){

		add_action('init', array($this,'do_type'));

	}

	function do_type() {

		$labels = array(
			'name'                => _x( 'Stories', 'Post Type General Name', 'aesop_stories' ),
			'singular_name'       => _x( 'Stories Item', 'Post Type Singular Name', 'aesop_stories' ),
			'menu_name'           => __( 'Stories', 'aesop_stories' ),
			'parent_item_colon'   => __( 'Parent Stories:', 'aesop_stories' ),
			'all_items'           => __( 'All Stories', 'aesop_stories' ),
			'view_item'           => __( 'View Stories', 'aesop_stories' ),
			'add_new_item'        => __( 'Add New Stories', 'aesop_stories' ),
			'add_new'             => __( 'Add New', 'aesop_stories' ),
			'edit_item'           => __( 'Edit Stories', 'aesop_stories' ),
			'update_item'         => __( 'Update Stories', 'aesop_stories' ),
			'search_items'        => __( 'Search Stories', 'aesop_stories' ),
			'not_found'           => __( 'Not found', 'aesop_stories' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'aesop_stories' ),
		);
		$args = array(
			'label'               => __( 'aesop_stories', 'aesop_stories' ),
			'description'         => __( 'Aesop Stories', 'aesop_stories' ),
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
		register_post_type( 'aesop_stories', $args );

	}

}
new aseStoriesType;