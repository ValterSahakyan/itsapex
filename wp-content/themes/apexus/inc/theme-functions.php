<?php
/**
 * Helper functions for the theme
 *
 * @package Apexus
 */
  

function apexus_html($html){
    return $html;
}

function apexus_get_menu_location(){
    $menu_locations = ['primary' => esc_html__( 'Primary', 'apexus' ), 'secondary' => esc_html__( 'Secondary', 'apexus' )]; 
    $add_menu_location = apexus()->get_theme_opt('add_menu_location',[]);
    if( !empty( $add_menu_location)){
        foreach($add_menu_location as $location){
            if( !empty($location) ){
                $menu_locations[sanitize_title($location)] = ucfirst($location);
            }
        }
    }
    return $menu_locations;

} 
/**
 * Google Fonts
*/
function apexus_fonts_url() {
    $fonts_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';
    
    if ( 'off' !== _x( 'on', 'Outfit font: on or off', 'apexus' ) ) {
        $fonts[] = 'Outfit:wght@100..900';
    }
    if ( 'off' !== _x( 'on', 'Figtree font: on or off', 'apexus' ) ) {
        $fonts[] = 'Figtree:ital,wght@0,300..900;1,300..900';
    }

    if ( $fonts ) {
        $fonts_url = add_query_arg( array(
            'family' => implode( '&family=', $fonts ),
            'subset' => urlencode( $subsets ),
        ), '//fonts.googleapis.com/css2' );
    }
    return $fonts_url;
}
 

function apexus_svgs_icon($args = []){
    global $wp_filesystem;
    $args = wp_parse_args($args, [
        'icon'   => 'core/arrow-next',
        'class'  => '',
        'before' => '',
        'after'  => '',
        'tag'    => 'span',
        'echo'   => true
    ]);
     
    ob_start();
        printf('%s', $args['before']);
        if(!empty($args['tag'])) printf('%s', '<'.$args['tag'].' class="pxl-svg-icon pxl-icon rtl-flip lh-0 '.$args['class'].'">');
        printf('%s',$wp_filesystem->get_contents( get_template_directory() . '/assets/svgs/'.$args['icon'].'.svg' ));
        if(!empty($args['tag'])) printf('%s', '</'.$args['tag'].'>');
        printf('%s', $args['after']);
    if($args['echo']){
        echo ob_get_clean();
    } else {
        return ob_get_clean();
    }
} 

/*
 * Get page ID by Slug
*/
function apexus_get_id_by_slug($slug, $post_type){
    $content = get_page_by_path($slug, OBJECT, $post_type);
    $id = $content->ID;
    return $id;
}
 
/**
 * get content by slug
 **/
function apexus_get_content_by_slug($slug, $post_type){
    $contents = get_posts(
        array(
            'name'      => $slug,
            'post_type' => $post_type
        )
    );
    if(!empty($contents)){
        $content = $contents[0]->post_content;
    }
 
    echo apply_filters('the_content',  $content);
}
 

function apexus_get_mega_menu_builder_id(){
    $mn_id = [];
    $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
    if ( is_array( $menus ) && ! empty( $menus ) ) {
        foreach ( $menus as $menu ) {
            if ( is_object( $menu )){
                $menu_obj = get_term( $menu->term_id, 'nav_menu' );
                $menu = wp_get_nav_menu_object( $menu_obj ) ;
                $menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'update_post_term_cache' => false ) );
                foreach ($menu_items as $menu_item) {
                    if( !empty($menu_item->pxl_megaprofile)){
                        if(!in_array((int)$menu_item->pxl_megaprofile, $mn_id))
                            $mn_id[] = (int)$menu_item->pxl_megaprofile;
                    }
                }  
            }
        }
    }
    return $mn_id;
}

function apexus_get_page_active_filters_url( $filters = array(), $link = '' ) {
    if ( empty( $link ) ) {
        $link = get_permalink();
    }

    if ( empty( $filters ) ) {
        $filters = $_GET;
    }
 
    if ( isset( $filters['max_price'] ) ) {
        $link = add_query_arg( 'max_price', wp_unslash( $filters['max_price'] ), $link );
    }
  
    if ( get_search_query() ) {
        $link = add_query_arg( 's', rawurlencode( wp_specialchars_decode( get_search_query() ) ), $link );
    }
    
    if ( ! empty( $filters['date_checkin'] ) ) {
        $link = add_query_arg( 'date_checkin', wp_unslash( $filters['date_checkin'] ) , $link );
    }
    if ( ! empty( $filters['date_checkout'] ) ) {
        $link = add_query_arg( 'date_checkout', wp_unslash( $filters['date_checkout'] ) , $link );
    }
    if ( ! empty( $filters['adults_number'] ) ) {
        $link = add_query_arg( 'adults_number', wp_unslash( $filters['adults_number'] ) , $link );
    }
    if ( ! empty( $filters['children_number'] ) ) {
        $link = add_query_arg( 'children_number', wp_unslash( $filters['children_number'] ) , $link );
    }
 
    return $link;
}
 

function apexus_hex_rgb($color) {
 
    $default = '0,0,0';
 
    //Return default if no color provided
    if(empty($color))
        return $default; 
 
    //Sanitize $color if "#" is provided 
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    $output = implode(",",$rgb);

    //Return rgb(a) color string
    return $output;
}
 
 
  
function apexus_hook_anchor_custom(){
    return;
}


function apexus_search_popup_normal(){
    ?>
    <div class="pxl-search-popup pxl-search-popup-normal pxl-modal-html pxl-transition">
        <a href="#" class="pxl-modal-close pxl-transition" title="<?php echo esc_attr__( 'Close', 'apexus' ) ?>"></a>
        <div class="pxl-search-popup-inner pxl-modal-inner container">
            <form method="get" class="search-form pxl-search-form-popup" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <div class="text-search-wrap">
                    <input type="search" class="search-field" placeholder="<?php echo esc_attr__( 'Search Here...','apexus'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                    <button type="submit" class="search-submit" value=""><span class="kngi-search-400"></span></button>
                </div>
            </form>
        </div>
    </div>
    <?php
}


 
if(function_exists( 'pxl_register_shortcode' )) {
    function greenola_image_highlight_shortcode( $atts = array() ) {
        extract(shortcode_atts(array(
           'id_image' => '',
       ), $atts));

        ob_start();
        if(!empty($id_image)) : 
            $img  = pxl_get_image_by_size( array(
                'attach_id'  => $id_image,
                'thumb_size' => 'full',
            ) );
            $thumbnail    = $img['thumbnail']; ?>
            <span class="pxl-image--highlight bg-image" >
                <?php echo wp_kses_post($thumbnail); ?>
            </span>
        <?php  endif;
        $output = ob_get_clean();

        return $output;
    }
    pxl_register_shortcode('highlight_image', 'greenola_image_highlight_shortcode');
}