<?php
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_clients',
        'title'      => esc_html__('PXL Clients', 'apexus'),
        'icon'       => 'eicon-slider-push',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(
            'swiper',
            'apexus-swiper',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_client-1.webp'
                                ],
                            ],
                            'prefix_class' => 'pxl-clients-layout-'
                        )
                    ),
                ),
                array(
                    'name'     => 'clients_list',
                    'label'    => esc_html__('Clients', 'apexus'),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'     => 'clients',
                            'label'    => esc_html__('Add Client', 'apexus'),
                            'type'     => 'repeater',
                            'controls' => array(
                                array(
                                    'name'        => 'client_img',
                                    'label'       => esc_html__('Client Image', 'apexus'),
                                    'type'        => 'media',
                                    'label_block' => true,
                                ),
                                array(
                                    'name'        => 'image_link',
                                    'label'       => esc_html__( 'Client Link', 'apexus' ),
                                    'type'        => 'url',
                                    'placeholder' => esc_html__( 'https://your-link.com', 'apexus' ),
                                    'default'     => [
                                        'url'         => '#',
                                        'is_external' => 'on'
                                    ],
                                )
                            ),
                            'default' => [],
                            'title_field' => '{{{ name }}}',
                        ),
                        array(
                            'name'  => 'bg_size',
                            'label' => esc_html__( 'Background Size', 'apexus' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-clients .item-image a' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'background_color',
                            'label' => esc_html__('Background Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-clients .item-image a' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'background_color_hover',
                            'label' => esc_html__('Background Color Hover', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-clients .item-image a:hover' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'border_color_hover',
                            'label' => esc_html__('Border Color Hover', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-clients .item-image a:hover' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'border_radius',
                            'label' => esc_html__('Border Radius Image', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px','%' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-clients .item-image a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ),
                    )
                ),
                array(
                    'name' => 'carousel_setting',
                    'label' => esc_html__('Carousel Settings', 'apexus'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        apexus_carousel_settings()    
                    ),
                ),
                array(
                    'name' => 'section_arrows_settings',
                    'label' => esc_html__('Arrows Settings', 'apexus'),
                    'tab'      => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        apexus_carousel_arrow_settings()   
                    )
                ),
                array(
                    'name' => 'section_dots_settings',
                    'label' => esc_html__('Dots Settings', 'apexus'),
                    'tab'      => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        apexus_carousel_dots_settings()
                    )
                ),
            )
        )
    ),
    apexus_get_class_widget_path()
);