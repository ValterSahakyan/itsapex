<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class Pxl_Divider extends Pxl_Widget_Base{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_divider',
            'title'    => esc_html__('Pxl Divider', 'apexus'),
            'icon'     => 'eicon-divider',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus', 'divider'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        return [
            [
                'name' => 'source_section',
                'label' => esc_html__('Source Settings', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array(
                    array(
                        'name' => 'width',
                        'label' => esc_html__( 'Width', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'max' => 1000,
                            ],
                        ],
                        'default' => [
                            'size' => 100,
                            'unit' => '%',
                        ],
                        'tablet_default' => [
                            'unit' => '%',
                        ],
                        'mobile_default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-divider' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name' => 'weight',
                        'label' => esc_html__( 'Weight', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'vw', 'custom' ],
                        'control_type' => 'responsive',
                        'default' => [
                            'size' => 1,
                        ],
                        'range' => [
                            'px' => [
                                'min' => 1,
                                'max' => 10,
                                'step' => 0.1,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-divider' => 'height: {{SIZE}}{{UNIT}}',
                            '{{WRAPPER}} .pxl-divider:before' => 'height: {{SIZE}}{{UNIT}}',
                        ],
                    ),
                    array(
                        'name' => 'border_radius',
                        'label' => esc_html__('Border Radius', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-divider:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                    ),
                    array(
                        'name' => 'divider_align',
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
                            '{{WRAPPER}} .pxl-widget-divider' => 'display: flex; justify-content: {{VALUE}};',
                        ],
                    ),
                ),
            ],
            [
                'name' => 'style_section',
                'label' => esc_html__('Style Settings', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'controls' => array(
                    array(
                        'name' => 'bg_gradient',
                        'label' => esc_html__( 'Style Background', 'apexus' ),
                        'type' => Controls_Manager::SELECT,
                        'options'      => [
                            ''             => esc_html__( 'Default', 'apexus' ),
                            'btn-linear'        => esc_html__( 'Linear', 'apexus' ),
                        ],
                        'default'      => '',
                    ),
                    array(
                        'name' => 'item_bar_bg',
                        'label' => esc_html__( 'Background Color', 'apexus' ),
                        'type' => \Elementor\Group_Control_Background::get_type(),
                        'types' => [ 'classic', 'gradient' ],
                        'control_type' => 'group',
                        'exclude' => [ 'image' ],
                        'selector' => '{{WRAPPER}} .pxl-widget-divider .pxl-divider:before',
                        'fields_options' => [
                            'background' => [
                                'default' => 'classic',
                            ],
                        ],
                        'condition' => [
                            'bg_gradient!' => 'btn-linear'
                        ]
                    ),
                    array(
                        'name' => 'gradient_1',
                        'label' => esc_html__('Linear 1', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-widget-divider .pxl-divider:before' => '--linear-1: {{VALUE}};',
                        ],
                        'condition' =>[
                            'bg_gradient' => 'btn-linear',
                        ]
                    ),
                    array(
                        'name' => 'gradient_2',
                        'label' => esc_html__('Linear 2', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-widget-divider .pxl-divider:before' => '--linear-2: {{VALUE}};',
                        ],
                        'condition' =>[
                            'bg_gradient' => 'btn-linear',
                        ]
                    ),
                    array(
                        'name' => 'gradient_3',
                        'label' => esc_html__('Linear 3', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-widget-divider .pxl-divider:before' => '--linear-3: {{VALUE}};',
                        ],
                        'condition' =>[
                            'bg_gradient' => 'btn-linear',
                        ]
                    ),
                ),
            ],
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Divider()); 