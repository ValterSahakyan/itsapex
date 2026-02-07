<?php
extract($settings);
$widget->add_render_attribute( 'wrapper', 'class', 'pxl-button-wrapper d-flex align-items-center' );
$link_type = !empty($settings['button_url_type']) ? $settings['button_url_type'] : 'url';
if ( ! empty( $settings['link']['url'] ) ) {
    $widget->add_render_attribute( 'button', 'href', $settings['link']['url'] );

    if ( isset( $settings['open_new_tab'] ) && $settings['open_new_tab'] === 'yes' ) {
        $widget->add_render_attribute( 'button', 'target', '_blank' );
    }

    if ( ! empty( $settings['link']['nofollow'] ) ) {
        $widget->add_render_attribute( 'button', 'rel', 'nofollow' );
    }
}

if ( ! empty( $settings['link']['custom_attributes'] ) ) {
    // Custom URL attributes should come as a string of comma-delimited key|value pairs
    $custom_attributes = Elementor\Utils::parse_custom_attributes( $settings['link']['custom_attributes'] );
    $widget->add_render_attribute( 'button', $custom_attributes);
} 
if($settings['style'] == 'link'){
    $widget->add_render_attribute( 'button', 'class', 'link-more '.$settings['style'].' icon-ps-'.$settings['icon_align']);
}else{
    $widget->add_render_attribute( 'button', 'class', 'pxl-btn '.$settings['style'].' icon-ps-'.$settings['icon_align'] );
}

if ( ! empty( $settings['button_css_id'] ) ) {
    $widget->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
}
 
if ( !empty($btn_icon['value']) ) {
    $widget->add_render_attribute( 'button', 'class', 'has-icon' );
}
if(!empty($settings['background_button']) && $settings['background_button'] == 'yes'){
    $widget->add_render_attribute( 'button', 'class', 'background-image');
}
 
if(!empty($button_split_text_anm) ){

    switch ($hover_split_text_anm) {
        case 'hover-split-text':
            $split_cls = 'pxl-split-text hover-split-text '.$button_split_text_anm;
            break;
        case 'only-hover-split-text':
            $split_cls = 'pxl-split-text-only-hover '.$button_split_text_anm;
            break;
        default:
            $split_cls = 'pxl-split-text '.$button_split_text_anm;
            break;
    }
    $widget->add_render_attribute( 'button', 'class', $split_cls );
}
$html_id = pxl_get_element_id($settings);
$button_attributes = $widget->get_render_attribute_string('button');
?>
<div id="<?php echo esc_attr($html_id); ?>" <?php pxl_print_html($widget->get_render_attribute_string( 'wrapper' )); ?> >
    <a <?php pxl_print_html($button_attributes); ?> data-text="<?php echo esc_attr($settings['text']); ?>">
        <?php 
        if (strpos($button_attributes, 'btn-fifth') !== false) {
            echo '<i class="pxl-icon left">';
            \Elementor\Icons_Manager::render_icon( $btn_icon, [ 'aria-hidden' => 'true', 'class' => 'pxl-button-icon '.$settings['icon_align'] ], 'span' ); 
            echo '</i>';
        }
        ?>
        <span class="pxl-button-text"><?php echo esc_html($settings['text']); ?></span>
        <?php 
        if ( !empty($btn_icon['value']) && strpos($button_attributes, 'btn-second') === false ) {
            echo '<span class="pxl-icon right">';
            \Elementor\Icons_Manager::render_icon( $btn_icon, [ 'aria-hidden' => 'true', 'class' => 'pxl-button-icon '.$settings['icon_align'] ], 'span' ); 
            echo '</span>';
        }
        
        if (strpos($button_attributes, 'btn-eighth') !== false) {
            echo '<span class="su-button-effect"></span>';
        }
        ?>
        <?php 
            if (!empty($btn_icon['value']) && strpos($button_attributes, 'btn-second') !== false) {
                echo '<span class="pxl-icon">';
                    echo '<span class="icon-left">';
                    \Elementor\Icons_Manager::render_icon( $btn_icon, [ 'aria-hidden' => 'true', 'class' => 'pxl-button-icon '.$settings['icon_align'] ], 'span' ); 
                    echo '</span>';
                    echo '<span class="icon-right">';
                    \Elementor\Icons_Manager::render_icon( $btn_icon, [ 'aria-hidden' => 'true', 'class' => 'pxl-button-icon '.$settings['icon_align'] ], 'span' ); 
                    echo '</span>';
                echo '</span>';
            }
        ?>
    </a>
</div>