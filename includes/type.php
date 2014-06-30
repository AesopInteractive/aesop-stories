<?php

class aseStoriesType{

	function __construct(){

		add_action('init', array($this,'do_type'));

	}

	function do_type() {

		$labels = array(
			'name'                => _x( 'Stories', 'Post Type General Name', 'aesop-stories' ),
			'singular_name'       => _x( 'Stories Item', 'Post Type Singular Name', 'aesop-stories' ),
			'menu_name'           => __( 'Stories', 'aesop-stories' ),
			'parent_item_colon'   => __( 'Parent Stories:', 'aesop-stories' ),
			'all_items'           => __( 'All Stories', 'aesop-stories' ),
			'view_item'           => __( 'View Stories', 'aesop-stories' ),
			'add_new_item'        => __( 'Add New Story', 'aesop-stories' ),
			'add_new'             => __( 'Add New', 'aesop-stories' ),
			'edit_item'           => __( 'Edit Story', 'aesop-stories' ),
			'update_item'         => __( 'Update Story', 'aesop-stories' ),
			'search_items'        => __( 'Search Stories', 'aesop-stories' ),
			'not_found'           => __( 'Not found', 'aesop-stories' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'aesop-stories' ),
		);
		$args = array(
			'label'               => __( 'aesop-stories', 'aesop-stories' ),
			'description'         => __( 'Aesop Stories', 'aesop-stories' ),
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
			'has_archive'			=> 'stories',
			'rewrite'				=> array('slug' => 'story'),
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'aesop_stories', $args );

	}

}
new aseStoriesType;