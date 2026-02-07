<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
class Pxl_Search extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_search',
            'title'    => esc_html__('PXL Search', 'apexus'),
            'icon'     => 'eicon-search',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        return [
            array(
                'name'     => 'text_section',
                'label'    => esc_html__( 'Setting', 'apexus' ),
                'tab'      => 'content',
                'controls' => array(
                    array(
                        'name' => 'search_type',
                        'label' => esc_html__('Search Type', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            '' => esc_html__('Default', 'apexus' ),
                        ],
                        'default' => '',
                    ),
                    array(
                        'name'     => 'placeholder',
                        'label'    => esc_html__('Placeholder text', 'apexus'),
                        'type'     => 'text',
                        'label_block' => true,
                        'default'  => 'Search for items...'
                    ),
                    array(
                        'name'    => 'search_text_width',
                        'label'   => esc_html__( 'Search Text width', 'apexus' ),
                        'type'    => 'slider',
                        'control_type' => 'responsive',
                        'size_units'   => [ 'px', '%' ],
                        'default' => [
                            'unit' => 'px',
                            'unit' => '%',
                        ],
                        'range' => [
                            'px' => [
                                'min' => 100,
                                'max' => 1200,
                            ],
                            '%' => [
                                'min' => 5,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-search-field' => 'width: {{SIZE}}{{UNIT}}'
                        ],
                    ),
                    array(
                        'name'    => 'search_text_height',
                        'label'   => esc_html__( 'Search Text height', 'apexus' ),
                        'type'    => 'slider',
                        'control_type' => 'responsive',
                        'size_units'   => [ 'px'],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'range' => [
                            'px' => [
                                'min' => 30,
                                'max' => 120,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-search-field' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
                        ],
                    ),
                    array(
                        'name' => 'search_text_padding',
                        'label' => esc_html__('Search Text Padding(px)', 'apexus' ),
                        'type' => 'dimensions',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-search-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name'         => 'search_border_radius',
                        'label'        => esc_html__( 'Search Border Radius', 'apexus' ),
                        'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                        'control_type' => 'responsive',
                        'size_units'   => [ 'px', '%' ],
                        'selectors'    => [
                            '{{WRAPPER}} .pxl-search-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name' => 'search_text_color',
                        'label' => esc_html__('Search Text Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-search-form .pxl-search-field' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'search_text_color_hover',
                        'label' => esc_html__('Search Text Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-search-form .pxl-search-field:hover' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'search_text_bg',
                        'label' => esc_html__('Search Text Background', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-search-field' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'search_text_bg_hover',
                        'label' => esc_html__('Search Text Background Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-search-field:hover' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'search_placeholder_color',
                        'label' => esc_html__('Placeholder Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-search-field::-webkit-input-placeholder' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'search_placeholder_color_hvoer',
                        'label' => esc_html__('Placeholder Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-search-field:hover::-webkit-input-placeholder' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'search_button_color',
                        'label' => esc_html__('Button Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-search-wrap-wg .pxl-search-submit' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'search_button_color_hover',
                        'label' => esc_html__('Button Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-search-form:hover .pxl-search-submit, {{WRAPPER}} .pxl-search-wrap-wg .pxl-search-submit:hover' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'search_text_border_color',
                        'label' => esc_html__('Search Text Border Color', 'apexus' ),
                        'type' => 'color',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-search-field' => 'border-color: {{VALUE}};'
                        ],
                    ),
                    array(
                        'name' => 'search_text_border_color_hover',
                        'label' => esc_html__('Search Text Border Color Hover', 'apexus' ),
                        'type' => 'color',
                        'control_type' => 'responsive',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-search-wrap-wg .pxl-search-form .pxl-search-field:hover, {{WRAPPER}} .pxl-search-wrap-wg .pxl-search-form .pxl-search-field:focus, {{WRAPPER}} .pxl-search-wrap-wg .pxl-search-form .pxl-search-field:active' => 'border-color: {{VALUE}};'
                        ],
                    ),
                     
                )
            ),  
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Search());