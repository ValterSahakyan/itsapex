<?php 
if(class_exists('MC4WP_Container')) : 
	extract($settings);
	?>
	<div class="pxl-mailchimp relative <?php echo esc_attr($settings['style']); ?>">
		<div class="mc-inner">
			<?php 
			if(!empty( $settings['form_id']))
				echo do_shortcode('[mc4wp_form id="'.(int)$settings['form_id'].'"]'); 
			else
				echo do_shortcode('[mc4wp_form]'); 
			?>
		</div>
	</div>
<?php endif; ?>
