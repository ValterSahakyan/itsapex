<?php
use Elementor\Embed;
$img_classes = [];

if (empty($settings['video_link']['url']) || $settings['video_link']['url'] === null) return;
 
$lightbox_id = isset($settings['_id']) ? $settings['_id'] : $settings['element_id'];

$video_atts = $embed_options = [];
$classes = ['pxl-video-lightbox'];
$embed_params = [
    'loop' => '0',
    'controls' => '1',
    'mute' => '0',
    'rel' => '0',
    'modestbranding' => '0'
];
 
$video_atts[] = 'class="' . implode(' ', $classes) . '"';
$video_atts[] = 'data-elementor-open-lightbox="yes"';
$video_atts[] = 'data-elementor-lightbox="' . esc_attr(json_encode([
    'type' => 'video',
    'videoType' => 'youtube',
    'url' => Embed::get_embed_url($settings['video_link']['url'], $embed_params, $embed_options),
    'modalOptions' => [
        'id' => 'pxl-lightbox-' . $lightbox_id,
        'entranceAnimation' => 'fadeInUp',
        'entranceAnimation_tablet' => '',
        'entranceAnimation_mobile' => '',
        'videoAspectRatio' => '169'
    ]
])).'"';

$video_bt_style = !empty( $settings['video_bt_style']) ? $settings['video_bt_style'] : '';
$bg_cls = '';

$widget->add_render_attribute( 'pxl_video_wrap', 'class', ['pxl-video-player relative', $bg_cls, 'btn-style-'.$video_bt_style, 'layout-'.$settings['layout']]);

if(!empty($settings['pxl_bg_parallax'])){
    $widget->add_render_attribute( 'pxl_video_wrap', 'class', 'pxl-bg-parallax pxl-pll-'.$settings['pxl_bg_parallax']); 
}
if(!empty($settings['pxl_bg_parallax']) && $settings['pxl_bg_parallax'] == 'transform-mouse-move'){
    $widget->add_render_attribute( 'pxl_video_wrap', 'class', 'pxl-parallax-background'); 
}
 
$show_parallax = ( (isset($settings['bg_type']) && ($settings['bg_type'] == 'background' || $settings['bg_type'] == 'background-only')) || (isset($settings['bg_type_tablet_extra']) && $settings['bg_type_tablet_extra'] == 'background') || (isset($settings['bg_type_tablet']) && $settings['bg_type_tablet'] == 'true') || (isset($settings['bg_type_mobile_extra']) && $settings['bg_type_mobile_extra'] == 'true') || (isset($settings['bg_type_mobile']) && $settings['bg_type_mobile'] == 'true')) ? true : false;

if ( ! empty( $hover_animation ) ) {
        $widget->add_render_attribute( 'icon-wrapper', 'class', 'elementor-animation-' . $hover_animation );
    } 
?>
<div <?php pxl_print_html($widget->get_render_attribute_string( 'pxl_video_wrap' )); ?>>
    <div <?php echo implode(' ', $video_atts); ?>>
        <div class="btn-video-wrap d-flex-wrap">
            <div class="pxl-video-btn <?php echo !empty($settings['video_btn_hover_animation']) ? 'elementor-animation-'.$settings['video_btn_hover_animation'] : ''; ?>">
                <?php if(! empty( $settings['selected_icon']['value'] )): ?>
                    <?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true', 'class' => 'pxl-icon' ], 'span' );?>
                <?php else: ?>
                    <span class="pxl-icon pxli-play"></span>
                <?php endif; ?>
            </div>
            <?php if(!empty( $settings['video_text'] )): ?>
                <span class="video-text"><?php pxl_print_html($settings['video_text']) ?></span>
            <?php endif; ?>
            <?php
                if (strpos($widget->get_render_attribute_string('pxl_video_wrap'), 'style-2') !== false) {
                    echo '<svg viewBox="0 0 200 100" class="curved-text">
                        <path id="curve" d="M 20,80 A 80,80 0 0,1 180,80" fill="transparent"/>
                        <text>
                            <textPath href="#curve" startOffset="50%" text-anchor="middle">';
                                pxl_print_html($settings['video_text']);
                    echo '    </textPath>
                        </text>
                    </svg>';
                }
            ?>
        </div>
    </div>
</div>