<?php
/**
 * Plugin Name: Webigraph Addons for Elementor
 * Description: Webigraph Addons Plugin Includes effective widgets for Elementor Page Builder.
 * Plugin URI:  http://elementor.webigraph.com/webigraph-addons-for-elementor/
 * Version:     1.1.0
 * Author:      Webigraph 
 * Author URI:  http://webigraph.com/
 * Text Domain: webigraph-addons-for-elementor
 * License: GNU General Public License v2.0
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



define( 'WEBIGRAPH_ADDONS_VERSION', '1.1.0' );
//Plugin URL
define("WEBIGRAPH_ADDONS_PLUGIN_URL", plugins_url());
// Plugin Root File
define( 'WEBIGRAPH_ADDONS_FILE', __FILE__ );
// Plugin Folder Path
define( 'WEBIGRAPH_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
// Plugin Folder URL
define( 'WEBIGRAPH_PLUGIN_URL', plugins_url( '/', __FILE__ ) );
// Plugin Addons Folder Path
define( 'WEBIGRAPH_ADDONS_DIR', plugin_dir_path( __FILE__ ) . 'widgets' );

/**
 * Load Wbigraph Elementor
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.1.0
 */
function webigraph_addons_load() {
	// Load localization file
	load_plugin_textdomain( 'webigraph-addons' );

	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'webigraph_addons_fail_load' );
		return;
	}

	// Check required version
	$elementor_version_required = '1.8.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'webigraph_elemetor_load_out_of_date' );
		return;
	}

	// Require the main plugin file
	require( __DIR__ . '/plugin.php' );
}
add_action( 'plugins_loaded', 'webigraph_addons_load' );



function webigraph_addons_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'elementor/elementor.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message = '<p>' . __( 'Webigraph Addons is not working, because you are using an old version of Elementor.', 'webigraph-addons' ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', 'webigraph-addons' ) ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}



function webigraph_addons_fail_load() {
	if (!current_user_can('activate_plugins')) {
		return;
	}

	$elementor = 'elementor/elementor.php';

	if (webigraph_addons_is_plugin_installed($elementor)) {
		$activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor);
		$message = __('<strong>Webigraph Addons </strong> requires <strong>Elementor</strong> plugin to be active. Please activate Elementor to continue.', 'webigraph-addons');
		$button_text = __('Activate Elementor', 'webigraph-addons');
	} else {
		$activation_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');
		$message = sprintf(__('<strong>Webigraph Addons </strong> requires <strong>Elementor</strong> plugin to be installed and activated. Please install Elementor to continue.', 'webigraph-addons'), '<strong>', '</strong>');
		$button_text = __('Install Elementor', 'webigraph-addons');
	}

	$button = '<p><a href="' . $activation_url . '" class="button-primary">' . $button_text . '</a></p>';

	printf('<div class="error"><p>%1$s</p>%2$s</div>', __($message), $button);
}



/**
     * Check if a plugin is installed
     *
     * @since v1.0.6
     */
    function webigraph_addons_is_plugin_installed($basename) {
        if (!function_exists('get_plugins')) {
            include_once ABSPATH . '/wp-admin/includes/plugin.php';
        }

        $installed_plugins = get_plugins();

        return isset($installed_plugins[$basename]);
    }
 


function webigraph_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'webigraph-addons',
		[
			'title' => __( 'Webigraph Addons', 'webigraph-addons' ),			 
		]
	); 

}

add_action( 'elementor/elements/categories_registered', 'webigraph_widget_categories' );


add_action( 'elementor/editor/after_enqueue_styles', 'webigraph_icon_setup' );
if ( ! function_exists( 'webigraph_icon_setup' ) ) {
	function webigraph_icon_setup() {        
	    wp_enqueue_style(
			"webigraph_admin_css",
			WEBIGRAPH_ADDONS_PLUGIN_URL."/webigraph-addons-for-elementor/admin/assets/css/webigraph-icon.css",
			array(),
			WEBIGRAPH_ADDONS_VERSION	 
		);
		$dynamic_css = sprintf( '[class^="webigraph-"]::after, [class*=" webigraph-"]::after { content: "WGE"; }', $badge_text ) ;

	    wp_add_inline_style( 'webigraph_admin_css',  $dynamic_css );	        
	}

}





 
