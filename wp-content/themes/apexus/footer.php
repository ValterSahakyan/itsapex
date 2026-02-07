<?php
/**
 * @package Apexus
 */
// $custom_cursor = apexus()->get_theme_opt( 'custom_cursor', false );
?>
</div><!-- #main -->
<?php apexus()->footer->getFooter(); ?>
</div>
<div class="pxl-page-overlay"><div class="pxl-cursor-icon"><span class="pxl-icon"></span></div></div>
<?php apexus_action('anchor_target');?>
<?php wp_footer(); ?>

<?php /* if ($custom_cursor) : ?>
	<div class="pxl-cursor-circle"></div>
<?php endif; */?>
</body>
</html>

