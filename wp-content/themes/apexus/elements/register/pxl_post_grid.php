<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
class Pxl_Post_Grid extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_post_grid',
            'title'    => esc_html__('PXL Post Grid', 'apexus'),
            'icon'     => 'eicon-posts-grid',
            'scripts'    => [
	            'apexus-post-grid',
	        ],
            'styles'   => [],
            'keywords' => ['apexus', 'post grid', 'grid'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }

    public function get_params(){
    	$pt_supports = ['post','portfolio'];
        return [
            [
                'name'     => 'layout_section',
                'label'    => esc_html__( 'Layout', 'apexus' ),
                'tab'      => 'layout',
                'controls' => array_merge(
                    array(
                        array(
                            'name'     => 'post_type',
                            'label'    => esc_html__( 'Select Post Type', 'apexus' ),
                            'type'     => Controls_Manager::SELECT,
                            'multiple' => true,
                            'options'  => apexus_get_post_type_options($pt_supports),
                            'default'  => 'post'
                        ) 
                    ),
                    apexus_get_post_grid_layout($pt_supports)
                ),
            ],
            [
            	'name'     => 'source_section',
                'label'    => esc_html__( 'Source', 'apexus' ),
                'tab' => 'content',
                'controls' => array_merge(
                    array(
                        array(
                            'name'     => 'select_post_by',
                            'label'    => esc_html__( 'Select posts by', 'apexus' ),
                            'type'     => Controls_Manager::SELECT,
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
                            'type'    => Controls_Manager::SELECT,
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
                            'type'    => Controls_Manager::SELECT,
                            'default' => 'desc',
                            'options' => [
                                'desc' => esc_html__('Descending', 'apexus' ),
                                'asc'  => esc_html__('Ascending', 'apexus' ),
                            ],
                        ),
                        array(
                            'name'    => 'limit',
                            'label'   => esc_html__('Total items', 'apexus' ),
                            'type'    => Controls_Manager::NUMBER,
                            'default' => '8',
                        ),
                    )
                ),
            ],
            [
                'name' => 'general_section',
                'label' => esc_html__('General Settings', 'apexus' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'controls' => array_merge(
                    array(
                    	
                        array(
                            'name'        => 'img_size',
                            'label'       => esc_html__('Image Size', 'apexus' ),
                            'type'        => Controls_Manager::TEXT,
                            'description' =>  esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).', 'apexus')
                        ),
                        array(
                            'name'    => 'filter',
                            'label'   => esc_html__('Term Filter', 'apexus' ),
                            'type'    => Controls_Manager::SELECT,
                            'default' => 'false',
                            'options' => [
                                'true'  => esc_html__('Enable', 'apexus' ),
                                'false' => esc_html__('Disable', 'apexus' ),
                            ],
                            'condition' => [
                                'select_post_by' => 'term_selected',
                            ],
                        ),
                        array(
                            'name'      => 'filter_default_title',
                            'label'     => esc_html__('Filter Default Title', 'apexus' ),
                            'type'      => Controls_Manager::TEXT,
                            'default'   => esc_html__('All', 'apexus' ),
                            'condition' => [
                                'select_post_by' => 'term_selected',
                                'filter'         => 'true',
                            ],
                        ),
                        array(
                            'name'         => 'filter_alignment',
                            'label'        => esc_html__( 'Filter Alignment', 'apexus' ),
                            'type'         => Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'start' => [
                                    'title' => esc_html__( 'Start', 'apexus' ),
                                    'icon'  => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'apexus' ),
                                    'icon'  => 'eicon-text-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__( 'End', 'apexus' ),
                                    'icon'  => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .grid-filter-wrap' => 'justify-content: {{VALUE}};'
                            ],
                            'default'      => 'center',
                            'condition' => [
                                'select_post_by' => 'term_selected',
                                'filter'         => 'true',
                            ],
                        ),
                        array(
                            'name'    => 'pagination_type',
                            'label'   => esc_html__('Pagination Type', 'apexus' ),
                            'type'    => Controls_Manager::SELECT,
                            'default' => 'false',
                            'options' => [
                                'pagination' => esc_html__('Pagination', 'apexus' ),
                                'loadmore'   => esc_html__('Loadmore', 'apexus' ),
                                'false'      => esc_html__('Disable', 'apexus' ),
                            ],
                        ),
                        array(
                            'name'      => 'loadmore_text',
                            'label'     => esc_html__( 'Load More text', 'apexus' ),
                            'type'      => Controls_Manager::TEXT,
                            'default'   => esc_html__('Load More','apexus'),
                            'condition' => [
                                'pagination_type' => 'loadmore'
                            ]
                        ),
                        array(
                            'name'             => 'loadmore_icon',
                            'label'            => esc_html__( 'Loadmore Icon', 'apexus' ),
                            'type'             => Controls_Manager::ICONS,
                            'default'          => [],
                            'condition' => [
                                'pagination_type' => 'loadmore'
                            ]
                        ),
                        array(
                            'name'    => 'loadmore_flex_direction',
                            'label'   => esc_html__('Loadmore Direction', 'apexus' ),
                            'type'    => Controls_Manager::SELECT,
                            'default' => '',
                            'options' => [
                                ''               => esc_html__('None', 'apexus' ),
                                'row'            => esc_html__('Row', 'apexus' ),
                                'row-reverse'    => esc_html__('Row Reverse', 'apexus' ),
                                'column'         => esc_html__('Column', 'apexus' ),
                                'column-reverse' => esc_html__('Column Reverse', 'apexus' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-load-more .pxl-btn' => 'flex-direction: {{VALUE}};'
                            ],
                            'condition' => [
                                'pagination_type' => 'loadmore'
                            ]
                        ),
                        array(
                            'name' => 'icon_space',
                            'label' => esc_html__('Icon Space', 'apexus' ),
                            'type' => Controls_Manager::NUMBER,
                            'default' => '10',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-load-more .pxl-btn' => 'row-gap: {{VALUE}}px; column-gap: {{VALUE}}px;'
                            ],
                            'condition' => [
                                'pagination_type' => 'loadmore'
                            ]
                        ),
                        array(
                            'name' => 'loadmore_color',
                            'label' => esc_html__('Load More Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-load-more .pxl-btn' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'pagination_type' => 'loadmore'
                            ]
                        ),
                        array(
                            'name' => 'loadmore_color_hover',
                            'label' => esc_html__('Load More Color Hover', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-load-more .pxl-btn:hover' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'pagination_type' => 'loadmore'
                            ]
                        ),
                        array(
                            'name' => 'loadmore_bg_color',
                            'label' => esc_html__('Load More Background Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-load-more .pxl-btn' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'pagination_type' => 'loadmore'
                            ]
                        ),
                        array(
                            'name' => 'loadmore_bg_color_hover',
                            'label' => esc_html__('Load More Background Color Hover', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-load-more .pxl-btn:hover' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'pagination_type' => 'loadmore'
                            ]
                        ),
                        array(
                            'name' => 'loadmore_typography',
                            'label' => esc_html__('Load More Typography', 'apexus' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-load-more .pxl-btn',
                            'condition' => [
                                'pagination_type' => 'loadmore'
                            ]
                        ),
                        array(
                            'name' => 'border_radius',
                            'label' => esc_html__('Border Radius', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-load-more .pxl-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'pagination_type' => 'loadmore'
                            ]
                        ),
                        array(
                            'name' => 'padding_loadmore',
                            'label' => esc_html__('Padding', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-load-more .pxl-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'pagination_type' => 'loadmore'
                            ]
                        ),
                        array(
                            'name'         => 'pagination_alignment',
                            'label'        => esc_html__( 'Pagination Alignment', 'apexus' ),
                            'type'         => Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'start' => [
                                    'title' => esc_html__( 'Start', 'apexus' ),
                                    'icon'  => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'apexus' ),
                                    'icon'  => 'eicon-text-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__( 'End', 'apexus' ),
                                    'icon'  => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-grid-pagination, {{WRAPPER}} .pxl-load-more' => 'justify-content: {{VALUE}};'
                            ],
                            'default'      => 'center',
                            'condition' => [
                                'pagination_type' => ['pagination', 'loadmore'],
                            ],
                        ),
                         
                    )
                )
            ],
            [
                'name' => 'grid_section',
                'label' => esc_html__('Grid Settings', 'apexus' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'controls' => array_merge(
                    [
                    	[
	                        'name' => 'column',
	                        'label' => esc_html__( 'Column', 'apexus' ),
	                        'type' => 'number',
	                        'description' => esc_html__( '( min = 1, max = 6, step = 1)', 'apexus'),
	                        'control_type' => 'responsive',                            
	                        'default' => 3,
	                        'min' => 1,
	                        'max' => 6,
	                        'step' => 1,
	                        'selectors' => [
	                            '{{WRAPPER}} .pxl-grid-inner .grid-item' => 'flex: 0 0 auto; width: calc( calc( 100% * 1/{{VALUE}}))'
	                        ]                   
	                    ],
	                    [
	                        'name' => 'column_gap',
	                        'label' => esc_html__( 'Column gap ( px)', 'apexus' ),
	                        'type' => 'number',
	                        'control_type' => 'responsive',   
	                        'description' => esc_html__( '( min = 0, max = 200, step = 1)', 'apexus'),                    
	                        'min' => 0,
	                        'max' => 200,
	                        'step' => 1,
                            'default' => 21,
	                        'selectors' => [
	                            '{{WRAPPER}} .pxl-grid-inner' => '--pxl-gutter-x: {{VALUE}}px'
	                        ]                                                   
	                    ],
	                    [
	                        'name' => 'row_gap',
	                        'label' => esc_html__( 'Row gap ( px)', 'apexus' ),
	                        'type' => 'number',
	                        'control_type' => 'responsive',   
	                        'description' => esc_html__( '( min = 0, max = 200, step = 1)', 'apexus'),    
                            'default' => 21,                
	                        'min' => 0,
	                        'max' => 200,
	                        'step' => 1,
	                        'selectors' => [
	                            '{{WRAPPER}} .pxl-grid-inner' => '--pxl-gutter-y: {{VALUE}}px'
	                        ]                                                   
	                    ]
                    ]
                ),
            ],
            [
                'name' => 'display_post_section',
                'label' => esc_html__('Display Options', 'apexus' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'controls' => array(
                    array(
                        'name'      => 'show_category',
                        'label'     => esc_html__('Show Category', 'apexus' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'return_value' => '1',
                        'default' => '1',
                    ),
                    array(
                        'name'      => 'show_excerpt',
                        'label'     => esc_html__('Show Excerpt', 'apexus' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'return_value' => '1',
                        'default' => '1',
                        'condition' => ['post_type' => 'portfolio']
                    ),
                    array(
                        'name'      => 'num_words',
                        'label'     => esc_html__('Number of Words', 'apexus' ),
                        'type'      => Controls_Manager::NUMBER,
                        'default'   => 19,
                        'condition' => [
                            'show_excerpt' => '1',
                            'post_type' => 'portfolio'
                        ],
                    ),
                
                ),
            ],
            [
                'name' => 'style_section',
                'label' => esc_html__('Style Settings', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array( 
                    array(
                        'name' => 'border_type',
                        'label' => esc_html__( 'Border Type', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            '' => esc_html__( 'None', 'apexus' ),
                            'solid' => esc_html__( 'Solid', 'apexus' ),
                            'double' => esc_html__( 'Double', 'apexus' ),
                            'dotted' => esc_html__( 'Dotted', 'apexus' ),
                            'dashed' => esc_html__( 'Dashed', 'apexus' ),
                            'groove' => esc_html__( 'Groove', 'apexus' ),
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-grid .post-image' => 'border-style: {{VALUE}} !important;',
                        ],
                        'condition' => [
                            'post_type' => 'post'
                        ]
                    ),
                    array(
                        'name' => 'border_width',
                        'label' => esc_html__( 'Border Width', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-grid .post-image' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                        ],
                        'control_type' => 'responsive',
                        'condition' => [
                            'post_type' => 'post',
                            'border_type!' => ''
                        ]
                    ),
                    array(
                        'name' => 'border_color',
                        'label' => esc_html__( 'Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-grid .post-image' => 'border-color: {{VALUE}} !important;',
                        ],
                        'condition' => [
                            'post_type' => 'post',
                            'border_type!' => ''
                        ],
                    ),
                    array(
                        'name' => 'border_radius_img',
                        'label' => esc_html__('Border Radius Image', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-grid .post-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                        'condition' => [
                            'post_type' => 'post',
                        ],
                    ),
                    array(
                        'name'  => 'space_image',
                        'label' => esc_html__( 'Space Image(px)', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-grid .post-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'post_type' => 'post',
                        ],
                    ),
                    array(
                        'name' => 'title_color',
                        'label' => esc_html__('Title Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-grid .item-title a,{{WRAPPER}} .pxl-post-grid .item-title,{{WRAPPER}} .pxl-portfolio-grid .item-title > a' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-post-grid .item-title a,{{WRAPPER}} .pxl-portfolio-grid .item-title > a' => 'background-image: linear-gradient(transparent calc(100% - 1px), {{VALUE}} 1px);',
                        ],
                    ),
                    array(
                        'name' => 'title_typography',
                        'label' => esc_html__('Title Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-post-grid .item-title a',
                    ),
                    array(
                        'name'  => 'space_title',
                        'label' => esc_html__( 'Space Title(px)', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-grid .item-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'post_type' => 'post',
                        ],
                    ),
                    array(
                        'name' => 'excerpt_color',
                        'label' => esc_html__('Excerpt Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-grid .item-excerpt, {{WRAPPER}} .pxl-portfolio-grid .item-excerpt' => 'color: {{VALUE}};',
                        ],
                        'condition'  =>[
                            'post_type' => 'portfolio'
                        ]
                    ),
                    array(
                        'name' => 'category_color',
                        'label' => esc_html__('Category Text Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-grid .port-category a,{{WRAPPER}} .pxl-portfolio-grid .port-category a' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'category_bg_color',
                        'label' => esc_html__('Category Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-grid .port-category a, {{WRAPPER}} .pxl-portfolio-grid .port-category a' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'category_hover_color',
                        'label' => esc_html__('Category Hover Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-grid .port-category a::after,{{WRAPPER}} .pxl-portfolio-grid .port-category a::after' => 'background-color: {{VALUE}};',
                        ],
                    ),
                ),
            ]
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Post_Grid());