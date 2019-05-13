<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://perfectreturn.com
 * @since      1.0.0
 *
 * @package    Splash_Popup
 * @subpackage Splash_Popup/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Splash_Popup
 * @subpackage Splash_Popup/includes
 * @author     Roni Das <kernelroni@gmail.com>
 */
class Splash_Popup {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Splash_Popup_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'SPLASH_POPUP_VERSION' ) ) {
			$this->version = SPLASH_POPUP_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'splash-popup';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Splash_Popup_Loader. Orchestrates the hooks of the plugin.
	 * - Splash_Popup_i18n. Defines internationalization functionality.
	 * - Splash_Popup_Admin. Defines all hooks for the admin area.
	 * - Splash_Popup_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-splash-popup-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-splash-popup-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-splash-popup-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-splash-popup-public.php';

		$this->loader = new Splash_Popup_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Splash_Popup_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Splash_Popup_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Splash_Popup_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		
		
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'splashpopupMenu' );	

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		
		$popup_cookie = "popup_cookie";
		$popup_cookie_value = "yes";		
		
		
		$splashinfo = get_option('splashinfo', false);				
		$data = unserialize($splashinfo);		
		extract($data);
		$popup_interval = intval($popup_interval);

		$popup_shown = $_COOKIE[$popup_cookie] == "yes";	 // 1/0	
		

		
		
				








		
		
		
		
		
		if(isset($is_active) && intval($is_active) == 1 && $this->splash_within_time_slot() && !$popup_shown){	

			
		
			$plugin_public = new Splash_Popup_Public( $this->get_plugin_name(), $this->get_version() );

			$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
			$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
			
			// add the modal html in footer.
			$this->loader->add_action( 'wp_footer', $plugin_public, 'load_splash_popup' );		
		
		}
		

		
		

		if($popup_interval == 0 ){ // popup interval is with in the data var.
			$popup_interval = 5; // default 5 min			
		}		
		
		// popup already show in this session 
		// save the interval into cookie
		setcookie($popup_cookie, $popup_cookie_value, time() + $popup_interval*60, "/"); // 60sec = 1 min		


		

	}
	
	/**
	 * Check the time slot ; if its between the time range then show the popup.
	 *
	 * @since    1.0.0
	 */	
	public function splash_within_time_slot(){
		
		$splashTime = get_option('splashinfo', false);
				
		if($splashTime){			
			
			$data = unserialize($splashTime);			
			
			$timezone = get_option('timezone_string'); // get the timezone form wordpress settings page. // wordpresssite/wp-admin/options-general.php
			
			$gmtTimezone = new DateTimeZone($timezone); 
			$startDate = $data['startdate'];
			$starthr = $data['starthr'];
			$startmin = $data['startmin'];
			
			$enddate = $data['enddate'];
			$endhr = $data['endhr'];
			$endmin = $data['endmin'];	

			// prepare format
			$startFullDatetime = $startDate . " $starthr:$startmin:0";
			$endFullDatetime = $enddate . " $endhr:$endmin:0";
			
			//echo $startFullDatetime . "<br>";
			
			//$date->format('Y-m-d H:i:s');
			$ndt = new DateTime("now",$gmtTimezone); // current time
			$sdt = new DateTime($startFullDatetime,$gmtTimezone);
			$edt = new DateTime($endFullDatetime,$gmtTimezone);
			
			if($ndt > $sdt && $ndt < $edt){			
				return true;			
			}
		
		
		//echo $ndt->format('Y-m-d H:i:s') . "<br>";
		//echo $sdt->format('Y-m-d H:i:s') . "<br>";
		//echo $edt->format('Y-m-d H:i:s') . "<br>";
		
		
		
		return false;
		
		}
	
	}
	

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Splash_Popup_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
