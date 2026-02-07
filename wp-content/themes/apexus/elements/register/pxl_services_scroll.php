<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class Pxl_services_scroll extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_services_scroll',
            'title'    => esc_html__('PXL Services Scroll', 'apexus'),
            'icon'     => 'eicon-post-list',
            'scripts'  => [],
            'styles'   => [''],
            'keywords' => ['apexus', 'services scroll'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        $templates = apexus_get_templates_option('tab', []) ;
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
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_services_scroll-1.webp'
                            ],
                            '2' => [
                                'label' => esc_html__( 'Layout 2', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_services_scroll-2.webp'
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
                        'name' => 'subtitle',
                        'label' => esc_html__('Sub Title', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'rows' => 5,
                        'condition' => [
                            'layout' => '2'
                        ]
                    ),
                    array(
                        'name' => 'content_list',
                        'label' => esc_html__('List', 'apexus'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'controls' => array(
                            array(
                                'name'             => 'selected_icon',
                                'label'            => esc_html__( 'Icon', 'apexus' ),
                                'type'             => 'icons',
                                'description'      => esc_html__( 'Use for layout 2', 'apexus' ),
                            ),
                            array(
                                'name' => 'image',
                                'label' => esc_html__('Image', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::MEDIA,
                                'description'      => esc_html__( 'Use for layout 1', 'apexus' ),
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
                                'name' => 'content_template',
                                'label' => esc_html__('Select Templates', 'apexus'),
                                'description'        => sprintf(esc_html__('Use for layout 2,Please create your layout before choosing. %sClick Here%s','apexus'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => '',
                                'options' => $templates,
                            ),
                        ),
                        'default' => [],
                        'title_field' => '{{{ name }}}',
                    ),
                ),
            ],
            [
                'name' => 'style_section',
                'label' => esc_html__('Style', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array(
                    array(
                        'name' => 'title_color',
                        'label' => esc_html__('Title Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .item-title' => '--heading-color-1: {{VALUE}};',
                            '{{WRAPPER}} .pxl-services-scroll.layout-2 .item-title' => 'color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name' => 'title_color_hover',
                        'label' => esc_html__('Title Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .item-title' => '--heading-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ), 
                    array(
                        'name' => 'title_typography',
                        'label' => esc_html__('Title Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-services-scroll .item-title',
                    ), 
                     array(
                        'name' => 'subtitle_color',
                        'label' => esc_html__('Sub Title Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .item-subtitle' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]
                    ), 
                    array(
                        'name' => 'subtitle_typography',
                        'label' => esc_html__('Sub Title Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-services-scroll .item-subtitle',
                        'condition' => [
                            'layout' => '2'
                        ]
                    ),
                    array(
                        'name' => 'description_color',
                        'label' => esc_html__('Description Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .item-description' => '--heading-color-1: {{VALUE}};',
                            '{{WRAPPER}} .pxl-services-scroll.layout-2 .item-description' => 'color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name' => 'description_color_hover',
                        'label' => esc_html__('Description Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .item-description' => '--heading-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ), 
                    array(
                        'name' => 'icon_des_color',
                        'label' => esc_html__('Icon Description Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .item-description svg' => 'color: {{VALUE}};'
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]
                    ), 
                    array(
                        'name' => 'des_border_color',
                        'label' => esc_html__('Description Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .item-description' => 'border-color: {{VALUE}};'
                        ],
                        'condition' => [
                            'layout' => '2'
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
                            '{{WRAPPER}} .pxl-services-scroll .item-description' => 'max-width: {{SIZE}}{{UNIT}};',
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
                            '{{WRAPPER}} .pxl-services-scroll .item-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-services-scroll .item-icon i' => 'font-size: {{SIZE}}{{UNIT}};'
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]
                    ),
                    array(
                        'name' => 'icon_color',
                        'label' => esc_html__('Icon Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .title-icon i' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-services-scroll.layout-2  .item-icon svg' => 'fill: {{VALUE}};'
                        ],
                    ), 
                    array(
                        'name' => 'icon_color_hover',
                        'label' => esc_html__('Icon Color hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .title-icon i' => '--primary-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ), 
                    array(
                        'name' => 'background_icon',
                        'label' => esc_html__('Icon Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .item-icon' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]
                    ),
                    array(
                        'name' => 'number_color',
                        'label' => esc_html__('Number Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .item-number' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'border_color',
                        'label' => esc_html__('Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .progress-bar:before' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'border_color_active',
                        'label' => esc_html__('Border Color Active', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .progress-bar:after' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'offset_fix',
                        'label' => esc_html__('Space Item', 'apexus'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 1000,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                            'size' => 202,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .item-inner + .item-inner' => 'padding-top: {{SIZE}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name' => 'height_border',
                        'label' => esc_html__('Height Border', 'apexus'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px'],
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 1000,
                            ],
                        ],
                        'description' => esc_html__('Default (calc(100% + XXXpx))', 'apexus'),
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .item-inner:last-child' => '--space-last: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ),
                    array(
                        'name' => 'max_height_content',
                        'label' => esc_html__('Max Height Content', 'apexus'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => ['px','%'],
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 1000,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .scroll-1' => 'max-height: {{SIZE}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name' => 'image_color',
                        'label' => esc_html__('Image Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-services-scroll .svg-scroll' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ),
                ),
            ],
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_services_scroll());