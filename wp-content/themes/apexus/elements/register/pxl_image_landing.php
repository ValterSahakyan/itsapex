<?php
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
class Pxl_image_landing extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_image_landing',
            'title'    => esc_html__('PXL Image Landing', 'apexus'),
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
                                'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_image_landing-1.webp'
                            ],
                        ],
                    ),
                )
            ),
            array(
                'name' => 'content_section',
                'label' => esc_html__('Content', 'apexus' ),
                'tab' => 'content',
                'controls' => array(
                    array(
                        'name' => 'selected_image',
                        'label' => esc_html__('Image', 'apexus' ),
                        'type' => 'media',
                    ),
                    array(
                        'name' => 'title_text',
                        'label' => esc_html__('Title Text', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Homepage', 'apexus'),
                    ),
                    array(
                        'name' => 'link_type',
                        'label' => esc_html__('Link Type', 'apexus'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options'       => [
                            'url'   => esc_html__('URL', 'apexus'),
                            'page'  => esc_html__('Existing Page', 'apexus'),
                        ],
                        'default'       => 'url',
                    ),
                    array(
                        'name' => 'link',
                        'label' => esc_html__('Link', 'apexus'),
                        'type' => \Elementor\Controls_Manager::URL,
                        'placeholder' => esc_html__('https://your-link.com', 'apexus' ),
                        'condition'     => [
                            'link_type'     => 'url',
                        ],
                        'default' => [
                            'url' => '#',
                        ],
                    ),
                    array(
                        'name' => 'page_link',
                        'label' => esc_html__('Existing Page', 'apexus'),
                        'type' => \Elementor\Controls_Manager::SELECT2,
                        'options'       => pxl_get_all_page(),
                        'condition'     => [
                            'link_type'     => 'page',
                        ],
                        'multiple'      => false,
                        'label_block'   => true,
                    ),
                    array(
                        'name' => 'open_in_new',
                        'label' => esc_html__('Open in new tab', 'apexus'),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'condition' => [
                            'link_type' => 'page',
                        ],
                    ),

                ),
            ),
            array(
                'name' => 'style_section',
                'label' => esc_html__('Style', 'apexus' ),
                'tab' => 'content',
                'controls' => array(
                    array(
                        'name' => 'title_typography',
                        'label' => esc_html__('Title Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-image-landing .image-title',
                    ),
                    array(
                        'name' => 'title_color',
                        'label' => esc_html__('Title Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-image-landing .image-title' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'cursor_typography',
                        'label' => esc_html__('Cursor Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-image-landing #circle-cursor',
                    ),
                    array(
                        'name' => 'cursor_color',
                        'label' => esc_html__('Cursor Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-image-landing #circle-cursor' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'cursor_bg_color',
                        'label' => esc_html__('Cursor Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-image-landing #circle-cursor' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'border_color',
                        'label' => esc_html__('Border Color', 'apexus' ),
                        'type' => 'color',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-image-landing' => 'border-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'background_color',
                        'label' => esc_html__('Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::HEADING,
                    ),
                    array(
                        'name' => 'background_cl',
                        'label' => esc_html__( 'Background Color', 'apexus' ),
                        'type' => \Elementor\Group_Control_Background::get_type(),
                        'types' => [ 'classic', 'gradient' ],
                        'control_type' => 'group',
                        'exclude' => [ 'image' ],
                        'selector' => '{{WRAPPER}} .pxl-image-landing',
                        'fields_options' => [
                            'background' => [
                                'default' => 'gradient',
                            ],
                        ],
                    ),
                    array(
                        'name' => 'color_overlay_img',
                        'label' => esc_html__('Color Overlay Image', 'apexus' ),
                        'type' => 'color',
                        'selectors' => [
                            '{{WRAPPER}} .pxl-image-landing .image-wrap a::after' => '--color-overlay: {{VALUE}};',
                        ],
                    ),
                ),
            ),
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_image_landing());