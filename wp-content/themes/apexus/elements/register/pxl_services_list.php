<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class Pxl_services_list extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_services_list',
            'title'    => esc_html__('PXL Services List', 'apexus'),
            'icon'     => 'eicon-site-identity',
            'scripts'  => [],
            'styles'   => [''],
            'keywords' => ['apexus', 'services'],
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
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_services_list-1.webp'
                            ],
                            '2' => [
                                'label' => esc_html__( 'Layout 2', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_services_list-2.webp'
                            ],
                            '3' => [
                                'label' => esc_html__( 'Layout 3', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_services_list-3.webp'
                            ],
                            '4' => [
                                'label' => esc_html__( 'Layout 4', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_services_list-4.webp'
                            ],
                            '5' => [
                                'label' => esc_html__( 'Layout 5', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_services_list-5.webp'
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
                        'name' => 'active_list',
                        'label' => esc_html__( 'Active List', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'default' => 2,
                        'condition' => [
                            'layout' => ['2','3','5']
                        ]
                    ),
                    array(
                        'name' => 'button_text',
                        'label' => esc_html__('Button Text', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => esc_html__('Request a Quote', 'apexus' ),
                        'condition' => [
                            'layout' => ['2','3']
                        ]
                    ),
                    array(
                        'name'        => 'hyper_link',
                        'label'       => esc_html__( 'Custom Link', 'apexus' ),
                        'type'        => 'url',
                        'placeholder' => esc_html__( 'https://your-link.com', 'apexus' ),
                        'default'     => [
                            'url'         => '#',
                            'is_external' => 'on'
                        ],
                        'separator' => 'after',
                        'condition' => [
                            'layout' => ['2','3']
                        ]
                    ),
                    array(
                        'name' => 'content_list',
                        'label' => esc_html__('List', 'apexus'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'controls' => array(
                            array(
                                'name' => 'image',
                                'label' => esc_html__('Image', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::MEDIA,
                            ),
                            array(
                                'name' => 'sub_title',
                                'label' => esc_html__('Sub Title', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                                'description' => esc_html__('Use for layout 1,2,3', 'apexus' )
                            ),
                            array(
                                'name' => 'title',
                                'label' => esc_html__('Title', 'apexus'),
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
                                'name' => 'button_text_list',
                                'label' => esc_html__('Button Text', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                                'default' => esc_html__('Read More', 'apexus' ),
                                'description' => esc_html__('Use for layout 3,4', 'apexus' )
                            ),
                            array(
                                'name'        => 'link_list',
                                'label'       => esc_html__( 'Link', 'apexus' ),
                                'type'        => 'url',
                                'placeholder' => esc_html__( 'https://your-link.com', 'apexus' ),
                                'default'     => [
                                    'url'         => '#',
                                    'is_external' => 'on'
                                ],
                                'description' => esc_html__('Use for layout 3,4', 'apexus' )
                            ),
                        ),
                        'default' => [],
                        'title_field' => '{{{ name }}}',
                    ),
                ),
            ],
            [
                'name' => 'section_list_two',
                'label' => esc_html__('Category', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'layout' => '4',
                ],
                'controls' => array(
                    array(
                        'name' => 'boxs',
                        'label' => esc_html__('Item Category', 'apexus'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'controls' => array(
                            array(
                                'name' => 'category' ,
                                'label' => esc_html__('Category', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => 3,
                            ),
                            array(
                                'name' => 'show_in',
                                'label' => esc_html__('Show In Item', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => 1,
                                'description' => 'Example: 1-3-5 corresponds to items 1, 3, 5', 
                            ),
                        ),
                        'title_field' => '{{{ category }}}',
                    ),
                    array(
                        'name' => 'category_typography',
                        'label' => esc_html__('Category Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-services-list .item-inner .category',
                    ), 
                    array(
                        'name' => 'category_color',
                        'label' => esc_html__('Category Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-inner .category' => 'color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name' => 'category_bg_color',
                        'label' => esc_html__('Category Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-inner .category' => 'background-color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name' => 'category_color_hover',
                        'label' => esc_html__('Category Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-inner:hover .category' => 'color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name' => 'category_bg_color_hover',
                        'label' => esc_html__('Category Background Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-inner:hover .category' => 'background-color: {{VALUE}};',
                        ],
                    ), 
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
                            'layout' => ['2','3','4','5']
                        ]
                    ),
                    array(
                        'name' => 'title_color',
                        'label' => esc_html__('Title Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-title' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-services-list.layout-5 .item-title svg' => 'fill: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['1','3','4','5']
                        ]
                    ), 
                    array(
                        'name' => 'title_color_active',
                        'label' => esc_html__('Title Active Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-inner.active .item-title' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['3','5']
                        ]
                    ), 
                    array(
                        'name' => 'title_img_color',
                        'label' => esc_html__('Title Image Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .tit-des .item-title' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['5']
                        ]
                    ), 
                    array(
                        'name' => 'title_typography',
                        'label' => esc_html__('Title Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-services-list .item-title',
                    ), 
                    array(
                        'name' => 'title2_color',
                        'label' => esc_html__('Title Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-title' => '--color1: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['2']
                        ]
                    ), 
                    array(
                        'name' => 'title2_active_color',
                        'label' => esc_html__('Title Active Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-title' => '--color2: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]
                    ), 
                    array(
                        'name' => 'number_color',
                        'label' => esc_html__( 'Number Color', 'apexus' ),
                        'type' => \Elementor\Group_Control_Background::get_type(),
                        'types' => [ 'classic', 'gradient' ],
                        'control_type' => 'group',
                        'exclude' => [ 'image' ],
                        'selector' => '{{WRAPPER}} .pxl-services-list .item-number',
                        'fields_options' => [
                            'background' => [
                                'default' => 'classic',
                            ],
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ), 
                    array(
                        'name' => 'number_typography',
                        'label' => esc_html__('Number Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-services-list .item-number',
                        'condition' => [
                            'layout!' => ['3','5']
                        ]
                    ),
                    array(
                        'name' => 'number2_color',
                        'label' => esc_html__('Number Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-number' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['2','4']
                        ]
                    ), 
                    array(
                        'name' => 'number2_active_color',
                        'label' => esc_html__('Number Active Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-inner.active .item-number,{{WRAPPER}} .pxl-services-list .item-inner.active .number' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]
                    ), 
                    array(
                        'name' => 'number_hover_color',
                        'label' => esc_html__('Number Hover Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-inner:hover .item-number' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '4'
                        ]
                    ), 
                    array(
                        'name' => 'subtitle_color',
                        'label' => esc_html__('Sub Title Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-subtitle' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout!' => ['4','5']
                        ]
                    ), 
                    array(
                        'name' => 'subtitle_typography',
                        'label' => esc_html__('Sub Title Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-services-list .item-subtitle',
                        'condition' => [
                            'layout!' => ['4','5']
                        ]
                    ), 
                    array(
                        'name' => 'subtitle_bg_color',
                        'label' => esc_html__('Sub Title Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-subtitle' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ), 
                    array(
                        'name' => 'button_more_color',
                        'label' => esc_html__('Button More Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .btn-more a' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-services-list .btn-more a span::after' => 'background-color: {{VALUE}};'
                        ],
                        'condition' => [
                            'layout' => ['3']
                        ]
                    ), 
                    array(
                        'name' => 'button_more_icon_color',
                        'label' => esc_html__('Button More Icon Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .btn-more a svg' => 'fill: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['3']
                        ]
                    ), 
                    array(
                        'name' => 'des_typography',
                        'label' => esc_html__('Description Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-services-list .item-description',
                        'condition' => [
                            'layout' => '2'
                        ]
                    ), 
                    array(
                        'name' => 'description_color',
                        'label' => esc_html__('Description Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-description' => 'color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name' => 'description_active_color',
                        'label' => esc_html__('Description Active Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-inner.active .item-description' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '5'
                        ]
                    ),
                    array(
                        'name' => 'description_color_hover',
                        'label' => esc_html__('Description Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-inner:hover .item-description' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '4'
                        ]
                    ), 
                    array(
                        'name' => 'description_img_color',
                        'label' => esc_html__('Description Image Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .tit-des .item-description' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['5']
                        ]
                    ), 
                    array(
                        'name'  => 'maxwidth_des',
                        'label' => esc_html__( 'Max Width Description', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 1000,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-description' => 'max-width: {{SIZE}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name' => 'border_color',
                        'label' => esc_html__('Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-inner + .item-inner,{{WRAPPER}} .pxl-services-list.layout-5 .item-inner' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-services-list .pxl-divider' => 'background-color: {{VALUE}};'
                        ],
                        'condition' => [
                            'layout' => ['2', '3','5']
                        ]
                    ), 
                    array(
                        'name' => 'border_active_color',
                        'label' => esc_html__('Border Active Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .pxl-divider::before' => 'background-color: {{VALUE}};'
                        ],
                        'condition' => [
                            'layout' => ['3']
                        ]
                    ), 
                    array(
                        'name' => 'dot_color',
                        'label' => esc_html__('Dot Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-dot' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['5']
                        ]
                    ), 
                    array(
                        'name' => 'dot_border_color',
                        'label' => esc_html__('Dot Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-dot::before' => 'border-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['5']
                        ]
                    ), 
                    array(
                        'name'  => 'dot_size',
                        'label' => esc_html__( 'Dot Size', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-dot' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'layout' => ['5']
                        ]
                    ),
                    array(
                        'name' => 'dot_icon_color',
                        'label' => esc_html__('Dot Icon Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-dot svg' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['5']
                        ]
                    ),
                    array(
                        'name' => 'button_color',
                        'label' => esc_html__('Button Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .btn-third .pxl-button-text, {{WRAPPER}} .pxl-services-list .btn-fourth' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['2','3','4']
                        ]
                    ), 
                    array(
                        'name' => 'button_bg_color',
                        'label' => esc_html__('Button Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .btn-third:before, {{WRAPPER}} .pxl-services-list .btn-fourth' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['2','3','4']
                        ]
                    ), 
                    array(
                        'name' => 'button_color_hover',
                        'label' => esc_html__('Button Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .btn-fourth:hover' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['4']
                        ]
                    ), 
                    array(
                        'name' => 'button_bg_color_hover',
                        'label' => esc_html__('Button Background Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .btn-fourth:hover,{{WRAPPER}} .pxl-services-list .btn-fourth:before' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['4']
                        ]
                    ), 
                    array(
                        'name' => 'button_border_color',
                        'label' => esc_html__('Button Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .btn-third' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [    
                            'layout' => ['2','3']
                        ]
                    ), 
                    array(
                        'name' => 'icon_arrow_color',
                        'label' => esc_html__('Icon Arrow Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .box-content::after' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['4']
                        ]
                    ), 
                    array(
                        'name' => 'bg_color_content',
                        'label' => esc_html__('Background Color Content', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .box-content::before' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['4']
                        ]
                    ), 
                    array(
                        'name' => 'bg_color_content_hover',
                        'label' => esc_html__('Background Color Content Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-inner:hover .box-content::before' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['4']
                        ]
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
                            '{{WRAPPER}} .pxl-services-list.layout-1 .item-inner,{{WRAPPER}} .pxl-services-list.layout-3 .item-inner + .item-inner,{{WRAPPER}} .pxl-services-list.layout-4 .item-inner + .item-inner,
                            {{WRAPPER}} .pxl-services-list.layout-5 .item-inner + .item-inner' => 'margin-top: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-services-list.layout-2 .item-inner + .item-inner' => 'padding-top: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-services-list.layout-2 .item-title' => 'padding-bottom: {{SIZE}}{{UNIT}};'
                        ],
                    ),
                    array(
                        'name' => 'bg_color_box',
                        'label' => esc_html__('Background Color Box', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list .item-image,{{WRAPPER}} .pxl-services-list .box-content,{{WRAPPER}} .pxl-services-list.layout-4 .box-image' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => ['1','4']
                        ]
                    ), 
                    array(
                        'name' => 'btn_padding',
                        'label' => esc_html__('Padding', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-list.layout-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                        'condition' => [
                            'layout' => '2'
                        ]
                    ),
                ),
            ],
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_services_list());