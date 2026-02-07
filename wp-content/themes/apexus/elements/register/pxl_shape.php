<?php
use Elementor\Controls_Manager;
class Pxl_Shape extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_shape',
            'title'    => esc_html__('Pxl Shape', 'apexus'),
            'icon'     => 'eicon-adjust',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus', 'shape', 'overlay', 'image'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }

    public function get_params(){
        return [
            [
                'name' => 'content_section',
                'label' => esc_html__('Content', 'apexus' ),
                'tab' => 'content',
                'controls' => [
                    array(
                        'name' => 'background_color',
                        'label' => esc_html__( 'Background Color', 'apexus' ),
                        'type' => \Elementor\Group_Control_Background::get_type(),
                        'types' => [ 'classic', 'gradient' ],
                        'control_type' => 'group',
                        'exclude' => [ 'image' ],
                        'selector' => '{{WRAPPER}} .pxl-shape-wg',
                        'fields_options' => [
                            'background' => [
                                'default' => 'classic',
                            ],
                        ],
                    ),
                    array(
                        'name' => 'style_color',
                        'label' => esc_html__('Option Mask', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            '' => esc_html__('Off', 'apexus' ),
                            'mask' => esc_html__('On', 'apexus' ),
                        ],
                    ),
                    [
                        'name'  => 'backdrop_filter',
                        'label' => esc_html__( 'Blur', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-shape-wg' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                        ],
                    ],
                ],
            ]
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Shape());