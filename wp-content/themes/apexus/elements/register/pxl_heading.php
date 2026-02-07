<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class Pxl_Heading extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_heading',
            'title'    => esc_html__('Pxl Heading', 'apexus'),
            'icon'     => 'eicon-t-letter',
            'scripts'  => ['apexus-splittext'],
            'styles'   => [],
            'keywords' => ['apexus', 'heading', 'title'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }

    public function get_params(){
        return [
            [
                'name' => 'title_section',
                'label' => esc_html__('Title', 'apexus' ),
                'tab' => 'content',
                'controls' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__('Title', 'apexus' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => 'Availability',
                        'label_block' => true,
                        'description' => 'Highlight image with shortcode: [highlight_image id_image="123"]',
                    ],
                    [
                        'name' => 'title_tag',
                        'label' => esc_html__('Heading HTML Tag', 'apexus' ),
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
                        'default' => 'h2',
                    ],
                    [
                        'name'         => 'title_break_line',
                        'label'        => esc_html__( 'Remove Title Break Line', 'apexus' ),
                        'type'         => Controls_Manager::SELECT,
                        'default'      => '',
                        'control_type' => 'responsive',
                        'options' => [
                            '' => esc_html__('No', 'apexus' ),
                            'none' => esc_html__('Yes', 'apexus' )
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .heading-title br' => 'display: {{VALUE}};',
                        ],
                    ],
                    [
                        'name'         => 'title_cliptext',
                        'label'        => esc_html__( 'Clip Text', 'apexus' ),
                        'type'         => Controls_Manager::SELECT,
                        'default'      => 'no',
                        'options' => [
                            'no' => esc_html__('No', 'apexus' ),
                            'yes' => esc_html__('Yes', 'apexus' )
                        ]
                    ],
                    [
                        'name' => 'title_cliptext_bg_img',
                        'label' => esc_html__( 'Clip Text Background Image', 'apexus' ),
                        'type' => Controls_Manager::MEDIA,
                        'dynamic' => [
                            'active' => true,
                        ],
                        'default' => [
                            'url' => ''
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .heading-title' => 'background-image: url( {{URL}} );',
                        ],
                        'condition' => ['title_cliptext' => 'yes']
                    ],
                    [
                        'name' => 'title_cliptext_bg_position',
                        'label' => esc_html__( 'Background Position', 'apexus' ),
                        'type'         => Controls_Manager::SELECT,
                        'options'      => [
                            ''              => esc_html__( 'Default', 'apexus' ),
                            'center center' => esc_html__( 'Center Center', 'apexus' ),
                            'center left'   => esc_html__( 'Center Left', 'apexus' ),
                            'center right'  => esc_html__( 'Center Right', 'apexus' ),
                            'top center'    => esc_html__( 'Top Center', 'apexus' ),
                            'top left'      => esc_html__( 'Top Left', 'apexus' ),
                            'top right'     => esc_html__( 'Top Right', 'apexus' ),
                            'bottom center' => esc_html__( 'Bottom Center', 'apexus' ),
                            'bottom left'   => esc_html__( 'Bottom Left', 'apexus' ),
                            'bottom right'  => esc_html__( 'Bottom Right', 'apexus' ),
                            'initial'       =>  esc_html__( 'Custom', 'apexus' ),
                        ],
                        'default'      => '',
                        'selectors' => [
                            '{{WRAPPER}} .heading-title' => 'background-position: {{VALUE}};',
                        ],
                        'condition' => ['title_cliptext' => 'yes']       
                    ],
                    [
                        'name' => 'title_cliptext_bg_pos_custom_x',
                        'label' => esc_html__( 'X Position', 'apexus' ),
                        'type' => Controls_Manager::SLIDER,  
                        'size_units' => [ 'px', 'em', '%', 'vw' ],
                        'default' => [
                            'unit' => 'px',
                            'size' => 0,
                        ],
                        'range' => [
                            'px' => [
                                'min' => -800,
                                'max' => 800,
                            ],
                            'em' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                            'vw' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .heading-title' => 'background-position: {{SIZE}}{{UNIT}} {{title_cliptext_bg_pos_custom_y.SIZE}}{{title_cliptext_bg_pos_custom_y.UNIT}}',
                        ],
                        'condition' => [
                            'title_cliptext' => 'yes',
                            'title_cliptext_bg_position' => [ 'initial' ],
                        ],
                    ],
                    [
                        'name' => 'title_cliptext_bg_pos_custom_y',
                        'label' => esc_html__( 'X Position', 'apexus' ),
                        'type' => Controls_Manager::SLIDER,  
                        'size_units' => [ 'px', 'em', '%', 'vw' ],
                        'default' => [
                            'unit' => 'px',
                            'size' => 0,
                        ],
                        'range' => [
                            'px' => [
                                'min' => -800,
                                'max' => 800,
                            ],
                            'em' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                            'vw' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .heading-title' => 'background-position: {{title_cliptext_bg_pos_custom_x.SIZE}}{{title_cliptext_bg_pos_custom_x.UNIT}} {{SIZE}}{{UNIT}}',
                        ],
                        'condition' => [
                            'title_cliptext' => 'yes',
                            'title_cliptext_bg_position' => [ 'initial' ],
                        ],
                    ],
                    [
                        'name'         => 'title_cliptext_bg_img_anm',
                        'label'        => esc_html__( 'Clip Text Background Animate', 'apexus' ),
                        'type'         => Controls_Manager::SELECT,
                        'default'      => 'cliptext-bg-anm-no',
                        'options' => [
                            'cliptext-bg-anm-no' => esc_html__('No', 'apexus' ),
                            'cliptext-bg-anm-horizontal' => esc_html__('Horizontal', 'apexus' ),
                            'cliptext-bg-anm-vertical' => esc_html__('vertical', 'apexus' ),
                        ],
                        'condition' => ['title_cliptext' => 'yes']
                    ],
                ],
            ],
            [
                'name' => 'subtitle_section',
                'label' => esc_html__('Sub Title', 'apexus' ),
                'tab' => 'content',
                'controls' => [
                    [
                        'name' => 'sub_title',
                        'label' => esc_html__('Sub Title', 'apexus' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'label_block' => true,
                    ],
                    [
                        'name'      => 'sub_title_on_top',
                        'label'     => esc_html__('On Top', 'apexus' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'return_value' => 'yes'
                    ],
                ],
            ],
            [
                'name' => 'highlight_section',
                'label' => esc_html__('Highlight Text', 'apexus' ),
                'tab' => 'content',
                'controls' => array_merge(
                    array(
                        array(
                            'name' => 'text_list',
                            'label' => esc_html__('Text List', 'apexus'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'highlight_text',
                                    'label' => esc_html__('Text', 'apexus'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                            ),
                            'title_field' => '{{{ highlight_text }}}',
                        ),
                        array(
                            'name' => 'highlight_color',
                            'label' => esc_html__('Highlight Color', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-wrap .heading-highlight .pxl-item--text' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'highlight_Bg_color',
                            'label' => esc_html__('Highlight Background Color', 'apexus' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-wrap .heading-highlight .pxl-item--text' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'highlight_typography',
                            'label' => esc_html__('Highlight Typography', 'apexus' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-heading-wrap .heading-highlight .pxl-item--text',
                        ),
                        array(
                            'name' => 'highlight_border_radius',
                            'label' => esc_html__('Highlight Border Radius', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px','%' ],
                            'default'    => ['px'],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-wrap .heading-highlight .pxl-item--text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    )
                ),
            ],
            [
                'name' => 'general_style_section',
                'label' => esc_html__('General Style', 'apexus' ),
                'tab' => 'style',
                'controls' => [  
                    [
                        'name' => 'content_align',
                        'label' => esc_html__('Content Alignment', 'apexus' ),
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
                            '{{WRAPPER}} .pxl-heading-wrap' => 'justify-content: {{VALUE}};',
                        ],
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
                            '{{WRAPPER}} .pxl-heading-inner' => 'text-align: {{VALUE}};',
                        ],
                    ],
                    [
                        'name'  => 'max_width',
                        'label' => esc_html__( 'Max Width', 'apexus' ),
                        'type'  => Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px','%','vw' ],
                        'range' => [
                            'px' => [
                                'min' => 100,
                                'max' => 1920,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-heading-inner' => 'max-width: {{SIZE}}{{UNIT}};',
                        ],
                    ],
                ],
            ],
            [
                'name' => 'title_style_section',
                'label' => esc_html__('Title Style', 'apexus' ),
                'tab' => 'style',
                'controls' => array_merge(
                    [  
                        [
                            'name' => 'style_heading_color',
                            'label' => esc_html__( 'Style Title Color', 'apexus' ),
                            'type' => Controls_Manager::SELECT,
                            'options'      => [
                                ''             => esc_html__( 'Default', 'apexus' ),
                                'til-gradient'        => esc_html__( 'Gradient', 'apexus' ),
                            ],
                            'default'      => '',
                        ],
                        [
                            'name' => 'title_color_df',
                            'label' => esc_html__('Title Color', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-wrap .heading-title' => 'color: {{VALUE}};',
                            ],
                            'condition' =>[
                                'style_heading_color' => '',
                            ]
                        ],
                        [
                            'name' => 'title_color',
                            'label' => esc_html__( 'Title Color', 'apexus' ),
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'types' => [ 'classic', 'gradient' ],
                            'control_type' => 'group',
                            'exclude' => [ 'image' ],
                            'selector' => '{{WRAPPER}} .pxl-heading-wrap .til-gradient .heading-title,{{WRAPPER}} .pxl-heading-wrap .til-gradient .heading-title .split-line div *',
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                            ],
                            'condition' =>[
                                'style_heading_color' => 'til-gradient',
                            ]
                        ],
                        [
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'apexus' ),
                            'type' => Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-heading-wrap .heading-title',
                        ],
                        [
                            'name' => 'title_margin',
                            'label' => esc_html__('Margin(px)', 'apexus' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-wrap .heading-title' => '--pxl-mt: {{TOP}}{{UNIT}}; --pxl-mr: {{RIGHT}}{{UNIT}}; --pxl-mb: {{BOTTOM}}{{UNIT}}; --pxl-ml: {{LEFT}}{{UNIT}};',
                            ],
                        ],
                        [
                            'name' => 'title_padding',
                            'label' => esc_html__('Padding(px)', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-wrap .heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ],
                        [
                            'name'      => 'text_shadow_color',
                            'label'     => esc_html__('Text Shadow', 'apexus' ),
                            'type'      => Controls_Manager::SWITCHER,
                            'return_value' => 'yes'
                        ],
                        [
                            'name' => 'color_shadow1',
                            'label' => esc_html__('Color 1', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-wrap .shadow-color .heading-title' => '--color-4: {{VALUE}};',
                            ],
                            'condition' =>[
                                'text_shadow_color' => 'yes',
                            ]
                        ],
                        [
                            'name' => 'color_shadow2',
                            'label' => esc_html__('Color 2', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-wrap .shadow-color .heading-title' => '--color-5: {{VALUE}};',
                            ],
                            'condition' =>[
                                'text_shadow_color' => 'yes',
                            ]
                        ],
                    ],
                    apexus_split_text_option('title_'),
                ),
            ],
            [
                'name' => 'subtitle_style_section',
                'label' => esc_html__('Sub Title Style', 'apexus' ),
                'tab' => 'style',
                'controls' => array_merge(
                    [
                        [
                            'name' => 'sub_title_color',
                            'label' => esc_html__('Sub Title Color', 'apexus' ),
                            'type' => Controls_Manager::COLOR,
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-wrap .heading-subtitle' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-heading-wrap .heading-subtitle .subtitle-text:before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-heading-wrap .heading-subtitle .subtitle-text:after' => 'background-color: {{VALUE}};',
                            ],
                            'separator' => 'before'
                        ],
                        [
                            'name' => 'sub_title_typography',
                            'label' => esc_html__('Sub Title Typography', 'apexus' ),
                            'type' => Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-heading-wrap .heading-subtitle',
                        ],
                        [
                            'name' => 'sub_title_margin',
                            'label' => esc_html__('Margin(px)', 'apexus' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-wrap .heading-subtitle' => '--pxl-mt: {{TOP}}{{UNIT}}; --pxl-mr: {{RIGHT}}{{UNIT}}; --pxl-mb: {{BOTTOM}}{{UNIT}}; --pxl-ml: {{LEFT}}{{UNIT}};',
                            ],
                        ],
                        [
                            'name' => 'sub_title_bg_color',
                            'label' => esc_html__('Sub Title Background Color', 'apexus' ),
                            'type' => Controls_Manager::COLOR,
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-wrap .sub-top .subtitle-text::before' => 'background-color: {{VALUE}};',
                            ],
                            'separator' => 'before',
                            'condition' => [
                                'sub_title_on_top' => 'yes',
                            ],
                        ],
                        
                    ],
                    apexus_split_text_option('subtitle_'),
                    
                ),
            ],
            [
                'name' => 'section_style_highlight_img',
                'label' => esc_html__('Highlight Image', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'controls' => array_merge(
                    array(
                        [
                            'name' => 'h_img_width',
                            'label' => esc_html__('Width', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 500,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-wrap .pxl-image--highlight img' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        [
                            'name' => 'h_img_height',
                            'label' => esc_html__('Height', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 500,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-wrap .pxl-image--highlight img' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        [
                            'name' => 'image_margin',
                            'label' => esc_html__('Margin', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-wrap .pxl-image--highlight' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ],
                        [
                            'name' => 'location_image_top',
                            'label' => esc_html__('Location Image Top', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => -100,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-wrap .pxl-image--highlight' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ],
                        [
                            'name' => 'location_image_bottom',
                            'label' => esc_html__('Location Image Bottom', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => -100,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-heading-wrap .pxl-image--highlight' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                        ],
                    )
                ),
            ],
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Heading()); 