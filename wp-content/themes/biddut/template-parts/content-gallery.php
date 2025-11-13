 <?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package biddut
 */

$gallery_images = function_exists('tpmeta_gallery_field')? tpmeta_gallery_field('biddut_post_gallery') : '';
$biddut_singleblog_social = get_theme_mod( 'biddut_singleblog_social', false );
  
$social_shear_col= $biddut_singleblog_social ? "col-lg-7 col-md-7" : "col-xl-12 col-md-12 col-lg-12";
if ( is_single() ): ?>

<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item tp-postbox-item-wrapper mb-80 format-image' );?>>
<?php if ( !empty( $gallery_images ) ): ?>
    <div class="tp-postbox-thumb p-relative mb-25">
        <div class="tp-blog-post-active swiper-container">
            <div class="swiper-wrapper">
                <?php foreach ( $gallery_images as $key => $image ): ?>
                <div class="swiper-slide">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                </div>
                <?php endforeach;?>
            </div>
        </div>
        <div class="tp-postbox-nav text-end">
            <button type="button" class="tp-blog-prev-1"><i class="fa-regular fa-arrow-left"></i>
            </button>
            <button type="button" class="tp-blog-next-1"><i class="fa-regular fa-arrow-right"></i>
            </button>
        </div>
    </div>
    <?php endif; ?>
     <!-- blog meta -->
     <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>

     <h3 class="tp-postbox-title2"><?php the_title();?></h3>
     <?php the_content();?>
     <?php
            wp_link_pages( [
                'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'biddut' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ] );
        ?>
     <div class="tp-postbox-share-wrapper">
         <div class="row">
             <div class=" <?php echo esc_attr($social_shear_col); ?>">
                 <?php echo biddut_get_tag(); ?>
             </div>
             <?php biddut_blog_social_share() ?>
         </div>
     </div>
 </article>


<?php else: 
    $categories = get_the_terms( $post->ID, 'category' );    
    $biddut_blog_cat = get_theme_mod( 'biddut_blog_cat', false );
?>

<article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item format-image mb-30 transition-3' );?>>
    <?php if ( !empty( $gallery_images ) ): ?>
         <div class="swiper-container postbox__thumb-slider-active">
            <div class="swiper-wrapper">
               <?php foreach ( $gallery_images as $key => $image ): ?>
                <div class="swiper-slide">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                </div>
                <?php endforeach;?>                
            </div>
        </div>
    <?php endif; ?>
        <div class="postbox__content">
            <div class="postbox__meta">
            <?php get_template_part( 'template-parts/blog/blog-meta' ); ?>
            </div>
            <h3 class="postbox__title">
            <a href="<?php the_permalink();?>"><?php the_title();?> </a>
            </h3>
            <div class="postbox__text">
                <?php the_excerpt();?>      
            </div> 
            <?php get_template_part( 'template-parts/blog/blog-btn' ); ?>
            
        </div>
    </article>






<?php
endif;?>