<?php

class AesopStoriesMeta {

	function __construct(){

		add_filter( 'cmb_meta_boxes', array($this,'meta') );

	}

	function meta( array $meta_boxes ) {
		$meta_boxes[] = array(
			'title' => __('Aesop Stories', 'aesop-stories'),
			'pages' 	=> array('aesop_stories'),
			'fields' => array(
				array(
					'id' 			=> 'aesop_stories_contributors',
					'name' 			=> __('Story Contributors', 'aesop-stories'),
					'type' 			=> 'group',
					'repeatable'     => true,
					'repeatable_max' => 20,
					'sortable'		=> true,
					'desc'			=> __('Add name and occupation. Avatar and bio are optional.', 'aesop-stories'),
					'fields' 		=> array(
						array(
							'id' 	=> 'name',
							'name' 	=> __('Name', 'aesop-stories'),
							'type' 	=> 'text',
							'cols'	=> 6
						),
						array(
							'id' 	=> 'occupation',
							'name' 	=> __('Occupation', 'aesop-stories'),
							'type' 	=> 'text',
							'cols'	=> 6
						),
						array(
							'id' 	=> 'avatar',
							'name' 	=> __('Avatar', 'aesop-stories'),
							'type' 	=> 'image',
							'cols'	=> 4
						),
						array(
							'id' 	=> 'bio',
							'name' 	=> __('Bio', 'aesop-stories'),
							'type' 	=> 'textarea',
							'cols'	=> 8
						)
					)
				)
			)
		);

		return $meta_boxes;

	}

}
new AesopStoriesMeta;