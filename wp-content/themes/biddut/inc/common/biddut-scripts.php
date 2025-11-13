<?php

/**
 * biddut_scripts description
 * @return [type] [description]
 */
function biddut_scripts() {

    /**
     * all css files
    */ 

    wp_enqueue_style( 'biddut-fonts', biddut_fonts_url(), array(), '1.0.0' );
    if( is_rtl() ){
        wp_enqueue_style( 'bootstrap-rtl', Biddut_THEME_CSS_DIR.'bootstrap.rtl.min.css', array() );
    }else{
        wp_enqueue_style( 'bootstrap', Biddut_THEME_CSS_DIR.'bootstrap.css', array() );
    }
    wp_enqueue_style( 'animate', Biddut_THEME_CSS_DIR . 'animate.css', [] );
    wp_enqueue_style( 'swiper-bundle', Biddut_THEME_CSS_DIR . 'swiper-bundle.css', [] );
    wp_enqueue_style( 'magnific-popup', Biddut_THEME_CSS_DIR . 'magnific-popup.css', [] );
    wp_enqueue_style( 'slick', Biddut_THEME_CSS_DIR . 'slick.css', [] );
    // wp_enqueue_style( 'nice-select', Biddut_THEME_CSS_DIR . 'nice-select.css', [] );    
    wp_enqueue_style( 'font-awesome-pro', Biddut_THEME_CSS_DIR . 'font-awesome-pro.css', [] );
    wp_enqueue_style( 'flaticon', Biddut_THEME_CSS_DIR . 'flaticon_biddut.css', [] );
    wp_enqueue_style( 'spacing', Biddut_THEME_CSS_DIR . 'spacing.css', [] );
    wp_enqueue_style( 'biddut-custom-animation', Biddut_THEME_CSS_DIR . 'custom-animation.css', [] );
    wp_enqueue_style( 'biddut-core', Biddut_THEME_CSS_DIR . 'biddut-core.css', [],time()  );
    wp_enqueue_style( 'biddut-unit', Biddut_THEME_CSS_DIR . 'biddut-unit.css', [],time()  );
    wp_enqueue_style( 'biddut-custom', Biddut_THEME_CSS_DIR . 'biddut-custom.css', [] );
    wp_enqueue_style( 'biddut-style', get_stylesheet_uri() );


    // all js
    wp_enqueue_script( 'waypoints', Biddut_THEME_JS_DIR . 'waypoints.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'bootstrap-bundle', Biddut_THEME_JS_DIR . 'bootstrap-bundle.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'swiper-bundle', Biddut_THEME_JS_DIR . 'swiper-bundle.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'jarallax', Biddut_THEME_JS_DIR . 'jarallax.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'range-slider', Biddut_THEME_JS_DIR . 'range-slider.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'slick', Biddut_THEME_JS_DIR . 'slick.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'magnific-popup', Biddut_THEME_JS_DIR . 'magnific-popup.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-nice-select', Biddut_THEME_JS_DIR . 'nice-select.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'purecounter', Biddut_THEME_JS_DIR . 'purecounter.js', [ 'jquery' ], false, true );    
    wp_enqueue_script( 'wow', Biddut_THEME_JS_DIR . 'wow.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'isotope-pkgd', Biddut_THEME_JS_DIR . 'isotope-pkgd.js', [ 'imagesloaded' ], false, true );
    wp_enqueue_script( 'biddut-main', Biddut_THEME_JS_DIR . 'main.js', [ 'jquery' ], false, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'biddut_scripts' );


/*
Register Fonts
 */
function biddut_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'biddut' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?'. urlencode('family=Jost:wght@400;500;600;700;800;900&family=Kumbh+Sans:wght@400;500;600;700;800&display=swap');
    }
    return $font_url;
}