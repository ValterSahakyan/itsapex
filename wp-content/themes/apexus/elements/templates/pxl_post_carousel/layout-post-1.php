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

$column    = $widget->get_setting('column_number', 3);
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
    'slides_to_show_xxl'   => 'auto', 
    'slides_to_show'       => 'auto', 
    'slides_to_show_lg'    => 'auto', 
    'slides_to_show_md'    => 'auto', 
    'slides_to_show_sm'    => 'auto', 
    'slides_to_show_xs'    => 'auto', 
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

$img_size = !empty( $img_size ) ? $img_size : '648x391';
 
$preloader = $widget->get_setting('preloader', '');
$readmore_text = !empty($readmore_text) ? $readmore_text : esc_html__('Continue Reading', 'apexus');
$num_words = !empty( $num_words ) ? (int)$num_words : 36;
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
                    $author_id = get_the_author_meta('ID');
                    $author_gravatar = get_avatar_url($author_id, array('size' => 40));
                    $user = get_userdata(get_the_author_meta('ID'));
                    $display_role = in_array('editor', $user->roles) ? 'Editor' : 'Editor';
                    ?>
                    <div class="pxl-swiper-slide swiper-slide">
                        <div class="item-inner-wrap relative">
                            <div class="item-inner relative">
                                <?php if (isset( $thumbnail )): ?>
                                    <div class="item-featured scale-hover-x">
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    </div>
                                <?php endif; ?>
                                <h4 class="item-title">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a>
                                </h4>
                            </div>
                            <div class="box-meta col-auto">
                                <?php if( $show_author): ?>
                                    <div class="meta-item">
                                        <div class="author-avatar col-auto"><img src="<?php echo esc_url($author_gravatar); ?>" alt="<?php echo get_the_title(); ?>" /></div>
                                        <div class="item-name">
                                            <span class="name"><?php the_author_posts_link(); ?></span>
                                            <span class="role"><?php echo esc_html( $display_role ); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if( $show_date): ?>
                                <div class="item-date">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                        <path d="M9 2.25C5.27783 2.25 2.25 5.27783 2.25 9C2.25 12.7222 5.27783 15.75 9 15.75C12.7222 15.75 15.75 12.7222 15.75 9C15.75 5.27783 12.7222 2.25 9 2.25ZM9 3.375C12.1135 3.375 14.625 5.88647 14.625 9C14.625 12.1135 12.1135 14.625 9 14.625C5.88647 14.625 3.375 12.1135 3.375 9C3.375 5.88647 5.88647 3.375 9 3.375ZM8.4375 4.5V9.5625H12.375V8.4375H9.5625V4.5H8.4375Z"/>
                                    </svg>
                                    <div class="month-year">
                                        <span class="month"><?php echo get_the_date('M', $post->ID); ?></span>
                                        <span class="year"><?php echo get_the_date('Y', $post->ID); ?></span>
                                    </div>
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