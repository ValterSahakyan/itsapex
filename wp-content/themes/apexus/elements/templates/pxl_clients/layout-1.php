<?php
$default_settings = [
    'clients' => [],
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$arrows  = $widget->get_setting('arrows', 'false');   
$dots = $widget->get_setting('dots','false');

$show_arrow = ($arrows == 'true' || (isset($settings['arrows_laptop']) && $settings['arrows_laptop'] == 'true') || (isset($settings['arrows_tablet_extra']) && $settings['arrows_tablet_extra'] == 'true') || $settings['arrows_tablet'] == 'true' || (isset($settings['arrows_mobile_extra']) && $settings['arrows_mobile_extra'] == 'true') || $settings['arrows_mobile'] == 'true') ? true : false;
$show_dots = ($dots == 'true' || (isset($settings['dots_laptop']) && $settings['dots_laptop'] == 'true') || (isset($settings['dots_tablet_extra']) && $settings['dots_tablet_extra'] == 'true') || $settings['dots_tablet'] == 'true' || (isset($settings['dots_mobile_extra']) && $settings['dots_mobile_extra'] == 'true') || $settings['dots_mobile'] == 'true') ? true : false;

$column    = $widget->get_setting('column_number', 7);
$column_xl = $widget->get_setting('column_number_laptop', $column);
$column_lg = $widget->get_setting('column_number_tablet_extra', $column_xl);
$column_md = $widget->get_setting('column_number_tablet', $column_lg);
$column_sm = $widget->get_setting('column_number_mobile_extra', $column_md);
$column_xs = $widget->get_setting('column_number_mobile', $column_sm); 

$slides_gutter    = ( isset($gutter) && $gutter !== '') ? $gutter : 12;
$slides_gutter_xl = ( isset($gutter_laptop) && $gutter_laptop !== '') ? $gutter_laptop : $slides_gutter;
$slides_gutter_lg = ( isset($gutter_tablet_extra) && $gutter_tablet_extra !== '') ? $gutter_tablet_extra : $slides_gutter_xl;
$slides_gutter_md = ( isset($gutter_tablet) && $gutter_tablet !== '') ? $gutter_tablet : $slides_gutter_lg;
$slides_gutter_sm = ( isset($gutter_mobile_extra) && $gutter_mobile_extra !== '') ? $gutter_mobile_extra : $slides_gutter_md;
$slides_gutter_xs = ( isset($gutter_mobile) && $gutter_mobile !== '') ? $gutter_mobile : $slides_gutter_sm;

$opts = [
    'slide_direction'      => 'horizontal',
    'slide_percolumn'      => 1, 
    'slide_mode'           => 'slide', 
    'slides_to_show_xxl'   => $column, 
    'slides_to_show'       => $column_xl, 
    'slides_to_show_lg'    => $column_lg, 
    'slides_to_show_md'    => $column_md, 
    'slides_to_show_sm'    => $column_sm, 
    'slides_to_show_xs'    => $column_xs, 
    'slides_to_scroll'     => $slides_to_scroll, 
    'slides_gutter'        => $slides_gutter,
    'slides_gutter_xl'     => $slides_gutter_xl,
    'slides_gutter_lg'     => $slides_gutter_lg,
    'slides_gutter_md'     => $slides_gutter_md,
    'slides_gutter_sm'     => $slides_gutter_sm,
    'slides_gutter_xs'     => $slides_gutter_xs,
    'center_slide'         => $center_slide != '' ? (bool)$center_slide : false,
    'loop'                 => $infinite != '' ? (bool)$infinite : false,
    'pause_on_hover'       => $pause_on_hover != '' ? (bool)$pause_on_hover : false,
    'autoplay'             => $autoplay != '' ? (bool)$autoplay : false,
    'pause_on_interaction' => true,
    'delay'                => $autoplay_speed,
    'speed'                => $speed,
    'dots_style'           => 'bullets',
    'set_timeout'          => true
];
  

$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
?>

<?php if(isset($clients) && !empty($clients) && count($clients)): ?>
    <div class="pxl-swiper-slider pxl-clients layout-<?php echo esc_attr($settings['layout'])?>">
        <div class="pxl-swiper-slider-wrap pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper swiper-wrapper align-items-center">
                    <?php foreach ($clients as $key => $value):
                        $client_img       = isset($value['client_img']) ? $value['client_img'] : [];
                        $image_link       = isset($value['image_link']) ? $value['image_link'] : [];

                        $thumbnail1 = '';
                        if(!empty($client_img['id'])) {
                            $img = pxl_get_image_by_size( array(
                                'attach_id'  => $client_img['id'],
                                'thumb_size' => 'full',
                                'class' => 'no-lazyload',
                            ));
                            $thumbnail1 = $img['thumbnail'];
                        }  

                        $link_key = $widget->get_repeater_setting_key( 'image_link', 'clients', $key ); 
                        if ( ! empty( $image_link['url'] ) ) {
                            $widget->add_render_attribute( $link_key, 'href', $image_link['url'] );

                            if ( $image_link['is_external'] ) {
                                $widget->add_render_attribute( $link_key, 'target', '_blank' );
                            }

                            if ( $image_link['nofollow'] ) {
                                $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                            }

                            if( ! empty($image_link['custom_attributes'])){
                                $custom_attributes = explode('|', $image_link['custom_attributes']);
                                foreach ($custom_attributes as $atts_value) {
                                    $_custom_attributes = explode(':', $atts_value);
                                    $widget->add_render_attribute( $link_key, $_custom_attributes[0], $_custom_attributes[1] );
                                }

                            }
                        }
                        $link_attributes = $widget->get_render_attribute_string( $link_key );
 
                        ?>
                        <div class="pxl-swiper-slide swiper-slide">
                            <div class="item-inner relative">
                                <?php if(!empty($thumbnail1)) : ?>
                                    <div class="item-image">
                                        <?php if ( ! empty( $image_link['url'] ) ) echo '<a '. $link_attributes .'>';
                                            echo wp_kses_post($thumbnail1);  
                                        if ( ! empty( $image_link['url'] ) ) echo '</a>';
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php if($show_arrow): 
                $arrows_position_cls = $widget->get_setting('arrows_position', 'nav-in-vertical');
                ?>
                <div class="pxl-swiper-arrows <?php echo esc_attr($arrows_position_cls) ?> ">
                    <div class="pxl-swiper-arrow pxl-swiper-arrow-prev">
                        <?php 
                        if( !empty($arrow_prev_icon['value'] )){
                            echo '<span class="pxl-icon">';
                            \Elementor\Icons_Manager::render_icon( $arrow_prev_icon, [ 'aria-hidden' => 'true' ], 'span' );
                            echo '</span>';
                        }else{
                            echo '<span class="pxl-icon pxli-angle-left2"></span>';
                        }
                        ?> 
                    </div>
                    <div class="pxl-swiper-arrow pxl-swiper-arrow-next">
                        <?php 
                        if( !empty($arrow_next_icon['value'] )){
                            echo '<span class="pxl-icon">';
                            \Elementor\Icons_Manager::render_icon( $arrow_next_icon, [ 'aria-hidden' => 'true' ], 'span' );
                            echo '</span>';
                        }else{
                            echo '<span class="pxl-icon pxli-angle-right2"></span>';
                        }
                        ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($show_dots): ?>
                <div class="pxl-swiper-dots style-<?php echo esc_attr($widget->get_setting('dots_style', 'bullets')) ?>"></div>
            <?php endif; ?>  
        </div>
    </div>
<?php endif; ?>
  