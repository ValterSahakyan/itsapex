<?php
extract($settings);
$widget->add_render_attribute( 'fancybox-wrap', 'class', ['pxl-fancybox-wrap d-flex', 'layout-'.$settings['layout']]);

// Icon
$widget->add_render_attribute( 'icon', 'class', 'pxl-fancy-icon relative');

// Heading
$widget->add_render_attribute( 'heading', 'class', 'title');
 
// desc
$widget->add_render_attribute( 'desc', 'class', 'desc');

// desc
$widget->add_render_attribute( 'button', 'class', 'button-more circle-cursor');

if(!empty($settings['hyper_link']['url'])){
    $widget->add_render_attribute( 'custom_link', 'href', $settings['hyper_link']['url'] );

    if ( $settings['hyper_link']['is_external'] ) {
        $widget->add_render_attribute( 'custom_link', 'target', '_blank' );
    }

    if ( $settings['hyper_link']['nofollow'] ) {
        $widget->add_render_attribute( 'custom_link', 'rel', 'nofollow' );
    }
}

$link_attributes = $widget->get_render_attribute_string( 'custom_link' );

$img_size = !empty( $img_size ) ? $img_size : '636x636';
$image       = isset($settings['image']) ? $settings['image'] : [];
$thumbnail = '';
if(!empty($image['id'])) {
    $img = pxl_get_image_by_size( array(
        'attach_id'  => $image['id'],
        'thumb_size' => $img_size,
        'class' => 'no-lazyload',
    ));
    $thumbnail = $img['thumbnail'];
}
?>
 
<div <?php pxl_print_html($widget->get_render_attribute_string('fancybox-wrap'));?>>
    <div class="fancybox-inner w-100 relative">
        <div class="pxl-fancybox-content">
            <div class="box-image">
                <?php if(!empty($thumbnail)): ?>
                    <div class="item-image scale-hover-x">
                        <?php if ( $link_attributes ) echo '<a class="add-custom-cursor" '. $link_attributes .'>'; ?>
                        <?php pxl_print_html($thumbnail); ?>
                        <?php if ( $link_attributes ) echo '</a>'; ?> 
                    </div>
                <?php endif; ?>
                <?php if(!empty($widget->get_setting('button_text'))): ?>
                    <div id="circle-cursor" <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?>>
                        <?php pxl_print_html( nl2br($widget->get_setting('button_text'))); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="item-content">
                <?php if (!empty($boxs) && is_array($boxs)): ?>
                    <div class="item-category d-flex">
                        <?php foreach ($boxs as $box): ?>
                            <?php if (!empty($box['category'])): ?>
                                <span class="category">
                                    <?php echo esc_html($box['category']); ?>
                                </span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if(!empty($widget->get_setting('title'))): ?>
                <h4 <?php pxl_print_html($widget->get_render_attribute_string( 'heading' )); ?>>
                    <?php if ( $link_attributes ) echo '<a '. $link_attributes .'>'; ?>
                    <?php pxl_print_html( nl2br($widget->get_setting('title'))); ?>
                    <?php if ( $link_attributes ) echo '</a>'; ?> 
                </h4>
                <?php endif; ?>
                <?php if(!empty($widget->get_setting('desc'))): ?>
                <div <?php pxl_print_html($widget->get_render_attribute_string( 'desc' )); ?>>
                    <?php pxl_print_html( nl2br($widget->get_setting('desc'))); ?>
                </div>
                <?php endif; ?>
            </div>
        </div> 
    </div>  
</div>
 



