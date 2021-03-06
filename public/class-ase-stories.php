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
	const VERSION = '0.2';

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

		add_filter('aesop_chapter_scroll_container', array($this,'aesop_chapter_scroll_container'));
		add_filter('aesop_chapter_scroll_nav', array($this,'aesop_chapter_scroll_nav'));
		add_filter('aesop_grid_gallery_spacing', array($this,'aesop_grid_gallery_spacing'));
		add_filter('aesop_stacked_gallery_styles_1663-2', array($this,'aesop_stacked_gallery_styles'));  //1663 staging / 2378 local
		add_filter('aesop_chapter_img_styles_1660-1', array($this,'aesop_chapter_img_styles')); // 1660 staging // 190 local 
		add_action('wp_footer', 						array($this,'aesop_chapter_loader'),21);
		add_filter('the_content', 		array($this,'remove_img_ptags'));

		require_once(ASE_STORIES_DIR.'/includes/type.php');
		require_once(ASE_STORIES_DIR.'/includes/helpers.php');
		require_once(ASE_STORIES_DIR.'/includes/template-loader.php');
		require_once(ASE_STORIES_DIR.'/public/includes/styles.php');
		require_once(ASE_STORIES_DIR.'/public/includes/shortcodes.php');

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


    	wp_deregister_style('ai-core-style');
    	wp_dequeue_style('ai-core-style');

    	// clean up wp head on the resume page
    	remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'parent_post_rel_link', 10, 0);
		remove_action('wp_head', 'start_post_rel_link', 10, 0);
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
		remove_action('wp_head', 'wp_generator');

	}
	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {


		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', ASE_STORIES_URL.'/public/assets/css/style.css', ASE_STORIES_VERSION );

		// dashichons
		wp_enqueue_style('dashicons');

	}

	public function enqueue_scripts(){

		wp_enqueue_script( $this->plugin_slug . '-plugin-script', ASE_STORIES_URL.'/public/assets/js/aesop-stories.min.js', array('jquery'), ASE_STORIES_VERSION, true );
		//wp_enqueue_script( $this->plugin_slug . '-loader', ASE_STORIES_URL.'/public/assets/js/pace.min.js', array('jquery'), ASE_STORIES_VERSION, true );


	}

	function remove_img_ptags($content){

	   	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);

	}

	function img_sizes(){
		add_image_size('aesop-story-cover', 1200, 9999, true);
		add_image_size('aesop-story-grid', 400, 400, true );
	}

	function aesop_chapter_scroll_nav($class){
		$class = '.aesop-story-chapters';
		return $class;
	}

	function aesop_chapter_scroll_container($class){
		$class = '.aesop-story-entry';
		return $class;
	}
	function aesop_grid_gallery_spacing(){
		return 40;
	}

	function aesop_stacked_gallery_styles(){
		return 'background-size:contain;';
	}

	function aesop_chapter_img_styles(){
		return 'background-size:cover;background-position:center bottom;';
	}

	function aesop_chapter_component_appears( $appears ){

		$appears = is_home();

		return $appears;
	}


	function aesop_chapter_loader(){

		// maintain backwards compatibility
		$offset = 0;

		// allow theme developers to determine the offset amount
		$chapterOffset = apply_filters('aesop_chapter_scroll_offset', $offset );

		// filterable content class
		$contentClass = apply_filters('aesop_chapter_scroll_container', '.aesop-entry-content');

		// filterabl content header class
		$contentHeaderClass = apply_filters('aesop_chapter_scroll_nav', '.aesop-entry-header');
		?>
			<!-- Chapter Loader -->
			<script>
				jQuery(document).ready(function(){

					jQuery('<?php echo $contentClass;?>').scrollNav({
					    sections: '.aesop-chapter-title',
					    arrowKeys: true,
					    insertTarget: '<?php echo $contentHeaderClass;?>',
					    insertLocation: 'appendTo',
					    showTopLink: true,
					    showHeadline: false,
					    scrollOffset: <?php echo $chapterOffset;?>,
					});

				});
			</script>

		<?php
	}

}
