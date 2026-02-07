<?php
/**
 * Add child styles.
 */

function apexus_child_enqueue_styles(){
    $parent_style = 'apexus-style'; 
    wp_enqueue_style('apexus-style-child', get_stylesheet_directory_uri() . '/style.css', array(
        $parent_style
    ));
}
add_action( 'wp_enqueue_scripts', 'apexus_child_enqueue_styles', 99);