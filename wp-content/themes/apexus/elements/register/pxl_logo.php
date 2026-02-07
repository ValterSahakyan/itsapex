<?php
use Elementor\Controls_Manager;
class Pxl_Logo extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_logo',
            'title'    => esc_html__('Pxl Logo', 'apexus'),
            'icon'     => 'eicon-image',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus', 'logo', 'image'],
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
                    [
                        'name' => 'logo',
                        'label' => esc_html__('Logo', 'apexus' ),
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'logo_max_width',
                        'label' => esc_html__('Max Width', 'apexus' ),
                        'type' => Controls_Manager::SLIDER,
                        'description' => esc_html__('Enter number.', 'apexus' ),
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 3000,
                            ],
                        ],
                        'control_type' => 'responsive',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-logo img' => 'max-width: {{SIZE}}{{UNIT}};',
                        ],
                    ],
                    [
                        'name'         => 'logo_align',
                        'label'        => esc_html__( 'Alignment', 'apexus' ),
                        'type'         => Controls_Manager::CHOOSE,
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
                            '{{WRAPPER}} .pxl-logo' => 'justify-content: {{VALUE}};',
                        ],
                    ],
                    [
                        'name' => 'logo_link',
                        'label' => esc_html__('Link', 'apexus' ),
                        'type' => Controls_Manager::URL,
                    ],
                ],
            ]
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Logo());