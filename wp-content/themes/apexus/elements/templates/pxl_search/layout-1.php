<?php 
extract($settings); 
?>
<div class="pxl-search-wrap-wg layout-<?php echo esc_attr($layout) ?>">
    <form method="get" class="pxl-search-form relative" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="search" class="pxl-search-field" placeholder="<?php echo esc_attr( $settings['placeholder']); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off"/>
        <button type="submit" class="pxl-search-submit" value=""><span class="pxl-icon pxli-search"></span></button>
        <?php if( $search_type == 'product'): ?>
            <input type="hidden" name="post_type" value="product">
        <?php endif; ?>
    </form>
</div>
 
 

 