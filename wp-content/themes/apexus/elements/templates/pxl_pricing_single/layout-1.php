<?php

extract($settings);

if ( ! empty( $button_link['url'] ) ) {
    $widget->add_render_attribute( 'button', 'href', $button_link['url'] );

    if ( $button_link['is_external'] ) {
        $widget->add_render_attribute( 'button', 'target', '_blank' );
    }

    if ( $button_link['nofollow'] ) {
        $widget->add_render_attribute( 'button', 'rel', 'nofollow' );
    }
}
  
$button_text = !empty( $button_text ) ? $button_text : esc_html__( 'Get Started', 'apexus' );
?>
<div class="pxl-pricing-single layout-1 <?php echo esc_attr($item_highlight); ?>">
    <div class="inner-item">
        <?php if(!empty($brand)): 
            ?>
                <span class="brand"><?php pxl_print_html($brand); ?></span>
            <?php endif; ?>
        <div class="box-item">
            <?php if ( !empty( $settings['icon_pricing'] )) : ?> 
                <span class="icon-brand"><?php \Elementor\Icons_Manager::render_icon( $settings['icon_pricing'], [ 'aria-hidden' => 'true' ] ); ?></span>
            <?php endif; ?>
            <h4 class="pricing-title"><?php pxl_print_html($title); ?></h4>
            <?php if(!empty($desc)): ?>
                <div class="desc"><?php pxl_print_html($desc); ?></div>
            <?php endif; ?>
            <div class="pricing-price">
                <span class="currency"><?php pxl_print_html($price_currency) ?></span>
                <span class="value"><?php pxl_print_html($price_value); ?></span>
                <?php if(!empty($price_suffix)): ?><span class="price-suffix">/<?php pxl_print_html($price_suffix) ?></span><?php endif; ?>
            </div>
            <?php if(!empty($button_link['url'])) : ?>
                <div class="pricing-button">
                    <a class="btn pxl-btn btn-primary" <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?>>
                        <span class="pxl-button-text"><?php pxl_print_html($button_text); ?></span>
                    </a>
                </div>
            <?php endif; ?>
            <?php if(isset($settings['content_list']) && !empty($settings['content_list']) && count($settings['content_list'])): 
                
                ?>
                <ul class="pricing-feature list-item">
                    <?php 
                    $k = 0;
                    foreach ($settings['content_list'] as $key => $pxl_list): 
                        $k = $k + 50;
                        $active_cls = $pxl_list['active'] == 'yes' ? 'active' : 'no-active';
                        ?>
                        <li class="item-feature <?php echo esc_attr($active_cls) ?>">
                            <?php if ( !empty( $pxl_list['selected_icon'] )) : ?> 
                                <span class="pxl-icon"><?php \Elementor\Icons_Manager::render_icon( $pxl_list['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                            <?php endif; ?>
                            <div class="box-list"><span class="item-text"><?php pxl_print_html($pxl_list['content'])?></span><span class="item-text2"><?php pxl_print_html($pxl_list['description_active'])?></span></div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>