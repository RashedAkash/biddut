<?php 

/**
 * Template part for displaying post meta
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package biddut
 */

$categories = get_the_terms( $post->ID, 'category' );
$biddut_blog_date = get_theme_mod( 'biddut_blog_date', true );
$biddut_blog_comments = get_theme_mod( 'biddut_blog_comments', true );
$biddut_blog_author = get_theme_mod( 'biddut_blog_author', true );
$biddut_blog_cat = get_theme_mod( 'biddut_blog_cat', false );

?>
<div class="tp-postbox-meta">
    <?php if ( !empty($biddut_blog_author) ): ?>
    <span>
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>">
            <i class="fa-regular fa-user"></i>
            <?php echo get_the_author();?>
         </a>
    </span>
    <?php endif;?>

    <?php if ( !empty($biddut_blog_cat) ): ?>
    <?php if ( !empty( $categories[0]->name ) ): ?>
    <span> <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"> <i
                class="fa-regular fa-folder-open"></i>
            <?php echo esc_html($categories[0]->name); ?>
         </a> 
   </span>
    <?php endif;?>
    <?php endif;?>

    <?php if ( !empty($biddut_blog_date) ): ?>
    <span>
        <i class="fa-sharp fa-regular fa-calendar-days"></i>
        <?php the_time( get_option('date_format') ); ?>
    </span>
    <?php endif;?>

    <?php if ( !empty($biddut_blog_comments) ): ?>
    <span>
        <a href="<?php comments_link();?>">
            <i class="fa-regular fa-comments"></i>
            <?php comments_number();?>
        </a>
    </span>
    <?php endif;?>
</div>