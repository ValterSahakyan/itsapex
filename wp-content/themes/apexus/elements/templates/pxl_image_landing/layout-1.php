<?php
use Elementor\Utils;

$default_settings = [
    'selected_image' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$thumbnail    = '';
if(!empty($selected_image['id'])){
    $img  = pxl_get_image_by_size( array(
        'attach_id'  => $selected_image['id'],
        'thumb_size' => 'full',
    ) );
    $thumbnail    = $img['thumbnail'];
}
$link_type = $settings['link_type'];
if ( ( $link_type === 'url' ) && ! empty( $settings['link']['url'] ) ) {

    $widget->add_render_attribute( 'link', 'href', $settings['link']['url'] );

    if ( ! empty( $settings['link']['is_external'] ) ) {
        $widget->add_render_attribute( 'link', 'target', '_blank' );
    }

    if ( ! empty( $settings['link']['nofollow'] ) ) {
        $widget->add_render_attribute( 'link', 'rel', 'nofollow' );
    }

    if ( ! empty( $settings['link']['custom_attributes'] ) ) {
        $custom_attributes = \Elementor\Utils::parse_custom_attributes(
            $settings['link']['custom_attributes']
        );
        $widget->add_render_attribute( 'link', $custom_attributes );
    }
}
if ($link_type === 'page') {
    $page_url = get_permalink($settings['page_link']);
    $widget->add_render_attribute( 'link', 'href', $page_url );

    if ( ! empty( $settings['open_in_new'] ) ) {
        $widget->add_render_attribute( 'link', 'target', '_blank' );
        $widget->add_render_attribute( 'link', 'rel', 'nofollow noopener' );
    }
}

$button_text_drag = !empty($button_text_drag) ? $button_text_drag : esc_html__('Detail', 'apexus');
if(!empty($selected_image['id'])) : ?>
    <div class="pxl-image-landing add-custom-cursor layout-1">
        <a id="circle-cursor" class="circle-cursor">
            <span><?php echo esc_html($button_text_drag); ?></span>
        </a>
        <div class="image-wrap">
            <div class="box-scale">
                <a <?php $widget->print_render_attribute_string( 'link' ); ?>>
                    <?php echo wp_kses_post($thumbnail); ?>
                </a>
            </div>
        </div>
        <div class="image-title">
            <a <?php $widget->print_render_attribute_string( 'link' ); ?>>
                <?php pxl_print_html($settings['title_text']); ?>
            </a>
        </div>
    </div>
<?php endif; ?>