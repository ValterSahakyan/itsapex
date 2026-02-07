<?php
extract($settings);
  
$editor_content = $widget->get_settings_for_display( 'text_editor' );
$editor_content = $widget->parse_text_editor( $editor_content );
 

$widget->add_render_attribute( 'text_editor_wrap', 'id', pxl_get_element_id($settings));
$widget->add_render_attribute( 'text_editor_wrap', 'class', ['pxl-text-editor-wrap d-flex']);
 
$widget->add_render_attribute( 'text_editor', 'class', [ 'pxl-text-editor', 'elementor-clearfix' ] );
$widget->add_inline_editing_attributes( 'text_editor', 'advanced' );
 

if(isset($text_truncate) && $text_truncate == true)
	$widget->add_render_attribute( 'text_editor', 'class', 'pxl-text-truncate' );
 
if( !empty($settings['split_text_anm']) ){
    $widget->add_render_attribute( 'text_editor', 'class', 'pxl-split-text '.$settings['split_text_anm']);
}

if(!empty($settings['sp_type'])){
    $widget->add_render_attribute( 'text_editor', 'class', 'pxl-split-text pxl_el_split_text '.$settings['sp_type']);
}

?>
<div <?php pxl_print_html($widget->get_render_attribute_string( 'text_editor_wrap' )); ?> >
	<div <?php echo ''.$widget->get_render_attribute_string( 'text_editor' ); ?>>
		<?php pxl_print_html($editor_content); ?>		
	</div>
</div>