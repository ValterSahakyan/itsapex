<?php 

    $widget->add_render_attribute( 'apexus-widget', 'class', [ 'pxl-heading-scroll-effect']);

    $heading = $settings[ 'heading_text'];

    $widget->add_render_attribute( 'heading', 'class', [ 'heading-text']);

    if ( ! empty( $settings['icon_arrow'] ) && $settings['icon_arrow'] === 'yes' ) {
        $widget->add_render_attribute( 'heading', 'class', 'icon-arrow' );
    }

    $heading_html = sprintf(
        '<%1$s %2$s>%3$s</%1$s>',
        \Elementor\Utils::validate_html_tag( $settings['heading_tag'] ),
        $widget->get_render_attribute_string( 'heading' ),
        $heading
    );
?>

<div <?php $widget->print_render_attribute_string( 'apexus-widget' ); ?>>

    <?php echo wp_kses_post( $heading_html); ?>  

</div>