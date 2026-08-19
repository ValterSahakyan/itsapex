<?php
/**
 * @Template: class-mage-menu-edit.php
 * @since: 1.0.0
 * @author: PixelArt Team
 */
if (!defined('ABSPATH')) {
    die();
}

use Elementor\Icons_Manager;

class PXL_Mega_Menu_Edit_Walker extends Walker_Nav_Menu_Edit
{
    protected $mega_locations;

    function __construct()
    {
 
        $this->megamenus = get_posts(array(
            'post_type' => 'pxl-template',
            'posts_per_page' => '-1',
            'meta_query' => array(
                array(
                    'key'       => 'template_type',
                    'value'     => 'mega-menu',
                    'compare'   => '='
                )
            )
        ));

        $this->walker_args = array(
            'depth' => 0,
            'child_of' => 0,
            'selected' => 0,
            'value_field' => 'ID'
        );

        $this->pages = get_posts(array(
            'post_type' => 'pxl-template',
            'posts_per_page' => '-1',
            'meta_query' => array(
                array(
                    'key'       => 'template_type',
                    'value'     => 'hidden-panel',
                    'compare'   => '='
                )
            )
        ));

        $this->walker_args_page = array(
            'depth' => 0,
            'child_of' => 0,
            'selected' => 0,
            'value_field' => 'ID'
        );
 
    }

    /**
     * Start the element output.
     *
     * @see Walker_Nav_Menu::start_el()
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $item_output = '';
        parent::start_el($item_output, $item, $depth, $args, $id);

        // Adding new Fields
        $item_output = str_replace('<fieldset class="field-move', $this->get_fields($item, $depth, $args, $id) . '<fieldset class="field-move', $item_output);

        $output .= $item_output;
    }

    function get_fields($item, $depth = 0, $args = array(), $id = 0)
    {
        $enable_megamenu = apply_filters('pxl_enable_megamenu', false);
        $enable_pagepopup = apply_filters('pxl_enable_pagepopup', false);
        $enable_ongpage_option = apply_filters('pxl_enable_onepage', true);
        $enable_menu_icons = apply_filters('pxl_enable_menu_icons', true); 
        $this->mega_locations = apply_filters('pxl_locations', array('primary'));
        $check_mega = true;
        $nav_menu_selected_id = isset($_REQUEST['menu']) ? (int)$_REQUEST['menu'] : intval(get_user_option('nav_menu_recently_edited'));
        $locations = get_registered_nav_menus();
        $menu_locations = get_nav_menu_locations();
        $key = array_search($nav_menu_selected_id, $menu_locations, true);
        if (in_array($nav_menu_selected_id, $menu_locations) && isset($locations[$key]) && in_array($key, $this->mega_locations)) {
            $check_mega = true;
        }
        ob_start();
        $item_id = esc_attr($item->ID);
        ?>

    <?php if (0 === $depth && $check_mega && $enable_megamenu === true) : ?>
        <p class="description description-wide">
            <label for="edit-menu-item-pxl-megaprofile-<?php echo esc_attr($item_id); ?>">
                <?php esc_html_e('Select Mega Menu', PXL_TEXT_DOMAIN); ?><br/>
                <select id="edit-menu-item-pxl-megaprofile-<?php echo esc_attr($item_id); ?>" class="widefat"
                        name="menu-item-pxl-megaprofile[<?php echo esc_attr($item_id); ?>]">
                    <option value="0"><?php esc_html_e('None', PXL_TEXT_DOMAIN) ?></option>
                    <?php
                    $r = $this->walker_args;
                    $r['selected'] = $item->pxl_megaprofile;
                    echo walk_page_dropdown_tree($this->megamenus, $r['depth'], $r);
                    ?>
                </select>
            </label>
        </p>
    <?php endif; ?>

    <?php if (0 === $depth && $enable_pagepopup === true) : ?>
        <p class="description description-wide">
            <label for="edit-menu-item-pxl-page-popup-<?php echo esc_attr($item_id); ?>">
                <?php esc_html_e('Select Page Popup', PXL_TEXT_DOMAIN); ?><br/>
                <select id="edit-menu-item-pxl-page-popup-<?php echo esc_attr($item_id); ?>" class="widefat"
                        name="menu-item-pxl-page-popup[<?php echo esc_attr($item_id); ?>]">
                    <option value="0"><?php esc_html_e('None', PXL_TEXT_DOMAIN) ?></option>
                    <?php
                    $r = $this->walker_args_page;
                    $r['selected'] = $item->pxl_page_popup;
                    echo walk_page_dropdown_tree($this->pages, $r['depth'], $r);
                    ?>
                </select>
            </label>
        </p>
    <?php endif; ?>
    <p class="description description-wide menu-item-pxl-svg-icon">
        <label><?php esc_html_e( 'Menu SVG Icon', PXL_TEXT_DOMAIN ); ?></label>
        <span class="pxl-svg-preview">
            <?php
            $svg_id = get_post_meta( $item_id, '_menu_item_pxl_svg', true );
            if ( $svg_id ) {
                echo file_get_contents( get_attached_file( $svg_id ) );
            }
            ?>
        </span>
        <input type="hidden" class="pxl-menu-svg-id" name="menu-item-pxl-svg[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $svg_id ); ?>" />
        <button class="button pxl-upload-svg"><?php esc_html_e( 'Upload SVG', PXL_TEXT_DOMAIN ); ?></button>
        <button class="button pxl-remove-svg <?php echo get_post_meta( $item_id, '_menu_item_pxl_svg', true ) ? '' : 'hidden'; ?>"><?php esc_html_e( 'Remove', PXL_TEXT_DOMAIN ); ?></button>
        
    </p>
    <?php if ($enable_menu_icons): ?>
        <p class="description description-wide">
            <label for="edit-menu-item-pxl-icon-<?php echo esc_attr($item_id); ?>">
                <?php esc_html_e('Icon', PXL_TEXT_DOMAIN); ?><br/>
                <select id="edit-menu-item-pxl-icon-<?php echo esc_attr($item_id); ?>"
                        class="widefat pxl-icon-picker"
                        name="menu-item-pxl-icon[<?php echo esc_attr($item_id); ?>]">
                    <option value="" <?php selected('', esc_attr($item->pxl_icon)) ?>><?php esc_html_e('No Icons', PXL_TEXT_DOMAIN) ?></option>
                    <?php $arr = $this->pxl_iconpicker_fontawesome(); 
                    foreach ($arr as $group => $icons) { ?>
                        <optgroup label="<?php echo esc_attr($group); ?>">
                            <?php foreach ($icons as $key => $label) {
                                $class_key = key($label); ?>
                                <option value="<?php echo esc_attr($class_key); ?>" <?php selected($class_key, esc_attr($item->pxl_icon)) ?>><?php echo esc_html(current($label)); ?></option>
                            <?php } ?>
                        </optgroup>
                    <?php } ?>
                </select>
            </label>
        </p>
    <?php endif; ?>

    <?php if ($enable_ongpage_option && 0 === $depth) : ?>
        <p class="description description-wide">
            <label for="menu-item-pxl-onepage-<?php echo esc_attr($item_id); ?>">
                <?php esc_html_e('One Page', PXL_TEXT_DOMAIN); ?><br/>
                <select id="menu-item-pxl-onepage-<?php echo esc_attr($item_id); ?>"
                        class="widefat menu-item-pxl-onepage"
                        name="menu-item-pxl-onepage[<?php echo esc_attr($item_id); ?>]">
                    <option value="no-one-page" <?php selected(esc_attr($item->pxl_onepage), 'no-one-page') ?>><?php esc_html_e('No', PXL_TEXT_DOMAIN) ?></option>
                    <option value="is-one-page" <?php selected(esc_attr($item->pxl_onepage), 'is-one-page') ?>><?php esc_html_e('Yes', PXL_TEXT_DOMAIN) ?></option>
                </select>
            </label>
        </p>
        <p class="description description-wide">
            <label for="menu-item-pxl-onepage-offset-<?php echo esc_attr($item_id); ?>">
                <?php esc_html_e('One Page Offset', PXL_TEXT_DOMAIN); ?><br/>
                <input type="number" min="0" id="menu-item-pxl-onepage-offset-<?php echo esc_attr($item_id); ?>"
                        class="widefat menu-item-pxl-onepage-offset"
                        name="menu-item-pxl-onepage-offset[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item->pxl_onepage_offset); ?>" />
            </label>
        </p>
    <?php endif;
        global $extra_menu_custom;
        if (!empty($extra_menu_custom)) {
            foreach ($extra_menu_custom as $key => $fields) {
                $fields["allow_primary"] = isset($fields["allow_primary"]) ? $fields["allow_primary"] : true;
                if (in_array($depth, $fields['lever_support']) && (($check_mega === true && $fields["allow_primary"] === true) || $fields["allow_primary"] === false)):
                    ?>
                    <p class="description description-wide">
                        <label for="menu-item-<?php echo esc_attr($key) ?>-<?php echo esc_attr($item_id); ?>">
                            <?php echo esc_attr($fields['label']) ?><br/>
                            <select id="menu-item-<?php echo esc_attr($key) ?>-<?php echo esc_attr($item_id); ?>"
                                    class="widefat menu-item-<?php echo esc_attr($key) ?>"
                                    name="menu-item-<?php echo esc_attr($key) ?>[<?php echo esc_attr($item_id); ?>]">
                                <?php
                                foreach ($fields["options"] as $val => $text) {
                                    ?>
                                    <option value="<?php echo esc_attr($val) ?>" <?php selected(esc_attr($item->$key), $val) ?>><?php echo esc_attr($text) ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </label>
                    </p>
                <?php
                endif;
            }
        }

        ?>
        <script>
            jQuery('.pxl-icon-picker').fontIconPicker();
        </script>

        <?php
        return ob_get_clean();
    }

    function pxl_iconpicker_fontawesome()
    {
        global $wp_filesystem;
        $icons = array();
        if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( 'Elementor\Plugin::instance' ) ) {
     
            /*$initial_tabs = [
                'fa-regular' => [
                    'name' => 'fa-regular',
                    'label' => esc_html__( 'Font Awesome - Regular', PXL_TEXT_DOMAIN ),
                    'url' => ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/regular.min.css',
                    'enqueue' => [ ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/fontawesome.min.css' ],
                    'prefix' => 'fa-',
                    'displayPrefix' => 'far',
                    'labelIcon' => 'fab fa-font-awesome-alt',
                    'ver' => '5.15.3',
                    'fetchJson' => ELEMENTOR_ASSETS_PATH . 'lib/font-awesome/js/regular.js',
                    'native' => true,
                ],
                'fa-solid' => [
                    'name' => 'fa-solid',
                    'label' => esc_html__( 'Font Awesome - Solid', PXL_TEXT_DOMAIN ),
                    'url' => ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/solid.min.css',
                    'enqueue' => [ ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/fontawesome.min.css' ],
                    'prefix' => 'fa-',
                    'displayPrefix' => 'fas',
                    'labelIcon' => 'fab fa-font-awesome',
                    'ver' => '5.15.3',
                    'fetchJson' => ELEMENTOR_ASSETS_PATH . 'lib/font-awesome/js/solid.js',
                    'native' => true,
                ],
                'fa-brands' => [
                    'name' => 'fa-brands',
                    'label' => esc_html__( 'Font Awesome - Brands', PXL_TEXT_DOMAIN ),
                    'url' => ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/brands.min.css',
                    'enqueue' => [ ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/fontawesome.min.css' ],
                    'prefix' => 'fa-',
                    'displayPrefix' => 'fab',
                    'labelIcon' => 'fab fa-font-awesome-flag',
                    'ver' => '5.15.3',
                    'fetchJson' => ELEMENTOR_ASSETS_PATH . 'lib/font-awesome/js/brands.js',
                    'native' => true,
                ],
            ];*/
            $icons_tabs = Icons_Manager::get_icon_manager_tabs();
            //$icons_tabs = array_merge($icons_tabs, $initial_tabs);
            
            //$awesome_pro_support = apply_filters( 'pxl_support_awesome_pro', false );
            
            $theme_url = get_template_directory_uri();

            foreach ($icons_tabs as $key => $value) {
                
                if(strpos($value['fetchJson'], $theme_url) !== false )
                    $value['fetchJson'] = str_replace($theme_url,get_template_directory(),$value['fetchJson']);
                 
                $fetchJson = $value['fetchJson']; 
               
                $file_content = '';   
                /*$opts = array(
                    'ssl'=>array(
                        'verify_peer'=>false,
                        'verify_peer_name'=>false,
                    )
                );
                $context = stream_context_create($opts);*/
                
                if(!empty($fetchJson) ){
                    $file_content = json_decode( $wp_filesystem->get_contents( $fetchJson ), true); 
                    //$file_content = json_decode( @file_get_contents($fetchJson, false, $context), true);
                }
                 
                if(empty($file_content)) continue;

                $icon_arr = [];  
                foreach ($file_content['icons'] as $ico) {
                    if(!empty($ico)){  
                        $icon_arr[] = [ $value['displayPrefix'].' '.$value['prefix'].$ico => str_replace(['-','_'], ' ', $ico)]  ;
                    }
                     
                }
                $icons[$value['label']] = $icon_arr;
            }
        }
        $icons = apply_filters("pxl_mega_menu/get_icons", $icons);

        return $icons;
    }
}