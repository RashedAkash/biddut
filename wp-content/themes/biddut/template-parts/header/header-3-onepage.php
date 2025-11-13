<?php 

	/**
	 * Template part for displaying header layout three
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package biddut
	*/
	// info
   $header_topbar_switch = get_theme_mod( 'header_topbar_switch', false );


   // Button Text
   $header_top_button_switch = get_theme_mod( 'header_top_button_switch', false);
   $header_top_button_text = get_theme_mod( 'header_button_text', __( 'Donate Now', 'biddut' ) );
   $header_top_button_link = get_theme_mod( 'header_button_link', __( '#', 'biddut' ) );

   // header right
   $biddut_header_right = get_theme_mod( 'header_right_switch', false );
   $biddut_menu_col = $biddut_header_right ? 'col-xxl-6 col-xl-6 col-lg-8 d-none d-lg-block' : 'col-xxl-9 col-xl-9 col-lg-8 d-none d-lg-block text-end';
   $header_search_switch = get_theme_mod( 'header_search_switch', false );

   //Phone
   $header_top_phone = get_theme_mod( 'header_phone', __( '+880190678956', 'biddut' ) );
   $header_top_time = get_theme_mod( 'header_top_time', __( 'Sunday - Friday: 9 am - 8 pm', 'biddut' ) );
   $header_top_menu = get_theme_mod( 'header_top_menu', __( 'top menu', 'biddut' ) );
   
   // Email id 
   $header_top_email = get_theme_mod( 'header_email', __( 'biddut@support.com', 'biddut' ) );
   $biddut_sticky_logo = get_theme_mod( 'header_sticky_logo', get_template_directory_uri() . '/assets/img/logo/logo-white.png' );
   // Header Address Text
   $header_top_address_text = get_theme_mod( 'header_address', __( '734 H, Bryan Burlington, NC 27215', 'biddut' ) );

   // Header Address Link
   $header_address_link = get_theme_mod( 'header_address_link', __( '#', 'biddut' ) );

   $header_language_switch = get_theme_mod( 'header_language_switch', false );

   // Header charity Text
   $header_top_charity_text = get_theme_mod( 'header_top_charity_text', __( 'Connect with our charity', 'biddut' ) );
      // header auth btn 
      $header_auth_switch = get_theme_mod( 'header_auth_switch', false );
      $header_auth_link = get_theme_mod( 'header_auth_link',"#" );

?>
<!-- header area start -->
<header class="tp-header-area-3 p-relative">
    <div class="tp-header-box-3">
        <div class="tp-header-logo-3 d-none d-xl-block">
            <?php biddut_header_logo(); ?>
        </div>

        <div class="tp-header-box-main-3">
            <div class="tp-header-top-3 d-none d-xl-block">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-xxl-7 col-xl-9">
                            <div class="tp-header-top-info-3">
                                <ul>
                                    <?php  if ( !empty( $header_top_email ) ): ?>
                                    <li>
                                        <a href="mailto:<?php echo esc_html( $header_top_email ); ?>"><span><i
                                                    class="fa-solid fa-envelope"></i></span><?php echo esc_html( $header_top_email ); ?></a>
                                    </li>
                                    <?php endif; ?>
                                    <?php  if ( !empty( $header_top_address_text ) ): ?>
                                    <li>
                                        <a href="<?php echo esc_url( $header_address_link ); ?>"
                                            target="_blank"><span><i
                                                    class="fa-sharp fa-solid fa-location-dot"></i></span><?php echo esc_html( $header_top_address_text ); ?></a>
                                    </li>
                                    <?php endif; ?>
                                    <?php  if ( !empty( $header_top_time ) ): ?>
                                    <li>
                                        <a href=""><span><i
                                                    class="fa-solid fa-clock"></i></span><?php echo esc_html__("Sunday - Friday:","biddut") ?><b><?php echo esc_html( $header_top_time ); ?></b></a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xxl-5 col-xl-3">
                            <div class="tp-header-top-right-3 d-flex justify-content-end align-items-center">
                                <div class="tp-header-top-social-3">
                                    <?php biddut_header_social_profiles(); ?>
                                </div>
                                <?php  if ( !empty( $header_top_time ) ): ?>
                                <div class="tp-header-top-support d-xxl-flex d-none">
                                    <?php echo biddut_kses( $header_top_menu ); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tp-header-wrapper-3">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-xxl-6 col-xl-7 col-6">
                            <div class="tp-main-menu home-3 align-items-center justify-content-between d-flex">
                                <div class="tp-main-menu-logo d-block d-xl-none">
                                    <?php biddut_header_black_logo(); ?>
                                </div>
                                <div class="d-none d-xl-flex">
                                    <nav class="tp-main-menu-content">
                                        <?php biddut_onepage_menu_01(); ?>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-5 col-6">
                            <div class="tp-header-main-right-3 d-flex align-items-center justify-content-xl-end">
                                <div class="tp-header-contact d-xl-flex d-none align-items-center">
                                    <?php  if ( !empty( $header_top_phone ) ): ?>
                                    <div class="tp-header-contact-inner-3 d-xxl-flex align-items-center d-none">
                                        <div class="tp-header-icon-3">
                                            <span><i class="fa-solid fa-phone"></i></span>
                                        </div>
                                        <div class="tp-header-contact-content">
                                            <p><?php echo esc_html__("Requesting A Call:","biddut") ?></p>
                                            <span><a
                                                    href="tel:<?php echo esc_attr( $header_top_phone ); ?>"><?php echo esc_html( $header_top_phone ); ?></a></span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php  if ( !empty( $header_search_switch ) ): ?>
                                    <div class="tp-header-contact-search-3 search-open-btn">
                                        <span><i class="fa-solid fa-magnifying-glass"></i></span>
                                    </div>
                                    <?php endif; ?>
                                    <?php  if ( !empty( $header_top_button_switch ) and !empty( $header_top_button_text ) ): ?>
                                    <div class="tp-header-btn-3">
                                        <a class="tp-btn"
                                            href="<?php echo esc_url( $header_top_button_link ); ?>"><?php echo esc_html( $header_top_button_text ); ?></a>
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
        </div>
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