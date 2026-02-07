<?php

$widget->add_render_attribute( 'fancybox-wrap', 'class', ['pxl-fancybox-wrap d-flex', 'layout-'.$settings['layout']]);

// Icon
$widget->add_render_attribute( 'icon', 'class', 'pxl-fancy-icon relative');

// Heading
$widget->add_render_attribute( 'heading', 'class', 'title');
 
// desc
$widget->add_render_attribute( 'desc', 'class', 'desc');

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
?>
 
<div <?php pxl_print_html($widget->get_render_attribute_string('fancybox-wrap'));?>>
    <div class="fancybox-inner w-100 relative">
        <div class="pxl-fancybox-content mouse-move-fancy">
            <?php if(! empty($settings['selected_icon'])): ?>
                <span class="item-icon">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true'] );?>
                </span>
            <?php endif; ?>
            <div class="item-content">
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
 



