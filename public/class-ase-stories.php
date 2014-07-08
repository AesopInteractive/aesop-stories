<?php
/**
 * Aesop Stories
 *
 * @package   ASE_Stories
 * @author    Nick Haskins <nick@aesopinteractive.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Aesopinteractive L.L.C.
 */

/**
 *
 * @package ASE_Stories
 * @author  Nick Haskins <nick@aesopinteractive.com>
 */
class ASE_Stories {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.0';

	/**
	 * Unique identifier for your plugin.
	 *
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'aesop-stories';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// clearn head
		add_action('wp_print_styles', array($this,'clean_head'));

		add_action('init', array($this,'img_sizes'));

		add_filter('aesop_chapter_scroll_nav', array($this,'aesop_chapter_scroll_nav'));
		add_filter('aesop_chapter_scroll_offset', array($this,'aesop_scroll_offset'));
		add_filter('aesop_timeline_scroll_offset', array($this,'aesop_scroll_offset'));

		require_once(ASE_STORIES_DIR.'/includes/type.php');
		require_once(ASE_STORIES_DIR.'/includes/helpers.php');
		require_once(ASE_STORIES_DIR.'/includes/template-loader.php');
		require_once(ASE_STORIES_DIR.'/public/includes/styles.php');
		require_once(ASE_STORIES_DIR.'/public/includes/shortcodes.php');

		// rcp integration
		if ( class_exists('RCP_Payments') ) {
			require_once(ASE_STORIES_DIR.'/includes/rcp.php');
		}

	}

	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();
				}

				restore_current_blog();

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}

	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

				}

				restore_current_blog();

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    1.0.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	private static function single_activate() {
		// @TODO: Define activation functionality here
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	private static function single_deactivate() {
		// @TODO: Define deactivation functionality here
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );

	}

	function clean_head(){

		if ('aesop_stories' == get_post_type() || is_post_type_archive('aesop_stories')) {

			//deregister 2012 styles and scripts
	    	wp_deregister_script('twentytwelve-navigation');
	    	wp_dequeue_script(	'twentytwelve-navigation');

	    	wp_deregister_style( 'twentytwelve-style' );
	    	wp_dequeue_style(	'twentytwelve-style');

	    	//deregister 2013 styles and scripts
	    	wp_deregister_style( 'twentythirteen-style' );
    		wp_dequeue_style(	'twentythirteen-style');

	    	wp_deregister_script('twentythirteen-script');
	    	wp_dequeue_script('twentythirteen-script');


	    	//deregister 2014 styles and scripts
    		wp_deregister_style( 'twentyfourteen-style' );
    		wp_dequeue_style(	'twentyfourteen-style');

    		wp_deregister_script('twentyfourteen-script');
	    	wp_dequeue_script('twentyfourteen-script');

	    	// clean up wp head on the resume page
	    	remove_action('wp_head', 'rsd_link');
			remove_action('wp_head', 'wlwmanifest_link');
			remove_action('wp_head', 'index_rel_link');
			remove_action('wp_head', 'parent_post_rel_link', 10, 0);
			remove_action('wp_head', 'start_post_rel_link', 10, 0);
			remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
			remove_action('wp_head', 'wp_generator');

			if (is_single()) {
				add_action('wp_footer', array($this,'preloader'));
			}
			
	    }

	}

	function preloader(){
		?>
		<script>
		jQuery(document).ready(function(){
			window.addEventListener('DOMContentLoaded', function() {
    			jQuery("body").queryLoader2();
			});
		});
		</script>
		<?php
	}
	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		if ('aesop_stories' == get_post_type() || aesop_stories_is_front_story()  ) {
			wp_enqueue_style( $this->plugin_slug . '-plugin-styles', ASE_STORIES_URL.'/public/assets/css/style.css', ASE_STORIES_VERSION );

			// dashichons
			wp_enqueue_style('dashicons');
			// fonts
			wp_enqueue_style( $this->plugin_slug . '-plugin-font', '//fonts.googleapis.com/css?family=Lustria', ASE_STORIES_VERSION);
			wp_enqueue_style( $this->plugin_slug . '-plugin-font', '//fonts.googleapis.com/css?family=Lato:300,400,700,400italic,700italic', ASE_STORIES_VERSION);

		}
	}

	public function enqueue_scripts(){

		if ('aesop_stories' == get_post_type() || aesop_stories_is_front_story() ) {
			wp_enqueue_script( $this->plugin_slug . '-plugin-script', ASE_STORIES_URL.'/public/assets/js/aesop-stories.min.js', array('jquery'), ASE_STORIES_VERSION, true );

			if ( is_single() ) {
				wp_enqueue_script( $this->plugin_slug . '-preloader', ASE_STORIES_URL.'/public/assets/js/preloader.js', array('jquery'), ASE_STORIES_VERSION);
			}
		}
	}

	function img_sizes(){
		add_image_size('aesop-story-cover', 1200, 9999, true);
		add_image_size('aesop-story-grid', 400, 400, true );
	}

	function aesop_chapter_scroll_nav($class){
		$class = '.aesop-story-chapters';
		return $class;
	}

	function aesop_scroll_offset($offset){
		$offset = 36;
		return $offset;
	}
}
