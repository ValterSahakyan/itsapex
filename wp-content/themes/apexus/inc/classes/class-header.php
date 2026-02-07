<?php
if (!class_exists('Apexus_Header')) {
    class Apexus_Header
    {
        public function getHeader()
        {
            $disable_header = apexus()->get_page_opt('disable_header','0');
            if($disable_header == '1') return; 

            $header_layout        = (int)apexus()->get_opt('header_layout');
            $header_mobile_layout = (int)apexus()->get_opt('header_mobile_layout');
            
            $logo_desktop = apexus()->get_theme_opt( 'logo_d', ['url' => get_template_directory_uri().'/assets/images/logo.png', 'id' => '' ] );
            $logo_mobile = apexus()->get_theme_opt( 'logo_m', ['url' => get_template_directory_uri().'/assets/images/logo.png', 'id' => '' ] );
             
            $menu_location_desktop_custom = apexus()->get_page_opt('menu_location_desktop','-1');

            if(!empty($menu_location_desktop_custom) && $menu_location_desktop_custom != '-1') {
                $menu_location = $menu_location_desktop_custom;
            }else{
                $menu_location = 'primary';
            }
 
            $header_type = $header_layout <= 0 ? 'df' : 'el';
            $header_mobile_type = $header_mobile_layout <=0 ? 'df' : 'el';
            $sticky_header_direction = apexus()->get_theme_opt('sticky_header_direction','scroll-down'); 
             
            $classes = [
                'pxl-header',
                'header-type-'.$header_type,
                'header-layout-'.$header_layout,
                'header-mobile-type-'.$header_mobile_type,
                'sticky-direction-'.$sticky_header_direction,
            ];
            ?>
            <header id="pxl-header" class="<?php echo esc_attr(implode(' ', $classes)); ?>">
                <?php if ($header_layout <= 0 || !class_exists('Pxltheme_Core') || !is_callable( 'Elementor\Plugin::instance' )): ?>
                    <div class="pxl-header-desktop d-none d-xl-block">
                        <div class="header-container container">
                            <div class="row align-items-center gx-90">
                                <div class="pxl-header-logo col-auto">
                                    <?php 
                                    printf(
                                        '<a class="logo-default logo-desktop" href="%1$s" title="%2$s" rel="home"><img class="pxl-logo" src="%3$s" alt="%2$s"/></a>',
                                        esc_url( home_url( '/' ) ),
                                        esc_attr( get_bloginfo( 'name' ) ),
                                        esc_url( $logo_desktop['url'] )
                                    );
                                    ?>
                                </div>
                                <div class="pxl-navigation col">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-xl-auto">
                                            <div class="row align-items-center">
                                                <div class="pxl-main-navigation col-12 col-xl-auto">
                                                    <?php 
                                                    if ( has_nav_menu( $menu_location ) ){
                                                        wp_nav_menu( array(
                                                            'theme_location' => $menu_location,
                                                            'container'  => '',
                                                            'menu_id'    => 'pxl-primary-menu',
                                                            'menu_class' => 'pxl-primary-menu clearfix',
                                                            'link_before'     => '<span class="pxl-menu-title">',
                                                            'link_after'      => '</span>',
                                                            'walker'         => class_exists( 'PXL_Mega_Menu_Walker' ) ? new PXL_Mega_Menu_Walker : '',
                                                        ) );
                                                    }else{
                                                        printf(
                                                            '<ul class="pxl-primary-menu primary-menu-not-set"><li><a href="%1$s">%2$s</a></li></ul>',
                                                            esc_url( admin_url( 'nav-menus.php' ) ),
                                                            esc_html__( 'Create New Menu', 'apexus' )
                                                        );
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php if(isset($header_layout) && $header_layout > 0) : ?>
                        <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display($header_layout); ?>         
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($header_mobile_layout <= 0 || !class_exists('Pxltheme_Core') || !is_callable( 'Elementor\Plugin::instance' )): ?>
                    <div class="pxl-header-mobile container d-xl-none">
                        <div class="row justify-content-between align-items-center gx-40">
                            <div class="pxl-header-logo col-auto">
                                <?php 
                                printf(
                                    '<a class="logo-default logo-mobile" href="%1$s" title="%2$s" rel="home"><img class="pxl-logo" src="%3$s" alt="%2$s"/></a>',
                                    esc_url( home_url( '/' ) ),
                                    esc_attr( get_bloginfo( 'name' ) ),
                                    esc_url( $logo_mobile['url'] )
                                );
                                ?>
                            </div>
                            <div class="col col-auto">
                                <div class="row align-items-center justify-content-end">
                                    <div class="header-mobile-nav">
                                        <span class="menu-mobile-toggle-nav open-menu pxl-anchor side-panel" data-target=".pxl-side-mobile" onclick="">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php if(isset($header_mobile_layout) && $header_mobile_layout > 0) : ?>
                        <div class="pxl-header-mobile d-xl-none"> 
                            <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $header_mobile_layout); ?>      
                        </div> 
                    <?php endif; ?>
                <?php endif; ?>
            </header>
            <?php 
        }
    }
}
 
