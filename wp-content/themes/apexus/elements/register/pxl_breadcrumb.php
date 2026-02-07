<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_breadcrumb',
        'title' => esc_html__('PXL Breadcrumb', 'apexus' ),
        'icon' => 'eicon-navigation-horizontal',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'apexus' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__( 'Templates', 'apexus' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'apexus' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_fancy_box-1.jpg'
                                ],
                            ],
                        )
                    )
                ),
                array(
                    'name' => 'content_section',
                    'label' => esc_html__('Style', 'apexus' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'text_align',
                            'label' => esc_html__('Alignment', 'apexus' ),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Start', 'apexus' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'apexus' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'End', 'apexus' ),
                                    'icon' => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb' => 'text-align: {{VALUE}}; justify-content: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'brc_color',
                            'label' => esc_html__('Text Color', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb, .pxl-breadcrumb .br-item' => 'color: {{VALUE}} !important;',
                                '{{WRAPPER}} .pxl-breadcrumb.hide-underline .br-item .br-text::after' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'link_color',
                            'label' => esc_html__('Link Color', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb a' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'link_color_hover',
                            'label' => esc_html__('Link Color Hover', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb a:hover' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name'             => 'selected_icon',
                            'label'            => esc_html__( 'Divider Icon', 'apexus' ),
                            'type'             => 'icons',
                        ),
                        array(
                            'name'  => 'icon_size',
                            'label' => esc_html__( 'Icon Size(px)', 'apexus' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb .pxli' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                                '{{WRAPPER}} .pxl-breadcrumb svg' => 'width: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb .br-divider' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'brc_typography',
                            'label' => esc_html__('Typography', 'apexus' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-breadcrumb, {{WRAPPER}} .pxl-breadcrumb a, {{WRAPPER}} .pxl-breadcrumb .br-item, {{WRAPPER}} .pxl-breadcrumb .br-divider, {{WRAPPER}} .pxl-breadcrumb .br-item',
                        ),
                        array(
                            'name' => 'btn_padding',
                            'label' => esc_html__('Padding', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb .br-divider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ),
                    ),
                ),
            ),
        ),
    ),
    apexus_get_class_widget_path()
);