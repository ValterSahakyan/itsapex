<?php
$col_xs = $widget->get_setting('col_xs', '');
$col_sm = $widget->get_setting('col_sm', '');
$col_md = $widget->get_setting('col_md', '');
$col_lg = $widget->get_setting('col_lg', '');
$col_xl = $widget->get_setting('col_xl', '');

if($col_xl == 'auto') {
    $col_xl = 'auto';
} elseif ($col_xl == '5') {
    $col_xl = 'pxl5';
} else {
    $col_xl = 12 / intval($col_xl);
}

if($col_lg == 'auto') {
    $col_lg = 'auto';
} elseif ($col_lg == '5') {
    $col_lg = 'pxl5';
} else {
    $col_lg = 12 / intval($col_lg);
}

if($col_md == 'auto') {
    $col_md = 'col-md-auto';
} else {
    $col_md = 12 / intval($col_md);
}

if($col_sm == 'auto') {
    $col_sm = 'col-sm-auto';
} else {
    $col_sm = 12 / intval($col_sm);
}

if($col_xs == 'auto') {
    $col_xs = 'col-xs-auto';
} else {
    $col_xs = 12 / intval($col_xs);
}

$item_class = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
if(isset($settings['marquee']) && !empty($settings['marquee']) && count($settings['marquee'])): ?>
    <div class="pxl-logo-marquee1 layout-2">
        <div class="pxl-logo-active pxl-flex-middle">
            <?php foreach ($settings['marquee'] as $key => $value):
                $image_slide    = isset($value['image_slide']) ? $value['image_slide'] : [];
                $text = isset($value['text']) ? $value['text'] : '';
                $thumbnail = '';
                if(!empty($image_slide['id'])) {
                    $img = pxl_get_image_by_size( array(
                        'attach_id'  => $image_slide['id'],
                        'thumb_size' => 'full',
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                } 
                ?>
                <div class="pxl-item--marquee <?php echo esc_attr($item_class); ?>"
                    data-speed="<?php echo esc_attr($settings['pxl_animate_speed']); ?>" data-slip-type="<?php echo esc_attr($settings['slip_type']); ?>">
                    <div class="pxl-item--inner pxl-flex-middle">
                        <?php if(!empty($thumbnail)) : ?>
                            <div class="item-image">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($text)) { ?>
                            <h4 class="pxl-text--logo">
                                <?php pxl_print_html($text); ?>
                            </h4>
                        <?php } ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
