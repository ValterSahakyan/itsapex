<?php
extract($settings);
$img_size = !empty($img_size) ? $img_size : '424x565';
$button_text = isset($settings['button_text']) ? $settings['button_text'] : '';
if(!empty($settings['hyper_link']['url'])){
    $widget->add_render_attribute( 'custom_link', 'href', $settings['hyper_link']['url'] );

    if ( $settings['hyper_link']['is_external'] ) {
        $widget->add_render_attribute( 'custom_link', 'target', '_blank' );
    }

    if ( $settings['hyper_link']['nofollow'] ) {
        $widget->add_render_attribute( 'custom_link', 'rel', 'nofollow' );
    }
}
$link_attributes = $widget->get_render_attribute_string( 'custom_link' );
?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list) > 0): ?>
    <div class="pxl-services-list layout-<?php echo esc_attr($settings['layout'])?>">
        <div class="row">
            <div class="col-6 content">
                <?php foreach ($content_list as $key => $value):
                    $image       = isset($value['image']) ? $value['image'] : [];
                    $description       = isset($value['description']) ? $value['description'] : '';
                    $sub_title       = isset($value['sub_title']) ? $value['sub_title'] : '';
                    $thumbnail = '';
                    if(!empty($image['id'])) {
                        $img = pxl_get_image_by_size( array(
                            'attach_id'  => $image['id'],
                            'thumb_size' => $img_size,
                            'class' => 'no-lazyload',
                        ));
                        $thumbnail = $img['thumbnail'];
                    }
                    $is_active = ($active_list == $key + 1);
                    ?>
                    <div id="item-<?php echo esc_attr($value['_id']); ?>" class="box-content <?php echo esc_attr( $is_active ? 'active' : '' ); ?>">
                        <div class="item-image">
                            <?php if(!empty($thumbnail)): ?>
                                <div class="col-auto">
                                    <?php pxl_print_html($thumbnail); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="sub-des">
                            <div class="item-subtitle"><?php pxl_print_html($sub_title); ?></div> 
                            <div class="item-description"><?php pxl_print_html($description); ?></div>  
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-6 title">
                <?php
                $idx = 0;
                foreach ($content_list as $key => $value):
                    $idx++;
                    $title        = isset($value['title']) ? $value['title'] : '';
                    $sub_title       = isset($value['sub_title']) ? $value['sub_title'] : '';
                    $button_text_list       = isset($value['button_text_list']) ? $value['button_text_list'] : '';

                    $link_key = $widget->get_repeater_setting_key( 'link_list', 'content_list', $key );
                    if ( ! empty( $value['link_list']['url'] ) ) {
                        $widget->add_render_attribute( $link_key, 'href', $value['link_list']['url'] );

                        if ( $value['link_list']['is_external'] ) {
                            $widget->add_render_attribute( $link_key, 'target', '_blank' );
                        }
                        if ( $value['link_list']['nofollow'] ) {
                            $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                        }
                    }
                    $is_active = ($active_list == $key + 1);
                    ?>
                    <div class="item-inner <?php echo esc_attr( $is_active ? 'active' : '' ); ?>" data-target="#item-<?php echo esc_attr($value['_id']); ?>">
                        <h3 class="item-title"><?php pxl_print_html($title); ?></h3>
                        <div class="item-subtitle"><?php pxl_print_html($sub_title); ?></div> 
                        <div class="btn-more">
                            <a <?php pxl_print_html($widget->get_render_attribute_string( $link_key )); ?>>
                                <?php if ( ! empty( $value['link_list']['url'] ) ) ?>
                                <span><?php pxl_print_html($button_text_list); ?></span>
                                <svg width="9" height="9" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.68053 2.27614L0.942807 8.01387L0 7.07107L5.73773 1.33333H0.680547V0H8.01386V7.33333H6.68053V2.27614Z"/>
                                </svg>
                                <?php if ( ! empty( $value['link_list']['url'] ) ) ?>
                            </a>
                        </div>
                        <div class="pxl-divider"></div>
                    </div>
                <?php endforeach; ?>
                <?php if ( $link_attributes ) echo '<a class="button-more" '. $link_attributes .'>'; ?>
                <span class="pxl-btn btn-third">
                    <span class="pxl-button-text"><?php pxl_print_html($button_text); ?></span>
                </span>
                <?php if ( $link_attributes ) echo '</a>'; ?> 
            </div>
        </div>
    </div>
<?php endif; ?>
