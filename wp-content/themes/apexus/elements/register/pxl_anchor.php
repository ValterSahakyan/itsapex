<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
class Pxl_Anchor extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_anchor',
            'title'    => esc_html__('Pxl Anchor', 'apexus'),
            'icon'     => 'eicon-anchor',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus', 'icon', 'anchor', 'toggle', 'hidden', 'popup', 'menu'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }

    public function get_params(){
        $templates_df = ['0' => esc_html__('None', 'apexus')];
        $templates = $templates_df + apexus_get_templates_option('hidden-panel') ;
        return [
            [
                'name'     => 'icon_section',
                'label'    => esc_html__( 'Settings', 'apexus' ),
                'tab'      => 'content',
                'controls' => [
                    [
                        'name' => 'template',
                        'label' => esc_html__('Select Templates', 'apexus'),
                        'type' => Controls_Manager::SELECT,
                        'options' => $templates,
                        'default' => 'df',
                        'description'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','apexus'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'), 
                    ],
                    [
                        'name' => 'link',
                        'label' => esc_html__('Link', 'apexus' ),
                        'type' => Controls_Manager::URL,
                        'placeholder' => esc_html__('https://your-link.com', 'apexus' ),
                        'default' => [
                            'url' => '#',
                        ],
                        'condition' => ['template' => '0']
                    ],
                    [
                        'name' => 'icon_type',
                        'label' => esc_html__('Select Icon Type', 'apexus'),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            '' => esc_html__('None', 'apexus'),
                            'lib' => esc_html__('Library', 'apexus'),
                            'menu-mobile-toggle-nav' => esc_html__('Mobile Menu Toggle', 'apexus'),
                        ],
                        'default' => 'lib' 
                    ],
                    [
                        'name' => 'style_layout',
                        'label' => esc_html__('Style Layout', 'apexus'),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            'none' => esc_html__('None', 'apexus'),
                        ],
                        'default' => 'none' 
                    ],
                    [
                        'name'             => 'selected_icon',
                        'label'            => esc_html__( 'Icon', 'apexus' ),
                        'type'             => Controls_Manager::ICONS,
                        'default'          => [
                            'library' => 'pxli',
                            'value'   => 'pxli-menu'
                        ],
                        'condition' => ['icon_type' => 'lib']
                    ],
                    [
                        'name' => 'icon_width',
                        'label' => esc_html__('Icon Width (px)', 'apexus' ),
                        'type' => Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 150,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-anchor-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => ['icon_type!' => ['menu-mobile-toggle-nav', 'menu-style-1']],
                    ],
                    [
                        'name'  => 'icon_size',
                        'label' => esc_html__( 'Icon Font Size(px)', 'apexus' ),
                        'type'  => Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 15,
                                'max' => 300,
                            ],
                        ],
                        'condition' => ['icon_type' => 'lib'],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-anchor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-anchor-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        ],
                    ],
                    [
                        'name' => 'icon_border',
                        'type' => Group_Control_Border::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-anchor-icon',
                    ],
                    [
                        'name'         => 'icon_border_radius',
                        'label'        => esc_html__( 'Border Radius', 'apexus' ),
                        'type'         => Controls_Manager::DIMENSIONS,
                        'control_type' => 'responsive',
                        'size_units'   => [ 'px', '%' ],
                        'selectors'    => [
                            '{{WRAPPER}} .pxl-anchor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ],
                    [
                        'name' => 'icon_margin',
                        'label' => esc_html__('Icon Margin(px)', 'apexus' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-anchor-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => ['icon_type!' => ['none', 'menu-style-1']],
                    ],
                    [
                        'name' => 'icon_padding',
                        'label' => esc_html__('Icon Padding(px)', 'apexus' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-anchor-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => ['icon_type' => 'menu-style-1'],
                    ],
                    [
                        'name' => 'icon_color',
                        'label' => esc_html__('Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'control_type' => 'responsive',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-anchor' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-anchor svg, {{WRAPPER}} .pxl-anchor svg path' => 'fill: {{VALUE}};',
                            '{{WRAPPER}} .pxl-anchor-wrap .icon-custom span span' => 'background-color: {{VALUE}};'
                        ],
                    ], 
                    [
                        'name' => 'icon_color_hover',
                        'label' => esc_html__('Hover Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'control_type' => 'responsive',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-anchor:hover' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-anchor:hover svg, {{WRAPPER}} .pxl-anchor:hover svg path' => 'fill: {{VALUE}};',
                            '{{WRAPPER}} .pxl-anchor-wrap .icon-custom:hover span span' => 'background-color: {{VALUE}};'
                        ],
                    ],
                    [
                        'name' => 'icon_border_color_hover',
                        'label' => esc_html__('Border Color Hover', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'control_type' => 'responsive',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-anchor-wrap .pxl-anchor:hover .pxl-anchor-icon' => 'border-color: {{VALUE}};'
                        ],
                    ], 
                    [
                        'name' => 'icon_bg',
                        'label' => esc_html__('Background Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-anchor-wrap .pxl-anchor-icon, {{WRAPPER}} .pxl-anchor-wrap .menu-toggle-bg-nav' => 'background-color: {{VALUE}};'
                        ],
                    ],
                    [
                        'name' => 'icon_bg_hover',
                        'label' => esc_html__('Background Color Hover', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-anchor-wrap .pxl-anchor:hover .pxl-anchor-icon, {{WRAPPER}} .pxl-anchor-wrap .menu-toggle-bg-nav:hover' => 'background-color: {{VALUE}};'
                        ],
                    ], 
                    [
                        'name'  => 'backdrop_filter',
                        'label' => esc_html__( 'Blur', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-anchor-wrap .pxl-anchor-icon, {{WRAPPER}} .pxl-anchor-wrap .menu-toggle-bg-nav' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                        ],
                        'condition' => ['icon_type' => 'lib'],
                    ],
                    [
                        'name'        => 'title',
                        'label'       => esc_html__( 'Title', 'apexus' ),
                        'type'        => Controls_Manager::TEXTAREA,
                        'placeholder' => esc_html__( 'Menu', 'apexus' ),
                    ],
                    [
                        'name'         => 'title_typo',
                        'label'        => esc_html__( 'Title Typography', 'apexus' ),
                        'type'         => Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector'     => '{{WRAPPER}} .anchor-title',
                        'condition'    => ['title!' => '']
                    ],
                    [
                        'name' => 'text_color',
                        'label' => esc_html__('Text Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'control_type' => 'responsive',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-anchor .anchor-title' => 'color: {{VALUE}};',
                        ],
                    ], 
                    [
                        'name' => 'text_color_hover',
                        'label' => esc_html__('Text Color Hover', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'control_type' => 'responsive',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-anchor:hover .anchor-title' => 'color: {{VALUE}};',
                        ],
                    ], 
                    [
                        'name'         => 'align',
                        'label'        => esc_html__( 'Justify Alignment', 'apexus' ),
                        'type'         => Controls_Manager::CHOOSE,
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
                            '{{WRAPPER}} .pxl-anchor-wrap' => 'justify-content: {{VALUE}};',
                        ],
                        'prefix_class' => 'anchor-align-'
                    ],
                    [
                        'name'        => 'custom_class',
                        'label'       => esc_html__( 'Custom class', 'apexus' ),
                        'type'        => Controls_Manager::TEXT,
                    ],
                ],
            ]
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Anchor()); 