<?php
$settings = $widget->get_settings_for_display();

$sphere_size = isset($settings['sphere_size']['size']) ? $settings['sphere_size']['size'] : 400;
$sphere_color = isset($settings['sphere_color']) ? $settings['sphere_color'] : '#D7D7D7';
$rotation_speed = isset($settings['rotation_speed']['size']) ? $settings['rotation_speed']['size'] : 0.005;
$rotation_type = isset($settings['rotation_type']) ? $settings['rotation_type'] : 'y_axis';
$theme_dir = get_template_directory_uri();
// Generate a unique ID for the canvas
$canvas_id = 'sphereCanvas_' . uniqid();
?>

<div class="pxl-sphere layout-1" 
    data-size="<?php echo esc_attr($sphere_size); ?>"
    data-color="<?php echo esc_attr($sphere_color); ?>"
    data-rotation="<?php echo esc_attr($rotation_type); ?>"
    data-speed="<?php echo esc_attr($rotation_speed); ?>"
    data-img="<?php echo esc_url($theme_dir . '/elements/assets/imgs/Earth_sphere_line.webp'); ?>">
    <canvas id="<?php echo esc_attr($canvas_id); ?>"></canvas>
</div>

<style>
.pxl-sphere.layout-1 {
    width: <?php echo esc_attr($sphere_size); ?>px;
    height: <?php echo esc_attr($sphere_size); ?>px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: transparent;
    position: relative; /* Add position relative */
}

.pxl-sphere.layout-1 canvas {
    display: block;
    position: absolute; /* Ensure canvas is positioned correctly */
    top: 0;
    left: 0;
}
</style>