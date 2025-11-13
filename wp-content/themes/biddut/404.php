<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package biddut
 */
$biddut_error_404 = get_theme_mod('biddut_error_404', __("404 ", 'biddut'));
$biddut_error_title = get_theme_mod('biddut_error_title', __("Sorry We Can't Find That Page! ", 'biddut'));
$biddut_error_text = get_theme_mod('biddut_error_text', __("Oops! The page you are looking for does not exist. It might have been moved or deleted. ", 'biddut'));
$biddut_error_link_text = get_theme_mod('biddut_error_link_text', __('Back To Home', 'biddut'));


get_header();
?>
<div class="tp-error__area pt-120 pb-120">
   <div class="container">
         <div class="row">
            <div class="col-xl-12">
               <div class="tp-error__box text-center">
                     <div class="tp-error__404">
                       <h1 class="error-404-title"><?php print esc_html($biddut_error_404);?></h1>
                     </div>
                     <div class="tp-error__text mb-10">
                        <h4 class="tp-error__title"><?php print esc_html($biddut_error_title);?></h4>
                     </div>
                     <div class="tp-error__text mb-20">
                        <p><?php print esc_html($biddut_error_text);?></p>
                     </div>
                     <div class="tp-error__btn">                                
                        <a class="tp-btn" href="<?php print esc_url(home_url('/'));?>"><?php print esc_html($biddut_error_link_text);?></a>
                     </div>
               </div>
            </div>
         </div>
   </div>
</div>

<?php
get_footer();
