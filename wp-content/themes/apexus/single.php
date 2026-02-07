<?php
/**
 * @package Apexus
 */
get_header();
$pxl_sidebar = apexus()->get_sidebar_args(['type' => 'post']); // type: blog, post, page, shop, product
?>
<div class="container">
    <div class="<?php echo esc_attr($pxl_sidebar['wrap_class']) ?>">
        <div id="pxl-content-area" class="<?php echo esc_attr($pxl_sidebar['content_class']) ?>">
            <?php while (have_posts()) {
                the_post();
                get_template_part('template-parts/content-single', get_post_format());
            } ?>
        </div>
        <?php if ($pxl_sidebar['sidebar_class']) : ?>
            <div id="pxl-sidebar-area" class="<?php echo esc_attr($pxl_sidebar['sidebar_class']) ?> sidebar-sticky">
                <div class="sidebar-area-wrap sidebar-sticky-wrap">
                    <?php dynamic_sidebar( 'sidebar-single' ); ?>
                    <?php apexus()->blog->get_post_share(); ?> 
                </div>
            </div>
        <?php endif; ?>
    </div> 
</div>
<?php apexus()->blog->set_post_views(get_the_ID()); ?>
<?php get_footer();
