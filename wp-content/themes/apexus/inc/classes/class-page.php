<?php
if (!class_exists('Apexus_Page')) {
    class Apexus_Page
    {
        public function get_site_loader(){

            $site_loader = apexus()->get_theme_opt( 'site_loader', false );
            $loading_img = apexus()->get_theme_opt( 'loading_img', [] );
            if($site_loader == '0') return;
            ?>
            <div id="pxl-loadding" class="pxl-loader style-<?php echo esc_attr($site_loader)?>">
            <?php 
            switch ($site_loader) {
                case '1':
                    ?>
                    <div class="loading-spinner">
                        <img src="<?php echo esc_url($loading_img['url'])?>" alt="<?php esc_attr_e('Loading','apexus');?>">
                    </div>
                    <?php 
                    break;
                case '2':
                    ?>
                    <div class="loading-text">
                        <span class="loading-text-words">L</span>
                        <span class="loading-text-words">O</span>
                        <span class="loading-text-words">A</span>
                        <span class="loading-text-words">D</span>
                        <span class="loading-text-words">I</span>
                        <span class="loading-text-words">N</span>
                        <span class="loading-text-words">G</span>
                    </div>
                    <?php 
                    break;
            }
            ?>
            </div>
            <?php 
             
        }

        public function get_link_pages() {
            wp_link_pages( array(
                'before'      => '<div class="navigation page-links empty-none">',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) ); 
        }

        public function get_pagination( $query = null, $ajax = false ){

            if($ajax){
                add_filter('paginate_links', [$this, 'get_ajax_paginate_links']);
            }

            $classes = array();

            if ( empty( $query ) )
            {
                $query = $GLOBALS['wp_query'];
            }

            if ( empty( $query->max_num_pages ) || ! is_numeric( $query->max_num_pages ) || $query->max_num_pages < 2 )
            {
                return;
            }

            $paged = $query->get( 'paged', '' );

            if ( ! $paged && is_front_page() && ! is_home() )
            {
                $paged = $query->get( 'page', '' );
            }

            $paged = $paged ? intval( $paged ) : 1;

            $pagenum_link = html_entity_decode( get_pagenum_link() );
            $query_args   = array();
            $url_parts    = explode( '?', $pagenum_link );

            if ( isset( $url_parts[1] ) )
            {
                wp_parse_str( $url_parts[1], $query_args );
            }

            $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
            $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

            $html_prev = '<svg class="icon-left" width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.51562 2.14062L4.01562 7.64062L3.67188 8L4.01562 8.35938L9.51562 13.8594L10.2344 13.1406L5.09375 8L10.2344 2.85938L9.51562 2.14062Z"/>
                        </svg>';
            $html_next = '<svg class="icon-right" width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.48438 2.14062L5.76562 2.85938L10.9062 8L5.76562 13.1406L6.48438 13.8594L11.9844 8.35938L12.3281 8L11.9844 7.64062L6.48438 2.14062Z"/>
                            </svg>';
            $paginate_links_args = array(
                'base'     => $pagenum_link,
                'total'    => $query->max_num_pages,
                'current'  => $paged,
                'mid_size' => 1,
                'add_args' => array_map( 'urlencode', $query_args ),
                'prev_text' => $html_prev,
                'next_text' => $html_next,
            );
            if($ajax){
                $paginate_links_args['format'] = '?page=%#%';
            }
            $links = paginate_links( $paginate_links_args );
            
            if ( $links ):
            ?>
            <nav class="posts-pagination <?php echo esc_attr($ajax?'ajax':''); ?>">
                <div class="pagination-inner">
                    <?php echo ''.$links; ?>
                </div>
            </nav>
            <?php
            endif;
        }
        
        function get_ajax_paginate_links($link){
            $parts = parse_url($link);
            if( !isset($parts['query']) ) return $link;
            parse_str($parts['query'], $query);
            if(isset($query['page']) && !empty($query['page'])){
                return '?' . $query['page'];
            }
            else{
                return '?1';
            }
        }
    }
}
 