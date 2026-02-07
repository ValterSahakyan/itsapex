<?php
/**
 * @package Apexus
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="description" content="<?php esc_attr_e( 'Apexus - Web Design Agency Wordpress Theme', 'apexus' ) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php 
        $pxl_page_cls = apply_filters( 'pxl_page_class', 'pxl-page' ); 
        $pxl_main_cls = apply_filters( 'pxl_main_class', 'pxl-main' ); 
    ?>

    <div id="pxl-page" class="<?php echo esc_attr($pxl_page_cls) ?>">
        <?php apexus()->page->get_site_loader(); ?>
        <?php apexus()->header->getHeader(); ?>
        <?php apexus()->pagetitle->get_page_title(); ?>
        <div id="pxl-main" class="<?php echo esc_attr($pxl_main_cls) ?>">
