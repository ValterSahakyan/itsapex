<?php
/**
 * @package Apexus
 */

$pxl_the_excerpt = get_the_excerpt();
$excerpt_more = apexus()->blog->get_excerpt_more(55, get_the_ID());
$has_excerpt_cls = ( !empty($pxl_the_excerpt) || !empty($excerpt_more)) ? 'has-excerpt' : 'no-excerpt';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('pxl-archive-post search-results-post'); ?>>
    <div class="post-content <?php echo esc_attr($has_excerpt_cls) ?>">
        <h3 class="post-title"><a href="<?php echo esc_url( get_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
        <?php if( !empty($pxl_the_excerpt) || !empty($excerpt_more) ): ?>
            <div class="post-excerpt">
                <?php 
                if(!empty($pxl_the_excerpt)) {
                    echo wp_kses_post($pxl_the_excerpt);
                } else {
                    echo wp_kses_post( $excerpt_more );
                }
                ?>
                </div>
        <?php endif; ?>
        <?php apexus()->page->get_link_pages(); ?>
    </div>
</article>
