<?php
extract($settings);
$img_size = !empty($img_size) ? $img_size : '618x460';
?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list) > 0): ?>
    <div class="pxl-services-list layout-<?php echo esc_attr($settings['layout'])?>">
        <?php $number = 1; foreach ($content_list as $key => $value):
            $image       = isset($value['image']) ? $value['image'] : [];
            $title        = isset($value['title']) ? $value['title'] : '';
            $description       = isset($value['description']) ? $value['description'] : '';
            $button_text_list       = isset($value['button_text_list']) ? $value['button_text_list'] : '';
            $thumbnail = '';
            if(!empty($image['id'])) {
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $image['id'],
                    'thumb_size' => $img_size,
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            }
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
            $current_slide = $key + 1;
            ?>
            <div class="item-inner relative row">
                <div class="img-title col-7">
                    <div class="box-image pxl-animated-waypoint">
                        <?php if(!empty($thumbnail)): ?>
                            <div class="item-image col-auto">
                                <?php pxl_print_html($thumbnail); ?>
                            </div>
                        <?php endif; ?>
                        <h5 class="item-title"><?php pxl_print_html($title); ?></h5>
                    </div>
                </div>
                <div class="col-5">
                    <div class="box-content">
                        <span class="item-number"><?php echo esc_html(sprintf('%02d', $number)); ?></span>
                        <?php if(isset($boxs) && !empty($boxs) && count($boxs) > 0): ?>
                            <div class="pxl-item-boxs d-flex">
                                <?php foreach ($boxs as $key => $box):
                                    $category = isset($box['category']) ? $box['category'] : '';
                                    $show_in = isset($box['show_in']) ? $box['show_in'] : '';
                                    $array = explode('-', $show_in);
                                    $array = array_map('intval', $array);                                       
                                ?>
                                <?php 
                                if (in_array($current_slide, $array) && (!empty($category))):?>
                                    <span class="category"><?php pxl_print_html($category); ?></span>

                                <?php endif; ?>
                                <?php endforeach;?>
                            </div>
                        <?php endif;?>
                        <div class="item-description"><?php pxl_print_html($description); ?></div>  
                        <a class="pxl-btn btn-fourth" <?php pxl_print_html($widget->get_render_attribute_string( $link_key )); ?>>
                            <?php if ( ! empty( $value['link_list']['url'] ) ) ?>
                            <span class="pxl-button-text"><?php pxl_print_html($button_text_list); ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                <path d="M10.0833 10.0833L14.6667 5.5M14.6667 5.5L19.25 10.0833M14.6667 5.5V12.6528C14.6667 13.6776 14.6667 14.1902 14.467 14.582C14.2913 14.9269 14.0103 15.2079 13.6653 15.3837C13.2735 15.5833 12.7609 15.5833 11.7362 15.5833H2.75" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <?php if ( ! empty( $value['link_list']['url'] ) ) ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php $number++; endforeach; ?>
    </div>
<?php endif; ?>
