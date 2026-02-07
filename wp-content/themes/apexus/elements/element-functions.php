<?php
use Elementor\Controls_Manager;
use Elementor\Embed;
use Elementor\Group_Control_Image_Size;
 

if (!function_exists('apexus_elements_scripts')) {
    add_action('apexus_scripts', 'apexus_elements_scripts');
    function apexus_elements_scripts(){

        wp_enqueue_style( 'e-animations');
 
        wp_enqueue_script('apexus-global', get_template_directory_uri() . '/elements/assets/js/pxl-global.js', ['jquery','gsap-scroll-trigger','elementor-frontend'], apexus()->get_version(), true);
        wp_localize_script('apexus-global', 'elements_data', [
            'splittext_toggle_actions' => apexus()->get_theme_opt('gsap_splittext_toggle_actions', 'play none none none'),
            'animation_toggle_actions' => apexus()->get_theme_opt('gsap_animation_toggle_actions', 'play none none none')
        ]);

        wp_register_script('apexus-splittext', get_template_directory_uri() . '/elements/assets/js/pxl-splittext.js', ['jquery','gsap-scroll-trigger','gsap-split-text','elementor-frontend'], apexus()->get_version(), true);
        
        wp_localize_script('apexus-splittext', 'elements_data', [
            'splittext_toggle_actions' => apexus()->get_theme_opt('gsap_splittext_toggle_actions', 'play none none none'),
            'animation_toggle_actions' => apexus()->get_theme_opt('gsap_animation_toggle_actions', 'play none none none')
        ]);

        wp_enqueue_script('apexus-elements', get_template_directory_uri() . '/elements/assets/js/pxl-elements.js', ['jquery','gsap-scroll-trigger','elementor-frontend'], apexus()->get_version(), true);
        wp_enqueue_script('apexus-sphere', get_template_directory_uri() . '/elements/assets/js/sphere.js', [ 'jquery' ], apexus()->get_version(), true);

        wp_register_script('apexus-post-grid', get_template_directory_uri() . '/elements/assets/js/pxl-post-grid.js', ['jquery'], apexus()->get_version(), true);
        wp_localize_script('apexus-post-grid', 'grid_data', array('ajax_url' => admin_url('admin-ajax.php'), 'wpnonce' => wp_create_nonce( '_ajax_nonce' )));
        wp_register_script('apexus-swiper', get_template_directory_uri() . '/elements/assets/js/pxl-swiper-carousel.js', ['jquery'], apexus()->get_version(), true);
        wp_register_script('apexus-countdown', get_template_directory_uri() . '/elements/assets/js/pxl-countdown.js', [ 'jquery' ], apexus()->get_version(), true);
        wp_register_script( 'apexus-heading-scroll-effect', get_template_directory_uri() . '/elements/assets/js/pxl-heading-scroll-effect.js', [ 'jquery', 'gsap-split-text'], apexus()->get_version(), true);
    }
}
 

add_filter( 'elementor/icons_manager/additional_tabs', 'apexus_add_ionicons_to_icon_manager');
function apexus_add_ionicons_to_icon_manager( $settings ) {
    $settings['pixelart'] = [
        'name' => 'pixelart',
        'label' => esc_html__('Pixelart', 'apexus'),
        'url' => false,
        'enqueue' => false,
        'prefix' => 'pxli-',
        'displayPrefix' => 'pxli',
        'labelIcon' => 'pxli-user2',
        'ver' => '1.0.0',
        'fetchJson' => get_template_directory_uri() . '/assets/fonts/pixelart/pixelarts.js'
    ];
    return $settings;
}

add_action( 'elementor/editor/after_enqueue_scripts', function() {
    wp_enqueue_style( 'apexus-custom-editor', get_template_directory_uri() . '/elements/assets/css/custom-editor.css', array(), '1.0.0' );
    wp_enqueue_style( 'pixelart-icon', get_template_directory_uri() . '/assets/fonts/pixelart/style.css', array(), '1.1.0');
} ); 

function apexus_inline_elementor_editor_styles(){
    $options = apexus_configs_options();
    $theme_colors = $options['theme_colors']; 
    ob_start();
    echo '.e-con{';
        foreach ($theme_colors as $color => $value) {
            printf('--%1$s-color: %2$s !important;', str_replace('#', '',$color),  $value['value']);
        }
    echo '}';
    return ob_get_clean();
}

add_action( 'elementor/preview/enqueue_styles', 'apexus_add_editor_preview_style' );
function apexus_add_editor_preview_style(){
    wp_add_inline_style( 'editor-preview', apexus_editor_preview_inline_styles() );
}
function apexus_editor_preview_inline_styles(){
    $options = apexus_configs_options();
    $theme_colors = $options['theme_colors']; 
    ob_start();
        echo '.elementor-edit-area-active,.elementor-edit-area-active .e-con{';
            foreach ($theme_colors as $color => $value) {
                printf('--%1$s-color: %2$s;', str_replace('#', '',$color),  $value['value']);
            }
        echo '}';
    return ob_get_clean();
}

if (!function_exists('apexus_get_class_widget_path')) {
    function apexus_get_class_widget_path(){
        $upload_dir = wp_upload_dir();
        $cls_path = $upload_dir['basedir'] . '/elementor-widget/';
        if (!is_dir($cls_path)) {
            wp_mkdir_p($cls_path);
        }
        return $cls_path;
    }
}

function apexus_get_post_type_options($pt_supports = []){
    $post_types = get_post_types([
        'public' => true,
    ], 'objects');
    $excluded_post_type = [
        'page',
        'attachment',
        'revision',
        'nav_menu_item',
        'custom_css',
        'customize_changeset',
        'oembed_cache',
        'e-landing-page',
        'product',
        'elementor_library'
    ];

    $result_some = [];
    $result_any = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $post_type) {
        if (!$post_type instanceof WP_Post_Type)
            continue;
        if (in_array($post_type->name, $excluded_post_type))
            continue;

        if (!empty($pt_supports) && in_array($post_type->name, $pt_supports)) {
            $result_some[$post_type->name] = $post_type->labels->singular_name;
        } else {
            $result_any[$post_type->name] = $post_type->labels->singular_name;
        }
    }

    if (!empty($pt_supports))
        return $result_some;
    else
        return $result_any;
}

/* post_grid functions */
function apexus_get_post_grid_layout($pt_supports = []){
    $post_types = apexus_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {
        $result[] = array(
            'name' => 'layout_' . $name,
            'label' => sprintf(esc_html__('Select Templates of %s', 'apexus'), $label),
            'type' => 'layoutcontrol',
            'default' => 'post-1',
            'options' => apexus_get_grid_layout_options($name),
            'prefix_class' => 'pxl-post-layout-',
            'condition' => [
                'post_type' => [$name]
            ]
        );
    }
    return $result;
}
function apexus_get_grid_layout_options($post_type_name){
    $option_layouts = [];
    switch ($post_type_name) {
         
        case 'post':
            $option_layouts = [
                'post-1' => [
                    'label' => esc_html__('Layout 1', 'apexus'),
                    'image' => get_template_directory_uri() . '/elements/assets/imgs/post_grid-layout-1.webp'
                ],
            ];
            break;
        case 'portfolio':
            $option_layouts = [
                'portfolio-1' => [
                    'label' => esc_html__('Layout 1', 'apexus'),
                    'image' => get_template_directory_uri() . '/elements/assets/imgs/portfolio_grid-layout-1.webp'
                ],
            ];
            break;
            
    }
    return $option_layouts;
}

//* post_list functions
function apexus_get_post_list_layout($pt_supports = []){
    $post_types = apexus_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {
        $result[] = array(
            'name' => 'layout_' . $name,
            'label' => sprintf(esc_html__('Select Templates of %s', 'apexus'), $label),
            'type' => 'layoutcontrol',
            'default' => 'post-list-1',
            'options' => apexus_get_list_layout_options($name),
            'condition' => [
                'post_type' => [$name]
            ]
        );
    }
    return $result;
}
function apexus_get_list_layout_options($post_type_name){
    $option_layouts = [];
    switch ($post_type_name) {
        case 'career':
            $option_layouts = [
                'career-list-1' => [
                    'label' => esc_html__('Layout 1', 'apexus'),
                    'image' => get_template_directory_uri() . '/elements/assets/imgs/career_list-layout-1.webp'
                ],
            ];
        break;
        case 'post':
            $option_layouts = [
                'post-list-1' => [
                    'label' => esc_html__('Layout 1', 'apexus'),
                    'image' => get_template_directory_uri() . '/elements/assets/imgs/post_list-layout-1.webp'
                ],
            ];
        break;
    }
    return $option_layouts;
}

function apexus_get_term_by_post_type($pt_supports = [], $args = []){
    $args = wp_parse_args($args, ['condition' => 'post_type', 'custom_condition' => []]);
    $post_types = apexus_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {

        $taxonomy = get_object_taxonomies($name, 'names');

         
        if ($name == 'post') $taxonomy = ['category'];
        if ($name == 'product') $taxonomy = ['product_cat'];

        $options = pxl_get_grid_term_options($name, $taxonomy);
        if ($name == 'phb_room_type') $options = [];
        
        $result[] = array(
            'name' => 'source_' . $name,
            'label' => sprintf(esc_html__('Select Term', 'apexus'), $label),
            'description' => esc_html__('Get all when no term selected', 'apexus'),
            'type' => Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => $options,
            'label_block' => true,
            'condition' => array_merge(
                [
                    $args['condition'] => [$name]
                ],
                $args['custom_condition']
            )
        );
    }

    return $result;
}

//////
function get_post_categories_for_widget() {
    $categories = get_categories([
        'taxonomy'   => 'category',
        'hide_empty' => false,
    ]);

    $options = [];

    if (!empty($categories)) {
        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }
    }

    return [
        [
            'name'        => 'post_category',
            'label'       => esc_html__('Select Category', 'apexus'),
            'type'        => \Elementor\Controls_Manager::SELECT,
            'options'     => $options,
            'label_block' => true,
            'multiple'    => false,
            'description' => esc_html__('This is the category created from the post.', 'apexus'),
        ]
    ];
}

function apexus_get_ids_by_post_type($pt_supports = [], $args = []){
    $args = wp_parse_args($args, ['condition' => 'post_type', 'custom_condition' => []]);
    $post_types = apexus_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
 
    foreach ($post_types as $name => $label) {

        $posts = apexus_list_post($name, false);
 
        $result[] = array(
            'name' => 'source_' . $name . '_post_ids',
            'label' => sprintf(esc_html__('Select posts', 'apexus'), $label),
            'type' => Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => $posts,
            'label_block' => true,
            'condition' => array_merge(
                [
                    $args['condition'] => [$name]
                ],
                $args['custom_condition']
            )
        );
    }

    return $result;
}
function apexus_get_ids_unselected_by_post_type($pt_supports = [], $args = []){
    $args = wp_parse_args($args, ['condition' => 'post_type', 'custom_condition' => []]);
    $post_types = apexus_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {

        $posts = apexus_list_post($name, false);
 
        $result[] = array(
            'name' => 'source_' . $name . '_post_ids_unselected',
            'label' => sprintf(esc_html__('Unselected posts', 'apexus'), $label),
            'type' => Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => $posts,
            'label_block' => true,
            'condition' => array_merge(
                [
                    $args['condition'] => [$name]
                ],
                $args['custom_condition']
            )
        );
    }

    return $result;
}

/* post_carousel functions */
function apexus_get_post_carousel_layout($pt_supports = []){
    $post_types = apexus_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {
        $result[] = array(
            'name' => 'layout_' . $name,
            'label' => sprintf(esc_html__('Select Templates of %s', 'apexus'), $label),
            'type' => 'layoutcontrol',
            'default' => 'post-1',
            'options' => apexus_get_carousel_layout_options($name),
            'prefix_class' => 'post-layout-',
            'condition' => [
                'post_type' => [$name]
            ]
        );
    }
    return $result;
}

function apexus_get_carousel_layout_options($post_type_name){
    $option_layouts = [];
    switch ($post_type_name) {
        case 'post':
            $option_layouts = [
                'post-1' => [
                    'label' => esc_html__('Layout 1', 'apexus'),
                    'image' => get_template_directory_uri() . '/elements/assets/imgs/post_carousel-layout1.webp'
                ],
                'post-2' => [
                    'label' => esc_html__('Layout 2', 'apexus'),
                    'image' => get_template_directory_uri() . '/elements/assets/imgs/post_carousel-layout2.webp'
                ],
            ];
            break;    
    }
    return $option_layouts;
}
 
/* grid columns setting */
function apexus_grid_column_settings(){
    $options = [
        '12' => '1/12',
        '6'  => '1/6',
        '5'  => '1/5',
        '4'  => '1/4',
        '3'  => '1/3',
        '2'  => '1/2',
        '1.5'  => '2/3',
        '0.4'  => '2/5',
        '1'  => '1'
    ];
    return array(
        array(
            'name'    => 'col_xs',
            'label'   => esc_html__( 'Extra Small <= 575', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => $options
        ),
        array(
            'name'    => 'col_sm',
            'label'   => esc_html__( 'Small <= 767', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => $options
        ),
        array(
            'name'    => 'col_md',
            'label'   => esc_html__( 'Medium <= 991', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '2',
            'options' => $options
        ),
        array(
            'name'    => 'col_lg',
            'label'   => esc_html__( 'Large <= 1199', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '2',
            'options' => $options
        ),
        array(
            'name'    => 'col_xl',
            'label'   => esc_html__( 'XL Devices >= 1200', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '2',
            'options' => $options
        ),
        array(
            'name'    => 'col_xxl',
            'label'   => esc_html__( 'XXL Devices >= 1400', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '2',
            'options' => $options
        )
    );
}

function apexus_grid_custom_column_settings(){
   $options = [
        '12' => '1/12',
        '6'  => '1/6',
        '5'  => '1/5',
        '4'  => '1/4',
        '3'  => '1/3',
        '2'  => '1/2',
        '1.5'  => '2/3',
        '0.4'  => '2/5',
        '1'  => '1'
    ];
    return array(
        array(
            'name'    => 'col_xs_c',
            'label'   => esc_html__( 'Extra Small <= 575', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => $options
        ),
        array(
            'name'    => 'col_sm_c',
            'label'   => esc_html__( 'Small <= 767', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => $options
        ),
        array(
            'name'    => 'col_md_c',
            'label'   => esc_html__( 'Medium <= 991', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '2',
            'options' => $options
        ),
        array(
            'name'    => 'col_lg_c',
            'label'   => esc_html__( 'Large <= 1199', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '2',
            'options' => $options
        ),
        array(
            'name'    => 'col_xl_c',
            'label'   => esc_html__( 'XL Devices >= 1200', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '3',
            'options' => $options
        ),
        array(
            'name'    => 'col_xxl_c',
            'label'   => esc_html__( 'XXL Devices >= 1400', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '3',
            'options' => $options
        )
    );
}

/* carousel columns setting */
function apexus_carousel_settings(){
    return array(
        array(
            'name'         => 'column_number',
            'label'        => esc_html__('Column Number (include decimal)', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::NUMBER,
            'control_type' => 'responsive',
        ),
        array(
            'name'    => 'slides_to_scroll',
            'label'   => esc_html__( 'Slides to scroll', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::NUMBER,
            'default' => 1,
            'min' => 1,
            'max' => 6,
            'step' => 1,
        ),
        array(
            'name'         => 'gutter',
            'label'        => esc_html__('Gutter', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::NUMBER,
            'control_type' => 'responsive',
        ),
        array(
            'name'    => 'center_slide',
            'label'   => esc_html__( 'Center Slider', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '' => esc_html__( 'Default layout', 'apexus' ),
                '0' => esc_html__( 'False', 'apexus' ),
                '1' => esc_html__( 'True', 'apexus' )
            ],
            'default' => ''
        ),
        array(
            'name'    => 'infinite',
            'label'   => esc_html__( 'Infinite Loop', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '' => esc_html__( 'Default layout', 'apexus' ),
                '0' => esc_html__( 'False', 'apexus' ),
                '1' => esc_html__( 'True', 'apexus' )
            ],
            'default' => ''
        ),
        array(
            'name'    => 'pause_on_hover',
            'label'   => esc_html__( 'Pause on Hover', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '' => esc_html__( 'Default layout', 'apexus' ),
                '0' => esc_html__( 'False', 'apexus' ),
                '1' => esc_html__( 'True', 'apexus' )
            ],
            'default' => ''
        ),
        array(
            'name'    => 'autoplay',
            'label'   => esc_html__( 'Autoplay', 'apexus' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '' => esc_html__( 'Default layout', 'apexus' ),
                '0' => esc_html__( 'False', 'apexus' ),
                '1' => esc_html__( 'True', 'apexus' )
            ],
            'default' => '',
        ),
        array(
            'name' => 'autoplay_speed',
            'label' => esc_html__('Autoplay Speed', 'apexus'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 5000,
        ),
        array(
            'name' => 'speed',
            'label' => esc_html__('Animation Speed', 'apexus'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 500,
        )
    );
}
function apexus_carousel_arrow_settings(){
    return array_merge(
        array( 
            array(
                'name'         => 'arrows',
                'label'        => esc_html__('Show Arrows', 'apexus'),
                'type'         => 'select',
                'options'      => [
                    'true'  => esc_html__('Yes', 'apexus'),
                    'false' => esc_html__('No','apexus')
                ], 
                'default'      => 'false', 
                'control_type' => 'responsive',
                'prefix_class' => 'pxl-swiper-arrows%s-',
            ),
            array(
                'name'        => 'arrow_prev_icon',
                'label'       => esc_html__('Previous Icon','apexus'),
                'type'        => 'icons',
                'label_block' => true,
            ),
            array(
                'name'         => 'arrow_prev_icon_rotate',
                'label' => esc_html__( 'Icon Previous Rotate', 'apexus' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'control_type' => 'responsive',
                'size_units' => [ 'deg', 'grad', 'rad', 'turn', 'custom' ],
                'default' => [
                    'unit' => 'deg',
                ],
                'tablet_default' => [
                    'unit' => 'deg',
                ],
                'mobile_default' => [
                    'unit' => 'deg',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-arrow-prev .pxl-icon span, {{WRAPPER}} .pxl-swiper-arrow-prev .pxl-icon svg' => 'transform: rotateY({{SIZE}}{{UNIT}});',
                ],
            ),
            array(
                'name'        => 'arrow_next_icon',
                'label'       => esc_html__('Next Icon','apexus'),
                'type'        => 'icons',
                'label_block' => true,
                'separator' => 'after',
            ),
            array(
                'name'         => 'arrow_next_icon_rotate',
                'label' => esc_html__( 'Icon Next Rotate', 'apexus' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'control_type' => 'responsive',
                'size_units' => [ 'deg', 'grad', 'rad', 'turn', 'custom' ],
                'default' => [
                    'unit' => 'deg',
                ],
                'tablet_default' => [
                    'unit' => 'deg',
                ],
                'mobile_default' => [
                    'unit' => 'deg',
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-arrow-next .pxl-icon span, {{WRAPPER}} .pxl-swiper-arrow-next .pxl-icon svg' => 'transform: rotateY({{SIZE}}{{UNIT}});',
                ],
            ),
            array(
                'name' => 'arrow_color',
                'label' => esc_html__('Arrow Color', 'apexus' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'control_type' => 'responsive',
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-arrow' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pxl-swiper-arrow .pxl-icon svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .pxl-swiper-arrow .pxl-icon svg path' => 'stroke: {{VALUE}};',
                ],
            ),
            array(
                'name' => 'arrow_border_color',
                'label' => esc_html__('Arrow Border Color', 'apexus' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'control_type' => 'responsive',
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-arrow' => 'border-color: {{VALUE}};',
                ],
            ),
            array(
                'name' => 'arrow_bg_color',
                'label' => esc_html__('Arrow Background Color', 'apexus' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'control_type' => 'responsive',
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-arrow, {{WRAPPER}} .layout-rounded .pxl-swiper-arrow:before' => 'background-color: {{VALUE}};',
                ],
            ),
            array(
                'name' => 'arrow_color_hover',
                'label' => esc_html__('Arrow Color Hover', 'apexus' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'control_type' => 'responsive',
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-arrow:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pxl-swiper-arrow:hover .pxl-icon svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .pxl-swiper-arrow:hover .pxl-icon svg path' => 'stroke: {{VALUE}};',
                ],
            ),
            array(
                'name' => 'arrow_border_color_hover',
                'label' => esc_html__('Arrow Border Color Hover', 'apexus' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'control_type' => 'responsive',
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-arrow:hover' => 'border-color: {{VALUE}};',
                ],
            ),
            array(
                'name' => 'arrow_bg_color_hover',
                'label' => esc_html__('Arrow Background Color Hover', 'apexus' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'control_type' => 'responsive',
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-arrow:hover, {{WRAPPER}} .layout-rounded .pxl-swiper-arrow:hover:before' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'after',
            ),
            array(
                'name'         => 'arrows_position',
                'label'        => esc_html__('Arrows Position ', 'apexus'),
                'type'         => 'select',
                'options'      => [
                    'df-layout'  => esc_html__('Default by Layout', 'apexus'),
                    'nav-in-vertical'  => esc_html__('In Vertical', 'apexus'),
                    'nav-out-vertical'  => esc_html__('Out Vertical', 'apexus'),
                    'custom' => esc_html__('Custom wrap','apexus'),
                    'custom-separate' => esc_html__('Custom Separate','apexus'),
                ], 
                'default'      => 'df-layout', 
            ),
        ),
        apexus_position_option([
            'prefix' => 'arrow_',
            'selectors_class' => '.pxl-swiper-arrows.custom',
            'condition' => ['arrows_position' => 'custom']
        ]),
        apexus_position_option([
            'prefix' => 'arrow_prev_',
            'selectors_class' => '.pxl-swiper-arrow-prev',
            'condition' => ['arrows_position' => 'custom-separate']
        ]),
        apexus_position_option([
            'prefix' => 'arrow_next_',
            'selectors_class' => '.pxl-swiper-arrow-next',
            'condition' => ['arrows_position' => 'custom-separate']
        ]),
        array(
            array(
                'name' => 'arrow_prev_margin',
                'label' => esc_html__('Previous Margin(px)', 'apexus' ),
                'type' => 'dimensions',
                'control_type' => 'responsive',
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-arrow-prev' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['arrows_position!' => 'custom']
            ),
            array(
                'name' => 'arrow_next_margin',
                'label' => esc_html__('Next Margin(px)', 'apexus' ),
                'type' => 'dimensions',
                'control_type' => 'responsive',
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-arrow-next' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['arrows_position!' => 'custom'],
            ),
            array(
                'name'  => 'arrow_width',
                'label' => esc_html__( 'Arrows Width (px)', 'apexus' ),
                'type'  => 'slider',
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-arrow' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ),
            array(
                'name'  => 'arrow_height',
                'label' => esc_html__( 'Arrows Height (px)', 'apexus' ),
                'type'  => 'slider',
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-arrow' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ),
            array(
                'name'  => 'icon_size',
                'label' => esc_html__( 'Arrows Font Size (px)', 'apexus' ),
                'type'  => 'slider',
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-arrow' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .pxl-swiper-arrow svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ),
            array(
                'name'         => 'arrow_direction',
                'label'        => esc_html__('Arrow Direction', 'apexus'),
                'type'         => 'select',
                'options'      => [
                    ''  => esc_html__('Default', 'apexus'),
                    'row'  => esc_html__('Row', 'apexus'),
                    'column'  => esc_html__('Columns','apexus'),
                    'column-reverse'  => esc_html__('Columns Reverse','apexus'),
                ], 
                'default'      => '', 
                'control_type' => 'responsive',
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-arrows.custom' => 'flex-direction: {{VALUE}};',
                ],
                'condition' => ['arrows_position' => 'custom']
            ),
            array(
                'name'  => 'arrow_gap',
                'label' => esc_html__( 'Arrows gap', 'apexus' ),
                'type'  => 'slider',
                'control_type' => 'responsive',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-arrows.custom' => 'column-gap: {{SIZE}}{{UNIT}}; row-gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => ['arrows_position' => 'custom']
            ),
            array(
                'name' => 'arrows_margin',
                'label' => esc_html__('Arrows Wrap Margin(px)', 'apexus' ),
                'type' => 'dimensions',
                'control_type' => 'responsive',
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-arrows' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => ['arrows_position' => 'custom'],
                'separator' => 'after',
            ),
            array(
                'name'         => 'arrow_border_radius',
                'label'        => esc_html__( 'Arrow Border Radius', 'apexus' ),
                'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                'control_type' => 'responsive',
                'size_units'   => [ 'px', '%' ],
                'selectors'    => [
                    '{{WRAPPER}} .pxl-swiper-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ),
        )
    );
}
function apexus_carousel_dots_settings(){
    return array_merge(
        array( 
            array(
                'name'         => 'dots',
                'label'        => esc_html__('Show Dots', 'apexus'),
                'type'         => 'select',
                'options'      => [
                    'true'  => esc_html__('Yes', 'apexus'),
                    'false' => esc_html__('No','apexus')
                ], 
                'default'      => 'false', 
                'control_type' => 'responsive',
                'prefix_class' => 'pxl-swiper-dots%s-'
            ),
            array(
                'name'         => 'dots_style',
                'label'        => esc_html__('Dots Style', 'apexus'),
                'type'         => 'select',
                'options'      => [
                    'bullets'  => esc_html__('Bullets','apexus'),
                    'bullets-number' => esc_html__('Number','apexus'),
                ], 
                'default'      => 'bullets', 
                'control_type' => 'responsive',
                'label_block'  => true,
                'prefix_class' => 'pxl-swiper-dots%s-',
            ),
            array(
                'name' => 'dots_margin',
                'label' => esc_html__('Dot Margin (px)', 'apexus' ),
                'type' => 'dimensions',
                'control_type' => 'responsive',
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ),
            array(
                'name' => 'dots_alignment',
                'label' => esc_html__( 'Horizontal Alignment', 'apexus' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Start', 'apexus' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'apexus' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__( 'End', 'apexus' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-dots' => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .pxl-swiper-dots.style-bullets-number' => 'text-align: {{VALUE}};',
                ],
            ),
            array(
                'name' => 'dots_color',
                'label' => esc_html__('Dots Color', 'apexus' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-dots .pxl-swiper-pagination-bullet' => 'background-color: {{VALUE}};'
                ],
            ),
            array(
                'name' => 'dots_color_active',
                'label' => esc_html__('Dots Color Active', 'apexus' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-dots.style-bullets .pxl-swiper-pagination-bullet:hover,
                    {{WRAPPER}} .pxl-swiper-dots.style-bullets .pxl-swiper-pagination-bullet.swiper-pagination-bullet-active, {{WRAPPER}} .pxl-fancy-box-carousel.layout-3 .pxl-swiper-dots.style-bullets .pxl-swiper-pagination-bullet::before,
                    {{WRAPPER}} .pxl-slider.layout-2 .pxl-swiper-dots.style-bullets .pxl-swiper-pagination-bullet::before,
                    {{WRAPPER}} .pxl-swiper-dots.style-bullets-number .swiper-pagination-custom-bullets .pxl-swiper-pagination-bullet::before' => 'background-color: {{VALUE}};'
                ],
            ),
            array(
                'name' => 'Number_typography',
                'label' => esc_html__('Number Typography', 'apexus' ),
                'type' => \Elementor\Group_Control_Typography::get_type(),
                'control_type' => 'group',
                'selector' => '{{WRAPPER}} .pxl-swiper-dots .swiper-pagination-custom-number',
                'condition' =>[
                    'dots_style' => 'bullets-number'
                ]
            ),
            array(
                'name' => 'number_color',
                'label' => esc_html__('Number Color', 'apexus' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pxl-swiper-dots .swiper-pagination-custom-number' => 'color: {{VALUE}};',
                ],
                'condition' =>[
                    'dots_style' => 'bullets-number'
                ]
            ),
        ),
        apexus_position_option([
            'prefix' => 'dots_',
            'selectors_class' => '.pxl-swiper-dots'
        ])
    );
}


function apexus_elementor_animation_opts($args = []){
    $args = wp_parse_args($args, [
        'name'   => '',
        'label'  => '',
        'condition'   => [],
    ]);
 
    return array(
        array(
            'name'      => $args['name'].'_animation',
            'label'     => $args['label'].' '.esc_html__( 'Motion Effect', 'apexus' ),
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
            ], 
            'frontend_available' => true,
            'default' => '',
            'condition'   => $args['condition'],
        ),
        array(
            'name'    => $args['name'].'_animation_duration', 
            'label'   => $args['label'].' '.esc_html__( 'Animation Duration (s: 0.1, 1, 2, 3)', 'apexus' ),
            'type'    => Controls_Manager::NUMBER,
            'min'       => 0,
            'selectors' => [
                '{{WRAPPER}}.pxl-animated' => '--pxl-animation-duration: {{VALUE}}s;',
            ],
            'condition'   => array_merge($args['condition'], [ $args['name'].'_animation!' => '' ]),
        ),
        array(
            'name'      => $args['name'].'_animation_delay',
            'label'     => $args['label'].' '.esc_html__( 'Animation Delay (s: 0.1, 0.2, 0.3)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'min'       => 0,
            'frontend_available' => true,
            'condition'   => array_merge($args['condition'], [ $args['name'].'_animation!' => '' ]),
        )
    );
}

function apexus_position_option_base($args = []){
    $start = is_rtl() ? esc_html__( 'Right', 'apexus' ) : esc_html__( 'Left', 'apexus' );
    $end = ! is_rtl() ? esc_html__( 'Right', 'apexus' ) : esc_html__( 'Left', 'apexus' );
    $args = wp_parse_args($args, [
        'prefix' => '',
        'selectors_class' => '',
        'condition' => []
    ]);
    $options = array(
        array(
            'name'        => $args['prefix'] .'position',
            'label' => ucfirst( str_replace('_', ' ', $args['prefix']) ).' '.esc_html__( 'Position', 'apexus' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'control_type' => 'responsive',
            'default' => '',
            'options' => [
                'relative' => esc_html__( 'Default', 'apexus' ),
                'absolute' => esc_html__( 'Absolute', 'apexus' ),
            ],
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => 'position: {{VALUE}}',
            ],
            'frontend_available' => true,
            'condition'   => $args['condition'],
        ),
         
        array(
            'name'        => $args['prefix'] .'pos_offset_left',
            'label' => esc_html__( 'Left', 'apexus' ).' (50px) px,%,vw,auto',
            'type' => 'text',
            'default' => '',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => 'left: {{VALUE}}',
            ],
            'condition'   => array_merge($args['condition'], [ $args['prefix'] .'position!' => '' ]),
        ),  
        array(
            'name'        => $args['prefix'] .'pos_offset_right',
            'label' => esc_html__( 'Right', 'apexus' ).' (50px) px,%,vw,auto',
            'type' => 'text',
            'default' => '',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => 'right: {{VALUE}}',
            ],
            'condition'   => array_merge($args['condition'], [ $args['prefix'] .'position!' => '' ]),
             
        ),
        array(
            'name'        => $args['prefix'] .'pos_offset_top',
            'label' => esc_html__( 'Top', 'apexus' ).' (50px) px,%,vh,auto',
            'type' => 'text',
            'default' => '',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => 'top: {{VALUE}}',
            ],
            'condition'   => array_merge($args['condition'], [ $args['prefix'] .'position!' => '']),
              
        ),  
        array(
            'name'        => $args['prefix'] .'pos_offset_bottom',
            'label' => esc_html__( 'Bottom', 'apexus' ).' (50px) px,%,vh,auto',
            'type' => 'text',
            'default' => '',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => 'bottom: {{VALUE}}',
            ],
            'condition'   => array_merge($args['condition'], [ $args['prefix'] .'position!' => '']),
        ),
        array(
            'name'        => $args['prefix'] .'horizontal_align',
            'label' => esc_html__( 'Alignment', 'apexus' ),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'top' => [
                    'title' => esc_html__( 'Top', 'apexus' ),
                    'icon' => 'eicon-v-align-top',
                ],
                'center' => [
                    'title' => esc_html__( 'Center', 'apexus' ),
                    'icon' => 'eicon-v-align-middle',
                ],
                'bottom' => [
                    'title' => esc_html__( 'Bottom', 'apexus' ),
                    'icon' => 'eicon-v-align-bottom',
                ],
            ],
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => 'background-position: {{VALUE}}',
            ],
            'condition'   => array_merge($args['condition'], [ $args['prefix'] .'position!' => '']),
        ),
        array(
            'name'        => $args['prefix'] .'z_index',
            'label' => ucfirst( str_replace('_', ' ', $args['prefix']) ).' '. esc_html__( 'Z-Index', 'apexus' ),
            'type' => Controls_Manager::NUMBER,
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => 'z-index: {{VALUE}};',
            ],
            'separator' => 'after',
            'condition'   => array_merge($args['condition'], [ $args['prefix'] .'position!' => '' ]),
        )
    );
    return $options;
}
function apexus_gsap_effect_options($args = []){
    $args = wp_parse_args($args, [
        'prefix' => 'pxl_',
        'label' => 'Pxl',
        'selectors_class' => '',
        'frontend_available' => false,
        'condition' => []
    ]);
    extract($args);
    
    $options = [
        [
            'name'         => $prefix .'popover',
            'label'        => $label,
            'type'         => Controls_Manager::POPOVER_TOGGLE,
            'label_off'    => esc_html__( 'Default', 'apexus' ),
            'label_on'     => esc_html__( 'Custom', 'apexus' ),
            'return_value' => 'yes',
            'condition'    => $condition,
        ],
        [
            'name'        => $prefix .'start_popover',
            'label'       => ucfirst( str_replace('_', '', $prefix) ).' '. esc_html__( 'Start Popover', 'apexus' ),
            'type'        => 'pxl_start_popover',
            'condition'   => $condition,
        ], 
        [
            'name'      => $prefix .'opacity',
            'label'     => esc_html__( 'Opacity (0, 0.1, 0.2, 1)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'min'       => 0,
            'frontend_available' => $frontend_available,
            'selectors' => [
                '{{WRAPPER}}' => '--'.$prefix.'opacity: {{VALUE}};',
            ],
        ],
        [
            'name'      => $prefix .'offset_x',
            'label'     => esc_html__( 'Offset X (px: -30, 0, 50)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'frontend_available' => $frontend_available,
        ], 
        [
            'name'      => $prefix .'offset_y',
            'label'     => esc_html__( 'Offset Y (px: -30, 0, 50)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'frontend_available' => $frontend_available,
        ],
        [
            'name'      => $prefix .'rotation',
            'label'     => esc_html__( 'Rotation (deg: -360, 0, 360)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'frontend_available' => $frontend_available,
        ], 
        [
            'name'      => $prefix .'rotationx',
            'label'     => esc_html__( 'rotationX (deg: -360, 0, 360)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'frontend_available' => $frontend_available,
        ], 
        [
            'name'      => $prefix .'rotationy',
            'label'     => esc_html__( 'rotationY (deg: -360, 0, 360)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'frontend_available' => $frontend_available,
        ],
        [
            'name'      => $prefix .'scale',
            'label'     => esc_html__( 'Scale (0, 0.4, 1, 1.5)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'min'       => 0,
            'frontend_available' => $frontend_available,
        ], 
        [
            'name'      => $prefix .'scalex',
            'label'     => esc_html__( 'scaleX (0, 0.5, 1, 2)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'min'       => 0,
            'frontend_available' => $frontend_available,
        ],
        [
            'name'      => $prefix .'scaley',
            'label'     => esc_html__( 'scaleY (0, 0.5, 1, 2)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'min'       => 0,
            'frontend_available' => $frontend_available,
        ],  
        [
            'name'      => $prefix .'skewx',
            'label'     => esc_html__( 'SkewX (deg: -360, 0, 360)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'frontend_available' => $frontend_available,
        ],
        [
            'name'      => $prefix .'skewy',
            'label'     => esc_html__( 'SkewY (deg: -360, 0, 360)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'frontend_available' => $frontend_available,
        ], 
        [
            'name'        => $prefix .'end_popover',
            'label'       => ucfirst( str_replace('_', '', $prefix) ).' '. esc_html__( 'End Popover', 'apexus' ),
            'type'        => 'pxl_end_popover',
            'condition'   => $condition,
        ]
    ];
    return $options;
}



function apexus_position_option($args = []){
    $args = wp_parse_args($args, [
        'prefix' => 'pxl_pos_',
        'label' => esc_html__( 'Position', 'apexus' ),
        'selectors_class' => '',
        'condition' => []
    ]);
    extract($args);
    $options = [
        [
            'name'         => $prefix .'popover',
            'label'        => $label,
            'type'         => Controls_Manager::POPOVER_TOGGLE,
            'label_off'    => esc_html__( 'Default', 'apexus' ),
            'label_on'     => esc_html__( 'Custom', 'apexus' ),
            'return_value' => 'yes',
        ],
        [
            'name'        => $prefix .'start_popover',
            'label'       => esc_html__( 'Start Popover', 'apexus' ),
            'type'        => 'pxl_start_popover',
        ],
        [
            'name'        => $prefix .'position',
            'label' => esc_html__( 'Position', 'apexus' ),
            'type'         => Controls_Manager::SELECT,
            'control_type' => 'responsive',
            'options'      => [
                ''         => esc_html__( 'Default', 'apexus' ),
                'absolute' => esc_html__( 'Absolute', 'apexus' ),
                'relative' => esc_html__( 'Relative', 'apexus' ),
                'fixed'    => esc_html__( 'Fixed', 'apexus' ),
            ],
            'default'      => '',
            'selectors' => [
                '{{WRAPPER}} '.$selectors_class => 'position: {{VALUE}};',
            ], 
        ],
        [
            'name'        => $prefix .'offset_left',
            'label' => esc_html__( 'Left', 'apexus' ).' (50px) px,%,vw,auto',
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} '.$selectors_class => 'left: {{VALUE}}',
            ],
            'condition'   => $condition,
        ],  
        [
            'name'        => $prefix .'offset_right',
            'label' => esc_html__( 'Right', 'apexus' ).' (50px) px,%,vw,auto',
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} '.$selectors_class => 'right: {{VALUE}}',
            ],
            'condition'   => $condition,
             
        ],
        [
            'name'        => $prefix .'offset_top',
            'label' => esc_html__( 'Top', 'apexus' ).' (50px) px,%,vh,auto',
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} '.$selectors_class => 'top: {{VALUE}}',
            ],
            'condition'   => $condition,
              
        ], 
        [
            'name'        => $prefix .'offset_bottom',
            'label' => esc_html__( 'Bottom', 'apexus' ).' (50px) px,%,vh,auto',
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} '.$selectors_class => 'bottom: {{VALUE}}',
            ],
            'condition'   => $condition,
        ],
        [
            'name'        => $prefix .'end_popover',
            'label'       => esc_html__( 'End Popover', 'apexus' ),
            'type'        => 'pxl_end_popover',
        ]
        
    ];
    return $options;
}
function apexus_transform_option($args = []){
    $transform_prefix_class = 'pxl-';
    $transform_return_value = 'transform';
    $args = wp_parse_args($args, [
        'prefix' => '',
        'selectors_class' => '',
        'condition' => []
    ]);
    $options = array(
        array(
            'name'        => $args['prefix'] .'transform_translate_popover',
            'label' => ucfirst( str_replace('_', ' ', $args['prefix']) ).' '. esc_html__( 'Transform', 'apexus' ),
            'type' => Controls_Manager::POPOVER_TOGGLE,
            'prefix_class' => $transform_prefix_class,
            'return_value' => $transform_return_value,
            'condition'   => $args['condition'],
        ),
        array(
            'name'        => $args['prefix'] .'pxl_start_popover',
            'label'       => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'Start Popover', 'apexus' ),
            'type'        => 'pxl_start_popover',
            'condition'   => $args['condition'],
        ),
        array(
            'name'        => $args['prefix'] .'transform_translateX_effect',
            'label' => esc_html__( 'Offset X', 'apexus' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ '%', 'px' ],
            'range' => [
                '%' => [
                    'min' => -100,
                    'max' => 100,
                ],
                'px' => [
                    'min' => -1000,
                    'max' => 1000,
                ],
            ],
            'control_type' => 'responsive',
            'condition' => [
                $args['prefix'] .'transform_translate_popover!' => '',
            ],
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => '--pxl-transform-translateX: {{SIZE}}{{UNIT}};',
            ],
            'frontend_available' => true,
        ),
        array(
            'name'        => $args['prefix'] .'_transform_translateY_effect',
            'label' => esc_html__( 'Offset Y', 'apexus' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ '%', 'px' ],
            'range' => [
                '%' => [
                    'min' => -100,
                    'max' => 100,
                ],
                'px' => [
                    'min' => -1000,
                    'max' => 1000,
                ],
            ],
            'control_type' => 'responsive',
            'condition' => [
                $args['prefix'] .'transform_translate_popover!' => '',
            ],
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => '--pxl-transform-translateY: {{SIZE}}{{UNIT}};',
            ],
            'frontend_available' => true,
        ),
        array(
            'name'        => $args['prefix'] .'pxl_end_popover',
            'label'       => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'End Popover', 'apexus' ),
            'type'        => 'pxl_end_popover',
            'condition'   => $args['condition'],
        ),
    );
    return $options;
}

function apexus_parallax_effect_option($args = []){
     
    $args = wp_parse_args($args, [
        'prefix' => '',
        'condition' => []
    ]);
    $options = array(
        array(
            'name'         => $args['prefix'] .'parallax_effect_popover',
            'label'        => ucfirst( str_replace('_', ' ', $args['prefix']) ).' '. esc_html__( 'Parallax Effect', 'apexus' ),
            'type'         => Controls_Manager::POPOVER_TOGGLE,
            'label_off'    => esc_html__( 'Default', 'apexus' ),
            'label_on'     => esc_html__( 'Custom', 'apexus' ),
            'return_value' => 'yes',
            'condition'    => $args['condition'],
        ),
        array(
            'name'        => $args['prefix'] .'pxl_start_popover',
            'label'       => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'Start Popover', 'apexus' ),
            'type'        => 'pxl_start_popover',
            'condition'   => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_x',
            'label'     => esc_html__( 'TranslateX', 'apexus' ).' (-80)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_y',
            'label'     => esc_html__( 'TranslateY', 'apexus' ).' (-80)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_z',
            'label'     => esc_html__( 'TranslateZ', 'apexus' ).' (-80)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_rotate_x',
            'label'     => esc_html__( 'Rotate X', 'apexus' ).' (30)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_rotate_y',
            'label'     => esc_html__( 'Rotate Y', 'apexus' ).' (30)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_rotate_z',
            'label'     => esc_html__( 'Rotate Z', 'apexus' ).' (30)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_scale_x',
            'label'     => esc_html__( 'Scale X', 'apexus' ).' (0.8)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_scale_y',
            'label'     => esc_html__( 'Scale Y', 'apexus' ).' (0.8)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_scale_z',
            'label'     => esc_html__( 'Scale Z', 'apexus' ).' (0.8)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_scale',
            'label'     => esc_html__( 'Scale', 'apexus' ).' (0.8)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'        => $args['prefix'] .'pxl_end_popover',
            'label'       => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'End Popover', 'apexus' ),
            'type'        => 'pxl_end_popover',
            'condition'   => $args['condition'],
        ), 
       
    );
    return $options;
}

function apexus_get_parallax_effect($settings = []){
    $effects = [];
    if(!empty($settings['layer_parallax_effect_x'])){
        $effects['x'] = (int)$settings['layer_parallax_effect_x'];
    }
    if(!empty($settings['layer_parallax_effect_y'])){
        $effects['y'] = (int)$settings['layer_parallax_effect_y'];
    }
    if(!empty($settings['layer_parallax_effect_z'])){
        $effects['y'] = (int)$settings['layer_parallax_effect_z'];
    }
    if(!empty($settings['layer_parallax_effect_rotate_x'])){
        $effects['rotateX'] = (float)$settings['layer_parallax_effect_rotate_x'];
    }
    if(!empty($settings['layer_parallax_effect_rotate_y'])){
        $effects['rotateY'] = (float)$settings['layer_parallax_effect_rotate_y'];
    }
    if(!empty($settings['layer_parallax_effect_rotate_z'])){
        $effects['rotateY'] = (float)$settings['layer_parallax_effect_rotate_z'];
    }
    if(!empty($settings['layer_parallax_effect_scale_x'])){
        $effects['scaleX'] = (float)$settings['layer_parallax_effect_scale_x'];
    }
    if(!empty($settings['layer_parallax_effect_scale_y'])){
        $effects['scaleY'] = (float)$settings['layer_parallax_effect_scale_y'];
    }
    if(!empty($settings['layer_parallax_effect_scale_z'])){
        $effects['scaleZ'] = (float)$settings['layer_parallax_effect_scale_z'];
    }
    if(!empty($settings['layer_parallax_effect_scale'])){
        $effects['scale'] = (float)$settings['layer_parallax_effect_scale'];
    }

    return json_encode($effects);
}

function apexus_button_settings($args = []){
    $args = wp_parse_args($args, [
        'prefix'                => '',
        'condition'             => [],
        'btn_text'              => ''
    ]);
    return array(
        array(
            'name'    => $args['prefix'].'style',
            'label'   => esc_html__( 'Button Style', 'apexus' ),
            'type'    => 'select',
            'default' => 'default',
            'options' => [
                'default'             => esc_html__( 'Default', 'apexus' ),
                'btn-primary'         => esc_html__( 'Primary', 'apexus' ),
                'btn-second'         => esc_html__( 'Second', 'apexus' ),
                'btn-third'         => esc_html__( 'Third', 'apexus' ),
                'btn-fourth'         => esc_html__( 'Fourth', 'apexus' ),
                'btn-fifth'         => esc_html__( 'Fifth', 'apexus' ),
                'btn-sixth'         => esc_html__( 'Sixth', 'apexus' ),
                'btn-seventh'         => esc_html__( 'Seventh', 'apexus' ),
                'btn-eighth'         => esc_html__( 'Eighth', 'apexus' ),
                'btn-outline'         => esc_html__( 'Outline', 'apexus' ),
                'link'                => esc_html__( 'Link', 'apexus' ),
            ],
            'condition'   => $args['condition'],
        ),
        array(
            'name'        => $args['prefix'].'text',
            'label'       => esc_html__('Text', 'apexus' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => $args['btn_text'],
            'placeholder' => esc_html__('Click here', 'apexus'),
        ),
        array(
            'name' => $args['prefix'].'link',
            'label' => esc_html__('Link', 'apexus'),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => esc_html__('https://your-link.com', 'apexus' ),
            'default' => [
                'url' => '#',
            ],
        ),
        array(
            'name' => $args['prefix'].'open_new_tab',
            'label' => esc_html__('Open link in new tab', 'apexus'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'apexus'),
            'label_off' => esc_html__('No', 'apexus'),
            'return_value' => 'yes',
            'default' => '',
            'condition' => [
                $args['prefix'].'link[url]!' => '',
            ],
        ),
    );
}
function pxl_get_product_grid_term_options($args=[]){
    $product_categories = get_categories(array( 'taxonomy' => 'product_cat' ));
    $options = array();
    foreach($product_categories as $category){
        $options[$category->slug] = $category->name;
    }
    return $options;
}
 
function apexus_get_img_link_url( $settings ) {
    if ( 'none' === $settings['link_to'] ) {
        return false;
    }

    if ( 'custom' === $settings['link_to'] ) {
        if ( empty( $settings['link']['url'] ) ) {
            return false;
        }

        return $settings['link'];
    }

    return [
        'url' => $settings['image']['url'],
    ];
}

function apexus_split_text_option($name = ''){
    $options = [
        [
            'name'         => $name .'popover',
            'label'        => esc_html__('Split Text Options From', 'apexus' ),
            'type'         => Controls_Manager::POPOVER_TOGGLE,
            'label_off'    => esc_html__( 'Default', 'apexus' ),
            'label_on'     => esc_html__( 'Custom', 'apexus' ),
            'return_value' => 'yes',
        ],
        [
            'name'        => $name .'start_popover',
            'label'       => esc_html__( 'Start Popover', 'apexus' ),
            'type'        => 'pxl_start_popover',
        ], 
        [
            'name'      => $name .'sp_type',
            'label'     => ucfirst( str_replace('_', ' ', $name) ).' '.esc_html__('Split Text Effect', 'apexus' ),
            'label_block' => true,
            'type'      => Controls_Manager::SELECT,
            'control_type' => 'responsive',
            'options' => [
                ''      => esc_html__( 'Default', 'apexus' ),
                'none'      => esc_html__( 'None', 'apexus' ),
                'chars' => esc_html__( 'Chars', 'apexus' ),
                'words' => esc_html__( 'Words', 'apexus' ),
                'lines' => esc_html__( 'Lines', 'apexus' ),
                'lines-rotation-x' => esc_html__( 'Lines Rotation X', 'apexus' ),
                'words-scale' => esc_html__( 'Words Scale', 'apexus' ),
            ], 
            'frontend_available' => true,
            'default' => '',
        ],
        [
            'name'      => $name .'sp_opacity',
            'label'     => esc_html__( 'Opacity (0, 0.1, 0.2, 1)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'min'       => 0,
            'frontend_available' => true,
            'selectors' => [
                '{{WRAPPER}} .pxl-split-text' => '--'.$name.'opacity: {{VALUE}};',
            ],
            'default'   => 0, 
            'condition' => [$name .'sp_type' => ['chars', 'words', 'lines']]
        ],
        [
            'name'      => $name .'sp_offset_x',
            'label'     => esc_html__( 'Offset X (px: -30, 0, 50)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'frontend_available' => true,
            'condition' => [$name .'sp_type' => ['chars', 'words', 'lines']]
        ], 
        [
            'name'      => $name .'sp_offset_y',
            'label'     => esc_html__( 'Offset Y (px: -30, 0, 50)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'frontend_available' => true,
            'condition' => [$name .'sp_type' => ['chars', 'words', 'lines']]
        ],
        [
            'name'      => $name .'sp_rotation',
            'label'     => esc_html__( 'Rotation (deg: -360, 0, 360)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'frontend_available' => true,
            'condition' => [$name .'sp_type' => ['chars', 'words', 'lines']]
        ], 
        [
            'name'      => $name .'sp_rotationx',
            'label'     => esc_html__( 'rotationX (deg: -360, 0, 360)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'frontend_available' => true,
            'condition' => [$name .'sp_type' => ['chars', 'words', 'lines']]
        ], 
        [
            'name'      => $name .'sp_rotationy',
            'label'     => esc_html__( 'rotationY (deg: -360, 0, 360)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'frontend_available' => true,
            'condition' => [$name .'sp_type' => ['chars', 'words', 'lines']]
        ],
        [
            'name'      => $name .'sp_scale',
            'label'     => esc_html__( 'Scale (0, 0.4, 1, 1.5)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'min'       => 0,
            'frontend_available' => true,
            'condition' => [$name .'sp_type' => ['chars', 'words', 'lines']]
        ], 
        [
            'name'      => $name .'sp_scalex',
            'label'     => esc_html__( 'scaleX (0, 0.5, 1, 2)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'min'       => 0,
            'frontend_available' => true,
            'condition' => [$name .'sp_type' => ['chars', 'words', 'lines']]
        ],
        [
            'name'      => $name .'sp_scaley',
            'label'     => esc_html__( 'scaleY (0, 0.5, 1, 2)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'min'       => 0,
            'frontend_available' => true,
            'condition' => [$name .'sp_type' => ['chars', 'words', 'lines']]
        ], 
        [
            'name'      => $name .'sp_toggle_actions',
            'label'     => esc_html__( 'Toggle Actions', 'apexus' ),
            'type'      => Controls_Manager::SELECT,
            'options' => [
                '' => esc_html__( 'Default', 'apexus' ),
                'play none none none' => 'play none none none',
                'play reverse play reverse' => 'play reverse play reverse',
                'play none none reverse' => 'play none none reverse',
                'play none none reset' => 'play none none reset',
            ],
            'default' => '',
            'frontend_available' => true,
            'condition' => [$name .'sp_type!' => ['','none']]
        ],
        [
            'name'      => $name .'sp_once',
            'label'     => esc_html__( 'Once', 'apexus' ),
            'type'      => Controls_Manager::SELECT,
            'options' => [
                '' => esc_html__( 'Default', 'apexus' ),
                '1' => esc_html__( 'True', 'apexus' ),
                '0' => esc_html__( 'False', 'apexus' )
            ],
            'default' => '',
            'frontend_available' => true,
            'condition' => [$name .'sp_type!' => ['','none']]
        ],
        [
            'name'      => $name .'sp_ease',
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
            'condition' => [$name .'sp_type!' => ['','none']]
        ], 
        [
            'name'      => $name .'sp_animation_duration',
            'label'     => esc_html__( 'Duration (s: 0.1, 1, 2, 3)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'min'       => 0,
            'frontend_available' => true,
             'condition' => [$name .'sp_type' => ['chars', 'words', 'lines']]
        ], 
        [
            'name'      => $name .'sp_animation_delay',
            'label'     => esc_html__( 'Delay (s: 0.1, 0.2, 0.3)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'min'       => 0,
            'frontend_available' => true,
             'condition' => [$name .'sp_type' => ['chars', 'words', 'lines']]
        ],
        [
            'name'      => $name .'sp_scrub',
            'label'     => esc_html__( 'Scrub (s: -2, 0 , 1, 2, 8)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'frontend_available' => true,
            'condition' => [$name .'sp_type!' => ['','none']]
        ],
        [
            'name'      => $name .'sp_stagger',
            'label'     => esc_html__( 'Stagger (s: 0, 0.2, 1, 2)', 'apexus' ),
            'type'      => Controls_Manager::NUMBER,
            'min'       => 0,
            'frontend_available' => true,
            'condition' => [$name .'sp_type!' => ['','none']]
        ],
        [
            'name'      => $name .'sp_transform_origin',
            'label'     => esc_html__( 'Transform Origin (top center -50)', 'apexus' ),
            'label_block' => true,
            'type'      => Controls_Manager::TEXT,
            'default' => '',
            'frontend_available' => true,
            'condition' => [$name .'sp_type' => ['chars', 'words', 'lines']]
        ],  
        [
            'name'        => $name .'end_popover',
            'label'       => esc_html__( 'End Popover', 'apexus' ),
            'type'        => 'pxl_end_popover',
        ],
         //////
        [
            'name' => $name.'split_text_anm',
            'label' => ucfirst( str_replace('_', ' ', $name) ).' '.esc_html__('Split Text Animation', 'apexus' ),
            'type' => 'select',
            'options' => [
                ''               => esc_html__( 'None', 'apexus' ),
                'split-in-fade' => esc_html__( 'In Fade', 'apexus' ),
                'split-in-right' => esc_html__( 'In Right', 'apexus' ),
                'split-in-left'  => esc_html__( 'In Left', 'apexus' ),
                'split-in-up'    => esc_html__( 'In Up', 'apexus' ),
                'split-in-down'  => esc_html__( 'In Down', 'apexus' ),
                'split-lines-rotation-x'  => esc_html__( 'Lines Transform rotate rotate', 'apexus' ),
            ],
            'label_block' => true,
            'default' => '',
        ],

    ];
    return $options;

}

function apexus_get_parallax_effect_settings($settings){
    $effects = [];
    if(!empty($settings['parallax_effect_x'])){
        $effects['x'] = (int)$settings['parallax_effect_x'];
    }
    if(!empty($settings['parallax_effect_y'])){
        $effects['y'] = (int)$settings['parallax_effect_y'];
    }
    if(!empty($settings['parallax_effect_z'])){
        $effects['z'] = (int)$settings['parallax_effect_z'];
    }
    if(!empty($settings['parallax_effect_rotate_x'])){
        $effects['rotateX'] = (float)$settings['parallax_effect_rotate_x'];
    }
    if(!empty($settings['parallax_effect_rotate_y'])){
        $effects['rotateY'] = (float)$settings['parallax_effect_rotate_y'];
    }
    if(!empty($settings['parallax_effect_scale_z'])){
        $effects['rotateZ'] = (float)$settings['parallax_effect_scale_z'];
    }
    if(!empty($settings['parallax_effect_scale_x'])){
        $effects['scaleX'] = (float)$settings['parallax_effect_scale_x'];
    }
    if(!empty($settings['parallax_effect_scale_y'])){
        $effects['scaleY'] = (float)$settings['parallax_effect_scale_y'];
    }
    if(!empty($settings['parallax_effect_scale_z'])){
        $effects['scalez'] = (float)$settings['parallax_effect_scale_z'];
    }
    if(!empty($settings['parallax_effect_scale'])){
        $effects['scale'] = (float)$settings['parallax_effect_scale'];
    }
    return json_encode($effects);
}

function apexus_get_instagram_data($settings){
    if (!class_exists('SB_Instagram_Feed')) return [];

    $atts = array();
    $preview_settings = false;
    $database_settings = sbi_get_database_settings();
 
    $instagram_feed_settings = new SB_Instagram_Settings( $atts, $database_settings, $preview_settings );
 
    $instagram_feed_settings->set_feed_type_and_terms();
    $instagram_feed_settings->set_transient_name();
    $transient_name = $instagram_feed_settings->get_transient_name();
    $sb_settings = $instagram_feed_settings->get_settings();
    $feed_type_and_terms = $instagram_feed_settings->get_feed_type_and_terms();

    $sb_settings['num'] = !empty($settings['number_item']) ? (int)$settings['number_item'] : $sb_settings['num']; 
    $sb_settings['minnum'] = !empty($settings['number_item']) ? (int)$settings['number_item'] : $sb_settings['minnum']; 

    $instagram_feed = new SB_Instagram_Feed( $transient_name );

    $instagram_feed->set_cache( $instagram_feed_settings->get_cache_time_in_seconds(), $sb_settings );

    if ( $sb_settings['caching_type'] === 'background' ) {
        $instagram_feed->add_report( 'background caching used' );
        if ( $instagram_feed->regular_cache_exists() ) {
            $instagram_feed->add_report( 'setting posts from cache' );
            $instagram_feed->set_post_data_from_cache();
        }

        if ( $instagram_feed->need_to_start_cron_job() ) {
            $instagram_feed->add_report( 'setting up feed for cron cache' );
            $to_cache = array(
                'atts' => $atts,
                'last_requested' => time(),
            );

            $instagram_feed->set_cron_cache( $to_cache, $instagram_feed_settings->get_cache_time_in_seconds() );

            SB_Instagram_Cron_Updater::do_single_feed_cron_update( $instagram_feed_settings, $to_cache, $atts, false );
            $instagram_feed->set_cache( $instagram_feed_settings->get_cache_time_in_seconds(), $sb_settings );
            $instagram_feed->set_post_data_from_cache();
        } elseif ( $instagram_feed->should_update_last_requested() ) {
            $instagram_feed->add_report( 'updating last requested' );
            $to_cache = array(
                'last_requested' => time(),
            );

            $instagram_feed->set_cron_cache( $to_cache, $instagram_feed_settings->get_cache_time_in_seconds(), $sb_settings['backup_cache_enabled'] );
        }

    } elseif ( $instagram_feed->regular_cache_exists() ) {
        $instagram_feed->add_report( 'page load caching used and regular cache exists' );
        $instagram_feed->set_post_data_from_cache();

        if ( $instagram_feed->need_posts( $sb_settings['num'] ) && $instagram_feed->can_get_more_posts() ) {
            while ( $instagram_feed->need_posts( $sb_settings['num'] ) && $instagram_feed->can_get_more_posts() ) {
                $instagram_feed->add_remote_posts( $sb_settings, $feed_type_and_terms, $instagram_feed_settings->get_connected_accounts_in_feed() );
            }
            $instagram_feed->cache_feed_data( $instagram_feed_settings->get_cache_time_in_seconds(), $sb_settings['backup_cache_enabled'] );
        }

    } else {
        $instagram_feed->add_report( 'no feed cache found' );

        while ( $instagram_feed->need_posts( $sb_settings['num'] ) && $instagram_feed->can_get_more_posts() ) {
            $instagram_feed->add_remote_posts( $sb_settings, $feed_type_and_terms, $instagram_feed_settings->get_connected_accounts_in_feed() );
        }

        if ( ! $instagram_feed->should_use_backup() ) {
            $instagram_feed->cache_feed_data( $instagram_feed_settings->get_cache_time_in_seconds(), $sb_settings['backup_cache_enabled'] );
        }

    }
  
    $post_data = $instagram_feed->get_post_data();

    if ( empty( $post_data ) && ! empty( $connected_accounts_for_feed ) && $sb_settings['minnum'] > 0 ) {
        $instagram_feed->handle_no_posts_found( $sb_settings, $feed_types_and_terms );
    }
   
      
    $posts = array_slice( $post_data, 0, $sb_settings['minnum'] );

    return $posts;
}

function apexus_elementor_wc_attribute_taxonomies(){
    $result = [];
    $attribute_array      = array();
    $attribute_taxonomies = wc_get_attribute_taxonomies();
    if ( ! empty( $attribute_taxonomies ) ) {
        foreach ( $attribute_taxonomies as $tax ) {
            if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) ) {
                $attribute_array[ $tax->attribute_name ] = $tax->attribute_name;
            }
        }
    }
    $result[] = array(
        'name'    => 'attribute_filter',
        'label'   => esc_html__( 'Select Attribute', 'apexus' ),
        'type'    => Controls_Manager::SELECT,
        'options' => $attribute_array,
        'label_block' => true,
        'default'   => '',
        'condition'   => ['filter_type' => 'attribute'],
    );

    return $result;
}