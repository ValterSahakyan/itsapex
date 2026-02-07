<?php
/**
 * @package Apexus
 */
 
if ( post_password_required() )
    return;
$post_comment = apexus()->get_theme_opt('post_comment', '1');
$wrap_class = 'comments-area no-comments';
if(have_comments()) $wrap_class = 'comments-area';

if(is_page()) $wrap_class .= ' page-comment';

if($post_comment == '1'):
    $comments_number = absint( get_comments_number() );
?>
    <div id="comments" class="<?php echo esc_attr($wrap_class);?>">
        <?php
        if ( have_comments() ) : ?>
            <div class="comment-list-wrap">
                <h3 class="comments-title"><?php
                    printf(
                        /* translators: 1: Number of comments, 2: Post title. */
                        _nx(
                            'Comment',
                            'Comments',
                            $comments_number,
                            'comments title',
                            'apexus'
                        ),
                        number_format_i18n( $comments_number )
                    );
                ?></h3>
                  
                <ol class="commentlist">
                    <?php
                        wp_list_comments( array(
                            'style'      => 'ul',
                            'short_ping' => true,
                            'callback'   => [apexus()->comment, 'comment_list'],
                            'max_depth'  => 3
                        ) );
                    ?>
                </ol>
                <nav class="navigation comments-pagination empty-none"><?php 
                    //the_comments_navigation(); 
                    paginate_comments_links([
                        'prev_text' => '<span class="pxli-angle-left"></span>',
                        'next_text' => '<span class="pxli-angle-left"></span>'
                    ]); 
                ?></nav> 
 
            </div>
            <?php if ( ! comments_open() ) : ?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'apexus' ); ?></p>
            <?php
            endif;

        endif;
       
        comment_form(apexus()->comment->comment_form_args()); ?>
</div>

<?php endif; 