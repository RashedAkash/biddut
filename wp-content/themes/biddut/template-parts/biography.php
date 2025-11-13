<?php
    $author_data = get_the_author_meta( 'description', get_query_var( 'author' ) );
    $author_info = get_the_author_meta( 'biddut_write_by');
    $facebook_url = get_the_author_meta( 'biddut_facebook' );
    $twitter_url = get_the_author_meta( 'biddut_twitter' );
    $linkedin_url = get_the_author_meta( 'biddut_linkedin' );
    $instagram_url = get_the_author_meta( 'biddut_instagram' );
    $biddut_url = get_the_author_meta( 'biddut_youtube' );
    $biddut_write_by = get_the_author_meta( 'biddut_write_by' );
    $author_bio_avatar_size = 180;
    if ( $author_data != '' ):
?>

 <div class="postbox__author black-bg d-sm-flex align-items-start white-bg mb-50">
        <div class="postbox__author-thumb">
              <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>">
            <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ] );?>  
        </a>
        </div>
        <div class="postbox__author-content">
            <h3 class="postbox__author-title">
                <a href="<?php print esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )?>">
            <?php print get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size, '', '', [ 'class' => 'media-object img-circle' ] );?>  
        </a>
            </h3>
            <p>Supported substance consolidates parts of web promoting <br> and substance showcasing. It includes making</p>

            <div class="postbox__author-social d-flex align-items-center">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
        </div>
    </div>


<?php endif;?>
