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

$slides_gutter    = ( isset($gutter) && $gutter !== '') ? $gutter : 0;
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
    'loop'                 => false,
    'pause_on_hover'       => $pause_on_hover != '' ? (bool)$pause_on_hover : false,
    'autoplay'             => $autoplay != '' ? (bool)$autoplay : false,
    'pause_on_interaction' => true,
    'delay'                => $autoplay_speed,
    'speed'                => $speed,
    'dots_style'           => $widget->get_setting('dots_style', 'bullets'),
    'set_timeout'          => true,
];
 
$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);

 
$preloader = $widget->get_setting('preloader', '');
$bg_image       = isset($settings['bg_image']) ? $settings['bg_image'] : [];
$thumbnail = '';
if(!empty($bg_image['id'])) {
    $img = pxl_get_image_by_size( array(
        'attach_id'  => $bg_image['id'],
        'thumb_size' => 'full',
        'class' => 'no-lazyload',
    ));
    $thumbnail = $img['url'];
}

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
        <div class="pxl-swiper-slider-wrap pxl-carousel-inner overflow-hidden" style="background-image: url('<?php echo esc_url($thumbnail); ?>');">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper swiper-wrapper">
                    <?php
                    foreach ($boxs as $key => $box):
                    $_id = isset($box['_id']) ? $box['_id'] : '';
                    $content_key = 'item-content-' . $key;
                    $active_section = 0;
                    $widget->add_render_attribute($content_key, [
                        'id' => $_id,
                        'class' => ['item-des'],
                    ]);
                    $is_active = false;
                    if($key + 1 === $active_section){
                        $is_active = true;
                        $widget->add_render_attribute($content_key, 'style', 'display:block;');
                    }

                    ?>
                    <div class="pxl-swiper-slide swiper-slide">
                        <div class="item-inner elementor-repeater-item-<?php echo esc_attr($box['_id']); ?>" data-target="#<?php echo esc_attr($_id); ?>">
                            <div class="box-content">
                                <div class="box-title">
                                    <?php
                                        if (!empty($box['sub_title'])){
                                            ?>
                                            <div class="item-subtitle">
                                                <?php echo pxl_print_html($box['sub_title']); ?>
                                            </div>
                                            <?php
                                        }
                                        if (!empty($box['title_text'])){
                                            ?>
                                            <h5 class="item-title">
                                                <?php echo pxl_print_html($box['title_text']); ?>
                                            </h5>
                                            <?php
                                        }
                                    ?>
                                </div>
                                <?php if (!empty($box['description_text'])) : ?>
                                    <div <?php pxl_print_html($widget->get_render_attribute_string( $content_key )); ?>>
                                        <?php echo pxl_print_html($box['description_text']); ?>
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
