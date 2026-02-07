<?php
if ( ! class_exists( 'ReduxFrameworkInstances' ) ) {
	return;
}
 
class Apexus_CSS_Generator {
	/**
     * @access protected
     * @var scssc
     */
    protected $scssc = null;

    /**
     * ReduxFramework class instance
     *
     * @access protected
     * @var ReduxFramework
     */
    protected $redux = null;

    /**
     * Debug mode is turn on or not
     *
     * @access protected
     * @var boolean
     */
    protected $dev_mode = true;

    /**
     * opt_name of ReduxFramework
     *
     * @access protected
     * @var string
     */
    protected $opt_name = '';

	function __construct() {
		$this->opt_name = apexus()->get_option_name();  
		if ( empty( $this->opt_name ) ) {
			return;
		}
		$this->dev_mode = (defined('THEME_DEV_MODE_SCSS') && THEME_DEV_MODE_SCSS);  
 
        add_filter( 'pxl_scssc_lib', function(){ return 'new';} );
		add_filter( 'pxl_scssc_on', '__return_true' );
		add_action( 'init', array( $this, 'init' ) );
	}

	function init() {

		if ( ! class_exists( '\ScssPhp\ScssPhp\Compiler' ) ) {
			return;
		}

		$this->redux = ReduxFrameworkInstances::get_instance( $this->opt_name );

		if ( empty( $this->redux ) || ! $this->redux instanceof ReduxFramework ) {
			return;
		}
		add_action( 'wp', array( $this, 'generate_with_dev_mode' ) );
		add_action( "redux/options/{$this->opt_name}/saved", function () {
            $this->generate_file_options();
		} );
	}

	function generate_with_dev_mode() {    
        $this->generate_file_grid();
		if ( $this->dev_mode === true ) {
			$this->generate_file_options();
            $this->generate_file();
            $this->generate_min_file();
		}
	}

    function generate_file_grid() { return; // for dev
        $css_dir  = get_template_directory() . '/assets/css/';
        $this->scssc = new \ScssPhp\ScssPhp\Compiler();
        $this->scssc->setImportPaths( $scss_dir );
        $css_file_grid = $css_dir . 'grid.css';

        $this->scssc->setOutputStyle('expanded');

        $result = $this->scssc->compileString( '@import "_bootstrap/bootstrap-grid.scss;"' );

        $this->redux->filesystem->execute( 'put_contents', $css_file_grid, array(
            'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $result->getCss() )
        ) );

    }

    function generate_file_options() {
        $scss_dir = get_template_directory() . '/assets/scss/';
        $_options = $scss_dir . '_options.scss';
        $this->redux->filesystem->execute( 'put_contents', $_options, array(
            'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->get_options_output() )
        ) );
    }

	function generate_file() {
		$scss_dir = get_template_directory() . '/assets/scss/';
		$css_dir  = get_template_directory() . '/assets/css/';

        $this->scssc = new \ScssPhp\ScssPhp\Compiler();
        $this->scssc->setImportPaths( $scss_dir );

		
		$css_file = $css_dir . 'style.css';
        $css_map_file = $css_dir . 'style.map';
         
        $this->scssc->setOutputStyle('expanded');
  
        $this->scssc->setSourceMap(\ScssPhp\ScssPhp\Compiler::SOURCE_MAP_FILE);
        $this->scssc->setSourceMapOptions(array(
            'sourceMapWriteTo'  => $css_file . ".map",
            'sourceMapURL'      => "style.map",
            'sourceMapFilename' => $css_file,
            'sourceMapBasepath' => $scss_dir,
            'sourceRoot'        => $scss_dir,
        ));

        $result = $this->scssc->compileString('@import "style.scss";');
         
        $this->redux->filesystem->execute( 'put_contents', $css_map_file, array(
            'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $result->getSourceMap() )
        ) );

		$this->redux->filesystem->execute( 'put_contents', $css_file, array(
			'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $result->getCss() )
		) );
         
	}

    function generate_min_file(){ return; // for dev  
        // Theme
        $scss_dir = get_template_directory() . '/assets/scss/';
        $css_dir  = get_template_directory() . '/assets/css/';
         
        $css_file = $css_dir . 'style.min.css';
          
        $this->scssc = new \ScssPhp\ScssPhp\Compiler();
        $this->scssc->setImportPaths( $scss_dir );
 
        $this->scssc->setSourceMap(\ScssPhp\ScssPhp\Compiler::SOURCE_MAP_FILE);
        $this->scssc->setSourceMapOptions(array(
            'sourceMapWriteTo'  => $css_file . ".map",
            'sourceMapURL'      => "style.min.css.map",
            'sourceMapFilename' => $css_file,
            'sourceMapBasepath' => $scss_dir,
            'sourceRoot'        => $scss_dir,
        ));

        $this->scssc->setOutputStyle( 'compressed' );

        $result = $this->scssc->compileString( '@'.'import "style.scss;"' ) ;
         
        $this->redux->filesystem->execute( 'put_contents', $css_file, array(
            'content' => $result->getCss() 
        ) );
       
    }

	protected function print_scss_opt_colors($variable,$param){
        if(is_array($variable)){
            $k = [];
            $v = [];
            foreach ($variable as $key => $value) {
                $k[] = str_replace('-', '_', $key);
                $v[] = 'var(--'.str_replace(['#',' '], [''],$key).'-color)';
            }
            if($param === 'key'){
                return implode(',', $k);
            }else{
                return implode(',', $v);
            }
            
        } else {
            return $variable;
        }
    }

	protected function get_options_output() {
        $options = apexus_configs_options();

        $theme_colors      = $options['theme_colors']; 
        $links             = $options['link']; 
        $body              = $options['body']; 
        $header            = $options['header']; 
        $heading           = $options['heading']; 
        $heading_font_size = $options['heading_font_size']; 
        $menu              = $options['menu']; 
        $submenu           = $options['submenu']; 
        $mobile_menu       = $options['mobile_menu']; 
        $mobile_submenu    = $options['mobile_submenu']; 
        $border            = $options['border']; 
        $logo              = $options['logo']; 
        $button            = $options['button']; 
         
		ob_start();

        foreach ($theme_colors as $key => $value) {
            printf('$%1$s_color: %2$s;', str_replace('-', '_', $key), 'var(--'.str_replace(['#',' '], [''],$key).'-color)' );
        }
   
        foreach ($links as $key => $value) {
            printf('$link_%1$s: %2$s;', str_replace('-', '_', $key), 'var(--link-'.$key.')');
        }
 
        foreach ($body as $key => $value) {
            printf('$body_%1$s: %2$s;', str_replace('-', '_', $key), 'var(--body-'.$key.')');
        }

        foreach ($heading as $key => $value) {
            printf('$heading_%1$s: %2$s;', str_replace('-', '_', $key), 'var(--heading-'.$key.')');
        }
        foreach ($heading_font_size as $key => $value) {
            printf('$heading_font_size_%1$s: %2$s;', str_replace('-', '_', $key), 'var(--heading-font-size-'.$key.')'); 
        }
        foreach ($logo as $key => $value) {
            printf('$logo_%1$s: %2$s;', str_replace('-', '_', $key), 'var(--logo-'.$key.')');
        }
        foreach ($header as $key => $value) {
            printf('$header_%1$s: %2$s;', str_replace('-', '_', $key), $value);
        }
        
        foreach ($menu as $key => $value) {
            printf('$menu_%1$s: %2$s;', str_replace('-', '_', $key), $value);
        }
        foreach ($submenu as $key => $value) {
            printf('$submenu_%1$s: %2$s;', str_replace('-', '_', $key), $value);
        }
        foreach ($mobile_menu as $key => $value) {
            printf('$mobile_menu_%1$s: %2$s;', str_replace('-', '_', $key), $value);
        }
        foreach ($mobile_submenu as $key => $value) {
            printf('$mobile_submenu_%1$s: %2$s;', str_replace('-', '_', $key), $value);
        }
        foreach ($border as $key => $value) {
            printf('$border_%1$s: %2$s;', str_replace('-', '_', $key), $value);
            if($key === 'color'){
                printf('$border_%1$s_rgb: %2$s;', str_replace('-', '_', $key), $value);
            }
        }
        
        foreach ($button as $key => $value) {
            printf('$button_%1$s: %2$s;', str_replace('-', '_', $key), $value);
        }
 
		return ob_get_clean();
	}

}
 

new Apexus_CSS_Generator();
