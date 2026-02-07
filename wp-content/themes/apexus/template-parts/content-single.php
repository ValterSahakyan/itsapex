<?php
/**
 * Template part for displaying single post
 *
 * @package Apexus
 */

if(has_post_thumbnail()){
    $content_inner_cls = 'single-post-inner has-post-thumbnail';
    $meta_class    = ''; 
} else {
    $content_inner_cls = 'single-post-inner no-post-thumbnail';
    $meta_class = '';
}
 
if(class_exists('\Elementor\Plugin') && \Elementor\Plugin::$instance->documents->get( get_the_ID() )->is_built_with_elementor()){
    $post_content_classes = 'single-elementor-content';
} else {
    $post_content_classes = '';
}
$post_date = apexus()->get_theme_opt( 'post_date', true );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('pxl-single-post'); ?>>
    <div class="<?php echo esc_attr($content_inner_cls);?>">
        <div class="post-content">
            <div class="content-inner">
                <div class="content-inner clearfix <?php echo esc_attr($post_content_classes);?>"><?php
                    the_content();
                ?></div>
            </div> 
        </div> 
    </div>
    <?php apexus()->blog->get_related_post(); ?> 
</article>
