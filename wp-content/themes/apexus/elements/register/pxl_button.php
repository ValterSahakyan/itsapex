<?php
use Elementor\Controls_Manager;
class Pxl_button extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_button',
            'title'    => esc_html__('Pxl Button', 'apexus'),
            'icon'     => 'eicon-button',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus', 'button'],
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
                'controls' => array_merge(
                    apexus_button_settings([
                        'btn_text' => esc_html__('Click Here', 'apexus' )
                    ])
                )
            ],
            [
                'name' => 'icon_section',
                'label' => esc_html__('Icon Settings', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => [
                    [
                        'name' => 'btn_icon',
                        'label' => esc_html__('Icon', 'apexus' ),
                        'type' => 'icons',
                        'label_block' => true,
                        'fa4compatibility' => 'icon',
                    ],
                    [
                        'name' => 'icon_align',
                        'label' => esc_html__('Icon Position', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => 'right',
                        'options' => [
                            'right' => esc_html__('After', 'apexus' ),
                            'left' => esc_html__('Before', 'apexus' ),
                        ],
                    ],
                    [
                        'name' => 'icon_space_left',
                        'label' => esc_html__('Icon Space Left', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 300,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn.icon-ps-left .pxl-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'icon_align' => ['left'],
                        ],
                    ],
                    [
                        'name' => 'icon_space_right',
                        'label' => esc_html__('Icon Space Right', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 300,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn.icon-ps-right .pxl-icon, {{WRAPPER}} .pxl-button-wrapper .link-more.icon-ps-right .pxl-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'icon_align' => ['right'],
                        ],
                    ],
                    [
                        'name' => 'icon_font_size',
                        'label' => esc_html__('Icon Font Size', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 300,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                        ],
                    ],
                    [
                        'name'       => 'rotate',
                        'label' => esc_html__( 'Rotate Icon', 'apexus' ),
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
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
                        ],
                    ],
                ],
            ],
            [
                'name' => 'style_section',
                'label' => esc_html__('Style Settings', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'controls' => [
                    [
                        'name' => 'text_align',
                        'label' => esc_html__('Alignment', 'apexus' ),
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
                            '{{WRAPPER}} .pxl-button-wrapper' => 'justify-content: {{VALUE}};'
                        ],
                    ],
                    [
                        'name'  => 'min_width',
                        'label' => esc_html__( 'Width', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 500,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-btn' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => ['style!' => ['btn-fifth','btn-seventh']]
                    ],
                    [
                        'name'  => 'min_height',
                        'label' => esc_html__( 'Height', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-btn' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => ['style!' => ['btn-fifth','btn-seventh']]
                    ],
                    [
                        'name' => 'btn_padding',
                        'label' => esc_html__('Padding', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn, {{WRAPPER}} .pxl-button-wrapper a.link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                        'condition' => ['style!' => ['btn-fifth','btn-seventh']]
                    ],
                    [
                        'name' => 'btn_padding2',
                        'label' => esc_html__('Padding', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn .pxl-button-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                        'condition' => ['style' => ['btn-fifth','btn-seventh']]
                    ],
                    [
                        'name' => 'btn_full',
                        'label' => esc_html__('Full Width', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::CHOOSE,
                        'control_type' => 'responsive',
                        'options' => [
                            'auto' => [
                                'title' => esc_html__( 'Auto', 'apexus' ),
                                'icon' => 'eicon-justify-center-h',
                            ],
                            '100%' => [
                                'title' => esc_html__( 'Full', 'apexus' ),
                                'icon' => 'eicon-justify-space-between-h',
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn,{{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-seventh .pxl-button-text' => 'width: {{VALUE}};',
                        ], 
                        'condition' => ['style!' => ['btn-fifth']]
                    ],
                    [
                        'name' => 'typography',
                        'label' => esc_html__('Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-button-wrapper .pxl-btn,{{WRAPPER}} .pxl-button-wrapper .link-more',
                    ],
                    [
                        'name'  => 'position_left_text',
                        'label' => esc_html__( 'Position Text(X)', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 50,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-btn.btn-second::before' => 'left: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => ['style' => ['btn-second']]
                    ],
                    [
                        'name' => 'btn_color',
                        'label' => esc_html__('Text Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn, {{WRAPPER}} .pxl-button-wrapper .link-more' => 'color: {{VALUE}} !important;',
                            '{{WRAPPER}} .link-more.underline-true:after' => 'background-color: {{VALUE}} !important;',
                        ],
                    ],
                    [
                        'name' => 'btn_color_hover',
                        'label' => esc_html__('Text Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn:hover, {{WRAPPER}} .pxl-button-wrapper .pxl-btn:active, {{WRAPPER}} .pxl-button-wrapper .pxl-btn:focus, {{WRAPPER}} .pxl-button-wrapper .link-more:hover' => 'color: {{VALUE}} !important;',
                            '{{WRAPPER}} .link-more.underline-true:hover:after,{{WRAPPER}} .link-more .pxl-button-text::after' => 'background-color: {{VALUE}};',
                        ],
                    ],
                    [
                        'name' => 'btn_bg_color',
                        'label' => esc_html__('Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => ['style!' => ['link', 'pxl-btn-round','btn-third','btn-fifth','btn-seventh']]
                    ],
                    [
                        'name' => 'btn_bg_color_hover',
                        'label' => esc_html__('Background Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn:hover, {{WRAPPER}} .pxl-button-wrapper .pxl-btn:focus, {{WRAPPER}} .pxl-button-wrapper .pxl-btn:active
                            {{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-eighth .su-button-effect' => 'background-color: {{VALUE}} !important;',
                        ],
                        'condition' => ['style!' => ['link','btn-third','btn-fourth','btn-fifth','btn-sixth','btn-seventh']]
                    ],
                    [
                        'name' => 'btn_bg_color2',
                        'label' => esc_html__('Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-third::before,{{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-fifth .pxl-button-text,
                            {{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-seventh .pxl-button-text::before' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => ['style' => ['btn-third','btn-fifth','btn-seventh']]
                    ],
                    [
                        'name' => 'btn_bg_color_hover2',
                        'label' => esc_html__('Background Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-third:hover::before,{{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-fourth::before,
                            {{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-fifth:hover .pxl-button-text, {{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-sixth::before,
                            {{WRAPPER}} .pxl-btn.btn-seventh .pxl-button-text::after' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => ['style' => ['btn-third','btn-fourth','btn-fifth','btn-sixth','btn-seventh']]
                    ],
                    [
                        'name' => 'btn_border_color2',
                        'label' => esc_html__('Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => ['style' => ['btn-third']]
                    ],
                    [
                        'name' => 'btn_border_color_hover2',
                        'label' => esc_html__('Border Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn:hover, {{WRAPPER}} .pxl-button-wrapper .pxl-btn:focus, {{WRAPPER}} .pxl-button-wrapper .pxl-btn:active' => 'background-color: {{VALUE}} !important;',
                        ],
                        'condition' => ['style' => ['btn-third']]
                    ],
                    [
                        'name' => 'btn_border_color3',
                        'label' => esc_html__('Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-fifth .pxl-button-text' => 'border-color: {{VALUE}};',
                        ],
                        'condition' => ['style' => ['btn-fifth']]
                    ],
                     [
                        'name' => 'btn_border_color3_hover',
                        'label' => esc_html__('Border Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-fifth:hover .pxl-button-text' => 'border-color: {{VALUE}};',
                        ],
                        'condition' => ['style' => ['btn-fifth']]
                    ],
                    [
                        'name'  => 'icon_Width_size',
                        'label' => esc_html__( 'Width Icon', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-btn.btn-second .pxl-icon .icon-left,{{WRAPPER}} .pxl-btn.btn-second .pxl-icon .icon-right
                            ,{{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-primary .pxl-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => ['style' => ['btn-primary','btn-second']]
                    ],
                    [
                        'name' => 'btn_icon_color',
                        'label' => esc_html__('Icon Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-btn .pxl-icon' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-btn .pxl-icon svg' => 'fill: {{VALUE}};',
                        ],
                        'condition' => ['style!' => 'link']
                    ],
                    [
                        'name' => 'btn_icon_hover_color',
                        'label' => esc_html__('Icon Hover Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-btn:hover .pxl-icon' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-btn:hover .pxl-icon svg' => 'fill: {{VALUE}};',
                        ],
                        'condition' => ['style!' => 'link']
                    ],
                    [
                        'name' => 'background_color_icon',
                        'label' => esc_html__('Background Color Icon', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-btn.btn-second .pxl-icon .icon-left,{{WRAPPER}} .pxl-btn.btn-second .pxl-icon .icon-right,
                            {{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-fifth .pxl-icon,{{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-seventh .pxl-icon,
                            {{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-primary .pxl-icon' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => ['style' => ['btn-primary','btn-second','btn-fifth', 'btn-seventh']]
                    ],
                    [
                        'name' => 'padding_icon',
                        'label' => esc_html__('Padding Icon', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'control_type' => 'responsive',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-fifth .pxl-icon.right,{{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-fifth:hover .pxl-icon.left,
                            {{WRAPPER}} .pxl-button-wrapper .pxl-btn.btn-seventh .pxl-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => ['style' => ['btn-fifth','btn-seventh']]
                    ],
                    [
                        'name' => 'box_shadow_color',
                        'label' => esc_html__('Box Shadow Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn,{{WRAPPER}} .pxl-btn.btn-primary:hover' => '--box-shadow-color: {{VALUE}};',
                        ],
                        'condition' => ['style!' => ['link', 'btn-third','btn-fifth','btn-seventh']]
                    ],
                    [
                        'name'      => 'background_button',
                        'label'     => esc_html__('Style Background Image', 'apexus' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'return_value' => 'yes',
                        'condition' => ['style' => ['btn-primary','btn-third']]
                    ],
                    [
                        'name'  => 'backdrop_filter',
                        'label' => esc_html__( 'Backdrop Filter', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                        ],
                        'condition' => ['style' => ['btn-third']]
                    ],
                    [
                        'name' => 'border_type',
                        'label' => esc_html__( 'Border Type', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            '' => esc_html__( 'None', 'apexus' ),
                            'solid' => esc_html__( 'Solid', 'apexus' ),
                            'double' => esc_html__( 'Double', 'apexus' ),
                            'dotted' => esc_html__( 'Dotted', 'apexus' ),
                            'dashed' => esc_html__( 'Dashed', 'apexus' ),
                            'groove' => esc_html__( 'Groove', 'apexus' ),
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn' => 'border-style: {{VALUE}} !important;',
                        ],
                        'condition' => ['style!' => ['link', 'btn-third','btn-fifth','btn-seventh']]
                    ],
                    [
                        'name' => 'border_width',
                        'label' => esc_html__( 'Border Width', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                        ],
                        'control_type' => 'responsive',
                        'condition' => ['style!' => ['link', 'btn-third','btn-fifth','btn-seventh']]
                    ],
                    [
                        'name' => 'border_color',
                        'label' => esc_html__( 'Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn' => 'border-color: {{VALUE}} !important;',
                        ],
                        'condition' => [
                            'style!' => ['link', 'btn-third'],
                            'border_type!' => ''
                        ],
                    ],
                    [
                        'name' => 'border_color_hover',
                        'label' => esc_html__( 'Border Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn:hover, {{WRAPPER}} .pxl-button-wrapper .pxl-btn:active, {{WRAPPER}} .pxl-button-wrapper .pxl-btn:focus' => 'border-color: {{VALUE}} !important;',
                        ],
                        'condition' => [
                            'style!' => ['link', 'btn-third'],
                            'border_type!' => ''
                        ],
                    ],
                    [
                        'name' => 'btn_border_radius',
                        'label' => esc_html__('Border Radius', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => ['style!' => ['link', 'btn-third','btn-fifth','btn-seventh']]
                    ],
                    [
                        'name' => 'btn_border_radius2',
                        'label' => esc_html__('Border Radius', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-button-wrapper .pxl-btn .pxl-button-text,{{WRAPPER}} .pxl-button-wrapper .pxl-btn .pxl-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => ['style' => ['btn-fifth','btn-seventh']]
                    ],
                    [
                        'name'  => 'show_underline',
                        'label' => esc_html__('Show Underline', 'apexus'),
                        'type'  => 'switcher',
                        'condition' => ['style' => 'link'],
                    ],
                    [
                        'name' => 'underline_style',
                        'label' => esc_html__( 'Underline Style', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            '' => esc_html__( 'df', 'apexus' ),
                            'style-1' => esc_html__( 'Style 1', 'apexus' ),
                        ],
                        'default' => '',
                        'condition' => ['style' => 'link', 'show_underline' => 'true']
                    ],
                    [
                        'name' => 'underline_weight',
                        'label' => esc_html__('Underline Weight', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 30,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .link-more.underline-true:after' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => ['style' => 'link', 'show_underline' => 'true']
                    ],
                    [
                        'name' => 'underline_bottom_space',
                        'label' => esc_html__('Underline Bottom Space', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => -50,
                                'max' => 50,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .link-more.underline-true:after' => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => ['style' => 'link', 'show_underline' => 'true']
                    ],
                ],
            ]
        ];
    }
}

\Elementor\Plugin::instance()->widgets_manager->register( new Pxl_button());
