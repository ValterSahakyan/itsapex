<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
class Pxl_mailchimp extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_mailchimp',
            'title'    => esc_html__('Pxl Mailchimp', 'apexus'),
            'icon'     => 'eicon-email-field',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        return [
            [
                'name' => 'section_content',
                'label' => esc_html__('Content', 'apexus'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => [
                    [
                        'name' => 'form_id',
                        'label' => esc_html__('Form ID', 'apexus' ),
                        'type' => 'text',
                    ],
                    array(
                        'name' => 'style',
                        'label' => esc_html__('Style', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            'style-1' => esc_html__( 'Style 1', 'apexus' ),
                            'style-2' => esc_html__( 'Style 2', 'apexus' ),
                            'style-3' => esc_html__( 'Style 3', 'apexus' ),
                        ],
                        'default' => 'style-1',
                    ),
                ],
            ],
            [
                'name' => 'section_content_input',
                'label' => esc_html__('Input', 'apexus'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => [
                    [
                        'name' => 'text_align_input',
                        'label' => esc_html__('Alignment Input', 'apexus' ),
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
                        'prefix_class' => 'elementor-align-',
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields input' => 'text-align: {{VALUE}};'
                        ],
                    ],
                    [
                        'name' => 'text_input_typography',
                        'label' => esc_html__('Text Input Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields input, {{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields input::placeholder',
                    ],
                    [
                        'name' => 'input_placeholder_color',
                        'label' => esc_html__('Input Placeholder Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields input::placeholder' => 'color: {{VALUE}};',
                        ],
                    ],
                    [
                        'name' => 'input_text_color',
                        'label' => esc_html__('Input Text Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields input' => 'color: {{VALUE}};',
                        ],
                    ],
                    [
                        'name' => 'input_background_color',
                        'label' => esc_html__('Input Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields input' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'style!' => 'style-3'
                        ]
                    ],
                    array(
                        'name' => 'bg_gradient',
                        'label' => esc_html__( 'Style Background Input', 'apexus' ),
                        'type' => Controls_Manager::SELECT,
                        'options'      => [
                            ''             => esc_html__( 'Default', 'apexus' ),
                            'btn-linear'        => esc_html__( 'Linear', 'apexus' ),
                        ],
                        'default'      => '',
                        'condition' => [
                            'style' => 'style-3'
                        ]
                    ),
                    [
                        'name' => 'input_background_color2',
                        'label' => esc_html__('Input Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields input' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'bg_gradient!' => 'btn-linear',
                            'style' => 'style-3'
                        ]
                    ],
                    array(
                        'name' => 'gradient_1',
                        'label' => esc_html__('Linear 1', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields input' => '--linear-1: {{VALUE}};',
                        ],
                        'condition' =>[
                            'bg_gradient' => 'btn-linear',
                            'style' => 'style-3'
                        ]
                    ),
                    array(
                        'name' => 'gradient_2',
                        'label' => esc_html__('Linear 2', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields input' => '--linear-2: {{VALUE}};',
                        ],
                        'condition' =>[
                            'bg_gradient' => 'btn-linear',
                            'style' => 'style-3'
                        ]
                    ),
                    array(
                        'name' => 'gradient_3',
                        'label' => esc_html__('Linear 3', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields input' => '--linear-3: {{VALUE}};',
                        ],
                        'condition' =>[
                            'bg_gradient' => 'btn-linear',
                            'style' => 'style-3'
                        ]
                    ),
                    array(
                        'name' => 'box_shadow_btn',                    
                        'type' => 'box-shadow',     
                        'control_type' => 'group',                      
                        'selector' => '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields input',
                        'condition' =>[
                            'style' => 'style-3'
                        ]
                    ),
                    [
                        'name' => 'input_padding',
                        'label' => esc_html__('Input Padding', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                    ],
                    [
                        'name' => 'input_border_radius',
                        'label' => esc_html__('Input Border Radius', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                    ],
                    [
                        'name' => 'height_input',
                        'label' => esc_html__('Height Input', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields input' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ],
                ],
            ],
            [
                'name' => 'section_button',
                'label' => esc_html__('Button', 'apexus'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => [
                    [
                        'name' => 'text_align_button',
                        'label' => esc_html__('Alignment Button', 'apexus' ),
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
                        'prefix_class' => 'elementor-align-',
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields' => 'text-align: {{VALUE}};'
                        ],
                    ],
                    [
                        'name' => 'height_button',
                        'label' => esc_html__('Height Button', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields button' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ],
                    [
                        'name' => 'btn_padding',
                        'label' => esc_html__('Button Padding', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                    ],
                    [
                        'name' => 'btn_margin',
                        'label' => esc_html__('Button Margin', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                        'condition' =>[
                            'style!' => 'style-3'
                        ]
                    ],
                    [
                        'name' => 'btn_border_radius',
                        'label' => esc_html__('Button Border Radius', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                        'condition' =>[
                            'style!' => 'style-3'
                        ]
                    ],
                    [
                        'name' => 'button_text_color',
                        'label' => esc_html__('Button Text Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields button' => 'color: {{VALUE}};',
                        ],
                    ],
                    [
                        'name' => 'button_text_hover_color',
                        'label' => esc_html__('Button Hover Text Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields button:hover' => 'color: {{VALUE}};',
                        ],
                    ],
                    [
                        'name' => 'text_typography',
                        'label' => esc_html__('Text Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields button',
                    ],
                    [
                        'name' => 'icon_color',
                        'label' => esc_html__('Icon Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mail-form1 .btn-button svg' => 'fill: {{VALUE}};',
                            '{{WRAPPER}} .pxl-mailchimp .mail-form1 .btn-button i' => 'color: {{VALUE}};'
                        ],
                    ],
                    [
                        'name' => 'button_bg_color',
                        'label' => esc_html__('Button Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields button' => 'background-color: {{VALUE}};',
                        ],
                        'condition' =>[
                            'style!' => 'style-3'
                        ]
                    ],
                    [
                        'name' => 'button_bg_color_hover',
                        'label' => esc_html__('Button Background Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .mc4wp-form-fields button:hover' => 'background-color: {{VALUE}};',
                        ],
                        'condition' =>[
                            'style!' => 'style-3'
                        ]
                    ],
                    [
                        'name' => 'btn_bg_color2',
                        'label' => esc_html__('Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .btn-button::before' => 'background-color: {{VALUE}};',
                        ],
                        'condition' =>[
                            'style' => 'style-3'
                        ]
                    ],
                    [
                        'name' => 'btn_border_color2',
                        'label' => esc_html__('Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-mailchimp .btn-button' => 'background-color: {{VALUE}};',
                        ],
                        'condition' =>[
                            'style' => 'style-3'
                        ]
                    ],
                ],
            ]
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register( new Pxl_mailchimp());