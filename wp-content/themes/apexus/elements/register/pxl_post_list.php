<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
class Pxl_Post_List extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_post_list',
            'title'    => esc_html__('PXL Post List', 'apexus'),
            'icon'     => 'eicon-post-list',
            'scripts'    => [
	            'apexus-post-grid',
	        ],
            'styles'   => [],
            'keywords' => ['apexus', 'post list', 'list'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        $pt_supports = ['post', 'career'];
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
                    apexus_get_post_list_layout($pt_supports)
                ),
            ],
            [
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
            ],
            [
                'name' => 'general_section',
                'label' => esc_html__('General Settings', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array_merge(
                    array(
                        array(
                            'name'    => 'show_toolbar',
                            'label'   => esc_html__('Show Toolbar', 'apexus' ),
                            'type'    => \Elementor\Controls_Manager::SELECT,
                            'default' => 'hide',
                            'options' => [
                                'show' => esc_html__('Show', 'apexus' ),
                                'hide'   => esc_html__('Hide', 'apexus' )
                            ],
                        ),
                        array(
                            'name' => 'toolbar_icon_color',
                            'label' => esc_html__('Toolbar Icon Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-career-list .post-list-toolbar .result-count::before' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'show_toolbar' => 'show'
                            ]
                        ),
                        array(
                            'name' => 'toolbar_color',
                            'label' => esc_html__('Toolbar Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-career-list .post-list-toolbar .result-count' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'show_toolbar' => 'show'
                            ]
                        ),
                        array(
                            'name'        => 'img_size',
                            'label'       => esc_html__('Image Size', 'apexus' ),
                            'type'        => \Elementor\Controls_Manager::TEXT,
                            'description' =>  esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: full).', 'apexus')
                        ),
                        array(
                            'name'         => 'item_space',
                            'label'        => esc_html__( 'Item Space', 'apexus' ),
                            'type'         => \Elementor\Controls_Manager::NUMBER,
                            'default'      => 24,
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-grid-inner' => 'row-gap: {{VALUE}}px;',
                            ],
                        ),
                        array(
                            'name'    => 'pagination_type',
                            'label'   => esc_html__('Pagination Type', 'apexus' ),
                            'type'    => \Elementor\Controls_Manager::SELECT,
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
                            'type'      => \Elementor\Controls_Manager::TEXT,
                            'default'   => esc_html__('Load More','apexus'),
                            'condition' => [
                                'pagination_type' => 'loadmore'
                            ]
                        ),
                        array(
                            'name'             => 'loadmore_icon',
                            'label'            => esc_html__( 'Loadmore Icon', 'apexus' ),
                            'type'             => 'icons',
                            'default'          => [],
                            'condition' => [
                                'pagination_type' => 'loadmore'
                            ]
                        ),
                        array(
                            'name' => 'icon_align',
                            'label' => esc_html__('Icon Position', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'right',
                            'options' => [
                                'right' => esc_html__('After', 'apexus' ),
                                'left' => esc_html__('Before', 'apexus' ),
                            ],
                            'condition' => [
                                'pagination_type' => 'loadmore'
                            ]
                        ),
                        array(
                            'name'         => 'pagination_alignment',
                            'label'        => esc_html__( 'Pagination Alignment', 'apexus' ),
                            'type'         => 'choose',
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
                            'default'      => 'start',
                            'condition' => [
                                'pagination_type' => ['pagination', 'loadmore'],
                            ],
                        ),
                    ),
                )
            ],
            [
                'name' => 'display_post_section',
                'label' => esc_html__('Display Options', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array(
                    array(
                        'name'      => 'show_category',
                        'label'     => esc_html__('Show Category', 'apexus' ),
                        'type'      => \Elementor\Controls_Manager::SWITCHER,
                        'return_value' => '1',
                        'default' => '1',
                        'condition' => [
                            'post_type' => 'post',
                        ],
                    ),
                    array(
                        'name'      => 'post_date',
                        'label'     => esc_html__('Show Date', 'apexus' ),
                        'type'      => \Elementor\Controls_Manager::SWITCHER,
                        'return_value' => '1',
                        'default' => '1',
                        'condition' => [
                            'post_type' => 'career',
                        ],
                    ),
                    array(
                        'name'      => 'show_excerpt',
                        'label'     => esc_html__('Show Excerpt', 'apexus' ),
                        'type'      => \Elementor\Controls_Manager::SWITCHER,
                        'return_value' => '1',
                        'default' => '1',
                        'condition' => [
                            'post_type' => 'career',
                        ],
                    ),
                    array(
                        'name'      => 'num_words',
                        'label'     => esc_html__('Number of Words', 'apexus' ),
                        'type'      => Controls_Manager::NUMBER,
                        'default'   => 30,
                        'condition' => [
                            'show_excerpt' => '1',
                            'post_type' => 'career',
                        ],
                    ),
                    array(
                        'name'      => 'show_readmore',
                        'label'     => esc_html__('Show Readmore', 'apexus' ),
                        'type'      => \Elementor\Controls_Manager::SWITCHER,
                        'return_value' => '1',
                        'default' => '1',
                        'condition' => [
                            'post_type' => 'career',
                        ],
                    ),
                    array(
                        'name'      => 'readmore_text',
                        'label'     => esc_html__('Readmore Text', 'apexus' ),
                        'type'      => \Elementor\Controls_Manager::TEXT,
                        'condition' => [
                            'show_readmore' => '1',
                            'post_type' => 'career',
                        ],
                    ),
                    array(
                        'name'      => 'show_infor',
                        'label'     => esc_html__('Show More Information', 'apexus' ),
                        'type'      => \Elementor\Controls_Manager::SWITCHER,
                        'return_value' => '1',
                        'default' => '1',
                        'condition' => [
                            'post_type' => 'career',
                        ],
                    ),
                ),
            ],
            [
                'name' => 'style_section',
                'label' => esc_html__('Style Settings', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'controls' => array( 
                    array(
                        'name' => 'title_color',
                        'label' => esc_html__('Title Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-career-list .item-title a,{{WRAPPER}} .pxl-post-list .item-title a' => 'color: {{VALUE}}; background-image: linear-gradient(transparent calc(100% - 1px), {{VALUE}} 1px);'
                        ],
                    ),
                    array(
                        'name' => 'title_typography',
                        'label' => esc_html__('Title Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-career-list .item-title a, {{WRAPPER}} .pxl-post-list .item-title a',
                    ),
                    array(
                        'name' => 'des_color',
                        'label' => esc_html__('Excerpt Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-career-list .item-excerpt' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => 'career',
                        ],
                    ),
                    array(
                        'name'  => 'max_width_excerpt',
                        'label' => esc_html__( 'Max Width Excerpt', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units'   => ['px', '%'],
                        'range' => [
                            'px' => [
                                'min' => 100,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-career-list .item-excerpt' => 'max-width: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'post_type' => 'career',
                        ],
                    ),
                     array(
                        'name' => 'date_color',
                        'label' => esc_html__('Date Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-career-list .box-title >span' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => 'career',
                        ],
                    ),
                    array(
                        'name' => 'more_infor_color',
                        'label' => esc_html__('More Info Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-career-list .icon-item > span' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => 'career',
                        ],
                    ),
                    array(
                        'name' => 'more_infor_icon_color',
                        'label' => esc_html__('More Info Icon Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-career-list .icon-item svg' => 'fill: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => 'career',
                        ],
                    ),
                    array(
                        'name' => 'more_infor_bg_icon_color',
                        'label' => esc_html__('More Info Icon Bg Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-career-list .icon-item svg' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => 'career',
                        ],
                    ),
                    array(
                        'name' => 'button_color',
                        'label' => esc_html__('Button Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-career-list .btn-primary .pxl-button-text' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => 'career',
                        ],
                    ),
                    array(
                        'name' => 'button_bgcolor',
                        'label' => esc_html__('Button Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-career-list .btn-primary' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => 'career',
                        ],
                    ),
                    array(
                        'name' => 'button_shadowcolor',
                        'label' => esc_html__('Button Shadow Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-career-list .btn-primary' => '--box-shadow-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => 'career',
                        ],
                    ),
                     array(
                        'name' => 'category_color',
                        'label' => esc_html__('Category Text Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-list .port-category a' => 'color: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => 'post',
                        ],
                    ),
                    array(
                        'name' => 'category_bg_color',
                        'label' => esc_html__('Category Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-list .port-category a' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => 'post',
                        ],
                    ),
                    array(
                        'name' => 'category_hover_color',
                        'label' => esc_html__('Category Hover Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-list .port-category a::after' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => 'post',
                        ],
                    ),
                    array(
                        'name' => 'border_color',
                        'label' => esc_html__('Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-post-list .grid-item + .grid-item' => 'border-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'post_type' => 'post',
                        ],
                    ),
                ),
            ]
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Post_List());
