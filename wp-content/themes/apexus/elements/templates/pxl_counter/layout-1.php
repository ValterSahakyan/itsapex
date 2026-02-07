<?php

$widget->add_render_attribute( 'counter-value', [
    'class' => 'counter-number-value',
    'data-duration' => $settings['duration'],
    'data-start' => $settings['starting_number'],
    'data-separator-enable' => $widget->get_setting( 'thousand_separator', 'no'),
    'data-delimiter' => $widget->get_setting( 'thousand_separator_char', '' )
] );

$ending_number = $widget->get_setting( 'ending_number', 0);

?>
<div class="pxl-counter-wg gx-16 layout-<?php echo esc_attr($settings['layout'])?>">    
    <div class="counter-number">
        <?php if( !empty($settings['prefix'])) : ?>
            <span class="counter-number-prefix"><?php pxl_print_html( $settings['prefix']); ?></span>
        <?php endif; ?>
        <span <?php $widget->print_render_attribute_string( 'counter-value'); ?>><?php echo esc_html( $ending_number); ?></span>
        <?php if( !empty($settings['suffix'])) : ?>
            <span class="counter-number-suffix"><?php pxl_print_html( $settings['suffix']); ?></span>
        <?php endif; ?>
    </div>
    <?php if( !empty($settings['title'])) : ?>
        <div class="counter-title p"><?php pxl_print_html(' '. $settings['title']); ?></div>
    <?php endif; ?>
</div>