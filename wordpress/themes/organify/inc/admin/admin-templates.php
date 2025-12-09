<?php

if( !defined( 'ABSPATH' ) )
	exit; 

class Organify_Admin_Templates extends Organify_Base{

	public function __construct() {
		$this->add_action( 'admin_menu', 'register_page', 20 );
	}
 
	public function register_page() {
		add_submenu_page(
			'pxlart',
		    esc_html__( 'Templates', 'organify' ),
		    esc_html__( 'Templates', 'organify' ),
		    'manage_options',
		    'edit.php?post_type=pxl-template',
		    false
		);
	}
}
new Organify_Admin_Templates;
