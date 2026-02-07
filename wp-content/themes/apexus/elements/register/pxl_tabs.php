<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
class Pxl_Tabs extends Pxl_Widget_Base{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_tabs',
            'title'    => esc_html__('Pxl Tabs', 'apexus'),
            'icon'     => 'eicon-tabs',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus', 'tabs'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        $templates_df = ['0' => esc_html__('None', 'apexus')];
        $templates = $templates_df + apexus_get_templates_option('tab') ;
        return [
            [
                'name'     => 'layout_section',
                'label'    => esc_html__( 'Layout', 'apexus' ),
                'tab'      => 'layout',
                'controls' => array(
                    array(
                        'name'    => 'layout',
                        'label'   => esc_html__( 'Layout', 'apexus' ),
                        'type'    => 'layoutcontrol',
                        'default' => '1',
                        'options' => [
                            '1' => [
                                'label' => esc_html__( 'Layout 1', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_tabs-1.webp'
                            ],
                            '2' => [
                                'label' => esc_html__( 'Layout 2', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_tabs-2.webp'
                            ],
                            '3' => [
                                'label' => esc_html__( 'Layout 3', 'apexus' ),
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_tabs-3.webp'
                            ],
                        ],
                        'prefix_class' => 'pxl-tabs-layout-',
                    ),
                )
            ],
            [
                'name'     => 'content_section',
                'label'    => esc_html__( 'Content', 'apexus' ),
                'tab'      => 'content',
                'controls' => array(
                    array(
                        'name' => 'style',
                        'label' => esc_html__('Style', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            '' => esc_html__( 'Style 1', 'apexus' ),
                            'style2' => esc_html__( 'Style 2', 'apexus' ),
                        ],
                        'default' => '',
                        'condition' => ['layout' => '1'] 
                    ),
                    array(
                        'name' => 'active_tab',
                        'label' => esc_html__( 'Active Tab', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'default' => 1,
                        'separator' => 'after',
                    ),
                    array(
                        'name' => 'tabs_list',
                        'label' => esc_html__('Tabs List', 'apexus'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'controls' => array(
                            array(
                                'name'             => 'tab_icon',
                                'label'            => esc_html__( 'Icon', 'apexus' ),
                                'type'             => 'icons',
                                'description'      => esc_html__( 'Use for layout 1', 'apexus' ),
                            ),
                            array(
                                'name' => 'tab_title',
                                'label' => esc_html__('Title', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'content_type',
                                'label' => esc_html__('Content Type', 'apexus'),
                                'type' => 'select',
                                'options' => [
                                    'df' => esc_html__( 'Default', 'apexus' ),
                                    'template' => esc_html__( 'From Template Builder', 'apexus' )
                                ],
                                'default' => 'df' 
                            ),
                            array(
                                'name' => 'content_template',
                                'label' => esc_html__('Select Templates', 'apexus'),
                                'description'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','apexus'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
                                'type' => 'select',
                                'options' => $templates,
                                'default' => 'df',
                                'condition' => ['content_type' => 'template'] 
                            ),
                            array(
                                'name' => 'tab_content',
                                'label' => esc_html__('Enter Content', 'apexus'),
                                'type' => \Elementor\Controls_Manager::WYSIWYG,
                                'default' => '',
                                'condition' => ['content_type' => 'df'] 
                            ),
                        ),
                        'title_field' => '{{{ tab_title }}}',
                    ),
                    
                    array(
                        'name' => 'title_color',
                        'label' => esc_html__('Title Color', 'apexus' ),
                        'type' => 'color',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-tabs .tab-title' => 'color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name' => 'title_active_color',
                        'label' => esc_html__('Title Actice Color', 'apexus' ),
                        'type' => 'color',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-tabs .tab-title.active' => 'color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name'         => 'title_typo',
                        'label'        => esc_html__( 'Title Typography', 'apexus' ),
                        'type'         => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector'     => '{{WRAPPER}} .pxl-tabs .tab-title',
                    ), 
                    array(
                        'name' => 'border_color_title',
                        'label' => esc_html__('Border Color', 'apexus' ),
                        'type' => 'color',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-tabs.layout-1 .tabs-title' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-tabs .tabs-title.style2::after' => 'background-color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-tabs .tab-title::after' => '--border-color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-tabs.layout-3 .tab-title::before' => 'color: {{VALUE}};'
                        ],
                    ), 
                    array(
                        'name' => 'border_color_tit',
                        'label' => esc_html__('Border Color Active', 'apexus' ),
                        'type' => 'color',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-tabs .tab-title::after' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ), 
                    array(
                        'name' => 'title_padding',
                        'label' => esc_html__('Title Padding', 'apexus' ),
                        'type' => 'dimensions',
                        'default' => ['top' => '', 'right' => '', 'bottom' => '', 'left' => ''],
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-tabs .tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => [
                            'layout!' => '3'
                        ]
                    ),
                    array(
                        'name'  => 'title_space',
                        'label' => esc_html__( 'Title Space (px)', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-tabs .tabs-title' => 'column-gap: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-tabs.layout-3 .tab-title::before' => 'margin-right: {{SIZE}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name' => 'icon_color',
                        'label' => esc_html__('Icon Color', 'apexus' ),
                        'type' => 'color',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-tabs .tab-title .title-icon i' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-tabs .tab-title .title-icon svg' => 'fill: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ),
                    array(
                        'name' => 'icon_color_active',
                        'label' => esc_html__('Icon Color Active', 'apexus' ),
                        'type' => 'color',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-tabs .tab-title.active i' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-tabs .tab-title.active svg' => 'fill: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ),
                    array(
                        'name' => 'icon_background_color',
                        'label' => esc_html__('Icon Background Color', 'apexus' ),
                        'type' => 'color',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-tabs .tabs-title.style2 .title-icon' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1',
                            'style' => 'style2'
                        ]
                    ),
                    array(
                        'name'  => 'icon_font_size',
                        'label' => esc_html__( 'Icon Size', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-tabs.layout-1 .tab-title .title-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                             '{{WRAPPER}} .pxl-tabs.layout-1 .tab-title .title-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ), 
                    array(
                        'name' => 'background_box',
                        'label' => esc_html__( 'Background Color', 'apexus' ),
                        'type' => \Elementor\Group_Control_Background::get_type(),
                        'types' => [ 'classic', 'gradient' ],
                        'control_type' => 'group',
                        'exclude' => [ 'image' ],
                        'selector' => '{{WRAPPER}} .pxl-tabs.layout-2',
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
                        'name' => 'content_space',
                        'label' => esc_html__('Content Space (px)', 'apexus' ),
                        'type' => 'dimensions',
                        'default' => ['top' => '', 'right' => '', 'bottom' => '', 'left' => ''],
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-tabs .tabs-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => [
                            'layout!' => '2'
                        ]
                    ),
                    array(
                        'name'         => 'align',
                        'label'        => esc_html__( 'Title Alignment', 'apexus' ),
                        'type'         => 'choose',
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
                        'selectors' => [
                            '{{WRAPPER}} .pxl-tabs .tabs-title' => 'justify-content: {{VALUE}};',
                        ],
                        'default'      => 'center',
                        'condition' => [
                            'layout!' => '2'
                        ]
                    ),

                ),
            ]
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Tabs()); 
