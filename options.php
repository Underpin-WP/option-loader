<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add this loader.
add_action( 'underpin/before_setup', function ( $file, $class ) {
	require_once( plugin_dir_path( __FILE__ ) . 'Option.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'Options.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'Option_Instance.php' );
	Underpin\underpin()->get( $file, $class )->loaders()->add( 'options', [
		'registry' => 'Underpin_Options\Loaders\Options',
	] );
}, 10, 2 );