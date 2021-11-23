<?php

namespace Underpin\Options\Factories;


use Underpin\Traits\Instance_Setter;
use Underpin\Options\Abstracts\Option;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class Option_Instance extends Option {
	use Instance_Setter;

	public function __construct( $args ) {
		$this->set_values( $args );
	}

}