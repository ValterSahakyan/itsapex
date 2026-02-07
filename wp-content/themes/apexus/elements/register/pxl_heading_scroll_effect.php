<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class Pxl_Heading_Scroll_Effect extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_heading_scroll_effect',
            'title'    => esc_html__('PXL Heading scroll effect', 'apexus'),
            'icon'     => 'eicon-t-letter',
            'scripts'  => ['apexus-heading-scroll-effect'],
            'styles'   => [],
            'keywords' => ['apexus', 'heading', 'title'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        return [
            array(
                'name' => 'title_section',
                'label' => esc_html__( 'Heading', 'apexus' ),
                'tab' => 'content',
                'controls' => array_merge(
                    array(
                        array(
                            'name' => 'heading_text',
                            'label' => esc_html__( 'Heading', 'apexus' ),
                            'type' => 'textarea',
                            'default' => 'This is heading',
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'heading_tag',
                            'label' => esc_html__( 'Heading HTML Tag', 'apexus' ),
                            'type' => 'select',
                            'options' => [
                                'h1' => 'H1',
                                'h2' => 'H2',
                                'h3' => 'H3',
                                'h4' => 'H4',
                                'h5' => 'H5',
                                'h6' => 'H6',
                                'div' => 'div',
                                'span' => 'span',
                                'p' => 'p',
                            ],
                            'default' => 'h2',
                        ),
                        array(
                            'name'      => 'icon_arrow',
                            'label'     => esc_html__('icon Arrow', 'apexus' ),
                            'type'      => Controls_Manager::SWITCHER,
                            'return_value' => 'yes'
                        ),
                        array(
                            'name'  => 'space_icon',
                            'label' => esc_html__( 'Space Icon', 'apexus' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-scroll-effect .heading-text.icon-arrow div:first-child::before' => 'margin-right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_arrow' => 'yes'
                            ]
                        ),
                        array(
                            'name'  => 'icon_position',
                            'label' => esc_html__( 'Icon Position', 'apexus' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => -50,
                                    'max' => 50,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-scroll-effect .heading-text.icon-arrow div:first-child::before' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_arrow' => 'yes'
                            ]
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__( 'Icon Color', 'apexus' ),
                            'type' => 'color',                            
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-scroll-effect .heading-text.icon-arrow div:first-child::before' => 'border-left-color: {{VALUE}};'
                            ],
                            'condition' => [
                                'icon_arrow' => 'yes'
                            ]
                        ),
                    )
                )
            ),
            array(
                'name' => 'heading_style_tab',
                'label' => esc_html__( 'Heading', 'apexus' ),
                'tab' => 'style',
                'controls' => array(
                    array(
                        'name'  => 'max_width',
                        'label' => esc_html__( 'Max Width', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 1000,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-heading-scroll-effect .heading-text' => 'max-width: {{SIZE}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name' => 'heading_typo',
                        'type' => 'typography', 
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-heading-scroll-effect .heading-text'
                    ),
                    array(
                        'name' => 'heading_color',
                        'label' => esc_html__( 'Color', 'apexus' ),
                        'type' => 'color',                            
                        'selectors' => [
                            '{{WRAPPER}} .pxl-heading-scroll-effect .heading-text' => '--heading-color-1: {{VALUE}};'
                        ]
                    ),
                    array(
                        'name' => 'heading_hover_color',
                        'label' => esc_html__( 'Color Hover', 'apexus' ),                        
                        'type' => 'color',                            
                        'selectors' => [
                            '{{WRAPPER}} .pxl-heading-scroll-effect .heading-text' => '--heading-color: {{VALUE}};'
                        ]
                    ),
                    array(
                        'name'  => 'space_row',
                        'label' => esc_html__( 'Space Row(px)', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => -50,
                                'max' => 50,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-heading-scroll-effect .heading-text div' => 'margin-top: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-heading-scroll-effect .heading-text div:first-child' => 'margin-top: 0;',
                        ],
                    ),
                    array(
                        'name' => 'content_align',
                        'label' => esc_html__('Alignment', 'apexus' ),
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
                            '{{WRAPPER}} .pxl-heading-scroll-effect' => 'justify-content: {{VALUE}}; text-align: {{VALUE}};',
                        ],
                    ),
                )
            ),
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Heading_Scroll_Effect()); 