<?php
extract($settings);
?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list) > 0): ?>
    <div class="pxl-counter-list layout-<?php echo esc_attr($settings['layout'])?>">
        <?php foreach ($content_list as $key => $value):
            $prefix        = isset($value['prefix']) ? $value['prefix'] : '';
            $suffix        = isset($value['suffix']) ? $value['suffix'] : '';
            $title        = isset($value['title']) ? $value['title'] : '';
            $image       = isset($value['image']) ? $value['image'] : [];
            $thumbnail = '';
            if(!empty($image['id'])) {
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $image['id'],
                    'thumb_size' => '205x137',
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            }
            $duration = isset($value['duration']) && $value['duration'] !== '' ? $value['duration'] : $widget->get_setting('duration', 4);
            $ending_number = isset($value['ending_number'])
                ? $value['ending_number']
                : $widget->get_setting('ending_number', 0);
            $thousand_separator = ($value['thousand_separator'] ?? '') === 'yes' ? 'yes' : 'no';
            $thousand_separator_char = $value['thousand_separator_char'] ?? ',';
            $attr_key = 'counter-value-' . $key;

            $widget->add_render_attribute($attr_key, [
                'class'          => 'counter-number-value',
                'data-duration'  => $duration,
                'data-start'     => !empty($value['starting_number']) ? $value['starting_number'] : 0,
                'data-delimiter' => $thousand_separator,
                'data-delimiter-char' => $thousand_separator_char,
            ]);

            $is_active = ($active_list == $key + 1);
            ?>
            <div class="item-inner <?php echo esc_attr( $is_active ? 'active' : '' ); ?> elementor-repeater-item-<?php echo esc_attr($value['_id']); ?>">
                <div class="box-counter">
                    <div class="counter-number">
                        <?php if (!empty($prefix)) : ?>
                            <span class="counter-number-prefix"><?php pxl_print_html($prefix); ?></span>
                        <?php endif; ?>

                        <span <?php $widget->print_render_attribute_string($attr_key); ?>>
                            <?php echo esc_html($ending_number); ?>
                        </span>

                        <?php if (!empty($suffix)) : ?>
                            <span class="counter-number-suffix"><?php pxl_print_html($suffix); ?></span>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($title)) : ?>
                        <div class="counter-title p"><?php pxl_print_html(' ' . $title); ?></div>
                    <?php endif; ?>
                </div>
                <?php if(!empty($thumbnail)): ?>
                    <div class="item-image col-auto">
                        <?php pxl_print_html($thumbnail); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
