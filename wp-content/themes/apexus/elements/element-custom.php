<?php 
//use Elementor\Widget_Base as Widget_Base;
use Elementor\Controls_Manager;
 
add_filter( 'pxl_register_widget_common_controls', 'apexus_register_widget_common_controls');
function apexus_register_widget_common_controls($widget){
    $params = [
        [
            'name' => 'pxl_el_effects_ss',
            'label' => esc_html__('Pxl Effects', 'apexus' ),
            'tab' => Controls_Manager::TAB_CONTENT,
            'controls' => array_merge(
                [
                    [
                        'name'      => 'pxl_animation',
                        'label'     => esc_html__('Motion Effect', 'apexus' ),
                        'type'      => Controls_Manager::SELECT,
                        'control_type' => 'responsive',
                        'options' => [
                            ''                      => esc_html__( 'Default', 'apexus' ),
                            'none'                  => esc_html__( 'None', 'apexus' ),
                            'pxl_fadeIn'            => esc_html__( 'Fade In', 'apexus' ),
                            'pxl_fadeInDown'        => esc_html__( 'Fade In Down', 'apexus' ),
                            'pxl_fadeInLeft'        => esc_html__( 'Fade In Left', 'apexus' ),
                            'pxl_fadeInRight'       => esc_html__( 'Fade In Right', 'apexus' ),
                            'pxl_fadeInUp'          => esc_html__( 'Fade In Up', 'apexus' ),
                            'pxl_rotateIn'          => esc_html__( 'Rotate In', 'apexus' ),
                            'pxl_rotateInDownLeft'  => esc_html__( 'Rotate In Down Left', 'apexus' ),
                            'pxl_rotateInDownRight' => esc_html__( 'Rotate In Down Right', 'apexus' ),
                            'pxl_rotateInUpLeft'    => esc_html__( 'Rotate In Up Left', 'apexus' ),
                            'pxl_rotateInUpRight'   => esc_html__( 'Rotate In Up Right', 'apexus' ),
                            'pxl_zoomIn'            => esc_html__( 'Zoom In', 'apexus' ),
                            'gsap'                  => esc_html__( 'Gsap', 'apexus' ),
                        ], 
                        'frontend_available' => true,
                        'default' => '',
                        'prefix_class' => 'pxl-anm%s-'
                    ],
                    [
                        'name'      => 'pxl_anm_el_class_apply',
                        'label'     => esc_html__( 'Element Class Apply', 'apexus' ),
                        'description' => esc_html__('Class that effect is applied for div inner', 'apexus' ),
                        'type'      => Controls_Manager::TEXT,
                        'label_block' => true,
                        'frontend_available' => true,
                        'prefix_class' => 'anm-assign-for-',
                        'condition' => ['pxl_animation' => 'gsap']
                    ], 
                ],
                apexus_gsap_effect_options([
                    'prefix' => 'pxl_from_',
                    'label' => esc_html__( 'From', 'apexus' ),
                    'selectors_class' => '',
                    'frontend_available' => true,
                    'condition' => ['pxl_animation' => 'gsap']
                ]),
                apexus_gsap_effect_options([
                    'prefix' => 'pxl_to_',
                    'label' => esc_html__( 'To', 'apexus' ),
                    'selectors_class' => '',
                    'frontend_available' => true,
                    'condition' => ['pxl_animation' => 'gsap']
                ]),
                [
                    [
                        'name'      => 'pxl_gsap_method',
                        'label'     => esc_html__( 'Method', 'apexus' ),
                        'type'      => Controls_Manager::SELECT,
                        'options' => [
                            '' => esc_html__( 'Default (From / To)', 'apexus' ),
                            'from' => esc_html__( 'From', 'apexus' ),
                            'to' => esc_html__( 'To', 'apexus' )
                        ],
                        'default' => '',
                        'frontend_available' => true,
                        'prefix_class' => 'gsap-method-',
                        'condition' => ['pxl_animation' => 'gsap']
                    ],
                    [
                        'name'      => 'pxl_toggle_actions',
                        'label'     => esc_html__( 'Toggle Actions', 'apexus' ),
                        'type'      => Controls_Manager::SELECT,
                        'options' => [
                            'play none none none' => 'play none none none',
                            'play reverse play reverse' => 'play reverse play reverse',
                            'play none none reverse' => 'play none none reverse',
                            'play none none reset' => 'play none none reset',
                        ],
                        'default' => 'play none none none',
                        'frontend_available' => true,
                        'condition' => ['pxl_animation' => 'gsap']
                    ],
                    [
                        'name'      => 'pxl_once',
                        'label'     => esc_html__( 'Once', 'apexus' ),
                        'type'      => Controls_Manager::SELECT,
                        'options' => [
                            '' => esc_html__( 'Default', 'apexus' ),
                            '1' => esc_html__( 'True', 'apexus' ),
                            '0' => esc_html__( 'False', 'apexus' )
                        ],
                        'default' => '',
                        'frontend_available' => true,
                        'condition' => ['pxl_animation' => 'gsap']
                    ],
                    [
                        'name'      => 'pxl_ease',
                        'label'     => esc_html__( 'Ease', 'apexus' ),
                        'type'      => Controls_Manager::SELECT,
                        'options' => [
                            '' => esc_html__( 'Default', 'apexus' ),
                            'none' => 'none',
                            'power1.in' => 'power1.in',
                            'power1.out' => 'power1.out',
                            'power1.inOut' => 'power1.inOut',
                            'power2.in' => 'power2.in',
                            'power2.out' => 'power2.out',
                            'power2.inOut' => 'power2.inOut',
                            'power3.in' => 'power3.in',
                            'power3.out' => 'power3.out',
                            'power3.inOut' => 'power3.inOut',
                            'circ.in' => 'circ.in',
                            'circ.out' => 'circ.out',
                            'circ.inOut' => 'circ.inOut',
                            'sine.in' => 'sine.in',
                            'sine.out' => 'sine.out',
                            'sine.inOut' => 'sine.inOut'
                        ],
                        'default' => '',
                        'frontend_available' => true,
                        'condition' => ['pxl_animation' => 'gsap']
                    ],
                    [
                        'name'      => 'pxl_scroll_start',
                        'label' => esc_html__( 'Scroll Start', 'apexus' ),
                        'description' => esc_html__('Defines when the animation will start. You can specify this as a percentage of the scroll position (top top, top center, bottom bottom, top 80%, +=100, ...)', 'apexus' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => '',
                        'frontend_available' => true,
                        'condition' => ['pxl_animation' => 'gsap']
                    ], 
                    [
                        'name'      => 'pxl_scroll_end',
                        'label' => esc_html__( 'Scroll End', 'apexus' ),
                        'description' => esc_html__('Defines when the animation will end. Similar to start, you can specify this as a percentage of the scroll position (top top, top center, bottom bottom, bottom 20%, +=100, ...)', 'apexus' ), 
                        'type' => Controls_Manager::TEXT,
                        'default' => '',
                        'frontend_available' => true,
                        'condition' => ['pxl_animation' => 'gsap']
                    ], 
                    [
                        'name'      => 'pxl_animation_duration',
                        'label'     => esc_html__( 'Duration (s: 0.1, 1, 2, 3)', 'apexus' ),
                        'type'      => Controls_Manager::NUMBER,
                        'min'       => 0,
                        'frontend_available' => true,
                        'selectors' => [
                            '{{WRAPPER}}.pxl-animated' => '--pxl-animation-duration: {{VALUE}}s;',
                        ],
                        'condition' => ['pxl_animation!' => ['','none']]
                    ], 
                    [
                        'name'      => 'pxl_animation_delay',
                        'label'     => esc_html__( 'Delay (s: 0.1, 0.2, 0.3)', 'apexus' ),
                        'type'      => Controls_Manager::NUMBER,
                        'min'       => 0,
                        'frontend_available' => true,
                        'condition' => ['pxl_animation!' => ['','none']]
                    ],
                    [
                        'name'      => 'pxl_distance',
                        'label'     => esc_html__( 'Distance (px)', 'apexus' ),
                        'type'      => Controls_Manager::NUMBER,
                        // 'min'       => 0,
                        'selectors' => [
                            '{{WRAPPER}}' => '--pxl-animation-distance: {{VALUE}}px;',
                        ],
                        'condition' => ['pxl_animation' => ['pxl_fadeInUp','pxl_fadeInDown','pxl_fadeInLeft','pxl_fadeInRight']]
                    ],
                    [
                        'name'      => 'pxl_scrub',
                        'label'     => esc_html__( 'Scrub (s: -2, 0 , 1, 2, 8)', 'apexus' ),
                        'type'      => Controls_Manager::NUMBER,
                        'frontend_available' => true,
                        'condition' => ['pxl_animation' => 'gsap']
                    ],
                    [
                        'name'      => 'pxl_stagger',
                        'label'     => esc_html__( 'Stagger (s: 0, 0.1, 0.2, 1, 2)', 'apexus' ),
                        'type'      => Controls_Manager::NUMBER,
                        'min'       => 0,
                        'frontend_available' => true,
                        'condition' => ['pxl_animation' => 'gsap']
                    ],
                     
                ]
            )
        ]
    ];
    $params[] =[
        'name' => 'pxl_el_setting_ss',
        'label' => esc_html__('Pxl Settings', 'apexus' ),
        'tab' => Controls_Manager::TAB_CONTENT,
        'controls' => array_merge(
            apexus_position_option([
                'prefix' => 'pxl_pos_',
                'selectors_class' => '',
                'condition' => ['pxl_pos_position!' => '']
            ]),
            [
                [
                    'name'      => 'pxl_wg_custom_css',
                    'label' => esc_html__('Custom Css', 'apexus' ),
                    'type' => Controls_Manager::CODE,
                    'language' => 'css',
                    'default' => '',
                    'placeholder' => 'Enter your custom CSS here...',
                ]
            ]
        )
    ];
    
    return $params;
}


add_action( 'elementor/element/parse_css', 'pxl_add_post_csss', 10, 2 ); 
function pxl_add_post_csss( $post_css, $element ) {
    if ( $post_css instanceof Dynamic_CSS ) {
        return;
    }
    $element_settings = $element->get_settings();
    if ( empty( $element_settings['pxl_wg_custom_css'] ) ) {
        return;
    }
    $css = trim( $element_settings['pxl_wg_custom_css'] );
    if ( empty( $css ) ) {
        return;
    }
    $css = str_replace( 'selector', $post_css->get_element_unique_selector( $element ), $css );
    $post_css->get_stylesheet()->add_raw_css( $css );
}

function apexus_add_header_setting_el_container( $element, $args ) {
    
    if ( get_post_type( get_the_ID()) === 'pxl-template' && ( get_post_meta( get_the_ID(), 'template_type', true ) === 'header') ) {
        $element->start_controls_section(
            'pxl_container_settings',
            [
                'label' => esc_html__( 'Pxl Header Settings', 'apexus' ),
                'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
            ]
        );
        $element->add_control(
            'pxl_header_screen',
            [
                'label' => esc_html__( 'Header desktop / mobile', 'apexus' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'hide_in_inner' => true,      
                'options'      => array(
                    ''      => esc_html__( 'Default', 'apexus' ),
                    'desktop'      => esc_html__( 'Desktop', 'apexus' ),
                    'mobile' => esc_html__( 'Mobile', 'apexus' ),
                ),
                'default'      => '',
            ]
        );
        $element->add_control(
            'pxl_header_type',
            [
                'label' => esc_html__( 'Header Type', 'apexus' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'hide_in_inner' => true,
                'options'      => array(
                    ''          => esc_html__( 'Select Type', 'apexus' ),
                    'main-sticky'       => esc_html__( 'Header Main & Sticky', 'apexus' ),
                    'sticky'      => esc_html__( 'Header Sticky', 'apexus' ),
                    'transparent' => esc_html__( 'Header Transparent', 'apexus' ),
                    'transparent-sticky' => esc_html__( 'Transparent & Sticky', 'apexus' ),
                    'fixed-top' => esc_html__( 'Header Fixed Top', 'apexus' ),
                ),
                'default'      => '',
                'condition' => ['pxl_header_screen' => 'desktop']
            ]
        );
        $element->add_control(
            'pxl_header_sticky_effect',
            [
                'label' => esc_html__( 'Header Sticky Effect', 'apexus' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'hide_in_inner' => true,
                'options'      => array(
                    ''  => esc_html__('Default', 'apexus'),
                    'transform-y'  => esc_html__('Transform Y', 'apexus'),
                    'rotate-x'     => esc_html__('Rotate X', 'apexus'), 
                ),
                'default'      => '',
                'condition' => [
                    'pxl_header_type' => 'sticky'
                ]
            ]
        );
        $element->add_control(
            'pxl_header_mobile_type',
            [
                'label' => esc_html__( 'Header Type', 'apexus' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'hide_in_inner' => true,
                'options'      => array(
                    ''          => esc_html__( 'Select Type', 'apexus' ),
                    'main-sticky'       => esc_html__( 'Main & Sticky', 'apexus' ),
                    'sticky'      => esc_html__( 'Sticky', 'apexus' ),
                    'transparent' => esc_html__( 'Transparent', 'apexus' ),
                    'transparent-sticky' => esc_html__( 'Transparent & Sticky', 'apexus' ),
                    'fixed-top'          => esc_html__( 'Header Fixed Top', 'apexus' ),
                ),
                'default'      => '',
                'condition' => ['pxl_header_screen' => 'mobile']
            ]
        );
        $element->add_control(
            'pxl_header_mobile_sticky_effect',
            [
                'label' => esc_html__( 'Header Sticky Effect', 'apexus' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'hide_in_inner' => true,
                'options'      => array(
                    ''  => esc_html__('Default', 'apexus'),
                    'transform-y'  => esc_html__('Transform Y', 'apexus'),
                    'rotate-x'     => esc_html__('Rotate X', 'apexus'), 
                ),
                'default'      => '',
                'condition' => [
                    'pxl_header_mobile_type' => 'sticky'
                ]
            ]
        );
        $element->end_controls_section();
    }
    
}

add_action( 'elementor/element/container/section_layout_additional_options/after_section_end', 'apexus_add_header_setting_el_container', 10, 3 );

//widget add control
add_action('elementor/element/common/_section_style/after_section_end', 'apexus_add_custom_common_controls');
function apexus_add_custom_common_controls(\Elementor\Element_Base $element){
    $element->start_controls_section(
        'section_pxl_widget_el',
        [
            'label' => esc_html__( 'Apexus Settings', 'apexus' ),
            'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
        ]
    );
      
    $element->add_responsive_control(
        'widget_width',
        [
            'label' => esc_html__('Widget Width', 'apexus' ),
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
                '{{WRAPPER}} .elementor-widget-container, {{WRAPPER}} .elementor-widget-container > div' => 'width: {{SIZE}}{{UNIT}};',
            ]
        ]
    );
    $element->add_responsive_control(
        'widget_height',
        [
            'label' => esc_html__('Widget Height', 'apexus' ),
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
                'vh' => [
                    'min' => 1,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}, {{WRAPPER}} .elementor-widget-container, {{WRAPPER}} .elementor-widget-container > div' => 'height: {{SIZE}}{{UNIT}};',
            ]
        ]
    );
    $element->add_control(
        'pxl_widget_el_border_animated',
        [
            'label' => esc_html__('Border Animated', 'apexus'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'apexus' ),
            'label_off' => esc_html__( 'No', 'apexus' ),
            'return_value' => 'yes',
            'default' => 'no',
            'separator' => 'after',
        ]
    );
    $element->add_control(
        'pxl_widget_el_parallax_effect',
        [
            'label' => esc_html__('Pxl Parallax Effect', 'apexus' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                ''               => esc_html__( 'None', 'apexus' ),
                'effect mouse-move bound-section' => esc_html__( 'Mouse Move (section hover)', 'apexus' ),
                'effect mouse-move bound-column' => esc_html__( 'Mouse Move (column hover)', 'apexus' ),
                'effect mouse-move mouse-move-scope' => esc_html__( 'Mouse Move Scope Class (mouse-move-scope)', 'apexus' ),
            ],
            'label_block' => true,
            'default' => '',
            'prefix_class' => 'pxl-parallax-'
        ]
    );
    $element->add_control(
        'pxl_widget_el_parallax',
        [
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
        ]
    ); 
    $element->add_control(
        'pxl_widget_el_parallax_value',
        [
            'name' => 'parallax_value',
            'label' => esc_html__('Value', 'apexus' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
            'condition' => [ 'pxl_widget_el_parallax!' => '']  
        ]
    ); 
    $element->add_responsive_control(
        'pxl_widget_align',
        [
            'label' => esc_html__('Alignment', 'apexus' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
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
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .elementor-widget-container' => 'display:flex; flex-wrap:wrap; justify-content: {{VALUE}};'
            ],
        ]
    );
    $element->add_control(
        'pxl_widget_overflow',
        [
            'label' => esc_html__( 'Overflow', 'apexus' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                ''      => esc_html__( 'Default', 'apexus' ),
                'visible'      => esc_html__( 'Visible', 'apexus' ),
                'hidden'       => esc_html__( 'Hidden', 'apexus' ),
            ],
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .elementor-widget-container' => 'overflow: {{VALUE}};',
            ],
            'separator' => 'after'
        ]
    );
    $element->end_controls_section();
 
}

//container render
add_action( 'elementor/element/after_add_attributes', 'apexus_custom_el_attributes', 10, 1 );
function apexus_custom_el_attributes($el){
    
    $settings = $el->get_settings();
     
    if( 'container' == $el->get_type() ) {
        if ( isset( $settings['pxl_header_screen'] ) && !empty($settings['pxl_header_screen'] ) ) {
            $el->add_render_attribute( '_wrapper', 'class', 'pxl-header-'.$settings['pxl_header_screen']);
        }
        if ( isset( $settings['pxl_header_type'] ) && !empty($settings['pxl_header_type'] ) ) {
            $el->add_render_attribute( '_wrapper', 'class', 'pxl-header-'.$settings['pxl_header_type']);
        }
        if ( isset( $settings['pxl_header_sticky_effect'] ) && !empty($settings['pxl_header_sticky_effect'] ) ) {
            $el->add_render_attribute( '_wrapper', 'class', 'pxl-header-'.$settings['pxl_header_sticky_effect']);
        }
        if ( isset( $settings['pxl_header_mobile_type'] ) && !empty($settings['pxl_header_mobile_type'] ) ) {
            $el->add_render_attribute( '_wrapper', 'class', 'pxl-header-mobile-'.$settings['pxl_header_mobile_type']);
        }
        if ( isset( $settings['pxl_header_mobile_sticky_effect'] ) && !empty($settings['pxl_header_mobile_sticky_effect'] ) ) {
            $el->add_render_attribute( '_wrapper', 'class', 'pxl-header-mobile-'.$settings['pxl_header_mobile_sticky_effect']);
        }
        if ( isset( $settings['pxl_section_border_animated'] ) && $settings['pxl_section_border_animated'] == 'yes'  ) {
            $el->add_render_attribute( '_wrapper', 'class', 'pxl-border-section-anm');
        }
    }

    $pxl_animation = ! empty( $settings['pxl_animation'] );
    $has_animation = $pxl_animation && 'none' !== $settings['pxl_animation'] && '' !== $settings['pxl_animation'] && 'gsap' !== $settings['pxl_animation'];
    if ( $has_animation ) {
        $is_static_render_mode = \Elementor\Plugin::$instance->frontend->is_static_render_mode();

        if ( ! $is_static_render_mode ) {
            $el->add_render_attribute( '_wrapper', 'class', 'pxl-invisible' );
             
        }
    }
       
}
 
add_action('elementor/frontend/container/before_render', function($container) {
    $settings = $container->get_settings_for_display();

    if(!empty($settings['pxl_section_border_animated']) && $settings['pxl_section_border_animated'] === 'yes'){
        $unit = $settings['border_width']['unit'] ?? 'px';

        $border_num = 0;
        if( (int)$settings['border_width']['top'] > 0) $border_num++;
        if( (int)$settings['border_width']['right'] > 0) $border_num++;
        if( (int)$settings['border_width']['bottom'] > 0) $border_num++;
        if( (int)$settings['border_width']['left'] > 0) $border_num++;

        $bd_top_style = 'style="border-width: '.$settings['border_width']['top'].$unit.' 0 0 0; border-style: '.$settings['border_border'].'; border-color: '.$settings['border_color'].';"';
        $bd_right_style = 'style="border-width: 0 '.$settings['border_width']['right'].$unit.' 0 0; border-style: '.$settings['border_border'].'; border-color: '.$settings['border_color'].';"';
        $bd_bottom_style = 'style="border-width: 0 0 '.$settings['border_width']['bottom'].$unit.' 0; border-style: '.$settings['border_border'].'; border-color: '.$settings['border_color'].';"';
        $bd_left_style = 'style="border-width: 0 0 0 '.$settings['border_width']['left'].$unit.'; border-style: '.$settings['border_border'].'; border-color: '.$settings['border_color'].';"';

        echo '<div class="pxl-border-animated num-'.$border_num.'">';
        echo '<div class="pxl-border-anm bt w-100" '.$bd_top_style.'></div>';
        echo '<div class="pxl-border-anm br h-100" '.$bd_right_style.'></div>';
        echo '<div class="pxl-border-anm bb w-100" '.$bd_bottom_style.'></div>';
        echo '<div class="pxl-border-anm bl h-100" '.$bd_left_style.'></div>';
    }
    /////
    $tl = !empty($settings['clip_top_left']['size']) ? $settings['clip_top_left']['size'] . $settings['clip_top_left']['unit'] : '0%';
    $lt = !empty($settings['clip_left_top']['size']) ? $settings['clip_left_top']['size'] . $settings['clip_left_top']['unit'] : '0%';
    $rb = !empty($settings['clip_right_bottom']['size']) ? $settings['clip_right_bottom']['size'] . $settings['clip_right_bottom']['unit'] : '0%';
    $br = !empty($settings['clip_bottom_right']['size']) ? $settings['clip_bottom_right']['size'] . $settings['clip_bottom_right']['unit'] : '0%';

    if ( $tl === '0%' && $lt === '0%' && $rb === '0%' && $br === '0%' ) return;
    $clip_path = "polygon({$tl} 0, 100% 0, 100% {$rb}, {$br} 100%, 0 100%, 0 {$lt})";

    $existing_style = $container->get_render_attribute_string('_wrapper');
    $container->add_render_attribute( '_wrapper', 'style', "clip-path: {$clip_path};" );
}, 10);

add_action('elementor/frontend/container/after_render', function($container) {
    $settings = $container->get_settings_for_display();

    if(!empty($settings['pxl_section_border_animated']) && $settings['pxl_section_border_animated'] === 'yes'){
        echo '</div>';
    }
}, 20);



 

//widget render
add_action('elementor/widget/before_render_content','apexus_custom_widget_el_before_render', 10, 1 );
function apexus_custom_widget_el_before_render($el){  
    $settings = $el->get_settings();
    if(!empty($settings['pxl_widget_el_parallax']) && !empty($settings['pxl_widget_el_parallax_value'])){
        $parallax_settings = json_encode([
            $settings['pxl_widget_el_parallax'] => $settings['pxl_widget_el_parallax_value']
        ]);
        $el->add_render_attribute( '_wrapper', 'data-parallax', $parallax_settings );
    }
}
 
add_filter('elementor/widget/render_content','apexus_custom_widget_el_render_content', 10, 2 );
function apexus_custom_widget_el_render_content($widget_content, $el){  
    $settings = $el->get_settings();
    if( isset($settings['pxl_widget_el_border_animated']) && $settings['pxl_widget_el_border_animated'] == 'yes' ){

        $el->add_render_attribute( '_wrapper', 'class', 'pxl-border-wg-anm');

        $breakpoints = ['laptop','tablet_extra','tablet','mobile_extra','mobile'];
         
        $unit = $settings['_border_width']['unit'];
        $border_num = 0;

        $bt_width = $settings['_border_width']['top'];
        $br_width = $settings['_border_width']['right'];
        $bb_width = $settings['_border_width']['bottom'];
        $bl_width = $settings['_border_width']['left'];
        foreach ($breakpoints as $v) {
            if( isset($settings['_border_width_'.$v]['top']) && (int)$settings['_border_width_'.$v]['top'] > 0 )
                $bt_width = $settings['_border_width_'.$v]['top'];
            if( isset($settings['_border_width_'.$v]['right']) && (int)$settings['_border_width_'.$v]['right'] > 0 )
                $br_width = $settings['_border_width_'.$v]['right'];
            if( isset($settings['_border_width_'.$v]['bottom']) && (int)$settings['_border_width_'.$v]['bottom'] > 0 )
                $bb_width = $settings['_border_width_'.$v]['bottom'];
            if( isset($settings['_border_width_'.$v]['left']) && (int)$settings['_border_width_'.$v]['left'] > 0 )
                $bl_width = $settings['_border_width_'.$v]['left'];
        }

        $bd_top_style = 'style="--bd-width: '.$bt_width.$unit.' 0 0 0; border-style: '.$settings['_border_border'].'; border-color: '.$settings['_border_color'].';"';
        $bd_right_style = 'style="--bd-width: 0 '.$br_width.$unit.' 0 0; border-style: '.$settings['_border_border'].'; border-color: '.$settings['_border_color'].';"';
        $bd_bottom_style = 'style="--bd-width: 0 0 '.$bb_width.$unit.' 0; border-style: '.$settings['_border_border'].'; border-color: '.$settings['_border_color'].';"';
        $bd_left_style = 'style="--bd-width: 0 0 0 '.$bl_width.$unit.'; border-style: '.$settings['_border_border'].'; border-color: '.$settings['_border_color'].';"';
  
         
        $bd_top_w = $bd_right_w = $bd_bottom_w = $bd_left_w = '';

        if( isset($settings['_border_width']['top'])){
            if( $settings['_border_width']['top'] == '0' )
                $bd_top_w.= ' bw-no';
            if( (int)$settings['_border_width']['top'] > 0 )
                $bd_top_w.= ' bw-yes';
        }
        if( isset($settings['_border_width']['right'])){
            if( $settings['_border_width']['right'] == '0' )
                $bd_right_w.= ' bw-no';
            if( (int)$settings['_border_width']['right'] > 0 )
                $bd_right_w.= ' bw-yes';
        }
        if( isset($settings['_border_width']['bottom'])){
            if( $settings['_border_width']['bottom'] == '0' )
                $bd_bottom_w.= ' bw-no';
            if( (int)$settings['_border_width']['bottom'] > 0 )
                $bd_bottom_w.= ' bw-yes';
        }
        if( isset($settings['_border_width']['left'])){
            if( $settings['_border_width']['left'] == '0' )
                $bd_left_w.= ' bw-no';
            if( (int)$settings['_border_width']['left'] > 0 )
                $bd_left_w.= ' bw-yes';
        }    
 

        foreach ($breakpoints as $v) {

            if( isset($settings['_border_width_'.$v]['top']) ){
                if( $settings['_border_width_'.$v]['top'] == '0' )
                    $bd_top_w.= ' bw-'.$v.'-no';
                if( (int)$settings['_border_width_'.$v]['top'] > 0 )
                    $bd_top_w.= ' bw-'.$v.'-yes';
            }

            if( isset($settings['_border_width_'.$v]['right']) ){
                if( $settings['_border_width_'.$v]['right'] == '0' )
                    $bd_right_w.= ' bw-'.$v.'-no';
                if( (int)$settings['_border_width_'.$v]['right'] > 0 )
                    $bd_right_w.= ' bw-'.$v.'-yes';
            }
 

            if( isset($settings['_border_width_'.$v]['bottom']) ){
                if( $settings['_border_width_'.$v]['bottom'] == '0' )
                    $bd_bottom_w.= ' bw-'.$v.'-no';
                if( (int)$settings['_border_width_'.$v]['bottom'] > 0 )
                    $bd_bottom_w.= ' bw-'.$v.'-yes';
            }
 
            if( isset($settings['_border_width_'.$v]['left']) ){
                if( $settings['_border_width_'.$v]['left'] == '0' )
                    $bd_left_w.= ' bw-'.$v.'-no';
                if( (int)$settings['_border_width_'.$v]['left'] > 0 )
                    $bd_left_w.= ' bw-'.$v.'-yes';
            }
  
        }

        if( (int)$settings['_border_width']['top'] > 0) $border_num++;
        if( (int)$settings['_border_width']['right'] > 0) $border_num++;
        if( (int)$settings['_border_width']['bottom'] > 0) $border_num++;
        if( (int)$settings['_border_width']['left'] > 0) $border_num++;

        $html = '<div class="pxl-border-animated num-'.$border_num.'">
        <div class="pxl-border-anm bt w-100 '.$bd_top_w.'" '.$bd_top_style.'></div>
        <div class="pxl-border-anm br h-100 '.$bd_right_w.'" '.$bd_right_style.'></div>
        <div class="pxl-border-anm bb w-100 '.$bd_bottom_w.'" '.$bd_bottom_style.'></div>
        <div class="pxl-border-anm bl h-100 '.$bd_left_w.'" '.$bd_left_style.'></div>
        </div>';
        return $html.$widget_content;
    }else{
        return $widget_content;
    }
}


/*
    General Custom Options
*/
add_action( 'elementor/element/container/section_layout/after_section_end', 'apexus_element_custom_options', 1, 1 ); 
function apexus_element_custom_options( \Elementor\Element_Base $el ) {
    $el->start_controls_section(
        'el_custom_opts',
        [
            'label' => esc_html__( 'Apexus Custom Options', 'apexus' ),
            'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
        ]
    );
    // 
    $el->add_responsive_control(
        'el_max_w',
        [
            'label' => esc_html__('Max Width', 'apexus' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%', 'custom' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}' => 'max-width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $el->add_responsive_control(
        'el_min_w',
        [
            'label' => esc_html__('Min Width', 'apexus' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%', 'custom' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}' => 'min-width: {{SIZE}}{{UNIT}};',
            ],
            'separator' => 'after',
        ]
    );
    $el->add_control(
        'clip_path_border',
        [
            'label' => esc_html__('Clip Path', 'apexus'),
            'type' => \Elementor\Controls_Manager::HEADING,
        ]
    );
    $el->add_control(
        'clip_top_left',
        [
            'label' => esc_html__('Top Left', 'apexus'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ '%', 'px' ],
            'default' => [ 'size' => '', 'unit' => '%' ],
        ]
    );
    $el->add_control(
        'clip_left_top',
        [
            'label' => esc_html__('Left Top', 'apexus'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ '%', 'px' ],
            'default' => [ 'size' => '', 'unit' => '%' ],
        ]
    );
    $el->add_control(
        'clip_right_bottom',
        [
            'label' => esc_html__('Right Bottom', 'apexus'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ '%', 'px' ],
            'default' => [ 'size' => '', 'unit' => '%' ],
        ]
    );

    $el->add_control(
        'clip_bottom_right',
        [
            'label' => esc_html__('Bottom Right', 'apexus'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ '%', 'px' ],
            'default' => [ 'size' => '', 'unit' => '%' ],
        ]
    );

    $el->add_control(
        'pxl_section_border_animated',
        [
            'label' => esc_html__('Border Animated', 'apexus'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'apexus' ),
            'label_off' => esc_html__( 'No', 'apexus' ),
            'return_value' => 'yes',
            'default' => 'no',
            'separator' => 'before',
        ]
    );
    $el->end_controls_section();
}
