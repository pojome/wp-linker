<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Linker_CPT {
	
	public function register_post_type() {
		register_post_type( 'linker', array(
			'labels'          => array(
				'name'               => __( 'Linker', 'linker' ),
				'singular_name'      => __( 'URL', 'linker' ),
				'add_new'            => __( 'Add New', 'linker' ),
				'add_new_item'       => __( 'Add New URL', 'linker' ),
				'edit'               => __( 'Edit', 'linker' ),
				'edit_item'          => __( 'Edit URL', 'linker' ),
				'new_item'           => __( 'New URL', 'linker' ),
				'view'               => __( 'View URL', 'linker' ),
				'view_item'          => __( 'View URL', 'linker' ),
				'search_items'       => __( 'Search URL', 'linker' ),
				'not_found'          => __( 'No URLs found', 'linker' ),
				'not_found_in_trash' => __( 'No URLs found in Trash', 'linker' ),
			),
			'public'          => true,
			'query_var'       => true,
			'capability_type' => 'post',
			'has_archive'     => false,
			'hierarchical'    => false,
			'menu_position'   => 30,
			'supports'        => array( 'title' ),
			'rewrite'         => array(
				'slug'       => apply_filters( 'linker_prefix_slug', 'go' ),
				'with_front' => false
			),
		) );
	}
	
	public function __construct() {
		add_action( 'init', array( &$this, 'register_post_type' ) );
	}
	
}