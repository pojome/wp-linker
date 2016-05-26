<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Linker_Maintenance {

	public static function activation() {
		Linker_Main::instance()->cpt->register_post_type();
		flush_rewrite_rules();
	}
}

register_activation_hook( LINKER__FILE__, array( 'Linker_Maintenance', 'activation' ) );
register_uninstall_hook( LINKER__FILE__, 'flush_rewrite_rules' );
