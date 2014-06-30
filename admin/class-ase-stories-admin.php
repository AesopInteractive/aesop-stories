<?php
/**
 * Plugin Name.
 *
 * @package   ASE_Stories_Admin
 * @author    Nick Haskins <nick@aesopinteractive.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Aesopinteractive L.L.C.
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * If you're interested in introducing public-facing
 * functionality, then refer to `class-plugin-name.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package ASE_Stories_Admin
 * @author  Nick Haskins <nick@aesopinteractive.com>
 */
class ASE_Stories_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		/*
		 * Call $plugin_slug from public plugin class.
		 *
		 * @TODO:
		 *
		 * - Rename "ASE_Stories" to the name of your initial plugin class
		 *
		 */
		$plugin = ASE_Stories::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		add_action('admin_enqueue_scripts', array($this,'admin_styles'));
		add_action( 'admin_menu', 			array($this,'remove_menus'));

		require_once(ASE_STORIES_DIR.'/admin/includes/settings.php');
		require_once(ASE_STORIES_DIR.'/admin/includes/meta.php');
		require_once(ASE_STORIES_DIR.'/admin/views/stories-tab.php');



	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	function admin_styles(){

        //Register Styles
		wp_register_style( $this->plugin_slug.'-admin-styles', ASE_STORIES_URL. '/admin/assets/css/admin.css', ASE_STORIES_VERSION, true);

		// Load styles and scripts on areas that users will edit
		if ( is_admin() ) {

			// Enqueue styles
			wp_enqueue_style( 'aesop-stories-admin-styles' );

		}
	}

	function remove_menus(){

	  	// remove the main stories listing
		remove_submenu_page( 'post-new.php?post_type=aesop_stories','post-new.php?post_type=aesop_stories');
	  	remove_submenu_page( 'edit.php?post_type=aesop_stories','edit.php?post_type=aesop_stories' );    //Pages
	  	
	}
}
