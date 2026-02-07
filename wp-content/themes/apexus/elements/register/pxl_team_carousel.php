<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class Pxl_team_carousel extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_team_carousel',
            'title'    => esc_html__('Pxl Team Carousel', 'apexus'),
            'icon'     => 'eicon-user-circle-o',
            'scripts'  => [
                'swiper',
                'apexus-swiper',
            ],
            'styles'   => ['swiper'],
            'keywords' => ['apexus', 'Team Carousel'],
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
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_team_carousel-1.webp'
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
                        'name' => 'content_list',
                        'label' => esc_html__('Content List', 'apexus'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'controls' => array(
                            array(
                                'name' => 'image',
                                'label' => esc_html__('Image', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::MEDIA,
                            ),
                            array(
                                'name' => 'title',
                                'label' => esc_html__('Title', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'position',
                                'label' => esc_html__('Position', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'label_block' => true,
                            ),
                            array(
                                'name'        => 'link_content',
                                'label'       => esc_html__( 'Link', 'apexus' ),
                                'type'        => 'url',
                                'default' => [
                                    'url' => '#',
                                ],
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'social',
                                'label' => esc_html__( 'Social', 'apexus' ),
                                'type' => 'pxl_icons',
                            ),
                        ),
                        'title_field' => '{{{ name }}}',
                    ),
                ),
            ],
            [
                'name' => 'general_section',
                'label' => esc_html__('General Settings', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array_merge(
                    array(
                        array(
                            'name'         => 'preloader',
                            'label'        => esc_html__('Pre Loader Effects', 'apexus'),
                            'type'         => 'select',
                            'default' => '',
                            'options' => [
                                '' => esc_html__( 'None', 'apexus' ),
                                'five-dots' => esc_html__( '5 Dots', 'apexus' ),
                            ],
                        ),
                    )
                )
            ],
            [
                'name' => 'carousel_setting',
                'label' => esc_html__('Carousel Settings', 'apexus'),
                'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                'controls' => array_merge(
                    apexus_carousel_settings()    
                ),
            ],
            [
                'name' => 'section_arrows_settings',
                'label' => esc_html__('Arrows Settings', 'apexus'),
                'tab'      => \Elementor\Controls_Manager::TAB_SETTINGS,
                'controls' => array_merge(
                    apexus_carousel_arrow_settings()   
                )
            ],
            [
                'name' => 'section_dots_settings',
                'label' => esc_html__('Dots Settings', 'apexus'),
                'tab'      => \Elementor\Controls_Manager::TAB_SETTINGS,
                'controls' => array_merge(
                    apexus_carousel_dots_settings()
                )
            ],
            [
                'name' => 'style_section',
                'label' => esc_html__('Style', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'controls' => array(
                    array(
                        'name' => 'img_size',
                        'label' => esc_html__('Image Size', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'description' =>  esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Ex: 370x300 (Width x Height)).', 'apexus')
                    ),
                    array(
                        'name' => 'title_typography',
                        'label' => esc_html__('Title Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-team-carousel .item-title',
                    ),
                    array(
                        'name' => 'title_color',
                        'label' => esc_html__('Title Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-team-carousel .item-title' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'title_color_hover',
                        'label' => esc_html__('Title Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-team-carousel .item-title:hover' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'position_color',
                        'label' => esc_html__('Position Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-team-carousel .item-position' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'icon_color',
                        'label' => esc_html__('Icon Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-team-carousel .item-social a i' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'icon_color_hover',
                        'label' => esc_html__('Icon Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-team-carousel .item-social a:hover i' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'bg_color_icon',
                        'label' => esc_html__('Background Color Icon', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-team-carousel .item-social a' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'bg_color_hover_icon',
                        'label' => esc_html__('Background Color Hover Icon', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-team-carousel .item-social a::before' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'background_color_image',
                        'label' => esc_html__('Background Color Image', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::HEADING,
                    ),
                    array(
                        'name' => 'background_color_img',
                        'label' => esc_html__( 'Background Color Image', 'apexus' ),
                        'type' => \Elementor\Group_Control_Background::get_type(),
                        'types' => [ 'classic', 'gradient' ],
                        'control_type' => 'group',
                        'exclude' => [ 'image' ],
                        'selector' => '{{WRAPPER}} .pxl-team-carousel .item-image',
                        'fields_options' => [
                            'background' => [
                                'default' => 'gradient',
                            ],
                        ],
                    ),
                    array(
                        'name' => 'background_color_box',
                        'label' => esc_html__('Background Color Box', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-team-carousel .item-inner,{{WRAPPER}} .pxl-team-carousel .item-image::after, {{WRAPPER}} .pxl-team-carousel .item-image::before' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'padding_box',
                        'label' => esc_html__('Padding Box', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-team-carousel .item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                    ),
                ),
            ],
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_team_carousel());