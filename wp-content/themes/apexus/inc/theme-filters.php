<?php
/**
 * Filters hook for the theme
 *
 * @package Apexus
 */

add_filter( 'pxl_server_info', 'apexus_add_server_info');
function apexus_add_server_info($infos){
    $infos = [
        'api_url' => 'https://api.7iquid.com/',
        'docs_url' => 'https://7iquid.gitbook.io/apexus-wordpress-theme',
        'plugin_url' => 'https://7iquid.com/plugins/',
        'demo_url' => 'https://demo.7iquid.com/apexus/',
        'support_url' => 'https://7iquid.ticksy.com/',
        'help_url' => '#',
        'email_support' => '7iquid.agency@gmail.com',
        'video_url' => '#'
    ];

    return $infos;
}

add_filter( 'pxl-swiper-version-active', 'apexus_set_swiper_version_active' );
function apexus_set_swiper_version_active($version){
	$version = '8.4.5'; //5.3.6, 7.4.1, 8.4.5, 10.3.0, 11.0.6
	return $version;
}

add_filter( 'pxl_set_dev_mode', 'apexus_set_dev_mode' );
function apexus_set_dev_mode($value){
	$value = true;
	return $value;
}

add_filter( 'body_class', 'apexus_body_classes' );
function apexus_body_classes( $classes ){   
	 
    $footer_position = apexus()->get_opt('footer_position', '0');

	$dark_light_option = apexus()->get_opt('dark_light_option', '');
    if($footer_position == '1') 
    	$classes[] = 'footer-fixed';

	$classes[] = esc_attr($dark_light_option);
    return $classes;
}

 
add_filter( 'pxl_main_class', 'apexus_main_classes' );
function apexus_main_classes($str_cls){

    if( class_exists('\Elementor\Plugin') && is_singular() && \Elementor\Plugin::$instance->documents->get(get_the_ID())->is_built_with_elementor() ){
    	$str_cls .= ' page-builder-el';
    }
    return $str_cls;
}

add_filter( 'phb_room_type_metabox_extra', 'apexus_room_type_metabox_extra' );
function apexus_room_type_metabox_extra($extra_setting){
	$extra_setting = [
		'title'  => esc_html__( 'Post Setting', 'apexus' ),
		'icon'   => 'el el-indent-left',
		'fields' => array_merge(
			apexus_header_opts([
				'default'         => true,
				'default_value'   => '-1'
			]),
	        apexus_page_title_opts([
				'default'         => true,
				'default_value'   => '-1'
			]),
			array(
				array(
                    'title'         => esc_html__('Video Url', 'apexus'),
                    'id'            => 'video_url',
                    'type'          => 'text',
                    'default'       => ''
                ),
			)
	    ) 
	];
	 
    return $extra_setting;
}


/* Post Type Support Elementor*/
add_filter( 'pxl_add_cpt_support', 'apexus_add_cpt_support' );
function apexus_add_cpt_support($cpt_support) { 
	$cpt_support[] = 'services';
	$cpt_support[] = 'portfolio';
	$cpt_support[] = 'career';
    $cpt_support[] = 'pxl-slider';
    //$cpt_support[] = 'product';
    return $cpt_support;
}


add_filter( 'pxl_extra_post_types', 'apexus_add_post_type' );
function apexus_add_post_type( $postypes ) {
	$theme_options = get_option(apexus()->get_option_name(), []);
	$services_slug = !empty( $theme_options['services_slug'] ) ? $theme_options['services_slug'] : 'services'; 
	$services_name = !empty( $theme_options['services_name'] ) ? $theme_options['services_name'] : esc_html__( 'Services', 'apexus' ); 

	$portfolio_slug = !empty( $theme_options['portfolio_slug'] ) ? $theme_options['portfolio_slug'] : 'portfolio'; 
	$portfolio_name = !empty( $theme_options['portfolio_name'] ) ? $theme_options['portfolio_name'] : esc_html__( 'Portfolio', 'apexus' ); 

	$career_slug = !empty( $theme_options['career_slug'] ) ? $theme_options['career_slug'] : 'career'; 
	$career_name = !empty( $theme_options['career_name'] ) ? $theme_options['career_name'] : esc_html__( 'Career', 'apexus' ); 

	$postypes['career'] = array(
		'status' => true,
		'item_name'  => $career_name,
		'items_name' => $career_name,
		'args'       => array(
			'menu_icon' => 'dashicons-media-text',
			'supports'           => array(
                'title',
                'editor',
                'thumbnail',
                'excerpt',
            ),
			'rewrite'             => array(
                'slug'       => $career_slug,
 		 	)
		),
	);  

	$postypes['portfolio'] = array(
		'status' => true,
		'item_name'  => $portfolio_name,
		'items_name' => $portfolio_name,
		'args'       => array(
			'supports'           => array(
                'title',
                'editor',
                'thumbnail',
                'excerpt',
            ),
			'rewrite'             => array(
                'slug'       => $portfolio_slug,
 		 	)
		),
	);  

	$postypes['services'] = array(
		'status' => true,
		'item_name'  => $services_name,
		'items_name' => $services_name,
		'args'       => array(
			'supports'           => array(
                'title',
                'editor',
                'thumbnail',
                'excerpt',
            ),
			'rewrite'             => array(
                'slug'       => $services_slug,
 		 	)
		),
	);  

    $postypes['pxl-slider'] = [
        'status'     => true,
        'item_name'  => esc_html__('Slider Builder', 'apexus'),
		'items_name' => esc_html__('Slider Builder', 'apexus'),
        'args'       => array(
            'supports'           => array(
                'title',
                'editor',
                'thumbnail',
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_in_nav_menus'   => false
        ),
        'labels'     => array()
    ]; 
 
	return $postypes;
}

add_filter( 'pxl_extra_taxonomies', 'apexus_add_tax' );
function apexus_add_tax( $taxonomies ) {
	$taxonomies['career-category'] = array(
		'status'     => true,
		'post_type'  => array( 'career' ),
		'taxonomy'   => 'Career Categories',
		'taxonomies' => 'Career Categories',
		'args'       => array(
			'rewrite'             => array(
                'slug'       => 'career-category'
 		 	),
		),
		'labels'     => array()
	);
	$taxonomies['portfolio-category'] = array(
		'status'     => true,
		'post_type'  => array( 'portfolio' ),
		'taxonomy'   => 'Portfolio Categories',
		'taxonomies' => 'Portfolio Categories',
		'args'       => array(
			'rewrite'             => array(
                'slug'       => 'portfolio-category'
 		 	),
		),
		'labels'     => array()
	);
	$taxonomies['services-category'] = array(
		'status'     => true,
		'post_type'  => array( 'services' ),
		'taxonomy'   => 'Services Categories',
		'taxonomies' => 'Services Categories',
		'args'       => array(
			'rewrite'             => array(
                'slug'       => 'services-category'
 		 	),
		),
		'labels'     => array()
	);
 
	return $taxonomies;
}

 
 
add_filter( 'pxl_theme_builder_post_types', 'apexus_theme_builder_post_type' );
function apexus_theme_builder_post_type($postypes){
	//default is pxl-template
	$postypes[] = 'pxl-slider';
	return $postypes;
}

add_filter( 'pxl_theme_builder_layout_ids', 'apexus_theme_builder_layout_id' );
function apexus_theme_builder_layout_id($layout_ids){
	//default [], 
	$header_layout        = (int)apexus()->get_opt('header_layout');
	$header_mobile_layout = (int)apexus()->get_opt('header_mobile_layout');

	$ptitle_layout 	      = (int)apexus()->get_opt('ptitle_layout');
 
	$footer_layout = (int)apexus()->get_opt('footer_layout');


	if( $header_layout > 0) 
		$layout_ids[] = $header_layout;
	if( $header_mobile_layout > 0) 
		$layout_ids[] = $header_mobile_layout;
	if( $ptitle_layout > 0) 
		$layout_ids[] = $ptitle_layout;
	if( $footer_layout > 0) 
		$layout_ids[] = $footer_layout;

	if (is_singular()){
		$post_id = get_the_ID();
		if ($post_id){
			$elementor_data = get_post_meta($post_id, '_elementor_data', true);
			$data = json_decode($elementor_data, true);
			if (is_array($data)){
				array_walk_recursive($data, function($value, $key) use (&$layout_ids) {
			        if ( ($key === 'slide_item' || $key === 'content_template') && intval($value) > 0) {
			            $layout_ids[] = intval($value);
			        }
			   	});
			}
		}
	}

	$hidden_template = apexus_get_templates_option('hidden-sidebar');
	if( count($hidden_template) > 0){
		foreach ($hidden_template as $key => $value) {
			$layout_ids[] = $key;
		}
	}

	$mega_menu_id = apexus_get_mega_menu_builder_id();
	
	if(!empty($mega_menu_id))
		$layout_ids = array_merge($layout_ids, $mega_menu_id);
	
	return $layout_ids;
}
 
add_filter( 'pxl_wg_get_source_id_builder', 'apexus_wg_get_source_builder' );
function apexus_wg_get_source_builder($wg_datas){
	$wg_datas['pxl_slider'] = 'slider_source';
	$wg_datas['pxl_tabs'] = ['control_name' => 'tabs_list', 'source_name' => 'content_template'];
	return $wg_datas;
}

add_filter( 'pxl_template_type_support', 'apexus_template_type_support' );
function apexus_template_type_support($type){
	//default ['header','footer','mega-menu']
	$extra_type = [
		'header'        => esc_html__('Header', 'apexus'), 
		'header-mobile' => esc_html__('Header Mobile', 'apexus'), 
		'footer'        => esc_html__('Footer', 'apexus'), 
		'mobile-menu'   => esc_html__('Mobile Menu', 'apexus'), 
		'mega-menu'     => esc_html__('Mega Menu', 'apexus'), 
		'page-title'    => esc_html__('Page Title', 'apexus'), 
		'hidden-sidebar'  => esc_html__('Hidden Sidebar', 'apexus'), 
		'tab'           => esc_html__('Tabs', 'apexus'),
		'popup'  		=> esc_html__('Popup (search form, login form, menu...)', 'apexus'),
		'accordion'  => esc_html__('Accordion', 'apexus'), 
	];
	$template_type = array_merge($type,$extra_type); 
	return $template_type;
}
  
add_filter( 'get_the_archive_title', 'apexus_archive_title_remove_label' );
function apexus_archive_title_remove_label( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_home() ) {
		$title = single_post_title( '', false );
	}

	return $title;
}

add_filter( 'comment_reply_link', 'apexus_comment_reply_text' );
function apexus_comment_reply_text( $link ) {
	$link = str_replace( 'Reply', ''.esc_attr__('Reply', 'apexus').'', $link );
	return $link;
}
 

add_filter( 'pxl_enable_megamenu', 'apexus_enable_megamenu' );
function apexus_enable_megamenu() {
	return true;
}
add_filter( 'pxl_enable_onepage', 'apexus_enable_onepage' );
function apexus_enable_onepage() {
	return true;
}

add_filter( 'pxl_support_awesome_pro', 'apexus_support_awesome_pro' );
function apexus_support_awesome_pro() {
	$enable_awesome_pro = apexus()->get_theme_opt('enable_awesome_pro', '0');
	if( $enable_awesome_pro == '1')
		return true;
	return false;
}

add_filter( 'pxl_support_js_core_main', 'apexus_support_js_core_main' );
function apexus_support_js_core_main() {
	return true;
}

add_filter( 'pxl_enable_menu_icons', 'apexus_enable_menu_icons' );
function apexus_enable_menu_icons() {
	$enable_menu_icons = apexus()->get_theme_opt('enable_menu_icons', '0');
	if( $enable_menu_icons == '1')
		return true;

	return false;
}
 
add_filter( 'pxl_support_e_control_icons', 'apexus_support_e_control_icons' );
function apexus_support_e_control_icons() {
	return true;
}
add_filter( 'pxl_support_e_control_list', 'apexus_support_e_control_list' );
function apexus_support_e_control_list() {
	return false;
}
 
 
add_filter( 'redux_pxl_iconpicker_field/get_icons', 'apexus_add_icons_to_pxl_iconpicker_field' );
function apexus_add_icons_to_pxl_iconpicker_field($icons){
	$custom_icons = []; //'Flaticon' => array(array('flaticon-marker' => 'flaticon-marker')),
	$icons = array_merge($custom_icons, $icons);
	return $icons;
}


add_filter("pxl_mega_menu/get_icons", "apexus_add_icons_to_megamenu");
function apexus_add_icons_to_megamenu($icons){
	$custom_icons = []; //'Flaticon' => array(array('flaticon-marker' => 'flaticon-marker')),
	$icons = array_merge($custom_icons, $icons);
	return $icons;
}
 

/**
 * Move comment field to bottom
 */
add_filter( 'comment_form_fields', 'apexus_comment_field_to_bottom' );
function apexus_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

/** 
 * Custom Widget Archive 
 * This code filters the Archive widget to include the post count inside the link 
 * @since 1.0.0
*/
if(!function_exists('apexus_get_archives_link_text')){
    add_filter('get_archives_link', 'apexus_get_archives_link_text', 10, 6);
    function apexus_get_archives_link_text($link_html, $url, $text, $format, $before, $after ){
        $text = wptexturize( $text );
        $url  = esc_url( $url );
     
        if ( 'link' == $format ) {
            $link_html = "\t<link rel='archives' title='" . esc_attr( $text ) . "' href='$url' />\n";
        } elseif ( 'option' == $format ) {
            $link_html = "\t<option value='$url'>$before $text $after</option>\n";
        } elseif ( 'html' == $format ) {
            $link_html = "\t<li>$before<a href='$url'><span class='title'>$text</span></a>$after</li>\n";
        } else { // custom
            $link_html = "\t$before<a href='$url'><span class='title'>$text</span>$after</a>\n";
        }
        return $link_html;
    }
}

if(!function_exists('apexus_archive_count_span')){
    add_filter('get_archives_link', 'apexus_archive_count_span');
    function apexus_archive_count_span($links) {
        $links = str_replace('<li>', '<li class="pxl-list-item pxl-archive-item">', $links);
        $links = str_replace('</a>&nbsp;(', ' <span class="count">', $links);
        $links = str_replace(')</li>', '</span></a></li>', $links);
        return $links;
    }
}

function apexus_add_sub_menu_toggle( $output, $item, $depth, $args ) {
	 
	if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
		$output .= '<span class="main-menu-toggle"></span>';
	}
	return $output;
}
add_filter( 'walker_nav_menu_start_el', 'apexus_add_sub_menu_toggle', 10, 4 ); 

/* ------Disable Lazy loading---- */
add_filter( 'wp_lazy_loading_enabled', '__return_false' );

//demo data
add_filter( 'pxl_export_wp_settings', 'apexus_export_wp_settings' );
function apexus_export_wp_settings($wp_options){
	$wp_options[] = 'mc4wp_default_form_id';
	$wp_options[] = 'users_can_register';
	$wp_options[] = 'elementor_experiment-container';
	return $wp_options;
}

// add custom font to redux
add_filter( 'redux/'.apexus()->get_option_name().'/field/typography/custom_fonts', 'apexus_add_redux_option_typo_custom_font', 10, 1 ); 
function apexus_add_redux_option_typo_custom_font($fonts){
	$custom_fonts = array(
		'Custom Fonts' => [
			'Outfit' => 'Outfit',
			'Figtree' => 'Figtree',
			'Clash Grotesk' => 'Clash Grotesk'
		],
	);
	return array_merge( $fonts, $custom_fonts );
 
}

// add custom font to elementor
add_filter( 'elementor/fonts/groups', 'apexus_update_elementor_font_groups_control' );
function apexus_update_elementor_font_groups_control($font_groups){
	$pxlfonts_group = array( 'pxlfonts' => esc_html__( 'Custom Fonts', 'apexus' ) );
	return array_merge( $pxlfonts_group, $font_groups );
}

add_filter( 'elementor/fonts/additional_fonts', 'apexus_update_elementor_font_control' );
function apexus_update_elementor_font_control($additional_fonts){
	$additional_fonts['Figtree'] = 'pxlfonts';
	$additional_fonts['Outfit'] = 'pxlfonts';
	$additional_fonts['Clash Grotesk'] = 'pxlfonts';
	return $additional_fonts;
}

add_filter( 'pxl_megamenu_content_render', 'apexus_update_megamenu_html', 10, 3 );
function apexus_update_megamenu_html($html, $post_id, $content){
	$mega_menu_max_width = get_post_meta( $post_id, 'mega_menu_max_width', true );
	if( !empty($mega_menu_max_width) && (int)$mega_menu_max_width > 0){
		$html = '<div class="sub-menu pxl-mega-menu" style="--megamenu-max-width:'.(int)$mega_menu_max_width.'px;"><div class="pxl-mega-menu-elementor">';
		$html .= $content;
		$html .= '</div></div>';
	}
	return $html;
}

function apexus_add_image_attachment_fields_to_edit( $form_fields, $post ) {
	
	$form_fields["custom_tags"] = array(
		"label" => esc_html__("Custom Tags",'apexus'),
		"input" => "text",  
		"value" => esc_attr( get_post_meta($post->ID, "custom_tags", true) ),
	);
	  
	return $form_fields;
}
add_filter("attachment_fields_to_edit", "apexus_add_image_attachment_fields_to_edit", null, 2);

function apexus_add_image_attachment_fields_to_save( $post, $attachment ) {
	if ( isset( $attachment['custom_tags'] ) )
		update_post_meta( $post['ID'], 'custom_tags', esc_attr($attachment['custom_tags']) );
	 
	return $post;
}
add_filter("attachment_fields_to_save", "apexus_add_image_attachment_fields_to_save", null , 2);
