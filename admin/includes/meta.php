<?php

class AesopStoriesMeta {

	function __construct(){

		add_filter( 'cmb_meta_boxes', array($this,'meta') );

	}

	function meta( array $meta_boxes ) {

			$opts = array(
				array(
					'id'				=> 'aesop_stories_video_bg',
					'name'				=> __('Video Background', 'aesop_stories'),
					'type'				=> 'file',
					'default'			=> '',
					'cols'				=> 12
				),
				array(
					'id'				=> 'aesop_stories_cover_text_color',
					'name'				=> __('Cover Text Color (optional)', 'aesop_stories'),
					'type'				=> 'colorpicker',
					'cols'				=> 4
				),
				array(
					'id'				=> 'aesop_stories_bg_color',
					'name'				=> __('Story Background Color (optional)', 'aesop_stories'),
					'type'				=> 'colorpicker',
					'cols'				=> 4
				),
				array(
					'id'				=> 'aesop_stories_text_color',
					'name'				=> __('Story Text Color (optional)', 'aesop_stories'),
					'type'				=> 'colorpicker',
					'cols'				=> 4
				)
			);

			$meta_boxes[] = array(
				'title' => __('Aesop Stories - Cover', 'aesop_stories-core'),
				'pages' 	=> array('aesop_stories'),
				'fields' => $opts
			);


		$meta_boxes[] = array(
			'title' => __('Aesop Stories - Contributors', 'aesop-stories'),
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