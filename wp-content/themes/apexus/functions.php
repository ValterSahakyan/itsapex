<?php
/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets.
 *
 * @package Apexus
 */
if( is_user_logged_in() ){
    define('THEME_DEV_MODE_ELEMENTS', true);
}

use Elementor\Plugin;

require_once get_template_directory() . '/inc/classes/class-main.php';

if (is_admin()) {
    require_once get_template_directory() . '/inc/admin/admin-init.php';
}
 
/**
 * Theme Require
 */
apexus()->require_folder('inc');
apexus()->require_folder('inc/classes');
apexus()->require_folder('inc/theme-options');
apexus()->require_folder('inc/widgets');
