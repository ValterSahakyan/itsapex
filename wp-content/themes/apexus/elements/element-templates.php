<?php 
use Elementor\Controls_Manager;
use Elementor\Embed;
use Elementor\Group_Control_Image_Size;

add_action( 'wp_ajax_apexus_load_more_post_grid', 'apexus_load_more_post_grid' );
add_action( 'wp_ajax_nopriv_apexus_load_more_post_grid', 'apexus_load_more_post_grid' );
function apexus_load_more_post_grid(){
    if ( ! check_ajax_referer( '_ajax_nonce', 'wpnonce' ) || empty( sanitize_text_field( wp_unslash($_POST['wpnonce'] ))) ) {
        wp_send_json(
            array(
                'status' => false,
                'message' => esc_attr__('Nonce error, please reload.', 'apexus'),
                'data' => array(),
            )
        );
    }
    try{
        if(!isset($_POST['settings']) || !function_exists('pxl_get_request_data')){
            throw new Exception(__('Something went wrong while requesting. Please try again!', 'apexus'));
        }
        $settings = pxl_get_request_data($_POST, 'settings');
        $source = isset($settings['source']) ? sanitize_text_field($settings['source']) : '';
        $term_slug = isset($settings['term_slug']) ? sanitize_text_field($settings['term_slug']) : '';
        if( !empty($term_slug) && $term_slug !='*'){
            $term_slug = str_replace('.', '', $term_slug);
            $source = [$term_slug.'|'.sanitize_text_field($settings['tax'][0])]; 
        }
        if( isset($_POST['handler_click']) && sanitize_text_field(wp_unslash( $_POST[ 'handler_click' ] )) == 'filter'){
            set_query_var('paged', 1);
            $settings['paged'] = 1;
        }elseif( isset($_POST['handler_click']) && sanitize_text_field(wp_unslash( $_POST[ 'handler_click' ] )) == 'select_orderby'){
            set_query_var('paged', 1);
            $settings['paged'] = 1;
        }else{
            set_query_var('paged', (int)$settings['paged']);
        }

        extract(pxl_get_posts_of_grid($settings['post_type'], [
                'source'      => $source,
                'orderby'     => isset($settings['orderby']) ? sanitize_text_field($settings['orderby']) : 'date',
                'order'       => isset($settings['order']) ? ($settings['orderby'] == 'title' ? 'asc' : sanitize_text_field($settings['order']) ) : 'desc',
                'limit'       => isset($settings['limit']) ? (int)$settings['limit'] : 6,
                'post_ids'    => isset($settings['post_ids']) ? $settings['post_ids']: [],
                'post_not_in' => isset($settings['post_not_in']) ? $settings['post_not_in'] : [],
            ],
            $settings['tax']
        ));
       
        ob_start();
            if( $settings['wg_type'] == 'post-list'){
                apexus_get_post_list($posts, $settings);
            }else{
                apexus_get_post_grid($posts, $settings);
            }
        $html = ob_get_clean();

        $pagin_html = '';
        if( isset($settings['pagination_type']) && $settings['pagination_type'] == 'pagination' ){ 
            ob_start();
                apexus()->page->get_pagination( $query,  true );
            $pagin_html = ob_get_clean();
        }

        $result_count = '';
        if( isset($settings['show_toolbar']) && $settings['show_toolbar'] == 'show' ){ 
            ob_start();
                if( (int)$settings['paged'] == 0){
                    $limit_start = 1;
                    $limit_end = ( (int)$settings['limit'] >= $total ) ? $total : (int)$settings['limit'];
                }else{
                    $limit_start = (((int)$settings['paged'] - 1 ) * (int)$settings['limit']) + 1;
                    $limit_end = (int)$settings['paged'] * (int)$settings['limit'];
                    $limit_end = ( $limit_end >= $total ) ? $total : $limit_end;
                }
                $average = ($limit_end - $limit_start) + 1;
 
                if( isset($settings['pagination_type']) && $settings['pagination_type'] == 'loadmore' ){ 
                    printf(
                        '<span>%1$s %2$s</span>',
                        $limit_end,
                        esc_html__('Total results','apexus')
                    );
                }else{
                    printf(
                        '<span>%1$s %2$s</span>',
                        $average,
                        esc_html__('Total results','apexus')
                    );
                }
                
            $result_count = ob_get_clean();
        }
         

        wp_send_json(
            array(
                'status' => true,
                'message' => esc_attr__('Load Successfully!', 'apexus'),
                'data' => array(
                    'html' => $html,
                    'paged' => (int)$settings['paged'],
                    'pagin_html' => $pagin_html,
                    'posts' => $posts,
                    'max' => $max,
                    'result_count' => $result_count,
                ),
            )
        );
    }
    catch (Exception $e){
        wp_send_json(array('status' => false, 'message' => $e->getMessage()));
    }
    die;
}


function apexus_get_post_grid($posts = [], $settings = []){ 
    if (empty($posts)) return;
      
    switch ($settings['layout']) {
        case 'post-list-1': 
            apexus_get_post_list_layout1($posts, $settings); 
            break;
        case 'career-list-1':
            apexus_get_career_list_layout1($posts, $settings);
            break;
        case 'post-1': 
            apexus_get_post_grid_layout1($posts, $settings); 
            break;
        case 'services-1': 
            apexus_get_services_grid_layout1($posts, $settings); 
            break;
        case 'portfolio-1': 
            apexus_get_portfolio_grid_layout1($posts, $settings); 
            break;
        default:
            return false;
            break;
    }
     
}
function apexus_get_post_grid_layout1($posts = [], $settings = []){
    extract($settings);  
    foreach ($posts as $key => $post):
        if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)){
            $img_id = get_post_thumbnail_id($post->ID);
            if($img_id){
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class' => 'object-fit no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            }else{  
                $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
            }
        }else{
            $thumbnail = '';
        }

        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));

        $author_id = get_post_field ('post_author', $post->ID);
        ?>
        <div class="<?php echo esc_attr('grid-item'); ?>">
            <div class="grid-item-wrap">
                <div class="grid-item-inner item-inner-wrap">
                    <?php if ( !empty( $thumbnail )): ?>
                        <div class="item-featured">
                            <div class="post-image scale-hover-x-left">
                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                    <?php echo wp_kses_post($thumbnail); ?>  
                                </a>       
                            </div> 
                        </div>
                    <?php endif; ?>
                    <div class="item-content">
                        <?php if( $show_category): ?>
                            <span class="port-category col-auto d-flex"><?php the_terms( $post->ID, 'category', '', ' ', '' ); ?></span>   
                        <?php endif; ?>
                        <h4 class="item-title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h4>
                    </div>
                </div>
            </div>
        </div>
                
 
    <?php endforeach;
}

function apexus_get_portfolio_grid_layout1($posts = [], $settings = []){
    extract($settings);  
    foreach ($posts as $key => $post):
        if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)){
            $img_id = get_post_thumbnail_id($post->ID);
            if($img_id){
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class' => 'object-fit no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            }else{  
                $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
            }
        }else{
            $thumbnail = '';
        }

        $filter_class = '';
        if ($select_post_by === 'term_selected' && $filter == "true")
            $filter_class = pxl_get_term_of_post_to_class($post->ID, array_unique($tax));
        ?>
        <div class="<?php echo esc_attr('grid-item'. ' ' .$filter_class); ?>">
            <div class="grid-item-wrap">
                <?php if ( !empty( $thumbnail )): ?>
                    <div class="post-image pxl-animated-waypoint">
                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                        <?php echo wp_kses_post($thumbnail); ?>  
                        </a>     
                    </div> 
                <?php endif; ?>
                <div class="inner-item">
                    <div class="item-content">
                        <h4 class="item-title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h4>
                        <?php if($show_excerpt) : ?>
                            <div class="item-excerpt">
                                <?php
                                if(!empty($post->post_excerpt)){
                                    echo wp_trim_words( $post->post_excerpt, $num_words, null );
                                } else{
                                    $content = strip_shortcodes( $post->post_content );
                                    $content = apply_filters( 'the_content', $content );
                                    $content = str_replace(']]>', ']]&gt;', $content);
                                    echo wp_trim_words( $content, $num_words, null );
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if( $show_category): ?>
                        <span class="port-category col-auto d-flex"><?php the_terms( $post->ID, 'portfolio-category', '', ' ', '' ); ?></span>   
                    <?php endif; ?>
                </div>
            </div>
        </div>
                
 
    <?php endforeach;
}
 
function apexus_get_post_list($posts = [], $settings = []){ 
    if (empty($posts) || !is_array($posts) || empty($settings) || !is_array($settings)) {
        return;
    }
    extract($settings);
}

function apexus_get_post_list_layout1($posts = [], $settings = []){
    extract($settings);  
    foreach ($posts as $key => $post):
        $author = get_user_by('id', $post->post_author);
        $date_format = get_option('date_format');
 
        $data_settings = '';
        $animate_cls = '';
        if ( !empty( $item_animation ) ) {
            $animate_cls = ' pxl-animate pxl-invisible animated-'.$item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => (float)$item_animation_delay
            ]);
            $data_settings = 'data-settings="'.esc_attr($data_animation).'"';
        }
        ?>
        <div class="<?php echo esc_attr('grid-item'); ?>">
            <div class="grid-item-wrap">
                <div class="grid-item-inner item-inner-wrap">
                    <?php if( $show_category): ?>
                        <span class="port-category col-auto d-flex"><?php the_terms( $post->ID, 'category', '', ' ', '' ); ?></span>   
                    <?php endif; ?>
                    <h4 class="item-title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h4>
                </div>
            </div>
        </div>
                
 
    <?php endforeach;
}

function apexus_get_career_list_layout1($posts = [], $settings = []){
    extract($settings); 
    foreach ($posts as $key => $post):
       
        if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)){
            $img_id = get_post_thumbnail_id($post->ID);
            if($img_id){
                $img = pxl_get_image_by_size( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size,
                    'class' => 'no-lazyload',
                ));
                $thumbnail = $img['thumbnail'];
            }else{  
                $thumbnail = get_the_post_thumbnail($post->ID, $img_size);
            }
        }else{
            $thumbnail = '';
        }
           
        $author = get_user_by('id', $post->post_author);
        $date_format = get_option('date_format');
 
        $data_settings = '';
        $animate_cls = '';
        if ( !empty( $item_animation ) ) {
            $animate_cls = ' pxl-animate pxl-invisible animated-'.$item_animation_duration;
            $data_animation =  json_encode([
                'animation'      => $item_animation,
                'animation_delay' => (float)$item_animation_delay
            ]);
            $data_settings = 'data-settings="'.esc_attr($data_animation).'"';
        }

        $flag = false;
        $post_format = get_post_format($post->ID) == false ? 'format-standard' : 'format-'.get_post_format($post->ID);
        $location_text = get_post_meta( $post->ID, 'location_text', true );
        $team_text = get_post_meta( $post->ID, 'team_text', true );
        $Time_text = get_post_meta( $post->ID, 'Time_text', true );
        $readmore_text = !empty($readmore_text) ? $readmore_text : esc_html__('Apply', 'apexus');
        ?>
        <div class="<?php echo esc_attr('grid-item list-item w-100 '. $post_format); ?> <?php echo esc_attr($animate_cls) ?>" <?php pxl_print_html($data_settings); ?>>
            <div class="grid-item-inner item-inner-wrap <?php echo esc_attr($post_format) ?>">
                <div class="item-content">
                    <div class="box-title">
                        <h3 class="item-title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php pxl_print_html(get_the_title($post->ID)); ?></a></h3>
                        <?php if($show_date) : ?>
                        <span>
                            <?php 
                                $post_time = get_the_time('U', $post->ID);
                                $current_time = current_time('timestamp');
                                echo human_time_diff($post_time, $current_time) . ' ago';
                            ?>
                        </span>
                        <?php endif; ?>
                    </div>
                    <?php if($show_excerpt) : ?>
                    <div class="item-excerpt">
                            <?php
                            if(!empty($post->post_excerpt)){
                                echo wp_trim_words( $post->post_excerpt, $num_words, null );
                            } else{
                                $content = strip_shortcodes( $post->post_content );
                                $content = apply_filters( 'the_content', $content );
                                $content = str_replace(']]>', ']]&gt;', $content);
                                echo wp_trim_words( $content, $num_words, null );
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                    <div class="box-content">
                        <?php if($show_infor) : ?>
                        <div class="item-icon d-flex-wrap align-items-end">
                            <div class="icon-item d-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                <path d="M10 1.875C6.90186 1.875 4.375 4.40186 4.375 7.5C4.375 8.37891 4.73145 9.38721 5.21484 10.4883C5.69824 11.5894 6.3208 12.7588 6.95312 13.8477C8.21777 16.0278 9.49219 17.8516 9.49219 17.8516L10 18.5938L10.5078 17.8516C10.5078 17.8516 11.7822 16.0278 13.0469 13.8477C13.6792 12.7588 14.3018 11.5894 14.7852 10.4883C15.2686 9.38721 15.625 8.37891 15.625 7.5C15.625 4.40186 13.0981 1.875 10 1.875ZM10 3.125C12.4243 3.125 14.375 5.07568 14.375 7.5C14.375 8.00049 14.1064 8.94775 13.6523 9.98047C13.1982 11.0132 12.5708 12.1582 11.9531 13.2227C10.9717 14.917 10.3613 15.813 10 16.3477C9.63867 15.813 9.02832 14.917 8.04688 13.2227C7.4292 12.1582 6.80176 11.0132 6.34766 9.98047C5.89355 8.94775 5.625 8.00049 5.625 7.5C5.625 5.07568 7.57568 3.125 10 3.125ZM10 6.25C9.30908 6.25 8.75 6.80908 8.75 7.5C8.75 8.19092 9.30908 8.75 10 8.75C10.6909 8.75 11.25 8.19092 11.25 7.5C11.25 6.80908 10.6909 6.25 10 6.25Z"/>
                                </svg>
                                <span><?php echo esc_html($location_text); ?></span>
                            </div>
                            <div class="icon-item d-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                <path d="M5.625 4.375C3.56201 4.375 1.875 6.06201 1.875 8.125C1.875 9.36523 2.48535 10.4688 3.41797 11.1523C1.77002 11.9702 0.625 13.6646 0.625 15.625H1.875C1.875 13.5474 3.54736 11.875 5.625 11.875C7.70264 11.875 9.375 13.5474 9.375 15.625H10.625C10.625 13.5474 12.2974 11.875 14.375 11.875C16.4526 11.875 18.125 13.5474 18.125 15.625H19.375C19.375 13.6646 18.23 11.9702 16.582 11.1523C17.5146 10.4688 18.125 9.36523 18.125 8.125C18.125 6.06201 16.438 4.375 14.375 4.375C12.312 4.375 10.625 6.06201 10.625 8.125C10.625 9.36523 11.2354 10.4688 12.168 11.1523C11.2573 11.604 10.4932 12.3169 10 13.2031C9.50684 12.3169 8.74268 11.604 7.83203 11.1523C8.76465 10.4688 9.375 9.36523 9.375 8.125C9.375 6.06201 7.68799 4.375 5.625 4.375ZM5.625 5.625C7.01416 5.625 8.125 6.73584 8.125 8.125C8.125 9.51416 7.01416 10.625 5.625 10.625C4.23584 10.625 3.125 9.51416 3.125 8.125C3.125 6.73584 4.23584 5.625 5.625 5.625ZM14.375 5.625C15.7642 5.625 16.875 6.73584 16.875 8.125C16.875 9.51416 15.7642 10.625 14.375 10.625C12.9858 10.625 11.875 9.51416 11.875 8.125C11.875 6.73584 12.9858 5.625 14.375 5.625Z"/>
                                </svg>
                                <span><?php echo esc_html($team_text); ?></span>
                            </div>
                            <div class="icon-item d-flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                <path d="M10 1.875C8.83545 1.875 7.87598 2.67334 7.59766 3.75H1.875V16.25H18.125V3.75H12.4023C12.124 2.67334 11.1646 1.875 10 1.875ZM10 3.125C10.5054 3.125 10.8936 3.3667 11.0938 3.75H8.90625C9.10645 3.3667 9.49463 3.125 10 3.125ZM3.125 5H16.875V10.625H3.125V5ZM10 8.75C9.65576 8.75 9.375 9.03076 9.375 9.375C9.375 9.71924 9.65576 10 10 10C10.3442 10 10.625 9.71924 10.625 9.375C10.625 9.03076 10.3442 8.75 10 8.75ZM3.125 11.875H16.875V15H3.125V11.875Z"/>
                                </svg>
                                <span><?php echo esc_html($Time_text); ?></span>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if($show_readmore) : ?>
                            <a class="pxl-btn btn-primary" href="<?php echo esc_url( get_permalink($post->ID)); ?>">
                                <span class="pxl-button-text"><?php echo apexus_html($readmore_text); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endforeach; 
}



