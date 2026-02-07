<?php 
/**
 * Actions Hook for the theme
 *
 * @package Apexus
 */
 
add_action('after_setup_theme', 'apexus_setup');
function apexus_setup(){
    //Set the content width in pixels, based on the theme's design and stylesheet.
    $GLOBALS['content_width'] = apply_filters( 'apexus_content_width', 1200 );

    // Make theme available for translation.
    load_theme_textdomain( 'apexus', get_template_directory() . '/languages' );

    // Custom Header
    add_theme_support( 'custom-header' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // Set post thumbnail size.
    set_post_thumbnail_size( 1170, 710 );
       
    // This theme uses wp_nav_menu() in one location.
    $menu_locations = apexus_get_menu_location();
    register_nav_menus( $menu_locations );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for core custom logo.
    add_theme_support( 'custom-logo', array(
        'height'      => 120,
        'width'       => 400,
        'flex-width'  => true,
        'flex-height' => true,
    ) );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');
    remove_theme_support('widgets-block-editor');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    remove_theme_support('widgets-block-editor');

}
 
add_action('after_switch_theme', 'apexus_update');
function apexus_update(){
    /* Change default image thumbnail sizes in wordpress */
    $thumbnail_size = [ 
        'thumbnail'    => [
            'thumbnail_size_w'    => 300,
            'thumbnail_size_h'    => 300,
            'thumbnail_crop'      => 1,
        ], //user avatar
        'medium'       => [
            'medium_size_w'       => 624,  
            'medium_size_h'       => 468,
            'medium_crop'         => 1,
        ], //blog standard
        'large'        => [
            'large_size_w'        => 850,  
            'large_size_h'        => 468,
            'large_crop'          => 1, 
        ]  //blog single 
    ];

    foreach ($thumbnail_size as $values) {
        foreach ($values as $option => $value) {
            if( get_option($option, '') != $value){  
                update_option($option, $value);
            }
        }
    }
  
}

/**
 * Register Widgets Position.
 */
add_action( 'widgets_init', 'apexus_widgets_position' );
function apexus_widgets_position() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'apexus' ),
		'id'            => 'sidebar-blog',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h5 class="widget-title"><span>',
		'after_title'   => '</span></h5>',
	) );
      
}

/**
 * Enqueue Styles Scripts : Front-End
 */
add_action( 'wp_enqueue_scripts', 'apexus_scripts', 99 );
function apexus_scripts() {  
    $js_variables = array(
        'ajaxurl'        => admin_url( 'admin-ajax.php' ),
        'pxl_ajax_url'     => class_exists('Apexus_Ajax') ? Apexus_Ajax::get_endpoint( '%%endpoint%%' ) : '#',
        'nonce'          => wp_create_nonce( 'apexus-security' ),
    );
    wp_enqueue_style( 'pixelart-icon', get_template_directory_uri() . '/assets/fonts/pixelart/style.css', array(), '1.1.0');
    
    wp_register_style( 'lightgallery', get_template_directory_uri() . '/assets/css/lightgallery.min.css', null, '1.6.12' );
   
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '1.0.0' );
	wp_enqueue_style( 'apexus-style', get_template_directory_uri() . '/assets/css/style.css', array(), apexus()->get_version() );
	wp_add_inline_style( 'apexus-style', apexus_inline_styles() );
    wp_enqueue_style( 'apexus-base', get_template_directory_uri() . '/style.css', array(), apexus()->get_version() );
	wp_enqueue_style( 'apexus-google-fonts', apexus_fonts_url(), array(), null );
 
    wp_enqueue_script( 'gsap', get_template_directory_uri() . '/assets/js/gsap.min.js', array( 'jquery' ), '3.5.0', true );
    wp_register_script( 'gsap-scroll-trigger', get_template_directory_uri() . '/assets/js/ScrollTrigger.min.js', array( 'jquery' ), '3.12.5', true );
    wp_register_script( 'gsap-split-text', get_template_directory_uri() . '/assets/js/SplitText.min.js', array( 'jquery' ), '3.12.5', true );
    wp_enqueue_script( 'pxl-parallax-scroll', get_template_directory_uri() . '/assets/js/parallax-scroll.js', array( 'jquery' ), apexus()->get_version(), true );
    wp_enqueue_script( 'nice-select', get_template_directory_uri() . '/assets/js/nice-select.min.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'apexus-cursor', get_template_directory_uri() . '/assets/js/cursor.js', array( 'jquery' ), apexus()->get_version(), true ); 
     
    wp_register_script( 'lightgallery', get_template_directory_uri() . '/assets/js/lightgallery-all.min.js', array('jquery'), '1.6.12', true );

    /* InertiaPlugin */
    wp_enqueue_script('inertiaplugin', get_template_directory_uri() . '/assets/js/libs/InertiaPlugin.min.js',  array( 'jquery' ), '3.12.5', true );
     /* TweenMax */
    wp_enqueue_script('TweenMax', get_template_directory_uri() . '/assets/js/libs/TweenMax.min.js',  array( 'jquery' ), '2.1.2', true );
    wp_enqueue_script( 'curtains-lib', get_template_directory_uri() . '/assets/js/libs/curtains.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script('Three', get_template_directory_uri() . '/assets/js/libs/three.min.js',  [ 'jquery' ], apexus()->get_version(), true );

    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/libs/magnific-popup.min.js', array( 'jquery' ), '1.0.0', true );
     /* divider move on menu */
    wp_enqueue_script('vanilla', get_template_directory_uri() . '/assets/js/libs/vanilla-tilt.min.js',  array( 'jquery' ), 'all', true );
    wp_register_script( 'pxl-ScrollToPlugin', get_template_directory_uri() . '/assets/js/libs/scroll-toplpugin.js', array( 'jquery' ), '3.12.5', true );
    wp_register_script('particles-background', get_template_directory_uri() . '/assets/js/libs/particles.min.js',  [ 'jquery' ], apexus()->get_version(), true ); 

    wp_register_script( 'swiper-bundle', get_template_directory_uri() . '/assets/js/libs/swiper-bundle.min.js', array( 'jquery' ), '12.0.3', true );
    wp_register_script( 'swiper-gl', get_template_directory_uri() . '/assets/js/libs/swiper-gl.min.js', array( 'jquery' ), '1.0.0', true );

    $smoothscroll = apexus()->get_theme_opt( 'smoothscroll', false );
    if(isset($smoothscroll) && $smoothscroll) {
        $js_variables['lenis'] = true;
        wp_enqueue_script('lenis-smoothscroll', get_template_directory_uri() . '/assets/js/libs/lenis.min.js', [], '1.3.11', true);
    }
    wp_enqueue_script( 'apexus-main', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery', 'gsap-scroll-trigger'), apexus()->get_version(), true );
    wp_localize_script( 'apexus-main', 'main_data', $js_variables );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    do_action( 'apexus_scripts');
}

/**
 * Enqueue Styles Scripts : Back-End
 */
add_action('admin_enqueue_scripts', 'apexus_admin_style');
function apexus_admin_style() {
    wp_enqueue_style( 'pixelart-icon', get_template_directory_uri() . '/assets/fonts/pixelart/style.css', array(), '1.1.0');
}

 
add_action('wp_head', 'apexus_site_favicon');
function apexus_site_favicon(){
    $favicon = apexus()->get_theme_opt( 'favicon' );
    if(!empty($favicon['url']))
        echo '<link rel="icon" type="image/png" href="'.esc_url($favicon['url']).'"/>';
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
add_action( 'wp_head', 'apexus_pingback_header' );
function apexus_pingback_header(){
    if ( is_singular() && pings_open() )
    {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
 

/**
 * Add field subtitle to post.
 */
add_action( 'edit_form_after_title', 'apexus_add_subtitle_field' );
function apexus_add_subtitle_field() {
	global $post;

	$screen = get_current_screen();

	if ( in_array( $screen->id, array( 'acm-post' ) ) ) {

		$value = get_post_meta( $post->ID, 'post_subtitle', true );

		echo '<div class="subtitle"><input type="text" name="post_subtitle" value="' . esc_attr( $value ) . '" id="subtitle" placeholder = "' . esc_attr__( 'Subtitle', 'apexus' ) . '" style="width: 100%;margin-top: 4px;"></div>';
	}
}
 
 
add_action('wp_footer', 'apexus_backtotop',2);
function apexus_backtotop($args = []){
    $back_totop_on = apexus()->get_theme_opt('back_totop_on', '0');
     $back_totop_on_style = apexus()->get_theme_opt('back_totop_on_style', '');
    if ($back_totop_on !== '1') return;
    $class = 'pxl-scroll-top';
    if ($back_totop_on_style === 'custom-style-1') {
        $class .= ' custom-style-1';
    }
    ?>
    <a href="<?php echo esc_url(home_url('/'))?>" class="<?php echo esc_attr($class); ?>" data-target="#pxl-page">
        <svg class="pxl-scroll-progress-circle" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
        </svg>
        <span class="pxl-icon pxli-angle-up"></span>
    </a>
<?php 
} 

add_action( 'pxltheme_anchor_target', 'apexus_hook_anchor_side_mobile_default');
function apexus_hook_anchor_side_mobile_default(){
    $header_mobile_layout = (int)apexus()->get_opt('header_mobile_layout'); 
    if( $header_mobile_layout > 0 ) return;
    $logo_url = get_template_directory_uri().'/assets/images/logo.png';

    $menu_location_mobile_custom = apexus()->get_page_opt('menu_location_mobile','-1');

    if(!empty($menu_location_mobile_custom) && $menu_location_mobile_custom != '-1') {
        $menu_location_mobile = $menu_location_mobile_custom;
    }else{
        $menu_location_mobile = 'primary';
    }
    ?>
    <nav class="pxl-hidden-template pos-left pxl-side-mobile mobile-panel-df">
        <div class="pxl-panel-header">
            <div class="panel-header-inner d-flex align-items-center justify-content-between">
                <?php 
                printf(
                    '<a class="logo-default" href="%1$s" title="%2$s" rel="home"><img class="pxl-logo" src="%3$s" alt="%2$s"/></a>',
                    esc_url( home_url( '/' ) ),
                    esc_attr( get_bloginfo( 'name' ) ),
                    esc_url( $logo_url )
                );
                ?>
                <span class="pxl-close" data-target=".pxl-side-mobile" title="<?php echo esc_attr__( 'Close', 'apexus' ) ?>"></span>
            </div>
        </div> 
        <div class="pxl-panel-content custom_scroll">
            <div class="menu-main-container-wrap">
                <div id="mobile-menu-container" class="menu-main-container pxl-nav-menu-mobile">
                    <?php 
                        if ( has_nav_menu( $menu_location_mobile ) ){
                            wp_nav_menu( 
                                array(
                                    'theme_location' => $menu_location_mobile,
                                    'container'      => '',
                                    'menu_id'        => 'pxl-mobile-menu',
                                    'menu_class'     => 'pxl-mobile-menu clearfix',
                                    'link_before'    => '<span class="pxl-menu-title">',
                                    'link_after'     => '</span>',  
                                    'walker'         => '',
                                ) 
                            );
                        }else{
                            printf(
                                '<ul class="pxl-mobile-menu pxl-primary-menu primary-menu-not-set"><li><a href="%1$s">%2$s</a></li></ul>',
                                esc_url( admin_url( 'nav-menus.php' ) ),
                                esc_html__( 'Create New Menu', 'apexus' )
                            );
                        }
                    ?>
                </div>
            </div>
        </div>
    </nav>
    <?php 
}
add_action( 'pxltheme_anchor_target', 'apexus_hook_anchor_templates_hidden_panel');
function apexus_hook_anchor_templates_hidden_panel(){

    $hidden_templates = apexus_get_templates_slug('hidden-panel');
    if(empty($hidden_templates)) return;

    foreach ($hidden_templates as $slug => $values){
        $cur_post_id = apply_filters( 'wpml_object_id', $values['post_id'], 'post' );
        $args = [
            'slug' => $slug,
            'post_id' => $cur_post_id,
            'position' => !empty($values['position']) ? $values['position'] : 'custom-pos',
            'custom_style' => !empty($values['custom_style']) ? $values['custom_style'] : '',
        ];
        if( did_action('pxl_anchor_target_hidden_panel_'.$cur_post_id) <= 0){
            //can be assign from here: do_action( 'pxl_anchor_target_hidden_panel_'.$slug);
            do_action( 'pxl_anchor_target_hidden_panel_'.$cur_post_id, $args );
        }
    } 
}

function apexus_hook_anchor_hidden_panel($args){  
    $custom_offset = get_post_meta( $args['post_id'], 'custom_offset', true );
    $custom_offset_mobile = get_post_meta( $args['post_id'], 'custom_offset_mobile', true );

    $bg_color = get_post_meta( $args['post_id'], 'template_bg_color', true );
    
    $custom_style = $custom_style_str = '';
    if( $args['position'] == 'custom' && ( !empty($custom_offset['top']) || !empty($custom_offset['right']) || !empty($custom_offset['bottom']) ||!empty($custom_offset['left']) ) ){
        $custom_style = '--hd-top-offset:'.$custom_offset['top'].'; --hd-right-offset:'.$custom_offset['right'].'; --hd-bottom-offset:'.$custom_offset['bottom'].'; --hd-left-offset:'.$custom_offset['left'].';';
    }
    if( !empty($custom_style) && ( !empty($custom_offset_mobile['top']) || !empty($custom_offset_mobile['right']) || !empty($custom_offset_mobile['bottom']) ||!empty($custom_offset_mobile['left']) ) ){
        $custom_style .= '--hd-top-offset-mobile:'.$custom_offset_mobile['top'].'; --hd-right-offset-mobile:'.$custom_offset_mobile['right'].'; --hd-bottom-offset-mobile:'.$custom_offset_mobile['bottom'].'; --hd-left-offset-mobile:'.$custom_offset_mobile['left'].';';
    }
    if( !empty($bg_color['rgba']) ){
        $custom_style .= '--tpl-bg-color:'.$bg_color['rgba'].';';
    }

    if( !empty($custom_style) ){
        $custom_style_str = 'style="'.$custom_style.'"';
    }
 
    ?>
    <div class="pxl-hidden-template pxl-hidden-template-<?php echo esc_attr($args['post_id'])?> el-builder pos-<?php echo esc_attr($args['position']) ?> <?php echo esc_attr($args['custom_style']) ?>" <?php echo !empty($custom_style_str) ? $custom_style_str : '';?>>
        <div class="pxl-hidden-template-wrap">
            <div class="pxl-panel-content custom_scroll">
                <span class="pxl-close" title="<?php echo esc_attr__( 'Close', 'apexus' ) ?>"></span>
               <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$args['post_id']); ?>
            </div>
        </div>
    </div> 
    <?php 
    
}
  

add_action( 'elementor/init', 'apexus_elementor_update_option' );
function apexus_elementor_update_option(){
    $elementor_unfiltered_files_upload = get_option( 'elementor_unfiltered_files_upload', '' );
     
    if( empty($elementor_unfiltered_files_upload) )
        update_option( 'elementor_unfiltered_files_upload', '1' );

}

add_action( 'user_registration_init', 'apexus_update_user_registration' );
function apexus_update_user_registration(){ 
    $user_registration_placeholder_username_or_email = get_option( 'user_registration_placeholder_username_or_email', '' );
    $user_registration_placeholder_password = get_option( 'user_registration_placeholder_password', '' );

    if( empty($user_registration_placeholder_username_or_email) )
        update_option( 'user_registration_placeholder_username_or_email', 'Username' );

    if( empty($user_registration_placeholder_password) )
        update_option( 'user_registration_placeholder_password', 'Password' );
}
 
add_action( 'wp_ajax_apexus_update_post_like', 'apexus_update_post_like' );
add_action( 'wp_ajax_nopriv_apexus_update_post_like', 'apexus_update_post_like' );
function apexus_update_post_like() {
    $nonce_value        = sanitize_text_field( wp_unslash($_POST['security']) ) ;
    $target      = isset( $_POST['target'] ) ? sanitize_text_field( $_POST['target'] ) : '';
    $post_id      = isset( $_POST['post_id'] ) ? sanitize_text_field( $_POST['post_id'] ) : 0;
    
    if( wp_verify_nonce( $nonce_value, 'apexus-security' )){
        if ( isset($_COOKIE['pxl_' . $post_id])) {
            wp_send_json(
                array(
                    'success'    => true,
                    'message'    => 'Invalid action',
                    'post_id'    => $post_id,
                    'target'    => $target
                )
            );
            die();
        }

        if ($target == 'like') {
            $like_count = (int)get_post_meta($post_id, 'pxl_like_count', true);
            $dislike_count = (int)get_post_meta($post_id, 'pxl_dislike_count', true);
            $like_count = $like_count + 1;
            $total = $like_count + $dislike_count;
            $check = update_post_meta($post_id, 'pxl_like_count', $like_count);
            if ($check) {
                $response_array = array('success' => true, 'latest_count' => $like_count, 'like_count' => $like_count, 'dislike_count' => $dislike_count, 'total' => $total, 'post_id' => $post_id, 'target' => $target);
            } else {
                $response_array = array('success' => false, 'latest_count' => $like_count, 'like_count' => $like_count, 'dislike_count' => $dislike_count, 'total' => $total, 'post_id' => $post_id, 'target' => $target);
            }
        }else {
            $like_count = (int)get_post_meta($post_id, 'pxl_like_count', true);
            $dislike_count = (int)get_post_meta($post_id, 'pxl_dislike_count', true);
            $dislike_count = $dislike_count + 1;
            $total = $dislike_count + $like_count;
            $check = update_post_meta($post_id, 'pxl_dislike_count', $dislike_count);
            if ($check) {
                $response_array = array('success' => true, 'latest_count' => $dislike_count, 'like_count' => $like_count, 'dislike_count' => $dislike_count, 'total' => $total, 'post_id' => $post_id, 'target' => $target);
            } else {
                $response_array = array('success' => false, 'latest_count' => $dislike_count, 'like_count' => $like_count, 'dislike_count' => $dislike_count, 'total' => $total, 'post_id' => $post_id, 'target' => $target);
            }
        }

        setcookie('pxl_' . $post_id, $target, time() + 365 * 24 * 60 * 60, '/');

        wp_send_json( $response_array );
 
        die;
    }else {
        die('No script!');
    }
}

add_action('wp_ajax_pxl_undo_post_like', 'pxl_undo_post_like');
add_action('wp_ajax_nopriv_pxl_undo_post_like', 'pxl_undo_post_like');
function pxl_undo_post_like() {
    $nonce_value        = sanitize_text_field( wp_unslash($_POST['security']) ) ;
    $target      = isset( $_POST['target'] ) ? sanitize_text_field( $_POST['target'] ) : '';
    $post_id      = isset( $_POST['post_id'] ) ? sanitize_text_field( $_POST['post_id'] ) : 0;
    if( wp_verify_nonce( $nonce_value, 'apexus-security' )){
        if (!isset($_COOKIE['pxl_' . $post_id])) {
            wp_send_json(
                array(
                    'success'    => false,
                    'message'    => 'Invalid action',
                    'post_id'    => $post_id,
                    'target'    => $target
                )
            );
            die();
        }

        if ($target == 'like') {
            $like_count = (int)get_post_meta($post_id, 'pxl_like_count', true);
            $dislike_count = (int)get_post_meta($post_id, 'pxl_dislike_count', true);
            $like_count = $like_count - 1;
            $total = $like_count + $dislike_count;
            $check = update_post_meta($post_id, 'pxl_like_count', $like_count);

            if ($check) {
                $response_array = array('success' => true, 'latest_count' => $like_count, 'like_count' => $like_count, 'dislike_count' => $dislike_count, 'total' => $total, 'post_id' => $post_id, 'target' => $target);
            } else {
                $response_array = array('success' => false, 'latest_count' => $like_count, 'like_count' => $like_count, 'dislike_count' => $dislike_count, 'total' => $total, 'post_id' => $post_id, 'target' => $target);
            }
 
        } else {
            $like_count = (int)get_post_meta($post_id, 'pxl_like_count', true);
            $dislike_count = (int)get_post_meta($post_id, 'pxl_dislike_count', true);
            $dislike_count = $dislike_count - 1;
            $total = $dislike_count + $like_count;
            $check = update_post_meta($post_id, 'pxl_dislike_count', $dislike_count);
            if ($check) {
                $response_array = array('success' => true, 'latest_count' => $dislike_count, 'like_count' => $like_count, 'dislike_count' => $dislike_count, 'total' => $total, 'post_id' => $post_id, 'target' => $target);
            } else {
                $response_array = array('success' => false, 'latest_count' => $dislike_count, 'like_count' => $like_count, 'dislike_count' => $dislike_count, 'total' => $total, 'post_id' => $post_id, 'target' => $target);
            }
        }
        
        setcookie('pxl_' . $post_id, $target, time() - 3600 * 24 * 365, '/');
        wp_send_json( $response_array );
    }else {
        die('No script!');
    }
}

////
function custom_sidebars() {
    register_sidebar([
        'name' => 'Sidebar Single',
        'id' => 'sidebar-single',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ]);
}
add_action('widgets_init', 'custom_sidebars');
