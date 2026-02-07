<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_sphere',
        'title' => esc_html__('PXl Sphere', 'apexus'),
        'icon' => 'eicon-circle-o',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'sphere',
            'apexus-sphere'
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'apexus' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name'         => 'layout',
                            'label'        => esc_html__( 'Templates', 'apexus' ),
                            'type'         => 'layoutcontrol',
                            'default'      => '1',
                            'options'      => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'apexus' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_sphere-1.webp'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'apexus' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_sphere-2.webp'
                                ],
                            ],
                            'prefix_class' => 'pxl-sphere-layout',
                        ) 
                    ),
                ),
                array(
                    'name' => 'section_content',
                    'label' => esc_html__('Content', 'apexus'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'sphere_size',
                            'label' => esc_html__('Sphere Size', 'apexus'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 50,
                                    'max' => 2000,
                                        'step' => 10,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 400,
                            ],
                        ),
                        array(
                            'name' => 'tilt_angle',
                            'label' => esc_html__('Tilt Angle', 'apexus'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => ['deg'],
                            'range' => [
                                'deg' => [
                                    'min' => -90,
                                    'max' => 90,
                                    'step' => 1,
                                ],
                            ],
                            'default' => [
                                'unit' => 'deg',
                                'size' => -30,
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'sphere_color',
                            'label' => esc_html__('Sphere Color', 'apexus'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                        ),
                        array(
                            'name' => 'rotation_type',
                            'label' => esc_html__('Rotation Type', 'apexus'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'y_axis',
                            'options' => [
                                'y_axis' => esc_html__('Y Axis (Horizontal)', 'apexus'),
                                'x_axis' => esc_html__('X Axis (Vertical)', 'apexus'),
                                'both_axis' => esc_html__('Both Axes', 'apexus'),
                            ],
                            'condition' => [
                                'layout' => '1'
                            ]
                        ),
                        array(
                            'name' => 'rotation_type2',
                            'label' => esc_html__('Rotation Type', 'apexus'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'y_axis',
                            'options' => [
                                'y_axis' => esc_html__('Y Axis (Horizontal)', 'apexus'),
                                'x_axis' => esc_html__('X Axis (Vertical)', 'apexus'),
                                'both_axis' => esc_html__('Both Axes', 'apexus'),
                                'custom' => esc_html__('Custom Path', 'apexus'),
                                'none' => esc_html__('No Rotation', 'apexus'),
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'rotation_speed',
                            'label' => esc_html__('Rotation Speed', 'apexus'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [''],
                            'range' => [
                                '' => [
                                    'min' => 0.001,
                                    'max' => 0.02,
                                    'step' => 0.001,
                                ],
                            ],
                            'default' => [
                                'size' => 0.005,
                            ],
                        ),
                        array(
                            'name' => 'custom_x_speed',
                            'label' => esc_html__('X Axis Speed', 'apexus'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [''],
                            'range' => [
                                '' => [
                                    'min' => -0.02,
                                    'max' => 0.02,
                                    'step' => 0.001,
                                ],
                            ],
                            'default' => [
                                'size' => 0.003,
                            ],
                            'condition' => [
                                'rotation_type' => ['both_axis', 'custom'],
                                'layout' => '2'
                            ],
                        ),
                        array(
                            'name' => 'custom_y_speed',
                            'label' => esc_html__('Y Axis Speed', 'apexus'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [''],
                            'range' => [
                                '' => [
                                    'min' => -0.02,
                                    'max' => 0.02,
                                    'step' => 0.001,
                                ],
                            ],
                            'default' => [
                                'size' => 0.005,
                            ],
                            'condition' => [
                                'rotation_type' => ['both_axis', 'custom'],
                                'layout' => '2'
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    apexus_get_class_widget_path()
);