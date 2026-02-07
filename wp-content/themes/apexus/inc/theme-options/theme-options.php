<?php
add_action('after_setup_theme', 'apexus_setup_option', 1);
function apexus_setup_option(){
    if (!class_exists('ReduxFramework')) {
        return;
    }

        
    $opt_name = apexus()->get_option_name();
    $version = apexus()->get_version();

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => '', //$theme->get('Name'),
        // Name that appears at the top of your panel
        'display_version'      => $version,
        // Version that appears at the top of your panel
        'menu_type'            => 'submenu',  
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__('Theme Options', 'apexus'),
        'page_title'           => esc_html__('Theme Options', 'apexus'),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        'disable_google_fonts_link' => false,                    // Disable this in case you want to create your own google fonts loader
        'font_display'         => 'swap',
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => true,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
        'show_options_object' => false,
        // OPTIONAL -> Give you extra features
        'page_priority'        => 80,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'pxlart', 
        // For a full list of options, visit: //codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'pxlart-theme-options',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        ),
    );

    Redux::SetArgs($opt_name, $args);

    /*--------------------------------------------------------------
    # General
    --------------------------------------------------------------*/

    Redux::setSection($opt_name, array(
        'title'  => esc_html__('General', 'apexus'),
        'icon'   => 'el el-icon-home',
        'fields' => array(
            array(
                'id'       => 'favicon',
                'type'     => 'media',
                'title'    => esc_html__('Favicon', 'apexus'),
                'default' => ''
            ),
            array(
                'id'       => 'site_loader',
                'type'     => 'select',
                'title'    => esc_html__('Site Loader', 'apexus'),
                'options' => array(
                    '0'  => esc_html__('Off', 'apexus'),
                    '1'  => esc_html__('Upload Gif', 'apexus'),
                    '2' => esc_html__('Loading', 'apexus'),
                ), 
                'default' => '0',
            ),
            array(
                'id'       => 'loading_img',
                'type'     => 'media',
                'title'    => esc_html__('Loading icon image ', 'apexus'),
                'default' => array(
                    'url'=>''
                ),
                'required' => array( 'site_loader' , '=', '1' )
            ),
            array(
                'id'       => 'page_overlay_bg_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Page Overlay Background Color', 'apexus'),
                'subtitle' => esc_html__('Background color when open hidden panel.', 'apexus'),
                'output'   => array('background-color' => '.pxl-page-overlay')
            ),
            array(
                'id'       => 'enable_awesome_pro',
                'type'     => 'button_set',
                'title'    => esc_html__('Enable Font Awesome Pro', 'apexus'),
                'options'  => [
                    '1'  => esc_html__('Yes','apexus'),
                    '0'  => esc_html__('No','apexus'),
                ],
                'default'  => '0',
            ),
            array(
                'id'       => 'add_menu_location',
                'type'     => 'multi_text',
                'title'    => esc_html__('Add Extra Menu Location', 'apexus'),
                'subtitle' => esc_html__('Default is primary location', 'apexus'),
            ),
            array(
                'id'       => 'enable_menu_icons',
                'type'     => 'button_set',
                'title'    => esc_html__('Enable Menu Icons', 'apexus'),
                'subtitle' => esc_html__('Icon select will be show in menu item managerment', 'apexus'),
                'options'  => [
                    '1'  => esc_html__('Yes','apexus'),
                    '0'  => esc_html__('No','apexus'),
                ],
                'default'  => '0'
            ),
            array(
                'id'       => 'gsap_animation_toggle_actions',
                'type'     => 'select',
                'title'    => esc_html__( 'Gsap Animation Toggle Actions', 'apexus' ),
                'options' => array(
                    'play none none none'  => 'play none none reverse',
                    'play reverse play reverse'  => 'play reverse play reverse',
                    'play none none reverse' => 'play none none reverse',
                    'play none none reset' => 'play none none reset',
                ), 
                'default' => 'play none none none',
            ),
            array(
                'id'       => 'gsap_splittext_toggle_actions',
                'type'     => 'select',
                'title'    => esc_html__( 'Gsap Split Text Toggle Actions', 'apexus' ),
                'options' => array(
                    'play none none none'  => 'play none none reverse',
                    'play reverse play reverse'  => 'play reverse play reverse',
                    'play none none reverse' => 'play none none reverse',
                    'play none none reset' => 'play none none reset',
                ), 
                'default' => 'play none none none',
            ),
            array(
                'id'       => 'smoothscroll',
                'type'     => 'switch',
                'title'    => esc_html__('Smooth Scroll', 'apexus'),
                'default'  => false
            ),
            array(
                'id'       => 'dark_light_option',
                'type'     => 'button_set',
                'title'    => esc_html__('Dark Light Mode', 'apexus'),
                'options'  => [
                    ''  => esc_html__('Light Mode', 'apexus'),
                    'dark-mode'  => esc_html__('Dark Mode', 'apexus'),
                ],
                'subtitle' => esc_html__('Select Default Mode.', 'apexus'),
                'default'  => '',
            ),
        )
    ));

    /*--------------------------------------------------------------
    # Colors
    --------------------------------------------------------------*/

    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Colors', 'apexus'),
        'icon'   => 'el el-icon-file-edit',
        'fields' => array(
            array(
                'id'          => 'heading_color',
                'type'        => 'color',
                'title'       => esc_html__('Heading Color', 'apexus'),
                'transparent' => false,
                'default'     => '#0A0A0A'
            ), 
            array(
                'id'          => 'primary_color',
                'type'        => 'color',
                'title'       => esc_html__('Primary Color', 'apexus'),
                'transparent' => false,
                'default'     => '#FE5631'
            ), 
            array(
                'id'          => 'second_color',
                'type'        => 'color',
                'title'       => esc_html__('Secondary Color', 'apexus'),
                'transparent' => false,
                'default'     => '#2458F6'
            ),
            array(
                'id'          => 'third_color',
                'type'        => 'color',
                'title'       => esc_html__('Third Color', 'apexus'),
                'transparent' => false,
                'default'     => '#68758C'
            ),
            array(
                'id'      => 'link_color',
                'type'    => 'link_color',
                'title'   => esc_html__('Link Colors', 'apexus'),
                'default' => array(
                    'regular' => '#0A0A0A',
                    'hover'   => '#FE5631',
                    'active'  => '#FE5631'
                ),
                'output'  => array('a')
            ),
        )
    ));

    /*--------------------------------------------------------------
    # Header
    --------------------------------------------------------------*/

    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Header', 'apexus'),
        'icon'   => 'el el-icon-website',
        'fields' => array_merge(
            apexus_header_opts(),
            array(
                array(
                    'id'       => 'sticky_header_direction',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Sticky Direction Display', 'apexus'),
                    'options'  => array(
                        'scroll-down' => esc_html__('Scroll Down', 'apexus'),
                        'scroll-up' => esc_html__('Scroll Up', 'apexus'),
                        'scroll' => esc_html__('Scroll', 'apexus'),
                    ),
                    'default'  => 'scroll-down'
                ),
            )  
        )
    ));
    

    /*--------------------------------------------------------------
    # Page Title area
    --------------------------------------------------------------*/
    
    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Page Title', 'apexus'),
        'icon'   => 'el el-icon-map-marker',
        'fields' => array_merge(
            apexus_page_title_opts(),
            array(
                array(
                    'id'       => 'pt_bg_parallax',
                    'title'    => esc_html__('Parallax Background', 'apexus'),
                    'subtitle' => esc_html__('Scroll parallax effect', 'apexus'),
                    'type'     => 'switch',
                    'default'  => false,
                    'required' => array( 'pt_mode', '!=', 'none')
                ),
                array(
                    'id' => 'pt_parallax',
                    'type' => 'select',
                    'title' => esc_html__( 'Parallax Type', 'apexus' ),
                    'options' => [
                        ''        => esc_html__( 'None', 'apexus' ),
                        'x'       => esc_html__( 'Transform X', 'apexus' ),
                        'y'       => esc_html__( 'Transform Y', 'apexus' ),
                        'z'       => esc_html__( 'Transform Z', 'apexus' ),
                        'rotateX' => esc_html__( 'RotateX', 'apexus' ),
                        'rotateY' => esc_html__( 'RotateY', 'apexus' ),
                        'rotateZ' => esc_html__( 'RotateZ', 'apexus' ),
                        'scaleX'  => esc_html__( 'ScaleX', 'apexus' ),
                        'scaleY'  => esc_html__( 'ScaleY', 'apexus' ),
                        'scaleZ'  => esc_html__( 'ScaleZ', 'apexus' ),
                        'scale'   => esc_html__( 'Scale', 'apexus' ),
                    ],
                    'default' => '',
                    'required' => array( 'pt_bg_parallax', '=', true )
                ),
                array(
                    'id' => 'pt_parallax_value',
                    'title' => esc_html__('Parallax Value', 'apexus' ),
                    'type' => 'text',
                    'default' => '',
                    'required' => array( 'pt_parallax', '!=', '' )
                ),
                array(
                    'id'             => 'parallax_position',
                    'type'           => 'spacing',
                    'output'         => array('.pxl-page-title-bg'),
                    'mode'           => 'absolute',
                    'units'          => array('px'),
                    'units_extended' => 'false',
                    'title' => esc_html__('Parallax Position', 'apexus' ),
                    'default'            => array(
                        'top'     => '0', 
                        'right'   => '0', 
                        'bottom'  => '0', 
                        'left'    => '0',
                        'units'          => 'px', 
                    ),
                    'required' => array( 'pt_parallax', '!=', '' )
                )
            ) 
        )
    ));


    /*--------------------------------------------------------------
    # Footer
    --------------------------------------------------------------*/

    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Footer', 'apexus'),
        'icon'   => 'el el-website',
        'fields' => array_merge(
            apexus_footer_opts()
        )
        
    ));

    /*--------------------------------------------------------------
    # WordPress default content
    --------------------------------------------------------------*/
    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Content', 'apexus'),
        'icon'   => 'el el-icon-pencil',
        'fields' => array(
            array(
                'id'       => 'content_bg_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Background Color', 'apexus'),
                'subtitle' => esc_html__('Content background color.', 'apexus'),
                'output'   => array('background-color' => '.pxl-main')
            )
        )
    ));
    Redux::setSection($opt_name, array(
        'title' => esc_html__('Blog Archive', 'apexus'),
        'subsection' => true,
        'fields'     => array_merge(
            array(
                array(
                    'id'           => 'archive_custom_sub_title',
                    'type'         => 'textarea',
                    'title'        => esc_html__( 'Custom Sub title', 'apexus' ),
                    'subtitle'     => esc_html__( 'Add short description for blog page title', 'apexus' ),
                    'required' => array( 'pt_mode', '!=', 'none' )
                ),
                array(
                    'id'      => 'blog_custom_archive_link',
                    'type'    => 'select',
                    'title'   => esc_html__('Custom Archive Link Page', 'apexus'),
                    'options' => apexus_list_post('page', false),
                    'default' => '0'  
                )
            ),
            apexus_sidebar_pos_opts([ 'prefix' => 'blog_']),
            array(
                array(
                    'id'       => 'archive_date',
                    'title'    => esc_html__('Date', 'apexus'),
                    'subtitle' => esc_html__('Display the Date for each blog post.', 'apexus'),
                    'type'     => 'switch',
                    'default'  => true,
                ),
                array(
                    'id'       => 'archive_author',
                    'title'    => esc_html__('Author', 'apexus'),
                    'subtitle' => esc_html__('Display the Author for each blog post.', 'apexus'),
                    'type'     => 'switch',
                    'default'  => true,
                ),
                array(
                    'id'       => 'archive_category',
                    'title'    => esc_html__('Category', 'apexus'),
                    'subtitle' => esc_html__('Display the Category for each blog post.', 'apexus'),
                    'type'     => 'switch',
                    'default'  => false,
                ),
                array(
                    'id'       => 'archive_comment_count',
                    'title'    => esc_html__('Comment Count', 'apexus'),
                    'subtitle' => esc_html__('Display the Comment count for blog post.', 'apexus'),
                    'type'     => 'switch',
                    'default'  => true
                ),
                array(
                    'id'       => 'archive_readmore',
                    'title'    => esc_html__('Readmore Button', 'apexus'),
                    'subtitle' => esc_html__('Display the Readmore button for each blog post.', 'apexus'),
                    'type'     => 'switch',
                    'default'  => true,
                ),
                array(
                    'id'      => 'archive_readmore_text',
                    'type'    => 'text',
                    'title'   => esc_html__('Read More Text', 'apexus'),
                    'default' => '',
                    'subtitle' => esc_html__('Default: Read more', 'apexus'),
                    'required' => array('archive_readmore', '=', true)
                ),
                array(
                    'id'       => 'archive_sticky_mark',
                    'title'    => esc_html__('Show Sticky Mark Icon', 'apexus'),
                    'subtitle' => esc_html__('Display icon mark for post sticky', 'apexus'),
                    'type'     => 'switch',
                    'default'  => true,
                ),
            )
        )
    ));
    Redux::setSection($opt_name, array(
        'title'      => esc_html__('Single Post', 'apexus'),
        'subsection' => true,
        'fields'     => array_merge(
            array(
                array(
                    'id'       => 'post_remove_breadcrumb_category',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Remove Breadcrumb Category', 'apexus'),
                    'options' => array(
                        'yes'  => esc_html__('Yes', 'apexus'),
                        'no'  => esc_html__('No', 'apexus')
                    ),
                    'default' => 'no',
                    'required' => ['post_breadcrumb', '=', 'on']
                ),
            ),
            apexus_sidebar_pos_opts([ 'prefix' => 'post_']),
            array(            
                array(
                    'id'       => 'post_feature_image_on',
                    'title'    => esc_html__('Show Post featured', 'apexus'),
                    'subtitle' => esc_html__('Display post featured for single post.', 'apexus'),
                    'type'     => 'switch',
                    'default'  => '1',
                    'required' => ['post_layout', '=', '1']
                ),
                array(
                    'id'       => 'post_feature_image_type',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Feature Image Type', 'apexus'),
                    'subtitle' => esc_html__('Feature image Type on single post.', 'apexus'),
                    'options' => array(
                        'cropped'  => esc_html__('Cropped Image', 'apexus'),
                        'full'  => esc_html__('Full Image', 'apexus')
                    ),
                    'default' => 'cropped',
                    'required' => ['post_feature_image_on', '=', '1']
                ),
                array(
                    'id'       => 'post_author_summary',
                    'title'    => esc_html__('Author Summary', 'apexus'),
                    'subtitle' => esc_html__('Display on bottom of single post.', 'apexus'),
                    'type'     => 'switch',
                    'default'  => '0'
                ),
                array(
                    'id'       => 'post_social_share',
                    'title'    => esc_html__('Social Share', 'apexus'),
                    'subtitle' => esc_html__('Display the Social Share for single post.', 'apexus'),
                    'type'     => 'switch',
                    'default'  => '0',
                ),
                array(
                    'id'       => 'post_social_share_icon',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Select Social Share', 'apexus'),
                    'subtitle' => esc_html__('Show social share on single post.', 'apexus'),
                    'multi'    => '1',
                    'options' => array(
                        'facebook'  => esc_html__('Facebook', 'apexus'),
                        'twitter'   => esc_html__('Twitter', 'apexus'),
                        'linkedin'  => esc_html__('Linkedin', 'apexus'),
                        'pinterest' => esc_html__('Pinterest', 'apexus'),
                    ), 
                    'default' => array('facebook', 'twitter', 'linkedin', 'pinterest'),
                    'required' => ['post_social_share', 'equals', '1']
                ),

                array(
                    'id'       => 'post_related_on',
                    'title'    => esc_html__('Related Post', 'apexus'),
                    'subtitle' => esc_html__('Display the related for blog post.', 'apexus'),
                    'type'     => 'switch',
                    'default'  => '0',
                ),
                array(
                    'id'      => 'related_title',
                    'type'    => 'text',
                    'title'   => esc_html__('Relate Title', 'apexus'),
                    'default' => '',
                ),
                array(
                    'id'      => 'related_subtitle',
                    'type'    => 'text',
                    'title'   => esc_html__('Relate Subtitle', 'apexus'),
                    'default' => '',
                ),
            )
        )
    ));

    Redux::setSection($opt_name, array(
        'title'      => esc_html__('Portfolio', 'apexus'),
        'subsection' => true,
        'fields'     => array_merge(
            array(
                array(
                    'id'       => 'portfolio_slug',
                    'title'    => esc_html__('Portfolio Slug', 'apexus'),
                    'subtitle' => esc_html__('Enter Portfolio slug ', 'apexus'),
                    'type'     => 'text',
                    'default'  => ''
                ),
                array(
                    'id'       => 'portfolio_name',
                    'title'    => esc_html__('Portfolio Name', 'apexus'),
                    'subtitle' => esc_html__('Enter Portfolio name ', 'apexus'),
                    'type'     => 'text',
                    'default'  => ''
                ),
                array(
                    'id'       => 'portfolio_ptitle_bg',
                    'type'     => 'background',
                    'title'    => esc_html__('Page Title Background', 'apexus'),
                    'output'   => array('.post-type-archive-portfolio .pxl-pagetitle .pxl-page-title-bg, .single-portfolio .pxl-pagetitle .pxl-page-title-bg'),
                ),
                array(
                    'id'           => 'custom_portfolio_title',
                    'type'         => 'text',
                    'title'        => esc_html__( 'Custom Single Title', 'apexus' ),
                    'subtitle'     => esc_html__( 'Custom heading text page title', 'apexus' )
                ),
                array(
                    'id'           => 'custom_portfolio_subtitle',
                    'type'         => 'text',
                    'title'        => esc_html__( 'Custom Single Sub Title', 'apexus' ),
                    'subtitle'     => esc_html__( 'Custom subtitle text page title', 'apexus' )
                )
            )
        )
    ));

    Redux::setSection($opt_name, array(
        'title'      => esc_html__('Services', 'apexus'),
        'subsection' => true,
        'fields'     => array_merge(
            array(
                array(
                    'id'       => 'services_slug',
                    'title'    => esc_html__('Services Slug', 'apexus'),
                    'subtitle' => esc_html__('Enter Services slug ', 'apexus'),
                    'type'     => 'text',
                    'default'  => ''
                ),
                array(
                    'id'       => 'services_name',
                    'title'    => esc_html__('Services Name', 'apexus'),
                    'subtitle' => esc_html__('Enter Services name ', 'apexus'),
                    'type'     => 'text',
                    'default'  => ''
                ),
                array(
                    'id'           => 'custom_services_title',
                    'type'         => 'text',
                    'title'        => esc_html__( 'Custom Single Title', 'apexus' ),
                    'subtitle'     => esc_html__( 'Custom heading text page title', 'apexus' )
                ),
                array(
                    'id'           => 'custom_services_subtitle',
                    'type'         => 'text',
                    'title'        => esc_html__( 'Custom Single Sub Title', 'apexus' ),
                    'subtitle'     => esc_html__( 'Custom subtitle text page title', 'apexus' )
                )
            )
        )
    ));

    Redux::setSection($opt_name, array(
        'title'      => esc_html__('Career', 'apexus'),
        'subsection' => true,
        'fields'     => array_merge(
            array(
                array(
                    'id'       => 'career_slug',
                    'title'    => esc_html__('Career Slug', 'apexus'),
                    'subtitle' => esc_html__('Enter Career slug ', 'apexus'),
                    'type'     => 'text',
                    'default'  => ''
                ),
                array(
                    'id'       => 'career_name',
                    'title'    => esc_html__('Career Name', 'apexus'),
                    'subtitle' => esc_html__('Enter Career name ', 'apexus'),
                    'type'     => 'text',
                    'default'  => ''
                ),
                array(
                    'id'       => 'career_ptitle_bg',
                    'type'     => 'background',
                    'title'    => esc_html__('Page Title Background', 'apexus'),
                    'output'   => array('.post-type-archive-career .pxl-pagetitle .pxl-page-title-bg, .single-career .pxl-pagetitle .pxl-page-title-bg'),
                ),
                array(
                    'id'           => 'custom_career_title',
                    'type'         => 'text',
                    'title'        => esc_html__( 'Custom Single Title', 'apexus' ),
                    'subtitle'     => esc_html__( 'Custom heading text page title', 'apexus' )
                ),
                array(
                    'id'           => 'custom_career_subtitle',
                    'type'         => 'text',
                    'title'        => esc_html__( 'Custom Single Sub Title', 'apexus' ),
                    'subtitle'     => esc_html__( 'Custom subtitle text page title', 'apexus' )
                )
            )
        )
    ));
    
    Redux::setSection($opt_name, array(
        'title'      => esc_html__('404 Page', 'apexus'),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'      => 'template_404',
                'type'    => 'select',
                'title'   => esc_html__('Select 404 Page Template', 'apexus'),
                'desc'    => sprintf(esc_html__('Please create your template before choosing. %sClick Here%s','apexus'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=page' ) ) . '">','</a>'),
                'options' => apexus_list_post('page'),
                'default' => '' 
            )
        )
    ));
    
    /*--------------------------------------------------------------
    # Typography
    --------------------------------------------------------------*/
    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Typography', 'apexus'),
        'icon'   => 'el el-icon-text-width',
        'fields' => array(
            array(
                'id'          => 'font_body',
                'type'        => 'typography',
                'title'       => esc_html__('Body', 'apexus'),
                'google'      => true,
                'line-height' => true,
                'font-size'   => true,
                'text-align'  => false,
                'letter-spacing' => true,
                'units'       => 'px',
            ),
            array(
                'id'             => 'font_heading',
                'type'           => 'typography',
                'title'          => esc_html__('Heading', 'apexus'),
                'google'         => true,
                'line-height'    => true,
                'font-size'      => false,
                'text-align'     => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'units'          => 'em',
            ),
            array(
                'id'          => 'font_h1',
                'type'        => 'text',
                'title'       => esc_html__('H1 Font Size', 'apexus'),
                'default'     => '',
                'placeholder' => '64px'
            ),
            array(
                'id'          => 'font_h2',
                'type'        => 'text',
                'title'       => esc_html__('H2 Font Size', 'apexus'),
                'default'     => '',
                'placeholder' => '48px'
            ),
            array(
                'id'          => 'font_h3',
                'type'        => 'text',
                'title'       => esc_html__('H3 Font Size', 'apexus'),
                'default'     => '',
                'placeholder' => '40px'
            ),
            array(
                'id'          => 'font_h4',
                'type'        => 'text',
                'title'       => esc_html__('H4 Font Size', 'apexus'),
                'default'     => '',
                'placeholder' => '36px'
            ),
            array(
                'id'          => 'font_h5',
                'type'        => 'text',
                'title'       => esc_html__('H5 Font Size', 'apexus'),
                'default'     => '',
                'placeholder' => '32px'
            ),
            array(
                'id'          => 'font_h6',
                'type'        => 'text',
                'title'       => esc_html__('H6 Font Size', 'apexus'),
                'default'     => '',
                'placeholder' => '24px'
            ),
        )
    ));

}
