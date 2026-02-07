<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
class Pxl_Accordion extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_accordion',
            'title'    => esc_html__('Pxl Accordion', 'apexus'),
            'icon'     => 'eicon-accordion',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus', 'accordion'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        $templates = apexus_get_templates_option('accordion', []) ;
        return[
            [
                'name'     => 'source_section',
                'label'    => esc_html__( 'Source Settings', 'apexus' ),
                'tab'      => 'content',
                'controls' => array(
                    array(
                        'name' => 'style',
                        'label' => esc_html__('Style', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            'style1' => esc_html__( 'Style 1', 'apexus' ),
                            'style2' => esc_html__( 'Style 2', 'apexus' ),
                            'style3' => esc_html__( 'Style 3', 'apexus' ),
                        ],
                        'default' => 'style1',
                    ),
                    array(
                        'name' => 'active_section',
                        'label' => esc_html__('Active section', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'separator' => 'after',
                        'default' => '1',
                    ),
                    array(
                        'name' => 'ac_items',
                        'label' => esc_html__('Accordion Items', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'controls' => array(
                            array(
                                'name' => 'ac_title',
                                'label' => esc_html__('Title', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                            ),
                             array(
                                'name' => 'ac_content_type',
                                'label' => esc_html__( 'Content Type', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => 'text_editor',
                                'options' => [
                                    'text_editor' => esc_html__( 'Content Default', 'apexus' ),
                                    'template' => esc_html__( 'Template', 'apexus' ),
                                ],
                            ),
                            array(
                                'name' => 'ac_content',
                                'label' => esc_html__('Content', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'rows' => 10,
                                'condition' => [
                                    'ac_content_type' => 'text_editor'
                                ],
                            ),
                            array(
                                'name' => 'ac_content_template',
                                'label' => esc_html__('Select Templates', 'apexus'),
                                'description'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','apexus'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => '',
                                'options' => $templates,
                                'condition' => [
                                    'ac_content_type' => 'template'
                                ],
                            ),
                        ),
                        'default' => [
                            [
                                'ac_title'   => esc_html__( 'FAQ Title #1', 'apexus' ),
                                'ac_content' => esc_html__( 'Lorem ipsum dolor sit amet consecte tur adipiscing elit sed do eiu smod tempor incididunt ut labore.', 'apexus' ),
                            ],
                            [
                                'ac_title'   => esc_html__( 'FAQ Title #2', 'apexus' ),
                                'ac_content' => esc_html__( 'Lorem ipsum dolor sit amet consecte tur adipiscing elit sed do eiu smod tempor incididunt ut labore.', 'apexus' ),
                            ],
                        ],
                        'title_field' => '{{{ ac_title }}}',
                        'separator' => 'after',
                    ),
                    
                )
            ],
            [
                'name'     => 'style_section',
                'label'    => esc_html__( 'Style', 'apexus' ),
                'tab'      => 'style',
                'controls' => array_merge(
                    array(
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .ac-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_active_color',
                            'label' => esc_html__('Title Active Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .ac-item.active .ac-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'apexus' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-accordion .ac-title',
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion.style3 .ac-title .pxl-icon::before,{{WRAPPER}} .pxl-accordion.style3 .ac-title .pxl-icon::after' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-accordion .ac-title .pxl-icon::before' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_color_active',
                            'label' => esc_html__('Icon Color Active', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion.style3 .ac-item.active .ac-title .pxl-icon::before, {{WRAPPER}} .pxl-accordion.style3 .ac-item.active .ac-title .pxl-icon::after' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-accordion .ac-item.active .ac-title .pxl-icon::before' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'desc_color',
                            'label' => esc_html__('Description Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .ac-content' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'desc_typography',
                            'label' => esc_html__('Description Typography', 'apexus' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-accordion .ac-content',
                        ),
                        array(
                            'name'  => 'space_item',
                            'label' => esc_html__( 'Space Item', 'apexus' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .ac-item.active' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'style' => 'style1'
                            ]
                        ),
                        array(
                            'name' => 'acc_padding',
                            'label' => esc_html__('Padding', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .ac-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ),
                        array(
                            'name'  => 'max_width_content',
                            'label' => esc_html__( 'Max Width Content', 'apexus' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .ac-title .text,{{WRAPPER}} .pxl-accordion .ac-content' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'bg_gradient',
                            'label' => esc_html__( 'Background Gradient', 'apexus' ),
                            'type' => Controls_Manager::SELECT,
                            'options'      => [
                                ''             => esc_html__( 'None', 'apexus' ),
                                'acc-linear'        => esc_html__( 'Linear', 'apexus' ),
                            ],
                            'default'      => '',
                            'condition' =>[
                                'style' => 'style1',
                            ]
                        ),
                        array(
                            'name' => 'gradient_1',
                            'label' => esc_html__('Linear 1', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .ac-item.active' => '--liner1: {{VALUE}};',
                            ],
                            'condition' =>[
                                'bg_gradient' => 'acc-linear',
                            ]
                        ),
                        array(
                            'name' => 'gradient_2',
                            'label' => esc_html__('Linear 2', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .ac-item.active' => '--liner2: {{VALUE}};',
                            ],
                            'condition' =>[
                                'bg_gradient' => 'acc-linear',
                            ]
                        ),
                        array(
                            'name' => 'gradient_3',
                            'label' => esc_html__('Linear 3', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .ac-item.active' => '--liner3: {{VALUE}};',
                            ],
                            'condition' =>[
                                'bg_gradient' => 'acc-linear',
                            ]
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__('Border Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-accordion .ac-item' => 'border-color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ],
        ];
    }
}

\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Accordion());