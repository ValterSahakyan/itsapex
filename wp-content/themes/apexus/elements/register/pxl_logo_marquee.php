<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_logo_marquee',
        'title' => esc_html__('Pxl Logo Marquee', 'apexus'),
        'icon' => 'eicon-image',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(
            'gsap',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'apexus' ),
                    'tab' => 'layout',
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'apexus' ),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'apexus' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_logo_marquee-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'apexus' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_logo_marquee-2.webp'
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'apexus' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_logo_marquee-3.webp'
                                ],
                            ],
                            'prefix_class' => 'pxl-logo-marquee-layout-'
                        )
                    ),
                ),
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'apexus'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'marquee',
                            'label' => esc_html__('Text Marquee', 'apexus'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name'        => 'image_slide',
                                    'label'       => esc_html__('Image', 'apexus'),
                                    'type'        => 'media',
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'text',
                                    'label' => esc_html__('Text', 'apexus' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'description'  => esc_html__('Use for layout 2', 'apexus' ),
                                ),
                            ),                         
                        ),
                    ),
                ),
                array(
                    'name' => 'section_settings_carousel',
                    'label' => esc_html__('Settings', 'apexus'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
                        array(
                            'name' => 'slip_type',
                            'label' => esc_html__('Slip Type', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'left',
                            'options' => [
                                'left' => 'Right To Left',
                                'right' => 'Left To Right',
                            ],
                        ),
                        array(
                            'name' => 'pxl_animate_speed',
                            'label' => esc_html__('Animation Speed', 'apexus'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'min' => 0.1,
                            'step' => 0.1,
                            'default' => 1,
                            'description' => 'Speed multiplier (1 = normal, 2 = fast, 0.5 = slow)',
                        ),
                        array(
                            'name' => 'col_xs',
                            'label' => esc_html__('Columns XS Devices', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '1',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '6' => '6',
                                'auto' => 'auto',
                            ],
                        ),
                        array(
                            'name' => 'col_sm',
                            'label' => esc_html__('Columns SM Devices', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '2',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '6' => '6',
                                'auto' => 'auto',
                            ],
                        ),
                        array(
                            'name' => 'col_md',
                            'label' => esc_html__('Columns MD Devices', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '3',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '6' => '6',
                                'auto' => 'auto',
                            ],
                        ),
                        array(
                            'name' => 'col_lg',
                            'label' => esc_html__('Columns LG Devices', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '3',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6',
                                'auto' => 'auto',
                            ],
                        ),
                        array(
                            'name' => 'col_xl',
                            'label' => esc_html__('Columns XL Devices', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '3',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6',
                                'auto' => 'auto',
                            ],
                        ),
                    ),
                ),

            array(
                'name' => 'section_style',
                'label' => esc_html__('Style', 'apexus'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'controls' => array(
                    array(
                        'name' => 'bg_gradient',
                        'label' => esc_html__( 'Background Gradient', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options'      => [
                            ''             => esc_html__( 'None', 'apexus' ),
                            'acc-linear'        => esc_html__( 'Linear', 'apexus' ),
                        ],
                        'default'      => '',
                        'condition' =>[
                            'layout' => '1',
                        ]
                    ),
                    array(
                        'name' => 'gradient_1',
                        'label' => esc_html__('Color 1', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-logo-marquee1 .pxl-logo-active::before' => '--linear-color1: {{VALUE}};',
                        ],
                        'condition' =>[
                            'bg_gradient' => 'acc-linear',
                            'layout' => '1'
                        ]
                    ),
                    array(
                        'name' => 'gradient_2',
                        'label' => esc_html__('Color 2', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-logo-marquee1 .pxl-logo-active::before' => '--linear-color2: {{VALUE}};',
                        ],
                        'condition' =>[
                            'bg_gradient' => 'acc-linear',
                            'layout' => '1'
                        ]
                    ),
                    array(
                        'name' => 'setting_mask',
                        'label' => esc_html__( 'Setting Mask', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options'      => [
                            ''             => esc_html__( 'Default', 'apexus' ),
                            'mask-none'        => esc_html__( 'None', 'apexus' ),
                        ],
                        'default'      => '',
                        'condition' =>[
                            'layout' => '1',
                        ]
                    ),
                    array(
                        'name' => 'text_typography',
                        'label' => esc_html__('Text Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-logo-marquee1 .pxl-text--logo',
                        'condition' =>[
                            'layout' => '2'
                        ]
                    ),
                    array(
                        'name' => 'text_color',
                        'label' => esc_html__('Text Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-logo-marquee1 .pxl-text--logo' => 'color: {{VALUE}};',
                        ],
                        'condition' =>[
                            'layout' => '2'
                        ]
                    ),
                    array(
                        'name'  => 'width_image',
                        'label' => esc_html__( 'Width Image', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px','%' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 500,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-logo-marquee1 .item-image img' => 'width: {{SIZE}}{{UNIT}}; object-fit: cover;',
                        ],
                    ),
                    array(
                        'name'  => 'height_image',
                        'label' => esc_html__( 'Height Image', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px','%' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 500,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-logo-marquee1 .item-image img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                        ],
                    ),
                    array(
                        'name'  => 'width_item',
                        'label' => esc_html__( 'Width Item', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px','%' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 500,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-logo-marquee1 .item-image' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' =>[
                            'layout' => ['1','3']
                        ]
                    ),
                    array(
                        'name'  => 'height_item',
                        'label' => esc_html__( 'Height Item', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px','%' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 500,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-logo-marquee1 .item-image' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' =>[
                            'layout' => ['1','3']
                        ]
                    ),
                    array(
                        'name' => 'bg_color_item',
                        'label' => esc_html__('Background Color item', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-logo-marquee1 .item-image::before' => 'background-color: {{VALUE}};',
                        ],
                        'condition' =>[
                            'layout' => '1'
                        ]
                    ),
                    array(
                        'name'  => 'backdrop_filter_item',
                        'label' => esc_html__( 'Blur Item', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px'],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-logo-marquee1 .item-image::before' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                        ],
                        'condition' =>[
                            'layout' => ['1']
                        ]
                    ),
                    array(
                        'name' => 'border_color',
                        'label' => esc_html__('Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-logo-marquee1 .item-image' => 'border-color: {{VALUE}};',
                        ],
                        'condition' =>[
                            'layout' => '3'
                        ]
                    ),
                    array(
                        'name' => 'border_radius',
                        'label' => esc_html__('Border Radius', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'control_type' => 'responsive',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-logo-marquee1 .item-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' =>[
                            'layout' => ['1','2']
                        ]
                    ),
                    array(
                        'name' => 'space_item',
                        'label' => esc_html__('Space Item', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 200,
                            ],
                        ],
                        'control_type' => 'responsive',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-logo-marquee1 .pxl-flex-middle' => 'gap: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-logo-marquee1 .pxl-item--marquee:first-child .pxl-item--inner,{{WRAPPER}} .pxl-logo-marquee1 .box-image:first-child .pxl-item--inner' => 'margin-left: {{SIZE}}{{UNIT}};'
                        ],
                    ),
                ),
            ),

        ),
    ),
),
apexus_get_class_widget_path()
);