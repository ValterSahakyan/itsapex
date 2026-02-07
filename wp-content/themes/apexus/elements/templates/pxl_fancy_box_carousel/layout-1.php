<?php
extract($settings);

$arrows  = $widget->get_setting('arrows', 'false');   
$dots = $widget->get_setting('dots','false');
$show_arrow = ($arrows == 'true' || (isset($settings['arrows_laptop']) && $settings['arrows_laptop'] == 'true') || (isset($settings['arrows_tablet_extra']) && $settings['arrows_tablet_extra'] == 'true') || $settings['arrows_tablet'] == 'true' || (isset($settings['arrows_mobile_extra']) && $settings['arrows_mobile_extra'] == 'true') || $settings['arrows_mobile'] == 'true') ? true : false;
$show_dots = ($dots == 'true' || (isset($settings['dots_laptop']) && $settings['dots_laptop'] == 'true') || (isset($settings['dots_tablet_extra']) && $settings['dots_tablet_extra'] == 'true') || $settings['dots_tablet'] == 'true' || (isset($settings['dots_mobile_extra']) && $settings['dots_mobile_extra'] == 'true') || $settings['dots_mobile'] == 'true') ? true : false;

$column    = $widget->get_setting('column_number', 4);
$column_xl = $widget->get_setting('column_number_laptop', $column);
$column_lg = $widget->get_setting('column_number_tablet_extra', $column_xl);
$column_md = $widget->get_setting('column_number_tablet', $column_lg);
$column_sm = $widget->get_setting('column_number_mobile_extra', $column_md);
$column_xs = $widget->get_setting('column_number_mobile', $column_sm); 

$slides_gutter    = ( isset($gutter) && $gutter !== '') ? $gutter : 16;
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
    'dots_style'           => $widget->get_setting('dots_style', 'bullets'),
    'set_timeout'          => true
];
 
$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);

 
$preloader = $widget->get_setting('preloader', '');
$img_size = !empty( $img_size ) ? $img_size : 'full';
?>
<?php if(isset($boxs) && !empty($boxs) && count($boxs) > 0): ?>
    <div class="pxl-swiper-slider pxl-fancy-box-carousel layout-<?php echo esc_attr($settings['layout'])?>">
        <?php if( !empty($preloader)): ?>
            <div class="pxl-swiper-loader">
                <div class="pxl-swiper-loader-inner <?php echo esc_attr($preloader)?>">
                    <?php if( $preloader == 'five-dots'): ?>
                        <span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="pxl-swiper-slider-wrap pxl-carousel-inner overflow-hidden">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper swiper-wrapper">
                    <?php
                    foreach ($boxs as $key => $box): 
                    if(!empty($box['link']['url'])){
                        $widget->add_render_attribute( 'link'.esc_attr($key), 'href', $box['link']['url'] );
                        if ( $box['link']['is_external'] ) {
                            $widget->add_render_attribute( 'link'.esc_attr($key), 'target', '_blank' );
                        }
                        if ( $box['link']['nofollow'] ) {
                            $widget->add_render_attribute( 'link'.esc_attr($key), 'rel', 'nofollow' );
                        }
                        if ( ! empty( $box['link']['custom_attributes'] ) ) {
                            $custom_attributes = Utils::parse_custom_attributes( $box['link']['custom_attributes'] );
                            $widget->add_render_attribute( 'link'.esc_attr($key), $custom_attributes);
                        }
                    }
                    $link_attributes = $widget->get_render_attribute_string( 'link'.esc_attr($key) );
                        ?>
                    <div class="pxl-swiper-slide swiper-slide">
                        <div class="item-inner">
                            <div class="box-content">
                                <div class="box-icon">
                                    <?php if(! empty($box['selected_icon'])): ?>
                                        <span class="item-icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $box['selected_icon'], [ 'aria-hidden' => 'true'] );?>
                                        </span>
                                    <?php endif; ?>
                                    <span class="item-date">
                                        <?php echo pxl_print_html($box['date_time']); ?>
                                    </span>
                                </div>
                                <div class="item-content">
                                    <?php
                                    if (!empty($box['title_text'])){
                                        ?>
                                        <h3 class="item-title">
                                            <?php if ( $link_attributes ) echo '<a '. implode( ' ', [ $link_attributes ] ).'>'; ?>
                                            <?php echo pxl_print_html($box['title_text']); ?>
                                            <?php if ( $link_attributes ) echo '</a>'; ?> 
                                        </h3>
                                        <?php
                                    }
                                    if (!empty($box['description_text'])){
                                        ?>
                                        <div class="item-description">
                                            <?php echo pxl_print_html($box['description_text']); ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                                if (!empty($box['sub_title'])){
                                    ?>
                                    <div class="item-subtitle">
                                        <?php echo pxl_print_html($box['sub_title']); ?>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php if($show_arrow): 
            $arrows_position_cls = $widget->get_setting('arrows_position', 'nav-in-vertical');
            ?>
            <div class="pxl-swiper-arrows <?php echo esc_attr($arrows_position_cls) ?>">
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
<?php endif; ?>
