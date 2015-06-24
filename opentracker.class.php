<?php
/**
* The Main class of the  Opentracker Plug-in
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


if (!class_exists('Opentracker')) {
	class Opentracker {

		public function __construct() {

			add_action( 'plugins_loaded', array( $this, 'true_load_plugin_textdomain'));
			add_action('admin_menu',  array( $this, 'plugin_admin_add_page' ));
			add_action( 'wp_enqueue_scripts', array( 'Opentracker', 'register_plugin_scripts' ) );
		}

		public function register_plugin_scripts() {

			    $sitename = get_option('opentracker_sitename');
			    if(!$sitename) $sitename = 'test.com';

			    if ( !is_admin() ) {
			    	wp_register_script( 'opentrackerscript', '//script.opentracker.net/?site=' . $sitename, array(), null, true);
			 		wp_enqueue_script( 'opentrackerscript' );
			    }
		}

		public function plugin_admin_add_page() {

			add_submenu_page( 'options-general.php', __( "Opentracker",'opentracker'),__( "Opentracker",'opentracker'), 'manage_options', 'opentracker', array( $this, 'add_settings' ));

		}


		public function add_settings() {

				global $wpdb;
                $option = 'opentracker_sitename';
				$save = isset($_GET['save']) ?  $_GET['save'] : '';
				$name = isset($_GET['sitename']) ?  $_GET['sitename'] : get_option($option);

				if($save) update_option($option, $name);

				print '<div class="wrap">
				<h2>' . __( "Opentracker Settings",'opentracker') . '</h2>

				<h4>' . __( "Application information",'opentracker') . '</h4>
				<p>Please enter your site name as you registered it at Opentracker.net.<br>
				If you have not done so yet, you can register your site for a free trial at <a href="http://www.opentracker.net?wp">Opentracker</a></p>

				<form action="">

				<input type="hidden" name="page" value="opentracker">

				<div class="fieldwrap">
				<label class="" for="sitename">' . __( "Enter your registered sitename here",'opentracker') . '</label><br />
				<input type="text" name="sitename" size="80" value="' . $name . '" id="sitename" spellcheck="true" autocomplete="off" />
				</div>

				<br />
				<div id="action">
				<span class="spinner"></span>
				<input name="save" type="submit" class="button button-primary button-large" id="save" accesskey="p" value="' . __( "Save",'opentracker') . '" />
				</div>
				<div class="clear"></div>

				</form>
				<p>You can verify a succesfull install by visiting the hompage of this wordpress site, then login at <a href="http://ot3.opentracker.net">ot3.opentracker</a>, and go to the visits online report. <br>
				You should see yourself there.</p>

				</div>';
		}


		public function true_load_plugin_textdomain() {
			load_plugin_textdomain( 'opentracker-en', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

    }
}


?>