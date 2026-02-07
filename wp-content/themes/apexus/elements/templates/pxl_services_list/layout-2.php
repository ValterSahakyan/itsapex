<?php
extract($settings);
$img_size = !empty($img_size) ? $img_size : '424x239';
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
            <div class="bg-image">
                <?php foreach ($content_list as $key => $value): 
                    $image       = isset($value['image']) ? $value['image'] : [];
                    $thumbnail = '';
                    if(!empty($image['id'])) {
                        $img = pxl_get_image_by_size( array(
                            'attach_id'  => $image['id'],
                            'thumb_size' => 'full',
                            'class' => 'no-lazyload',
                        ));
                        $thumbnail = $img['thumbnail'];
                    }
                    $is_active = ($active_list == $key + 1);
                ?>
                <?php if(!empty($thumbnail)): ?>
                    <div class="image-full <?php echo esc_attr( $is_active ? 'active' : '' ); ?>" data-id="item-<?php echo esc_attr($value['_id']); ?>">
                        <?php pxl_print_html($thumbnail); ?>
                    </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
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
                        <div class="item-subtitle"><?php pxl_print_html($sub_title); ?></div> 
                        <div class="item-description"><?php pxl_print_html($description); ?></div>  
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-6 title">
                <?php
                $idx = 0;
                $number = 1;
                foreach ($content_list as $key => $value):
                    $idx++;
                    $title        = isset($value['title']) ? $value['title'] : '';
                    $is_active = ($active_list == $number);
                    ?>
                    <div class="item-inner <?php echo esc_attr( $is_active ? 'active' : '' ); ?>" data-target="#item-<?php echo esc_attr($value['_id']); ?>">
                        <h5 class="item-title"><?php pxl_print_html($title); ?></h5>
                        <span class="item-number">[ <span class="number"><?php echo esc_html(sprintf('%02d', $number)); ?></span> ]</span>
                    </div>
                <?php $number++; endforeach; ?>
                <?php if ( $link_attributes ) echo '<a class="button-more" '. $link_attributes .'>'; ?>
                <span class="pxl-btn btn-third">
                    <span class="pxl-button-text"><?php pxl_print_html($button_text); ?></span>
                </span>
                <?php if ( $link_attributes ) echo '</a>'; ?> 
            </div>
        </div>
    </div>
<?php endif; ?>
