<?php
use Elementor\Controls_Manager;
class Pxl_Icon extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_icon',
            'title'    => esc_html__('Pxl Icon', 'apexus'),
            'icon'     => 'eicon-favorite',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus', 'icon'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }

    public function get_params(){
        return [
            [
                'name' => 'content_section',
                'label' => esc_html__('Content', 'apexus' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'controls' => [
                    [
                        'name'  => 'selected_icon',
                        'label' => esc_html__( 'Icon', 'apexus' ),
                        'type'  => 'icons',
                    ],
                    [
                        'name' => 'style_icon',
                        'label' => esc_html__('Style Icon', 'apexus'),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            '' => esc_html__('Default', 'apexus'),
                            'style-1' => esc_html__('Style 1', 'apexus'),
                        ],
                        'default' => '' 
                    ],
                    [
                        'name' => 'link',
                        'label' => esc_html__('Link', 'apexus' ),
                        'type' => Controls_Manager::URL,
                        'placeholder' => esc_html__('https://your-link.com', 'apexus' ),
                        'default' => [
                            'url' => '',
                        ]
                    ],
                    [
                        'name' => 'video_link',
                        'label' => esc_html__('Video URL', 'apexus'),
                        'description' => '(https://www.youtube.com/watch?v=SF4aHwxHtZ0)',
                        'type' => Controls_Manager::URL,
                        'default' => [
                            'url' => '',
                            'is_external' => 'on'
                        ]
                    ]
                ],
            ],
            [
                'name' => 'style_section',
                'label' => esc_html__('Style', 'apexus' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'controls' => [
                    [
                        'name'       => 'icon_width',
                        'label'      => esc_html__( 'Box Width', 'apexus' ),
                        'type'       => Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                        'range'      => [
                            'px' => [
                                'min' => 6,
                                'max' => 300,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .icon-inner' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ],
                    [
                        'name'       => 'icon_height',
                        'label'      => esc_html__( 'Box Height', 'apexus' ),
                        'type'       => Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                        'range'      => [
                            'px' => [
                                'min' => 6,
                                'max' => 300,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .icon-inner' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ],
                    [
                        'name' => 'content_align',
                        'label' => esc_html__( 'Alignment', 'apexus' ),
                        'type' => Controls_Manager::CHOOSE,
                        'control_type' => 'responsive',
                        'options' => [
                            'start' => [
                                'title' => esc_html__( 'Start', 'apexus' ),
                                'icon' => 'eicon-text-align-left',
                            ],
                            'center' => [
                                'title' => esc_html__( 'Center', 'apexus' ),
                                'icon' => 'eicon-text-align-center',
                            ],
                            'end' => [
                                'title' => esc_html__( 'End', 'apexus' ),
                                'icon' => 'eicon-text-align-right',
                            ]
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .icon-inner' => 'display:flex; text-align: {{VALUE}}; justify-content: {{VALUE}};',
                        ]
                    ], 
                    [
                        'name' => 'content_vertical_alignment',
                        'label' => esc_html__( 'Vertical Alignment', 'apexus' ),
                        'type' => Controls_Manager::CHOOSE,
                        'control_type' => 'responsive',
                        'options' => [
                            'flex-start' => [
                                'title' => esc_html__( 'Top', 'apexus' ),
                                'icon' => 'eicon-v-align-top',
                            ],
                            'center' => [
                                'title' => esc_html__( 'Middle', 'apexus' ),
                                'icon' => 'eicon-v-align-middle',
                            ],
                            'flex-end' => [
                                'title' => esc_html__( 'Bottom', 'apexus' ),
                                'icon' => 'eicon-v-align-bottom',
                            ],
                        ],
                        'default' => 'top',
                        'toggle' => false,
                        'selectors' => [
                            '{{WRAPPER}} .icon-inner' => 'display:flex; align-items: {{VALUE}};',
                        ]
                    ], 
                    [
                        'name'       => 'size',
                        'label'      => esc_html__( 'Size', 'apexus' ),
                        'type'       => Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                        'range'      => [
                            'px' => [
                                'min' => 6,
                                'max' => 300,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .icon-inner .pxl-icon' => '--font-size: {{SIZE}}{{UNIT}};'
                        ],
                        'separator' => 'before',
                    ],
                    [
                        'name'       => 'fit_to_size',
                        'label' => esc_html__( 'Fit to Size', 'apexus' ),
                        'type' => Controls_Manager::SWITCHER,
                        'description' => 'Avoid gaps around icons when width and height aren\'t equal',
                        'label_off' => esc_html__( 'Off', 'apexus' ),
                        'label_on' => esc_html__( 'On', 'apexus' ),
                        'condition' => [
                            'selected_icon[library]' => 'svg',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .icon-inner svg' => 'width: 100%;',
                        ],
                    ],
                    [
                        'name'       => 'backdrop_filter',
                        'label' => esc_html__( 'Icon Backdrop Filter', 'apexus' ),
                        'type' => Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px'],
                        'range' => [
                            'px' => [
                                'max' => 50,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .icon-inner' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                        ]
                    ],
                    [
                        'name'       => 'icon_padding',
                        'label' => esc_html__( 'Padding', 'apexus' ),
                        'type' => Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                        'range' => [
                            'px' => [
                                'max' => 50,
                            ],
                            'em' => [
                                'min' => 0,
                                'max' => 5,
                            ],
                            'rem' => [
                                'min' => 0,
                                'max' => 5,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .icon-inner' => 'padding: {{SIZE}}{{UNIT}};',
                        ]
                    ],
                    [
                        'name'       => 'rotate',
                        'label' => esc_html__( 'Rotate', 'apexus' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'deg', 'grad', 'rad', 'turn', 'custom' ],
                        'control_type' => 'responsive',
                        'default' => [
                            'unit' => 'deg',
                        ],
                        'tablet_default' => [
                            'unit' => 'deg',
                        ],
                        'mobile_default' => [
                            'unit' => 'deg',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-icon i, {{WRAPPER}} .pxl-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
                        ],
                        'separator' => 'after',
                    ],
                    [
                        'name' => 'icon_effects',
                        'control_type' => 'tab',
                        'tabs' => [
                            [
                                'name' => 'normal',
                                'label' => esc_html__('Normal', 'apexus' ),
                                'type' => Controls_Manager::TAB,
                                'controls' => [
                                    [
                                        'name'    => 'icon_color',
                                        'label'   => esc_html__( 'Color', 'apexus' ),
                                        'type'    => Controls_Manager::COLOR,
                                        'default' => '',
                                        'selectors' => [
                                            '{{WRAPPER}} .pxl-icon' => '--color: {{VALUE}};',
                                        ],
                                    ],
                                    [
                                        'name' => 'background_color',
                                        'label' => esc_html__('Background Color', 'apexus' ),
                                        'type' => Controls_Manager::COLOR,
                                        'selectors' => [
                                            '{{WRAPPER}} .icon-inner' => 'background-color: {{VALUE}};',
                                        ]
                                    ], 
                                    array(
                                        'name' => 'button_shadow',
                                        'label'        => esc_html__( 'Box Shadow', 'apexus' ),
                                        'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                        'control_type' => 'group',
                                        'exclude' => [
                                            'box_shadow_position',
                                        ],
                                        'selector' => '{{WRAPPER}} .icon-inner'
                                    ),  
                                ],
                            ],
                            [
                                'name' => 'hover',
                                'label' => esc_html__('Hover', 'apexus' ),
                                'type' => Controls_Manager::TAB,
                                'controls' => [
                                    [
                                        'name'        => 'icon_color_hover',
                                        'label' => esc_html__( 'Color Hover', 'apexus' ),
                                        'type' => Controls_Manager::COLOR,
                                        'default' => '',
                                        'selectors' => [
                                            '{{WRAPPER}} .icon-inner:hover .pxl-icon' => '--color-hover: {{VALUE}};',
                                        ],
                                    ],
                                    [
                                        'name' => 'background_color_hover',
                                        'label' => esc_html__('Background Color Hover', 'apexus' ),
                                        'type' => Controls_Manager::COLOR,
                                        'selectors' => [
                                            '{{WRAPPER}} .icon-inner:hover' => 'background-color: {{VALUE}};',
                                        ]
                                    ], 
                                    [
                                        'name' => 'hover_animation',
                                        'label' => esc_html__( 'Hover Animation', 'apexus' ),
                                        'type' => Controls_Manager::SELECT,
                                        'options'      => [
                                            ''             => esc_html__( 'Default', 'apexus' ),
                                            'pulse'        => esc_html__( 'Pulse', 'apexus' ),
                                            'pulse-grow'   => esc_html__( 'Pulse Grow', 'apexus' ),
                                            'pulse-shrink' => esc_html__( 'Pulse Shrink', 'apexus' ),
                                            'push'         => esc_html__( 'Push', 'apexus' ),
                                            'pop'          => esc_html__( 'Pop', 'apexus' ),
                                            'bob'          => esc_html__( 'Bob', 'apexus' ),
                                            'fade-in-out'         => esc_html__( 'fade in out', 'apexus' ),
                                            'fade-out-in'         => esc_html__( 'fade out in', 'apexus' ),
                                        ],
                                        'default'      => '',
                                    ],
                                    [
                                        'name'      => 'hover_animation_duration',
                                        'label'     => esc_html__( 'Animation Duration (ms)', 'apexus' ),
                                        'type'      => Controls_Manager::NUMBER,
                                        'min'       => 0,
                                        'step'      => 5000,
                                        'selectors' => [
                                            '{{WRAPPER}} .icon-inner' => '--animation-duration: {{VALUE}}ms;',
                                        ],
                                        'condition' => ['hover_animation!' => '']
                                    ],
                                    array(
                                        'name' => 'button_hover_shadow',
                                        'label'        => esc_html__( 'Box Shadow', 'apexus' ),
                                        'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                        'control_type' => 'group',
                                        'exclude' => [
                                            'box_shadow_position',
                                        ],
                                        'selector' => 
                                            '{{WRAPPER}} .icon-inner:hover'
                                    ),   
                                ]
                            ]
                        ],
                    ],
                    [
                        'name'       => 'border_radius',
                        'label' => esc_html__( 'Border Radius', 'apexus' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                        'selectors' => [
                            '{{WRAPPER}} .icon-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ], 
                ],
            ]
        ];
    }
    
}

\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Icon());