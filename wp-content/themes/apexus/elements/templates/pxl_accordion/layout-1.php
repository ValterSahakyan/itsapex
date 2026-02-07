<?php
extract($settings);
$html_id = pxl_get_element_id($settings);

$active_section = intval($active_section);
$ac_items = $widget->get_settings('ac_items');

if(!empty($ac_items)) : ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="pxl-accordion <?php echo esc_attr($settings['style']); ?>">
        <?php foreach ($ac_items as $key => $ac):
            $is_active = ($key + 1) == $active_section;
            $_id = isset($ac['_id']) ? $ac['_id'] : '';
            $ac_title = isset($ac['ac_title']) ? $ac['ac_title'] : '';
            $ac_content_type = isset($ac['ac_content_type']) ? $ac['ac_content_type'] : 'text_editor';
            $ac_content = '';
            if($ac['ac_content_type'] == 'template'){
                if(!empty($ac['ac_content_template'])){
                    $content = Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$ac['ac_content_template']);
                    $ac_content = $content;
                }
            }elseif($ac['ac_content_type'] == 'text_editor'){
                $ac_content = $ac['ac_content'];
            }
             
            $title_key = $widget->get_repeater_setting_key( 'ac_title', 'ac_items', $key );
            $widget->add_render_attribute( $title_key, ['class' => [ 'ac-title d-flex align-items-center' ]] );
            $widget->add_inline_editing_attributes( $title_key, 'basic' );

            $content_key = $widget->get_repeater_setting_key( 'ac_content', 'ac_items', $key );
            $widget->add_render_attribute( $content_key, [
                'id' => $_id.$html_id,
                'class' => [ 'ac-content' ],
            ] );
            if($is_active){
                $widget->add_render_attribute( $content_key, 'style', 'display:block;' );
            }
            $widget->add_inline_editing_attributes( $content_key, 'basic' );

            $wrap_key = $widget->get_repeater_setting_key( 'ac_anm', 'ac_items', $key );
            $widget->add_render_attribute( $wrap_key, 'class', 'ac-item' );
            if($is_active){
                $widget->add_render_attribute( $wrap_key, 'class','active' );
            }

            $widget->add_render_attribute( $wrap_key, 'data-target', '#' . $_id.$html_id );

            ?>
            <div <?php pxl_print_html($widget->get_render_attribute_string( $wrap_key )); ?>> 
                <div class="ac-title-wrap">
                    <a <?php pxl_print_html($widget->get_render_attribute_string( $title_key )); ?>>
                        <span class="text"><?php echo wp_kses_post($ac_title); ?></span>
                        <span class="pxl-icon"></span>
                    </a>
                </div>
                <div <?php pxl_print_html($widget->get_render_attribute_string( $content_key )); ?>><?php pxl_print_html($ac_content); ?></div>
            </div>
        <?php
            endforeach;
        ?>
    </div>
<?php endif; ?>