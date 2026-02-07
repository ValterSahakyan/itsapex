<?php
extract($settings);
if (!class_exists('Apexus_Page_Title')) return;

$titles = apexus()->pagetitle->get_title();
?>
<div class="pxl-pt-wrap d-flex">
    <div class="pxl-page-title-inner">
        <div class="pxl-page-title">
            <h1 class="main-title"><?php pxl_print_html($titles['title']) ?></h1>
            <?php if(!empty($titles['sub_title'])): ?>
                <div class="sub-title p"><?php echo apexus_html($titles['sub_title']) ?></div>
            <?php endif; ?>
        </div>
    </div> 
</div>