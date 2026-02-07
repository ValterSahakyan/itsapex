<?php
/**
 * @package Apexus
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="pxl-page" class="pxl-page page-404 overflow-hidden">
        <?php $template_404 = (int)apexus()->get_theme_opt('template_404',0); ?>
        <?php if ($template_404 <= 0 || !class_exists('Pxltheme_Core') || !is_callable( 'Elementor\Plugin::instance' )): ?>
            <main id="pxl-content-main" class="pxl-content-main">
                <div class="page-404-wrap relative row align-items-center">
                    <div class="page-404-inner relative text-center col-12">
                        <h1 class="number-wrap">
                            <span>404</span>
                        </h1>
                        <h2 class="pxl-error-title">
                            <?php echo esc_html__( 'OOPS! Page Not Found!', 'apexus' );?>
                        </h2>
                        <div class="desc">
                            <span><?php echo esc_html__( 'The page you are looking is not available or has been removed. Try going to Home Page by using the button below.', 'apexus' );?></span>
                        </div>
                        <div class="pxl-button-wrapper">
                            <a class="btn btn-gradient" href="<?php echo esc_url(home_url('/')); ?>">
                                <span><?php echo esc_html__('back to homepage', 'apexus') ?></span>
                            </a>
                        </div>
                    </div>       
                </div>
            </main>    
        <?php else: ?>
            <?php if( $template_404 > 0): ?>
                <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $template_404); ?>      
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php wp_footer(); ?>
</body>
</html>
