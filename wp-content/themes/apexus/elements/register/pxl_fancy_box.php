<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
class Pxl_Fancy_Box extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_fancy_box',
            'title'    => esc_html__('PXL Fancy Box', 'apexus'),
            'icon'     => 'eicon-icon-box',
            'scripts'  => [
                'gsap',
                'scroll-trigger',
            ],
            'styles'   => [],
            'keywords' => ['apexus', 'accordion'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        return[
            array(
                'name'     => 'layout_section',
                'label'    => esc_html__( 'Layout', 'apexus' ),
                'tab'      => 'layout',
                'controls' => array(
                    array(
                        'name'    => 'layout',
                        'label'   => esc_html__( 'Templates', 'apexus' ),
                        'type'    => 'layoutcontrol',
                        'default' => '1',
                        'options' => [
                            '1' => [
                                'label' => esc_html__( 'Layout 1', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_fancy_box-1.webp'
                            ],
                            '2' => [
                                'label' => esc_html__( 'Layout 2', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_fancy_box-2.webp'
                            ],
                            '3' => [
                                'label' => esc_html__( 'Layout 3', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_fancy_box-3.webp'
                            ],
                        ]
                    )
                )
            ),
            array(
                'name'     => 'content_section',
                'label'    => esc_html__( 'Content', 'apexus' ),
                'tab'      => 'content',
                'controls' => array(
                    array(
                        'name'             => 'selected_icon',
                        'label'            => esc_html__( 'Icon', 'apexus' ),
                        'type'             => 'icons',
                        'condition' => [
                            'layout' => ['1']
                        ],
                    ),
                    array(
                        'name' => 'image',
                        'label' => esc_html__('Image', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'condition' => [
                            'layout' => ['2','3']
                        ],
                    ),
                    array(
                        'name'     => 'title',
                        'label'    => esc_html__('Title', 'apexus'),
                        'type'     => 'textarea',
                        'default'  => esc_html__('Your Title', 'apexus')
                    ),
                    array(
                        'name'     => 'desc',
                        'label'    => esc_html__('Description', 'apexus'),
                        'type'     => 'textarea',
                        'default'  => esc_html__('We use the latest technologies it voluptatem accusantium do loremque laudantium.', 'apexus'),
                    ),
                    array(
                        'name' => 'boxs',
                        'label' => esc_html__('Category', 'apexus'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'default' => [],
                        'condition' => [
                            'layout' => ['2']
                        ],
                        'controls' => array(
                            array(
                                'name' => 'category',
                                'label' => esc_html__('Category', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                            ),
                        ),
                        'title_field' => '{{{ category }}}',
                    ),
                    array(
                        'name'     => 'button_text',
                        'label'    => esc_html__('Button Text', 'apexus'),
                        'type'     => 'text',
                        'default'  => esc_html__('View Detail', 'apexus'),
                        'label_block' => true,
                        'condition' => [
                            'layout' => '2'
                        ]
                    ),
                    array(
                        'name'        => 'hyper_link',
                        'label'       => esc_html__( 'Custom Link', 'apexus' ),
                        'type'        => 'url',
                        'placeholder' => esc_html__( 'https://your-link.com', 'apexus' ),
                        'default'     => [
                            'url'         => '',
                            'is_external' => 'on'
                        ],
                    ),
                )
            ),
            array(
                'name'     => 'style_section',
                'label'    => esc_html__( 'Style', 'apexus' ),
                'tab'      => 'style',
                'controls' => array_merge(
                    array(
                        array(
                            'name' => 'text_align',
                            'label' => esc_html__( 'Alignment', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
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
                            'default'      => 'start',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .pxl-fancybox-content' => 'align-items: {{VALUE}}; text-align: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['1','3']
                            ]
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .title' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-fancybox-wrap.layout-2 .title > a' => 'background-image: linear-gradient(transparent calc(100% - 1px), {{VALUE}} 1px);'
                            ],
                        ),
                        array(
                            'name' => 'title_hover_color',
                            'label' => esc_html__('title Hover Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .pxl-fancybox-content:hover .title' => 'color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => ['1','3']
                            ]
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'apexus' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-fancybox-wrap .title',
                        ),
                        array(
                            'name'       => 'max_width_title',
                            'label'      => esc_html__( 'Max Width Title', 'apexus' ),
                            'type'       => Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px', '%'],
                            'range'      => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 700,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .title' => 'max-width: {{SIZE}}{{UNIT}};'
                            ],
                            'condition' => [
                                'layout' => '3'
                            ]
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .item-icon svg' => 'fill: {{VALUE}};',
                                '{{WRAPPER}} .pxl-fancybox-wrap .item-icon i' => 'color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => '1'
                            ]
                        ),
                        array(
                            'name' => 'icon_color_hover',
                            'label' => esc_html__('Icon Color Hover', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .pxl-fancybox-content:hover .item-icon svg' => 'fill: {{VALUE}};',
                                '{{WRAPPER}} .pxl-fancybox-wrap .pxl-fancybox-content:hover .item-icon i' => 'color: {{VALUE}};'
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
                                '{{WRAPPER}} .pxl-fancybox-wrap .item-icon' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '1'
                            ]
                        ),
                        array(
                            'name' => 'icon_bg_color_hover',
                            'label' => esc_html__('Icon Background Color Hover', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .pxl-fancybox-content:hover .item-icon' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '1'
                            ]
                        ),
                        array(
                            'name'       => 'icon_font_size',
                            'label'      => esc_html__( 'Icon Size', 'apexus' ),
                            'type'       => Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range'      => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 200,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .item-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-fancybox-wrap .item-icon i' => 'font-size: {{SIZE}}{{UNIT}};'
                            ],
                            'condition' => [
                                'layout' => '1'
                            ]
                        ),
                        array(
                            'name' => 'desc_color',
                            'label' => esc_html__('Description Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .desc' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'desc_hover_color',
                            'label' => esc_html__('Description Hover Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .pxl-fancybox-content:hover .desc' => 'color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => ['1','3']
                            ]
                        ), 
                        array(
                            'name' => 'desc_typography',
                            'label' => esc_html__('Description Typography', 'apexus' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-fancybox-wrap .desc',
                        ),
                        array(
                            'name'       => 'max_width_des',
                            'label'      => esc_html__( 'Max Width Description', 'apexus' ),
                            'type'       => Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px', '%'],
                            'range'      => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 700,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .desc' => 'max-width: {{SIZE}}{{UNIT}};'
                            ],
                        ),
                        array(
                            'name' => 'category_color',
                            'label' => esc_html__('Category Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .item-category .category' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'category_bg_color',
                            'label' => esc_html__('Category Background Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .item-category .category' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'button_color',
                            'label' => esc_html__('Button Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .button-more#circle-cursor' => 'color: {{VALUE}};',
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
                                '{{WRAPPER}} .pxl-fancybox-wrap .button-more#circle-cursor' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'background_color',
                            'label' => esc_html__('Background Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .pxl-fancybox-content' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '1'
                            ]
                        ),
                        array(
                            'name' => 'background_color_hover',
                            'label' => esc_html__('Background Color Hover', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .pxl-fancybox-content::before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-fancybox-wrap.layout-2 .box-image:hover .item-image' => 'border-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout!' => ['3']
                            ]
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__('Border Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .item-image::before,{{WRAPPER}} .pxl-fancybox-wrap.layout-3 .pxl-fancybox-content' => 'border-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['2', '3']
                            ]
                        ),
                        array(
                            'name' => 'border_color_hover',
                            'label' => esc_html__('Border Color Hover', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .pxl-fancybox-content:hover' => 'border-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['3']
                            ]
                        ),
                        array(
                            'name' => 'color_shadow_box',
                            'label' => esc_html__('Color Shadow Box', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .pxl-fancybox-content' => '--color-shadow: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '1'
                            ]
                        ),
                        array(
                            'name'       => 'height_box',
                            'label'      => esc_html__( 'Height Box', 'apexus' ),
                            'type'       => Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => ['px'],
                            'range'      => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .pxl-fancybox-content' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => '1'
                            ]
                        ),
                        array(
                            'name' => 'padding_box',
                            'label' => esc_html__('Padding Box', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancybox-wrap .pxl-fancybox-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout' => ['1','3']
                            ]
                        ),
                    )
                )
            ),
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Fancy_Box());