<?php
/**
 * @package Apexus
 */
get_header();
?>
<?php 
 
if ( class_exists('\Elementor\Plugin') && \Elementor\Plugin::$instance->documents->get( get_the_ID() )->is_built_with_elementor() ) {
    $classes = 'elementor-container pxl-page-content';
} else {
    $classes = 'container';
}
 
?>
<div class="<?php echo esc_attr($classes);?> pxl-content-container">
    <div class="row">
        <div id="pxl-content-area" class="col-12">
            <main id="pxl-content-main" class="pxl-content-main">
                <?php while ( have_posts() ) {
                    the_post();
                    get_template_part( 'template-parts/content-single','services' );
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
                } ?>
            </main>
        </div>
    </div>
</div>
<?php get_footer();
