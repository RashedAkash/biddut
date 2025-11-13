<?php
/**
 * Template for displaying Comments
 * Works with your postbox__comment and tp-btn markup
 */

if ( post_password_required() ) {
    return;
}
?>

<?php if ( have_comments() || comments_open() ) : ?>

<div id="comments" class="postbox__comment-area mb-60">

    <?php if ( have_comments() ) : ?>
    <div class="postbox__comment mb-50">
        <h3 class="postbox__title">
            <?php
                $count = get_comments_number();
                echo esc_html( $count ) . ' ' . ( $count == 1 ? esc_html__( 'Comment', 'biddut' ) : esc_html__( 'Comments', 'biddut' ) );
            ?>
        </h3>

        <ul class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'      => 'ul',
                    'avatar_size'=> 80,
                    'callback'   => function( $comment, $args, $depth ) {
                        ?>
                        <li <?php comment_class( empty( $args['has_children'] ) ? '' : 'children' ); ?> id="comment-<?php comment_ID(); ?>">
                            <div class="postbox__comment-box p-relative" id="div-comment-<?php comment_ID(); ?>">
                                <div class="postbox__comment-info d-flex align-items-start">
                                    <div class="postbox__comment-avater mr-40">
                                        <?php echo get_avatar( $comment, 80 ); ?>
                                    </div>
                                    <div class="postbox__comment-name p-relative">
                                        <h5><?php comment_author(); ?></h5>
                                        <div class="postbox__comment-text">
                                            <?php if ( $comment->comment_approved == '0' ) : ?>
                                                <em><?php esc_html_e( 'Your comment is awaiting moderation.', 'biddut' ); ?></em><br/>
                                            <?php endif; ?>
                                            <p><?php comment_text(); ?></p>
                                            <div class="postbox__comment-reply">
                                                <?php
                                                    comment_reply_link( array_merge( $args, array(
                                                        'reply_text' => '<i class="fa-regular fa-arrow-turn-down-left"></i>' . esc_html__( 'Reply', 'biddut' ),
                                                        'depth'      => $depth,
                                                        'max_depth'  => $args['max_depth']
                                                    ) ) );
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php
                    },
                ) );
            ?>
        </ul>
    </div>

    <?php
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
            echo '<div class="comment-pagination mb-50">';
            paginate_comments_links( array(
                'prev_text' => esc_html__( '← Older', 'biddut' ),
                'next_text' => esc_html__( 'Newer →', 'biddut' ),
            ) );
            echo '</div>';
        endif;
    ?>
    <?php endif; ?>

    <?php if ( comments_open() ) : ?>
    <div class="postbox__comment-form-box">
        <h3 class="postbox__comment-form-title pb-15">
            <?php esc_html_e( 'Write a comment', 'biddut' ); ?>
        </h3>

        <?php
            $commenter = wp_get_current_commenter();
            $req = get_option( 'require_name_email' );
            $aria_req = $req ? " aria-required='true'" : '';

            $fields = array(
                'author' => '
                    <div class="col-xl-6 col-lg-6 col-12 mb-20">
                        <div class="tp-contact-form-input-box">
                            <input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Enter your name', 'biddut' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />
                        </div>
                    </div>',
                'email' => '
                    <div class="col-xl-6 col-lg-6 col-12 mb-20">
                        <div class="tp-contact-form-input-box">
                            <input id="email" name="email" type="email" placeholder="' . esc_attr__( 'Enter your email', 'biddut' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '"' . $aria_req . ' />
                        </div>
                    </div>',
            );

            $args = array(
                'fields' => apply_filters( 'comment_form_default_fields', $fields ),
                'comment_field' => '
                    <div class="col-12 mb-20">
                        <div class="tp-contact-form-input-box">
                            <textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Write your message', 'biddut' ) . '" cols="45" rows="5" aria-required="true"></textarea>
                        </div>
                    </div>',
                'submit_button' => '<button type="submit" class="tp-btn"><span>' . esc_html__( 'SEND message', 'biddut' ) . '</span></button>',
                'class_form' => 'row',
                'title_reply' => '',
            );

            comment_form( $args );
        ?>
    </div>
    <?php endif; ?>

</div>
<?php endif; ?>
