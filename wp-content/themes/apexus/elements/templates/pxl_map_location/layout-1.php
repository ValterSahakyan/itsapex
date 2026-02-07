<?php
extract($settings);
$widget->add_render_attribute( 'map-wrap', 'class', ['pxl-location-wrap', 'layout-'.$settings['layout']]);
?>
<div <?php pxl_print_html($widget->get_render_attribute_string('map-wrap'));?>>
    <div class="lc-content-wrap row d-flex justify-content-between">
        <div class="map-area">
            <div class="map-wrapper">
                <?php if (!empty($settings['img_map']['url']))
                    echo '<img src="' . $settings['img_map']['url'] . '" alt="shape"/>';
                ?>
                <?php foreach ($settings['location_list'] as $key => $value) :
                    $increase = $key + 1;
                    $img_location= isset($value['img_location']) ? $value['img_location'] : [];
                    $thumbnail = '';
                    if(!empty($img_location['id'])) {
                        $img = pxl_get_image_by_size( array(
                            'attach_id'  => $img_location['id'],
                            'thumb_size' => '39x39',
                            'class' => 'no-lazyload',
                        )); 
                        $thumbnail = $img['thumbnail'];
                    }
                    ?>
                    <?php
                    $offset_x = isset($value['item_offset_x']) ? $value['item_offset_x'] . '%' : '';
                    $offset_y = isset($value['item_offset_y']) ? $value['item_offset_y'] . '%' : '';
                    if ($offset_x === '%' || $offset_x === '') $offset_x = 0;
                    if ($offset_y === '%' || $offset_y === '') $offset_y = 0;

                    $item_style_location = 'style="top: ' . esc_attr($offset_y) . '; left: ' . esc_attr($offset_x) . ';"';
                    ?>
                        <div id="ct-<?php echo esc_attr($increase); ?>" class="location-wrap pxl-ttip tt-top-left elementor-repeater-item-<?php echo esc_attr($value['_id']); ?>" <?php pxl_print_html($item_style_location); ?>>
                            <div class="map-marker"></div>
                            <div class="box-inner d-flex">
                                <div class="item-image">
                                    <?php if(!empty($thumbnail)) :?>
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="title-location">
                                    <?php if (!empty($value['item_title'])) : ?>
                                    <span class="item-title">
                                        <?php echo esc_attr($value['item_title']) ?>
                                    </span>
                                    <?php endif; ?>
                                    <span class="item-subtitle">
                                        <?php echo esc_attr($value['subtitle_location']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>