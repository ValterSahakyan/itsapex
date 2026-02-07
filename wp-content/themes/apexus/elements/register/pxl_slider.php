<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class Pxl_slider extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_slider',
            'title'    => esc_html__('Pxl Slider', 'apexus'),
            'icon'     => 'eicon-slides',
            'scripts'  => [
                'swiper',
                'apexus-swiper',
                'swiper-bundle',
                'swiper-gl',
            ],
            'styles'   => ['swiper'],
            'keywords' => ['apexus', 'Slider'],
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
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_slider-1.webp'
                            ],
                            '2' => [
                                'label' => esc_html__( 'Layout 2', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_slider-2.webp'
                            ],
                        ],
                    ),
                    
                ),
            ],
            [
                'name' => 'section_list',
                'label' => esc_html__('Content', 'apexus'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array(
                    array(
                        'name' => 'content_list',
                        'label' => esc_html__('Content List', 'apexus'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'controls' => array(
                            array(
                                'name' => 'background_image',
                                'label' => esc_html__('Background Image', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::MEDIA,
                            ),
                            array(
                                'name' => 'logo',
                                'label' => esc_html__('Image', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::MEDIA,
                            ),
                            array(
                                'name'             => 'selected_icon',
                                'label'            => esc_html__( 'Icon', 'apexus' ),
                                'type'             => 'icons',
                                'description'      => esc_html__( 'Icon Use layout 1', 'apexus' ),
                            ),
                            array(
                                'name' => 'text_icon_1',
                                'label' => esc_html__('Text Icon 1', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => esc_html__('This is the Text', 'apexus'),
                                'label_block' => true,
                                'description' => esc_html__( 'Icon Use layout 1', 'apexus' ),
                            ),
                            array(
                                'name' => 'text_icon_2',
                                'label' => esc_html__('Text Icon 2', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => esc_html__('This is the Text', 'apexus'),
                                'label_block' => true,
                                'description' => esc_html__( 'Icon Use layout 1', 'apexus' ),
                            ),
                            array(
                                'name' => 'title',
                                'label' => esc_html__('Title', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => esc_html__('This is the Title', 'apexus'),
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'description',
                                'label' => esc_html__('Description', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'default' => esc_html__('This is the Description', 'apexus'),
                                'rows' => 10,
                            ),
                            array(
                                'name' => 'button_text',
                                'label' => esc_html__('Button Text', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => esc_html__('Make a call', 'apexus'),
                                'label_block' => true,
                            ),
                            array(
                                'name'        => 'link_button',
                                'label'       => esc_html__( 'Link', 'apexus' ),
                                'type'        => 'url',
                                'default' => [
                                    'url' => '#',
                                ],
                                'label_block' => true,
                            ),
                        ),
                        'title_field' => '{{{ name }}}',
                    ),
                ),
            ],
            [
                'name' => 'general_section',
                'label' => esc_html__('General Settings', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array_merge(
                    array(
                        array(
                            'name'         => 'preloader',
                            'label'        => esc_html__('Pre Loader Effects', 'apexus'),
                            'type'         => 'select',
                            'default' => '',
                            'options' => [
                                '' => esc_html__( 'None', 'apexus' ),
                                'five-dots' => esc_html__( '5 Dots', 'apexus' ),
                            ],
                        ),
                    ),
                )
            ],
            [
                'name' => 'carousel_setting',
                'label' => esc_html__('Carousel Settings', 'apexus'),
                'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                'controls' => array_merge(
                    apexus_carousel_settings()    
                ),
            ],
            [
                'name' => 'section_arrows_settings',
                'label' => esc_html__('Arrows Settings', 'apexus'),
                'tab'      => \Elementor\Controls_Manager::TAB_SETTINGS,
                'controls' => array_merge(
                    apexus_carousel_arrow_settings()   
                )
            ],
            [
                'name' => 'section_dots_settings',
                'label' => esc_html__('Dots Settings', 'apexus'),
                'tab'      => \Elementor\Controls_Manager::TAB_SETTINGS,
                'controls' => array_merge(
                    apexus_carousel_dots_settings()
                )
            ],
            [
                'name' => 'style_section',
                'label' => esc_html__('Style', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array(
                    array(
                        'name' => 'img_size',
                        'label' => esc_html__('Image Size', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'description' =>  esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Ex: 370x300 (Width x Height)).', 'apexus'),
                        'condition' => [
                            'layout' => '2'
                        ]
                    ),
                    array(
                        'name'  => 'max_width_box',
                        'label' => esc_html__( 'Max Width Box(px)', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px','%' ],
                        'range' => [
                            'px' => [
                                'min' => 100,
                                'max' => 2000,
                            ],
                        ],
                        'default' => [
                            'size' => '',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider .item-inner' => 'max-width: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]
                    ), 
                    array(
                        'name'  => 'height_box',
                        'label' => esc_html__( 'Height Box(px)', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 100,
                                'max' => 1000,
                            ],
                        ],
                        'default' => [
                            'size' => '',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider .item-inner' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]
                    ), 
                    array(
                        'name' => 'background_color_mask',
                        'label' => esc_html__('Mask Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider .pxl-swiper-slider-wrap::before' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ),
                    array(
                        'name' => 'background_color_overlay',
                        'label' => esc_html__('Overlay Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::HEADING,
                    ),
                    array(
                        'name' => 'background_color_overlay1',
                        'label' => esc_html__( 'Overlay Background Color', 'apexus' ),
                        'type' => \Elementor\Group_Control_Background::get_type(),
                        'types' => [ 'classic', 'gradient' ],
                        'control_type' => 'group',
                        'exclude' => [ 'image' ],
                        'selector' => '{{WRAPPER}} .pxl-slider .pxl-swiper-container::before',
                        'fields_options' => [
                            'background' => [
                                'default' => 'gradient',
                            ],
                        ]
                    ),
                    array(
                        'name' => 'padding_box',
                        'label' => esc_html__('Padding Box', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider .item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                        'separator' => 'after'
                    ), 
                    array(
                        'name' => 'title_typography',
                        'label' => esc_html__('Title Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-slider .item-title',
                    ),
                    array(
                        'name' => 'title_color',
                        'label' => esc_html__('Title Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider .item-title' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name'  => 'title_max_width',
                        'label' => esc_html__( 'Max Width Title', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 1000,
                            ],
                        ],
                        'default' => [
                            'size' => '',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider .item-title' => 'max-width: {{SIZE}}{{UNIT}};',
                        ]
                    ), 
                    array(
                        'name' => 'des_color',
                        'label' => esc_html__('Description Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider .item-des' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'des_typography',
                        'label' => esc_html__('Description Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-slider .item-des',
                    ),
                    array(
                        'name'  => 'des_max_width',
                        'label' => esc_html__( 'Max Width Description', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 1000,
                            ],
                        ],
                        'default' => [
                            'size' => '',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider .item-des' => 'max-width: {{SIZE}}{{UNIT}};',
                        ],
                        'separator' => 'after'
                    ), 
                    array(
                        'name' => 'icon_color',
                        'label' => esc_html__('Icon Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider .box-icon .item-icon svg' => 'fill: {{VALUE}};',
                            '{{WRAPPER}} .pxl-slider .box-icon .item-icon i' => 'color: {{VALUE}};'
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ),
                    array(
                        'name' => 'icon_bg_color',
                        'label' => esc_html__('Icon background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider .box-icon .item-icon' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ),
                    array(
                        'name' => 'text_icon_color1',
                        'label' => esc_html__('Text Icon Color 1', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider .box-icon .text-1' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ),
                    array(
                        'name' => 'text_icon_color2',
                        'label' => esc_html__('Text Icon Color 2', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider .box-icon .text-2' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ),
                    array(
                        'name' => 'button_typography',
                        'label' => esc_html__('Button Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-slider .pxl-btn',
                    ),
                    array(
                        'name' => 'button_color',
                        'label' => esc_html__('Button Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider.layout-1 .btn-primary,{{WRAPPER}} .pxl-slider.layout-2 .btn-seventh' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'button_color_hover',
                        'label' => esc_html__('Button Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider .btn-seventh:hover' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]
                    ),
                    array(
                        'name' => 'button_icon_color',
                        'label' => esc_html__('Button Icon Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider .btn-seventh .pxl-icon svg' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]
                    ),
                    array(
                        'name' => 'button_bg_color',
                        'label' => esc_html__('Button Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider.layout-1 .btn-primary, {{WRAPPER}} .pxl-slider.layout-2 .btn-seventh .pxl-button-text,
                            {{WRAPPER}} .pxl-slider.layout-2 .btn-seventh .pxl-icon' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'button_bg_color_hover',
                        'label' => esc_html__('Button Background Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-slider .btn-seventh .pxl-button-text::after' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]
                    ),
                ),
            ],
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_slider());