<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
class Pxl_Map_Location extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_map_location',
            'title'    => esc_html__('Pxl Map Location', 'apexus'),
            'icon'     => 'far fa-map',
            'scripts'  => ['apexus-map-location'],
            'styles'   => [],
            'keywords' => ['apexus', 'map'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        return [
            [
                'name' => 'layout_section',
                'label' => esc_html__('Layout', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                'controls' => array(
                    array(
                        'name'    => 'layout',
                        'label'   => esc_html__( 'Layout', 'apexus' ),
                        'type'    => 'layoutcontrol',
                        'default' => '1',
                        'options' => [
                            '1' => [
                                'label' => esc_html__( 'Layout 1', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_map_location-1.webp'
                            ],
                            '2' => [
                                'label' => esc_html__( 'Layout 2', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_map_location-2.webp'
                            ],
                        ],
                        'prefix_class' => 'pxl-location-wrap-layout-',
                    ),
                ),
            ],
            [
                'name'     => 'content_section',
                'label'    => esc_html__( 'Content Settings', 'apexus' ),
                'tab'      => 'content',
                'controls' => array(
                    array(
                        'name'        => 'img_map',
                        'label'       => esc_html__('Image Map', 'apexus'),
                        'type'        => 'media',
                        'label_block' => true,
                    ),
                    array(
                        'name'     => 'location_list',
                        'label'    => esc_html__( 'Location Lists', 'apexus' ),
                        'type'     => 'repeater',
                        'controls' => array(
                            array(
                                'name' => 'item_offset_x',
                                'label' => esc_html__('Offset X (%)', 'apexus' ),
                                'type' => 'number',
                                'default' => '0',
                            ),
                            array(
                                'name' => 'item_offset_y',
                                'label' => esc_html__('Offset Y (%)', 'apexus' ),
                                'type' => 'number',
                                'default' => '0',
                            ),
                            array(
                                'name'        => 'img_location',
                                'label'       => esc_html__('Image Location', 'apexus'),
                                'type'        => 'media',
                                'label_block' => true,
                            ),
                            array(
                                'name'        => 'item_title',
                                'label'       => esc_html__( 'Name City', 'apexus' ),
                                'type'        => 'text',
                                'placeholder' => esc_html__( 'Enter Name', 'apexus' ),
                                'default'     => 'Name City',  
                                'label_block' => true
                            ),
                            array(
                                'name'        => 'subtitle_location',
                                'label'       => esc_html__( 'Name Country', 'apexus' ),
                                'type'        => 'text',
                                'label_block' => true,
                                'placeholder'=> 'Name Country',
                            ),
                            array(
                                'name' => 'width_box',
                                'label' => esc_html__( 'Width Box', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%'],
                                'control_type' => 'responsive',
                                'range' => [
                                    'px' => [
                                        'max' => 1000,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-location-wrap {{CURRENT_ITEM}} .box-inner' => 'width: {{SIZE}}{{UNIT}};',
                                ],
                                'description' => esc_html__( 'Width Use for layout 2', 'apexus' ),
                            ),
                        ),
                    ),
                )
            ],
            [
                'name' => 'lc_style',
                'label' => esc_html__('Style', 'apexus'),
                'tab' => 'style',
                'controls' => array_merge(
                    array(
                        array(
                            'name' => 'dot_location_color',
                            'label' => esc_html__('Color Dot Location', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-location-wrap .map-marker,{{WRAPPER}} .pxl-location-wrap .map-marker::after' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_dot_color',
                            'label' => esc_html__('Icon Dot Color', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-location-wrap .map-marker::before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-location-wrap .map-marker::after' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'border_dot_color',
                            'label' => esc_html__('Border Dot Color', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-location-wrap .location-wrap::after' => 'border-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Name City Color', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-location-wrap .item-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_color_hover',
                            'label' => esc_html__('Name City Color Hover', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-location-wrap .title-location .item-title' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Name Typography', 'apexus' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-location-wrap .item-title',
                        ),
                        array(
                            'name' => 'country_color',
                            'label' => esc_html__('Country Color', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-location-wrap .item-subtitle' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'country_color_hover',
                            'label' => esc_html__('Country Color Hover', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-location-wrap .title-location .item-subtitle' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'country_typography',
                            'label' => esc_html__('Country Typography', 'apexus' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-location-wrap .item-subtitle',
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__('Border Color', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-location-wrap .pxl-ttip .box-inner::before' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'background_color',
                            'label' => esc_html__('Background Color', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-location-wrap.layout-1 .pxl-ttip .box-inner,{{WRAPPER}} .pxl-location-wrap.layout-2 .title-location' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-location-wrap.layout-1 .pxl-ttip .box-inner::after' => 'background-color: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name' => 'overlay_background',
                            'label' => esc_html__('Overlay Background', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-location-wrap .map-area .map-wrapper::before' => '--overlay-color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => '1'
                            ]
                        ),
                    ),
                ),
            ],
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Map_Location()); 