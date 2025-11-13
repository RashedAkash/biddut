<?php 

	/**
	 * Template part for displaying header layout two
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package biddut
	*/

	 // info
    $biddut_topbar_switch = get_theme_mod( 'header_topbar_switch', false );


     // Phone Number
   $header_top_phone = get_theme_mod( 'header_phone', __( '+8801310-069824', 'biddut' ) );

    // contact button
	$biddut_button_text = get_theme_mod( 'biddut_button_text', __( 'Make Request', 'biddut' ) );
   $biddut_button_link = get_theme_mod( 'biddut_button_link', __( '#', 'biddut' ) );

    // acc button
	$biddut_acc_button_text = get_theme_mod( 'biddut_acc_button_text', __( 'Login', 'biddut' ) );
   $biddut_acc_button_link = get_theme_mod( 'biddut_acc_button_link', __( '#', 'biddut' ) );

    $biddut_sticky_logo = get_theme_mod( 'header_sticky_logo', get_template_directory_uri() . '/assets/img/logo/logo-white.png' );
  // Header Address Text
  $header_top_address_text = get_theme_mod( 'header_address', __( '734 H, Bryan Burlington, NC 27215', 'biddut' ) );
  $header_address_link = get_theme_mod( 'header_address_link', __( '#', 'biddut' ) );
    
   // Button Text
   $header_top_button_switch = get_theme_mod( 'header_top_button_switch', false);
   $header_top_button_text = get_theme_mod( 'header_button_text', __( 'Donate Now', 'biddut' ) );

   // Button Text
   $header_top_button_link = get_theme_mod( 'header_button_link', __( '#', 'biddut' ) );
       // header right
   $biddut_header_right = get_theme_mod( 'header_right_switch', false );
   $biddut_menu_col = $biddut_header_right ? 'col-xl-7 col-lg-8 d-none d-lg-block' : 'col-xl-10 col-lg-8 d-none d-lg-block';
   $biddut_menu_end = $biddut_header_right ? '' : 'justify-content-end';
   // header search btn 
   $header_search_switch = get_theme_mod( 'header_search_switch', false );

   // header auth btn 
   $header_auth_switch = get_theme_mod( 'header_auth_switch', false );
   $header_auth_link = get_theme_mod( 'header_auth_link',"#" );
?>



<!-- header area start -->
<header class="tp-header-area p-relative">
    <div class="tp-header-box p-relative">
        <div class="tp-header-logo p-relative">
            <span class="tp-header-logo-bg"></span>
            <?php biddut_header_logo(); ?>
        </div>
        <div class="tp-header-wrapper-inner header__sticky p-relative">
            <?php if(!empty($biddut_topbar_switch)) : ?>
            <div class="tp-header-top d-none d-xl-flex">
                <?php if(!empty($header_top_address_text)) : ?>
                <div class="tp-header-top-info">
                    <a href="<?php echo esc_url( $header_address_link ); ?>"><span><i class="fa-sharp fa-solid fa-location-dot"></i></span><?php echo esc_html( $header_top_address_text ); ?></a>
                </div>
                <?php endif; ?>
                <div class="tp-header-top-right d-flex justify-content-end align-items-center">
                    <div class="header-social ">
                        <?php biddut_header_social_profiles(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="tp-header-main-menu d-flex align-items-center justify-content-between">
                <div class="tp-main-menu d-none d-xl-block">
                    <nav class="tp-main-menu-content">
                        <?php biddut_onepage_menu_01(); ?>
                    </nav>
                </div>
                <?php if(!empty($biddut_header_right)) : ?>
                <div class="tp-header-main-right d-flex align-items-center justify-content-xl-end">
                    <div class="tp-header-contact d-xl-flex align-items-center d-none">
                        <div class="tp-header-contact-search search-open-btn d-none d-xxl-block">
                            <span><i class="fa-solid fa-magnifying-glass"></i></span>
                        </div>
                        <?php  if ( !empty( $header_top_phone ) ): ?>
                        <div class="tp-header-contact-inner d-flex align-items-center">
                            <div class="tp-header-contact-icon">
                                <span><i class="fa-solid fa-phone"></i></span>
                            </div>
                            <div class="tp-header-contact-content">
                                <p><?php echo esc_html__("Requesting A Call:","biddut") ?></p>
                                <span><a
                                        href="tel:<?php echo esc_attr( $header_top_phone ); ?>"><?php echo esc_html( $header_top_phone ); ?></a></span>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="tp-header-sticky-hamburger d-xl-none offcanvas-open-btn">
                        <button class="hamburger-btn">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php  if ( !empty( $header_top_button_switch ) and !empty( $header_top_button_text ) ): ?>
        <div class="tp-header-btn">
            <a class="tp-btn d-none d-xl-block"
                href="<?php echo esc_url( $header_top_button_link ); ?>"><?php echo esc_html( $header_top_button_text ); ?><i
                    class="fa-regular fa-arrow-right"></i></a>
            <div class="tp-header-main-right-hamburger-btn d-xl-none offcanvas-open-btn">
                <button class="hamburger-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
        <?php endif; ?>
        <?php  if ( empty( $biddut_header_right ) ): ?>
        <div class="tp-header-btn d-xl-none">
            <a class="tp-btn d-none d-xl-block"
                href="<?php echo esc_url( $header_top_button_link ); ?>"><?php echo esc_html( $header_top_button_text ); ?><i
                    class="fa-regular fa-arrow-right"></i></a>
            <div class="tp-header-main-right-hamburger-btn d-xl-none offcanvas-open-btn">
                <button class="hamburger-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
        <?php endif; ?>
    </div>
</header>
<!-- header area end -->
<!-- sticky header start -->
<header id="header-sticky" class="tp-header-main-sticky p-relative">
    <div class="tp-header-space-2">
        <div class="container-fluid">
            <div class="row align-items-center"> 
                <div class="col-xl-3 col-6">
                    <div class="tp-header-logo-2 p-relative">
                        <?php biddut_header_black_logo(); ?>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-xl-block">
                    <div class="tp-main-menu home-2 d-none d-xl-block">
                        <nav class="tp-main-menu-content">
                            <?php biddut_onepage_menu_01(); ?>
                        </nav>
                    </div>
                </div>
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
                                    <span><a
                                            href="tel:<?php echo esc_attr( $header_top_phone ); ?>"><?php echo esc_html( $header_top_phone ); ?></a></span>
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
            </div>
        </div>
    </div>
</header>
<!-- sticky header end -->

<?php get_template_part( 'template-parts/header/header-side-info' ); ?>