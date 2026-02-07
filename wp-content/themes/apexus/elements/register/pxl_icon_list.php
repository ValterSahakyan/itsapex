<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
class Pxl_Icon_List extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_icon_list',
            'title'    => esc_html__('Pxl Icon Lists', 'apexus'),
            'icon'     => 'eicon-bullet-list',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus', 'icon', 'list'],
            'params'   => []
        ];
        parent::__construct($data, $args);
    }
    protected function register_controls() {
        $this->start_controls_section(
            'section_icon',
            [
                'label' => esc_html__( 'Icon List', 'apexus' ),
            ]
        );

        $this->add_responsive_control(
            'view',
            [
                'label' => esc_html__( 'Layout', 'apexus' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'traditional',
                'options' => [
                    'traditional' => [
                        'title' => esc_html__( 'Default', 'apexus' ),
                        'icon' => 'eicon-editor-list-ul',
                    ],
                    'inline' => [
                        'title' => esc_html__( 'Inline', 'apexus' ),
                        'icon' => 'eicon-ellipsis-h',
                    ],
                ],
                'render_type' => 'template',
                'classes' => 'elementor-control-start-end',
                'style_transfer' => true,
                'prefix_class' => 'pxl-icon-list--layout-%s-',
            ]
        ); 

        $this->add_control(
            'icon_type',
            [
                'label' => esc_html__('Icon Type', 'apexus' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'df' => esc_html__('Default', 'apexus' ),
                    'bullet' => esc_html__('Bullet', 'apexus' ),
                    'icon' => esc_html__('Icon', 'apexus' ),
                ],
                'default' => 'df',
            ]
        );

        $this->add_control(
            'selected_icon',
            [
                'label' => esc_html__( 'Icon', 'apexus' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'condition' => ['icon_type' => 'icon']
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_icon',
            [
                'label' => esc_html__( 'Icon (For Icon Type is icon)', 'apexus' ),
                'type' => Controls_Manager::ICONS,
                'default' => [],
            ]
        );

        $repeater->add_control(
            'item_icon_text',
            [
                'label' => esc_html__( 'Icon Text', 'apexus' ),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'apexus' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__( 'Title', 'apexus' ),
                'default' => ''
            ]
        );
         
        $repeater->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'apexus' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__( 'List Item', 'apexus' ),
                'default' => esc_html__( 'List Item', 'apexus' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
 
        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'apexus' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_responsive_control(
            'i_font_size',
            [
                'label' => esc_html__( 'Font Size', 'apexus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 6,
                    ],
                    '%' => [
                        'min' => 6,
                    ],
                    'vw' => [
                        'min' => 6,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .pxl-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'show_item',
            [
                'label'   => esc_html__('Display', 'apexus' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('Default', 'apexus' ),
                    'none'   => esc_html__('Hide', 'apexus' )
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'display: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_list',
            [
                'label' => esc_html__( 'Items', 'apexus' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => esc_html__( 'Item Title #1', 'apexus' ),
                        'text' => esc_html__( 'List Item #1', 'apexus' ),
                    ],
                    [
                        'title' => esc_html__( 'Item Title #2', 'apexus' ),
                        'text' => esc_html__( 'List Item #2', 'apexus' ),
                    ],
                    [
                        'title' => esc_html__( 'Item Title #3', 'apexus' ),
                        'text' => esc_html__( 'List Item #3', 'apexus' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );
      
        $this->end_controls_section();
        
        // Tab Style 
        $this->start_controls_section(
            'section_icon_list',
            [
                'label' => esc_html__( 'List', 'apexus' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'item_row_gap',
            [
                'label' => esc_html__( 'Row Gap', 'apexus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon-list-wg' => 'row-gap: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_column_gap',
            [
                'label' => esc_html__( 'Column Gap', 'apexus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon-list-wg' => 'column-gap: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'items_align',
            [
                'label' => esc_html__( 'Horizontal Alignment', 'apexus' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => true,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Start', 'apexus' ),
                        'icon' => 'eicon-justify-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'apexus' ),
                        'icon' => 'eicon-justify-center-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'apexus' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'space-around' => [
                        'title' => esc_html__( 'Space Around', 'apexus' ),
                        'icon' => 'eicon-justify-space-around-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'End', 'apexus' ),
                        'icon' => 'eicon-justify-end-h',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon-list-wg' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'space_between',
            [
                'label' => esc_html__( 'Item Space', 'apexus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon-list-wg.items-traditional .list-item:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
                    '{{WRAPPER}} .pxl-icon-list-wg.items-traditional .list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
                    '{{WRAPPER}} .pxl-icon-list-wg.items-inline .list-item' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
                    '{{WRAPPER}} .pxl-icon-list-wg.items-inline' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
                    'body.rtl {{WRAPPER}} .pxl-icon-list-wg.items-inline .list-item:after' => 'left: calc(-{{SIZE}}{{UNIT}}/2)',
                    'body:not(.rtl) {{WRAPPER}} .pxl-icon-list-wg.items-inline .list-item:after' => 'right: calc(-{{SIZE}}{{UNIT}}/2)',
                ],
            ]
        );

        $this->add_responsive_control(
            'flex_wrap',
            [
                'label' => esc_html__( 'Flex Wrap', 'apexus' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'apexus' ),
                    'wrap' => esc_html__( 'Wrap', 'apexus' ),
                    'wrap-reverse' => esc_html__( 'Wrap Reverse', 'apexus' ),
                ], 
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon-list-wg' => 'flex-wrap: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_width',
            [
                'label' => esc_html__( 'Item Width', 'apexus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon-list-wg .list-item' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => ['flex_wrap!' => '']
            ]
        );

        $this->add_responsive_control(
            'item_direction',
            [
                'label'        => esc_html__('Item Direction', 'apexus'),
                'type'         => 'select',
                'options'      => [
                    ''  => esc_html__('Default', 'apexus'),
                    'row'  => esc_html__('Row', 'apexus'),
                    'column'  => esc_html__('Columns','apexus'),
                    'column-reverse'  => esc_html__('Columns Reverse','apexus'),
                ], 
                'default'      => '', 
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon-list-wg .list-item' => 'flex-direction: {{VALUE}};',
                ],
            ]    
        );
 
        $this->add_responsive_control(
            'item_align',
            [
                'label' => esc_html__( 'Item Horizontal Alignment', 'apexus' ),
                'type' => Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .pxl-icon-list-wg .list-item' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_vertical_align',
            [
                'label' => esc_html__( 'Item Vertical Alignment', 'apexus' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Start', 'apexus' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'apexus' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'End', 'apexus' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon-list-wg .list-item' => 'align-items: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'item_text_align',
            [
                'label' => esc_html__( 'Text Alignment', 'apexus' ),
                'type' => Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .pxl-icon-list-wg .list-item' => 'text-align: {{VALUE}};',
                ],
            ]
        );
 
        $this->add_control(
            'divider',
            [
                'label' => esc_html__( 'Divider', 'apexus' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__( 'Off', 'apexus' ),
                'label_on' => esc_html__( 'On', 'apexus' ),
                'selectors' => [
                    '{{WRAPPER}} .list-item:not(:last-child):after' => 'content: ""',
                ],
            ]
        );

        $this->add_control(
            'divider_style',
            [
                'label' => esc_html__( 'Style', 'apexus' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'solid' => esc_html__( 'Solid', 'apexus' ),
                    'double' => esc_html__( 'Double', 'apexus' ),
                    'dotted' => esc_html__( 'Dotted', 'apexus' ),
                    'dashed' => esc_html__( 'Dashed', 'apexus' ),
                ],
                'default' => 'solid',
                'condition' => [
                    'divider' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon-list-wg.items-traditional .list-item:not(:last-child):after' => 'border-top-style: {{VALUE}}',
                    '{{WRAPPER}} .pxl-icon-list-wg.items-inline .list-item:not(:last-child):after' => 'border-left-style: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'divider_weight',
            [
                'label' => esc_html__( 'Weight', 'apexus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                    ],
                ],
                'condition' => [
                    'divider' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon-list-wg.items-traditional .list-item:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .pxl-icon-list-wg.items-inline .list-item:not(:last-child):after' => 'border-left-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'divider_width',
            [
                'label' => esc_html__( 'Width', 'apexus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'default' => [
                    'unit' => '%',
                ],
                'condition' => [
                    'divider' => 'yes',
                    'view!' => 'inline',
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'divider_height',
            [
                'label' => esc_html__( 'Height', 'apexus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'custom' ],
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'divider' => 'yes',
                    'view' => 'inline',
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-item:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label' => esc_html__( 'Color', 'apexus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ddd',
                'condition' => [
                    'divider' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-item:not(:last-child):after' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();

        // Icon style section
        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => esc_html__( 'Icon', 'apexus' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'icon_colors' );

        $this->start_controls_tab(
            'icon_colors_normal',
            [
                'label' => esc_html__( 'Normal', 'apexus' ),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Color', 'apexus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon i, {{WRAPPER}} .pxl-icon .icon-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pxl-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'apexus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_colors_hover',
            [
                'label' => esc_html__( 'Hover', 'apexus' ),
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label' => esc_html__( 'Color', 'apexus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .list-item:hover .pxl-icon i, {{WRAPPER}} .list-item:hover .pxl-icon .icon-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .list-item:hover .pxl-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_bg_color_hover',
            [
                'label' => esc_html__( 'Background Color Hover', 'apexus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .list-item:hover .pxl-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'hover_animation',
            [
                'label' => esc_html__( 'Hover Animation', 'apexus' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ] 
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__( 'Box Width', 'apexus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'icon_height',
            [
                'label' => esc_html__( 'Box Height', 'apexus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_font_size',
            [
                'label' => esc_html__( 'Font Size', 'apexus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'default' => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min' => 6,
                    ],
                    '%' => [
                        'min' => 6,
                    ],
                    'vw' => [
                        'min' => 6,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_gap',
            [
                'label' => esc_html__( 'Column Gap', 'apexus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-item' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_row_gap',
            [
                'label' => esc_html__( 'Row Gap', 'apexus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-item' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'apexus' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ],   
        );
        $this->add_responsive_control(
            'icon_self_align',
            [
                'label' => esc_html__( 'Horizontal Alignment', 'apexus' ),
                'type' => Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .pxl-icon' => 'text-align: {{VALUE}}; justify-content: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'icon_self_vertical_align',
            [
                'label' => esc_html__( 'Vertical Alignment', 'apexus' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Start', 'apexus' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'apexus' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'End', 'apexus' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon' => 'align-items: {{VALUE}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'icon_vertical_offset',
            [
                'label' => esc_html__( 'Adjust Vertical Position', 'apexus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => -15,
                        'max' => 15,
                    ],
                    'em' => [
                        'min' => -1,
                        'max' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--icon-vertical-offset: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'icon_text_typography',
                'selector' => '{{WRAPPER}} .pxl-icon .icon-text',
            ]
        );
        $this->add_responsive_control(
            'icon_rotate',
            [
                'label' => esc_html__( 'Rotate', 'apexus' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'deg', 'grad', 'rad', 'turn', 'custom' ],
                'control_type' => 'responsive',
                'default' => [
                    'unit' => 'deg',
                ],
                'tablet_default' => [
                    'unit' => 'deg',
                ],
                'mobile_default' => [
                    'unit' => 'deg',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-icon i, {{WRAPPER}} .pxl-icon svg,  {{WRAPPER}} .pxl-icon .icon-text' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
                'separator' => 'after',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Title', 'apexus' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title Tag', 'apexus' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'span',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .item-title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'apexus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .item-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Color Hover', 'apexus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .item-title a:hover,{{WRAPPER}} .list-item:hover .item-title a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_bottom_space',
            [
                'label' => esc_html__('Bottom Space', 'apexus' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .item-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ],
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_text_style',
            [
                'label' => esc_html__( 'Text', 'apexus' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'text_tag',
            [
                'label' => esc_html__('Text Tag', 'apexus' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'span',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} a.list-item, {{WRAPPER}} .list-item .item-text',
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Color', 'apexus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .item-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_color_hover',
            [
                'label' => esc_html__( 'Color Hover', 'apexus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .list-item:hover .item-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_link_color',
            [
                'label' => esc_html__( 'Link Color', 'apexus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .item-text a ' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_link_color_hover',
            [
                'label' => esc_html__( 'Link Color Hover', 'apexus' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .item-text a:hover ' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
    } 
}

\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Icon_List());
  