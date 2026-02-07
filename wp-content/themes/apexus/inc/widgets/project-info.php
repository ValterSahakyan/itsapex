<?php
defined( 'ABSPATH' ) or exit( -1 );

/**
 * Author Information widgets
 *
 */

if(!function_exists('pxl_register_wp_widget')) return;
add_action( 'widgets_init', function(){
    pxl_register_wp_widget( 'PXL_Project_Info_Widget' );
});
class PXL_Project_Info_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'pxl_project_info_widget',
            esc_html__('* Pxl Project Information', 'apexus'),
            array('categories' => esc_html__('Show Project Information', 'apexus'),)
        );
    }

    function widget($args, $instance)
    {
        extract($args);
        $project_title      = !empty($instance['project_title']) ? $instance['project_title'] : '';
        $client_name      = !empty($instance['client_name']) ? $instance['client_name'] : '';
        $categories      = !empty($instance['categories']) ? $instance['categories'] : '';
        $date_time      = !empty($instance['date_time']) ? $instance['date_time'] : '';
        
        if( is_single()){
            $post_id = get_the_ID();
            $user_id = get_the_author_meta( 'ID' );

            $categories      = !empty( get_the_author_meta( 'categories', $user_id )) ? get_the_author_meta( 'categories', $user_id ) : $categories;
        } 

        ?>
        <div class="pxl-project-info widget" >
            <div class="content-inner">
                <?php if (!empty($project_title)): ?>
                    <h4 class="widget-title"><?php echo esc_html($project_title);?></h4>
                <?php endif; ?>
                <?php if (!empty($client_name)): ?>
                    <div class="client-name">
                        <span><?php echo esc_html('Client:','apexus');?></span>
                        <span class="text"><?php echo esc_html($client_name);?></span>
                    </div>
                <?php endif; ?>
                <?php if (!empty($categories)): ?>
                    <div class="categories">
                        <span><?php echo esc_html('Categories:','apexus');?></span>
                        <div class="text"><?php echo apexus_html(nl2br($categories)); ?></div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($date_time)): ?>
                    <div class="date-time">
                        <span><?php echo esc_html('Date:','apexus');?></span>
                        <span class="text"><?php echo esc_html($date_time);?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['project_title'] = strip_tags($new_instance['project_title']);
        $instance['client_name'] = strip_tags($new_instance['client_name']);
        $instance['categories'] = strip_tags($new_instance['categories']);
        $instance['date_time'] = strip_tags($new_instance['date_time']);
  
        return $instance;
    }

    function form($instance)
    {
        $project_title  = isset($instance['project_title']) ? $instance['project_title'] : '';
        $client_name  = isset($instance['client_name']) ? $instance['client_name'] : '';
        $categories  = isset($instance['categories']) ? $instance['categories'] : '';
        $date_time  = isset($instance['date_time']) ? $instance['date_time'] : '';
        
        ?>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('project_title')); ?>"><?php esc_html_e( 'Project Title', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('project_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('project_title') ); ?>" type="text" value="<?php echo esc_attr( $project_title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('client_name')); ?>"><?php esc_html_e( 'Client Name', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('client_name') ); ?>" name="<?php echo esc_attr( $this->get_field_name('client_name') ); ?>" type="text" value="<?php echo esc_attr( $client_name ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('categories')); ?>"><?php esc_html_e('Categories', 'apexus'); ?></label>
            <textarea class="widefat" rows="2" cols="20" id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>"><?php echo wp_kses_post($categories); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_url($this->get_field_id('date_time')); ?>"><?php esc_html_e( 'Date', 'apexus' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('date_time') ); ?>" name="<?php echo esc_attr( $this->get_field_name('date_time') ); ?>" type="text" value="<?php echo esc_attr( $date_time ); ?>" />
        </p>
        <?php
    }
} 