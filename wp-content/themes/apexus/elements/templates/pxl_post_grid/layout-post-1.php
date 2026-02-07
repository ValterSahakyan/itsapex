<?php
$html_id = $settings['element_name'] . '-' . $settings['element_id'];
$tax = ['category'];
$select_post_by = $widget->get_setting('select_post_by', 'term_selected');
$source = $post_ids = $post_ids_unselected = [];


if($select_post_by === 'post_selected'){
    $post_ids = $widget->get_setting('source_'.$settings['post_type'].'_post_ids', '');
}else{
    $source  = $widget->get_setting('source_'.$settings['post_type'], '');
    $post_ids_unselected  = $widget->get_setting('source_'.$settings['post_type'].'_post_ids_unselected', '');
}
 
$orderby = $widget->get_setting('orderby', 'date');
$order = $widget->get_setting('order', 'desc');
$limit = $widget->get_setting('limit', 8);

$query_result = pxl_get_posts_of_grid('post', ['source' => $source, 'orderby' => $orderby, 'order' => $order, 'limit' => $limit, 'post_ids' => $post_ids, 'post_not_in' => $post_ids_unselected ], $tax);
extract($query_result);
 
$post_type            = $widget->get_setting('post_type','post');
$layout               = $widget->get_setting('layout_'.$post_type, 'post-1');

$filter               = $widget->get_setting('filter', 'false');

$filter_default_title = $widget->get_setting('filter_default_title', 'All');

$pagination_type      = $widget->get_setting('pagination_type', 'pagination');
  
$load_more = array(
    'tax'                     => $tax,
    'post_type'               => $post_type,   
    'layout'                  => $layout,
    'select_post_by'          => $select_post_by,

    'filter'                  => $filter,

    'startPage'               => $paged,
    'maxPages'                => $max,
    'total'                   => $total,
    'perpage'                 => $limit,
    'nextLink'                => $next_link,
    'source'                  => $source,
    'post_ids'                => $post_ids,
    'orderby'                 => $orderby,
    'order'                   => $order,
    'limit'                   => $limit,
    'img_size'                => $widget->get_setting('img_size','306x220'),  
    'show_category'            => $widget->get_setting('show_category'),
    'post_not_in'             => $post_ids_unselected,
    'pagination_type'         => $pagination_type,
);

$wrap_attrs = [
    'id'               => $html_id,
    'class'            => trim('pxl-grid pxl-post-grid layout-'.$layout),

    'data-start-page'  => $paged,
    'data-max-pages'   => $max,
    'data-total'       => $total,
    'data-perpage'     => $limit,
    'data-next-link'   => $next_link
];

$wrap_attrs['data-loadmore'] = json_encode($load_more);
  
$widget->add_render_attribute( 'wrapper', $wrap_attrs );
   
if( count($posts) <= 0){
    echo '<div class="pxl-no-post-grid">'.esc_html__( 'No Post Found', 'apexus' ). '</div>';
    return;
}
?>

<div <?php pxl_print_html($widget->get_render_attribute_string( 'wrapper' )) ?>>
    <div class="pxl-grid-overlay"></div>
    <?php if ($select_post_by === 'term_selected' && $filter == "true"): ?>
        <div class="grid-filter-wrap d-flex-wrap">
            <span class="filter-item active" data-filter="*"><?php echo esc_html($filter_default_title); ?></span>
            <?php foreach ($categories as $category): ?>
                <?php $category_arr = explode('|', $category); ?>
                <?php $term = get_term_by('slug',$category_arr[0], $category_arr[1]); ?>

                <span class="filter-item" data-filter="<?php echo esc_attr('.' . $term->slug); ?>">
                    <?php echo esc_html($term->name); ?>
                </span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="pxl-grid-inner pxl-grid-masonry row relative"> 
        <?php apexus_get_post_grid($posts, $load_more); ?>
    </div>
     
    <?php if ($pagination_type == 'pagination') { ?>
        <div class="pxl-grid-pagination pagin-post d-flex">
            <?php apexus()->page->get_pagination($query, true); ?>
        </div>
    <?php } ?>
    <?php if (!empty($next_link) && $pagination_type == 'loadmore'): 

        ?>
        <div class="pxl-load-more d-flex" data-loading-text="<?php echo esc_attr__('Loading', 'apexus') ?>" data-loadmore-text="<?php echo esc_html($settings['loadmore_text']); ?>">
            <span class="pxl-btn btn-grid-loadmore btn-primary <?php //echo esc_attr($icon_pos)?>">
                <span class="btn-text pxl-button-text"><?php echo esc_html($settings['loadmore_text']); ?></span>
                <?php 
                if(!empty($settings['loadmore_icon']['value'])){   
                    echo '<span class="pxl-icon">';
                        \Elementor\Icons_Manager::render_icon( $settings['loadmore_icon'], [ 'aria-hidden' => 'true']); 
                    echo '</span>';
                }
                ?>
                <span class="pxl-btn-icon pxli-spinner"></span>
            </span>
        </div>
    <?php endif; ?>
</div>