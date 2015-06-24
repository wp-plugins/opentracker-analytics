<?php

	// Exit if accessed directly
	if ( ! defined( 'ABSPATH' ) ) exit;

	/**
	 * Plugin version
	 *
	 * @var string
	 */

	if ( ! defined( 'OPENTRACKER_DIR' ) ) {
		define( 'OPENTRACKER_DIR', plugin_dir_path( __FILE__ ) );
	}

	if ( ! defined( 'OPENTRACKER_URL' ) ) {
		define( 'OPENTRACKER_URL', plugins_url( '/', __FILE__ ) );
	}

?>