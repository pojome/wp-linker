<?php

class WP_Linker_Test_Base extends WP_UnitTestCase {

	function setUp() {
		parent::setUp();

		Linker_Main::instance();

		do_action( 'init' );
		do_action( 'plugins_loaded' );
	}
	
	public function test_getinstance() {
		$this->assertInstanceOf( 'Linker_Main', Linker_Main::instance() );
	}

	/**
	 * @expectedIncorrectUsage __clone
	 */
	public function test_Clone() {
		$obj_cloned = clone Linker_Main::instance();
	}

	/**
	 * @expectedIncorrectUsage __wakeup
	 */
	public function test_Wakeup() {
		unserialize( serialize( Linker_Main::instance() ) );
	}
}