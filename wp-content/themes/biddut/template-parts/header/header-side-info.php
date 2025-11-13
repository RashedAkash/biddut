<?php 

   /**
    * Template part for displaying header side information
    *
    * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
    *
    * @package biddut
   */

    $header_side_logo = get_theme_mod( 'header_side_logo', get_template_directory_uri() . '/assets/img/logo/white-logo.png' );

    // Contacts Text 
    $header_side_contacts_text = get_theme_mod( 'header_side_contacts_text', __( 'CONTACT US', 'biddut' ) );

    // Contacts Text 
    $header_side_contacts_text = get_theme_mod( 'header_side_contacts_text', __( 'CONTACT US', 'biddut' ) );
   // Email id 
   $header_side_email = get_theme_mod( 'header_side_email', __( 'biddut@support.com', 'biddut' ) );

   // Phone Number
   $header_side_phone = get_theme_mod( 'header_side_phone', __( '+8801310-069824', 'biddut' ) );

   // Header Address Text
   $header_side_address_text = get_theme_mod( 'header_side_address', __( '734 H, Bryan Burlington, NC 27215', 'biddut' ) );

   // Header Address Link
   $header_side_address_link = get_theme_mod( 'header_side_address_link', __( 'https://www.google.com/maps/@36.0758266,-79.4558848,17z', 'biddut' ) );


   //Offcanvas About Us
   $offcanvas_about_us = get_theme_mod( 'header_top_offcanvas_textarea', __( 'Web designing in a powerful way of just not an only professions. We have tendency to believe the idea that smart looking .', 'biddut' ) );

   //header_side_mailchimp
   $header_side_mailchimp = get_theme_mod( 'header_side_mailchimp', __( '[contact-form-7 id="a429561" title="Untitled"]', 'biddut' ) );

    // header_side_info_switch
    $header_side_info_switch = get_theme_mod( 'header_side_info_switch', false );

?>

 <!-- tp-offcanvus-area-start -->
   <div class="tpoffcanvas-area">
      <div class="tpoffcanvas">
         <div class="tpoffcanvas__close-btn">
            <button class="close-btn"><i class="fal fa-times"></i></button>
         </div>
         <div class="tpoffcanvas__logo">
            <a href="<?php echo esc_url( home_url( '/' ) );?>">
                     <img src="<?php echo esc_url($header_side_logo);?>" alt="<?php echo esc_attr__( 'logo', 'biddut' );?>">
            </a>
         </div>

         <?php if(!empty($header_side_info_switch )): ?>
         <div class="tpoffcanvas__title">
            <p><?php echo esc_html($offcanvas_about_us); ?></p>
         </div>
         <?php endif; ?>

         <div class="tp-main-menu-mobile d-xl-none"></div>

         <?php if(!empty($header_side_info_switch )): ?>
         <div class="tpoffcanvas__contact-info">
            <div class="tpoffcanvas__contact-title">
               <h5><?php echo esc_html($header_side_contacts_text); ?></h5>
            </div>
            <ul>
               <li>
                  <i class="fa-light fa-location-dot"></i>
                  <a href="<?php echo esc_attr($header_side_address_link);?>" target="_blank"><?php echo esc_html($header_side_address_text);?></a>
               </li>
               <li>
                  <i class="fas fa-envelope"></i>
                  <a href="mailto:<?php echo esc_attr($header_side_email);?>"><?php echo esc_attr($header_side_email);?></a>
               </li>
               <li>
                  <i class="fal fa-phone-alt"></i>
                  <a href="tel:<?php echo esc_attr( $header_side_phone);?>"><?php echo esc_attr( $header_side_phone);?></a>
               </li>
            </ul>
         </div>
         <?php endif; ?>



        
         <?php if ( !empty($header_side_info_switch) ) : ?>
         <?php if ($header_side_mailchimp) : ?>
   <div class="tpoffcanvas__input">
      <div class="tpoffcanvas__input-title">
         <h4>Get Update</h4>
      </div>

      <?php
         // Contact Form 7 shortcode
         echo do_shortcode($header_side_mailchimp);
      ?>
   </div>
   <?php else: ?>
    <p><?php echo esc_html__('please enter your shortcode here'); ?></p>
<?php endif; ?>
<?php endif; ?>

         


         <?php if(!empty($header_side_info_switch )): ?>
         <div class="tpoffcanvas__social">
            <div class="social-icon">
               <?php biddut_header_social_profiles(); ?>
            </div>
         </div>
         <?php endif; ?>

      </div>
   </div>
   <div class="body-overlay"></div>
   <!-- tp-offcanvus-area-end -->


