<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class Pxl_testimonial_list extends Pxl_Widget_Base
{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_testimonial_list',
            'title'    => esc_html__('PXL Testimonial List', 'apexus'),
            'icon'     => 'eicon-blockquote',
            'scripts'  => [],
            'styles'   => [''],
            'keywords' => ['apexus', 'services'],
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
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_testimonial_list-1.webp'
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
                        'name' => 'selected_icon',
                        'label' => esc_html__('Quote Icon', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        'fa4compatibility' => 'icon',                        
                    ),
                    array(
                        'name'  => 'quote_size',
                        'label' => esc_html__( 'Quote Size', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 10,
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'size' => '',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-list .icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .pxl-testimonial-list .icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};'
                        ],
                    ),
                    array(
                        'name' => 'quote_color',
                        'label' => esc_html__('Quote Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-list .icon-wrapper svg' => 'fill: {{VALUE}};',
                            '{{WRAPPER}} .pxl-testimonial-list .icon-wrapper i' => 'color: {{VALUE}};'
                        ],
                    ), 
                    array(
                        'name' => 'content_list',
                        'label' => esc_html__('List', 'apexus'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'controls' => array(
                            array(
                                'name' => 'image',
                                'label' => esc_html__('Image', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::MEDIA,
                            ),
                            array(
                                'name' => 'title',
                                'label' => esc_html__('Title', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'rows' => 10,
                            ),
                            array(
                                'name' => 'description',
                                'label' => esc_html__('Description', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'rows' => 10,
                            ),
                            array(
                                'name' => 'name',
                                'label' => esc_html__('Name', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'position',
                                'label' => esc_html__('Position', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'subdescription',
                                'label' => esc_html__('Sub Description', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::TEXTAREA,
                                'rows' => 5,
                            ),
                            array(
                                'name' => 'text_rating',
                                'label' => esc_html__('Number Rating', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                                'default' => esc_html__('5.0/5', 'apexus'),
                            ),
                            array(
                                'name' => 'rating',
                                'label' => esc_html__('Rating', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => 'none',
                                'options' => [
                                    'none' => esc_html__('None', 'apexus' ),
                                    'star1' => esc_html__('1 Star', 'apexus' ),
                                    'star2' => esc_html__('2 Star', 'apexus' ),
                                    'star3' => esc_html__('3 Star', 'apexus' ),
                                    'star4' => esc_html__('4 Star', 'apexus' ),
                                    'star5' => esc_html__('5 Star', 'apexus' ),
                                ],
                            ),
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
                    array(
                        'name' => 'title_color',
                        'label' => esc_html__('Title Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-list .item-title' => 'color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name' => 'title_typography',
                        'label' => esc_html__('Title Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-testimonial-list .item-title',
                    ),  
                    array(
                        'name' => 'des_typography',
                        'label' => esc_html__('Description Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-testimonial-list .item-des',
                    ), 
                    array(
                        'name' => 'description_color',
                        'label' => esc_html__('Description Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-list .item-des' => 'color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name'  => 'maxwidth_des',
                        'label' => esc_html__( 'Max Width Description', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 1000,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-list .item-des' => 'max-width: {{SIZE}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name' => 'name_typography',
                        'label' => esc_html__('Name Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-testimonial-list .item-name',
                    ), 
                    array(
                        'name' => 'name_color',
                        'label' => esc_html__('Name Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-list .item-name' => 'color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name' => 'position_typography',
                        'label' => esc_html__('Position Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-testimonial-list .item-position',
                    ),
                    array(
                        'name' => 'position_color',
                        'label' => esc_html__('Position Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-list .item-position' => 'color: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name' => 'border_color',
                        'label' => esc_html__('Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-list .pxl-divider' => 'border-image: repeating-linear-gradient(90deg, {{VALUE}} 0 4px, transparent 4px 15px) 2 round;'
                        ],
                    ), 
                    array(
                        'name' => 'number_rating_typography',
                        'label' => esc_html__('Number Rating Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-testimonial-list .item-rating-star .item-text',
                    ),
                    array(
                        'name' => 'number_rating_color',
                        'label' => esc_html__('Number Rating Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-list .item-rating-star .item-text' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'rating_color',
                        'label' => esc_html__('Rating Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-list .item-rating-star .item-rating i' => 'color: {{VALUE}};',
                        ],
                    ),  
                    array(
                        'name' => 'subdescription_typography',
                        'label' => esc_html__('Sub Description Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-testimonial-list .subdescription',
                    ),
                    array(
                        'name' => 'subdescription_color',
                        'label' => esc_html__('Sub Description Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-list .subdescription' => 'color: {{VALUE}};',
                        ],
                    ),  
                    array(
                        'name' => 'subdescription_icon_color',
                        'label' => esc_html__('Sub Description Icon Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-list .item-subdescription svg' => 'fill: {{VALUE}};',
                        ],
                    ), 
                    array(
                        'name'  => 'width_image',
                        'label' => esc_html__( 'Width Image', 'apexus' ),
                        'type'  => 'slider',
                        'control_type' => 'responsive',
                        'size_units' => [ 'px','%' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 700,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-testimonial-list .box-content' => 'max-width: {{SIZE}}{{UNIT}};',
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
                            '{{WRAPPER}} .pxl-testimonial-list .title' => 'gap: {{SIZE}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name'      => 'clip_path_box',
                        'label'     => esc_html__('Clip Path Box', 'apexus' ),
                        'type'      => Controls_Manager::SWITCHER,
                        'return_value' => 'yes'
                    ),
                ),
            ],
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_testimonial_list());