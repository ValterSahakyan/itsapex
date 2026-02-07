<?php
use Elementor\Controls_Manager;
class Pxl_video extends Pxl_Widget_Base{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_video',
            'title'    => esc_html__('Pxl Video', 'apexus'),
            'icon'     => 'eicon-play',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus', 'video'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        return [
            [
                'name' => 'layout_section',
                'label' => esc_html__('Layout', 'apexus'),
                'tab' => 'layout',
                'controls' => array(
                    array(
                        'name' => 'layout',
                        'label' => esc_html__('Templates', 'apexus'),
                        'type' => 'layoutcontrol',
                        'default' => '1',
                        'options' => [
                            '1' => [
                                'label' => esc_html__('Layout 1', 'apexus'),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_video-1.jpg'
                            ],
                        ],
                        'prefix_class' => 'pxl-video-layout-'
                    ),
                )
            ],
            [
                'name' => 'video_section',
                'label' => esc_html__('Video', 'apexus'),
                'tab' => 'content',
                'controls' => array_merge(
                    array(
                        array(
                            'name'             => 'selected_icon',
                            'label'            => esc_html__( 'Icon', 'apexus' ),
                            'type'             => 'icons',
                            'default'          => [],
                            'condition' => ['layout' => ['1']]
                        ),
                        array(
                            'name' => 'video_bt_style',
                            'label' => esc_html__('Video Button Style', 'apexus'),
                            'type' => Controls_Manager::SELECT,
                            'options' => [
                                'df' => esc_html__('Default', 'apexus'),
                            ],
                            'default' => 'df',
                            'label_block' => true,
                            'condition' => ['layout' => ['1']]
                        ),

                        array(
                            'name' => 'video_link',
                            'label' => esc_html__('Video URL', 'apexus'),
                            'description' => '(https://www.youtube.com/watch?v=SF4aHwxHtZ0)',
                            'type' => Controls_Manager::URL,
                            'default' => [
                                'url' => '#',
                                'is_external' => 'on'
                            ]
                        ),
                        array(
                            'name' => 'video_text',
                            'label' => esc_html__('Text', 'apexus'),
                            'type' => Controls_Manager::TEXT,
                            'default' => '',
                        ),
                    )
                )
            ],
            [
                'name'     => 'style_section',
                'label'    => esc_html__('Style', 'apexus' ),
                'tab'      => 'style',
                'controls' => [
                    array(
                        'name'  => 'max_width',
                        'label' => esc_html__( 'Max Width (px)', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 100,
                                'max' => 1920,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-video-player' => 'max-width: {{SIZE}}{{UNIT}};'
                        ],
                        'separator' => 'before',
                        'condition' => [
                            'video_bt_style!' => 'style-2'
                        ]
                    ),
                    array(
                        'name' => 'content_align',
                        'label' => esc_html__('Content Alignment', 'apexus' ),
                        'type' => 'choose',
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
                            '{{WRAPPER}} .btn-video-wrap' => 'justify-content: {{VALUE}}; align-items: {{VALUE}};',
                        ],
                        'condition' => [
                            'video_bt_style!' => 'style-2'
                        ]
                    ),
                    array(
                        'name' => 'video_spacing',
                        'label' => esc_html__('Padding Button (px)', 'apexus' ),
                        'type' => 'dimensions',
                        'default' => ['top' => '', 'right' => '', 'bottom' => '', 'left' => ''],
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-video-player .pxl-video-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => [
                            'video_bt_style!' => 'style-2'
                        ]
                    ),
                    array(
                        'name'         => 'border_radius',
                        'label'        => esc_html__( 'Border Radius Button', 'apexus' ),
                        'type'         => Controls_Manager::DIMENSIONS,
                        'control_type' => 'responsive',
                        'size_units'   => [ 'px', '%' ],
                        'selectors'    => [
                            '{{WRAPPER}} .pxl-video-player .pxl-video-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow:hidden;',
                        ],
                        'condition' => [
                            'video_bt_style!' => 'style-2'
                        ]
                    ),
                    array(
                        'name' => 'video_play_width',
                        'label' => esc_html__('Video Button Width', 'apexus' ),
                        'type' => Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'default' => [
                            'unit' => 'px',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                        ],
                        'size_units' => [ '%', 'px', 'vw' ],
                        'range' => [
                            '%' => [
                                'min' => 1,
                                'max' => 100,
                            ],
                            'px' => [
                                'min' => 1,
                                'max' => 500,
                            ],
                            'vw' => [
                                'min' => 1,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-video-player .pxl-video-btn' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'video_bt_style!' => 'style-2'
                        ]
                    ), 
                     array(
                        'name' => 'video_play_width_2',
                        'label' => esc_html__('Video Button Width', 'apexus' ),
                        'type' => Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'default' => [
                            'unit' => 'px',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                        ],
                        'size_units' => [ '%', 'px', 'vw' ],
                        'range' => [
                            '%' => [
                                'min' => 1,
                                'max' => 100,
                            ],
                            'px' => [
                                'min' => 1,
                                'max' => 500,
                            ],
                            'vw' => [
                                'min' => 1,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-video-player.btn-style-style-2 .btn-video-wrap' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'video_bt_style' => 'style-2'
                        ]
                    ), 
                    
                    array(
                        'name' => 'video_play_border_width',
                        'label' => esc_html__('Video Button Border Width', 'apexus' ),
                        'type' => Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'default' => [
                            'unit' => 'px',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                        ],
                        'size_units' => ['px',],
                        'range' => [
                            'px' => [
                                'min' => 1,
                                'max' => 10,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-video-player .pxl-video-btn' => 'border: {{SIZE}}{{UNIT}} solid;',
                        ],
                        'condition' => [
                            'video_bt_style!' => 'style-2'
                        ]
                    ), 
                    
                    array(
                        'name' => 'play_icon_fontsize',
                        'label' => esc_html__('Play Icon Font Size (px)', 'apexus' ),
                        'type' => Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'default' => [
                            'unit' => 'px',
                        ],
                        'size_units' => ['px'],
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 500,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-video-player .pxl-video-btn > .pxl-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-video-player .pxl-video-btn > svg' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ), 
                    array(
                        'name' => 'text_color',
                        'label' => esc_html__('Text Color', 'apexus'),
                        'type' => Controls_Manager::COLOR,
                        'condition' => [
                            'video_text!' => ''
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-video-player .video-text' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-video-player.btn-style-style-2 .curved-text' => 'fill: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'text_typography',
                        'label' => esc_html__('Text Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-video-player .video-text,{{WRAPPER}} .pxl-video-player.btn-style-style-2 .curved-text', 
                    ),
                    array(
                        'name' => 'space_text',
                        'label' => esc_html__('Space Text (px)', 'apexus' ),
                        'type' => Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'default' => [
                            'unit' => 'px',
                        ],
                        'size_units' => ['px'],
                        'range' => [
                            'px' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-video-player .video-text' => 'margin-top: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-video-player.btn-style-style-2 .curved-text' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ), 
                     array(
                        'name' => 'bg_color_overlay',
                        'label' => esc_html__('Background Color Overlay', 'apexus'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-video-player .btn-video-wrap::before' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'video_bt_style' => 'style-2'
                        ]
                    ),
                    array(
                        'name' => 'video_player_effects',
                        'control_type' => 'tab',
                        'tabs' => [
                            [
                                'name' => 'normal',
                                'label' => esc_html__('Normal', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::TAB,
                                'controls' => [
                                    array(
                                        'name' => 'video_play_bg',
                                        'label' => esc_html__('Button Background', 'apexus'),
                                        'type' => Controls_Manager::COLOR,
                                        'condition' => [
                                           'video_bt_style!' => 'style-1'
                                        ],
                                        'selectors' => [
                                            '{{WRAPPER}} .pxl-video-player .pxl-video-btn' => 'background-color: {{VALUE}};',
                                        ],
                                    ),
                                    array(
                                        'name' => 'bg_style1',
                                        'label' => esc_html__('Button Background', 'apexus'),
                                        'type' => Controls_Manager::COLOR,
                                        'condition' => [
                                           'video_bt_style' => 'style-1'
                                        ],
                                        'selectors' => [
                                            '{{WRAPPER}} .pxl-video-player.btn-style-style-1 .pxl-video-btn::before' => 'background-color: {{VALUE}};',
                                        ],
                                    ),
                                    array(
                                        'name' => 'video_play_border_color',
                                        'label' => esc_html__('Button Border Color', 'apexus'),
                                        'type' => Controls_Manager::COLOR,
                                        'selectors' => [
                                            '{{WRAPPER}} .pxl-video-player.layout-1 .pxl-video-btn' => 'border-color: {{VALUE}};',
                                        ],
                                        'condition' => [
                                            'video_bt_style!' => 'style-2'
                                        ]
                                    ),
                                    array(
                                        'name' => 'play_icon_color',
                                        'label' => esc_html__('Play Icon Color', 'apexus'),
                                        'type' => Controls_Manager::COLOR,
                                        'selectors' => [
                                            '{{WRAPPER}} .pxl-video-player .pxl-video-btn > .pxl-icon' => 'color: {{VALUE}};',
                                            '{{WRAPPER}} .pxl-video-player .pxl-video-btn > svg path' => 'fill: {{VALUE}};',
                                        ],
                                    ),
                                    
                                ],
                            ],
                            [
                                'name' => 'hover',
                                'label' => esc_html__('Hover', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::TAB,
                                'controls' => [
                                    array(
                                        'name' => 'video_play_bg_hover',
                                        'label' => esc_html__('Button Background Hover', 'apexus'),
                                        'type' => Controls_Manager::COLOR,
                                        'condition' => [
                                            'video_bt_style!' => 'style-1'
                                        ],
                                        'selectors' => [
                                            '{{WRAPPER}} .pxl-video-player .pxl-video-btn:hover' => 'background-color: {{VALUE}};',
                                        ],
                                    ), 
                                    array(
                                        'name' => 'bg_hover_style1',
                                        'label' => esc_html__('Button Background Hover', 'apexus'),
                                        'type' => Controls_Manager::COLOR,
                                        'condition' => [
                                            'video_bt_style' => 'style-1'
                                        ],
                                        'selectors' => [
                                            '{{WRAPPER}} .pxl-video-player.btn-style-style-1 .pxl-video-btn' => 'background-color: {{VALUE}};',
                                        ],
                                    ), 
                                    array(
                                        'name' => 'video_play_border_color_hover',
                                        'label' => esc_html__('Button Border Color Hover', 'apexus'),
                                        'type' => Controls_Manager::COLOR,
                                        'selectors' => [
                                            '{{WRAPPER}} .pxl-video-player.layout-1 .pxl-video-btn:hover' => 'border-color: {{VALUE}};',
                                        ],
                                        'condition' => [
                                            'video_bt_style!' => 'style-2'
                                        ]
                                    ),
                                    array(
                                        'name' => 'play_icon_color_hover',
                                        'label' => esc_html__('Play Icon Color Hover', 'apexus'),
                                        'type' => Controls_Manager::COLOR,
                                        'selectors' => [
                                            '{{WRAPPER}} .pxl-video-player .pxl-video-btn:hover > .pxl-icon' => 'color: {{VALUE}};',
                                            '{{WRAPPER}} .pxl-video-player .pxl-video-btn:hover > svg path' => 'fill: {{VALUE}};',
                                        ],
                                    ), 
                                    array(
                                        'name' => 'video_btn_hover_animation',
                                        'label' => esc_html__( 'Button Video Hover Animation', 'apexus' ),
                                        'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
                                        'condition' => [
                                            'video_bt_style!' => 'style-1'
                                        ]
                                    ),     
                                ]
                            ]
                        ],
                    ),
                ]
            ],
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register( new Pxl_video());
