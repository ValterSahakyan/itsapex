<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class Pxl_Testimonial_Carousel extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_testimonial_carousel',
            'title'    => esc_html__('PXL Testimonial Carousel', 'apexus'),
            'icon'     => 'eicon-blockquote',
            'scripts'  => [
                'swiper',
                'apexus-swiper',
            ],
            'styles'   => ['swiper'],
            'keywords' => ['apexus', 'testimonial'],
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
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_testimonial_carousel-1.webp'
                            ],
                            '2' => [
                                'label' => esc_html__( 'Layout 2', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_testimonial_carousel-2.webp'
                            ],
                            '3' => [
                                'label' => esc_html__( 'Layout 3', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_testimonial_carousel-3.webp'
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
                        'name' => 'title',
                        'label' => esc_html__('Title', 'apexus'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Testimonials', 'apexus'),
                        'label_block' => true,
                        'condition' => [
                            'layout' => '2'
                        ]
                    ),
                    array(
                        'name' => 'selected_icon',
                        'label' => esc_html__('Quote Icon', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        'fa4compatibility' => 'icon',  
                        'condition' => [
                            'layout' => ['2','3']
                        ]                        
                    ),
                    array(
                        'name'  => 'quote_size',
                        'label' => esc_html__( 'Quote Size', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'size' => '',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-carousel .icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-testimonial-carousel .icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};'
                        ],
                        'condition' => [
                            'layout' => ['2','3']
                        ]
                    ),
                    array(
                        'name' => 'quote_color',
                        'label' => esc_html__('Quote Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-carousel .icon-wrapper svg' => 'fill: {{VALUE}};',
                            '{{WRAPPER}} .pxl-testimonial-carousel .icon-wrapper i' => 'color: {{VALUE}};'
                        ],
                        'condition' => [
                            'layout' => ['2','3']
                        ]
                    ), 
                    array(
                        'name' => 'content_list',
                        'label' => esc_html__('Testimonial List', 'apexus'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'controls' => array(
                            array(
                                'name' => 'logo_image',
                                'label' => esc_html__('Logo', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::MEDIA,
                                'description' => esc_html__('Use for layout 1', 'apexus' )
                            ),
                            array(
                                'name' => 'image',
                                'label' => esc_html__('Image', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::MEDIA,
                                'description' => esc_html__('Use for layout 1, 2', 'apexus' )
                            ),
                            array(
                                'name' => 'name',
                                'label' => esc_html__('Name', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'position',
                                'label' => esc_html__('Positon', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'description',
                                'label' => esc_html__('Description', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'rows' => 10,
                            ),
                            array(
                                'name' => 'button_text',
                                'label' => esc_html__('Button Text', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                                'default' => esc_html__('Read Case Study', 'apexus'),
                                'description' => esc_html__('Button Use for layout 1', 'apexus' )
                            ),
                            array(
                                'name'        => 'link_button',
                                'label'       => esc_html__( 'Link', 'apexus' ),
                                'type'        => 'url',
                                'default' => [
                                    'url' => '#',
                                ],
                                'label_block' => true,
                                'description' => esc_html__('Button Use for layout 1, 2', 'apexus' )
                            ),
                            array(
                                'name' => 'rating',
                                'label' => esc_html__('Rating', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => 'none',
                                'options' => [
                                    'none' => esc_html__('None', 'apexus' ),
                                    'star1' => esc_html__('1 Star', 'apexus' ),
                                    'star2' => esc_html__('2 Star', 'apexus' ),
                                    'star3' => esc_html__('3 Star', 'apexus' ),
                                    'star4' => esc_html__('4 Star', 'apexus' ),
                                    'star5' => esc_html__('5 Star', 'apexus' ),
                                ],
                                'description' => esc_html__('Button Use for layout 1, 2', 'apexus' )
                            ),
                        ),
                        'default' => [],
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
                        'name' => 'title_color',
                        'label' => esc_html__('Name Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-carousel .thumbs-name,{{WRAPPER}} .pxl-testimonial-carousel.layout-3 .item-name' => 'color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name' => 'title_typography',
                        'label' => esc_html__('Name Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .thumbs-name, {{WRAPPER}} .pxl-testimonial-carousel.layout-3 .name-position',
                    ), 
                    array(
                        'name' => 'title_color2',
                        'label' => esc_html__('Title Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-carousel .item-title' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]  
                    ), 
                    array(
                        'name' => 'title_bg_color2',
                        'label' => esc_html__('Title Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-carousel .item-title' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]  
                    ), 
                    array(
                        'name' => 'position_color',
                        'label' => esc_html__('Position Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-carousel .thumbs-position,{{WRAPPER}} .pxl-testimonial-carousel.layout-3 .item-position' => 'color: {{VALUE}};',
                        ],

                    ),
                    array(
                        'name' => 'description_color',
                        'label' => esc_html__('Description Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-carousel .item-description' => 'color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name' => 'desc_typography',
                        'label' => esc_html__('Description Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .item-description',
                    ),
                    array(
                        'name'  => 'max_width_des',
                        'label' => esc_html__( 'Max Width Description', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 100,
                                'max' => 1000,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-carousel .item-description' => 'max-width: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'layout' => '3'
                        ] 
                    ), 
                    array(
                        'name'  => 'star_size',
                        'label' => esc_html__( 'Star Size', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'size' => '',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-carousel .item-rating i' => 'font-size: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'layout!' => '3'
                        ] 
                    ), 
                    array(
                        'name' => 'star_color',
                        'label' => esc_html__('Star Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-carousel .item-rating i' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout!' => '3'
                        ] 

                    ),
                    array(
                        'name' => 'button_color',
                        'label' => esc_html__('Button Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-carousel .btn-primary' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-testimonial-carousel.layout-2 .btn-audio svg' => 'fill: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout!' => '3'
                        ] 
                    ),
                    array(
                        'name' => 'button_bg_color',
                        'label' => esc_html__('Button Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-carousel .btn-primary' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ),
                    array(
                        'name' => 'background_color_content',
                        'label' => esc_html__('Background Color Content', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-carousel .pxl-swiper-slider-wrap .pxl-swiper-container' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout!' => '3'
                        ] 

                    ),
                    array(
                        'name' => 'background_color_box',
                        'label' => esc_html__('Background Color Box', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-carousel.layout-1' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ),
                    array(
                        'name' => 'border_color_box',
                        'label' => esc_html__('Border Color Box', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-carousel.layout-2' => 'border-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]
                    ),
                    array(
                        'name' => 'background_color_box2',
                        'label' => esc_html__( 'Background Color Box', 'apexus' ),
                        'type' => \Elementor\Group_Control_Background::get_type(),
                        'types' => [ 'classic', 'gradient' ],
                        'control_type' => 'group',
                        'exclude' => [ 'image' ],
                        'selector' => '{{WRAPPER}} .pxl-testimonial-carousel.layout-2',
                        'fields_options' => [
                            'background' => [
                                'default' => 'gradient',
                            ],
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]
                    ),
                    array(
                        'name' => 'divider_color',
                        'label' => esc_html__('Divider Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-carousel .pxl-divider' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '3'
                        ]
                    ),
                ),
            ],
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Testimonial_Carousel());