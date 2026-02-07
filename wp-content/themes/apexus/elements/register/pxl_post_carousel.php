<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class Pxl_Post_Carousel extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_post_carousel',
            'title'    => esc_html__('PXL Post Carousel', 'apexus'),
            'icon'     => 'eicon-posts-carousel',
            'scripts'    => [
            	'swiper',
                'apexus-swiper',
	        ],
            'styles'   => [],
            'keywords' => ['apexus', 'post carousel', 'carousel'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
    	$pt_supports = ['post'];
        return [
            array(
                'name'     => 'layout_section',
                'label'    => esc_html__( 'Layout', 'apexus' ),
                'tab'      => 'layout',
                'controls' => array_merge(
                    array(
                        array(
                            'name'     => 'post_type',
                            'label'    => esc_html__( 'Select Post Type', 'apexus' ),
                            'type'     => 'select',
                            'multiple' => true,
                            'options'  => apexus_get_post_type_options($pt_supports),
                            'default'  => 'post'
                        ) 
                    ),
                    apexus_get_post_carousel_layout($pt_supports)
                ),
            ),
            array(
                'name' => 'source_section',
                'label' => esc_html__('Source', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array_merge(
                    array(
                        array(
                            'name'     => 'select_post_by',
                            'label'    => esc_html__( 'Select posts by', 'apexus' ),
                            'type'     => 'select',
                            'multiple' => true,
                            'options'  => [
                                'term_selected' => esc_html__( 'Terms selected', 'apexus' ),
                                'post_selected' => esc_html__( 'Posts selected ', 'apexus' ),
                            ],
                            'default'  => 'term_selected'
                        ) 
                    ),
                    apexus_get_term_by_post_type($pt_supports, ['custom_condition' => ['select_post_by' => 'term_selected']]),
                    apexus_get_ids_by_post_type($pt_supports, ['custom_condition' => ['select_post_by' => 'post_selected']]),
                    apexus_get_ids_unselected_by_post_type($pt_supports, ['custom_condition' => ['select_post_by' => 'term_selected']]),
                    array(
                        array(
                            'name'    => 'orderby',
                            'label'   => esc_html__('Order By', 'apexus' ),
                            'type'    => \Elementor\Controls_Manager::SELECT,
                            'default' => 'date',
                            'options' => [
                                'date'   => esc_html__('Date', 'apexus' ),
                                'ID'     => esc_html__('ID', 'apexus' ),
                                'author' => esc_html__('Author', 'apexus' ),
                                'title'  => esc_html__('Title', 'apexus' ),
                                'rand'   => esc_html__('Random', 'apexus' ),
                            ],
                        ),
                        array(
                            'name'    => 'order',
                            'label'   => esc_html__('Sort Order', 'apexus' ),
                            'type'    => \Elementor\Controls_Manager::SELECT,
                            'default' => 'desc',
                            'options' => [
                                'desc' => esc_html__('Descending', 'apexus' ),
                                'asc'  => esc_html__('Ascending', 'apexus' ),
                            ],
                        ),
                        array(
                            'name'    => 'limit',
                            'label'   => esc_html__('Total items', 'apexus' ),
                            'type'    => \Elementor\Controls_Manager::NUMBER,
                            'default' => '6',
                        ),
                    )
                ),
            ),
            array(
                'name' => 'general_section',
                'label' => esc_html__('General Settings', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array_merge(
                    array(
                        array(
                            'name'        => 'img_size',
                            'label'       => esc_html__('Image Size', 'apexus' ),
                            'type'        => \Elementor\Controls_Manager::TEXT,
                            'description' =>  esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).', 'apexus'),
                        ),
                        array(
                            'name'  => 'filter_alignment',
                            'label' => esc_html__( 'Filter Horizontal Alignment', 'apexus' ),
                            'type'  => \Elementor\Controls_Manager::CHOOSE,
                            'options' => [
                                'start' => [
                                    'title' => esc_html__( 'Start', 'apexus' ),
                                    'icon' => 'eicon-h-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'apexus' ),
                                    'icon' => 'eicon-h-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__( 'End', 'apexus' ),
                                    'icon' => 'eicon-h-align-right',
                                ],
                            ],
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .swiper-filter-wrap' => 'justify-content: {{VALUE}};',
                            ],
                            'condition' => [
                                'select_post_by' => 'term_selected',
                                'filter'         => 'true',
                            ],
                        ),  
                        array(
                            'name'      => 'filter_default_title',
                            'label'     => esc_html__('Filter Default Title', 'apexus' ),
                            'type'      => \Elementor\Controls_Manager::TEXT,
                            'default'   => esc_html__('All', 'apexus' ),
                            'condition' => [
                                'select_post_by' => 'term_selected',
                                'filter'         => 'true',
                            ],
                        ),
                        array(
                            'name'      => 'filter_item_column_gap',
                            'label' => esc_html__( 'Filter Items Gap', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                            'range' => [
                                'px' => [
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .swiper-filter-wrap' => 'column-gap: {{SIZE}}{{UNIT}}',
                            ],
                            'condition' => [
                                'select_post_by' => 'term_selected',
                                'filter'         => 'true',
                            ],
                        ), 

                        array(
                            'name'      => 'filter_color',
                            'label'     => esc_html__('Filter Color', 'apexus' ),
                            'type'      => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .swiper-filter-wrap .filter-item' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'select_post_by' => 'term_selected',
                                'filter'         => 'true',
                            ],
                        ),  
                        array(
                            'name'      => 'filter_color_hover',
                            'label'     => esc_html__('Filter Color Hover', 'apexus' ),
                            'type'      => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .swiper-filter-wrap .filter-item.active, {{WRAPPER}} .swiper-filter-wrap .filter-item:hover' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'select_post_by' => 'term_selected',
                                'filter'         => 'true',
                            ],
                        ), 
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
            ),
            array(
                'name' => 'carousel_setting',
                'label' => esc_html__('Carousel Settings', 'apexus'),
                'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                'controls' => array_merge(
                    apexus_carousel_settings()
                ),
            ),
            array(
                'name' => 'section_arrows_settings',
                'label' => esc_html__('Arrows Settings', 'apexus'),
                'tab'      => \Elementor\Controls_Manager::TAB_SETTINGS,
                'controls' => array_merge(
                    apexus_carousel_arrow_settings()   
                )
            ),
            array(
                'name' => 'section_dots_settings',
                'label' => esc_html__('Dots Settings', 'apexus'),
                'tab'      => \Elementor\Controls_Manager::TAB_SETTINGS,
                'controls' => array_merge(
                    apexus_carousel_dots_settings()
                )
            ),
            array(
                'name'     => 'display_section',
                'label'    => esc_html__('Display Items Options', 'apexus' ),
                'tab'      => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array(
                    array(
                        'name'      => 'show_date',
                        'label'     => esc_html__('Show Date', 'apexus' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'return_value' => '1',
                        'default' => '1',
                        'condition' => [
                            'post_type' => ['post'],
                        ]
                    ),
                    array(
                        'name'      => 'show_excerpt',
                        'label'     => esc_html__('Show Excerpt', 'apexus' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'return_value' => '1',
                        'default' => '1',
                        'condition' => [
                            'post_type' => ['post'],
                            'layout_post' => ['post-2']
                        ]
                    ),
                    array(
                        'name'      => 'num_words',
                        'label'     => esc_html__('Number of Words', 'apexus' ),
                        'type'      => \Elementor\Controls_Manager::NUMBER,
                        'condition' => [
                            'show_excerpt' => '1',
                            'layout_post' => ['post-2']
                        ],
                    ),
                    array(
                        'name'      => 'show_author',
                        'label'     => esc_html__('Show Author', 'apexus' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'return_value' => '1',
                        'default' => '1',
                        'condition' => [
                            'post_type' => ['post'],
                            'layout_post' => ['post-1']
                        ]
                    ),
                ),
            ),
            array(
                'name'     => 'style_section',
                'label'    => esc_html__('Style', 'apexus' ),
                'tab'      => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array(
                    array(
                        'name'      => 'title_color',
                        'label'     => esc_html__('Title Color', 'apexus' ),
                        'type'      => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-carousel .item-title,{{WRAPPER}} .pxl-post-carousel .item-title >a' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-post-carousel .item-title a' => 'background-image: linear-gradient(transparent calc(100% - 1px), {{VALUE}} 1px);',
                        ],
                    ),
                    array(
                        'name'         => 'title_typo',
                        'label'        => esc_html__('Title Typography', 'apexus' ),
                        'type'         => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector'     => '{{WRAPPER}} .pxl-post-carousel .item-title',
                    ),
                    array(
                        'name'      => 'date_color',
                        'label'     => esc_html__('Date Color', 'apexus' ),
                        'type'      => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-carousel .item-date .month-year, {{WRAPPER}} .pxl-post-carousel.layout-post-2 .month-year .date' => 'color: {{VALUE}};',
                        ],
                        'separator' => 'before',
                    ),
                    array(
                        'name'         => 'date_typo',
                        'label'        => esc_html__('Date Typography', 'apexus' ),
                        'type'         => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector'     => '{{WRAPPER}} .pxl-post-carousel .item-date .month-year,{{WRAPPER}} .pxl-post-carousel.layout-post-2 .month-year .date',
                    ),
                    array(
                        'name'      => 'year_color',
                        'label'     => esc_html__('Year Color', 'apexus' ),
                        'type'      => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-carousel .month-year .year' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => ['post'],
                            'layout_post' => ['post-2']
                        ]
                    ),
                    array(
                        'name' => 'max_width_year',
                        'label' => esc_html__('Max Width Year', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 300,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-carousel .month-year .year' => 'max-width: {{SIZE}}{{UNIT}};'
                        ],
                        'condition' => [
                            'post_type' => ['post'],
                            'layout_post' => ['post-2']
                        ]
                    ),
                    array(
                        'name'      => 'icon_date_color',
                        'label'     => esc_html__('Icon Date Color', 'apexus' ),
                        'type'      => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-carousel .item-date svg' => 'fill: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => ['post'],
                            'layout_post' => ['post-1']
                        ]
                    ),
                    array(
                        'name'      => 'author_color',
                        'label'     => esc_html__('Author Color', 'apexus' ),
                        'type'      => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-carousel .meta-item .name a' => 'color: {{VALUE}};',
                        ],
                        'separator' => 'before',
                        'condition' => [
                            'post_type' => ['post'],
                            'layout_post' => ['post-1']
                        ]
                    ),
                    array(
                        'name'         => 'author_typo',
                        'label'        => esc_html__('Author Typography', 'apexus' ),
                        'type'         => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector'     => '{{WRAPPER}} .pxl-post-carousel .meta-item .name',
                        'condition' => [
                            'post_type' => ['post'],
                            'layout_post' => ['post-1']
                        ]
                    ),
                    array(
                        'name'      => 'role_color',
                        'label'     => esc_html__('Role Color', 'apexus' ),
                        'type'      => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-carousel .meta-item .role' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => ['post'],
                            'layout_post' => ['post-1']
                        ]
                    ),
                    array(
                        'name'         => 'role_typo',
                        'label'        => esc_html__('Role Typography', 'apexus' ),
                        'type'         => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector'     => '{{WRAPPER}} .pxl-post-carousel .meta-item .role',
                        'condition' => [
                            'post_type' => ['post'],
                            'layout_post' => ['post-1']
                        ]
                    ),
                    array(
                        'name'      => 'border_color',
                        'label'     => esc_html__('Border Color', 'apexus' ),
                        'type'      => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-carousel .item-inner-wrap' => 'border-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => ['post'],
                            'layout_post' => ['post-1']
                        ]
                    ),
                    array(
                        'name'      => 'excerpt_color',
                        'label'     => esc_html__('Excerpt Color', 'apexus' ),
                        'type'      => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            ' {{WRAPPER}} .pxl-post-carousel .item-excerpt' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => ['post'],
                            'layout_post' => ['post-2']
                        ]
                    ),
                    array(
                        'name' => 'space_inline',
                        'label' => esc_html__('Space Item', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-carousel .pxl-swiper-slide' => '--pxl-spacing-inline: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'post_type' => ['post'],
                            'layout_post' => ['post-1']
                        ]
                    ),
                    array(
                        'name' => 'height_item',
                        'label' => esc_html__('Height Item', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px','%','custom' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 1000,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-carousel .item-inner-wrap' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'post_type' => ['post'],
                            'layout_post' => ['post-1']
                        ]
                    ),
                ),
            ),
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Post_Carousel());