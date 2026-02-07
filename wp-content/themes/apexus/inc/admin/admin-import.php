<?php
/**
* The Apexus_Admin_Import class
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Apexus_Admin_Import extends Apexus_Admin_Page {

	public function __construct() {

		$this->id = 'pxlart-import-demos';
		$this->page_title = esc_html__( 'Import Demos', 'apexus' );
		$this->menu_title = esc_html__( 'Import Demos', 'apexus' );
		$this->parent = 'pxlart';

		parent::__construct();
	}

	public function display() {
		require_once get_template_directory() . '/inc/admin/views/admin-demos.php';
	}


	public function save() {

	}
}
new Apexus_Admin_Import;