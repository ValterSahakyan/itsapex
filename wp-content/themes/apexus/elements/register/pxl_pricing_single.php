<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
class Pxl_Pricing_Single extends Pxl_Widget_Base{
    public function __construct($data = [], $args = null) {
        $args = [
            'name'     => 'pxl_pricing_single',
            'title'    => esc_html__('Pxl Pricing', 'apexus'),
            'icon'     => 'eicon-price-table',
            'scripts'  => [],
            'styles'   => [],
            'keywords' => ['apexus', 'pricing'],
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
                                'image' => get_template_directory_uri() . '/elements/assets/imgs/pxl_pricing_single-1.webp'
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
                        'name' => 'icon_pricing',
                        'label' => esc_html__('Icon', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                    ),
                    array(
                        'name' => 'title',
                        'label' => esc_html__('Title', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'placeholder' => esc_html__('Enter your title', 'apexus' ),
                        'label_block' => true,
                    ),
                    array(
                        'name'        => 'price_currency',
                        'label'       => esc_html__('Currency', 'apexus'),
                        'type'        => \Elementor\Controls_Manager::TEXT,
                    ),
                    array(
                        'name'        => 'price_value',
                        'label'       => esc_html__('Price', 'apexus'),
                        'type'        => \Elementor\Controls_Manager::TEXT,
                    ),
                    array(
                        'name'        => 'price_suffix',
                        'label'       => esc_html__('Price Suffix', 'apexus'),
                        'type'        => \Elementor\Controls_Manager::TEXT,
                        'default'     => 'Per Month'
                    ), 
                    array(
                        'name'        => 'desc',
                        'label'       => esc_html__('Description', 'apexus'),
                        'type'        => \Elementor\Controls_Manager::TEXTAREA,
                    ), 
                    array(
                        'name' => 'button_text',
                        'label' => esc_html__('Button Text', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => '',
                        'label_block' => true,
                    ),
                    array(
                        'name' => 'button_link',
                        'label' => esc_html__('Button Link', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::URL,
                        'default' => [
                            'url' => '#',
                        ],
                    ),
                    array(
                        'name' => 'content_list',
                        'label' => esc_html__('Feature', 'apexus'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'controls' => array(
                            array(
                                'name' => 'selected_icon',
                                'label' => esc_html__('Icon', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::ICONS,
                                'fa4compatibility' => 'icon',
                                'default' => [
                                    'value' => 'pxli pxli-check-circle1',
                                    'library' => 'pxli-check-circle1',
                                ],
                            ),
                            array(
                                'name' => 'content',
                                'label' => esc_html__('Content', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                            ),
                            array(
                                'name' => 'active',
                                'label' => esc_html__('Active', 'apexus' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'options' => [
                                    'no' => 'No',
                                    'yes' => 'Yes',
                                ],
                                'default' => 'no',
                            ),
                            array(
                                'name' => 'description_active',
                                'label' => esc_html__('Description', 'apexus'),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'label_block' => true,
                                'condition' =>[
                                    'active' => 'yes'
                                ]
                            ),
                        ),
                        'title_field' => '{{{ content }}}',
                    ),
                    array(
                        'name' => 'brand',
                        'label' => esc_html__('Highlight Text', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'placeholder' => esc_html__('Enter the Highlight', 'apexus' ),
                        'label_block' => true,
                    ),
                ),
            ],
            [
                'name' => 'style_section',
                'label' => esc_html__('Style Settings', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'controls' => array( 
                    array(
                        'name' => 'pricing_bg',
                        'label' => esc_html__('Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .inner-item' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'pricing_bg_hover',
                        'label' => esc_html__('Background Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .inner-item:hover' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'bg_border_radius',
                        'label' => esc_html__('Border Radius', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px','%' ],
                        'default' => ['px'],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .inner-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name' => 'pricing_padding',
                        'label' => esc_html__('Padding', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px' ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .inner-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'control_type' => 'responsive',
                    ), 
                    array(
                        'name' => 'border_color_box',
                        'label' => esc_html__('Border Color Box', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .inner-item' => 'border-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'border_color_box_hover',
                        'label' => esc_html__('Border Color Hover Box', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .inner-item:hover' => 'border-color: {{VALUE}};',
                        ],
                        'separator' => 'after'
                    ),
                    array(
                        'name' => 'title_typography',
                        'label' => esc_html__('Title Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-pricing-single .pricing-title',
                    ),
                    array(
                        'name' => 'title_color',
                        'label' => esc_html__('Title Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .pricing-title' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'title_hover_color',
                        'label' => esc_html__('Title Hover Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .inner-item:hover .pricing-title' => 'color: {{VALUE}};',
                        ],
                        'separator' => 'after'
                    ),
                    array(
                        'name' => 'price_color',
                        'label' => esc_html__('Price Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .pricing-price' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-pricing-single.highlight-active .pricing-price span' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'price_hover_color',
                        'label' => esc_html__('Price Hover Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .inner-item:hover .pricing-price' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'price_typography',
                        'label' => esc_html__('Price Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-pricing-single .pricing-price',
                    ),
                    array(
                        'name' => 'suffix_color',
                        'label' => esc_html__('Price Suffix Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .pricing-price .price-suffix' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'suffix_hover_color',
                        'label' => esc_html__('Price Suffix Hover Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .inner-item:hover .price-suffix' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'description_typography',
                        'label' => esc_html__('Description Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-pricing-single .desc',
                    ),
                    array(
                        'name' => 'des_color',
                        'label' => esc_html__('Description Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .desc' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'des_hover_color',
                        'label' => esc_html__('Description Hover Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .inner-item:hover .desc' => 'color: {{VALUE}};',
                        ],
                        'separator' => 'after'
                    ),
                    array(
                        'name' => 'feature_color',
                        'label' => esc_html__('Feature Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .item-feature .item-text' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'feature_hover_color',
                        'label' => esc_html__('Feature Hover Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .inner-item:hover .item-feature .item-text' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'feature_icon_color',
                        'label' => esc_html__('Feature Icon Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .item-feature .pxl-icon i' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .pxl-pricing-single .item-feature .pxl-icon svg' => 'fill: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'feature_icon_bg_color',
                        'label' => esc_html__('Feature Icon Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .item-feature .pxl-icon' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'active_feature_color',
                        'label' => esc_html__('Active Feature Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .item-feature .item-text2' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'feature_typography',
                        'label' => esc_html__('Feature Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-pricing-single .item-feature .item-text',
                    ),
                      array(
                        'name' => 'active_feature_typography',
                        'label' => esc_html__('Active Feature Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-pricing-single .item-feature .item-text2',
                    ),
                    array(
                        'name' => 'icon_fontsize',
                        'label' => esc_html__('Feature Icon Font Size (px)', 'apexus' ),
                        'control_type' => 'responsive',
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .item-feature .pxl-icon i' => 'font-size: {{VALUE}}px;',
                            '{{WRAPPER}} .pxl-pricing-single .item-feature .pxl-icon svg' => 'width: {{VALUE}}px; height: {{VALUE}}px;'
                        ],
                    ),
                    array(
                        'name' => 'icon_spacer',
                        'label' => esc_html__('Feature Icon Spacer', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'control_type' => 'responsive',
                        'size_units' => [ 'px' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 50,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .item-feature' => 'gap: {{SIZE}}{{UNIT}};'
                        ],
                        'separator' => 'after'
                    ),
                    array(
                        'name' => 'button_color',
                        'label' => esc_html__('Button Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .pricing-button .btn-primary' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'button_typography',
                        'label' => esc_html__('Button Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-pricing-single .pricing-button .btn-primary',
                    ),
                    array(
                        'name' => 'button_color_hover',
                        'label' => esc_html__('Button Hover Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .inner-item:hover .btn-primary' => 'color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'button_bg_color',
                        'label' => esc_html__('Button Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .pricing-button .btn-primary' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'button_bg_hover',
                        'label' => esc_html__('Button Hover Background', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .inner-item:hover .btn-primary' => 'background-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'button_border_color',
                        'label' => esc_html__('Button Border Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .pricing-button .btn-primary' => 'border-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'button_border_color_hover',
                        'label' => esc_html__('Button Border Color Hover', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .inner-item:hover .btn-primary' => 'border-color: {{VALUE}};',
                        ],
                    ),
                    array(
                        'name' => 'button_border_radius',
                        'label' => esc_html__('Border Radius', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'control_type' => 'responsive',
                        'size_units' => ['px','%'],
                        'default' => ['px'],
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .pricing-button .btn-primary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ),
                    array(
                        'name' => 'box_shadow_btn',                    
                        'type' => 'box-shadow',     
                        'control_type' => 'group',                      
                        'selector' => '{{WRAPPER}} .pxl-pricing-single .inner-item .btn-primary',
                    ),
                    array(
                        'name' => 'item_highlight',
                        'label' => esc_html__('Highlight', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            'highlight-none' => 'No',
                            'highlight-active' => 'Yes',
                        ],
                        'default' => 'highlight-none',
                        'separator' => 'before'
                    ),
                    array(
                        'name' => 'item_highlight_bg',
                        'label' => esc_html__('Hightlight Background Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .brand' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => ['item_highlight' => 'highlight-active']
                    ), 
                    array(
                        'name' => 'item_highlight_color',
                        'label' => esc_html__('Hightlight Color', 'apexus' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .pxl-pricing-single .brand' => 'color: {{VALUE}};',
                        ],
                        'condition' => ['item_highlight' => 'highlight-active']
                    ),
                    array(
                        'name' => 'item_highlight_typography',
                        'label' => esc_html__('Highlight Typography', 'apexus' ),
                        'type' => \Elementor\Group_Control_Typography::get_type(),
                        'control_type' => 'group',
                        'selector' => '{{WRAPPER}} .pxl-pricing-single .brand',
                        'condition' => ['item_highlight' => 'highlight-active']
                    ),
                ),
            ],
        ];
    }
}
\Elementor\Plugin::instance()->widgets_manager->register(new Pxl_Pricing_Single()); 