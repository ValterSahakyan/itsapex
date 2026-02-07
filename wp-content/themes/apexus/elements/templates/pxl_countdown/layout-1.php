<?php
extract($settings);
$time_to = $settings['time_to'];
$style_dot = (!empty($settings['style_dot']) && $settings['style_dot'] === 'yes') ? 'style-dot' : '';

?>
<div class="pxl-countdown layout-1">
    <div class="pxl-countdown-container font-smooth <?php pxl_print_html($style_dot); ?>" data-time="<?php echo esc_attr($time_to); ?>">
        <?php if($hidden_day) : ?>
        <div class="time-item">
            <div class="time-item-inner">
                <div class="day inner-number"></div>
                <div class="inner-text"><?php echo esc_html__('Days', 'apexus') ?></div>
            </div>
        </div>
        <?php endif; ?>
        <?php if($hidden_hours) : ?>
        <div class="time-item">
            <div class="time-item-inner">
                <div class="hour inner-number"></div>
                <div class="inner-text"><?php echo esc_html__('Hours', 'apexus') ?></div>
            </div>
        </div>
        <?php endif; ?>
        <?php if($hidden_minutes) : ?>
        <div class="time-item">
            <div class="time-item-inner">
                <div class="minute inner-number"></div>
                <div class="inner-text"><?php echo esc_html__('Minutes', 'apexus') ?></div>
            </div>
        </div>
        <?php endif; ?>
        <?php if($hidden_seconds) : ?>
        <div class="time-item">
            <div class="time-item-inner">
                <div class="second inner-number"></div>
                <div class="inner-text"><?php echo esc_html__('Seconds', 'apexus') ?></div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>