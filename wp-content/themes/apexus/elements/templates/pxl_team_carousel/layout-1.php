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

$slides_gutter    = ( isset($gutter) && $gutter !== '') ? $gutter : 24;
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
$img_size = !empty( $img_size ) ? $img_size : '286x286';
?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list) > 0): ?>
    <div class="pxl-swiper-slider pxl-team-carousel layout-<?php echo esc_attr($settings['layout'])?>">
        <?php if( !empty($preloader)): ?>
            <div class="pxl-swiper-loader">
                <div class="pxl-swiper-loader-inner <?php echo esc_attr($preloader)?>">
                    <?php if( $preloader == 'five-dots'): ?>
                        <span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="pxl-swiper-slider-wrap pxl-carousel-inner">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper swiper-wrapper">
                    <?php foreach ($content_list as $key => $value):
                    $image       = isset($value['image']) ? $value['image'] : [];
                    $title        = isset($value['title']) ? $value['title'] : '';
                    $position        = isset($value['position']) ? $value['position'] : '';
                    $thumbnail = '';
                    if(!empty($image['id'])) {
                        $img = pxl_get_image_by_size( array(
                            'attach_id'  => $image['id'],
                            'thumb_size' => $img_size,
                            'class' => 'no-lazyload',
                        ));
                        $thumbnail = $img['thumbnail'];
                    }
                    $link_key = $widget->get_repeater_setting_key( 'link_content', 'content_list', $key );
                    if ( ! empty( $value['link_content']['url'] ) ) {
                        $widget->add_render_attribute( $link_key, 'href', $value['link_content']['url'] );

                        if ( $value['link_content']['is_external'] ) {
                            $widget->add_render_attribute( $link_key, 'target', '_blank' );
                        }

                        if ( $value['link_content']['nofollow'] ) {
                            $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                        }
                    }
                    $social = isset($value['social']) ? $value['social'] : '';
                    ?>
                    <div class="pxl-swiper-slide swiper-slide">
                        <div class="item-inner relative">
                            <?php if(!empty($thumbnail)): ?>
                                <div class="item-image">
                                    <?php pxl_print_html($thumbnail); ?>
                                </div>
                            <?php endif; ?>
                            <div class="item-info-wrap align-items-center">
                                <div class="title-position">
                                    <a class="item-title" <?php pxl_print_html($widget->get_render_attribute_string( $link_key )); ?>>
                                        <?php if ( ! empty( $value['link_content']['url'] ) ) ?>
                                        <?php pxl_print_html($title); ?>
                                        <?php if ( ! empty( $value['link_content']['url'] ) ) ?>
                                    </a>
                                    <div class="item-position"><?php pxl_print_html($position); ?></div> 
                                </div>
                                <?php if(!empty($social)): ?>
                                <div class="item-social d-flex">
                                    <?php 
                                    $team_social = json_decode($social, true);
                                    foreach ($team_social as $value): ?>
                                        <a href="<?php echo esc_url($value['url']); ?>" target="_blank">
                                            <i class="pxli <?php echo esc_attr($value['icon']); ?>"></i>
                                        </a>
                                    <?php endforeach;?>
                                </div>
                                <?php endif; ?>
                            </div>
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
