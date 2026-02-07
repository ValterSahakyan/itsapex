<?php
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
 
class Pxl_Text_Editor extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_text_editor',
            'title'    => esc_html__('Pxl Text Editor', 'apexus'),
            'icon'     => 'eicon-text',
            'scripts'  => ['apexus-splittext'],
            'styles'   => [],
            'keywords' => ['apexus', 'text', 'editor'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        return [
            [
                'name' => 'editor_section',
                'label' => esc_html__( 'Text Editor', 'apexus' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'controls' => [
                    [
                        'name' => 'text_editor',
                        'label' => '',
                        'type' => Controls_Manager::WYSIWYG,
                        'default' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'apexus' ),
                    ],
                ],
            ],
            [
                'name' => 'section_style_content',
                'label' => esc_html__( 'Style', 'apexus' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'controls' => [
                    [
                        'name'  => 'max_width',
                        'label' => esc_html__( 'Max Width (px)', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px','%','vw' ],
                        'range' => [
                            'px' => [
                                'min' => 100,
                                'max' => 1920,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-text-editor' => 'max-width: {{SIZE}}{{UNIT}};',
                        ],
                    ],
                    [
                      'name' => 'align',
                        'label' => esc_html__( 'Alignment', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::CHOOSE,
                        'control_type' => 'responsive',
                        'options' => [
                            'start' => [
                                'title' => esc_html__( 'Left', 'apexus' ),
                                'icon' => 'eicon-text-align-left',
                            ],
                            'center' => [
                                'title' => esc_html__( 'Center', 'apexus' ),
                                'icon' => 'eicon-text-align-center',
                            ],
                            'end' => [
                                'title' => esc_html__( 'Right', 'apexus' ),
                                'icon' => 'eicon-text-align-right',
                            ]
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-text-editor-wrap' => 'justify-content: {{VALUE}};',
                            '{{WRAPPER}} .pxl-text-editor' => 'text-align: {{VALUE}};',
                        ],
                    ],
                    [
                        'name' => 'text_color',
                        'label' => esc_html__( 'Text Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'control_type' => 'responsive',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-text-editor' => 'color: {{VALUE}};'
                        ],
                    ],
                    [
                        'name' => 'link_color',
                        'label' => esc_html__( 'Link Color', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-text-editor a' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-text-editor a.link-underline' => 'border-color: {{VALUE}};',
                        ],
                    ],
                    [
                        'name' => 'link_color_hover',
                        'label' => esc_html__( 'Link Color Hover', 'apexus' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-text-editor a:hover' => 'color: {{VALUE}};',
                        ],
                    ],
                    [
                        'name' => 'typography',
                        'type' => Group_Control_Typography::get_type(),
                        'label' => esc_html__( 'Text Typography', 'apexus' ),
                        'selector' => '{{WRAPPER}} .pxl-text-editor, {{WRAPPER}} .pxl-text-editor h1, {{WRAPPER}} .pxl-text-editor h2, {{WRAPPER}} .pxl-text-editor h3, {{WRAPPER}} .pxl-text-editor h4, {{WRAPPER}} .pxl-text-editor h5, {{WRAPPER}} .pxl-text-editor h6',
                        'control_type' => 'group',
                    ],
                    [
                        'name' => 'link_typography',
                        'type' => Group_Control_Typography::get_type(),
                        'label' => esc_html__( 'Link Typography', 'apexus' ),
                        'selector' => '{{WRAPPER}} .pxl-text-editor a',
                        'control_type' => 'group',
                    ],
                    [
                        'name'  => 'paragraph_space',
                        'label' => esc_html__( 'Paragraph Space (px)', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 500,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-text-editor p:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ],
                    [
                        'name'         => 'remove_break_line',
                        'label'        => esc_html__( 'Remove Break Line', 'apexus' ),
                        'type'         => 'select',
                        'default'      => '',
                        'control_type' => 'responsive',
                        'options' => [
                            '' => esc_html__('No', 'apexus' ),
                            'none' => esc_html__('Yes', 'apexus' )
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-text-editor br' => 'display: {{VALUE}};',
                        ],
                    ],
                    [
                        'name' => 'text_truncate',
                        'label' => esc_html__('Text Truncate', 'apexus'),
                        'type' => \Elementor\Controls_Manager::SWITCHER
                    ],
                    [
                        'name' => 'text_truncate_line',
                        'label' => esc_html__('Truncate Number Line', 'apexus'),
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'control_type' => 'responsive',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-text-editor' => '--truncate-line: {{VALUE}};',
                        ],
                        'default' => '',
                        'condition' => ['text_truncate' => 'true']
                    ],
                    [
                        'name' => 'text_truncate_font_size',
                        'label' => esc_html__('Truncate Font Size (px)', 'apexus'),
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'control_type' => 'responsive',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-text-editor' => '--truncate-font-size: {{VALUE}};',
                        ],
                        'default' => '',
                        'condition' => ['text_truncate' => 'true']
                    ],
                    [
                        'name' => 'text_truncate_line_height',
                        'label' => esc_html__('Truncate Line Height (em)', 'apexus'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'control_type' => 'responsive',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-text-editor' => '--truncate-line-height: {{VALUE}};',
                        ],
                        'default' => '',
                        'condition' => ['text_truncate' => 'true']
                    ],
                ],
            ],
            [
                'name' => 'animation_section',
                'label' => esc_html__('Animation Settings', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array_merge(
                    apexus_split_text_option()
                )
            ]
        ];
    }
    /*protected function register_controls() {
        $this->render_controls($this->get_params());
    } 
    protected function content_template() {
    }*/
}

\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Text_Editor());