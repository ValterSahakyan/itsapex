<?php
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
class Pxl_Image extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_image',
            'title'    => esc_html__('PXL Image', 'apexus'),
            'icon'     => 'eicon-image',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus', 'image'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }

    public function get_params(){
        return [
            [
                'name' => 'content_section',
                'label' => esc_html__('Image', 'apexus' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'controls' => [
                    [
                        'name' => 'image',
                        'label' => esc_html__( 'Choose Image', 'apexus' ),
                        'type' => Controls_Manager::MEDIA,
                        'dynamic' => [
                            'active' => true,
                        ],
                        'default' => [
                            'url' => Utils::get_placeholder_image_src()
                        ]
                    ],
                    [
                        'name' => 'image',
                        'label' => esc_html__( 'Image Size', 'apexus' ),
                        'type' => Group_Control_Image_Size::get_type(),
                        'control_type' => 'group',
                        'default' => 'full',  
                    ],
                    [
                        'name'      => 'image_mode',
                        'label'     => esc_html__('Image Mode', 'apexus' ),
                        'type'      => Controls_Manager::SELECT,
                        'options' => [
                            '' => esc_html__( 'Default', 'apexus' ),
                            'background' => esc_html__( 'Background', 'apexus' ),
                            'parallax' => esc_html__( 'Parallax', 'apexus' ),
                        ],
                        'default' => '',  
                    ],
                    [
                        'name' => 'align',
                        'label' => esc_html__( 'Alignment', 'apexus' ),
                        'type' => Controls_Manager::CHOOSE,
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
                            ],
                        ],
                        'control_type' => 'responsive',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-image-wg' => 'display:flex; flex-wrap:wrap; text-align: {{VALUE}}; justify-content:{{VALUE}};',
                        ],
                       /* 'condition' => [
                            'image_mode' => '',
                        ],*/
                    ],
                    [
                        'name' => 'link_to',
                        'label' => esc_html__( 'Link', 'apexus' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'none',
                        'options' => [
                            'none' => esc_html__( 'None', 'apexus' ),
                            'file' => esc_html__( 'Media File', 'apexus' ),
                            'custom' => esc_html__( 'Custom URL', 'apexus' ),
                        ],
                    ],
                    [
                        'name' => 'link',
                        'label' => esc_html__( 'Link', 'apexus' ),
                        'type' => Controls_Manager::URL,
                        'dynamic' => [
                            'active' => true,
                        ],
                        'placeholder' => esc_html__( 'https://your-link.com', 'apexus' ),
                        'condition' => [
                            'link_to' => 'custom',
                        ],
                        'show_label' => false,
                    ],
                    [
                        'name' => 'open_lightbox',
                        'label' => esc_html__( 'Lightbox', 'apexus' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'default',
                        'options' => [
                            'default' => esc_html__( 'Default', 'apexus' ),
                            'yes' => esc_html__( 'Yes', 'apexus' ),
                            'no' => esc_html__( 'No', 'apexus' ),
                        ],
                        'condition' => [
                            'link_to' => 'file',
                        ],
                    ],
                    
                ],
            ],
            [
                'name'     => 'bg_parallax_section',
                'label'    => esc_html__('Background Parallax', 'apexus' ),
                'tab'      => 'content',
                'controls' => array_merge(
                    [
                        [
                            'name' => 'bg_parallax_width',
                            'label' => esc_html__('Background Width', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'default' => [
                                'unit' => '%',
                            ],
                            'tablet_default' => [
                                'unit' => '%',
                            ],
                            'mobile_default' => [
                                'unit' => '%',
                            ],
                            'size_units' => [ '%', 'px', 'vw' ],
                            'range' => [
                                '%' => [
                                    'min' => 1,
                                    'max' => 100,
                                ],
                                'px' => [
                                    'min' => 1,
                                    'max' => 1920,
                                ],
                                'vw' => [
                                    'min' => 1,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-wg' => 'width: {{SIZE}}{{UNIT}};',
                            ],

                        ],
                        [
                            'name' => 'bg_parallax_height',
                            'label' => esc_html__('Background Height', 'apexus' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'default' => [
                                'unit' => 'px',
                            ],
                            'tablet_default' => [
                                'unit' => 'px',
                            ],
                            'mobile_default' => [
                                'unit' => 'px',
                            ],
                            'size_units' => [ 'px', 'vh' ],
                            'range' => [
                                'px' => [
                                    'min' => 1,
                                    'max' => 1000,
                                ],
                                'vh' => [
                                    'min' => 1,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-wg' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                             
                        ]
                    ],
                    apexus_position_option_base([
                            'prefix' => '',
                            'selectors_class' => '.parallax-inner',
                            'condition' => []
                        ]
                    ),
                    apexus_parallax_effect_option([
                            'prefix' => '',
                            'condition' => []
                        ]
                    )
                ),
                'condition' => [
                    'image_mode' => 'parallax',
                ],
            ],
            [
                'name' => 'parallax_section',
                'label' => esc_html__('Parallax Settings', 'apexus' ),
                'tab'      => 'content',
                'controls' => [
                    [
                        'name' => 'pxl_parallax',
                        'label' => esc_html__( 'Parallax Type', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            ''        => esc_html__( 'None', 'apexus' ),
                            'y'       => esc_html__( 'Transform Y', 'apexus' ),
                            'x'       => esc_html__( 'Transform X', 'apexus' ),
                            'z'       => esc_html__( 'Transform Z', 'apexus' ),
                            'rotateX' => esc_html__( 'RotateX', 'apexus' ),
                            'rotateY' => esc_html__( 'RotateY', 'apexus' ),
                            'rotateZ' => esc_html__( 'RotateZ', 'apexus' ),
                            'scaleX'  => esc_html__( 'ScaleX', 'apexus' ),
                            'scaleY'  => esc_html__( 'ScaleY', 'apexus' ),
                            'scaleZ'  => esc_html__( 'ScaleZ', 'apexus' ),
                            'scale'   => esc_html__( 'Scale', 'apexus' ),
                        ],
                    ],
                    [
                        'name' => 'parallax_value',
                        'label' => esc_html__('Value', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => '',
                        'condition' => [ 'pxl_parallax!' => '']  
                    ],
                    [
                        'name' => 'pxl_parallax_screen',
                        'label'   => esc_html__( 'Parallax In Screen', 'apexus' ),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'control_type' => 'responsive',
                        'default' => '',
                        'options' => array(
                            '' => esc_html__( 'Default', 'apexus' ),
                            'no'   => esc_html__( 'No', 'apexus' ),
                        ),
                        'prefix_class' => 'pxl-parallax%s-',
                        'condition' => [ 'pxl_parallax!' => '']  
                    ]
                    
                ]
            ],
            [
                'name'     => 'style_section',
                'label'    => esc_html__( 'Style', 'apexus' ),
                'tab'      => Controls_Manager::TAB_STYLE,
                'controls' => [
                    [
                        'name'        => 'width',
                        'label' => esc_html__( 'Width', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'default' => [
                            'unit' => '%',
                        ],
                        'tablet_default' => [
                            'unit' => '%',
                        ],
                        'mobile_default' => [
                            'unit' => '%',
                        ],
                        'size_units' => [ '%', 'px', 'vw' ],
                        'range' => [
                            '%' => [
                                'min' => 1,
                                'max' => 100,
                            ],
                            'px' => [
                                'min' => 1,
                                'max' => 1000,
                            ],
                            'vw' => [
                                'min' => 1,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ],
                    [
                        'name'        => 'max_width',
                        'label' => esc_html__( 'Max Width', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'default' => [
                            'unit' => '%',
                        ],
                        'tablet_default' => [
                            'unit' => '%',
                        ],
                        'mobile_default' => [
                            'unit' => '%',
                        ],
                        'size_units' => [ '%', 'px', 'vw' ],
                        'range' => [
                            '%' => [
                                'min' => 1,
                                'max' => 100,
                            ],
                            'px' => [
                                'min' => 1,
                                'max' => 1000,
                            ],
                            'vw' => [
                                'min' => 1,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} img' => 'max-width: {{SIZE}}{{UNIT}};',
                        ],
                    ],
                    [
                        'name'        => 'height',
                        'label' => esc_html__( 'Height', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'default' => [
                            'unit' => 'px',
                        ],
                        'tablet_default' => [
                            'unit' => 'px',
                        ],
                        'mobile_default' => [
                            'unit' => 'px',
                        ],
                        'size_units' => [ 'px', '%', 'vh', 'vw' ],
                        'range' => [
                            'px' => [
                                'min' => 1,
                                'max' => 1000,
                            ],
                            'vh' => [
                                'min' => 1,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ],
                    [
                        'name'        => 'object-fit',
                        'label' => esc_html__( 'Object Fit', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'control_type' => 'responsive',
                        'options' => [
                            '' => esc_html__( 'Default', 'apexus' ),
                            'fill' => esc_html__( 'Fill', 'apexus' ),
                            'cover' => esc_html__( 'Cover', 'apexus' ),
                            'contain' => esc_html__( 'Contain', 'apexus' ),
                        ],
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} img' => 'object-fit: {{VALUE}};',
                        ],
                        'condition' => [
                            'image_mode' => '',
                        ],
                    ],
                    [
                        'name'         => 'image_border_radius',
                        'label'        => esc_html__( 'Border Radius', 'apexus' ),
                        'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                        'control_type' => 'responsive',
                        'size_units'   => [ 'px', '%' ],
                        'selectors'    => [
                            '{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-bg-parallax' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ],
                    [
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
                            '{{WRAPPER}} img, {{WRAPPER}} .pxl-bg-parallax' => 'border-style: {{VALUE}};',
                        ],
                    ],
                    [
                        'name' => 'border_width',
                        'label' => esc_html__( 'Border Width', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} img, {{WRAPPER}} .pxl-bg-parallax' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                        'condition' => ['border_type!' => '']
                    ],
                    [
                        'name' => 'border_color',
                        'label' => esc_html__( 'Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} img, {{WRAPPER}} .pxl-bg-parallax' => 'border-color: {{VALUE}};',
                        ],
                        'condition' => ['border_type!' => '']
                    ],
                    [
                        'name'      => 'filter_color',
                        'label'     => esc_html__('Filter Color', 'apexus' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'return_value' => 'yes'
                    ],
                    [
                        'name'      => 'clip_path',
                        'label'     => esc_html__('Clip Path', 'apexus' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'return_value' => 'yes'
                    ],
                    [
                        'name'      => 'cl_top_Left',
                        'label' => esc_html__('Top Left', 'apexus'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ '%', 'px' ],
                        'default' => [ 'size' => '', 'unit' => '%' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-image-wg' => '--top-Left: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'clip_path' => 'yes'
                        ]
                    ],
                    [
                        'name'      => 'cl_left_top',
                        'label' => esc_html__('Left Top', 'apexus'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ '%', 'px' ],
                        'default' => [ 'size' => '', 'unit' => '%' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-image-wg' => '--left-top: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'clip_path' => 'yes'
                        ]
                    ],
                    [
                        'name'      => 'cl_right_bottom',
                        'label' => esc_html__('Right Bottom', 'apexus'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ '%', 'px' ],
                        'default' => [ 'size' => '', 'unit' => '%' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-image-wg' => '--right-bottom: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'clip_path' => 'yes'
                        ]
                    ],
                    [
                        'name'      => 'cl_bottom_right',
                        'label' => esc_html__('Bottom Right', 'apexus'),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ '%', 'px' ],
                        'default' => [ 'size' => '', 'unit' => '%' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-image-wg' => '--bottom-right: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => [
                            'clip_path' => 'yes'
                        ]
                    ],
                ]
            ],
            [
                'name' => 'custom_style_section',
                'label' => esc_html__('Custom Style', 'apexus' ),
                'tab'      => 'style',
                'controls' => [
                    [
                        'name' => 'custom_style',
                        'label' => esc_html__( 'Style', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            ''                => esc_html__( 'None', 'apexus' ),
                            'pxl-transition'  => esc_html__( 'Transition', 'apexus' ),
                            'draw-from-top'   => esc_html__( 'Draw From Top', 'apexus' ),
                            'draw-from-left'  => esc_html__( 'Draw From Left', 'apexus' ),
                            'draw-from-right' => esc_html__( 'Draw From Right', 'apexus' ),
                            'move-from-left'  => esc_html__( 'Move From Left', 'apexus' ),
                            'move-from-right' => esc_html__( 'Move From Right', 'apexus' ),
                            'skew-in'         => esc_html__( 'Skew In Left', 'apexus' ),
                            'skew-in-right'   => esc_html__( 'Skew In Right', 'apexus' ),
                            'zoom-in'         => esc_html__( 'Zoom In', 'apexus' ),
                            'zoom-out'         => esc_html__( 'Zoom Out', 'apexus' ),
                            'scale pxl-animated-waypoint'         => esc_html__( 'Scale', 'apexus' ),
                        ],
                    ],
                    [
                        'name'      => 'custom_animation_delay',
                        'label'     => esc_html__( 'Custom Animation Delay', 'apexus' ),
                        'type'      => \Elementor\Controls_Manager::NUMBER,
                        'min'       => 0,
                        'step'      => 100,
                        'separator' => 'after',
                    ],
                    [
                        'name' => 'img_animation',
                        'label' => esc_html__( 'Animation', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => array(
                            'default'=> esc_html__( 'Default', 'apexus' ),
                            'up-down-move'   => esc_html__( 'Up Down Move', 'apexus' ),
                            'animated-rotate'   => esc_html__( 'Animated Rotate', 'apexus' ),
                            'shape-animate1'   => esc_html__( 'Shape Animate 1', 'apexus' ),
                            'shape-animate2'   => esc_html__( 'Shape Animate 2', 'apexus' ),
                            'shape-animate3'   => esc_html__( 'Shape Animate 3', 'apexus' ),
                            'shape-animate4'   => esc_html__( 'Shape Animate 4', 'apexus' ),
                        ),
                        'default'      => 'default',
                    ],
                ]
            ],
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Image());