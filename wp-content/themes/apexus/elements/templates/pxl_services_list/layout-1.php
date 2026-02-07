<?php
extract($settings);
?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list) > 0): ?>
    <div class="pxl-services-list layout-<?php echo esc_attr($settings['layout'])?>">
        <?php $number = 1; foreach ($content_list as $key => $value):
            $image       = isset($value['image']) ? $value['image'] : [];
            $title        = isset($value['title']) ? $value['title'] : '';
            $description       = isset($value['description']) ? $value['description'] : '';
            $sub_title       = isset($value['sub_title']) ? $value['sub_title'] : '';
            $thumbnail = '';
            if(!empty($image['id'])) {
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $image['id'],
                    'thumb_size' => '526x400',
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            }
            ?>
            <div class="item-inner relative row">
                <div class="box-image col-5">
                    <?php if(!empty($thumbnail)): ?>
                        <div class="item-image col-auto">
                            <?php pxl_print_html($thumbnail); ?>
                            <span class="item-number"><?php echo esc_html(sprintf('%02d', $number)); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-7">
                    <div class="box-content">
                        <div class="item-subtitle"><?php pxl_print_html($sub_title); ?></div> 
                        <div class="title-des">
                            <h5 class="item-title"><?php pxl_print_html($title); ?></h5>
                            <div class="item-description"><?php pxl_print_html($description); ?></div>  
                        </div>
                    </div>
                </div>
            </div>
        <?php $number++; endforeach; ?>
    </div>
<?php endif; ?>
