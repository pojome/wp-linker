<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

register_activation_hook( LINKER_BASE, 'flush_rewrite_rules' );
register_uninstall_hook( LINKER_BASE, 'flush_rewrite_rules' );