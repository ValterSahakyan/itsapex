<?php
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
class Pxl_Counter extends Pxl_Widget_Base
{
    public function __construct( $data = [], $args = null) {
        $args = [
            'name'     => 'pxl_counter',
            'title'    => esc_html__( 'Pxl Counter', 'apexus'),
            'icon'     => 'eicon-counter',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus', 'counter'],
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
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_counter-1.webp'
                            ],
                        ],
                    ),
                    
                ),
            ],
            [
                'name'     => 'section_counter',
                'label'    => esc_html__( 'Counter', 'apexus'),
                'tab'      => 'content',
                'controls' => [
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
                        'name' => 'duration',
                        'label' => esc_html__('Animation Duration', 'apexus'),
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'default' => 2,
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1                 
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
                            '' => esc_html__( 'Default', 'apexus'),
                            '.' => esc_html__( 'Dot', 'apexus'),
                        ],
                        'default' => ''
                    ]                     
                ]
            ],
            [
                'name'     => 'counter_style_section',
                'label'    => esc_html__( 'General', 'apexus'),
                'tab'      => 'style',
                'controls' => [
                    [
                        'name' => 'number_typography',
                        'label' => esc_html__( 'Number Typography', 'apexus'),
                        'type' => 'typography',
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-counter-wg .counter-number'
                    ],
                    [
                        'name' => 'number_cl',
                        'label' => esc_html__('Number Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::HEADING,
                    ],
                    [
                        'name' => 'number_color',
                        'label' => esc_html__( 'Number Color', 'apexus' ),
                        'type' => \Elementor\Group_Control_Background::get_type(),
                        'types' => [ 'classic', 'gradient' ],
                        'control_type' => 'group',
                        'exclude' => [ 'image' ],
                        'selector' => '{{WRAPPER}} .pxl-counter-wg .counter-number .counter-number-value',
                        'fields_options' => [
                            'background' => [
                                'default' => 'classic',
                            ],
                        ],
                    ],
                    [
                        'name' => 'suffix_typography',
                        'label' => esc_html__( 'Suffix Typography', 'apexus'),
                        'type' => 'typography',
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-counter-wg .counter-number .counter-number-suffix'
                    ],
                    [
                        'name' => 'suffix_color',
                        'label' => esc_html__( 'Suffix Color', 'apexus'),
                        'type' => 'color',                        
                        'selectors' => [
                            '{{WRAPPER}} .pxl-counter-wg .counter-number .counter-number-suffix' => 'color: {{VALUE}}'
                        ]
                    ],
                    [
                        'name'  => 'position_suffix',
                        'label' => esc_html__( 'Position Suffix(Y)', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => -50,
                                'max' => 50,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-counter-wg .counter-number .counter-number-suffix' => 'margin-top: {{SIZE}}{{UNIT}};',
                        ],
                    ], 
                    [
                        'name' => 'title_typography',
                        'label' => esc_html__( 'Title Typography', 'apexus'),
                        'type' => 'typography',
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-counter-wg .counter-title'
                    ],
                    [
                        'name' => 'title_color',
                        'label' => esc_html__( 'Title Color', 'apexus'),
                        'type' => 'color',                        
                        'selectors' => [
                            '{{WRAPPER}} .pxl-counter-wg .counter-title' => 'color: {{VALUE}}'
                        ]
                    ], 
                    [
                        'name'  => 'space_title',
                        'label' => esc_html__( 'Space Title', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-counter-wg .counter-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                        ],
                    ], 
                    [
                        'name'  => 'counter_size',
                        'label' => esc_html__( 'Counter Size', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 50,
                                'max' => 500,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-counter-wg .inner-counter' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'layout' => '2'
                        ]
                    ],  
                    [
                        'name' => 'text_align',
                        'label' => esc_html__('Text Alignment', 'apexus' ),
                        'type' => Controls_Manager::CHOOSE,
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
                            '{{WRAPPER}} .pxl-counter-wg' => 'text-align: {{VALUE}};',
                        ],
                        'condition' => [
                            'layout' => '1'
                        ]
                    ],                                   
                ]
            ]            
        ];
    }
}

\Elementor\Plugin::instance()->widgets_manager->register( new pxl_counter());
 