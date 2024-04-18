<?php
/*
Plugin Name: Linker
Plugin URI: http://wordpress.org/plugins/linker/
Description: Manage, create and track outbound links by custom pretty links with your domain.
Author: Linker Team
Author URI: http://pojo.me/
Version: 1.3.0
Text Domain: linker
Domain Path: /language/
License: GPLv2 or later


This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'LINKER__FILE__', __FILE__ );
define( 'LINKER_BASE', plugin_basename( LINKER__FILE__ ) );
define( 'LINKER_PLUGIN_URL', plugins_url( '', LINKER__FILE__ ) );

include( 'classes/class-linker-maintenance.php' );
include( 'classes/class-linker-cpt.php' );

final class Linker_Main {

	/**
	 * @var Linker_Main The one true Linker_Main
	 * @since 1.0.0
	 */
	private static $_instance = null;

	/**
	 * @var Linker_CPT
	 * @since 1.0.0
	 */
	public $cpt;

	public function load_textdomain() {
		load_plugin_textdomain( 'linker', false, basename( dirname( __FILE__ ) ) . '/language' );
	}

	/**
	 * Throw error on object clone
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'linker' ), '1.0.0' );
	}

	/**
	 * Disable unserializing of the class
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'linker' ), '1.0.0' );
	}

	/**
	 * @since 1.0.0
	 * @return Linker_Main
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) )
			self::$_instance = new Linker_Main();

		return self::$_instance;
	}

	private function __construct() {
		$this->cpt = new Linker_CPT();

		add_action( 'plugins_loaded', array( &$this, 'load_textdomain' ) );
	}
}

if ( ! defined( 'POJO_LINKER_TESTS' ) ) {
	Linker_Main::instance();
}
