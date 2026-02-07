<?php
extract($settings);

$arrows  = $widget->get_setting('arrows', 'false');   
$dots = $widget->get_setting('dots','false');
$show_arrow = ($arrows == 'true' || (isset($settings['arrows_laptop']) && $settings['arrows_laptop'] == 'true') || (isset($settings['arrows_tablet_extra']) && $settings['arrows_tablet_extra'] == 'true') || $settings['arrows_tablet'] == 'true' || (isset($settings['arrows_mobile_extra']) && $settings['arrows_mobile_extra'] == 'true') || $settings['arrows_mobile'] == 'true') ? true : false;
$show_dots = ($dots == 'true' || (isset($settings['dots_laptop']) && $settings['dots_laptop'] == 'true') || (isset($settings['dots_tablet_extra']) && $settings['dots_tablet_extra'] == 'true') || $settings['dots_tablet'] == 'true' || (isset($settings['dots_mobile_extra']) && $settings['dots_mobile_extra'] == 'true') || $settings['dots_mobile'] == 'true') ? true : false;

$column    = $widget->get_setting('column_number', 1);
$column_xl = $widget->get_setting('column_number_laptop', $column);
$column_lg = $widget->get_setting('column_number_tablet_extra', $column_xl);
$column_md = $widget->get_setting('column_number_tablet', $column_lg);
$column_sm = $widget->get_setting('column_number_mobile_extra', $column_md);
$column_xs = $widget->get_setting('column_number_mobile', $column_sm); 

$slides_gutter    = ( isset($gutter) && $gutter !== '') ? $gutter : 15;
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
    'class'         => 'pxl-swiper-container overflow-hidden',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);

 
$preloader = $widget->get_setting('preloader', '');
$quote_icon_type = $widget->get_setting('quote_icon_type', 'text');
?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list) > 0): ?>
    <div class="pxl-swiper-slider pxl-testimonial-carousel layout-<?php echo esc_attr($settings['layout'])?>">
        <?php if( !empty($preloader)): ?>
            <div class="pxl-swiper-loader">
                <div class="pxl-swiper-loader-inner <?php echo esc_attr($preloader)?>">
                    <?php if( $preloader == 'five-dots'): ?>
                        <span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <?php
            $thumb_opts = [
                'allow_touch_move'              => false,
                'slide_direction'               => 'horizontal',
                'slide_percolumn'               => 1,
                'slide_mode'                    => 'fade', 
                'slides_to_show_xxl'            => 1,
                'slides_to_show'                => 1, 
                'slides_to_show_lg'             => 1, 
                'slides_to_show_md'             => 1, 
                'slides_to_show_sm'             => 1, 
                'slides_to_show_xs'             => 1, 
                'slides_to_scroll'              => 1, 
                'slides_gutter'                 => 15,
                'arrow'                         => false,
                'dots'                          => false,
                'speed'                         => 500,
                'loop'                          => true,
            ];
            $data_thumb_settings = wp_json_encode($thumb_opts);
            ?>
            <div class="pxl-swiper-slider-thumbs col-5">
                <div class="pxl-swiper-slider-inner pxl-carousel-inner">
                    <div class="pxl-swiper-thumbs overflow-hidden" data-settings="<?php echo esc_attr($data_thumb_settings) ?>">
                        <div class="pxl-thumbs-wrapper swiper-wrapper">
                            <?php
                            $idx = 0;
                            foreach ($content_list as $key => $value):
                                $idx++;
                                $image       = isset($value['image']) ? $value['image'] : [];
                                $logo_image       = isset($value['logo_image']) ? $value['logo_image'] : [];
                                $name        = isset($value['name']) ? $value['name'] : '';
                                $position        = isset($value['position']) ? $value['position'] : '';
                                $thumbnail = '';
                                if( !empty($image['id']) ) {
                                    $img = pxl_get_image_by_size( array(
                                        'attach_id'  => $image['id'],
                                        'thumb_size' => '65x65',
                                        'class' => 'no-lazyload',
                                    ));
                                    $thumbnail = $img['thumbnail'];
                                }  
                                $thumbnail_logo = '';
                                if( !empty($logo_image['id']) ) {
                                    $img_2 = pxl_get_image_by_size( array(
                                        'attach_id'  => $logo_image['id'],
                                        'thumb_size' => 'full',
                                        'class' => 'no-lazyload',
                                    ));
                                    $thumbnail_logo = $img_2['thumbnail'];
                                }  
                                ?>
                                <div class="pxl-swiper-slide thumb-item swiper-slide">
                                    <?php if (!empty($thumbnail_logo)): ?>
                                        <div class="item-image">
                                            <?php pxl_print_html($thumbnail_logo); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="thumbs-wrap">
                                        <?php if(!empty($thumbnail)): ?>
                                            <div class="thumbs-image">
                                                <?php pxl_print_html($thumbnail); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="thumbs-content">
                                            <h5 class="thumbs-name"><?php pxl_print_html($name); ?></h5>
                                            <span class="thumbs-position"><?php pxl_print_html($position); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pxl-swiper-slider-wrap pxl-carousel-inner col-7">
                <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                    <div class="pxl-swiper-wrapper swiper-wrapper">
                        <?php foreach ($content_list as $key => $value):
                        $description       = isset($value['description']) ? $value['description'] : '';
                        $button_text       = isset($value['button_text']) ? $value['button_text'] : '';
                        $link_key = $widget->get_repeater_setting_key( 'link_button', 'content_list', $key );
                        if ( ! empty( $value['link_button']['url'] ) ) {
                            $widget->add_render_attribute( $link_key, 'href', $value['link_button']['url'] );

                            if ( $value['link_button']['is_external'] ) {
                                $widget->add_render_attribute( $link_key, 'target', '_blank' );
                            }

                            if ( $value['link_button']['nofollow'] ) {
                                $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                            }
                        }
                        ?>
                        <div class="pxl-swiper-slide swiper-slide">
                            <div class="item-inner relative">
                                <?php if (!empty($value['rating']) && $value['rating'] != 'none') : ?>
                                    <div class="item-rating-star">
                                        <div class="item-rating <?php echo esc_attr($value['rating']); ?>">
                                            <i class="pxli pxli-rating"></i>
                                            <i class="pxli pxli-rating"></i>
                                            <i class="pxli pxli-rating"></i>
                                            <i class="pxli pxli-rating"></i>
                                            <i class="pxli pxli-rating"></i>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="item-description"><?php pxl_print_html($description); ?></div> 
                                <a class="pxl-btn btn-primary" <?php pxl_print_html($widget->get_render_attribute_string( $link_key )); ?>>
                                    <?php if ( ! empty( $value['link_button']['url'] ) ) ?>
                                    <span class="pxl-button-text"><?php pxl_print_html($button_text); ?></span>
                                    <?php if ( ! empty( $value['link_button']['url'] ) ) ?>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
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
