<?php
if (!class_exists('Apexus_Page_Title')) {
    class Apexus_Page_Title
    {
        public function get_page_title(){
            $pt_mode = apexus()->get_opt('pt_mode');
             
            $ptitle_layout = (int)apexus()->get_opt('ptitle_layout'); 

            if( $pt_mode == 'none' ) return;

            $pt_bg_parallax = apexus()->get_theme_opt('pt_bg_parallax');
            $data_parallax = $pll_cls = $pll_style = '';
            if( (isset($pt_bg_parallax) && $pt_bg_parallax) ){
                $data_parallax = json_encode([
                    apexus()->get_theme_opt('pt_parallax') => apexus()->get_theme_opt('pt_parallax_value')
                ]);
                $pll_cls = 'has-parallax overflow-hidden';
            }

            $titles = $this->get_title();
            $breadcrumb = new Apexus_Breadcrumb();
            $entries = $breadcrumb->get_entries();

            $page_for_posts = (int)get_option('page_for_posts', '0'); 
            $blog_custom_archive_page_id = (int)apexus()->get_theme_opt('blog_custom_archive_link','0');
            $post_remove_breadcrumb_category = apexus()->get_theme_opt('post_remove_breadcrumb_category', 'no');
                        
            if( is_singular('post') && $post_remove_breadcrumb_category == 'yes'){
                unset($entries[(count($entries) - 2)]);
            }
 
            $brc_divider = '<span class="br-divider">/</span>';
            if ($pt_mode == 'bd' && $ptitle_layout > 0 && class_exists('Pxltheme_Core') && is_callable( 'Elementor\Plugin::instance' )) {
                ?>
                <div id="pxl-pagetitle" class="pxl-pagetitle  layout-el relative <?php echo esc_attr($pll_cls) ?>">
                    <div class="pxl-page-title-bg pxl-absoluted" data-parallax='<?php echo esc_attr($data_parallax);?>'></div>
                    <div class="pxl-page-title-overlay"></div>
                    <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $ptitle_layout);?>
                </div>
                <?php 
            } else {
                ?>
                <div id="pxl-pagetitle" class="pxl-pagetitle layout-df relative <?php echo esc_attr($pll_cls) ?>">
                    <div class="pxl-page-title-bg pxl-absoluted" data-parallax='<?php echo esc_attr($data_parallax);?>'></div>
                    <div class="pxl-page-title-overlay"></div>
                    <div class="container relative">
                        <div class="pxl-page-title-inner row align-content-center justify-content-center">
                            <div class="pxl-page-title col-12">
                                <h1 class="main-title"><?php echo apexus_html($titles['title']) ?></h1>
                            </div>
                            <?php if(!empty($titles['sub_title'])): ?>
                                <div class="sub-title p"><?php echo apexus_html($titles['sub_title']) ?></div>
                            <?php endif; ?>
                            <?php if ( !empty( $entries )): ?>
                                <div class="pxl-breadcrumb d-flex justify-content-center">
                                    <div class="breadcrumb-inner">
                                        <?php 
                                            foreach ( $entries as $entry ){
                                                $entry = wp_parse_args( $entry, array(
                                                    'label' => '',
                                                    'url'   => ''
                                                ) );

                                                if( $blog_custom_archive_page_id > 0 && $page_for_posts > 0){
                                                    $page_for_posts_obj = get_post($page_for_posts);
                                                    $page_for_posts_slug = $page_for_posts_obj->post_name;
                                                    if( strpos($entry['url'], $page_for_posts_slug) !== false){
                                                        $blog_custom_archive_page_obj = get_post($blog_custom_archive_page_id);

                                                        $entry['label'] = $blog_custom_archive_page_obj->post_title;
                                                        $entry['url'] = get_permalink($blog_custom_archive_page_id);
                                                    }
                                                }

                                                if ( empty( $entry['label'] ) ){
                                                    continue;
                                                }

                                                echo '<div class="br-item">';
                                                if ( ! empty( $entry['url'] ) ){
                                                    printf(
                                                        '<a class="br-link" href="%1$s">%2$s</a>%3$s',
                                                        esc_url( $entry['url'] ),
                                                        esc_attr( $entry['label'] ),
                                                        $brc_divider
                                                    );           
                                                }else{
                                                    printf( '<span class="br-text" >%s</span>%2$s', $entry['label'], $brc_divider );
                                                }
                                                echo '</div>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php 
            } 
        } 
        
        public function get_title() {
            $title = $sub_title = '';      
            // Default titles
            if ( ! is_archive() ) {
                // Posts page view
                $custom_title  = apexus()->get_page_opt('custom_title','');
                $sub_title = apexus()->get_page_opt('custom_sub_title','');

                $title_career = apexus()->get_theme_opt('custom_career_title','');
                $sub_title_career = apexus()->get_theme_opt('custom_career_subtitle','');

                $title_portfolio = apexus()->get_theme_opt('custom_portfolio_title','');
                $sub_title_portfolio = apexus()->get_theme_opt('custom_portfolio_subtitle','');

                $title_services = apexus()->get_theme_opt('custom_services_title','');
                $sub_title_services = apexus()->get_theme_opt('custom_services_subtitle','');
 
                if ( is_home() ) {
                    // Only available if posts page is set.
                    if ( ! is_front_page() && $page_for_posts = get_option( 'page_for_posts' ) ) {
                        $title = get_post_meta( $page_for_posts, 'custom_title', true );
                        if ( empty( $title ) ) {
                            $title = get_the_title( $page_for_posts );
                        }
                    }
                    if ( is_front_page() ) {
                        $title = esc_html__( 'Blog', 'apexus' );
                        $sub_title = apexus()->get_theme_opt('archive_custom_sub_title','');
                    }
                    
                } // Single page view
                elseif ( is_page() ) {
                    $title = get_post_meta( get_the_ID(), 'custom_title', true );
                    if ( ! $title ) {
                        $title = get_the_title();
                    }
                } elseif ( is_404() ) {
                    $title = esc_html__( '404', 'apexus' );
                } elseif ( is_search() ) {
                    $title = esc_html__( 'Search results', 'apexus' );
                } else {
                    $title = get_the_title();
                    $title = get_post_meta( get_the_ID(), 'custom_title', true );
                    if ( ! $title ) {
                        $title = get_the_title();
                    } else {
                        $title = $title;
                    }
                     
                }
                
            } elseif ( is_author() ) {  
                $title     = get_the_author();
                $sub_title = apexus()->get_theme_opt('archive_custom_sub_title','');
            } else {
                $custom_title = apexus()->get_opt('custom_title','');
                
                $title = get_the_archive_title();
                 
                $title = !empty($custom_title) ? $custom_title : $title; 
                 
                if ( get_post_type() === 'post' )
                    $sub_title = apexus()->get_theme_opt('archive_custom_sub_title','');

            }

            return array(
                'title' => $title,
                'sub_title' => $sub_title,
            );
        }


    }
     
}
 
