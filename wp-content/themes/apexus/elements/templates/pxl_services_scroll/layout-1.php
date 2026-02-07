<?php
extract($settings);
$offset_fix = isset($settings['offset_fix']['size']) ? $settings['offset_fix']['size'] : 202;

?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list) > 0): ?>
    <div class="pxl-services-scroll layout-<?php echo esc_attr($settings['layout'])?>" data-offset-fix="<?php echo esc_attr($offset_fix); ?>">
        <div class="row">
            <div class="col-5">
                <div class="scroll-1">
                    <div class="box-content">
                        <?php $number = 1; foreach ($content_list as $key => $value):
                            $title        = isset($value['title']) ? $value['title'] : '';
                            $description       = isset($value['description']) ? $value['description'] : '';
                            $progress_key = $widget->get_repeater_setting_key( 'progress', 'content_list', $key );
                            $widget->add_render_attribute( $progress_key, [            
                                'class' => 'progress-bar',
                                'data-target' => '#progress-'.$settings['element_id'].'-'.$value['_id'],
                            ]);  
                            
                            ?>
                            <div class="item-inner">
                                <span <?php $widget->print_render_attribute_string( $progress_key) ?>></span>
                                <span class="item-number"><?php echo esc_html(sprintf('%02d', $number)); ?></span>
                                <div class="title-des">
                                    <div class="title-icon">
                                        <i class="pxli-Polygon"></i>
                                        <h5 class="item-title"><?php pxl_print_html($title); ?></h5>
                                    </div>
                                    <div class="item-description"><?php pxl_print_html($description); ?></div>  
                                </div>
                            </div>
                        <?php $number++; endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="box-image">
                    <span class="svg-scroll"></span>
                    <div class="item-img">
                        <?php foreach ($content_list as $key => $value):
                            $image       = isset($value['image']) ? $value['image'] : [];
                            $thumbnail = '';
                            if(!empty($image['id'])) {
                                $img = pxl_get_image_by_size( array(
                                    'attach_id'  => $image['id'],
                                    'thumb_size' => '636x800',
                                    'class' => 'no-lazyload',
                                ));
                                $thumbnail = $img['thumbnail'];
                            }
                            ?>
                            <?php if(!empty($thumbnail)): ?>
                                <div class="item-image">
                                    <?php pxl_print_html($thumbnail); ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>    
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
