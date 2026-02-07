<?php

$uri = get_template_directory_uri() . '/inc/admin/demo-data/demo-imgs/';
$pxl_server_info = apply_filters( 'pxl_server_info', ['demo_url' => ''] ) ;
// Demos
$demos = array(
	// Elementor Demos
	'apexus' => array(
		'title'       => 'Apexus',
		'description' => '',
		'screenshot'  => $uri . 'apexus.jpg',
		'preview'     => $pxl_server_info['demo_url'],
	),
);