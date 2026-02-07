<?php
$html_id = pxl_get_element_id($settings);
$editor_title = $widget->get_settings_for_display( 'title' );
$editor_title = !empty($editor_title) ? $widget->parse_text_editor( $editor_title ) : ''; 

$widget->add_render_attribute( 'wrap-heading', 'class', 'pxl-heading-wrap d-flex');
$widget->add_render_attribute( 'heading-inner', 'class', 'pxl-heading-inner');

if(!empty($settings['sub_title_on_top']) && $settings['sub_title_on_top'] == 'yes'){
    $widget->add_render_attribute( 'heading-inner', 'class', 'd-flex flex-column flex-column-reverse sub-top');
}
if(!empty($settings['text_shadow_color']) && $settings['text_shadow_color'] == 'yes'){
    $widget->add_render_attribute( 'heading-inner', 'class', 'shadow-color');
}
if ( $settings['style_heading_color'] === 'til-gradient' ) {
    $widget->add_render_attribute( 'heading-inner', 'class', 'til-gradient' );
}

$list_array = [];
$hightlight_list = $widget->get_settings('text_list');
if(count($hightlight_list) > 0){
    foreach ($hightlight_list as $key => $list) {
        $list_array[] = $list['highlight_text'];
    }
}

$widget->add_render_attribute( 'large-title', 'class', 'heading-title');
 
if(!empty($settings['title_sp_type'])){
    $widget->add_render_attribute( 'large-title', 'class', 'pxl-split-text pxl_title_split_text '.$settings['title_sp_type']);
}
 
$widget->add_render_attribute( 'sub-title', 'class', 'heading-subtitle');
if(!empty($settings['sub_img_before']['url'])){
    $widget->add_render_attribute( 'sub-title', 'class', 'has-img pxl-draw-from-left');
}

$widget->add_render_attribute( 'sub-title-text', 'class', 'subtitle-text ');
if(!empty($settings['subtitle_sp_type'])){
    $widget->add_render_attribute( 'sub-title-text', 'class', 'pxl-split-text pxl_subtitle_split_text '.$settings['subtitle_sp_type']);
}


$title_cliptext = $widget->get_settings( 'title_cliptext', 'no' );
if( $title_cliptext == 'yes'){
    $widget->add_render_attribute( 'large-title', 'class', 'clip-text '.$settings['title_cliptext_bg_img_anm'] );
}
if(!empty($settings['title_split_text_anm'])){
    $widget->add_render_attribute( 'large-title', 'class', 'pxl-split-text '.$settings['title_split_text_anm']);
}
if(!empty($settings['subtitle_split_text_anm'])){
    $widget->add_render_attribute( 'sub-title-text', 'class', 'pxl-split-text '.$settings['subtitle_split_text_anm']);
}
?>
<div id="pxl-<?php echo esc_attr($html_id) ?>" <?php pxl_print_html($widget->get_render_attribute_string( 'wrap-heading' )); ?>>
    <div <?php pxl_print_html($widget->get_render_attribute_string( 'heading-inner' )); ?> >
        <<?php echo esc_attr($settings['title_tag']); ?> <?php pxl_print_html($widget->get_render_attribute_string( 'large-title' )); ?>>
            <?php echo wp_kses_post($editor_title); ?>
            <?php if (!empty($list_array)) { ?>
                <span class="heading-highlight typewrite">
                    <?php foreach ($list_array as $highlight) { ?>
                        <span class="pxl-item--text"><?php echo esc_html($highlight); ?></span>
                    <?php } ?>
                </span>
            <?php } ?>
        </<?php echo esc_attr($settings['title_tag']); ?>>
        <?php if(!empty($settings['sub_title']) ): ?>
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'sub-title' )); ?>>
                <div <?php pxl_print_html($widget->get_render_attribute_string( 'sub-title-text' )); ?>><?php pxl_print_html(nl2br($settings['sub_title'])); ?></div>
            </div>
        <?php endif; ?>
    </div>
</div>

