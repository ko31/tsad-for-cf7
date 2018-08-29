<?php

class TsadForCf7
{
	private $prefix = 'tsad-for-cf7';

	public function __construct() {
	}

	public static function get_instance()
	{
		static $instance;
		if ( ! $instance ) {
			$instance = new TsadForCf7();
		}
		return $instance;
	}

	public function register()
	{
		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
	}

	public function plugins_loaded()
	{
		load_plugin_textdomain( $this->get_prefix(), false, 'tsad-for-cf7/languages' );
		if ( is_admin() ) {
			TsadForCf7\Admin::get_instance()->register();
		} else {
			TsadForCf7\Action::get_instance()->register();
		}
	}

	public function get_prefix() {
		return $this->prefix;
	}

	public function get_option( $key, $default = null ) {
		$option = get_option( $this->get_prefix(), array() );
		if ( ! empty( $option[ $key ] ) && trim( $option[ $key ] ) ) {
			return trim( $option[ $key ] );
		} else {
			return $default;
		}
	}
}
