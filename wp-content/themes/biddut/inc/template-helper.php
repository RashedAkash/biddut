<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package biddut
 */

function get_header_style($style){
    if ( $style == 'header_2'  ) {
        get_template_part( 'template-parts/header/header-2' );
    }
    elseif ( $style == 'header_3'  ) {
        get_template_part( 'template-parts/header/header-3' );
    }
    elseif ( $style == 'header_1_onepage' ) {
        get_template_part( 'template-parts/header/header-1-onepage' );
    }
    elseif ( $style == 'header_2_onepage' ) {
        get_template_part( 'template-parts/header/header-2-onepage' );
    }
    elseif ( $style == 'header_3_onepage' ) {
        get_template_part( 'template-parts/header/header-3-onepage' );
    }
    else{
        get_template_part( 'template-parts/header/header-1');
    }
}

function biddut_check_header() {
    $tp_header_tabs = function_exists('tpmeta_field')? tpmeta_field('biddut_header_tabs') : false;
    $tp_header_style_meta = function_exists('tpmeta_field')? tpmeta_field('biddut_header_style') : '';
    $elementor_header_template_meta = function_exists('tpmeta_field')? tpmeta_field('biddut_header_templates') : false;

    $biddut_header_option_switch = get_theme_mod('biddut_header_elementor_switch', false);
    $header_default_style_kirki = get_theme_mod( 'header_layout_custom', 'header_1' );
    $elementor_header_templates_kirki = get_theme_mod( 'biddut_header_templates' );
    
    if($tp_header_tabs == 'default'){
        if($biddut_header_option_switch){
            if($elementor_header_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }
        }else{ 
            if($header_default_style_kirki){
                get_header_style($header_default_style_kirki);
            }else{
                get_template_part( 'template-parts/header/header-1' );
            }
        }
    }elseif($tp_header_tabs == 'custom'){
        if ($tp_header_style_meta) {
            get_header_style($tp_header_style_meta);
        }else{
            get_header_style($header_default_style_kirki);
        }  
    }elseif($tp_header_tabs == 'elementor'){
        if($elementor_header_template_meta){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_template_meta);
        }else{
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
        }
    }else{
        if($biddut_header_option_switch){

            if($elementor_header_templates_kirki){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_header_templates_kirki);
            }else{
                get_template_part( 'template-parts/header/header-1' );
            }
        }else{
            get_header_style($header_default_style_kirki);

        }
        
    }

}
add_action( 'biddut_header_style', 'biddut_check_header', 10 );



/**
 * [biddut_header_lang description]
 * @return [type] [description]
 */

function biddut_header_lang_defualt() {
    $biddut_header_lang = get_theme_mod( 'biddut_header_lang', true );
    if ( $biddut_header_lang ): ?>

<span class="tp-header-lang-selected-lang tp-lang-toggle"
    id="tp-header-lang-toggle"><?php echo esc_html__( 'English', 'biddut' );?></span>

<?php do_action( 'biddut_language' );?>

<?php endif;?>
<?php
}

/**
 * [biddut_language_list description]
 * @return [type] [description]
 */
function _biddut_language( $mar ) {
    return $mar;
}
function biddut_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<ul class="tp-header-lang-list tp-lang-list">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<li class="' . $active . '"><a href="' . $lan['url'] . '">' . $lan['translated_name'] . '</a></li>';
        }
        $mar .= '</ul>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<ul class="tp-header-lang-list tp-lang-list tp-header-lan-list-area">';
        $mar .= '<li><a href="#">' . esc_html__( 'English', 'biddut' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Bangla', 'biddut' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'French', 'biddut' ) . '</a></li>';
        $mar .= '<li><a href="#">' . esc_html__( 'Hindi', 'biddut' ) . '</a></li>';
        $mar .= ' </ul>';
    }
    echo _biddut_language( $mar );
}
add_action( 'biddut_language', 'biddut_language_list' );


// header logo
function biddut_header_logo() { ?>
    <?php 
        $biddut_logo_on = function_exists('tpmeta_field')? tpmeta_field('biddut_en_secondary_logo') : '';
        $biddut_logo = get_template_directory_uri() . '/assets/img/logo/white-logo.png';
        $biddut_logo_secondary = get_template_directory_uri() . '/assets/img/logo/black-logo.png';
        $biddut_site_logo = get_theme_mod( 'header_logo', $biddut_logo );
        $biddut_secondary_logo = get_theme_mod( 'header_secondary_logo', $biddut_logo_secondary );
      ?>

    <?php if ( $biddut_logo_on == 'on' ) : ?>
    <a class="main-logo" href="<?php echo esc_url( home_url( '/' ) );?>">
        <img src="<?php echo esc_url( $biddut_secondary_logo );?>" alt="<?php echo esc_attr__( 'logo', 'biddut' );?>" />
    </a>
    <?php else : ?>
    <a class="standard-logo" href="<?php echo esc_url( home_url( '/' ) );?>">
        <img src="<?php echo esc_url( $biddut_site_logo );?>" alt="<?php echo esc_attr__( 'logo', 'biddut' );?>" />
    </a>
    <?php endif; ?>
<?php
}


// header logo
function biddut_header_black_logo() { ?>
    <?php 
        $biddut_logo = get_template_directory_uri() . '/assets/img/logo/black-logo.png';

        $biddut_black_logo = get_theme_mod( 'header_logo', $biddut_logo );
    ?>

    <a href="<?php echo esc_url( home_url( '/' ) );?>">
        <img src="<?php echo esc_url( $biddut_black_logo );?>" alt="<?php echo esc_attr__( 'logo', 'biddut' );?>" />
    </a>
<?php
}

/**
 * [biddut_header_social_profiles description]
 * @return [type] [description]
 */
function biddut_header_social_profiles() {
    $biddut_topbar_fb_url = get_theme_mod( 'header_facebook_link', __( '#', 'biddut' ) );
    $biddut_topbar_twitter_url = get_theme_mod( 'header_twitter_link', __( '#', 'biddut' ) );
    $biddut_topbar_instagram_url = get_theme_mod( 'header_instagram_link', __( '#', 'biddut' ) );
    $biddut_topbar_linkedin_url = get_theme_mod( 'header_linkedin_link', __( '#', 'biddut' ) );
    $biddut_topbar_youtube_url = get_theme_mod( 'header_youtube_link', __( '#', 'biddut' ) );
    ?>
<?php if ( !empty( $biddut_topbar_fb_url ) ): ?>
<a target="_blank" class="icon facebook" href="<?php echo esc_url( $biddut_topbar_fb_url );?>"><i class="fa-brands fa-facebook-f"></i></a>
<?php endif;?>

<?php if ( !empty( $biddut_topbar_twitter_url ) ): ?>
<a target="_blank" class="icon twitter" href="<?php echo esc_url( $biddut_topbar_twitter_url );?>"><i class="fa-brands fa-twitter"></i></a>
<?php endif;?>

<?php if ( !empty( $biddut_topbar_instagram_url ) ): ?>
<a target="_blank" class="icon youtube" href="<?php echo esc_url( $biddut_topbar_instagram_url );?>"><i class="fa-brands fa-instagram"></i></a>
<?php endif;?>

<?php if ( !empty( $biddut_topbar_linkedin_url ) ): ?>
<a target="_blank" class="icon linkedin" href="<?php echo esc_url( $biddut_topbar_linkedin_url );?>"><i class="fab fa-linkedin"></i></a>
<?php endif;?>

<?php if ( !empty( $biddut_topbar_youtube_url ) ): ?>
<a target="_blank" class="icon youtube" href="<?php echo esc_url( $biddut_topbar_youtube_url );?>"><i class="fab fa-youtube"></i></a>
<?php endif;?>

<?php
}

/**
 * [biddut_header_side_info_social_profiles description]
 * @return [type] [description]
 */
function biddut_header_side_info_social_profiles() {
    $biddut_topbar_fb_url = get_theme_mod( 'header_facebook_link', __( '#', 'biddut' ) );
    $biddut_topbar_twitter_url = get_theme_mod( 'header_twitter_link', __( '#', 'biddut' ) );
    $biddut_topbar_instagram_url = get_theme_mod( 'header_instagram_link', __( '#', 'biddut' ) );
    $biddut_topbar_linkedin_url = get_theme_mod( 'header_linkedin_link', __( '#', 'biddut' ) );
    $biddut_topbar_youtube_url = get_theme_mod( 'header_youtube_link', __( '#', 'biddut' ) );
    ?>

<?php if ( !empty( $biddut_topbar_fb_url ) ): ?>
<a class="icon facebook" href="<?php echo esc_url( $biddut_topbar_fb_url );?>"><i class="fab fa-facebook-f"></i></a>
<?php endif;?>

<?php if ( !empty( $biddut_topbar_twitter_url ) ): ?>
<a class="icon twitter" href="<?php echo esc_url( $biddut_topbar_twitter_url );?>"><i class="fab fa-twitter"></i></a>
<?php endif;?>

<?php if ( !empty( $biddut_topbar_instagram_url ) ): ?>
<a class="icon linkedin" href="<?php echo esc_url( $biddut_topbar_instagram_url ) ?>"><i
        class="fa-brands fa-instagram"></i></a>
<?php endif;?>

<?php if ( !empty( $biddut_topbar_linkedin_url ) ): ?>
<a class="icon linkedin" href="<?php echo esc_url( $biddut_topbar_linkedin_url ) ?>"><i
        class="fab fa-linkedin"></i></a>
<?php endif;?>

<?php if ( !empty( $biddut_topbar_youtube_url ) ): ?>
<a class="icon youtube" href="<?php echo esc_url( $biddut_topbar_youtube_url );?>"><i class="fab fa-youtube"></i></a>
<?php endif;?>

<?php
}

// biddut_footer_social_profiles 
function biddut_footer_social_profiles() {
    $biddut_footer_fb_url = get_theme_mod( 'biddut_footer_fb_url', __( '#', 'biddut' ) );
    $biddut_footer_twitter_url = get_theme_mod( 'biddut_footer_twitter_url', __( '#', 'biddut' ) );
    $biddut_footer_instagram_url = get_theme_mod( 'biddut_footer_instagram_url', __( '#', 'biddut' ) );
    $biddut_footer_linkedin_url = get_theme_mod( 'biddut_footer_linkedin_url', __( '#', 'biddut' ) );
    $biddut_footer_youtube_url = get_theme_mod( 'biddut_footer_youtube_url', __( '#', 'biddut' ) );
    ?>


<?php if ( !empty( $biddut_footer_fb_url ) ): ?>
<a href="<?php echo esc_url( $biddut_footer_fb_url );?>">
    <?php echo esc_html__('Fb.','biddut'); ?>
</a>
<?php endif;?>

<?php if ( !empty( $biddut_footer_twitter_url ) ): ?>
<a href="<?php echo esc_url( $biddut_footer_twitter_url );?>">
    <?php echo esc_html__('Tw.','biddut'); ?>
</a>
<?php endif;?>

<?php if ( !empty( $biddut_footer_instagram_url ) ): ?>
<a href="<?php echo esc_url( $biddut_footer_instagram_url );?>">
    <?php echo esc_html__('In.','biddut'); ?>
</a>
<?php endif;?>

<?php if ( !empty( $biddut_footer_linkedin_url ) ): ?>
<a href="<?php echo esc_url( $biddut_footer_linkedin_url );?>">
    <?php echo esc_html__('Ln.','biddut'); ?>
</a>
<?php endif;?>

<?php if ( !empty( $biddut_footer_youtube_url ) ): ?>
<a href="<?php echo esc_url( $biddut_footer_youtube_url );?>">
    <?php echo esc_html__('Yt.','biddut'); ?>
</a>
<?php endif;?>

<?php
    }

/**
 * [biddut_header_menu description]
 * @return [type] [description]
 */
function biddut_header_menu() {
    ?>
<?php
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => '',
            'container'      => '',
            'fallback_cb'    => ' Biddut_Navwalker_Class::fallback',
            'walker'         => new Biddut_Navwalker_Class,
        ] );
    ?>
<?php
}


/**
 * [biddut_footer_menu description]
 * @return [type] [description]
 */
function biddut_onepage_menu_01() {
    wp_nav_menu( [
        'theme_location' => 'onepage-menu-menu-01',
        'menu_class'     => 'tp-onepage-menu',
        'container'      => '',
        'fallback_cb'    => 'biddut_Navwalker_Class::fallback',
        'walker'         =>  new \TPCore\Widgets\biddut_Navwalker_Class,
    ] );
}


 /*
 * biddut footer
 */
add_action( 'biddut_footer_style', 'biddut_check_footer', 10 );


function get_footer_style($style){
    if( $style == 'footer_2'  ) {
        get_template_part( 'template-parts/footer/footer-2' );
    }elseif ( $style == 'footer_3'  ) {
        get_template_part( 'template-parts/footer/footer-3' );
    }elseif ( $style == 'footer_4' ) {
        get_template_part( 'template-parts/footer/footer-4' );
    }else{
        get_template_part( 'template-parts/footer/footer-1');
    }
}

function biddut_check_footer() {
    $tp_footer_tabs = function_exists('tpmeta_field')? tpmeta_field('biddut_footer_tabs') : '';
    $biddut_footer_style = function_exists( 'tpmeta_field' ) ? tpmeta_field( 'biddut_footer_style' ) : NULL;
    $footer_template = function_exists('tpmeta_field')? tpmeta_field('biddut_footer_template') : false;

    $biddut_footer_option_switch = get_theme_mod( 'biddut_footer_elementor_switch', false );
    $elementor_footer_template = get_theme_mod( 'biddut_footer_templates');
    $biddut_default_footer_style = get_theme_mod( 'footer_layout', 'footer_1' );

    if($tp_footer_tabs == 'default'){
        if($biddut_footer_option_switch){
            if($elementor_footer_template){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template);
            }
        }else{ 
            if($biddut_default_footer_style){
                get_footer_style($biddut_default_footer_style);
            }else{
                get_template_part( 'template-parts/footer/footer-1' );
            }
        }
    }elseif($tp_footer_tabs == 'custom'){
        if ($biddut_footer_style) {
            get_footer_style($biddut_footer_style);
        }else{
            get_footer_style($biddut_default_footer_style);
        }  
    }elseif($tp_footer_tabs == 'elementor'){
        if($footer_template){
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($footer_template);
        }else{
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template);
        }

    }else{
        if($biddut_footer_option_switch){

            if($elementor_footer_template){
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($elementor_footer_template);
            }else{
                get_template_part( 'template-parts/footer/footer-1' );
            }
        }else{
            get_footer_style($biddut_default_footer_style);

        }
    }
}

// biddut_copyright_text
function biddut_copyright_text() {
   echo get_theme_mod( 'footer_copyright', esc_html__( '© 2024 biddut, All Rights Reserved. Design By Theme Pure', 'biddut' ) );
}


/**
 *
 * pagination
 */
if ( !function_exists( 'biddut_pagination' ) ) {

    function _biddut_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function biddut_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];
        }

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul>';
            foreach ( $paginations as $key => $pg ) {
                $pagi .= '<li>' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        echo _biddut_pagi_callback( $pagi );
    }
}

// theme color
function biddut_custom_color() {
    $biddut_color_1 = get_theme_mod( 'biddut_color_1', '#00A3C3' );
    $biddut_color_2 = get_theme_mod( 'biddut_color_2', '#16243E' );
    $biddut_gra_color_1 = get_theme_mod( 'biddut_gra_color_1', '#004D6E' );
    $biddut_gra_color_2 = get_theme_mod( 'biddut_gra_color_2', '#00ACCC' );
    $biddut_body = get_theme_mod( 'biddut_body', '#333F4D' );

    wp_enqueue_style( 'biddut-custom', Biddut_THEME_CSS_DIR . 'biddut-custom.css', [] );
    
    if ( !empty($biddut_color_1 || $biddut_color_2 || $biddut_color_3 || $biddut_color_4)) {
        $custom_css = '';
        $custom_css .= "html:root{
            --tp-theme-primary: " . $biddut_color_1 . ";
            --tp-theme-secondary: " . $biddut_color_2 . ";
            --tp-gradient-primary: linear-gradient(90deg, {$biddut_gra_color_1} 0%,  {$biddut_gra_color_2} 100%);
            --tp-text-1: " . $biddut_body . ";
        }";

        wp_add_inline_style( 'biddut-custom', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'biddut_custom_color' );

// biddut_kses_intermediate
function biddut_kses_intermediate( $string = '' ) {
    return wp_kses( $string, biddut_get_allowed_html_tags( 'intermediate' ) );
}

function biddut_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function biddut_kses($raw){

   $allowed_tags = array(
      'a'                         => array(
         'class'   => array(),
         'href'    => array(),
         'rel'  => array(),
         'title'   => array(),
         'target' => array(),
      ),
      'abbr'                      => array(
         'title' => array(),
      ),
      'b'                         => array(),
      'blockquote'                => array(
         'cite' => array(),
      ),
      'cite'                      => array(
         'title' => array(),
      ),
      'code'                      => array(),
      'del'                    => array(
         'datetime'   => array(),
         'title'      => array(),
      ),
      'dd'                     => array(),
      'div'                    => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'dl'                     => array(),
      'dt'                     => array(),
      'em'                     => array(),
      'h1'                     => array(),
      'h2'                     => array(),
      'h3'                     => array(),
      'h4'                     => array(),
      'h5'                     => array(),
      'h6'                     => array(),
      'i'                         => array(
         'class' => array(),
      ),
      'img'                    => array(
         'alt'  => array(),
         'class'   => array(),
         'height' => array(),
         'src'  => array(),
         'width'   => array(),
      ),
      'li'                     => array(
         'class' => array(),
      ),
      'ol'                     => array(
         'class' => array(),
      ),
      'p'                         => array(
         'class' => array(),
      ),
      'q'                         => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'                      => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'                 => array(
         'width'         => array(),
         'height'     => array(),
         'scrolling'     => array(),
         'frameborder'   => array(),
         'allow'         => array(),
         'src'        => array(),
      ),
      'strike'                 => array(),
      'br'                     => array(),
      'strong'                 => array(),
      'data-wow-duration'            => array(),
      'data-wow-delay'            => array(),
      'data-wallpaper-options'       => array(),
      'data-stellar-background-ratio'   => array(),
      'ul'                     => array(
         'class' => array(),
      ),
      'svg' => array(
           'class' => true,
           'aria-hidden' => true,
           'aria-labelledby' => true,
           'role' => true,
           'xmlns' => true,
           'width' => true,
           'height' => true,
           'viewbox' => true, // <= Must be lower case!
       ),
       'g'     => array( 'fill' => true ),
       'title' => array( 'title' => true ),
       'path'  => array( 'd' => true, 'fill' => true,  ),
      );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed;
}
// Blog Single Social Share
function biddut_blog_social_share() {

    // Get switch from Customizer
    $biddut_singleblog_social = get_theme_mod('biddut_singleblog_social', false);

    // If switch is off, stop
    if ( empty( $biddut_singleblog_social ) ) {
        return;
    }

    $post_url   = urlencode( get_permalink() );
    $post_title = urlencode( get_the_title() );
    ?>

    <div class="postbox__details-share text-lg-end">
        <span><?php esc_html_e('Share:', 'biddut'); ?></span>

        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $post_url; ?>" target="_blank">
            <i class="fa-brands fa-linkedin-in"></i>
        </a>

        <a href="https://twitter.com/intent/tweet?url=<?php echo $post_url; ?>&text=<?php echo $post_title; ?>" target="_blank">
            <i class="fab fa-twitter"></i>
        </a>

        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_url; ?>" target="_blank">
            <i class="fab fa-facebook-f"></i>
        </a>
    </div>
    <?php
}



// product single social share
function biddut_product_social_share(){
    $post_url = get_the_permalink();
    ?>
<div class="tp-shop-details__social">
    <span><?php echo esc_html__('Share:', 'biddut');?></span>
    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url);?>" target="_blank"><i
            class="fa-brands fa-linkedin-in"></i></a>
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url);?>" target="_blank"><i
            class="fa-brands fa-facebook"></i></a>
    <a href="https://twitter.com/share?url=<?php echo esc_url($post_url);?>" target="_blank"><i
            class="fa-brands fa-twitter"></i></a>
    <a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url($post_url);?>" target="_blank"><i
            class="fa-brands fa-pinterest-p"></i></a>
</div>
<?php
}

// / This code filters the Archive widget to include the post count inside the link /
add_filter( 'get_archives_link', 'biddut_archive_count_span' );
function biddut_archive_count_span( $links ) {
    $links = str_replace('</a>&nbsp;(', '<span > (', $links);
    $links = str_replace(')', ')</span></a> ', $links);
    return $links;
}


// / This code filters the Category widget to include the post count inside the link /
add_filter('wp_list_categories', 'biddut_cat_count_span');
function biddut_cat_count_span($links) {
  $links = str_replace('</a> (', '<span> (', $links);
  $links = str_replace(')', ')</span></a>', $links);
  return $links;
}