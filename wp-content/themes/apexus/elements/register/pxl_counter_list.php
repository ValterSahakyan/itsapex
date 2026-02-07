<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class Pxl_counter_list extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_counter_list',
            'title'    => esc_html__('PXL Counter List', 'apexus'),
            'icon'     => 'eicon-counter',
            'scripts'  => [],
            'styles'   => [''],
            'keywords' => ['apexus', 'Counter List'],
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
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_counter_list-1.webp'
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
                        'default' => 1,
                    ),
                    array(
                        'name' => 'content_list',
                        'label' => esc_html__('List', 'apexus'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'controls' => array(
                            [
                                'name' => 'image',
                                'label' => esc_html__('Image', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::MEDIA,
                            ],
                            [
                                'name' => 'starting_number',
                                'label' => esc_html__('Starting Number', 'apexus'),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'default' => 1
                            ],
                            [
                                'name' => 'ending_number',
                                'label' => esc_html__('Ending Number', 'apexus'),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'default' => 100
                            ],
                            [
                                'name' => 'prefix',
                                'label' => esc_html__('Number Prefix', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => ''
                            ],
                            [
                                'name' => 'suffix',
                                'label' => esc_html__('Number Suffix', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => ''
                            ],
                            [
                                'name' => 'title',
                                'label' => esc_html__('Title', 'apexus'),
                                'label_block' => true,
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'default' => ''
                            ],
                            [
                                'name' => 'thousand_separator',
                                'label' => esc_html__('Thousand Separator', 'apexus'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                                'return_value' => 'yes'                  
                            ],
                            [
                                'name' => 'thousand_separator_char',
                                'label' => esc_html__( 'Separator', 'apexus'),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'condition' => [
                                    'thousand_separator' => 'yes',
                                ],
                                'options' => [
                                    '.' => esc_html__( 'Dot', 'apexus'),
                                ],
                                'default' => '.'
                            ],
                            [
                                'name' => 'min_width_number',
                                'label' => esc_html__( 'Width Number', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'size_units' => [ 'px', '%','custom'],
                                'control_type' => 'responsive',
                                'range' => [
                                    'px' => [
                                        'max' => 500,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-counter-list {{CURRENT_ITEM}} .box-counter' => 'min-width: {{SIZE}}{{UNIT}};',
                                ],
                            ],
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
                    [
                        'name' => 'duration',
                        'label' => esc_html__('Animation Duration', 'apexus'),
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'default' => 4,
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1                 
                    ],
                    array(
                        'name' => 'number_color',
                        'label' => esc_html__('Number Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-counter-list .counter-number' => 'color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name' => 'number_typography',
                        'label' => esc_html__('Number Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-counter-list .counter-number',
                    ), 
                    array(
                        'name' => 'suffix_color',
                        'label' => esc_html__('Suffix Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-counter-list .counter-number-suffix' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'suffix_typography',
                        'label' => esc_html__('Suffix Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-counter-list .counter-number-suffix',
                    ), 
                    array(
                        'name' => 'title_color',
                        'label' => esc_html__('Title Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-counter-list .counter-title' => 'color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name' => 'title_typography',
                        'label' => esc_html__('Title Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-counter-list .counter-title',
                    ), 
                    array(
                        'name' => 'dot_color',
                        'label' => esc_html__('Dot Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-counter-list .item-inner::before' => 'background-color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name' => 'dot_active_color',
                        'label' => esc_html__('Dot Active Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-counter-list .item-inner.active::before' => 'background-color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name' => 'border_color',
                        'label' => esc_html__('Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-counter-list::before' => 'background-color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name'  => 'space_item',
                        'label' => esc_html__( 'Space Item', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 400,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-counter-list .item-inner + .item-inner' => 'margin-top: {{SIZE}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name' => 'background_color',
                        'label' => esc_html__('Background Color (last item)', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-counter-list .item-inner:last-child::after' => 'background-color: {{VALUE}};'
                        ],
                    ), 
                ),
            ],
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_counter_list());