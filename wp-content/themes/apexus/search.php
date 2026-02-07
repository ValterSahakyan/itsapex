<?php
/**
 *
 * @package Apexus
 */
get_header();
$pxl_sidebar = apexus()->get_sidebar_args(['type' => 'blog']); // type: blog, post, page, shop, product

?>
<div class="container">
    <div class="<?php echo esc_attr($pxl_sidebar['wrap_class']) ?>">
        <div id="pxl-content-area" class="<?php echo esc_attr($pxl_sidebar['content_class']) ?>">
            <?php if ( have_posts() ): ?>
            <main id="pxl-content-main" class="pxl-content-main">
                <?php 
                    while ( have_posts() ) {
                        the_post();
                        get_template_part( 'template-parts/content','search' );
                    }
                ?>
            </main>
            <?php 
                apexus()->page->get_pagination();
            else:
                get_template_part( 'template-parts/content', 'none' );
            endif; ?>
        </div>
        <?php if ($pxl_sidebar['sidebar_class']) : ?>
            <div id="pxl-sidebar-area" class="<?php echo esc_attr($pxl_sidebar['sidebar_class']) ?>">
                <div class="sidebar-area-wrap">
                    <?php get_sidebar(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php get_footer();
