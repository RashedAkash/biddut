 <?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package biddut
 */
$categories = get_the_terms( $post->ID, 'category' );
$biddut_blog_cat = get_theme_mod( 'biddut_blog_cat', false );
$biddut_singleblog_social = get_theme_mod( 'biddut_singleblog_social', false );
  
$social_shear_col= $biddut_singleblog_social ? "col-xl-6 col-lg-6 col-md-6" : "col-xl-12 col-md-12 col-lg-12";

if ( is_single() ) : ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('postbox__item format-image transition-3'); ?>>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="postbox__thumb p-relative m-img">
            <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
        </div>
    <?php endif; ?>

    <div class="postbox__content mb-70">

        <!-- Meta -->
        <div class="postbox__meta-box pb-5 d-flex justify-content-between align-items-center">
            <div class="postbox__meta">
                <?php get_template_part('template-parts/blog/blog-meta'); ?>
            </div>
        </div>

        <!-- Title -->
        <h3 class="postbox__title pb-5"><?php the_title(); ?></h3>

        <!-- Content -->
        <div class="postbox__text">
            <?php the_content(); ?>
        </div>

        <!-- Tags & Share -->
        <div class="postbox__details-share-wrapper mt-40">
            <div class="row align-items-center">
                
                <!-- Tags -->
                <div class="col-xl-5 col-lg-6 col-md-6">
                    <div class="postbox__details-tag tagcloud   d-flex r gap-2">
                        <span><?php esc_html_e('Tag:', 'biddut'); ?></span>
                        <?php echo biddut_get_tag(); ?>
                    </div>
                </div>

                <!-- Social Share -->
                <?php if ( function_exists('biddut_blog_social_share') ) : ?>
                    <div class="col-xl-7 col-lg-6 col-md-6">
                        <?php biddut_blog_social_share(); ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>

    </div><!-- /.postbox__content -->

</article>



 <?php else: ?>



    <article id="post-<?php the_ID();?>" <?php post_class( 'postbox__item format-image mb-30 transition-3' );?>>

    <?php if ( has_post_thumbnail() ): ?>
        <div class="postbox__thumb ">
            <a href="<?php the_permalink();?>">
            <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
            </a>
             
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

 

 <?php endif;?>