<?php 
    extract($settings);
    $video_atts = $embed_options = [];
    if ( !empty($video_link['url']) ){
        
        $lightbox_id = isset($_id) ? $_id : $element_id;
        $classes = ['pxl-video-lightbox'];
        $classes[] = isset($settings['video_animation_duration']) ? 'animated-' . $settings['video_animation_duration'] : '';
        if (!empty($settings['video_animation'])) {
            $classes[] = 'pxl-animate pxl-invisible';
            $video_atts[] = 'data-settings="' . esc_attr(json_encode([
                    'animation' => $settings['video_animation'],
                    'animation_delay' => $settings['video_animation_delay']
                ])).'"';

        }
        $embed_params = [
            'loop' => '0',
            'controls' => '1',
            'mute' => '0',
            'rel' => '0',
            'modestbranding' => '0'
        ];
         
        $video_atts[] = 'class="' . implode(' ', $classes) . '"';
        $video_atts[] = 'data-elementor-open-lightbox="yes"';
        $video_atts[] = 'data-elementor-lightbox="' . esc_attr(json_encode([
            'type' => 'video',
            'videoType' => 'youtube',
            'url' => \Elementor\Embed::get_embed_url($settings['video_link']['url'], $embed_params, $embed_options),
            'modalOptions' => [
                'id' => 'pxl-lightbox-' . $lightbox_id,
                'entranceAnimation' => 'fadeInUp',
                'entranceAnimation_tablet' => '',
                'entranceAnimation_mobile' => '',
                'videoAspectRatio' => '169'
            ]
        ])).'"';
    }

    $widget->add_render_attribute( 'wrapper', 'class', 'pxl-icon-wg' );
    $style_icon = $settings['style_icon'] ?? '';
    if ( ! empty( $style_icon ) ) {
        $widget->add_render_attribute('wrapper', 'class', $style_icon);
    }
    $widget->add_render_attribute( 'icon-wrapper', 'class', 'icon-inner relative pxl-transition' );
    $widget->add_render_attribute( 'icon', 'class', 'pxl-icon' );
    if( !empty($link['url'])){
        $widget->add_render_attribute( 'link', 'href', $link['url'] );
        if ( $settings['link']['is_external'] ) {
            $widget->add_render_attribute( 'link', 'target', '_blank' );
        }
        if ( $settings['link']['nofollow'] ) {
            $widget->add_render_attribute( 'link', 'rel', 'nofollow' );
        }
        $link_attributes = $widget->get_render_attribute_string( 'link' ); 
    }
    if ( ! empty( $hover_animation ) ) {
        $widget->add_render_attribute( 'icon-wrapper', 'class', 'pxl-hover-anm' );
        $widget->add_render_attribute( 'icon', 'class', $hover_animation );
    }
    /*if ( ! empty( $icon_effect ) ) {
        $widget->add_render_attribute( 'icon', 'class', $icon_effect );
    }*/
 
?>
<div <?php pxl_print_html($widget->get_render_attribute_string( 'wrapper' )); ?>>
    <?php echo !empty($link['url']) ? '<a '. implode( ' ', [ $link_attributes ] ) .'>' : ''; ?>
        <div <?php pxl_print_html($widget->get_render_attribute_string( 'icon-wrapper' )); ?> <?php echo implode(' ', $video_atts); ?>>
            <?php if(! empty( $settings['selected_icon']['value'] )): ?>
                <span <?php pxl_print_html($widget->get_render_attribute_string( 'icon' )); ?>><?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true'] );?></span>
            <?php endif; ?>
        </div>  
    <?php echo !empty($link['url']) ? '</a>' : ''; ?>
</div>