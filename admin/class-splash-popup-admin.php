<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://perfectreturn.com
 * @since      1.0.0
 *
 * @package    Splash_Popup
 * @subpackage Splash_Popup/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Splash_Popup
 * @subpackage Splash_Popup/admin
 * @author     Roni Das <kernelroni@gmail.com>
 */
class Splash_Popup_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Splash_Popup_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Splash_Popup_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/splash-popup-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Splash_Popup_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Splash_Popup_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		 
		wp_enqueue_media();
		
		wp_enqueue_script('jquery-ui-datepicker');
		wp_register_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');		
		wp_enqueue_style('jquery-ui');			 

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/splash-popup-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	public function splashpopupMenu(){
		
		add_menu_page( 'SplashPopup', 'SplashPopup', 'manage_options', 'SplashPopup', array(&$this,"admin_view"), 'dashicons-tickets', 6  );
	}
	
	
	public function admin_view(){

		$post = $_POST['splashinfo'];
		$info = 0;

		
		if(intval($post['duration'])  <= 0 ){
			$post['duration'] = 30;
		}
		
		if($_POST){
			
			$info = serialize($post);
			update_option('splashinfo', $info);
		}
		
		$info = get_option('splashinfo', false);
		
		if($info){
		$data = unserialize($info);		
		extract($data);
		}
		
		
		
	
		
		
		//echo "admin page for splash screen settings";
		require_once plugin_dir_path( __FILE__ ) . 'partials/splash-popup-admin-display.php';
		
		
	}	

}
