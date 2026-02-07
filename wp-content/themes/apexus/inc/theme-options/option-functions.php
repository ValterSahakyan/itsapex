<?php 
/**
 * Get Post List 
*/
if(!function_exists('apexus_list_post')){
    function apexus_list_post($post_type = 'post', $default = false, $exclude_post = 0){
        $post_list = array();
        $posts = get_posts(array('post_type' => $post_type, 'orderby' => 'date', 'order' => 'ASC', 'posts_per_page' => '-1'));
        if($default){
        	$post_list[-1] = esc_html__( 'Inherit', 'apexus' );
        }
        foreach($posts as $post){
            $post_list[$post->ID] = $post->post_title;
        }
        
        if( (int)$exclude_post > 0 ){
        	unset($post_list[(int)$exclude_post]);
        }

        return $post_list;
    }
}
 
if(!function_exists('apexus_get_templates_option')){
	function apexus_get_templates_option($meta_value = 'df', $default = false){
        $post_list = array();
        if($default && !is_array($default)){
            $post_list[-1] = esc_html__('Inherit','apexus');
        }
        if(is_array($default)){
        	$key = isset($default['key']) ? $default['key'] : '0';
        	$post_list[$key] = !empty($default['value']) ? $default['value'] : esc_html__('None','apexus');
        }
        if( is_array($meta_value)){
        	$args = array(
	            'post_type' => 'pxl-template',
	            'posts_per_page' => '-1',
	            'orderby' => 'date',
	            'order' => 'ASC',
	            'meta_query' => array(
	                array(
	                    'key'       => 'template_type',
	                    'value'     => $meta_value,
	                    'compare'   => 'IN'
	                )
	            )
	        );
        }else{
	        $args = array(
	            'post_type' => 'pxl-template',
	            'posts_per_page' => '-1',
	            'orderby' => 'date',
	            'order' => 'ASC',
	            'meta_query' => array(
	                array(
	                    'key'       => 'template_type',
	                    'value'     => $meta_value,
	                    'compare'   => '='
	                )
	            )
	        );
	    }

        $posts = get_posts($args);
        
        foreach($posts as $post){  
        	$template_type = get_post_meta( $post->ID, 'template_type', true );
        	if($template_type == 'df') continue;
            $post_list[$post->ID] = $post->post_title;
        }
         
        return $post_list;
    }
}
if(!function_exists('apexus_get_templates_option_slug')){
    function apexus_get_templates_option_slug($meta_value = 'df'){
        $post_list = array();
        $args = array(
            'post_type' => 'pxl-template',
            'posts_per_page' => '-1',
            'orderby' => 'date',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key'       => 'template_type',
                    'value'     => $meta_value,
                    'compare'   => '='
                )
            )
        );

        $posts = get_posts($args);
        
        foreach($posts as $post){  
        	$template_type = get_post_meta( $post->ID, 'template_type', true );
        	if($template_type == 'df') continue;
        	$keys = [$post->post_name, $post->ID];
        	$key = implode('||', $keys);
            $post_list[$key] = $post->post_title;
        }
        return $post_list;
    }
}

if(!function_exists('apexus_get_slider_option')){
    function apexus_get_slider_option(){
        $post_list = array();
         
        $args = array(
            'post_type' => 'pxl-slider',
            'posts_per_page' => '-1',
            'orderby' => 'date',
            'order' => 'ASC',
        );

        $posts = get_posts($args);
        
        foreach($posts as $post){  
            $post_list[$post->ID] = $post->post_title;
        }
         
        return $post_list;
    }
}

if(!function_exists('apexus_get_templates_slug')){
    function apexus_get_templates_slug($meta_value = 'df'){
        $post_list = array();
        $posts = get_posts(
        	array(
        		'post_type' => 'pxl-template', 
        		'orderby' => 'date', 
        		'order' => 'ASC', 
        		'posts_per_page' => '-1',
        		'meta_query' => array(
	                array(
	                    'key'       => 'template_type',
	                    'value'     => $meta_value,
	                    'compare'   => '='
	                )
	            )
        	)
        );
         
        foreach($posts as $post){
        	$template_type = get_post_meta( $post->ID, 'template_type', true );
        	$template_position = get_post_meta( $post->ID, 'template_position', true );
        	$pos = !empty($template_position) ? $template_position : '';
        	$template_custom_style = get_post_meta( $post->ID, 'template_custom_style', true );
        	$custom_style = !empty($template_custom_style) ? $template_custom_style : '';
        	if($template_type == 'df') continue;
        	$value_args = [
				'post_id'      => $post->ID, 
				'title'        => $post->post_title,
				'slug'         => $post->post_name,
				'position'     => $pos,
				'custom_style' => $custom_style
        	];
            $post_list[$post->post_name] = $value_args;
        }
        return $post_list;
    }
}



if(!function_exists('apexus_header_opts')){
	function apexus_header_opts($args=[]){
		$args = wp_parse_args($args,[
			'default'         => false,
			'default_value'   => ''
		]);
		
		if($args['default']){  
			$options = [
				'-1' => esc_html__('Default','apexus'),
                '1'  => esc_html__('Yes','apexus'),
                '0'  => esc_html__('No','apexus'),
			];
			$default_value = '-1';
		} else {
			 
			$options = [
				'1'  => esc_html__('Yes','apexus'),
                '0'  => esc_html__('No','apexus'),
			];
			$default_value = '0';
		} 
		$opts = array(
	        array(
				'id'      => 'header_layout',
				'type'    => 'select',
				'title'   => esc_html__('Header Layout', 'apexus'),
				'desc'    => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','apexus'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
				'options' => apexus_get_templates_option('header',$args['default']),
				'default' => $args['default_value']  
	        ),
	        array(
	            'id'       => 'header_mobile_layout',
	            'type'     => 'select',
	            'title'    => esc_html__('Header Mobile Layout', 'apexus'),
	            'desc'    => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','apexus'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
	            'options'  => apexus_get_templates_option('header-mobile',$args['default']),
	            'default'  => $args['default_value'],
	        ), 
	        
	    );
	    if(!$args['default']){ 
	    	$opts[] = array(
	            'id'       => 'logo_d',
	            'type'     => 'media',
	            'title'    => esc_html__('Logo', 'apexus'),
	            'default' => array(
	                'url'=>''
	            ),
	            'required' => array( 'header_layout' , '=', '' )
	        ); 
	        $opts[] = array(
	            'id'       => 'logo_size',
	            'type'     => 'dimensions',
	            'title'    => esc_html__('Logo Size', 'apexus'),
	            'subtitle' => esc_html__('Enter demensions for your logo', 'apexus'),
	            'height'    => false,
	            'unit'     => 'px',
	            'required' => array( 'header_layout' , '=', '' )
	        ); 
	    	$opts[] = array(
	            'id'       => 'logo_m',
	            'type'     => 'media',
	            'title'    => esc_html__('Logo Mobile', 'apexus'),
	            'default' => array(
	                'url'=>''
	            ),
	            'required' => array( 'header_mobile_layout' , '=', '' )
	        );
	        $opts[] = array(
	            'id'       => 'logo_mobile_size',
	            'type'     => 'dimensions',
	            'title'    => esc_html__('Logo Mobile Size', 'apexus'),
	            'subtitle' => esc_html__('Enter demensions for your logo mobile', 'apexus'),
	            'height'    => false,
	            'unit'     => 'px',
	            'required' => array( 'header_mobile_layout' , '=', '' )
	        ); 
	    }
 
		return $opts;
	}
}
 
if(!function_exists('apexus_page_title_opts')){
	function apexus_page_title_opts($args=[]){
		$args = wp_parse_args($args,[
			'default'         => false,
			'default_value'   => '',
			'output_prefix'   => ''
		]);
		if($args['default']){
			$options = [
				'-1' => esc_html__('Default','apexus'),
                '1'  => esc_html__('Yes','apexus'),
                '0'  => esc_html__('No','apexus'),
			];
			$default_value = '-1';
			
		} else {
			$options = [
				'1'  => esc_html__('Yes','apexus'),
                '0'  => esc_html__('No','apexus'),
			];
			$default_value = '0';
		} 
		
		if($args['default']){
			$pt_mode_options = [
				'-1'  => esc_html__('Inherit', 'apexus'),
	            'bd'   => esc_html__('Builder', 'apexus'),
	            'none'  => esc_html__('Disable', 'apexus')
			];
			$pt_mode_default = '-1';
		}else{
			$pt_mode_options = [
				'df'  => esc_html__('Default', 'apexus'),
	            'bd'   => esc_html__('Builder', 'apexus'),
	            'none'  => esc_html__('Disable', 'apexus')
			];
			$pt_mode_default = 'df';
		}

		$opts = array(
		 	array(
                'id'       => 'pt_mode',
                'type'     => 'button_set',
                'title'    => esc_html__('Select Page title Mode', 'apexus'),
                'options' => $pt_mode_options, 
                'default' => $pt_mode_default
            ),
			array(
	            'id'       => 'ptitle_layout',
	            'type'     => 'select',
	            'title'    => esc_html__('Page Title Layout (not empty)', 'apexus'),
	            'subtitle' => esc_html__('Select a layout for page title.', 'apexus'),
	            'options'  => apexus_get_templates_option('page-title',false),
	            'default'  => $args['default_value'],
	            'required' => array( 'pt_mode', '=', 'bd' )
	        ),
	        array(
				'id'       => 'ptitle_bg',
				'type'     => 'background',
				'title'    => esc_html__('Background', 'apexus'),
				'subtitle' => esc_html__('Page title background.', 'apexus'),
				'output'   => array($args['output_prefix'].' .pxl-pagetitle .pxl-page-title-bg'),
				'required' => array( 'pt_mode', '!=', 'none' )
	        ),
	        array(
				'id'       => 'ptitle_overlay_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__('Overlay Background Color', 'apexus'),
				'output'   => array('background-color' => $args['output_prefix'].' .pxl-pagetitle .pxl-page-title-overlay'),
				'required' => array( 'pt_mode', '!=', 'none' )
	        ),
		);
		if($args['default']){
			$custom_opts = [
				[
                    'id'           => 'custom_title',
                    'type'         => 'text',
                    'title'        => esc_html__( 'Custom Title', 'apexus' ),
                    'subtitle'     => esc_html__( 'Custom heading text title', 'apexus' ),
                    'required' => array( 'pt_mode', '!=', 'none' )
                ],
                [
                    'id'           => 'custom_sub_title',
                    'type'         => 'textarea',
                    'title'        => esc_html__( 'Custom Sub title', 'apexus' ),
                    'subtitle'     => esc_html__( 'Add short description for page title', 'apexus' ),
                    'required' => array( 'pt_mode', '!=', 'none' )
                ]
			];
			$opts = array_merge($opts,$custom_opts);
		}


		return $opts;
	}
	
}
 
if(!function_exists('apexus_footer_opts')){
	function apexus_footer_opts($args=[]){
		$args = wp_parse_args($args,[
			'default'         => false,
			'default_value'   => ''
		]);
		if($args['default']){
			$options = [
				'-1' => esc_html__('Inherit','apexus'),
                '1'  => esc_html__('Yes','apexus'),
                '0'  => esc_html__('No','apexus'),
			];
			$options_type = [
				'-1' => esc_html__('Inherit','apexus'),
                '1'  => esc_html__('Fixed','apexus'),
                '2'  => esc_html__('Absoluted','apexus'),
                '0'  => esc_html__('Nothing','apexus'),
			];
			$default_value = '-1';
		} else {
			$options = [
				'1'  => esc_html__('Yes','apexus'),
                '0'  => esc_html__('No','apexus'),
			];
			$options_type = [
                '1'  => esc_html__('Fixed','apexus'),
                '2'  => esc_html__('Absoluted','apexus'),
                '0'  => esc_html__('Nothing','apexus'),
			];
			$default_value = '0';
		} 
		
		$footer_layout_opts = apexus_get_templates_option('footer', $args['default']);
		if($args['default'])
			$footer_layout_opts[-2] = esc_html__( 'Disable', 'apexus' );
		$opts = array(
	        array(
	            'id'          => 'footer_layout',
	            'type'        => 'select',
	            'title'       => esc_html__('Footer Layout', 'apexus'),
	            'desc'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','apexus'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
	            'options'     => $footer_layout_opts,
	            'default'     => $args['default_value'],
	        ),
	        array(
                'title'    => esc_html__('Footer Position', 'apexus'),
                'subtitle' => esc_html__('Make footer fixed or absoluted at bottom?', 'apexus'),
                'id'       => 'footer_position',
                'type'     => 'button_set',
                'options'  => $options_type,
                'default'  => $default_value,
            ),
            array(
                'id'       => 'back_totop_on',
                'type'     => 'button_set',
                'title'    => esc_html__('Enable Back to Top', 'apexus'),
                'options'  => $options,
                'default'  => $default_value,
			),
			array(
                'id'          => 'back_totop_on_style',
                'type'        => 'select',
                'title'       => esc_html__('Back To Top Style', 'apexus'),
                'options'  => array(
                    'default' => esc_html__('Default', 'apexus'),
                    'custom-style-1'  => esc_html__('Style 1', 'apexus'),	
                ),
                'default'     => 'default',
                'required' => array( 'back_totop_on', 'equals', '1' ),
                'force_output' => true
            ),
	    );
 
		return $opts;
	}
}
if(!function_exists('apexus_sidebar_pos_opts')){
	function apexus_sidebar_pos_opts($args=[]){
		$args = wp_parse_args($args,[
			'prefix'        => 'blog_',
			'default'       => false,
			'default_value' => '0'
		]);

		if($args['default']){
			$options = [
				'-1'    => esc_html__('Inherit','apexus'),
				'left'  => esc_html__('Left','apexus'),
				'right' => esc_html__('Right','apexus'),
				'0'     => esc_html__('Disabled','apexus'),
			];
			 
		} else {
			$options = [
				'left'  => esc_html__('Left','apexus'),
				'right' => esc_html__('Right','apexus'),
				'0'     => esc_html__('Disabled','apexus'),
			]; 
		}  
		$opts = array(
	        array(
	            'id'       => $args['prefix'].'sidebar_pos',
	            'type'     => 'button_set',
	            'title'    => esc_html__('Sidebar Position', 'apexus'),
	            'subtitle' => esc_html__('Select a sidebar position is displayed.', 'apexus'),
	            'options'  => $options,
	            'default'  => $args['default_value'],
	        ),
	    );
 
		return $opts;
	}
}


/* Get list menu */
function apexus_get_nav_menu_locations(){

    $menus_locations = array(
        '-1' => esc_html__('Inherit', 'apexus')
    );

    $locations = get_registered_nav_menus();

    foreach ($locations as $location => $location_name){
    	if( has_nav_menu( $location ) ){
	        $menus_locations[$location] = $location_name;
	    }
    }
    return $menus_locations;
}
function apexus_get_nav_menu_slug(){

    $menus = array(
        '-1' => esc_html__('Inherit', 'apexus')
    );

    $obj_menus = wp_get_nav_menus();

    foreach ($obj_menus as $obj_menu){
        $menus[$obj_menu->slug] = $obj_menu->name;
    }
    return $menus;
}
/* Get list user */
function apexus_get_user_list(){

	$users = get_users();
    $list = array(
    	'-1' => esc_html__('None', 'apexus')
    );
    
    foreach ($users as $user) {
       $list[$user->ID] = $user->display_name; 
    }

    return $list;
}

function apexus_product_single_opts_wishlist_compare(){
	$arr = [];
	if(class_exists('WPCleverWoosw'))
		$arr[] = array(
            'id'       => 'product_wishlist',
            'title'    => esc_html__('Show Wishlist', 'apexus'),
            'type'     => 'switch',
            'default'  => '1',
        );
	if(class_exists('WPCleverWoosc'))
		$arr[] = array(
            'id'       => 'product_compare',
            'title'    => esc_html__('Show compare', 'apexus'),
            'type'     => 'switch',
            'default'  => '1',
        );
	return $arr;
}