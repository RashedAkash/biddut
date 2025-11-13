<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package biddut
 */

$biddut_blog_btn = get_theme_mod( 'biddut_blog_btn', 'Read More' );
$biddut_blog_btn_switch = get_theme_mod( 'biddut_blog_btn_switch', true );

?>
<?php if ( !empty( $biddut_blog_btn_switch ) ): ?>
<div class="postbox__read-more">
    <a href="<?php the_permalink();?>" class="tp-btn-black"> <?php print esc_html( $biddut_blog_btn );?></a>
</div>
<?php endif;?>
