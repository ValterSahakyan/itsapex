<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class Pxl_process_accordion extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_process_accordion',
            'title'    => esc_html__('PXL Process accordion', 'apexus'),
            'icon'     => 'eicon-accordion',
            'scripts'    => array(
                
            ),
            'styles' => [
                'swiper'
            ],
            'keywords' => ['apexus', 'process accordion'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        return [
            array(
                'name'     => 'source_section',
                'label'    => esc_html__( 'Source Settings', 'apexus' ),
                'tab'      => 'content',
                'controls' => array(
                    array(
                        'name' => 'process_list',
                        'label' => esc_html__( 'Process', 'apexus' ),
                        'type' => 'repeater',
                        'controls' => array(
                            array(
                                'name' => 'selected_icon',
                                'label' => esc_html__('Icon', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::ICONS,                     
                            ),
                            array(
                                'name'        => 'featured_image',
                                'label'       => esc_html__( 'Featured image', 'apexus' ),
                                'type'        => 'media',
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'title',
                                'label' => esc_html__( 'Title', 'apexus' ),
                                'type' => 'textarea',
                                'rows' => 3,
                            ),                                                                       
                        ),                            
                        'default' => [
                            [
                                'title' => esc_html__( 'Process #1', 'apexus')                                    
                                                                      
                            ],
                            [
                                'title' => esc_html__( 'Process #2', 'apexus')                                    
                                                                      
                            ],
                            [
                                'title' => esc_html__( 'Process #3', 'apexus')                                    
                                                                      
                            ]                                                                  
                        ],
                        'title_field' => '{{{ title }}}'                       
                    )                        
                )
            ),
            array(
                'name'     => 'style_general_section',
                'label'    => esc_html__( 'General', 'apexus' ),
                'tab'      => 'style',
                'controls' => array_merge(
                    array(
                        array(
                            'name' => 'image_height',
                            'label' => esc_html__( 'Image height ( px)', 'apexus' ),
                            'type' => 'slider',  
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'max' => 1000
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process-accordion-widget' => '--image-height: {{SIZE}}{{UNIT}}!important;',
                            ],
                        ),
                        array(
                            'name' => 'content_spacing',
                            'label' => esc_html__( 'Content spacing ( px)', 'apexus' ),
                            'type' => 'slider',  
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process-accordion-widget .widget-wrap' => 'column-gap: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_setting',
                            'label' => esc_html__( 'Icon', 'apexus'),
                            'type' => 'heading'
                        ),
                        array(
                            'name' => 'icon_bg_color',
                            'label' => esc_html__( 'Icon Background color', 'apexus' ),
                            'type' => 'color',                    
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process-accordion-widget .icon-wrapper' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__( 'Icon color', 'apexus' ),
                            'type' => 'color',                    
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process-accordion-widget .icon-wrapper i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-process-accordion-widget .icon-wrapper svg' => 'fill: {{VALUE}};',
                            ],
                        ),
                         array(
                            'name' => 'icon_bg_color_active',
                            'label' => esc_html__( 'Icon Background color Active', 'apexus' ),
                            'type' => 'color',                    
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process-accordion-widget .process-item.is-active .icon-wrapper, {{WRAPPER}} .pxl-process-accordion-widget .process-item.swiper-slide-active .icon-wrapper' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_color_active',
                            'label' => esc_html__( 'Icon color Active', 'apexus' ),
                            'type' => 'color',                    
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process-accordion-widget .process-item.is-active .icon-wrapper i, {{WRAPPER}} .pxl-process-accordion-widget .process-item.swiper-slide-active .icon-wrapper i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-process-accordion-widget .process-item.is-active .icon-wrapper svg, {{WRAPPER}} .pxl-process-accordion-widget .process-item.swiper-slide-active .icon-wrapper svg' => 'fill: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'  => 'icon_font_size',
                            'label' => esc_html__( 'Icon Size', 'apexus' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process-accordion-widget .icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-process-accordion-widget .icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'heading_count',
                            'label' => esc_html__( 'Count settings', 'apexus'),
                            'type' => 'heading'
                        ),
                        array(
                            'name' => 'count_typography',
                            'type' => 'typography',
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-process-accordion-widget .process-count'
                        ),
                        array(
                            'name' => 'count_color',
                            'label' => esc_html__( 'Color', 'apexus' ),
                            'type' => 'color',                    
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process-accordion-widget .process-count' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'heading_title',
                            'label' => esc_html__( 'Title settings', 'apexus'),
                            'type' => 'heading'
                        ),
                        array(
                            'name' => 'title_typography',
                            'type' => 'typography',
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-process-accordion-widget .process-name'
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__( 'Color', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process-accordion-widget .process-name' => 'color: {{VALUE}};',
                            ]
                        ),  
                        array(
                            'name' => 'title_active_typography',
                            'label' => esc_html__( 'Typography Active', 'apexus' ),
                            'type' => 'typography',
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-process-accordion-widget .process-name-active'
                        ),
                        array(
                            'name' => 'title_active_color',
                            'label' => esc_html__( 'Color Active', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process-accordion-widget .process-name-active' => 'color: {{VALUE}};',
                            ]
                        ),
                        array(
                            'name' => 'divider_color',
                            'label' => esc_html__( 'Divider Color', 'apexus' ),
                            'type' => 'color',                    
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process-accordion-widget .pxl-divider' => 'background-color: {{VALUE}};',
                            ],
                        ),  
                        array(
                            'name' => 'divider_color_active',
                            'label' => esc_html__( 'Divider Color Active', 'apexus' ),
                            'type' => 'color',                    
                            'selectors' => [
                                '{{WRAPPER}} .pxl-process-accordion-widget .pxl-divider::before' => 'background-color: {{VALUE}};',
                            ],
                        ), 
                        array(
                            'name' => 'bg_setting',
                            'label' => esc_html__( 'Background Box', 'apexus'),
                            'type' => 'heading'
                        ),
                        array(
                            'name' => 'background_color_box',
                            'label' => esc_html__( 'Background Color Box', 'apexus' ),
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'types' => [ 'classic', 'gradient' ],
                            'control_type' => 'group',
                            'exclude' => [ 'image' ],
                            'selector' => '{{WRAPPER}} .pxl-process-accordion-widget .featured-image::after',
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                            ],
                        ),
                        array(
                            'name' => 'bg_active_setting',
                            'label' => esc_html__( 'Background Box Active', 'apexus'),
                            'type' => 'heading'
                        ),
                        array(
                            'name' => 'background_box_active',
                            'label' => esc_html__( 'Background Box Acitve', 'apexus' ),
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'types' => [ 'classic', 'gradient' ],
                            'control_type' => 'group',
                            'exclude' => [ 'image' ],
                            'selector' => '{{WRAPPER}} .pxl-process-accordion-widget .process-item.is-active .featured-image::after, {{WRAPPER}} .pxl-process-accordion-widget .process-item.swiper-slide-active .featured-image::after',
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                            ],
                        ),
                    )
                )
            ) 
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_process_accordion()); 