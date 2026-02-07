<?php 
$widget->add_render_attribute( 'pxl_img_wrap', 'id', pxl_get_element_id($settings));
$widget->add_render_attribute( 'pxl_img_wrap', 'class', 'pxl-image-wg d-flex');
$widget->add_render_attribute( 'pxl_img_inner', 'class', 'parallax-inner');

if(!empty($settings['custom_style'])){
	$widget->add_render_attribute( 'pxl_img_wrap', 'class', 'pxl-'.$settings['custom_style']);
	if(!empty($settings['custom_animation_delay'])){
		$custom_style_settings = json_encode([
	        'custom_animation_delay' => $settings['custom_animation_delay']
	    ]);
	    $widget->add_render_attribute( 'pxl_img_wrap', 'data-setting-custom', $custom_style_settings );
	}
	 
}

if(!empty($settings['pxl_parallax'])){
    $parallax_settings = json_encode([
        $settings['pxl_parallax'] => $settings['parallax_value'],
    ]);
    $widget->add_render_attribute( 'pxl_img_wrap', 'data-parallax', $parallax_settings );
}
 
$link = apexus_get_img_link_url( $settings );
if ( $link ) {
	$widget->add_link_attributes( 'link', $link );

	if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
		$widget->add_render_attribute( 'link', [
			'class' => 'elementor-clickable',
		] );
	}
	if ( 'file' === $settings['link_to'] ) {
		$widget->add_lightbox_data_attributes( 'link', $settings['image']['id'], $settings['open_lightbox'] );
	}
}	

if(!empty($settings['image_mode']) && $settings['image_mode'] == 'background'){
	$image_src = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $settings['image']['id'], 'image', $settings );
	$widget->add_render_attribute( 'pxl_img_wrap', 'class', 'bg-image'); 
	$widget->add_render_attribute( 'pxl_img_wrap', 'style', '--pxl-image-bg: url('. esc_url($image_src).' )'); 
}
if(!empty($settings['image_mode']) && $settings['image_mode'] == 'parallax'){
	$data_parallax = apexus_get_parallax_effect_settings($settings);
	$image_src = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $settings['image']['id'], 'image', $settings );
	$widget->add_render_attribute( 'pxl_img_wrap', 'class', 'pxl-bg-parallax'); 
	$widget->add_render_attribute( 'pxl_img_inner', 'data-parallax', $data_parallax); 
	$widget->add_render_attribute( 'pxl_img_inner', 'style', '--pxl-image-bg: url('. esc_url($image_src).' )'); 
}
if(!empty($settings['img_animation'])){
    $widget->add_render_attribute( 'pxl_img_wrap', 'class', $settings['img_animation']); 
}

if(!empty($settings['filter_color']) && $settings['filter_color'] == 'yes'){
    $widget->add_render_attribute( 'pxl_img_wrap', 'class', 'filter-color');
}
?>
<div <?php pxl_print_html($widget->get_render_attribute_string( 'pxl_img_wrap' )); ?>>
	<?php if ( $link ) : ?><a <?php $widget->print_render_attribute_string( 'link' ); ?>><?php endif; ?>
		<?php if( empty($settings['image_mode'])) \Elementor\Group_Control_Image_Size::print_attachment_image_html( $settings );?>
		<?php if(!empty($settings['image_mode']) && $settings['image_mode'] == 'parallax'): ?>
			<div <?php pxl_print_html($widget->get_render_attribute_string( 'pxl_img_inner' )); ?>></div>
		<?php endif; ?>
	<?php if ( $link ) : ?></a><?php endif; ?>
</div>