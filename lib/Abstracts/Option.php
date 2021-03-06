<?php
/**
 * WordPress Option Abstraction
 *
 * @since   1.0.0
 * @package Lib\Core\Abstracts
 */


namespace Underpin\Options\Abstracts;

use Underpin\Traits\Feature_Extension;
use WP_Error;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Option
 * WordPress Option Class
 *
 * @since   1.0.0
 * @package Lib\Core\Abstracts
 */
abstract class Option {

	protected $key = false;

	protected $default_value = [];

	/**
	 * Adds the option.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function add() {
		return add_option( $this->key, $this->default_value );
	}

	/**
	 * Updates the option to the specified value.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $value The value to update this setting to.
	 * @param bool  $key   The key to update, if this option is an array of options.
	 *
	 * @return bool True if updated, otherwise false
	 */
	public function update( $value, $key = false ) {

		if ( false !== $key ) {
			$option         = (array) $this->get();
			$option[ $key ] = $value;
			$value          = $option;
		}

		return update_option( $this->key, $value );
	}

	/**
	 * Resets the setting to the default value.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function reset() {
		return $this->update( $this->default_value );
	}

	/**
	 * Deletes the option.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public function delete() {
		return delete_option( $this->key );
	}

	/**
	 * Retrieves the option.
	 *
	 * @since 1.0.0
	 *
	 * @return mixed|void
	 */
	public function get() {
		return get_option( $this->key, $this->default_value );
	}

	public function export() {
		$this->value = $this->get();

		return $this;
	}

	/**
	 * Plucks a single value from an array of options.
	 *
	 * @since 1.0.0
	 *
	 * @param string $setting The setting to retrieve
	 *
	 * @return mixed|\WP_Error The value if it is set, otherwise WP_Error.
	 */
	public function pluck( $setting ) {
		$settings = $this->get();

		if ( isset( $settings[ $setting ] ) ) {
			return $settings[ $setting ];
		}

		return new \WP_Error( 'setting_not_set', 'The provided setting is not set in this option.', [ 'setting' => $setting ] );
	}

	public function __get( $key ) {
		if ( isset( $this->$key ) ) {
			return $this->$key;
		} else {
			return new WP_Error( 'post_template_param_not_set', 'The batch task key ' . $key . ' could not be found.' );
		}
	}

}