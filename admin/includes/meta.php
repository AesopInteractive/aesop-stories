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
				),
				array(
					'id' 			=> 'aesop_stories_cover_lines',
					'name' 			=> __('Cover Title', 'aesop-stories'),
					'type' 			=> 'group',
					'repeatable'     => true,
					'repeatable_max' => 5,
					'sortable'		=> true,
					'desc'			=> __('If you do not like how the default title has been styled, you can adjust it here. Add a new group for each line of the cover.', 'aesop-stories'),
					'fields' 		=> array(
						array(
							'id' 	=> 'text',
							'name' 	=> __('Text', 'aesop-stories'),
							'type' 	=> 'text',
							'cols'	=> 6
						)
					)
				),
				array(
					'id'             	=> 'aesop_stories_block_cover_options',
					'name'           	=> ' ',
					'type'				=> 'title',
					'desc'				=> __('The two options below control the appearence of the cover title. By default, the maximum font size is <code>400</code>. If you have a really short title, try making this number larger, like <code>600</code>. If you have a really long title, make this number shorter like <code>200</code>. You can use this together with the maximum title width. By default, it\'s set at <code>60%</code>. However you can change this to something like <code>75%</code>', 'aesop_stories')
				),
				array(
					'id'				=> 'aesop_stories_title_size',
					'name'				=> __('Maximum Font Size', 'aesop_stories'),
					'type'				=> 'text',
					'default'			=> 400,
					'cols'				=> 6
				),
				array(
					'id'				=> 'aesop_stories_title_width',
					'name'				=> __('Maximum Title Width', 'aesop_stories'),
					'type'				=> 'text',
					'default'			=> '70%',
					'cols'				=> 6
				),
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