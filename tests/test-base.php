<?php

class WP_Linker_Test_Base extends WP_UnitTestCase {
	
	public function test_getinstance() {
		$this->assertInstanceOf( 'Linker_Main', Linker_Main::instance() );
	}
	
}