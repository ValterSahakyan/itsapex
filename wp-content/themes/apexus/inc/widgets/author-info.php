<?php
defined( 'ABSPATH' ) or exit( -1 );

/**
 * Author Information widgets
 *
 */

if(!function_exists('pxl_register_wp_widget')) return;
add_action( 'widgets_init', function(){
    pxl_register_wp_widget( 'PXL_Author_Info_Widget' );
});
class PXL_Author_Info_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'pxl_author_info_widget',
            esc_html__('* Pxl Author Information', 'apexus'),
            array('description' => esc_html__('Show Author Information, It will get data of author in single post', 'apexus'),)
        );
    }

    function widget($args, $instance)
    {
        extract($args);

        $author_image_id  = !empty($instance['author_image']) ? $instance['author_image'] : '';
        $author_image_url = wp_get_attachment_image_url($author_image_id, '');
        $author_name      = !empty($instance['author_name']) ? $instance['author_name'] : '';
        $author_role      = !empty($instance['author_role']) ? $instance['author_role'] : '';
        $description      = !empty($instance['description']) ? $instance['description'] : '';

        $author_facebook_link  = !empty($instance['author_facebook_link']) ? $instance['author_facebook_link'] : '';
        $author_twitter_link   = !empty($instance['author_twitter_link']) ? $instance['author_twitter_link'] : '';
        $author_linkedin_link  = !empty($instance['author_linkedin_link']) ? $instance['author_linkedin_link'] : '';
        $author_telegram_link  = !empty($instance['author_telegram_link']) ? $instance['author_telegram_link'] : '';
        $author_pinterest_link = !empty($instance['author_pinterest_link']) ? $instance['author_pinterest_link'] : '';
        $author_instagram_link = !empty($instance['author_instagram_link']) ? $instance['author_instagram_link'] : '';
        $author_youtube_link   = !empty($instance['author_youtube_link']) ? $instance['author_youtube_link'] : '';
        $author_vimeo_link     = !empty($instance['author_vimeo_link']) ? $instance['author_vimeo_link'] : '';
        $author_skype_link     = !empty($instance['author_skype_link']) ? $instance['author_skype_link'] : '';
        $author_google_link    = !empty($instance['author_google_link']) ? $instance['author_google_link'] : '';
        $author_tumblr_link    = !empty($instance['author_tumblr_link']) ? $instance['author_tumblr_link'] : '';
        $author_rss_link       = !empty($instance['author_rss_link']) ? $instance['author_rss_link'] : '';
        
        if( is_single()){
            $post_id = get_the_ID();
            $user_id = get_the_author_meta( 'ID' );
            
            $author_name      = get_the_author();
            $description      = !empty( get_the_author_meta( 'description', $user_id )) ? get_the_author_meta( 'description', $user_id ) : $description;
            if( class_exists('Pu_User_Profile') ){
                $user_metas = Pu_User_Profile::pu_get_user_meta($user_id);
                if( !empty( $user_metas)){
                    $author_role           = $user_metas['pu_author_brief_desc'];
                    $author_facebook_link  = $user_metas['pu_user_facebook'];
                    $author_twitter_link   = $user_metas['pu_user_twitter'];
                    $author_linkedin_link  = $user_metas['pu_user_linkedin'];
                    $author_telegram_link  = $user_metas['pu_user_telegram'];
                    $author_pinterest_link = $user_metas['pu_user_pinterest'];
                    $author_instagram_link = $user_metas['pu_user_instagram'];
                    $author_youtube_link   = $user_metas['pu_user_youtube'];
                    $author_vimeo_link     = $user_metas['pu_user_vimeo'];
                    $author_skype_link     = $user_metas['pu_user_skype'];
                    $author_google_link    = $user_metas['pu_user_google'];
                    $author_tumblr_link    = $user_metas['pu_user_tumblr'];
                    $author_rss_link       = $user_metas['pu_user_rss'];
                }
            }
        } 

        ?>
        <div class="pxl-author-info widget" >
            <div class="content-inner">
                <div class="author-image">
                    <div class="image-wrap">
                        <?php if( is_single()): ?>
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 250 ); ?>
                        <?php else: ?>
                            <img src="<?php echo esc_url($author_image_url)?>" alt="<?php echo esc_attr__('Author Image', 'apexus');?>">
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (!empty($author_name)): ?>
                    <h4 class="author-name"><?php echo esc_html($author_name);?></h4>
                <?php endif; ?>
                <?php if (!empty($author_role)): ?>
                    <span class="author-role"><?php echo esc_html($author_role);?></span>
                <?php endif; ?>
                <?php if (!empty($description)): ?>
                    <div class="author-desc p"><?php echo apexus_html(nl2br($description)); ?></div>
                <?php endif; ?>
                <?php if ( !empty($author_facebook_link) || !empty($author_twitter_link) || !empty($author_linkedin_link) || !empty($author_telegram_link) || !empty($author_pinterest_link) || !empty($author_instagram_link) || !empty($author_youtube_link) || !empty($author_vimeo_link) || !empty($author_skype_link) || !empty($author_google_link) || !empty($author_tumblr_link) || !empty($author_rss_link)): ?>
                    <div class="author-social d-flex-wrap justify-content-center">
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
                        <?php if(!empty($author_google_link)): ?>
                            <div class="social-item google d-flex align-items-center">
                                <a href="<?php echo esc_url($author_google_link); ?>"><span class="pxl-icon pxli-google"></span></a>
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
                        <?php if(!empty($author_telegram_link)): ?>
                            <div class="social-item linkedin d-flex align-items-center">
                                <a href="<?php echo esc_url($author_telegram_link); ?>"><span class="pxl-icon pxli-telegram-svgrepo-com"></span></a>
                            </div>
                        <?php endif; ?>
                         
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['author_image'] = strip_tags($new_instance['author_image']);
        $instance['author_name'] = strip_tags($new_instance['author_name']);
        $instance['author_role'] = strip_tags($new_instance['author_role']);
        $instance['description'] = strip_tags($new_instance['description']);

        $instance['author_facebook_link']  = strip_tags($new_instance['author_facebook_link']);
        $instance['author_twitter_link']   = strip_tags($new_instance['author_twitter_link']);
        $instance['author_linkedin_link']  = strip_tags($new_instance['author_linkedin_link']);
        $instance['author_telegram_link']  = strip_tags($new_instance['author_telegram_link']);
        $instance['author_pinterest_link'] = strip_tags($new_instance['author_pinterest_link']);
        $instance['author_instagram_link'] = strip_tags($new_instance['author_instagram_link']);
        $instance['author_youtube_link']   = strip_tags($new_instance['author_youtube_link']);
        $instance['author_vimeo_link']     = strip_tags($new_instance['author_vimeo_link']);
        $instance['author_skype_link']     = strip_tags($new_instance['author_skype_link']);
        $instance['author_google_link']    = strip_tags($new_instance['author_google_link']);
        $instance['author_tumblr_link']    = strip_tags($new_instance['author_tumblr_link']);
        $instance['author_rss_link']       = strip_tags($new_instance['author_rss_link']);
  
        return $instance;
    }

    function form($instance)
    {
        $author_image = isset($instance['author_image']) ? esc_attr($instance['author_image']) : '';
        $author_name  = isset($instance['author_name']) ? $instance['author_name'] : '';
        $author_role  = isset($instance['author_role']) ? $instance['author_role'] : '';
        $description  = isset($instance['description']) ? $instance['description'] : '';
 
        $author_facebook_link  = isset($instance['author_facebook_link']) ? $instance['author_facebook_link'] : '';
        $author_twitter_link   = isset($instance['author_twitter_link']) ? $instance['author_twitter_link'] : '';
        $author_linkedin_link  = isset($instance['author_linkedin_link']) ? $instance['author_linkedin_link'] : '';
        $author_telegram_link  = isset($instance['author_telegram_link']) ? $instance['author_telegram_link'] : '';
        $author_pinterest_link = isset($instance['author_pinterest_link']) ? $instance['author_pinterest_link'] : '';
        $author_instagram_link = isset($instance['author_instagram_link']) ? $instance['author_instagram_link'] : '';
        $author_youtube_link   = isset($instance['author_youtube_link']) ? $instance['author_youtube_link'] : '';
        $author_vimeo_link     = isset($instance['author_vimeo_link']) ? $instance['author_vimeo_link'] : '';
        $author_skype_link     = isset($instance['author_skype_link']) ? $instance['author_skype_link'] : '';
        $author_google_link    = isset($instance['author_google_link']) ? $instance['author_google_link'] : '';
        $author_tumblr_link    = isset($instance['author_tumblr_link']) ? $instance['author_tumblr_link'] : '';
        $author_rss_link       = isset($instance['author_rss_link']) ? $instance['author_rss_link'] : '';
        
        ?>
        <div class="apexus-image-wrap">
            <label for="<?php echo esc_url($this->get_field_id('author_image')); ?>"><?php esc_html_e('Author Image', 'apexus'); ?></label>
            <input type="hidden" class="widefat hide-image-url"
                   id="<?php echo esc_attr($this->get_field_id('author_image')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('author_image')); ?>"
                   value="<?php echo esc_attr($author_image) ?>"/>
            <div class="pxl-show-image">
                <?php
                if ($author_image != "") {
                    ?>
                    <img src="<?php echo wp_get_attachment_image_url($author_image) ?>">
                    <?php
                }
                ?>
            </div>
            <?php
            if ($author_image != "") {
                ?>
                <a href="#" class="pxl-select-image" style="display: none;"><?php esc_html_e('Select Image', 'apexus'); ?></a>
                <a href="#" class="pxl-remove-image"><?php esc_html_e('Remove Image', 'apexus'); ?></a>
                <?php
            } else {
                ?>
                <a href="#" class="pxl-select-image"><?php esc_html_e('Select Image', 'apexus'); ?></a>
                <a href="#" class="pxl-remove-image" style="display: none;"><?php esc_html_e('Remove Image', 'apexus'); ?></a>
                <?php
            }
            ?>
        </div>
        
        <p>
            <label for="<?php echo esc_url($this->get_field_id('author_name')); ?>"><?php esc_html_e( 'Author Name', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_name') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_name') ); ?>" type="text" value="<?php echo esc_attr( $author_name ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('author_role')); ?>"><?php esc_html_e( 'Author Role', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_role') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_role') ); ?>" type="text" value="<?php echo esc_attr( $author_role ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('description')); ?>"><?php esc_html_e('Description', 'apexus'); ?></label>
            <textarea class="widefat" rows="4" cols="20" id="<?php echo esc_attr($this->get_field_id('description')); ?>" name="<?php echo esc_attr($this->get_field_name('description')); ?>"><?php echo wp_kses_post($description); ?></textarea>
        </p>

        
        <p>
            <label for="<?php echo esc_url($this->get_field_id('author_facebook_link')); ?>"><?php esc_html_e( 'Facebook Link', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_facebook_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_facebook_link') ); ?>" type="text" value="<?php echo esc_attr( $author_facebook_link ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('author_twitter_link')); ?>"><?php esc_html_e( 'Twitter Link', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_twitter_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_twitter_link') ); ?>" type="text" value="<?php echo esc_attr( $author_twitter_link ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('author_linkedin_link')); ?>"><?php esc_html_e( 'Linkedin Link', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_linkedin_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_linkedin_link') ); ?>" type="text" value="<?php echo esc_attr( $author_linkedin_link ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('author_telegram_link')); ?>"><?php esc_html_e( 'Telegram Link', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_telegram_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_telegram_link') ); ?>" type="text" value="<?php echo esc_attr( $author_telegram_link ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('author_pinterest_link')); ?>"><?php esc_html_e( 'Pinterest Link', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_pinterest_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_pinterest_link') ); ?>" type="text" value="<?php echo esc_attr( $author_pinterest_link ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('author_instagram_link')); ?>"><?php esc_html_e( 'Instagram Link', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_instagram_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_instagram_link') ); ?>" type="text" value="<?php echo esc_attr( $author_instagram_link ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('author_youtube_link')); ?>"><?php esc_html_e( 'Youtube Link', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_youtube_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_youtube_link') ); ?>" type="text" value="<?php echo esc_attr( $author_youtube_link ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('author_vimeo_link')); ?>"><?php esc_html_e( 'Vimeo Link', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_vimeo_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_vimeo_link') ); ?>" type="text" value="<?php echo esc_attr( $author_vimeo_link ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('author_skype_link')); ?>"><?php esc_html_e( 'Skype Link', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_skype_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_skype_link') ); ?>" type="text" value="<?php echo esc_attr( $author_skype_link ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('author_google_link')); ?>"><?php esc_html_e( 'Google Link', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_google_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_google_link') ); ?>" type="text" value="<?php echo esc_attr( $author_google_link ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('author_tumblr_link')); ?>"><?php esc_html_e( 'Tumblr Link', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_tumblr_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_tumblr_link') ); ?>" type="text" value="<?php echo esc_attr( $author_tumblr_link ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('author_rss_link')); ?>"><?php esc_html_e( 'Rss Link', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_rss_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_rss_link') ); ?>" type="text" value="<?php echo esc_attr( $author_rss_link ); ?>" />
        </p>
        
        <?php
    }
} 