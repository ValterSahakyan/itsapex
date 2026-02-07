<?php
/**
* The Apexus_Admin_Dashboard base class
*/

if( !defined( 'ABSPATH' ) )
	exit; 

class Apexus_Admin_Dashboard extends Apexus_Admin_Page {

	public function __construct() {
		$this->id = 'pxlart';
		$this->page_title = apexus()->get_name();
		$this->menu_title = apexus()->get_name();
		$this->position = '50';

		parent::__construct();
	}

	public function display() {
		require_once get_template_directory() . '/inc/admin/views/admin-dashboard.php';
	}
 
	public function save() {

	}
}
new Apexus_Admin_Dashboard;
