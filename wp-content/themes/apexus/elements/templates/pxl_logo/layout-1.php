<?php 
extract($settings);
 
if ( ! empty( $logo_link['url'] ) ) {
    $widget->add_render_attribute( 'logo_link', 'href', $logo_link['url'] );

    if ( $logo_link['is_external'] ) {
        $widget->add_render_attribute( 'logo_link', 'target', '_blank' );
    }

    if ( $logo_link['nofollow'] ) {
        $widget->add_render_attribute( 'logo_link', 'rel', 'nofollow' );
    }
}else{
    $widget->add_render_attribute( 'logo_link', 'href', home_url('/') );
}

if(!empty($logo['url'])) : 
    $thumbnail = '<img src="'.esc_url($logo['url']).'" alt="'.apexus()->get_name().'">';
    ?>
    <div class="pxl-logo d-flex-wrap align-items-center">
        <a <?php pxl_print_html($widget->get_render_attribute_string( 'logo_link' )); ?>><?php pxl_print_html($thumbnail);?></a>
    </div>
<?php endif; ?>
