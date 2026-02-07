<?php
/**
 * @package Apexus
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="pxl-entry-content clearfix">
        <?php the_content(); ?>
    </div> 
    <?php apexus()->page->get_link_pages(); ?>
</article> 
