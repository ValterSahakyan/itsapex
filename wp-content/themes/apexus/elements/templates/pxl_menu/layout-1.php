<?php
$html_id = pxl_get_element_id($settings);  
$show_arrow_cls = ($settings['show_arrow'] === 'yes') ? 'is-arrow' : ''; 
$style_cls  = $widget->get_setting('style','df');
 

$menu_location_desktop_custom = apexus()->get_page_opt('menu_location_desktop','-1');
$menu_location_mobile_custom = apexus()->get_page_opt('menu_location_mobile','-1');


if(!empty($menu_location_desktop_custom) && $menu_location_desktop_custom != '-1') {
    $menu_location = $menu_location_desktop_custom;
}else{
    $menu_location = $settings['menu_location'];
}

if(!empty($menu_location_mobile_custom) && $menu_location_mobile_custom != '-1') {
    $menu_location_mobile = $menu_location_mobile_custom;
}else{
    $menu_location_mobile = $settings['menu_location'];
}
 

$menu_location = ( !empty( $menu_location ) && has_nav_menu( $menu_location ) ) ? $menu_location : 'primary';
$menu_location_mobile = ( !empty( $menu_location_mobile ) && has_nav_menu( $menu_location_mobile ) ) ? $menu_location_mobile : 'primary';

?>
<?php if($settings['type'] == '1'): 
    $link_before_lv0 = '';
    $has_icon_cls = '';
    ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="pxl-nav-menu pxl-nav-menu-main style-<?php echo esc_attr($style_cls) ?> <?php echo esc_attr($show_arrow_cls) ?> <?php echo esc_attr($has_icon_cls) ?>">
    <?php 
        wp_nav_menu( 
            array(
                'theme_location' => $menu_location,
                'menu_id'    => 'pxl-primary-menu-'.$html_id,
                'menu_class' => 'pxl-primary-menu clearfix',
                'link_before'    => '<span class="pxl-menu-title">',
                'link_before_lv0'    => $link_before_lv0,
                'link_after'      => '</span>',
                'walker'         => class_exists( 'PXL_Mega_Menu_Walker' ) ? new PXL_Mega_Menu_Walker : '',
            )
        );
    ?>
    </div>
<?php elseif($settings['type'] == '2'): 
    $style_class  = $widget->get_setting('inner_style','df');
    ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="pxl-nav-menu pxl-nav-menu-inner style-<?php echo esc_attr($style_class) ?>">
        <?php 
            wp_nav_menu( 
                array(
                    'theme_location' => $menu_location,
                    'menu_class'     => 'pxl-nav-inner clearfix',
                    'link_before'    => '<span>',
                    'link_after'     => '</span>',
                    'depth'          => '1',
                    'walker'         => class_exists( 'PXL_Mega_Menu_Walker' ) ? new PXL_Mega_Menu_Walker : '',
                )
            );
            
        ?>
    </div>
<?php elseif($settings['type'] == '4'): 
    ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="pxl-nav-menu pxl-nav-menu-inner">
        <?php 
            wp_nav_menu( 
                array(
                    'theme_location' => $menu_location,
                    'menu_id'    => 'pxl-canvas-menu-'.$html_id,
                    'menu_class' => 'pxl-canvas-menu clearfix',
                    'link_before'    => '<span class="pxl-menu-title">',
                    'link_after'      => '</span>',
                    'walker'         => class_exists( 'PXL_Mega_Menu_Walker' ) ? new PXL_Mega_Menu_Walker : '',
                )
            );
        ?>
    </div>
<?php else: 
    ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="pxl-nav-menu pxl-nav-menu-mobile">
        <?php 
            wp_nav_menu( 
                array(
                    'theme_location' => $menu_location_mobile,
                    'menu_id'     => 'pxl-mobile-menu',
                    'menu_class'  => 'pxl-mobile-menu clearfix',
                    'link_before'    => '<span class="pxl-menu-title">',
                    'link_after'      => '</span>',
                    'walker'         => class_exists( 'PXL_Mega_Menu_Walker' ) ? new PXL_Mega_Menu_Walker : ''
                )
            );
        ?>
    </div>
<?php endif; ?>
