<?php

if (!class_exists('Apexus_Footer')) {
     
    class Apexus_Footer
    {
         
        public function getFooter(){

            $footer_layout = (int)apexus()->get_opt('footer_layout');  
            $footer_position = apexus()->get_opt('footer_position', '0');
            
            $footer_temp = $footer_layout <= 0 ? 'df' : 'el';
            $css_classes = [
                'pxl-footer',
                'footer-type-'.$footer_temp,
                'footer-layout-'.$footer_layout
            ];
            if($footer_position == '1') $css_classes[] = 'pxl-footer-fixed';
            if($footer_position == '2') $css_classes[] = 'pxl-footer-absoluted';
              
            $footer_wrap_cls = trim(implode(' ', $css_classes));

            if($footer_layout === -2) return;

            if ($footer_layout <= 0 || !class_exists('Pxltheme_Core') || !is_callable( 'Elementor\Plugin::instance' )) {  
                ?>
                <footer id="pxl-footer" class="<?php echo esc_attr($footer_wrap_cls);?>">
                    <?php do_action('apexus_before_footer'); ?>
                    <div class="pxl-footer-bottom">
                        <div class="container">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-12 col-md-auto text-center">
                                    <div class="pxl-copyright-text pxl-footer-copyright">
                                        <?php 
                                        printf( esc_html__('© %s Apexus by %s, All Rights Reserved.','apexus'), date('Y'), '<a href="'.esc_url('https://themeforest.net/user/7iquid/portfolio').'" target="_blank" rel="nofollow">7iquid</a>');
                                        ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php do_action('apexus_after_footer');  ?>
                </footer>
                <?php 
            } else { 
                ?>
                <footer id="pxl-footer" class="<?php echo esc_attr($footer_wrap_cls);?>">
                    <?php 
                        do_action('apexus_before_footer');
                        echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $footer_layout);
                        do_action('apexus_after_footer'); 
                    ?>
                </footer> 
                <?php  
            } 
        }
 
    }
}
 
 