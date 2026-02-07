<?php
if (!class_exists('Apexus_Blog')) {
    class Apexus_Blog
    {
        public function get_post_feature(){
            
            $post_feature_image_on = apexus()->get_theme_opt('post_feature_image_on', '1');
            if( $post_feature_image_on != '1') return;
           
            $post_feature_image_type = apexus()->get_theme_opt('post_feature_image_type','cropped');
 
            if($post_feature_image_type == 'full'){ 
                $thumbnail_size = 'full'; 
            }else{
                $thumbnail_size = 'large';
            }

            if ( has_post_thumbnail() ){
                echo '<div class="post-featured relative">';
                    echo '<div class="post-image '.$post_feature_image_type.'">';  
                        the_post_thumbnail($thumbnail_size);
                    echo '</div>';
                echo '</div>';
            }
            
        }
        public function get_archive_category_meta() {
            $archive_category = apexus()->get_theme_opt( 'archive_category', true );
            ?>
            <?php if($archive_category) : ?>
                <div class="post-category d-flex-wrap gx-8"><?php the_terms( get_the_ID(), 'category', '', ' ', '' ); ?></div>
            <?php endif;  
        }

        public function get_post_metas(){
            $post_author = apexus()->get_theme_opt( 'post_author', true );
            $post_date = apexus()->get_theme_opt( 'post_date', true );
            $post_comment_count = apexus()->get_theme_opt( 'post_comment_count', true );
            if($post_author || $post_date || $post_comment_count) : ?>
                <div class="post-metas">
                    <div class="meta-inner d-flex-wrap align-items-center">
                        <?php if($post_date) : ?>
                            <span class="meta-item post-date col-auto d-flex"><span><?php echo get_the_date('j M Y'); ?></span></span>
                        <?php endif; ?>
                        <span class="meta-item post-news"><?php echo esc_html('General News', 'apexus'); ?></span>
                        <?php if($post_author) : ?>
                            <span class="meta-item post-author col-auto d-flex"><span><?php esc_html_e('By ','apexus')?><?php the_author_posts_link(); ?></span></span>
                        <?php endif; ?>
                        <?php if ($post_comment_count) : ?>
                            <a class="meta-item post-comment-count" href="<?php the_permalink(); ?>#comments">
                                <?php
                                    $count = get_comments_number();
                                    if ($count == 0) {
                                        echo '<span class="cmt-count">No&nbsp;</span> ' . esc_html__('Comment', 'apexus');
                                    } else {
                                        $formatted = ($count < 10) ? '0' . $count : $count;
                                        echo '<span class="cmt-count">' . $formatted . '&nbsp;' . '</span> ' . _n('Comment', 'Comments', $count, 'apexus');
                                    }
                                ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; 
        }
        public function get_archive_post_metas(){
            $archive_author = apexus()->get_theme_opt( 'archive_author', true );
            $archive_comment_count = apexus()->get_theme_opt( 'archive_comment_count', true );
            if($archive_author || $archive_comment_count) : ?>
                <div class="post-metas">
                    <div class="meta-inner d-flex-wrap align-items-center">
                        <span class="meta-item post-news"><?php echo esc_html('General News', 'apexus'); ?></span>
                        <?php if($archive_author) : ?>
                            <span class="meta-item post-author col-auto d-flex"><span><?php esc_html_e('By ','apexus')?><?php the_author_posts_link(); ?></span></span>
                        <?php endif; ?>
                        <?php if ($archive_comment_count) : ?>
                            <a class="meta-item post-comment-count" href="<?php the_permalink(); ?>#comments">
                                <?php
                                    $count = get_comments_number();
                                    if ($count == 0) {
                                        echo '<span class="cmt-count">No&nbsp;</span> ' . esc_html__('Comment', 'apexus');
                                    } else {
                                        $formatted = ($count < 10) ? '0' . $count : $count;
                                        echo '<span class="cmt-count">' . $formatted . '&nbsp;' . '</span> ' . _n('Comment', 'Comments', $count, 'apexus');
                                    }
                                ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; 
        }
       
        public function get_excerpt( $length = 38 ){
            $pxl_the_excerpt = get_the_excerpt();
            if(!empty($pxl_the_excerpt)) {
                $excerpt_more = apply_filters( 'apexus_excerpt_more', '&hellip;' );
                $excerpt      = wp_trim_words( $pxl_the_excerpt, $length, $excerpt_more );
                echo wp_kses_post($excerpt);
            } else {
                echo wp_kses_post($this->get_excerpt_more( $length ));
            }
        }

        public function get_excerpt_more( $length = 38, $post = null ) {
            $post = get_post( $post );

            if ( empty( $post ) || 0 >= $length ) {
                return '';
            }

            if ( post_password_required( $post ) ) {
                return esc_html__( 'Post password required.', 'apexus' );
            }

            $content = apply_filters( 'the_content', strip_shortcodes( $post->post_content ) );
            $content = str_replace( ']]>', ']]&gt;', $content );

            $excerpt_more = apply_filters( 'apexus_excerpt_more', '&hellip;' );
            $excerpt      = wp_trim_words( $content, $length, $excerpt_more );

            return $excerpt;
        }

        public function get_post_title(){
            ?>
            <h3 class="post-title"><?php the_title(); ?></h3>
            <?php 
        }
          
        public function set_post_views( $post_id ) {
            $count_key = 'post_views_count';
            $count    = get_post_meta( $post_id, $count_key, true );
            if ( $count == '' ) {
                $count = 0;
                delete_post_meta( $post_id, $count_key );
                add_post_meta( $post_id, $count_key, '0' );
            } else {
                $count ++;
                update_post_meta( $post_id, $count_key, $count );
            }
        }

        public function get_post_views( $post_id ) {
            $view_count = (int)get_post_meta( $post_id , 'post_views_count', true);
            return $view_count;
        }
  
        public function get_post_tags(){
            $post_tag = apexus()->get_theme_opt( 'post_tag', true );
            if($post_tag != '1') return;
            $tags_list = get_the_tag_list( '<span class="label"><i class="bi bi-tags-fill"></i> '.esc_attr__('Tags:', 'apexus'). '</span>', ' ' );
            if ( $tags_list ){
                echo '<div class="post-tags">';
                printf('%2$s', '', $tags_list);
                echo '</div>';
            }
        }
        public function get_blog_post_footer(){
            $archive_readmore = apexus()->get_theme_opt('archive_readmore', '1');
            $archive_readmore_text = apexus()->get_theme_opt('archive_readmore_text', esc_html__('Continue Reading', 'apexus'));
            ?>
            <?php if( $archive_readmore == '1'): ?>
                <div class="post-readmore">
                    <a class="pxl-readmore" href="<?php echo esc_url( get_permalink()); ?>">
                        <span><?php echo apexus_html($archive_readmore_text); ?></span>
                        <span class="pxli pxli-arrow-leftnew"></span>
                    </a>
                </div>
            <?php endif; 
        } 
        public function get_post_author_summary(){
            $post_author_summary = apexus()->get_theme_opt( 'post_author_summary', '0' ); 
            if( $post_author_summary == '0' ) return;
            $author_id = get_the_author_meta('ID');
            $author_gravatar = get_avatar_url($author_id, array('size' => 48));
            $author_role = get_user_meta($author_id, 'pu_author_brief_desc', true);
            $author_description = get_the_author_meta( 'description' );
            ?>
            <div class="post-author-summary">
                <div class="post-author d-flex align-items-center gx-24 gx-sm-16">
                    <div class="author-avatar col-auto"><img src="<?php echo esc_url($author_gravatar); ?>" alt="<?php echo get_the_title(); ?>" /></div>
                    <div class="author-title col">
                        <h4 class="author-name mb-0"><?php the_author_posts_link(); ?></h4>
                        <?php if( !empty($author_role) ): ?>
                            <div class="author-role small"><?php echo esc_html($author_role); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if( !empty($author_description) ): ?>
                    <div class="author-desc p"><?php echo esc_html($author_description); ?></div>
                <?php endif; ?>
                <div class="author-info-foot d-flex-wrap gy-10 justify-content-between align-items-center">
                    <?php 
                        $curauth = get_userdata($author_id);
                        if( class_exists('Pu_User_Profile') ){
                            $user_metas = Pu_User_Profile::pu_get_user_meta($author_id);
                            if( !empty( $user_metas)){
                                $author_role           = $user_metas['pu_author_brief_desc'];
                                $author_facebook_link  = $user_metas['pu_user_facebook'];
                                $author_twitter_link   = $user_metas['pu_user_twitter'];
                                $author_linkedin_link  = $user_metas['pu_user_linkedin'];
                                $author_pinterest_link = $user_metas['pu_user_pinterest'];
                                $author_instagram_link = $user_metas['pu_user_instagram'];
                                $author_youtube_link   = $user_metas['pu_user_youtube'];
                                $author_vimeo_link     = $user_metas['pu_user_vimeo'];
                                $author_skype_link     = $user_metas['pu_user_skype'];
                                $author_behance        = $user_metas['pu_user_behance']; 
                                $author_dribbble       = $user_metas['pu_user_dribbble']; 
                                $author_tumblr_link    = $user_metas['pu_user_tumblr'];
                                $author_rss_link       = $user_metas['pu_user_rss'];
                            }
                            if ( !empty($author_facebook_link) || !empty($author_twitter_link) || !empty($author_linkedin_link) || !empty($author_pinterest_link) || !empty($author_instagram_link) || !empty($author_youtube_link) || !empty($author_vimeo_link) || !empty($author_skype_link) || !empty($author_behance) || !empty($author_dribbble) || !empty($author_tumblr_link) || !empty($author_rss_link)): ?>
                                <div class="author-social d-flex-wrap align-items-center gx-16">
                                    <?php if(!empty($author_facebook_link)): ?>
                                        <div class="social-item facebook d-flex align-items-center">
                                            <a href="<?php echo esc_url($author_facebook_link); ?>"><span class="pxl-icon pxli-facebook"></span></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($author_twitter_link)): ?>
                                        <div class="social-item twitter d-flex align-items-center">
                                            <a href="<?php echo esc_url($author_twitter_link); ?>"><span class="pxl-icon pxli-twitter"></span></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($author_linkedin_link)): ?>
                                        <div class="social-item linkedin d-flex align-items-center">
                                            <a href="<?php echo esc_url($author_linkedin_link); ?>"><span class="pxl-icon pxli-linkedin-in"></span></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($author_pinterest_link)): ?>
                                        <div class="social-item pinterest d-flex align-items-center">
                                            <a href="<?php echo esc_url($author_pinterest_link); ?>"><span class="pxl-icon pxli-pinterest"></span></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($author_instagram_link)): ?>
                                        <div class="social-item instagram d-flex align-items-center">
                                            <a href="<?php echo esc_url($author_instagram_link); ?>"><span class="pxl-icon pxli-instagram1"></span></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($author_youtube_link)): ?>
                                        <div class="social-item youtube d-flex align-items-center">
                                            <a href="<?php echo esc_url($author_youtube_link); ?>"><span class="pxl-icon pxli-youtube-brands"></span></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($author_vimeo_link)): ?>
                                        <div class="social-item vimeo d-flex align-items-center">
                                            <a href="<?php echo esc_url($author_vimeo_link); ?>"><span class="pxl-icon pxli-vimeo-v"></span></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($author_skype_link)): ?>
                                        <div class="social-item skype d-flex align-items-center">
                                            <a href="<?php echo esc_url($author_skype_link); ?>"><span class="pxl-icon pxli-skype"></span></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($author_behance)): ?>
                                        <div class="social-item behance d-flex align-items-center">
                                            <a href="<?php echo esc_url($author_behance); ?>"><span class="pxl-icon pxli-behance"></span></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($author_dribbble)): ?>
                                        <div class="social-item dribbble d-flex align-items-center">
                                            <a href="<?php echo esc_url($author_dribbble); ?>"><span class="pxl-icon pxli-dribbble"></span></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($author_tumblr_link)): ?>
                                        <div class="social-item tumblr d-flex align-items-center">
                                            <a href="<?php echo esc_url($author_tumblr_link); ?>"><span class="pxl-icon pxli-tumblr"></span></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(!empty($author_rss_link)): ?>
                                        <div class="social-item rss d-flex align-items-center">
                                            <a href="<?php echo esc_url($author_rss_link); ?>"><span class="pxl-icon pxli-rss"></span></a>
                                        </div>
                                    <?php endif; ?>
                                     
                                </div>
                            <?php endif;
                        }
                        if(!empty($curauth->user_url))
                            echo '<div class="author-url"><a class="btn btn-md" href="'.esc_url($curauth->user_url).'">'.esc_html__('Contact Author','apexus').'</a></div>';
                    ?>

                </div>
            </div>
            <?php 
        }
         
        public function get_post_footer(){
            $post_tag = apexus()->get_theme_opt('post_tag', '1');
            $post_social_share = apexus()->get_theme_opt( 'post_social_share', '0' );
            $tags_list = get_the_tag_list( '', ' ' );
            ?>
            <?php if( $post_tag == '1' || $post_social_share == '1'): ?>
                <div class="post-footer gy-30 align-items-center justify-content-between mt-15">
                    <?php if( $post_tag == '1' && $tags_list): ?>
                        <div class="post-tags row">
                            <span class="d-inline-block col-auto"><?php esc_html_e('Tags:', 'apexus') ?></span>
                            <div class="post-tags-inner d-flex-wrap col-auto"><?php printf('%2$s', '', $tags_list) ?></div>
                        </div>
                    <?php endif; ?>
                    
                </div>
            <?php endif; 
        }  
        public function get_post_share() { 
            $post_social_share = apexus()->get_theme_opt( 'post_social_share', '0' );
            $share_icons = apexus()->get_theme_opt( 'post_social_share_icon', [] );
            if($post_social_share != '1' || empty($share_icons) || !function_exists('pxl_post_share_link')) return;
            ?>
            <div class="post-shares d-flex-wrap align-items-center col-auto gx-16 gx-xl-24">
                <div class="col social-share">
                    <span class="text"><?php esc_html_e('Share this post', 'apexus') ?></span>
                    <div class="row gx-5 gx-xl-5">
                        <?php if(in_array('twitter', $share_icons)): ?>
                        <div class="social-item col-auto">
                            <?php pxl_post_share_link([
                                'icon' => 'twitter',
                                'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <path d="M1.57812 2L6.30859 8.76042L1.82682 14H3.58724L7.09635 9.88672L9.97396 14H14.5807L9.63281 6.91667L13.8268 2H12.0938L8.84766 5.79167L6.19922 2H1.57812ZM4.13802 3.33333H5.50391L12.0221 12.6667H10.668L4.13802 3.33333Z"/>
                                    </svg>'
                            ]); ?>
                        </div>
                        <?php endif; ?> 
                        <?php if(in_array('facebook', $share_icons)): ?>
                        <div class="social-item col-auto">
                            <?php pxl_post_share_link([
                                'icon' => 'facebook',
                                'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <path d="M9.62695 1C7.65595 1 6.5 2.04109 6.5 4.41309V6.5H4V9H6.5V15H9V9H11L11.5 6.5H9V4.83594C9 3.94244 9.29138 3.5 10.1299 3.5H11.5V1.10254C11.263 1.07054 10.5725 1 9.62695 1Z"/>
                                    </svg>'
                            ]); ?>
                        </div>
                        <?php endif; ?> 
                        <?php if(in_array('linkedin', $share_icons)): ?>
                        <div class="social-item col-auto">
                            <?php pxl_post_share_link([
                                'icon' => 'linkedin',
                                'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                <path d="M4.32129 2C3.59179 2 3 2.59081 3 3.32031C3 4.04981 3.59131 4.6543 4.32031 4.6543C5.04931 4.6543 5.6416 4.04981 5.6416 3.32031C5.6416 2.59131 5.05079 2 4.32129 2ZM10.7676 5.5C9.65808 5.5 9.02325 6.08023 8.71875 6.65723H8.68652V5.65527H6.5V13H8.77832V9.36426C8.77832 8.40626 8.85063 7.48047 10.0361 7.48047C11.2046 7.48047 11.2217 8.5728 11.2217 9.4248V13H13.4971H13.5V8.96582C13.5 6.99182 13.0756 5.5 10.7676 5.5ZM3.18164 5.65527V13H5.46191V5.65527H3.18164Z"/>
                                </svg>'
                            ]); ?>
                        </div>
                        <?php endif; ?> 
                        <?php if(in_array('pinterest', $share_icons)): ?>
                            <div class="social-item col-auto">
                                <?php pxl_post_share_link([
                                    'icon' => 'pinterest',
                                    'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path d="M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3.8-3.4 5-20.3 6.9-28.1.6-2.5.3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z"/></svg>'
                                ]); ?>
                            </div>
                        <?php endif; ?>  
                    </div>
                </div>
            </div>
            <?php
        }

        public function get_website_share() { 
            $post_social_share = apexus()->get_theme_opt( 'post_social_share', '0' );
            $share_icons = apexus()->get_theme_opt( 'post_social_share_icon', [] );
            if($post_social_share != '1' || empty($share_icons) || !function_exists('pxl_post_share_link')) return;
            ?>
            <div class="post-shares sidebar-sticky">
                <div class="sidebar-sticky-wrap">
                    <h6 class="mb-05"><?php esc_html_e('Share Post', 'apexus') ?></h6>
                    <div class="social-share">
                        <?php if(in_array('pinterest', $share_icons)): ?>
                            <div class="social-item col-auto">
                                <?php pxl_site_share_link([
                                    'icon' => 'pinterest', 
                                    'text' => esc_html__('Pinterest', 'apexus')
                                ]); ?>
                            </div>
                        <?php endif; ?>
                        <?php if(in_array('facebook', $share_icons)): ?>
                        <div class="social-item col-auto">
                            <?php pxl_site_share_link([
                                'icon' => 'facebook',
                                'text' => esc_html__('Facebook', 'apexus')
                            ]); ?>
                        </div>
                        <?php endif; ?> 
                        <?php if(in_array('linkedin', $share_icons)): ?>
                        <div class="social-item col-auto">
                            <?php pxl_site_share_link([ 
                                'icon' => 'linkedin', 
                                'text' => esc_html__('LinkedIn', 'apexus')
                            ]); ?>
                        </div>
                        <?php endif; ?> 
                        <?php if(in_array('twitter', $share_icons)): ?>
                        <div class="social-item col-auto">
                            <?php pxl_site_share_link([
                                'icon' => 'twitter', 
                                'text' => esc_html__('Twitter', 'apexus')
                            ]); ?>
                        </div>
                        <?php endif; ?> 
                    </div>
                </div>
            </div>
            <?php
        }
        
        public function get_post_nav() {
            $post_navigation = apexus()->get_theme_opt( 'post_navigation', false );
            if($post_navigation != '1') return;
            global $post;

            $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
            $next     = get_adjacent_post( false, '', false );

            if ( ! $next && ! $previous )
                return;
            ?>
            <?php
            $next_post = get_next_post();
            $previous_post = get_previous_post();
            if(empty($previous_post) && empty($next_post)) return;

            ?>
            <div class="single-next-prev-nav row gx-0 justify-content-between align-items-center">
                <?php if(!empty($previous_post)): 
                    $thumbnail = get_the_post_thumbnail($previous_post->ID, 'thumbnail', []);
                    ?>
                    <div class="nav-next-prev prev col relative text-start">
                        <div class="nav-inner">
                            <?php previous_post_link('%link',''); ?>
                            <div class="nav-title-wrap align-items-center d-flex">
                                <?php if(!empty($thumbnail)): ?>
                                    <div class="col-auto nav-img"><?php echo wp_kses_post( $thumbnail ) ?></div>
                                <?php endif; ?>
                                <div class="col"><span class="nav-label"><?php echo esc_html__('Previous Post', 'apexus'); ?></span></div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($next_post)) : 
                    $thumbnail = get_the_post_thumbnail($next_post->ID, 'thumbnail', []);
                    ?>
                    <div class="nav-next-prev next col relative text-end">
                        <div class="nav-inner">
                            <?php next_post_link('%link',''); ?>
                            <div class="nav-title-wrap align-items-center d-flex">
                                <div class="col"><span class="nav-label"><?php echo esc_html__('Next Post', 'apexus'); ?></span></div>
                                <?php if(!empty($thumbnail)): ?>
                                    <div class="col-auto nav-img"><?php echo wp_kses_post( $thumbnail ) ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div> 
            <?php  
        }
 
        public function get_related_post(){
            $post_related_on = apexus()->get_theme_opt( 'post_related_on', false );
            if($post_related_on != '1') return;
            if($post_related_on) {
                global $post;
                $current_id = $post->ID;
                $posttags = get_the_category($post->ID);
                if (empty($posttags)) return;

                $tags = array();

                foreach ($posttags as $tag) {

                    $tags[] = $tag->term_id;
                }
                $post_number = '6';
                $query_similar = new WP_Query(array('posts_per_page' => $post_number, 'post_type' => 'post', 'post_status' => 'publish', 'category__in' => $tags));
                if (count($query_similar->posts) > 1) {
                    wp_enqueue_script( 'swiper' );
                    wp_enqueue_script( 'apexus-swiper' );
                    $opts = [
                        'slide_direction'      => 'horizontal',
                        'slide_percolumn'      => 1,
                        'slide_mode'           => 'slide',
                        'slides_to_show_xxl'   => 2,
                        'slides_to_show'       => 2,
                        'slides_to_show_lg'    => 2,
                        'slides_to_show_md'    => 2,
                        'slides_to_show_sm'    => 1,
                        'slides_to_show_xs'    => 1,
                        'slides_to_scroll'     => 1,
                        'slides_gutter'        => 22,
                        'slides_gutter_xl'     => 22,
                        'slides_gutter_lg'     => 22,
                        'slides_gutter_md'     => 22,
                        'slides_gutter_sm'     => 22,
                        'slides_gutter_xs'     => 22,
                        'center_slide'         => false,
                        'arrow'                => true,
                        'dots'                 => true,
                        'dots_style'           => 'bullets',
                        'autoplay'             => false,
                        'pause_on_hover'       => true,
                        'pause_on_interaction' => true,
                        'delay'                => 5000,
                        'loop'                 => false,
                        'speed'                => 500,
                    ];
                    $data_settings = wp_json_encode($opts);
                    $dir           = is_rtl() ? 'rtl' : 'ltr';
                    apexus()->add_render_attribute(
                        'carousel',
                        [
                            'class'         => 'pxl-swiper-container',
                            'dir'           => $dir,
                            'data-settings' => wp_json_encode($opts)
                        ],
                        null,
                        true
                    );
                    $related_title = apexus()->get_theme_opt('related_title');
                    if (empty($related_title)) {
                        $related_title = 'More Related Articles';
                    }
                    $related_subtitle = apexus()->get_theme_opt('related_subtitle');
                    if (empty($related_subtitle)) {
                        $related_subtitle = 'Explore our latest blog and articles for expert insights on web design, SEO, and digital trends.';
                    }
                    ?>
                    <div class="pxl-related-post">
                        <div class="ralated-box-title">
                            <h4 class="related-title"><?php echo esc_html( $related_title ); ?></h4>
                            <div class="description-relate">
                                <span class="related-des"><?php echo esc_html( $related_subtitle ); ?></span>
                            </div>
                        </div>
                        <div class="pxl-post-related pxl-theme-carousel">
                            <div class="pxl-swiper-slider pxl-post-carousel relative">
                                <div class="pxl-swiper-slider-inner pxl-carousel-inner overflow-hidden">
                                    <div <?php apexus()->print_render_attribute_string('carousel'); ?>>
                                        <div class="pxl-related-post-inner pxl-swiper-wrapper swiper-wrapper">
                                            <?php foreach ($query_similar->posts as $post):
                                                $thumbnail_url = '';
                                                if (has_post_thumbnail(get_the_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) :
                                                    $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'apexus-blog-small', false);
                                                endif;
                                                if ($post->ID !== $current_id) : ?>
                                                    <div class="pxl-swiper-slide swiper-slide grid-item">
                                                        <div class="grid-item-inner">
                                                            <?php if (has_post_thumbnail()) { ?>
                                                                <div class="item-featured">
                                                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($thumbnail_url[0]); ?>" /></a>
                                                                </div>
                                                            <?php } ?>
                                                            <div class="item-content">
                                                                <h3 class="item-title">
                                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                                </h3>
                                                                <div class="item-meta">
                                                                    <span class="item-date"><?php echo get_the_date('j M Y', $post->ID); ?></span>
                                                                    <?php echo esc_html('-', 'apexus'); ?>
                                                                    <span class="item-name"><?php echo esc_html('by ', 'apexus'); ?><?php the_author_posts_link(); ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif;
                                            endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            }

            wp_reset_postdata();
        }
    }
 
}