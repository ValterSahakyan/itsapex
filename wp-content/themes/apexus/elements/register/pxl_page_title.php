<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class Pxl_Page_Title extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_page_title',
            'title'    => esc_html__('PXL Page Title', 'apexus'),
            'icon'     => 'eicon-t-letter',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus', 'page title'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }

    public function get_params(){
        return [
            [
                'name'     => 'content_section',
                'label'    => esc_html__( 'Style', 'apexus' ),
                'tab'      => 'style',
                'controls' => [
                    [
                        'name' => 'content_align',
                        'label' => esc_html__('Content Alignment', 'apexus' ),
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
                            '{{WRAPPER}} .pxl-pt-wrap' => 'justify-content: {{VALUE}};',
                        ],
                    ],
                    [
                        'name' => 'text_align',
                        'label' => esc_html__('Text Alignment', 'apexus' ),
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
                            '{{WRAPPER}} .pxl-pt-wrap' => 'text-align: {{VALUE}};',
                        ],
                    ],
                    array(
                        'name' => 'title_color',
                        'label' => esc_html__( 'Title Color', 'apexus' ),
                        'type' => \Elementor\Group_Control_Background::get_type(),
                        'types' => [ 'classic', 'gradient' ],
                        'control_type' => 'group',
                        'exclude' => [ 'image' ],
                        'selector' => '{{WRAPPER}} .pxl-pt-wrap .main-title',
                        'fields_options' => [
                            'background' => [
                                'default' => 'classic',
                            ],
                        ],
                    ),
                    [
                        'name' => 'pt_typography',
                        'label' => esc_html__('Typography', 'apexus' ),
                        'type' => Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-pt-wrap .main-title',
                    ],
                    [
                        'name'  => 'maxwidth_title',
                        'label' => esc_html__( 'Max Width Title', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px','%' ],
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 1000,
                            ],
                        ],
                        'default' => [
                            'size' => '',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pt-wrap .main-title' => 'max-width: {{SIZE}}{{UNIT}}; ',
                        ]
                    ],
                    [
                        'name'  => 'padding_bottom',
                        'label' => esc_html__( 'Padding Bottom', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px'],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'size' => '',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pt-wrap .main-title' => 'padding-bottom: {{SIZE}}{{UNIT}}; ',
                        ],
                        'separator' => 'after'
                    ],
                    [
                        'name' => 'subtitle_color',
                        'label' => esc_html__('Sub Title Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pt-wrap .sub-title' => 'color: {{VALUE}};',
                        ],
                    ],
                    [
                        'name' => 'subpt_typography',
                        'label' => esc_html__('SubTitle Typography', 'apexus' ),
                        'type' => Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-pt-wrap .sub-title',
                    ],
                    [
                        'name'  => 'maxwidth_subtitle',
                        'label' => esc_html__( 'Max Width SubTitle', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px','%' ],
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 1000,
                            ],
                        ],
                        'default' => [
                            'size' => '',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pt-wrap .sub-title' => 'max-width: {{SIZE}}{{UNIT}};',
                        ]
                    ],
                ]
            ] 
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Page_Title());