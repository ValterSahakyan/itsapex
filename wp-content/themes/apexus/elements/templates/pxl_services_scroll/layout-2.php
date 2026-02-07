<?php
extract($settings);
$offset_fix = isset($settings['offset_fix']['size']) ? $settings['offset_fix']['size'] : 202;

?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list) > 0): ?>
    <div class="pxl-services-scroll layout-<?php echo esc_attr($settings['layout'])?>" data-offset-fix="<?php echo esc_attr($offset_fix); ?>">
        <div class="row">
            <div class="col-6">
                <div class="box-image">
                    <div class="item-img">
                        <?php $number = 1; foreach ($content_list as $key => $value):            
                            ?>
                            <div class="item-template item-image">
                                <span class="item-number"><?php echo esc_html(sprintf('%02d', $number)); ?></span>
                                <?php if(!empty($value['content_template'])) : ?>
                                <?php $slide_content = Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$value['content_template']);
                                pxl_print_html($slide_content); ?>
                                <?php endif; ?>
                            </div>
                        <?php $number++; endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <?php if (!empty($settings['subtitle'])) : ?>
                    <h4 class="item-subtitle pxl-split-text split-in-fade"><?php pxl_print_html($settings['subtitle']); ?></h4>
                <?php endif; ?>
                <div class="scroll-1">
                    <div class="box-content">
                        <?php foreach ($content_list as $key => $value):
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
                                <div class="title-icon">
                                    <?php if(! empty($value['selected_icon'])): ?>
                                        <span class="item-icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $value['selected_icon'], [ 'aria-hidden' => 'true'] );?>
                                        </span>
                                    <?php endif; ?>
                                    <h4 class="item-title"><?php pxl_print_html($title); ?></h4>
                                </div>
                                <div class="item-description">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <?php pxl_print_html($description); ?>
                                </div>  
                            </div>
                        <?php endforeach; ?>
                    </div>    
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
