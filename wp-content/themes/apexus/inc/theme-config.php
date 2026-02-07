<?php
if(!function_exists('apexus_configs_options')){
    function apexus_configs_options($value = false){ 
        $body_font    = '\'Outfit\', sans-serif'; 
        $heading_font = '\'Outfit\', sans-serif';
        $configs = [
            'theme_colors' => [
                'primary'   => [
                    'title' => esc_html__('Primary', 'apexus').' ('.apexus()->get_opt('primary_color', '#FE5631').')', 
                    'value' => apexus()->get_opt('primary_color', '#FE5631')
                ],
                'second'   => [
                    'title' => esc_html__('Secondary', 'apexus').' ('.apexus()->get_opt('second_color', '#2458F6').')', 
                    'value' => apexus()->get_opt('second_color', '#2458F6')
                ], 
                'third'   => [
                    'title' => esc_html__('Third', 'apexus').' ('.apexus()->get_opt('third_color', '#68758C').')', 
                    'value' => apexus()->get_opt('third_color', '#68758C')
                ], 
                'body'     => [
                    'title' => esc_html__('Body', 'apexus').' ('.apexus()->get_opt('font_body', ['color' => '#A3A3A3'], 'color').')', 
                    'value' => apexus()->get_opt('font_body', ['color' => '#A3A3A3'],'color')
                ],
                'heading'     => [
                    'title' => esc_html__('Heading', 'apexus').' ('.apexus()->get_opt('heading_color', '#0A0A0A').')', 
                    'value' => apexus()->get_opt('heading_color', '#0A0A0A')
                ]
            ],
            'link' => [
                'color' => apexus()->get_opt('link_color', ['regular' => 'var(--heading-color)'],'regular'),
                'color-hover'   => apexus()->get_opt('link_color', ['hover' => '#FE5631'],'hover'),
                'color-active'  => apexus()->get_opt('link_color', ['active' => '#FE5631'],'active'),
            ],
            
            'body' => [
                'font-family'       => apexus()->get_theme_opt('font_body',['font-family' => $body_font], 'font-family'),
                'font-size'         => apexus()->get_theme_opt('font_body',['font-size' => '16px'], 'font-size'),
                'font-weight'       => apexus()->get_theme_opt('font_body',['font-weight' => 'normal'], 'font-weight'),
                'line-height'       => apexus()->get_theme_opt('font_body',['line-height' => '1.5'], 'line-height'),
                'letter-spacing'    => apexus()->get_theme_opt('font_body',['letter-spacing' => '0'], 'letter-spacing'),
            ],
            'content' => [
                'bg-color'       => apexus()->get_page_opt('content_bb_color','')
            ],
            'heading' => [
                'font-family'       => apexus()->get_theme_opt('font_heading',['font-family' => $heading_font], 'font-family'),
                'font-weight'       => apexus()->get_theme_opt('font_heading',['font-weight' => '500'], 'font-weight'),
                'text-transform'    => apexus()->get_theme_opt('font_heading',['text-transform' => 'none'], 'text-transform'),
                'line-height'       => apexus()->get_theme_opt('font_heading',['line-height' => '1'], 'line-height'),
                'letter-spacing'    => apexus()->get_theme_opt('font_heading',['letter-spacing' => '-1.92px'], 'letter-spacing'),
                'color-hover'       => 'var(--link-color)',
            ],
            'heading_font_size' => [
                'h1' => apexus()->get_theme_opt('font_h1','64px'),
                'h2' => apexus()->get_theme_opt('font_h2','48px'),
                'h3' => apexus()->get_theme_opt('font_h3','40px'),
                'h4' => apexus()->get_theme_opt('font_h4','36px'),
                'h5' => apexus()->get_theme_opt('font_h5','32px'),
                'h6' => apexus()->get_theme_opt('font_h6','24px')
            ], 
            'logo' => [
                'width' => apexus()->get_theme_opt('logo_size', ['width' => '116px', 'units' => 'px'])['width'],
                'mobile_width' => apexus()->get_theme_opt('logo_mobile_size', ['width' => '110px', 'units' => 'px'])['width'],
            ],
            'header' => [
                'height' => '134px' // use for default header
            ],
            'border' => [
                'color'          => 'rgba(25, 27, 29, 0.1)',
            ],
         
            // Menu Color
            'menu' => [
                'bg'             => '#fff',
                'regular'        => 'var(--heading-color)',
                'hover'          => 'var(--heading-color)',
                'active'         => 'var(--heading-color)',
                'font_size'      => '14px',
                'font_weight'    => 400,
                'letter_spacing' => '0px',
                'font_family'    => 'var(--heading-font-family)', 
            ] ,
            'submenu' => [
                'bg'            => '#FFFFFF',
                'shadow'        => '0px 10px 40px 0px rgba(27, 26, 26, 0.09)',
                'regular'       => '#0a0a0a',
                'hover'         => 'var(--primary-color)',
                'active'        => 'var(--primary-color)',
                'font_size'     => '14px',  
                'font_weight'   => 400,   
                'font_family'    => 'var(--heading-font-family)', 
                'item_bg'       => 'transparent',
                'item_bg_hover' => 'transparent'
            ],
            'mobile_menu' => [
                'regular'        => 'var(--link-color)',
                'hover'          => 'var(--primary-color)',
                'active'         => 'var(--primary-color)',
                'font_size'      => '14px',
                'font_weight'    => 400,
                'font_family'    => 'var(--heading-font-family)', 
                'item_bg'        => 'transparent',
                'item_bg_hover'  => 'transparent',
                'text_transform' => 'capitalize' 
            ],
            'mobile_submenu' => [
                'regular'       => '#0a0a0a',
                'hover'         => 'var(--heading-color)',
                'active'        => 'var(--heading-color)',
                'font_size'      => '14px', 
                'font_weight'    => 400, 
                'font_family'    => 'var(--heading-font-family)', 
                'item_bg'        => 'transparent',
                'item_bg_hover'  => 'transparent',
                'text_transform' => 'capitalize' 
            ],
            'button' => [
                'font-family'        => 'var(--heading-font-family)',
                'font-size'          => '16px',
                'font-weight'        => '500',
                'line-height'        => '1.5',  
                'color'              => '#FAFAFA',
                'letter-spacing'     => '0px',
                'padding'            => '12px 24px 12px 24px',
                'bg-color'           => 'var(--primary-color)',      
                'text-transform'     => 'none',
                'bg-color-hover'     => 'var(--default-color)',
                'color-hover'        => '#FAFAFA',
            ],            
        ];

        if(!$value)
            return $configs;
        else
            return $configs[$value];

    }
}
if(!function_exists('apexus_inline_styles')){
    function apexus_inline_styles() {  
        $options = apexus_configs_options();

        $body              = $options['body']; 
        $content           = $options['content']; 
        $theme_colors      = $options['theme_colors']; 
        $link_color        = $options['link']; 
        $heading           = $options['heading']; 
        $heading_font_size = $options['heading_font_size']; 
        $logo              = $options['logo']; 
         
        ob_start();
        echo ':root{';
            
            foreach ($theme_colors as $color => $value) {
                printf('--%1$s-color: %2$s;', str_replace('#', '',$color),  $value['value']);
            }
   
            foreach ($theme_colors as $color => $value) {
                printf('--%1$s-color-rgb: %2$s;', str_replace('#', '',$color),  apexus_hex_rgb($value['value']));
            }
            foreach ($link_color as $color => $value) {
                printf('--link-%1$s: %2$s;', $color, $value);
            } 
            foreach ($body as $key => $value) {
                printf('--body-%1$s: %2$s;', $key, $value);
            }
            foreach ($content as $key => $value) {
                printf('--content-%1$s: %2$s;', $key, $value);
            }
            foreach ($heading as $key => $value) {
                printf('--heading-%1$s: %2$s;', $key, $value);
            }
            foreach ($heading_font_size as $key => $value) {
                printf('--heading-font-size-%1$s: %2$s;', $key, $value);
            }
            foreach ($logo as $key => $value) {
                printf('--logo-%1$s: %2$s;', $key, $value);
            }
            

        echo '}';
        return ob_get_clean();
         
    }
}
 