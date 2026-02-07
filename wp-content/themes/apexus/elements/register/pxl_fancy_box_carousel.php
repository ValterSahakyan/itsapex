<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
class Pxl_fancy_box_carousel extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_fancy_box_carousel',
            'title'    => esc_html__('PXL Fancy Box Carousel', 'apexus'),
            'icon'     => 'eicon-info-box',
            'scripts'  => [
                'swiper',
                'apexus-swiper',
            ],
            'styles'   => ['swiper'],
            'keywords' => ['apexus', ''],
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
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_fancy_box_carousel-1.webp'
                            ],
                            '2' => [
                                'label' => esc_html__( 'Layout 2', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_fancy_box_carousel-2.webp'
                            ],
                            '3' => [
                                'label' => esc_html__( 'Layout 3', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_fancy_box_carousel-3.webp'
                            ],
                            '4' => [
                                'label' => esc_html__( 'Layout 4', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_fancy_box_carousel-4.webp'
                            ],
                            '5' => [
                                'label' => esc_html__( 'Layout 5', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_fancy_box_carousel-5.webp'
                            ],
                            '6' => [
                                'label' => esc_html__( 'Layout 6', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_fancy_box_carousel-6.webp'
                            ],
                        ],
                    ),
                    
                ),
            ],
            [
                'name' => 'section_boxs',
                'label' => esc_html__('Box Settings', 'apexus'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array(
                    array(
                        'name' => 'bg_image',
                        'label' => esc_html__('Background Image', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'condition' => [
                            'layout' => ['6']
                        ],
                    ),
                    array(
                        'name' => 'boxs',
                        'label' => esc_html__('Item', 'apexus'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'default' => [],
                        'condition' => [
                            'layout!' => ['3','5']
                        ],
                        'controls' => array(
                            array(
                                'name'             => 'selected_icon',
                                'label'            => esc_html__( 'Icon', 'apexus' ),
                                'type'             => 'icons',
                                'description' => esc_html__('Icon Use for layout 1,2,3', 'apexus'),
                            ),
                            array(
                                'name' => 'image',
                                'label' => esc_html__('Image', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::MEDIA,
                                'description' => esc_html__('Img Use for layout 2,4', 'apexus'),
                            ),
                            array(
                                'name' => 'title_text',
                                'label' => esc_html__('Title', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'default' => esc_html__('This is the heading', 'apexus'),
                                'placeholder' => esc_html__('Enter your title', 'apexus'),
                            ),
                            array(
                                'name' => 'sub_title',
                                'label' => esc_html__('Sub Title', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'default' => esc_html__('This is the SubTitle', 'apexus'),
                                'placeholder' => esc_html__('Enter your SubTitle', 'apexus'),
                                'description' => esc_html__('SubTitle Use for layout 1,6', 'apexus'),
                            ),
                            array(
                                'name' => 'description_text',
                                'label' => esc_html__('Description', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'apexus'),
                            ),
                             array(
                                'name' => 'date_time',
                                'label' => esc_html__('Date', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => esc_html__('YYYY', 'apexus'),
                                'description' => esc_html__('Date Use for layout 1', 'apexus'),
                            ),
                            array(
                                'name'        => 'link',
                                'label'       => esc_html__( 'Custom Link', 'apexus' ),
                                'type'        => 'url',
                                'placeholder' => esc_html__( 'https://your-link.com', 'apexus' ),
                                'description' => esc_html__('Use for layout 1', 'apexus'),
                            ),
                            array(
                                'name'  => 'space_title',
                                'label' => esc_html__( 'Space Title', 'apexus' ),
                                'type'  => 'slider',
                                'control_type' => 'responsive',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-fancy-box-carousel.layout-6 {{CURRENT_ITEM}} .item-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                                ],
                                'description' => esc_html__('Space Use for layout 6', 'apexus'),
                            ),
                        ),
                        'title_field' => '{{{ title_text }}}',
                    ),
                    array(
                        'name' => 'boxs_2',
                        'label' => esc_html__('Item', 'apexus'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'default' => [],
                        'condition' => [
                            'layout' => ['3','5']
                        ],
                        'controls' => array(
                            array(
                                'name'             => 'selected_icon_2',
                                'label'            => esc_html__( 'Icon', 'apexus' ),
                                'type'             => 'icons',
                                'description' => esc_html__('Icon Use for layout 5', 'apexus'),
                            ),
                            array(
                                'name' => 'image_2',
                                'label' => esc_html__('Image', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::MEDIA,
                            ),
                            array(
                                'name' => 'title_1',
                                'label' => esc_html__('Title 1', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'default' => esc_html__('This is the heading', 'apexus'),
                                'placeholder' => esc_html__('Enter your title', 'apexus'),
                                'description' => esc_html__('Title Use for layout 3', 'apexus'),
                            ),
                            array(
                                'name' => 'title_2',
                                'label' => esc_html__('Title 2', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'default' => esc_html__('This is the heading', 'apexus'),
                                'placeholder' => esc_html__('Enter your title', 'apexus'),
                                'description' => esc_html__('Title Use for layout 3', 'apexus'),
                            ),
                            array(
                                'name' => 'sub_title_2',
                                'label' => esc_html__('Sub Title', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'default' => esc_html__('This is the SubTitle', 'apexus'),
                                'placeholder' => esc_html__('Enter your SubTitle', 'apexus'),
                            ),
                             array(
                                'name' => 'button_text',
                                'label' => esc_html__('Button Text', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => esc_html__('Explore details', 'apexus'),
                            ),
                            array(
                                'name'        => 'link_2',
                                'label'       => esc_html__( 'Link', 'apexus' ),
                                'type'        => 'url',
                                'placeholder' => esc_html__( 'https://your-link.com', 'apexus' ),
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
                        array(
                            'name' => 'setting_drag',
                            'label' => esc_html__('Show Drag', 'apexus'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'condition' => [
                                'layout' => ['3']
                            ]
                        ),
                        array(
                            'name' => 'button_text_drag',
                            'label' => esc_html__('Button Text Drag', 'apexus'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'condition' => [
                                'setting_drag' => 'yes',
                            ]
                        ),
                        array(
                            'name' => 'drag_color',
                            'label' => esc_html__('Drag Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancy-box-carousel #circle-cursor' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'setting_drag' => 'yes',
                            ]
                        ), 
                        array(
                            'name' => 'drag_bg_color',
                            'label' => esc_html__('Drag Background Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancy-box-carousel #circle-cursor' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'setting_drag' => 'yes',
                            ]
                        ), 
                    )
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
                            'layout' => ['3','4','5']
                        ]
                    ),
                    array(
                        'name'  => 'height_box',
                        'label' => esc_html__( 'Height Box', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px','%','custom' ],
                        'range' => [
                            'px' => [
                                'min' => 100,
                                'max' => 700,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-inner' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'layout!' => ['3','4','5','6']
                        ]
                    ),
                    array(
                        'name'  => 'height_box_2',
                        'label' => esc_html__( 'Height Box', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px','%','custom' ],
                        'range' => [
                            'px' => [
                                'min' => 100,
                                'max' => 700,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .pxl-swiper-slider-wrap' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'layout' => ['6']
                        ]
                    ),
                    array(
                        'name' => 'padding_box',
                        'label' => esc_html__('Padding Box', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                        'condition' => [
                            'layout!' => ['4','5','6']
                        ]
                    ),
                    array(
                        'name' => 'border_radius_box',
                        'label' => esc_html__('Border Radius Box', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                        'condition' => [
                            'layout' => '1'
                        ]
                    ),
                    array(
                        'name' => 'box_shadow',
                        'label'        => esc_html__( 'Box Shadow', 'apexus' ),
                        'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                        'control_type' => 'group',
                        'exclude' => [
                            'box_shadow_position',
                        ],
                        'selector' => '{{WRAPPER}} .pxl-fancy-box-carousel .item-inner',
                        'condition' => [
                            'layout' => '5'
                        ]
                    ),
                    array(
                        'name' => 'background_color_box',
                        'label' => esc_html__('Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-inner' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['1','5']
                        ]
                    ),  
                    array(
                        'name' => 'title',
                        'label' => esc_html__('Title', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::HEADING,
                        'condition' => [
                            'layout' => ['5']
                        ]
                    ),
                    array(
                        'name' => 'title_typography',
                        'label' => esc_html__('Title Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-fancy-box-carousel .item-title',
                        'condition' => [
                            'layout!' => '5'
                        ]
                    ),
                    array(
                        'name' => 'title_color',
                        'label' => esc_html__('Title Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-title' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout!' => ['3', '5']
                        ]
                    ), 
                    array(
                        'name' => 'title_color2',
                        'label' => esc_html__('Title Color 1', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-title .title-1' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '3'
                        ]
                    ), 
                    array(
                        'name' => 'title_color3',
                        'label' => esc_html__('Title Color 2', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-title .title-2' => '--heading-color-hover: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '3'
                        ]
                    ), 
                    array(
                        'name' => 'title_hover_color',
                        'label' => esc_html__('Title Hover Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-inner .item-title a:hover' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-title .title-2' => '--heading-color: {{VALUE}};'
                        ],
                        'separator' => 'after',
                        'condition' => [
                            'layout' => ['1','3']
                        ]
                    ), 
                    array(
                        'name' => 'subtitle_typography',
                        'label' => esc_html__('Sub Title Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-fancy-box-carousel .item-subtitle',
                        'condition' => [
                            'layout' => ['1','3', '5','6']
                        ]
                    ),
                    array(
                        'name' => 'subtitle_color',
                        'label' => esc_html__('Sub Title Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-subtitle' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['1','3','5','6']
                        ]
                    ), 
                    array(
                        'name' => 'subtitle_bg_color',
                        'label' => esc_html__('Sub Title Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-subtitle' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['3']
                        ]
                    ), 
                    array(
                        'name' => 'border_color',
                        'label' => esc_html__('Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-subtitle,{{WRAPPER}} .pxl-fancy-box-carousel.layout-6 .item-inner' => 'border-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['1', '6']
                        ]
                    ), 
                    array(
                        'name' => 'des_typography',
                        'label' => esc_html__('Description Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-fancy-box-carousel .item-description, {{WRAPPER}} .pxl-fancy-box-carousel .item-des',
                        'condition' => [
                            'layout!' => ['3','5']
                        ]
                    ),
                    array(
                        'name' => 'des_color',
                        'label' => esc_html__('Description Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-description, {{WRAPPER}} .pxl-fancy-box-carousel .item-des' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout!' => ['3','5']
                        ]
                    ),
                    array(
                        'name' => 'date_color',
                        'label' => esc_html__('Date Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-date' => 'color: {{VALUE}};',
                        ],
                        'separator' => 'before',
                        'condition' => [
                            'layout' => '1'
                        ]
                    ),
                    array(
                        'name' => 'date_bgcolor',
                        'label' => esc_html__('Date Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-date' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ),
                    array(
                        'name' => 'number_color_1',
                        'label' => esc_html__('Number Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-number' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '3'
                        ]
                    ),
                     array(
                        'name' => 'number_bg_color',
                        'label' => esc_html__('Number Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-number' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '3'
                        ]
                    ),
                    array(
                        'name'  => 'icon_font_size',
                        'label' => esc_html__( 'Icon Size', 'apexus' ),
                        'type'  => Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'layout!' => ['4','5','6']
                        ]
                    ),
                    array(
                        'name' => 'icon_color',
                        'label' => esc_html__('Icon Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-icon i' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-icon svg' => 'fill: {{VALUE}};'
                        ],
                        'condition' => [
                            'layout!' => ['3','4','5','6']
                        ]
                    ), 
                    array(
                        'name' => 'icon_color2',
                        'label' => esc_html__('Icon Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-icon svg,{{WRAPPER}} .pxl-fancy-box-carousel.layout-5 .item-button > a svg' => 'color: {{VALUE}};'
                        ],
                        'condition' => [
                            'layout' => ['3','5']
                        ]
                    ), 
                    array(
                        'name' => 'icon_border_color',
                        'label' => esc_html__('Icon Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-icon' => 'border-color: {{VALUE}};'
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ), 
                    array(
                        'name' => 'icon_bg_color',
                        'label' => esc_html__('Icon Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-icon' => 'background: {{VALUE}};'
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]
                    ), 
                    array(
                        'name' => 'button_typography',
                        'label' => esc_html__('Button Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-fancy-box-carousel .item-button > a',
                        'condition' => [
                            'layout' => ['5']
                        ]
                    ),
                    array(
                        'name' => 'button_text_color',
                        'label' => esc_html__('Button Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .pxl-btn.btn-primary,{{WRAPPER}} .pxl-fancy-box-carousel.layout-5 .item-button > a' => 'color: {{VALUE}};'
                        ],
                        'condition' => [
                            'layout' => ['3','5']
                        ]
                    ), 
                    array(
                        'name' => 'button_bg_color',
                        'label' => esc_html__('Button Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .pxl-btn.btn-primary' => 'background-color: {{VALUE}};'
                        ],
                        'condition' => [
                            'layout' => '3'
                        ]
                    ), 
                    array(
                        'name' => 'button_border_color',
                        'label' => esc_html__('Button Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-button > a' => 'border-color: {{VALUE}};'
                        ],
                        'condition' => [
                            'layout' => ['5']
                        ]
                    ), 
                    array(
                        'name' => 'button_border_color_hover',
                        'label' => esc_html__('Button Border Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .item-button > a::before' => 'background-color: {{VALUE}};'
                        ],
                        'condition' => [
                            'layout' => ['5']
                        ]
                    ), 
                    array(
                        'name' => 'bg_color_content',
                        'label' => esc_html__('Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .box-content::after' => 'background-color: {{VALUE}};'
                        ],
                        'condition' => [
                            'layout' => ['6']
                        ]
                    ), 
                    array(
                        'name' => 'padding_content',
                        'label' => esc_html__('Padding Content', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-fancy-box-carousel .box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                        'condition' => [
                            'layout' => ['6']
                        ]
                    ),
                ),
            ],
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_fancy_box_carousel());