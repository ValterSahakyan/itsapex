<?php
$settings = $widget->get_settings_for_display();

$sphere_size = isset($settings['sphere_size']['size']) ? $settings['sphere_size']['size'] : 400;
$sphere_radius = $sphere_size * 0.3;
$sphere_color = isset($settings['sphere_color']) ? $settings['sphere_color'] : '#2458F6';
$rotation_type2 = isset($settings['rotation_type2']) ? $settings['rotation_type2'] : 'y_axis';
$rotation_speed = isset($settings['rotation_speed']['size']) ? $settings['rotation_speed']['size'] : 0.005;
$custom_x_speed = isset($settings['custom_x_speed']['size']) ? $settings['custom_x_speed']['size'] : 0.003;
$custom_y_speed = isset($settings['custom_y_speed']['size']) ? $settings['custom_y_speed']['size'] : 0.005;
$tilt_angle = isset($settings['tilt_angle']['size']) ? $settings['tilt_angle']['size'] : -30;

// Generate a unique ID for the canvas
$canvas_id = 'sphereCanvas_' . uniqid();
?>

<div class="pxl-sphere layout-2" 
    data-size="<?php echo esc_attr($sphere_size); ?>"
    data-radius="<?php echo esc_attr($sphere_radius); ?>"
    data-color="<?php echo esc_attr($sphere_color); ?>"
    data-rotation="<?php echo esc_attr($rotation_type2); ?>"
    data-speed="<?php echo esc_attr($rotation_speed); ?>"
    data-xspeed="<?php echo esc_attr($custom_x_speed); ?>"
    data-yspeed="<?php echo esc_attr($custom_y_speed); ?>"
    data-tilt="<?php echo esc_attr($tilt_angle); ?>">
    <canvas id="<?php echo esc_attr($canvas_id); ?>"></canvas>
</div>

<style>
.pxl-sphere.layout-2 {
    width: <?php echo esc_attr($sphere_size); ?>px;
    height: <?php echo esc_attr($sphere_size); ?>px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: transparent;
    position: relative; /* Add position relative */
}

.pxl-sphere.layout-2 canvas {
    display: block;
    position: absolute; /* Ensure canvas is positioned correctly */
    top: 0;
    left: 0;
}
</style>