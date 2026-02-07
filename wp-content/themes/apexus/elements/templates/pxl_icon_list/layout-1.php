<?php 
extract($settings);
 
$widget->add_render_attribute( 'icon_list', 'class', ['pxl-icon-list-wg', 'items-'.$view, 'icon-type-'.$icon_type] );
  
$hover_animation_cls = !empty($hover_animation) ? $hover_animation : 'none-anm';

$animate_cls = '';
$data_animations = [];

?>
<div <?php $widget->print_render_attribute_string( 'icon_list' ); ?>>
	<?php 
	foreach ( $icon_list as $index => $item ) : 
		$increase = $index + 1; 
        $data_settings = '';
        if ( !empty( $data_animations ) ) {
            $data_settings = 'data-settings="'.esc_attr(json_encode($data_animations)).'"';
        }
        if ( ! empty( $item['link']['url'] ) ){
        	$link_key = 'link_' . $index;
			$widget->add_link_attributes( $link_key, $item['link'] );
        }
		if ( ! empty( $item['link']['url'] ) && empty($item['title']) ):
			?>
			<a class="list-item relative d-flex item-<?php echo esc_attr($view) ?> elementor-repeater-item-<?php echo esc_attr($item['_id']) ?> pxl-hover-anm <?php echo esc_attr($animate_cls); ?>" <?php $widget->print_render_attribute_string( $link_key ); ?> <?php pxl_print_html($data_settings); ?>>
		<?php else: ?>
			<div class="list-item relative d-flex item-<?php echo esc_attr($view) ?> elementor-repeater-item-<?php echo esc_attr($item['_id']) ?> pxl-hover-anm <?php echo esc_attr($animate_cls); ?>" <?php pxl_print_html($data_settings); ?>>
		<?php endif; ?>

		<?php if ( $icon_type == 'icon' && ( !empty( $selected_icon['value'] ) || !empty( $item['item_icon']['value'] ) || !empty( $item['item_icon_text'])) ) : ?>  
			<span class="pxl-icon d-inline-flex flex-shrink-0">
				<span class="icon-inner <?php echo esc_attr($hover_animation_cls) ?>">
				<?php
                    if(!empty($item['item_icon']['value']))
                        \Elementor\Icons_Manager::render_icon( $item['item_icon'], [ 'aria-hidden' => 'true'] );
                    else
                        \Elementor\Icons_Manager::render_icon( $selected_icon, [ 'aria-hidden' => 'true']);
                ?>
                <?php if( !empty( $item['item_icon_text'])) echo '<span class="icon-text">'.$item['item_icon_text'].'</span>'; ?>
                </span>
			</span>
		<?php endif; ?>

		<?php if( !empty($item['title'])) echo '<div class="item-content">'; ?> 
		<?php if( !empty($item['title'])): ?>
	        <<?php echo esc_attr($title_tag); ?> class="item-title">
	        	<?php if ( ! empty( $item['link']['url'] ) && !empty($item['title']) ) : ?>
	        		<a <?php $widget->print_render_attribute_string( $link_key ); ?>>
				<?php endif; ?>
	        		<?php pxl_print_html( $item['title'] )?>
	        	<?php if ( ! empty( $item['link']['url'] ) && !empty($item['title']) ) : ?>
	        		</a>
				<?php endif; ?>
	        </<?php echo esc_attr($title_tag); ?>>
        <?php endif; ?>
        <?php if( !empty($item['text'])): ?>
		<<?php echo esc_attr($text_tag); ?> class="item-text"><?php pxl_print_html( nl2br($item['text']) )?></<?php echo esc_attr($text_tag); ?>>
		<?php endif; ?>
		<?php if( !empty($item['title'])) echo '</div>'; ?> 

		<?php if ( ! empty( $item['link']['url'] ) && empty($item['title']) ) : ?>
			</a>
		<?php else: ?>
			</div>
		<?php endif; 
	endforeach;
	?>
</div>