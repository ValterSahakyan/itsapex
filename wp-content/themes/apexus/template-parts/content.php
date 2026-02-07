<?php
/**
 * Template part for displaying posts in loop
 *
 * @package Apexus
 */
 
$archive_sticky_mark = apexus()->get_theme_opt( 'archive_sticky_mark', true );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('pxl-archive-post'); ?> >
    <?php if (has_post_thumbnail()) {
        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'medium'); 
        echo '<div class="archive-feature post-featured relative">'; ?>
            <a href="<?php echo esc_url( get_permalink()); ?>">
                <?php the_post_thumbnail('large'); ?>
            </a>
        <?php echo '</div>';
    } ?>

    <div class="post-content">
        <?php apexus()->blog->get_archive_category_meta(); ?>
        <h4 class="post-title">
            <a href="<?php echo esc_url( get_permalink()); ?>" title="<?php the_title_attribute(); ?>">
                <?php if(is_sticky() && $archive_sticky_mark) { ?>
                    <i class="pxli-thumbtack"></i>
                <?php } ?>
                <?php the_title(); ?>
            </a>
        </h4>
        <?php apexus()->page->get_link_pages(); ?>
        
    </div>
     
</article>