<?php 
    extract($settings);
    $image_size = [ 636, 386];

    $image_height = $image_size[1].'px';

    $widget->add_render_attribute( 'widget', [

        'class'         => 'pxl-process-accordion-widget layout-1',
        'style' => '--image-height: '.esc_attr( $image_height)
    ]);

?>
<div <?php $widget->print_render_attribute_string( 'widget') ?>>
    <div class="widget-wrap swiper-wrapper">
        <?php foreach ( $settings['process_list'] as $index => $item ) :  

            if( $index == '0'){

                $class = 'process-item swiper-slide is-active';

            }else{

                $class = 'process-item swiper-slide';

            }
            $featured_image = isset($item['featured_image']) ? $item['featured_image'] : [];
            $thumbnail = '';

            if (!empty($featured_image['id'])) {
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $featured_image['id'],
                    'thumb_size' => $image_size,
                    'class'      => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            }
            ?>
            <div class="<?php echo esc_attr( $class) ?>">
                <?php if(!empty($thumbnail)): ?>
                    <div class="featured-image">
                        <?php pxl_print_html($thumbnail); ?>
                    </div>
                <?php endif; ?>
                <div class="process-item-inner">   
                    <div class="process-info">
                        <?php if (!empty($item['selected_icon']['value'])) { ?>
                            <div class="icon-wrapper">
                                <?php \Elementor\Icons_Manager::render_icon($item['selected_icon'], ['aria-hidden' => 'true', 'class' => 'item-icon pxl-icon'], 'i'); ?>
                            </div>
                        <?php } ?>
                        <div class="process-count"><?php echo sprintf( '%02d', $index+1) ?></div>
                    </div>  
                    <div class="process-name"><?php echo esc_html( $item['title']); ?></div>
                    <div class="item-name">
                        <div class="process-name-active"><?php echo esc_html( $item['title']); ?></div>  
                        <div class="pxl-divider"></div>  
                    </div>               
                </div>            
            </div>
        <?php endforeach; ?>
    </div>
</div>