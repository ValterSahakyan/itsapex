<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class Pxl_countdown extends Pxl_Widget_Base{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_countdown',
            'title'    => esc_html__('Pxl Countdown', 'apexus'),
            'icon'     => 'eicon-countdown',
            'scripts'    => array(
                'apexus-countdown',
            ),
            'styles'   => [],
            'keywords' => ['apexus', 'countdown'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        return [
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
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_countdown-1.webp'
                            ],
                        ],
                        'prefix_class' => 'pxl-counter-layout',
                    ) 
                ),
            ),
            array(
                'name' => 'content_section',
                'label' => esc_html__('Time to', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array(
                    array(
                        'name' => 'time_to',
                        'label' => esc_html__('Enter the time', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => '09/19/2026 00:00 AM',
                        'label_block' => true,
                        'description' => 'Time Format: 09/19/2026 00:00 AM'
                    ),
                    array(
                        'name'      => 'hidden_day',
                        'label'     => esc_html__('Hidden Day', 'apexus' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'return_value' => '1',
                        'default' => '1',
                    ),
                    array(
                        'name'      => 'hidden_hours',
                        'label'     => esc_html__('Hidden Hours', 'apexus' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'return_value' => '1',
                        'default' => '1',
                    ),
                    array(
                        'name'      => 'hidden_minutes',
                        'label'     => esc_html__('Hidden Minutes', 'apexus' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'return_value' => '1',
                        'default' => '1',
                    ),
                    array(
                        'name'      => 'hidden_seconds',
                        'label'     => esc_html__('Hidden Seconds', 'apexus' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'return_value' => '1',
                        'default' => '1',
                    ),
                ),
            ),
            array(
                'name' => 'section_style_number',
                'label' => esc_html__('Style', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'controls' => array(
                    array(
                        'name' => 'number_typography',
                        'label' => esc_html__('Number Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-countdown .pxl-countdown-container .inner-number',
                    ),
                    array(
                        'name' => 'number_color',
                        'label' => esc_html__('Number Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::HEADING,
                    ),
                    array(
                        'name' => 'number_cl',
                        'label' => esc_html__( 'Number Color', 'apexus' ),
                        'type' => \Elementor\Group_Control_Background::get_type(),
                        'types' => [ 'classic', 'gradient' ],
                        'control_type' => 'group',
                        'exclude' => [ 'image' ],
                        'selector' => '{{WRAPPER}} .pxl-countdown .pxl-countdown-container .inner-number',
                        'fields_options' => [
                            'background' => [
                                'default' => 'classic',
                            ],
                        ],
                    ),
                    array(
                        'name' => 'text_typography',
                        'label' => esc_html__('Text Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-countdown .pxl-countdown-container .inner-text',
                    ),
                    array(
                        'name' => 'text_color',
                        'label' => esc_html__('Text Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-countdown .pxl-countdown-container .inner-text' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name'  => 'space_text',
                        'label' => esc_html__( 'Space Text', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-countdown .pxl-countdown-container' => 'column-gap: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-countdown .style-dot > *::before' => 'left: calc({{SIZE}}{{UNIT}} / -2);'
                        ],
                    ),
                    array(
                        'name'      => 'style_dot',
                        'label'     => esc_html__('Style Dot', 'apexus' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'return_value' => 'yes',
                    ),
                    array(
                        'name' => 'dot_color',
                        'label' => esc_html__('Dot Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-countdown .style-dot > *::before' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'style_dot' => 'yes'
                        ]
                    ),
                    array(
                        'name'  => 'dot_size',
                        'label' => esc_html__( 'Dot size', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-countdown .style-dot > *::before' => 'font-size: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'style_dot' => 'yes'
                        ]
                    ),
                    array(
                        'name'  => 'dot_position',
                        'label' => esc_html__( 'Dot Position(Y)', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px','%' ],
                        'default' => [
                            'unit' => '%',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-countdown .style-dot > *::before' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'style_dot' => 'yes'
                        ]
                    ),
                    array(
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
                            '{{WRAPPER}} .pxl-countdown .pxl-countdown-container' => 'justify-content: {{VALUE}}; text-align: {{VALUE}};'
                        ],
                    ),

                ),
            ),
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_countdown()); 