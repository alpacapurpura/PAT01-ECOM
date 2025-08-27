<?php
/**
* The Organify_Admin_Dashboard base class
*/

if( !defined( 'ABSPATH' ) )
	exit; 

class Organify_Admin_Dashboard extends Organify_Admin_Page {

	public function __construct() {
		$this->id = 'pxlart';
		$this->page_title = organify()->get_name();
		$this->menu_title = organify()->get_name();
		$this->position = '50';

		parent::__construct();
	}

	public function display() {
		include_once( get_template_directory() . '/inc/admin/views/admin-dashboard.php' );
	}
 
	public function save() {

	}
}
new Organify_Admin_Dashboard;
