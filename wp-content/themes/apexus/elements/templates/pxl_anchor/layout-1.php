<?php
$template = (int)$widget->get_setting('template','0');
$widget->add_render_attribute('anchor', 'class', 'pxl-anchor side-panel d-flex-wrap align-items-center relative');
 

$target = '.pxl-hidden-template-'.$template; 
if($template > 0 ){
	if ( !has_action( 'pxl_anchor_target_hidden_panel_'.$template) ){
		add_action( 'pxl_anchor_target_hidden_panel_'.$template, 'apexus_hook_anchor_hidden_panel' );
	} 
	
}else if( $template == 0 && !empty($settings['link']['url'])){
	 
    $widget->add_render_attribute( 'custom_link', 'href', $settings['link']['url'] );

    if ( $settings['link']['is_external'] ) {
        $widget->add_render_attribute( 'custom_link', 'target', '_blank' );
    }

    if ( $settings['link']['nofollow'] ) {
        $widget->add_render_attribute( 'custom_link', 'rel', 'nofollow' );
    }
 
    $widget->add_render_attribute( 'custom_link', 'class', 'pxl-anchor d-flex align-items-center' );
      
}
 
$style_layout_cls = !empty($settings['style_layout'] ) ? 'style-'.$settings['style_layout'] : '';
$custom_cls = $widget->get_setting('custom_class','');

$wrap_cls = [
	'pxl-anchor-wrap d-flex-wrap align-items-center align-content-center',
	$style_layout_cls,
	$custom_cls
];
?>
<div class="<?php echo implode(' ', $wrap_cls) ?>">
	<?php if( $template == 0 && !empty($settings['link']['url'])): ?>
		<a <?php pxl_print_html($widget->get_render_attribute_string( 'custom_link' )); ?>>
			<?php 
		    if( $widget->get_setting('icon_type','none') == 'lib'){
		    	echo '<div class="pxl-anchor-icon d-inline-flex">';
		    	\Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'span' );
		    	echo '</div>';
		    }
		    if($widget->get_setting('icon_type','none') == 'custom-1'){
		    	echo '<div class="pxl-anchor-icon icon-custom d-inline-flex custom-1"><span></span><span></span><span></span></div>';
		    } 
		    if(!empty($widget->get_setting('title',''))){
		    	echo '<span class="anchor-title d-inline-flex">'.$widget->get_setting('title', '').'</span>';
		    } ?>
		</a>
	<?php else: ?>
		<div <?php pxl_print_html($widget->get_render_attribute_string( 'anchor' )); ?> data-target="<?php echo esc_attr($target)?>">
		    <?php 
		    if( $widget->get_setting('icon_type','none') == 'lib'){
		    	echo '<div class="pxl-anchor-icon d-inline-flex">';
		    	\Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'span' );
		    	echo '</div>';
		    }
		    if($widget->get_setting('icon_type','none') == 'menu-mobile-toggle-nav'){
		    	echo '<div class="pxl-anchor-icon icon-custom d-inline-flex header-mobile-nav"><span class="menu-mobile-toggle-nav"><span></span><span></span><span></span></span></div>';
		    } 
		    if(!empty($widget->get_setting('title',''))){
		    	echo '<span class="anchor-title d-inline-flex">'.$widget->get_setting('title', '').'</span>';
		    } ?>
		</div>
	<?php endif; ?>
</div>
 