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

		if( !class_exists( 'TGM_Plugin_Activation' ) && is_admin() ) {
			require_once(ASE_STORIES_DIR.'/class-tgm-plugin-activation.php');
			require_once(ASE_STORIES_DIR.'/activator.php');
		}


		add_action('admin_enqueue_scripts', array($this,'admin_styles'));

		require_once(ASE_STORIES_DIR.'/admin/includes/feat-img-mod.php');
		require_once(ASE_STORIES_DIR.'/admin/includes/menu.php');
		require_once(ASE_STORIES_DIR.'/admin/includes/settings.php');
		require_once(ASE_STORIES_DIR.'/admin/includes/meta.php');

		new AesopStoriesFeaturedImageMod(array(
	    	'post_type'     => 'aesop_stories',
	    	'metabox_title' => __( 'Story Cover Image', 'aesop-stories' ),
	    	'set_text'      => __( 'Set Story Cover Image', 'aesop-stories' ),
	    	'remove_text'   => __( 'Remove Story Cover Image', 'aesop-stories' )
		));

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


	function admin_styles($hook){

		global $current_screen;

        //Register Styles
		wp_register_style( $this->plugin_slug.'-admin-styles', ASE_STORIES_URL. '/admin/assets/css/admin.css', ASE_STORIES_VERSION, true);
		wp_register_script( $this->plugin_slug.'-admin-script', ASE_STORIES_URL. '/admin/assets/js/admin.js', array('jquery'), ASE_STORIES_VERSION, true);

		// if all stories
		if ( 'toplevel_page_aesop-stories' == $hook ) {

			// Enqueue styles
			wp_enqueue_style( 'aesop-stories-admin-styles' );

		}

		// if single edit
		if ('aesop_stories' == $current_screen->post_type) {
			wp_enqueue_script( 'aesop-stories-admin-script' );

		}


	}

}
