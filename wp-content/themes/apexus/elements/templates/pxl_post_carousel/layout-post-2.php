<?php
extract($settings);

$tax = ['category'];
$select_post_by = $widget->get_setting('select_post_by', 'term_selected');
$source = $post_ids = $post_ids_unselected = [];

if($select_post_by === 'post_selected'){
    $post_ids = $widget->get_setting('source_'.$settings['post_type'].'_post_ids', '');
}else{
    $source  = $widget->get_setting('source_'.$settings['post_type'], '');
    $post_ids_unselected  = $widget->get_setting('source_'.$settings['post_type'].'_post_ids_unselected', '');
}

$orderby = $widget->get_setting('orderby', 'date');
$order = $widget->get_setting('order', 'desc');
$limit = $widget->get_setting('limit', -1);

$settings['layout'] = $settings['layout_'.$settings['post_type']];
 
extract(pxl_get_posts_of_grid(
    'post', 
    ['source' => $source, 'orderby' => $orderby, 'order' => $order, 'limit' => $limit, 'post_ids' => $post_ids, 'post_not_in' => $post_ids_unselected], 
    $tax
));

$arrows  = $widget->get_setting('arrows', 'false');   
$dots = $widget->get_setting('dots','false');
$show_arrow = ($arrows == 'true' || (isset($settings['arrows_laptop']) && $settings['arrows_laptop'] == 'true') || (isset($settings['arrows_tablet_extra']) && $settings['arrows_tablet_extra'] == 'true') || $settings['arrows_tablet'] == 'true' || (isset($settings['arrows_mobile_extra']) && $settings['arrows_mobile_extra'] == 'true') || $settings['arrows_mobile'] == 'true') ? true : false;
$show_dots = ($dots == 'true' || (isset($settings['dots_laptop']) && $settings['dots_laptop'] == 'true') || (isset($settings['dots_tablet_extra']) && $settings['dots_tablet_extra'] == 'true') || $settings['dots_tablet'] == 'true' || (isset($settings['dots_mobile_extra']) && $settings['dots_mobile_extra'] == 'true') || $settings['dots_mobile'] == 'true') ? true : false;

$column    = $widget->get_setting('column_number', 2);
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
    'dots_style'           => 'bullets',
    'set_timeout'          => true
];


$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);

$img_size = !empty( $img_size ) ? $img_size : '636x415';
$num_words = !empty( $num_words ) ? (int)$num_words : 6;
$preloader = $widget->get_setting('preloader', '');
?>

<?php if(!empty($posts) && count($posts)): ?>
<div class="pxl-swiper-slider pxl-post-carousel layout-<?php echo esc_attr($layout) ?> relative center-mode-<?php echo esc_attr($opts['center_slide']);?>">
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
                    foreach ($posts as $post):
                        $thumbnail = '';
                        if (has_post_thumbnail($post->ID)){
                            $img = pxl_get_image_by_size( array(
                                'post_id'  => $post->ID ,
                                'thumb_size' => $img_size,
                                'class' => 'no-lazyload',
                            ));
                            $thumbnail = $img['thumbnail'];
                        }
                    ?>
                    <div class="pxl-swiper-slide swiper-slide">
                        <div class="item-inner-wrap relative">
                            <?php if (isset( $thumbnail )): ?>
                                <div class="item-featured scale-hover-x">
                                    <?php echo wp_kses_post($thumbnail); ?>
                                </div>
                            <?php endif; ?>
                            <div class="item-inner relative">
                                <?php if( $show_date): ?>
                                <div class="item-date">
                                    <div class="month-year">
                                        <span class="date"><?php echo get_the_date('d', $post->ID); ?></span>
                                        <span class="year"><?php echo get_the_date('F Y', $post->ID); ?></span>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="box-content">
                                    <h4 class="item-title">
                                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a>
                                    </h4>
                                    <?php if($show_excerpt) : ?>
                                    <div class="item-excerpt">
                                        <?php
                                        if(!empty($post->post_excerpt)){
                                            echo wp_trim_words( $post->post_excerpt, $num_words, null );
                                        } else{
                                            $content = strip_shortcodes( $post->post_content );
                                            $content = apply_filters( 'the_content', $content );
                                            $content = str_replace(']]>', ']]&gt;', $content);
                                            echo wp_trim_words( $content, $num_words, null );
                                        }
                                        ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
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