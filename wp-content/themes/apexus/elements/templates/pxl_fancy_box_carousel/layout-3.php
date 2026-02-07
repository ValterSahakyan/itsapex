<?php
extract($settings);

$arrows  = $widget->get_setting('arrows', 'false');   
$dots = $widget->get_setting('dots','false');
$show_arrow = ($arrows == 'true' || (isset($settings['arrows_laptop']) && $settings['arrows_laptop'] == 'true') || (isset($settings['arrows_tablet_extra']) && $settings['arrows_tablet_extra'] == 'true') || $settings['arrows_tablet'] == 'true' || (isset($settings['arrows_mobile_extra']) && $settings['arrows_mobile_extra'] == 'true') || $settings['arrows_mobile'] == 'true') ? true : false;
$show_dots = ($dots == 'true' || (isset($settings['dots_laptop']) && $settings['dots_laptop'] == 'true') || (isset($settings['dots_tablet_extra']) && $settings['dots_tablet_extra'] == 'true') || $settings['dots_tablet'] == 'true' || (isset($settings['dots_mobile_extra']) && $settings['dots_mobile_extra'] == 'true') || $settings['dots_mobile'] == 'true') ? true : false;

$column    = $widget->get_setting('column_number', 3);
$column_xl = $widget->get_setting('column_number_laptop', $column);
$column_lg = $widget->get_setting('column_number_tablet_extra', $column_xl);
$column_md = $widget->get_setting('column_number_tablet', $column_lg);
$column_sm = $widget->get_setting('column_number_mobile_extra', $column_md);
$column_xs = $widget->get_setting('column_number_mobile', $column_sm); 

$slides_gutter    = ( isset($gutter) && $gutter !== '') ? $gutter : 130;
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
    'set_timeout'          => true
];
 
$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);

 
$preloader = $widget->get_setting('preloader', '');
$img_size = !empty( $img_size ) ? $img_size : '550x363';
$drag = $widget->get_setting('setting_drag','false'); 
$button_text_drag = !empty($button_text_drag) ? $button_text_drag : esc_html__('Drag', 'apexus');
?>
<?php if(isset($boxs_2) && !empty($boxs_2) && count($boxs_2) > 0): ?>
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
        <?php if ($drag !== 'false') :
            ?>
            <a id="circle-cursor" class="circle-cursor">
                <span><?php echo esc_html($button_text_drag); ?></span>
            </a>
            <?php
        endif; ?>
        <div class="pxl-swiper-slider-wrap pxl-carousel-inner add-custom-cursor">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper swiper-wrapper">
                    <?php $number = 1;
                    foreach ($boxs_2 as $key => $box): 
                    $image_2       = isset($box['image_2']) ? $box['image_2'] : [];
                    $thumbnail = '';
                    if(!empty($image_2['id'])) {
                        $img = pxl_get_image_by_size( array(
                            'attach_id'  => $image_2['id'],
                            'thumb_size' => $img_size,
                            'class' => 'no-lazyload',
                        ));
                        $thumbnail = $img['thumbnail'];
                    }
                    if(!empty($box['link_2']['url'])){
                        $widget->add_render_attribute( 'link_2'.esc_attr($key), 'href', $box['link_2']['url'] );
                        if ( $box['link_2']['is_external'] ) {
                            $widget->add_render_attribute( 'link_2'.esc_attr($key), 'target', '_blank' );
                        }
                        if ( $box['link_2']['nofollow'] ) {
                            $widget->add_render_attribute( 'link_2'.esc_attr($key), 'rel', 'nofollow' );
                        }
                        if ( ! empty( $box['link_2']['custom_attributes'] ) ) {
                            $custom_attributes = Utils::parse_custom_attributes( $box['link_2']['custom_attributes'] );
                            $widget->add_render_attribute( 'link_2'.esc_attr($key), $custom_attributes);
                        }
                    }
                    $link_attributes = $widget->get_render_attribute_string( 'link_2'.esc_attr($key) );
                    
                    $_id = isset($box['_id']) ? $box['_id'] : '';
                    $content_key = 'item-content-' . $key;
                    $active_section = 0;
                    $widget->add_render_attribute($content_key, [
                        'id' => $_id,
                        'class' => ['box-content'],
                    ]);
                    $is_active = false;
                    if($key + 1 === $active_section){
                        $is_active = true;
                        $widget->add_render_attribute($content_key, 'style', 'display:flex;');
                    }
                        ?>
                    <div class="pxl-swiper-slide swiper-slide">
                        <div class="item-inner" data-target="#<?php echo esc_attr($_id); ?>">
                            <div class="box-image">
                                <?php if(!empty($thumbnail)): ?>
                                    <div class="item-image">
                                        <?php pxl_print_html($thumbnail); ?>
                                        <svg class="chevron-largeright1" width="293" height="363" viewBox="0 0 293 363" xmlns="http://www.w3.org/2000/svg">
                                            <defs>
                                                <linearGradient id="shimmer" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" style="stop-color:rgba(255,255,255,0);stop-opacity:1" />
                                                <stop offset="50%" style="stop-color:rgba(255,255,255,0.5);stop-opacity:1" />
                                                <stop offset="100%" style="stop-color:rgba(255,255,255,0);stop-opacity:1" />
                                                </linearGradient>
                                                
                                                <clipPath id="arrow-clip">
                                                <path d="M133.393 9.7171L284.643 161.752C295.509 172.675 295.509 190.325 284.643 201.248L133.393 353.283C127.205 359.503 118.794 363 110.02 363H5.50558C0.616974 363 -1.8378 357.095 1.61002 353.63L153.204 201.248C164.071 190.325 164.071 172.675 153.204 161.752L1.61002 9.37038C-1.83777 5.90466 0.617004 0 5.50562 0H110.02C118.794 0 127.205 3.49709 133.393 9.7171Z"/>
                                                </clipPath>
                                            </defs>

                                            <path data-figma-bg-blur-radius="4" d="M133.393 9.7171L284.643 161.752C295.509 172.675 295.509 190.325 284.643 201.248L133.393 353.283C127.205 359.503 118.794 363 110.02 363H5.50558C0.616974 363 -1.8378 357.095 1.61002 353.63L153.204 201.248C164.071 190.325 164.071 172.675 153.204 161.752L1.61002 9.37038C-1.83777 5.90466 0.617004 0 5.50562 0H110.02C118.794 0 127.205 3.49709 133.393 9.7171Z" fill-opacity="0.12"/>

                                            <g clip-path="url(#arrow-clip)">
                                                <rect x="-100%" y="0" width="500" height="100" fill="url(#shimmer)" class="shimmer-path" />
                                            </g>
                                        </svg>
                                        <svg class="chevron-largeright2" width="293" height="363" viewBox="0 0 293 363" xmlns="http://www.w3.org/2000/svg">
                                            <defs>
                                                <linearGradient id="shimmer" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" style="stop-color:rgba(255,255,255,0);stop-opacity:1" />
                                                <stop offset="50%" style="stop-color:rgba(255,255,255,0.5);stop-opacity:1" />
                                                <stop offset="100%" style="stop-color:rgba(255,255,255,0);stop-opacity:1" />
                                                </linearGradient>
                                                
                                                <clipPath id="arrow-clip">
                                                <path d="M133.393 9.7171L284.643 161.752C295.509 172.675 295.509 190.325 284.643 201.248L133.393 353.283C127.205 359.503 118.794 363 110.02 363H5.50558C0.616974 363 -1.8378 357.095 1.61002 353.63L153.204 201.248C164.071 190.325 164.071 172.675 153.204 161.752L1.61002 9.37038C-1.83777 5.90466 0.617004 0 5.50562 0H110.02C118.794 0 127.205 3.49709 133.393 9.7171Z"/>
                                                </clipPath>
                                            </defs>

                                            <path data-figma-bg-blur-radius="4" d="M133.393 9.7171L284.643 161.752C295.509 172.675 295.509 190.325 284.643 201.248L133.393 353.283C127.205 359.503 118.794 363 110.02 363H5.50558C0.616974 363 -1.8378 357.095 1.61002 353.63L153.204 201.248C164.071 190.325 164.071 172.675 153.204 161.752L1.61002 9.37038C-1.83777 5.90466 0.617004 0 5.50562 0H110.02C118.794 0 127.205 3.49709 133.393 9.7171Z" fill-opacity="0.12"/>

                                            <g clip-path="url(#arrow-clip)">
                                                <rect x="-100%" y="0" width="500" height="100" fill="url(#shimmer)" class="shimmer-path" />
                                            </g>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <?php
                                    if (!empty($box['sub_title_2'])){
                                        ?>
                                        <div class="item-subtitle">
                                            <?php echo pxl_print_html($box['sub_title_2']); ?>
                                        </div>
                                        <?php
                                    }
                                ?>
                                <span class="item-number"><?php echo esc_html(sprintf('%02d', $number)); ?></span>
                                <div class="box-icon">
                                    <svg class="overlay-clippath" width="112" height="53" viewBox="0 0 112 53" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.1367 31C16.2223 44.3463 11.6665 48.728 0.136719 52.0001H111.137C100.569 50.2054 96.0683 45.3446 90.1367 31L83.6367 15.0001C79.6619 6.56646 75.107 1.13967 65.1367 0.500051L44.6367 0.5C34.6367 1 30.9656 4.52025 25.6367 15L20.1367 31Z" stroke="current-Color"/>
                                    </svg>
                                    <span class="item-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div <?php pxl_print_html($widget->get_render_attribute_string( $content_key )); ?>>
                                <div class="item-content">
                                    <?php
                                    if (!empty($box['title_1']) || !empty($box['title_2'])) {
                                    ?>
                                        <h3 class="item-title">
                                            <?php if ( $link_attributes ) echo '<a '. implode( ' ', [ $link_attributes ] ).'>'; ?>
                                            <span class="title-1"><?php if (!empty($box['title_1'])) echo pxl_print_html($box['title_1']); ?></span>
                                            <span class="title-2"><?php if (!empty($box['title_2'])) echo pxl_print_html($box['title_2']); ?></span>
                                            <?php if ( $link_attributes ) echo '</a>'; ?> 
                                        </h3>
                                    <?php
                                    }

                                    if (!empty($box['button_text'])){
                                        ?>
                                        <div class="item-button">
                                            <?php if ( $link_attributes ) echo '<a class="pxl-btn btn-primary" '. implode( ' ', [ $link_attributes ] ).'>'; ?>
                                                <span class="pxl-button-text"><?php echo pxl_print_html($box['button_text']); ?></span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                                <path d="M10.0833 10.0833L14.6667 5.5M14.6667 5.5L19.25 10.0833M14.6667 5.5V12.6528C14.6667 13.6776 14.6667 14.1902 14.467 14.582C14.2913 14.9269 14.0103 15.2079 13.6653 15.3837C13.2735 15.5833 12.7609 15.5833 11.7362 15.5833H2.75" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            <?php if ( $link_attributes ) echo '</a>'; ?> 
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $number++; endforeach; ?>
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
