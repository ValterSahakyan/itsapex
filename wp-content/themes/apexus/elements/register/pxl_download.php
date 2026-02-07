<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class Pxl_download extends Pxl_Widget_Base{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_download',
            'title'    => esc_html__('PXL Download', 'apexus'),
            'icon'     => 'eicon-file-download',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus', 'download'],
            'params'   => $this->get_params()
        ];
        parent::__construct($data, $args);
    }
    public function get_params(){
        return [
            array(
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
                                'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_download-1.jpg'
                            ],
                        ],
                        'prefix_class' => 'pxl-download-layout-',
                    ),
                )
            ),
            array(
                'name'     => 'list_section',
                'label'    => esc_html__( 'Content Settings', 'apexus' ),
                'tab'      => 'content',
                'controls' => array(
                    array(
                        'name' => 'download',
                        'label' => esc_html__('Download Lists', 'apexus'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'default' => [],
                        'controls' => array(
                            array(
                                'name' => 'file_name',
                                'label' => esc_html__('File Name', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'file_type_icon',
                                'label' => esc_html__('File Icon', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::ICONS,
                                'fa4compatibility' => 'icon',
                                'default' => [
                                    'value' => 'fas fa-star',
                                    'library' => 'fa-solid',
                                ],
                            ),
                            array(
                                'name' => 'link',
                                'label' => esc_html__('Link', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::URL,
                            ),
                        ),
                        'title_field' => '{{{ file_name }}}',
                    ),
                )
            ),
            array(
                'name' => 'style_section',
                'label' => esc_html__('Style', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'controls' => array(
                    array(
                        'name' => 'text_typography',
                        'label' => esc_html__('Text Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-download .item-download .download-title',
                    ),
                    array(
                        'name' => 'text_color',
                        'label' => esc_html__('Text Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-download .item-download .download-title' => 'color: {{VALUE}}; background-image: linear-gradient(transparent calc(100% - 1px), {{VALUE}} 1px);',
                        ],
                    ),
                    array(
                        'name'  => 'font_size',
                        'label' => esc_html__( 'Icon Size', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-download .item-download svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-download .item-download i' => 'font-size: {{SIZE}}{{UNIT}};'
                        ],
                    ),
                    array(
                        'name' => 'icon_color',
                        'label' => esc_html__('Icon Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-download .item-download svg' => 'fill: {{VALUE}};',
                            '{{WRAPPER}} .pxl-download .item-download i' => 'color: {{VALUE}};'
                        ],
                    ),
                    array(
                        'name' => 'background_color',
                        'label' => esc_html__('Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-download .item-download' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'shadow_color',
                        'label' => esc_html__('Shadow Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-download .item-download' => '--color-shadow: {{VALUE}};',
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
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-download .item-download' => 'margin-top: {{SIZE}}{{UNIT}};',
                        ],
                    ),
                ),
            ),
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_download()); 