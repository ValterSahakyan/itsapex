<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
class Pxl_Contact_Form extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_contact_form',
            'title'    => esc_html__('Pxl Contact Form 7', 'apexus'),
            'icon'     => 'eicon-form-horizontal',
            'scripts'  => ['jquery-ui-datepicker', 'pxl-timepicker'],
            'styles'   => ['pxl-timepicker'],
            'keywords' => ['apexus','contact-form'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        if(class_exists('WPCF7')) {
            $cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');
            $contact_forms = array();
            if ($cf7) {
                foreach ($cf7 as $cform) {
                    $contact_forms[$cform->ID] = $cform->post_title;
                }
            } else {
                $contact_forms[esc_html__('No contact forms found', 'apexus')] = 0;
            }
            return [
                [
                    'name'     => 'source_section',
                    'label'    => esc_html__('Source Settings', 'apexus'),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'form_id',
                            'label' => esc_html__('Select Form', 'apexus'),
                            'type' => 'select',
                            'options' => $contact_forms,
                        ),
                        array(
                            'name'  => 'width',
                            'label' => esc_html__( 'Width', 'apexus' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px','%' ],
                            'range' => [
                                'px' => [
                                    'min' => 100,
                                    'max' => 1920,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-cf7-wrap' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'text_typography',
                            'label' => esc_html__('Input Text Typography', 'apexus' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .wpcf7-form input, {{WRAPPER}} .wpcf7-form select, {{WRAPPER}} .wpcf7-form textarea,
                            {{WRAPPER}} .wpcf7-form input::placeholder, {{WRAPPER}} .wpcf7-form select::placeholder, {{WRAPPER}} .wpcf7-form textarea::placeholder',
                        ),
                        array(
                            'name' => 'text_input_color',
                            'label' => esc_html__('Input Color', 'apexus'),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form input, {{WRAPPER}} .wpcf7-form select, {{WRAPPER}} .wpcf7-form textarea, {{WRAPPER}} .wpcf7-form .nice-select .option,{{WRAPPER}} .wpcf7-form .nice-select .current,{{WRAPPER}} .wpcf7-form .nice-select:after ' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'text_input_hover_color',
                            'label' => esc_html__('Input Hover Color', 'apexus'),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form input:hover, {{WRAPPER}} .wpcf7-form select:hover, {{WRAPPER}} .wpcf7-form textarea:hover, {{WRAPPER}} .wpcf7-form .nice-select:hover .option,{{WRAPPER}} .wpcf7-form .nice-select:hover .current, {{WRAPPER}} .wpcf7-form .nice-select:hover:after' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'placeholder_color',
                            'label' => esc_html__('Placeholder Color', 'apexus'),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form input::placeholder, {{WRAPPER}} .wpcf7-form select::placeholder, {{WRAPPER}} .wpcf7-form textarea::placeholder, {{WRAPPER}} .wpcf7-form .nice-select .selected' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'placeholder_color_hover',
                            'label' => esc_html__('Placeholder Hover Color', 'apexus'),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form input:hover::placeholder, {{WRAPPER}} .wpcf7-form select:hover::placeholder, {{WRAPPER}} .wpcf7-form textarea:hover::placeholder, {{WRAPPER}} .wpcf7-form .nice-select:hover .selected' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'form_background',
                            'label' => esc_html__('Background Input Color', 'apexus'),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form input, {{WRAPPER}} .wpcf7-form select, {{WRAPPER}} .wpcf7-form textarea,{{WRAPPER}} .wpcf7-form .nice-select' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'border_input',
                            'label' => esc_html__('Border Input Color', 'apexus'),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form input, {{WRAPPER}} .wpcf7-form select, {{WRAPPER}} .wpcf7-form textarea,{{WRAPPER}} .wpcf7-form .nice-select,{{WRAPPER}} .form-shipment .col-12.col-lg-5.col-md-5 p' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'form_background_hover',
                            'label' => esc_html__('Background Input Hover Color', 'apexus'),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form input:hover, {{WRAPPER}} .wpcf7-form:hover select, {{WRAPPER}} .wpcf7-form:hover textarea,{{WRAPPER}} .wpcf7-form .nice-select:hover' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'border_input_hover',
                            'label' => esc_html__('Border Input Hover Color', 'apexus'),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form input:hover, {{WRAPPER}} .wpcf7-form select:hover, {{WRAPPER}} .wpcf7-form textarea:hover, {{WRAPPER}} .wpcf7-form .nice-select:hover, {{WRAPPER}} .form-shipment .col-12.col-lg-5.col-md-5 p:hover' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'label_color',
                            'label' => esc_html__('Label Color', 'apexus'),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form p, {{WRAPPER}} .wpcf7-form label' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'label_typography',
                            'label' => esc_html__('Label Typography', 'apexus' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .wpcf7-form p, {{WRAPPER}} .wpcf7-form label',
                        ),
                        array(
                            'name' => 'content_padding',
                            'label' => esc_html__('Input Padding(px)', 'apexus' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form input, {{WRAPPER}} .wpcf7-form select, {{WRAPPER}} .wpcf7-form textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'input_shadow',
                            'label'        => esc_html__( 'Input Shadow', 'apexus' ),
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'exclude' => [
                                'box_shadow_position',
                            ],
                            'selector' => '{{WRAPPER}} .wpcf7-form input,{{WRAPPER}} .wpcf7-form select, {{WRAPPER}} .wpcf7-form textarea,{{WRAPPER}} .wpcf7-form .nice-select'
                        ),
                        array(
                            'name' => 'input_shadow_hover',
                            'label'        => esc_html__( 'Input Shadow Hover', 'apexus' ),
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'exclude' => [
                                'box_shadow_position',
                            ],
                            'selector' => '{{WRAPPER}} .wpcf7-form input:hover,{{WRAPPER}} .wpcf7-form input:active,{{WRAPPER}} .wpcf7-form input:focus,
                            {{WRAPPER}} .wpcf7-form select:hover,{{WRAPPER}} .wpcf7-form select:active,{{WRAPPER}} .wpcf7-form select:focus,
                            {{WRAPPER}} .wpcf7-form textarea:hover,{{WRAPPER}} .wpcf7-form textarea:active,{{WRAPPER}} .wpcf7-form textarea:focus,
                            {{WRAPPER}} .wpcf7-form .nice-select:hover,{{WRAPPER}} .wpcf7-form .nice-select:active,{{WRAPPER}} .wpcf7-form .nice-select:focus,
                            {{WRAPPER}} .wpcf7-form input[type=checkbox]:checked::before'
                        ),
                        array(
                            'name'        => 'textarea_height',
                            'label' => esc_html__('Textarea Height', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
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
                            'size_units' => [ 'px'],
                            'range' => [
                                'px' => [
                                    'min' => 1,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-textarea' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'separator' => 'after'
                        ),  
                        array(
                            'name' => 'icon_effects',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'normal',
                                    'label' => esc_html__('Normal', 'apexus' ),
                                    'type' => Controls_Manager::TAB,
                                    'controls' => [
                                        [
                                            'name'    => 'size_icon',
                                            'label'   => esc_html__( 'Size Icon', 'apexus' ),
                                            'type'    => 'slider',
                                            'control_type' => 'responsive',
                                            'size_units'   => [ 'px'],
                                            'default' => [
                                                'unit' => 'px',
                                            ],
                                            'range' => [
                                                'px' => [
                                                    'min' => 14,
                                                    'max' => 100,
                                                ],
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-cf7-wrap button i' => 'font-size: {{SIZE}}{{UNIT}};'
                                            ],
                                        ],
                                        [
                                            'name'    => 'icon_button_color',
                                            'label'   => esc_html__( 'Icon Button Color', 'apexus' ),
                                            'type'    => Controls_Manager::COLOR,
                                            'default' => '',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-cf7-wrap button i' => 'color: {{VALUE}};',
                                            ],
                                        ],
                                        [
                                            'name'    => 'space_icon',
                                            'label'   => esc_html__( 'Space Icon', 'apexus' ),
                                            'type'    => 'slider',
                                            'control_type' => 'responsive',
                                            'size_units'   => [ 'px'],
                                            'default' => [
                                                'unit' => 'px',
                                            ],
                                            'range' => [
                                                'px' => [
                                                    'min' => 0,
                                                    'max' => 100,
                                                ],
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-cf7-wrap button i,{{WRAPPER}} .pxl-cf7-wrap .form-contact .btn-primary .pxl-icon' => 'margin-left: {{SIZE}}{{UNIT}};'
                                            ],
                                        ],
                                        [
                                            'name' => 'btn_text_typography',
                                            'label' => esc_html__('Button Text Typography', 'apexus' ),
                                            'type' => \Elementor\Group_Control_Typography::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} .pxl-cf7-wrap button',
                                        ],
                                        [
                                            'name'    => 'text_button_color',
                                            'label'   => esc_html__( 'Text Button Color', 'apexus' ),
                                            'type'    => Controls_Manager::COLOR,
                                            'default' => '',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-cf7-wrap button' => 'color: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-cf7-wrap .btn-primary .pxl-icon' => 'background-color: {{VALUE}};',
                                            ],
                                        ],
                                        [
                                            'name' => 'background_color_button',
                                            'label' => esc_html__('Background Color Button', 'apexus' ),
                                            'type' => Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-cf7-wrap .wpcf7-form button' => 'background-color: {{VALUE}};',
                                            ]
                                        ], 
                                        [
                                            'name' => 'border_color_button',
                                            'label' => esc_html__('Border Color Button', 'apexus' ),
                                            'type' => Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-cf7-wrap .wpcf7-form button' => 'border-color: {{VALUE}};',
                                            ]
                                        ],
                                        [
                                            'name' => 'color_button_box_shadow',
                                            'label' => esc_html__('Color Box Shadow', 'apexus' ),
                                            'type' => Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-cf7-wrap .wpcf7-form button' => '--color-boxshadow: {{VALUE}};',
                                            ]
                                        ],   
                                        [
                                            'name'    => 'height_button',
                                            'label'   => esc_html__( 'Height Button', 'apexus' ),
                                            'type'    => 'slider',
                                            'control_type' => 'responsive',
                                            'size_units'   => [ 'px'],
                                            'default' => [
                                                'unit' => 'px',
                                            ],
                                            'range' => [
                                                'px' => [
                                                    'min' => 0,
                                                    'max' => 100,
                                                ],
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-cf7-wrap button' => 'height: {{SIZE}}{{UNIT}};'
                                            ],
                                        ], 
                                        [
                                            'name' => 'button_padding',
                                            'label' => esc_html__('Button Padding', 'apexus' ),
                                            'type' => 'dimensions',
                                            'control_type' => 'responsive',
                                            'size_units' => [ 'px' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-cf7-wrap button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ],
                                        [
                                            'name' => 'button_border_radius',
                                            'label' => esc_html__('Button Border Radius', 'apexus' ),
                                            'type' => 'dimensions',
                                            'control_type' => 'responsive',
                                            'size_units' => [ 'px' ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-cf7-wrap button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                            ],
                                        ],
                                        [
                                            'name'    => 'space_button',
                                            'label'   => esc_html__( 'Space Button', 'apexus' ),
                                            'type'    => 'slider',
                                            'control_type' => 'responsive',
                                            'size_units'   => [ 'px'],
                                            'default' => [
                                                'unit' => 'px',
                                            ],
                                            'range' => [
                                                'px' => [
                                                    'min' => 0,
                                                    'max' => 100,
                                                ],
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-cf7-wrap button' => 'margin-top: {{SIZE}}{{UNIT}};'
                                            ],
                                        ], 
                                    ],
                                ],
                                [
                                    'name' => 'hover',
                                    'label' => esc_html__('Hover', 'apexus' ),
                                    'type' => Controls_Manager::TAB,
                                    'controls' => [
                                        [
                                            'name'        => 'icon_color_hover',
                                            'label' => esc_html__( 'Icon Color Hover', 'apexus' ),
                                            'type' => Controls_Manager::COLOR,
                                            'default' => '',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-cf7-wrap button:hover i' => 'color: {{VALUE}};',
                                            ],
                                        ],
                                        [
                                            'name'    => 'text_button_hover_color',
                                            'label'   => esc_html__( 'Button Color Hover Text', 'apexus' ),
                                            'type'    => Controls_Manager::COLOR,
                                            'default' => '',
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-cf7-wrap button:hover' => 'color: {{VALUE}};',
                                                '{{WRAPPER}} .pxl-cf7-wrap .btn-primary .pxl-icon' => 'background-color: {{VALUE}};',
                                            ],
                                        ],
                                        [
                                            'name' => 'background_color_hover_button',
                                            'label' => esc_html__('Background Color Hover Button', 'apexus' ),
                                            'type' => Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-cf7-wrap .wpcf7-form button:hover, {{WRAPPER}} .pxl-cf7-wrap .wpcf7-form .btn-secondary .su-button-effect,
                                                .pxl-cf7-wrap .wpcf7-form .btn-fourth.icon-ps-right::before,{{WRAPPER}} .pxl-cf7-wrap .wpcf7-form .pxl-btn.btn-fourth::before' => 'background-color: {{VALUE}};',
                                            ]
                                        ],   
                                        [
                                            'name' => 'border_color_hover_button',
                                            'label' => esc_html__('Hover Border Color Button', 'apexus' ),
                                            'type' => Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-cf7-wrap .wpcf7-form button:hover' => 'border-color: {{VALUE}};',
                                            ]
                                        ],
                                        [
                                            'name' => 'color_button_box_shadow_hover',
                                            'label' => esc_html__('Hover Color Box Shadow', 'apexus' ),
                                            'type' => Controls_Manager::COLOR,
                                            'selectors' => [
                                                '{{WRAPPER}} .pxl-cf7-wrap .wpcf7-form button:hover' => '--color-boxshadow: {{VALUE}};',
                                            ]
                                        ],     
                                    ]
                                ]
                            ],
                        ),
                        array(
                            'name' => 'checkbox',
                            'label' => esc_html__('Checkbox', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before'
                        ),
                        array(
                            'name' => 'text_checkbox',
                            'label' => esc_html__('Text Checkbox Color', 'apexus'),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-list-item-label' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'text_checkbox_hover',
                            'label' => esc_html__('Text Checkbox Hover Color', 'apexus'),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-list-item input[type=checkbox]:checked + .wpcf7-list-item-label,{{WRAPPER}} .wpcf7-form .wpcf7-list-item:hover .wpcf7-list-item-label' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'checkbox_border_color',
                            'label' => esc_html__('Checkbox Border Color', 'apexus'),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-list-item input[type=checkbox]' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'checkbox_hover_border_color',
                            'label' => esc_html__('Checkbox Hover Border Color', 'apexus'),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-list-item input[type=checkbox]:checked, {{WRAPPER}} .wpcf7-form .wpcf7-list-item:hover input[type=checkbox]' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'checkbox_background_color',
                            'label' => esc_html__('Checkbox Background Color', 'apexus'),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-list-item input[type=checkbox]' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'checkbox_hover_bg_color',
                            'label' => esc_html__('Checkbox Hover Background Color', 'apexus'),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-list-item input[type=checkbox]:checked, {{WRAPPER}} .wpcf7-form .wpcf7-list-item:hover input[type=checkbox]' => 'background-color: {{VALUE}};',
                            ],
                        ),
                    )
                ]
            ];
        }
    }
}
\Elementor\Plugin::instance()->widgets_manager->register( new Pxl_Contact_Form());