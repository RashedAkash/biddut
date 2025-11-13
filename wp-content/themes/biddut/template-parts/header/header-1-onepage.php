<?php 

	/**
	 * Template part for displaying header layout one
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package biddut
	*/

	// info
    $header_topbar_switch = get_theme_mod( 'header_topbar_switch', false );

   // Email id 
   $header_top_email = get_theme_mod( 'header_email', __( 'biddut@support.com', 'biddut' ) );

   // Phone Number
   $header_top_phone = get_theme_mod( 'header_phone', __( '+8801310-069824', 'biddut' ) );

   // Header Address Text
   $header_top_address_text = get_theme_mod( 'header_address', __( '734 H, Bryan Burlington, NC 27215', 'biddut' ) );

   // Header charity Text
   $header_top_charity_text = get_theme_mod( 'header_top_charity_text', __( 'Connect with our charity', 'biddut' ) );

   // Header Address Link
   $header_top_address_link = get_theme_mod( 'header_address_link', __( '#', 'biddut' ) );

   // Button Text
   $header_top_button_switch = get_theme_mod( 'header_top_button_switch', false);
   $header_top_button_text = get_theme_mod( 'header_button_text', __( 'Donate Now', 'biddut' ) );

   // Button Text
   $header_top_button_link = get_theme_mod( 'header_button_link', __( '#', 'biddut' ) );

   $header_language_switch = get_theme_mod( 'header_language_switch', __( 'false', 'biddut' ) );
   $phone_number_url = preg_replace("/[^0-9]/", "", $header_top_phone); 

   // header right
   $biddut_header_right = get_theme_mod( 'header_right_switch', false );
   $biddut_menu_col = $biddut_header_right ? 'col-xl-7 col-lg-8 d-none d-lg-block' : 'col-xl-10 col-lg-8 d-none d-lg-block';
   $biddut_menu_end = $biddut_header_right ? '' : 'd-flex justify-content-end';

//    col-xl-7 d-none d-xl-block

   // header search btn 
   $header_search_switch = get_theme_mod( 'header_search_switch', true );

   // header auth btn 
   $header_auth_switch = get_theme_mod( 'header_auth_switch', true );
   $header_auth_link = get_theme_mod( 'header_auth_link',"#" );

?>

<!-- header area start -->
<header id="header-sticky" class="tp-header-area-2 p-relative tp-header-height">
    <div class="tp-header-space-2">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-xl-3 col-6">
                    <div class="tp-header-logo-2 p-relative">
                        <?php biddut_header_logo(); ?>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-xl-block">
                    <div class="tp-main-menu home-2 d-none d-xl-block">
                        <nav class="tp-main-menu-content">
                            <?php biddut_onepage_menu_01(); ?>
                        </nav>
                    </div>
                </div>
                <?php  if ( !empty( $biddut_header_right ) ): ?>
                <div class="col-xl-3 col-6">
                    <div class="tp-header-main-right-2 d-flex align-items-center justify-content-xl-end">
                        <div class="tp-header-contact-2 d-flex align-items-center">
                            <?php  if ( !empty( $header_search_switch ) ): ?>
                            <div class="tp-header-contact-search search-open-btn d-none d-xxl-block">
                                <span><i class="fa-solid fa-magnifying-glass"></i></span>
                            </div>
                            <?php endif; ?>
                            <?php  if ( !empty( $header_top_phone ) ): ?>
                            <div class="tp-header-contact-inner d-none d-xl-flex align-items-center">
                                 <div class="tp-header-contact-icon">
                                    <span><i class="fa-solid fa-phone"></i></span>
                                </div>
                                <div class="tp-header-contact-content">
                                    <p><?php echo esc_html__("Requesting A Call:","biddut") ?></p>
                                    <span><a href="tel:<?php echo biddut_kses($phone_number_url); ?>"><?php echo esc_html( $header_top_phone ); ?></a></span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="tp-header-main-right-hamburger-btn d-xl-none offcanvas-open-btn text-end">
                            <button class="hamburger-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php  if ( empty( $biddut_header_right ) ): ?>
                <div class="col-xl-3 col-6">
                    <div class="tp-header-main-right-2 d-flex align-items-center justify-content-xl-end">
                        <div class="tp-header-main-right-hamburger-btn d-xl-none offcanvas-open-btn text-end">
                            <button class="hamburger-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>  
            </div>
        </div>
    </div>
</header>
<!-- header area end -->
<?php get_template_part( 'template-parts/header/header-side-info' ); ?>