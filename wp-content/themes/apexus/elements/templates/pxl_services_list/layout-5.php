<?php
extract($settings);
$img_size = !empty($img_size) ? $img_size : '447x288';
?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list) > 0): ?>
    <div class="pxl-services-list layout-<?php echo esc_attr($settings['layout'])?>">
        <div class="row">
            <div class="col-7 content">
                <?php foreach ($content_list as $key => $value):
                    $image       = isset($value['image']) ? $value['image'] : [];
                    $description       = isset($value['description']) ? $value['description'] : '';
                    $title        = isset($value['title']) ? $value['title'] : '';
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
                            <div class="item-dot">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                    <line x1="8.04297" y1="3.27836e-08" x2="8.04297" y2="15" stroke="currentColor" stroke-width="1.5"/>
                                    <line x1="15" y1="7.5" x2="-6.55671e-08" y2="7.5" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            </div>
                            <?php if(!empty($thumbnail)): ?>
                                <div class="col-auto">
                                    <?php pxl_print_html($thumbnail); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="tit-des">
                            <div class="item-title"><?php pxl_print_html($title); ?></div> 
                            <div class="item-description"><?php pxl_print_html($description); ?></div>  
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-5 title">
                <?php
                $idx = 0;
                foreach ($content_list as $key => $value):
                    $idx++;
                    $title        = isset($value['title']) ? $value['title'] : '';
                    $description       = isset($value['description']) ? $value['description'] : '';
                    $is_active = ($active_list == $key + 1);
                    ?>
                    <div class="item-inner <?php echo esc_attr( $is_active ? 'active' : '' ); ?>" data-target="#item-<?php echo esc_attr($value['_id']); ?>">
                        <h3 class="item-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="9" height="10" viewBox="0 0 9 10">
                                <path d="M9 5L0 10L4.5426e-07 0L9 5Z"/>
                            </svg>
                            <span><?php pxl_print_html($title); ?></span>
                        </h3>
                        <div class="item-description"><?php pxl_print_html($description); ?></div>  
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
