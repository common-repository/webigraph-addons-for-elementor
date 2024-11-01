<?php
namespace WebigraphAddons; 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->add_actions();
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );
		add_action( 'elementor/frontend/after_register_scripts', function() {
			wp_register_script( 'webigraph-jquery-351', plugins_url( '/assets/js/jquery-3.5.1.min.js', WEBIGRAPH_ADDONS_FILE ), array('jquery'), WEBIGRAPH_ADDONS_VERSION, true );
			wp_register_script( 'webigraph-addons', plugins_url( '/assets/js/webigraphaddons.js', WEBIGRAPH_ADDONS_FILE ), array('jquery'), WEBIGRAPH_ADDONS_VERSION, true );
			wp_register_script( 'webigraph-modal-js', plugins_url( '/assets/js/modalbox.js', WEBIGRAPH_ADDONS_FILE ), array('jquery'), WEBIGRAPH_ADDONS_VERSION, true );

		} );

		add_action( 'elementor/frontend/after_enqueue_styles', function() {
		   wp_enqueue_style('webigraph-addons',   plugin_dir_url(__FILE__). '/assets/css/webigraphaddons.css');
		} );	 

	}

	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->includes_files();
		$this->register_widget_addons();		 
	}	

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes_files() {
		$this->include_addons_file('webigraph-button-group');
		$this->include_addons_file('webigraph-multi-heading');	 
		$this->include_addons_file('webigraph-easy-text-editor');
		$this->include_addons_file('webigraph-modal-box');
	}

	private function include_addons_file($class){
		require WEBIGRAPH_ADDONS_DIR .'/'.$class.'.php';	 
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private 
	 */
	private function register_widget_addons() {
		$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
		$widgets_manager->register_widget_type( new Widgets\Webigraph_Button_Group() );
		$widgets_manager->register_widget_type( new Widgets\Webigraph_Multi_Heading() );
		$widgets_manager->register_widget_type( new Widgets\Webigraph_Easy_Text_Editor() );
		$widgets_manager->register_widget_type( new Widgets\Webigraph_Modal_box() );
	}
}

new Plugin();
