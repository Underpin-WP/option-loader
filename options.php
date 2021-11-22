<?php

use Underpin\Abstracts\Underpin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add this loader.
Underpin::attach( 'setup', new \Underpin\Factories\Observer( 'options', [
	'update' => function ( Underpin $plugin ) {
	require_once( plugin_dir_path( __FILE__ ) . 'lib/abstracts/Option.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'lib/loaders/Options.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'lib/factories/Option_Instance.php' );
	$plugin->loaders()->add( 'options', [
		'class' => 'Underpin_Options\Loaders\Options',
	] );
	},
] ) );
