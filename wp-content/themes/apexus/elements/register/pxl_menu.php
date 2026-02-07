<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
class Pxl_Menu extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_menu',
            'title'    => esc_html__('Pxl Menu', 'apexus'),
            'icon'     => 'eicon-nav-menu',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus', 'menu', 'nav'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        $locations = get_registered_nav_menus();
        foreach($locations as $location => $location_name){
            if( !has_nav_menu( $location )){
                unset($locations[$location]);
            }
        }
        return [
            array(
                'name' => 'source_section',
                'label' => esc_html__('Source Settings', 'apexus'),
                'tab' => 'content',
                'controls' => array(
                    array(
                        'name' => 'type',
                        'label' => esc_html__('Type', 'apexus' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            '1' => esc_html__('Main Menu', 'apexus'),
                            '2' => esc_html__('Menu Inner', 'apexus'),
                            '3' => esc_html__('Mobile Menu', 'apexus'),
                            '4' => esc_html__('Canvas Menu', 'apexus'),
                        ],
                        'default' => '1',
                    ),
                    array(
                        'name' => 'style',
                        'label' => esc_html__('Menu Style', 'apexus' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            'df' => esc_html__('Default', 'apexus'),
                            'vr' => esc_html__('Vertical', 'apexus'),
                            'st1' => esc_html__('Style 1', 'apexus'),
                            'st2' => esc_html__('Style 2', 'apexus'),
                            'st3' => esc_html__('Style 3', 'apexus'),
                            'st4' => esc_html__('Style 4', 'apexus'),
                        ],
                        'default' => 'df',
                        'condition' => ['type' => '1']
                    ),
                    array(
                        'name' => 'inner_style',
                        'label' => esc_html__('Menu Style', 'apexus' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            'df' => esc_html__('Default', 'apexus'),
                            'hr' => esc_html__('Horizontal', 'apexus'),
                        ],
                        'default' => 'df',
                        'condition' => ['type' => '2']
                    ),
                    array(
                        'name' => 'menu_location',
                        'label' => esc_html__('Menu Location', 'apexus'),
                        'type' => Controls_Manager::SELECT,
                        'options' => $locations,
                        'default' => 'primary',
                    ),
                    array(
                        'name'         => 'align',
                        'label'        => esc_html__( 'Alignment', 'apexus' ),
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
                            '{{WRAPPER}} .pxl-primary-menu, {{WRAPPER}} .style-vr .pxl-primary-menu > li,  {{WRAPPER}} .pxl-mobile-menu' => 'justify-content: {{VALUE}};'
                        ],
                        'condition' => [
                            'type' => ['1','3'],
                        ]
                    ),
                    
                ),
            ),
            array(
                'name' => 'first_section',
                'label' => esc_html__('Style First Level', 'apexus'),
                'tab' => 'content',
                'condition' => [
                    'type' => ['1','3'],
                ],
                'controls' => array(
                    array(
                        'name' => 'color',
                        'label' => esc_html__('Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li > a' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu > li > a' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li .main-menu-toggle' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu > li .main-menu-toggle' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li > a span:before' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'color_hover',
                        'label' => esc_html__('Color Hover', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li:hover > a'                      => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-item > a'          => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-ancestor > a'      => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-item .main-menu-toggle' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-ancestor .main-menu-toggle'   => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-item > a span:before' => 'background-color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-ancestor > a span:before'   => 'background-color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu > li > a:hover,
                            {{WRAPPER}} .pxl-mobile-menu .menu-item:hover > a,{{WRAPPER}} .pxl-mobile-menu .menu-item:active > a,
                            {{WRAPPER}} .pxl-mobile-menu .current-menu-item > a,{{WRAPPER}} .pxl-mobile-menu .current-menu-ancestor > a'   => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li:hover .main-menu-toggle' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu > li:hover .main-menu-toggle'  => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li:hover > a span:before' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'typography',
                        'label' => esc_html__('Typography', 'apexus' ),
                        'type' => Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li > a, {{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu > li > a',
                    ),
                    array(
                        'name'  => 'show_arrow',
                        'label' => esc_html__('Show Arrow', 'apexus'),
                        'type'  => Controls_Manager::SWITCHER,
                        'return_value' => 'yes',
                        'default' => 'yes',
                        'condition' => [
                            'type' => ['1'],
                        ],
                    ),
                    array(
                        'name' => 'arrow_color',
                        'label' => esc_html__('Arrow Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .style-st3 .pxl-primary-menu > li .main-menu-toggle::before' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'style' => ['st3'],
                        ],
                    ),
                    array(
                        'name' => 'dot_menu_color',
                        'label' => esc_html__('Dot Menu Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .style-st4 .pxl-primary-menu > li::before' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'style' => ['st4'],
                        ],
                    ),
                    array(
                        'name' => 'dot_active_menu_color',
                        'label' => esc_html__('Dot Active Menu Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .style-st4 .pxl-primary-menu > li.current-menu-ancestor::before,{{WRAPPER}} .style-st4 .pxl-primary-menu > li:hover::before' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'style' => ['st4'],
                        ],
                    ),
                    array(
                        'name' => 'color_dot_shadow',
                        'label' => esc_html__('Color Dot Shadow', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .style-st4 .pxl-primary-menu > li.current-menu-ancestor::before,{{WRAPPER}} .style-st4 .pxl-primary-menu > li:hover::before' => '--color-boxshadow: {{VALUE}};',
                        ],
                        'condition' => [
                            'style' => ['st4'],
                        ],
                    ),
                    array(
                        'name' => 'divider_color',
                        'label' => esc_html__('Divider Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .style-st3 .pxl-primary-menu > li > a::after, {{WRAPPER}} .style-st4 .pxl-primary-menu::before' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'style' => ['st3','st4'],
                        ],
                    ),
                    array(
                        'name' => 'border_color',
                        'label' => esc_html__('Border Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .style-st3 .pxl-primary-menu > li' => 'border-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'style' => ['st3'],
                        ],
                    ),
                    array(
                        'name' => 'item_space',
                        'label' => esc_html__('Item Space', 'apexus' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px', 'em', '%', 'rem' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-primary-menu > li,{{WRAPPER}} .pxl-nav-menu .pxl-divider-move' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-mobile-menu > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name' => 'padding_item',
                        'label' => esc_html__('Padding', 'apexus' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px', 'em', '%', 'rem' ],
                        'selectors' => [
                            '{{WRAPPER}} .style-st3 .pxl-primary-menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => [
                            'style' => ['st3'],
                        ],
                    ),
                    array(
                        'name'  => 'height_item',
                        'label' => esc_html__( 'Height', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 500,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .style-st3 .pxl-primary-menu > li > a' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'style' => ['st3'],
                        ],
                    ),
                    array(
                        'name'  => 'width_divider',
                        'label' => esc_html__( 'Width Divider(calc)', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 300,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .style-st4 .pxl-primary-menu::before' => '--width-border: {{SIZE}}{{UNIT}};',
                        ],
                        'description' => esc_html__( 'width: calc(100% - XX);', 'apexus' ),
                        'condition' => [
                            'style' => ['st4'],
                        ],
                    ),
                ),
            ),
            array(
                'name' => 'sub_section',
                'label' => esc_html__('Style Sub Level', 'apexus'),
                'tab' => 'content',
                'condition' => [
                    'type' => ['1','3'],
                ],
                'controls' => array(
                    array(
                        'name' => 'sub_color',
                        'label' => esc_html__('Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu a' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu li .sub-menu a' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'sub_color_hover',
                        'label' => esc_html__('Color Hover', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu a:hover' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu li .sub-menu a:hover' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu .sub-menu li:before' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'sub_typography',
                        'label' => esc_html__('Typography', 'apexus' ),
                        'type' => Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu a, {{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu li .sub-menu a',
                    ),
                    array(
                        'name' => 'background_color_sub',
                        'label' => esc_html__('Background Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-primary-menu .sub-menu' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'border_color_sub',
                        'label' => esc_html__('Border Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-primary-menu .sub-menu' => 'border: 1px solid {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'border_bottom_color_sub',
                        'label' => esc_html__('Border Bottom Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-primary-menu .sub-menu li > a' => 'border-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'dot_color',
                        'label' => esc_html__('Dot Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-primary-menu .sub-menu li > a::before,{{WRAPPER}} .pxl-primary-menu .sub-menu li > a .pxl-menu-title::before' => 'background-color: {{VALUE}};',
                        ],
                    ),
                ),
            ),
            array(
                'name' => 'nav_section',
                'label' => esc_html__('Style', 'apexus'),
                'tab' => 'content',
                'condition' => [
                    'type' => ['2'],
                ],
                'controls' => array(
                    array(
                        'name' => 'nav_color',
                        'label' => esc_html__('Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner a' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'nav_color_hover',
                        'label' => esc_html__('Color Hover', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner a:hover' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'nav_typography',
                        'label' => esc_html__('Typography', 'apexus' ),
                        'type' => Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner a',
                    ),
                    array(
                        'name' => 'nav_item_space',
                        'label' => esc_html__('Item Space', 'apexus' ),
                        'type' => Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 300,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner li + li' => 'margin-top: {{SIZE}}{{UNIT}};',
                        ],
                    ),
                ),
            ),
        ];
    }
}

\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Menu());
 