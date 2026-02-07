<?php
 
add_action( 'pxl_post_metabox_register', 'apexus_page_options_register' );
function apexus_page_options_register( $metabox ) {
   
	$panels = [
		'post' => [ //post_type
			'opt_name'            => 'post_option',
			'display_name'        => esc_html__( 'Post Settings', 'apexus' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header' => [
					'title'  => esc_html__( 'Header', 'apexus' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						array(
					        array(
				                'id'       => 'disable_header',
				                'title'    => esc_html__('Disable', 'apexus'),
				                'type'     => 'switch',
				                'default'  => '0',
				            ),
					    ),
				        apexus_header_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
					        array(
				                'id'       => 'menu_location_desktop',
				                'type'     => 'select',
				                'title'    => esc_html__( 'Menu Location Desktop', 'apexus' ),
				                'options'  => apexus_get_nav_menu_locations(),
				                'default' => '-1',
				            ),
				            array(
				                'id'       => 'menu_location_mobile',
				                'type'     => 'select',
				                'title'    => esc_html__( 'Menu Location Mobile', 'apexus' ),
				                'options'  => apexus_get_nav_menu_locations(),
				                'default' => '-1',
				            )
					    )
				    )
				],
				'post_title_setting' => [
					'title'  => esc_html__( 'Post Title Settings', 'apexus' ),
					'icon'   => 'el el-indent-left',
					'fields' => array_merge(
				        apexus_page_title_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
				    )
				],
				'footer' => [
					'title'  => esc_html__( 'Footer', 'apexus' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
				        apexus_footer_opts([
							'default'         => true,
							'default_value'   => '-1'
						])
				    )
				],
			]
		],
		'page' => [ //post_type
			'opt_name'            => 'pxl_page_options',
			'display_name'        => esc_html__( 'Page Settings', 'apexus' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header' => [
					'title'  => esc_html__( 'Header', 'apexus' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						array(
					        array(
				                'id'       => 'disable_header',
				                'title'    => esc_html__('Disable', 'apexus'),
				                'type'     => 'switch',
				                'default'  => '0',
				            ),
					    ),
				        apexus_header_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
					        array(
				                'id'       => 'menu_location_desktop',
				                'type'     => 'select',
				                'title'    => esc_html__( 'Menu Location Desktop', 'apexus' ),
				                'options'  => apexus_get_nav_menu_locations(),
				                'default' => '-1',
				            ),
				            array(
				                'id'       => 'menu_location_mobile',
				                'type'     => 'select',
				                'title'    => esc_html__( 'Menu Location Mobile', 'apexus' ),
				                'options'  => apexus_get_nav_menu_locations(),
				                'default' => '-1',
				            )
					    )
				    )
				],
				'page_title' => [
					'title'  => esc_html__( 'Page Title', 'apexus' ),
					'icon'   => 'el el-indent-left',
					'fields' => array_merge(
				        apexus_page_title_opts([
							'default'         => true,
							'default_value'   => '-1'
						])
				    )
					 
				],
				'content' => [
					'title'  => esc_html__( 'Content', 'apexus' ),
					'icon'   => 'el-icon-pencil',
					'fields' => array(
						array(
				            'id'          => 'content_bb_color',
				            'type'        => 'color',
				            'title'       => esc_html__('Background Color', 'apexus'),
				            'transparent' => false,
							'output'   => array('background-color' => '.pxl-main'),
				            'default'     => ''
				        ),
					)
				],
				'footer' => [
					'title'  => esc_html__( 'Footer', 'apexus' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
				        apexus_footer_opts([
							'default'         => true,
							'default_value'   => '-1'
						])
				    )
				],
				'colors' => [
					'title'  => esc_html__( 'Colors', 'apexus' ),
					'icon'   => 'el el-website',
					'fields' => array(
				        array(
				            'id'          => 'primary_color',
				            'type'        => 'color',
				            'title'       => esc_html__('Primary Color', 'apexus'),
				            'transparent' => false,
				            'default'     => ''
				        ), 
				        array(
				            'id'          => 'second_color',
				            'type'        => 'color',
				            'title'       => esc_html__('Secondary Color', 'apexus'),
				            'transparent' => false,
				            'default'     => ''
				        ),
				        array(
				            'id'          => 'heading_color',
				            'type'        => 'color',
				            'title'       => esc_html__('Heading Color', 'apexus'),
				            'transparent' => false,
				            'default'     => ''
				        ), 
				        array(
				            'id'      => 'link_color',
				            'type'    => 'link_color',
				            'title'   => esc_html__('Link Colors', 'apexus'),
				            'default' => array(
				                'regular' => '',
				                'hover'   => '',
				                'active'  => ''
				            ),
				            'output'  => array('a')
				        ),
				    )
				],
				  
			]
		],
		'portfolio' => [ //post_type
			'opt_name'            => 'portfolio_option',
			'display_name'        => esc_html__( 'Settings', 'apexus' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header' => [
					'title'  => esc_html__( 'Header', 'apexus' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						array(
					        array(
				                'id'       => 'disable_header',
				                'title'    => esc_html__('Disable', 'apexus'),
				                'type'     => 'switch',
				                'default'  => '0',
				            ),
					    ),
				        apexus_header_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
					        array(
				                'id'       => 'menu_location_desktop',
				                'type'     => 'select',
				                'title'    => esc_html__( 'Menu Location Desktop', 'apexus' ),
				                'options'  => apexus_get_nav_menu_locations(),
				                'default' => '-1',
				            ),
				            array(
				                'id'       => 'menu_location_mobile',
				                'type'     => 'select',
				                'title'    => esc_html__( 'Menu Location Mobile', 'apexus' ),
				                'options'  => apexus_get_nav_menu_locations(),
				                'default' => '-1',
				            )
					    )
				    )
				],
				'portfolio_page_title_setting' => [
					'title'  => esc_html__( 'Page Title', 'apexus' ),
					'icon'   => 'el el-indent-left',
					'fields' => array_merge(
				        apexus_page_title_opts([
							'default'         => true,
							'default_value'   => '-1',
							'output_prefix'   => 'body.single-portfolio'
						])
				    )
				],
				'footer' => [
					'title'  => esc_html__( 'Footer', 'apexus' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
				        apexus_footer_opts([
							'default'         => true,
							'default_value'   => '-1'
						])
				    )
				],
			]
		],
		'services' => [ //post_type
			'opt_name'            => 'services_option',
			'display_name'        => esc_html__( 'Settings', 'apexus' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header' => [
					'title'  => esc_html__( 'Header', 'apexus' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						array(
					        array(
				                'id'       => 'disable_header',
				                'title'    => esc_html__('Disable', 'apexus'),
				                'type'     => 'switch',
				                'default'  => '0',
				            ),
					    ),
				        apexus_header_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
					        array(
				                'id'       => 'menu_location_desktop',
				                'type'     => 'select',
				                'title'    => esc_html__( 'Menu Location Desktop', 'apexus' ),
				                'options'  => apexus_get_nav_menu_locations(),
				                'default' => '-1',
				            ),
				            array(
				                'id'       => 'menu_location_mobile',
				                'type'     => 'select',
				                'title'    => esc_html__( 'Menu Location Mobile', 'apexus' ),
				                'options'  => apexus_get_nav_menu_locations(),
				                'default' => '-1',
				            )
					    )
				    )
				],
				'services_page_title_setting' => [
					'title'  => esc_html__( 'Page Title', 'apexus' ),
					'icon'   => 'el el-indent-left',
					'fields' => array_merge(
				        apexus_page_title_opts([
							'default'         => true,
							'default_value'   => '-1',
							'output_prefix'   => 'body.single-services'
						])
				    )
				],
				'footer' => [
					'title'  => esc_html__( 'Footer', 'apexus' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
				        apexus_footer_opts([
							'default'         => true,
							'default_value'   => '-1'
						])
				    )
				],
			]
		],
		'career' => [ //post_type
			'opt_name'            => 'career_option',
			'display_name'        => esc_html__( 'Settings', 'apexus' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header' => [
					'title'  => esc_html__( 'Header', 'apexus' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						array(
					        array(
				                'id'       => 'disable_header',
				                'title'    => esc_html__('Disable', 'apexus'),
				                'type'     => 'switch',
				                'default'  => '0',
				            ),
					    ),
				        apexus_header_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
					        array(
				                'id'       => 'menu_location_desktop',
				                'type'     => 'select',
				                'title'    => esc_html__( 'Menu Location Desktop', 'apexus' ),
				                'options'  => apexus_get_nav_menu_locations(),
				                'default' => '-1',
				            ),
				            array(
				                'id'       => 'menu_location_mobile',
				                'type'     => 'select',
				                'title'    => esc_html__( 'Menu Location Mobile', 'apexus' ),
				                'options'  => apexus_get_nav_menu_locations(),
				                'default' => '-1',
				            )
					    )
				    )
				],
				'career_page_title_setting' => [
					'title'  => esc_html__( 'Page Title', 'apexus' ),
					'icon'   => 'el el-indent-left',
					'fields' => array_merge(
				        apexus_page_title_opts([
							'default'         => true,
							'default_value'   => '-1',
							'output_prefix'   => 'body.single-career'
						])
				    )
				],
				'footer' => [
					'title'  => esc_html__( 'Footer', 'apexus' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
				        apexus_footer_opts([
							'default'         => true,
							'default_value'   => '-1'
						])
				    )
				],
				'career_settings' => [
					'title'  => esc_html__( 'Settings', 'apexus' ),
					'icon'   => 'el-icon-website',
					'fields' => array( 
						array(
				            'id'          => 'location_text',
				            'type'        => 'text',
				            'title'       => esc_html__('Location', 'apexus'),
							'default'     => esc_html__('Dallas, TX (On-site)', 'apexus'),
				        ),
						array(
				            'id'          => 'team_text',
				            'type'        => 'text',
				            'title'       => esc_html__('Team', 'apexus'),
				            'default'     => esc_html__('Operations', 'apexus')
				        ),
						array(
				            'id'          => 'Time_text',
				            'type'        => 'text',
				            'title'       => esc_html__('Time', 'apexus'),
				            'default'     => esc_html__('Full-time', 'apexus')
				        ),
					)
				],
			]
		],
		'product' => [ //post_type
			'opt_name'            => 'product_option',
			'display_name'        => esc_html__( 'Product Settings', 'apexus' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header' => [
					'title'  => esc_html__( 'Header', 'apexus' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						array(
					        array(
				                'id'       => 'disable_header',
				                'title'    => esc_html__('Disable', 'apexus'),
				                'type'     => 'switch',
				                'default'  => '0',
				            ),
					    ),
				        apexus_header_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
					        array(
				                'id'       => 'menu_location_desktop',
				                'type'     => 'select',
				                'title'    => esc_html__( 'Menu Location Desktop', 'apexus' ),
				                'options'  => apexus_get_nav_menu_locations(),
				                'default' => '-1',
				            ),
				            array(
				                'id'       => 'menu_location_mobile',
				                'type'     => 'select',
				                'title'    => esc_html__( 'Menu Location Mobile', 'apexus' ),
				                'options'  => apexus_get_nav_menu_locations(),
				                'default' => '-1',
				            )
					    )
				    )
				],
				'product_title_setting' => [
					'title'  => esc_html__( 'Page Title Settings', 'apexus' ),
					'icon'   => 'el el-indent-left',
					'fields' => array_merge(
				        apexus_page_title_opts([
							'default'         => true,
							'default_value'   => '-1',
							'output_prefix'   => 'body.single-product'
						])
				    )
				],
				'footer' => [
					'title'  => esc_html__( 'Footer', 'apexus' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
				        apexus_footer_opts([
							'default'         => true,
							'default_value'   => '-1'
						])
				    )
				], 
			]
		],
		'pxl-template' => [ //post_type
			'opt_name'            => 'pxl_template_options',
			'display_name'        => esc_html__( 'Template Settings', 'apexus' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'general' => [
					'title'  => esc_html__( 'General', 'apexus' ),
					'icon'   => 'el-icon-website',
					'fields' => array(
						array(
							'id'    => 'template_type',
							'type'  => 'select',
							'title' => esc_html__('Type', 'apexus'),
				            'options' => [
								'df'            => esc_html__('Select Type', 'apexus'), 
								'header'        => esc_html__('Header', 'apexus'), 
								'header-mobile' => esc_html__('Header Mobile', 'apexus'), 
								'footer'        => esc_html__('Footer', 'apexus'), 
								'mega-menu'     => esc_html__('Mega Menu', 'apexus'), 
								'page-title'    => esc_html__('Page Title', 'apexus'), 
								'hidden-panel'  => esc_html__('Hidden Panel', 'apexus'), 
								'tab'           => esc_html__('Tab', 'apexus'), 
								'accordion'  => esc_html__('Accordion', 'apexus'), 
				            ],
				            'default' => 'df',
				        ),
				        array(
							'id'       => 'template_position',
							'type'     => 'select',
							'title'    => esc_html__('Display Position', 'apexus'),
							'options'  => [
								'left'   => esc_html__('Left Position', 'apexus'),
								'top'    => esc_html__('Top Position', 'apexus'),
								'center' => esc_html__('Center Position (popup)', 'apexus'),
								'right'  => esc_html__('Right Position', 'apexus'),
								'full'   => esc_html__('Full Screen', 'apexus'),
								'custom'  => esc_html__('Custom Offset', 'apexus'),
				            ],
							'default'  => 'left',
							'required' => [ 'template_type', '=', 'hidden-panel']
				        ),
				        array(
							'id'       => 'template_custom_style',
							'type'     => 'select',
							'title'    => esc_html__('Custom Style', 'apexus'),
							'options'  => [
								''   => esc_html__('None', 'apexus'),
								'pxl-side-mobile'    => esc_html__('Mobile Menu', 'apexus'),
								'pxl-canvas-menu'    => esc_html__('Canvas Menu', 'apexus'),
								'pxl-hidden-sidebar'    => esc_html__('Hidden Sidebar', 'apexus'),
				            ],
							'default'     => '',
							'required' => [ 'template_type', '=', 'hidden-panel']
				        ),
			         	array(
		                    'id'            => 'mega_menu_max_width',
		                    'title'         => esc_html__( 'Mega Menu Max Width (px)', 'apexus' ),
		                    'type'          => 'slider',
		                    'default'       => 0,
		                    'min'           => 0,
		                    'max'           => 2560,
		                    'step'          => 1,
		                    'display_value' => 'text',
		                    'required' => [ 'template_type', '=', 'mega-menu']
		                ),
		                array(
			                'id'             => 'custom_offset',
					        'type'           => 'spacing',
					        'mode'           => 'absolute',
					        'units'          => array('px', 'em', '%', 'vw'),
					        'units_extended' => 'true',
					        'title'          => esc_html__( 'Custom Offset', 'apexus' ),
					        'desc'           => esc_html__('You can enable or disable any piece of this field. Top, Right, Bottom, Left, or Units.', 'apexus'),
					        'default'            => array(
					            'top'     => '', 
					            'right'   => '', 
					            'bottom'  => '', 
					            'left'    => '',
					            'units'   => 'px', 
					        ),
					        'required' => [ 'template_position', '=', 'custom']
				        ),
				        array(
			                'id'             => 'custom_offset_mobile',
					        'type'           => 'spacing',
					        'mode'           => 'absolute',
					        'units'          => array('px', 'em', '%', 'vw'),
					        'units_extended' => 'true',
					        'title'          => esc_html__( 'Custom Offset Mobile', 'apexus' ),
					        'desc'           => esc_html__('You can enable or disable any piece of this field. Top, Right, Bottom, Left, or Units.', 'apexus'),
					        'default'            => array(
					            'top'     => '', 
					            'right'   => '', 
					            'bottom'  => '', 
					            'left'    => '',
					            'units'   => 'px', 
					        ),
					        'required' => [ 'template_position', '=', 'custom']
				        ),
		                array(
				            'id'       => 'template_bg_color',
				            'type'     => 'color_rgba',
				            'title'    => esc_html__('Background Color', 'apexus'),
				            'required' => [ 'template_type', '=', 'hidden-panel']
				        ), 
					),
				    
				],
			]
		],
		  
	];
 
	$metabox->add_meta_data( $panels );
}
 