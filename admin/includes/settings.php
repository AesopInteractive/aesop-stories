<?php
/**
* creates setting tabs
*
* @since version 1.0
* @param null
* @return global settings
*/

require_once dirname( __FILE__ ) . '/class.settings-api.php';

if ( !class_exists('aesop_story_settings_api_wrap' ) ):
class aesop_story_settings_api_wrap {

    private $settings_api;

    const version = '1.0';

    function __construct() {

        $this->dir  		= plugin_dir_path( __FILE__ );
        $this->url  		= plugins_url( '', __FILE__ );
        $this->settings_api = new WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this,'submenu_page'),99);

    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

	function submenu_page() {
		add_submenu_page( 'aesop-stories', 'Settings', __('Settings','aesop-stories'), 'manage_options', 'aesop-stories-settings', array($this,'submenu_page_callback') );
	}

	function submenu_page_callback() {

		echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
			?><h2><?php _e('Stories Settings','aesop-stories');?></h2><?php

			$this->settings_api->show_navigation();
        	$this->settings_api->show_forms();

		echo '</div>';

	}

    function get_settings_sections() {
        $sections = array(
            array(
                'id' 	=> 'aesop_story_settings_main',
                'title' => __( 'Setup', 'aesop-stories' )
			),
			 array(
                'id' 	=> 'aesop_story_settings_front',
                'title' => __( 'Story Front', 'aesop-stories' )
			)
        );
        return $sections;
    }

    function get_settings_fields() {
        $settings_fields = array(
            'aesop_story_settings_main' => array(
            	array(
                    'name' 				=> 'aesop_stories_domain',
                    'label' 			=> __( 'Naming Convention', 'aesop-stories' ),
                    'desc' 				=> __( 'By default its called Stories. You can rename this to something like, portfolio. Flush permalinks after renaming by going to Settings-->Permalinks and clicking Save Settings.', 'aesop-stories' ),
                    'type' 				=> 'text',
                    'default' 			=> 'stories',
                    'sanitize_callback' => ''
                )
            ),
            'aesop_story_settings_front' => array(
            	array(
                    'name' 				=> 'aesop_stories_front_page',
                    'label' 			=> __( 'Enable Story Front', 'aesop-stories' ),
                    'desc' 				=> __( 'Enable story front.', 'aesop-stories' ),
                    'type' 				=> 'checkbox',
                    'default' 			=> '',
                    'sanitize_callback' => ''
                ),
            	array(
                    'name' 				=> 'aesop_stories_front_story_id',
                    'label' 			=> __( 'Front Story', 'aesop-stories' ),
                    'desc' 				=> __( 'Choose a story to set as the front page of your website (optional).', 'aesop-stories' ),
                    'type' 				=> 'select',
                    'options' => self::get_stories(),
                    'default' 			=> '',
                    'sanitize_callback' => ''
                )
            )
        );

        return $settings_fields;
    }

    function get_stories(){

		$stories = get_posts('post_type=aesop_stories&numberposts=');

    	foreach( $stories as $story ) :
        	$item[$story->ID] = $story->post_title;
    	endforeach;

    	return $item;
    }
}
endif;

$settings = new aesop_story_settings_api_wrap();






