<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_CTA_2 extends Widget_Base {

    use \TPCore\Widgets\TPCoreElementFunctions;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tp-cta';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CTA-2', 'tpcore' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'tp-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'tpcore' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'tpcore' ];
	}
    /**
         * contact form 7 setup.
         *
         * Adds different input fields to allow the user to change and customize the widget settings.
         *
         * @since 1.0.0
         *
         * @access protected
         */

    public function get_tp_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $tp_cfa         = array();
        $tp_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $tp_forms       = get_posts( $tp_cf_args );
        $tp_cfa         = ['0' => esc_html__( 'Select Form', 'tpcore' ) ];
        if( $tp_forms ){
            foreach ( $tp_forms as $tp_form ){
                $tp_cfa[$tp_form->ID] = $tp_form->post_title;
            }
        }else{
            $tp_cfa[ esc_html__( 'No contact form found', 'tpcore' ) ] = 0;
        }
        return $tp_cfa;
    }
	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */


	protected function register_controls(){
		$this->register_controls_section();
		$this->style_tab_content();
	}		


	// controls file 
	protected function register_controls_section(){
        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tp-core'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tp-core'),
                    'layout-2' => esc_html__('Layout 2', 'tp-core'),
                    'layout-3' => esc_html__('Layout 3', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
          // tp_section_title
          $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1','layout-2','layout-3']);

        
        $this->tp_button_render('cta', 'Button', ['layout-2']);  

          // cta-content
		$this->start_controls_section(
            'cta_content',
            [
                'label' => esc_html__('Content', 'tp-core'),
            ]
        );
           $this->add_control(
            'tp_cta_2_title',
            [
                'label' => esc_html__( 'Client Title', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'tp_cta_2_subtitle',
            [
                'label' => esc_html__( 'Client subtitle', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );
       
        $this->end_controls_section();

        
        // tp_btn_button_group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'tp-core'),

            ]
        );

        $this->add_control(
            'tp_button_style',
            [
                'label' => esc_html__('Select Button Style', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'tp-btn-blue-lg' => esc_html__('Style 1', 'tp-core'),
                    'tp-btn-inner' => esc_html__('Style 2', 'tp-core'),
                ],
                'default' => 'tp-btn-blue-lg',
                'condition' => [
                    'tp_design_style' => ['layout-4']
                ]
            ]
        );

        $this->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__( 'Show Button', 'tp-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-core' ),
                'label_off' => esc_html__( 'Hide', 'tp-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tp_btn_text',
            [
                'label' => esc_html__('Button Text', 'tp-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tp-core'),
                'title' => esc_html__('Enter button text', 'tp-core'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'tp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__('Button link', 'tp-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tp-core'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'tp_btn_link_type' => '1',
                    'tp_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'tp-core'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_button_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();


        // _tp_image
		$this->start_controls_section(
            'cta_image',
            [
                'label' => esc_html__('Thumbnail', 'tp-core'),
            ]
        );
        $this->add_control(
            'tp_image',
            [
                'label' => esc_html__( 'Choose Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_image_2',
            [
                'label' => esc_html__( 'Choose Image 2', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-1','layout-2','layout-5']
                ]
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

       
        $this->end_controls_section();
        // cta shape
        $this->start_controls_section(
            'tp_cta_shape',
                [
                  'label' => esc_html__( 'Section Shape', 'tpcore' ),
                  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                  'condition' => [
                    'tp_design_style' => ''
                  ]
                ]
           );
   
           $this->add_control(
            'tp_cta_shape_switch',
            [
              'label'        => esc_html__( 'Shape On/Off', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => '0',
            ]
           );
   
           $this->add_control(
               'tp_shape_image_1',
               [
                   'label' => esc_html__( 'Choose Shape Image 1', 'tp-core' ),
                   'type' => \Elementor\Controls_Manager::MEDIA,
                   'default' => [
                       'url' => \Elementor\Utils::get_placeholder_image_src(),
                   ],
                   'condition' => [
                       'tp_cta_shape_switch' => 'yes'
                   ]
               ]
           );
   
           $this->add_control(
               'tp_shape_image_2',
               [
                   'label' => esc_html__( 'Choose Shape Image 2', 'tp-core' ),
                   'type' => \Elementor\Controls_Manager::MEDIA,
                   'default' => [
                       'url' => \Elementor\Utils::get_placeholder_image_src(),
                   ],
                   'condition' => [
                       'tp_cta_shape_switch' => 'yes'
                   ]
               ]
           );

           $this->add_group_control(
               Group_Control_Image_Size::get_type(),
               [
                   'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                   'exclude' => ['custom'],
                   'condition' => [
                       'tp_cta_shape_switch' => 'yes'
                   ]
               ]
           );
           
           $this->end_controls_section();

           // cta 3 contact
        $this->start_controls_section(
            'tp_fact',
            [
                'label' => esc_html__('Contact', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-3'
                  ]
            ]
        );
        $this->add_control(
            'tp_contact_gmail',
            [
                'label' => esc_html__('Contact info 01', 'tp-core'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('example@gmail.com', 'tp-core'),
                'placeholder' => esc_html__('Contact Text', 'tp-core'),
                'label_block' => true,
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'tpcore_contact',
            [
                'label' => esc_html__('Contact Form', 'tpcore'),
            ],
        );

        $this->add_control(
            'tpcore_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'tpcore' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_tp_contact_form(),
            ]
        );

        $this->end_controls_section();

	}

	// style_tab_content
	protected function style_tab_content(){
        $this->tp_section_style_controls('cta_section', 'Section Style', '.ele-section'); 
        $this->tp_basic_style_controls('section_sub_title', 'Section - Sub Title', '.tp-el-sub-title', ['layout-1', 'layout-2', 'layout-3']);
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title', ['layout-1', 'layout-2', 'layout-3']);
        $this->tp_basic_style_controls('section_des', 'Section - Description', '.tp-el-des', ['layout-1', 'layout-2', 'layout-3']);
        $this->tp_basic_style_controls('section_email', 'Section - Email', '.tp-el-email', 'layout-3');
	}


	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		?>

<?php if ( $settings['tp_design_style']  == 'layout-2' ):
    // thumbnail
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }      
    
    // Link
    if ('2' == $settings['tp_cta_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_cta_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
    } else {
        if ( ! empty( $settings['tp_cta_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_cta_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
        }
    }
    $this->add_render_attribute('title_args', 'class', 'tp-footer-subscribe-title tp-el-title');
?>
<div class="tp-footer-subscribe pb-80 pt-120 ele-section">
        <div class="container">
            <div class="tp-footer-subscribe-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-7">
                        <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                            <h4 class=" tp-el-sub-title tp-text-white "><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></h4>
                        <?php endif; ?>
                        <div class="tp-footer-subscribe-wrapper-title d-flex align-items-center">
                            <?php if( !empty($settings['tp_section_title']) ) : ?>
                            <span><img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer/home-3/icon.svg" alt=""></span>
                            <?php 
                                if ( !empty($settings['tp_section_title' ]) ) :
                                printf( '<%1$s %2$s data-wow-duration=".9s"
                                data-wow-delay=".5s" >%3$s</%1$s>',
                                tag_escape( $settings['tp_section_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_section_title' ] )
                                ); endif; 
                            ?>
                             <?php endif;?>
                        </div>
                        <?php if ( !empty($settings['tp_section_description']) ) : ?>
                        <p class="tp-el-des tp-text-white"><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-7 col-md-5">
                        <div class="tp-form-wrapper">
                            <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
                                <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>
                                <?php else : ?>
                                <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
    // thumbnail
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_2']['url']) ) {
        $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
        $tp_image_alt_2 = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
    } 
    if ( !empty($settings['tp_image_3']['url']) ) {
        $tp_image_3 = !empty($settings['tp_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_image_3']['id'], $settings['tp_image_size_size']) : $settings['tp_image_3']['url'];
        $tp_image_alt_3 = get_post_meta($settings["tp_image_3"]["id"], "_wp_attachment_image_alt", true);
    } 
    
    // Link
    if ('2' == $settings['tp_cta_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_cta_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
    } else {
        if ( ! empty( $settings['tp_cta_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_cta_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
        }
    }
    $this->add_render_attribute('title_args', 'class', 'tp-cta-title-2 tp-el-title');
?>

<section class="tp-cta-area-2 p-relative pt-75 pb-80 ele-section" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/cta/home-2/bg.png); ">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6">
                <div class="tp-cta-wrapper-2 text-center">
                    
                    <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                        <h4 class=" tp-el-sub-title tp-text-white "><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></h4>
                    <?php endif; ?>
                    <?php if ( !empty($settings['tp_section_title' ]) ) :
                        printf( '<%1$s %2$s data-wow-duration=".9s"
                        data-wow-delay=".5s" >%3$s</%1$s>',
                        tag_escape( $settings['tp_section_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        tp_kses( $settings['tp_section_title' ] )
                        ); endif;  ?>
                    <?php if ( !empty($settings['tp_section_description']) ) : ?>
                    <p class="tp-el-des"><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                    <?php endif; ?>
                    <?php if ( !empty($settings['tp_contact_gmail']) ) : ?>
                    <span class="tp-el-email">Email: <a
                            href="mailto:<?php echo tp_kses( $settings['tp_contact_gmail'] ); ?>"><?php echo tp_kses( $settings['tp_contact_gmail'] ); ?></a></span>
                    <?php endif; ?>
                    <div class="tp-cta-email p-relative">
                        <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
                            <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>
                            <?php else : ?>
                            <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                            <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php else:

// thumbnail
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }

    // thumbnail-2
    if ( !empty($settings['tp_image_2']['url']) ) {
        $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
    }

    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_2']['url']) ) {
        $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
        $tp_shape_image_alt_2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }

     // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-black hover-2 tp-el-btn');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn-black hover-2 tp-el-btn');
        }
    }

    
    $this->add_render_attribute('title_args', 'class', 'tp-cta-title tp-el-title');   
?>

<div class="tp-cta-3-area fix">
         <div class="container-fluid p-0">
            <div class="row g-0">
               <div class="col-xl-6 col-lg-6">
                  <div class="tp-cta-3-left-wrap theme-bg z-index-3 p-relative">
                     <div class="tp-cta-3-left-shape d-none d-xl-block">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/cta/shape-3-1.png" alt="">
                     </div>
                     <div class="tp-cta-3-left-box">
                        <div class="row align-items-center">
                           <div class="col-xl-6 col-lg-6 col-md-5 d-none d-md-block">
                              <div class="tp-cta-3-left-thumb">
                                 <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                              </div>
                           </div>
                           <div class="col-xl-6 col-lg-6 col-md-7">
                              <div class="tp-cta-3-left-text text-center text-md-start">
                                
                                 <h5 class="tp-cta-3-left-title"><?php echo tp_kses( $settings['tp_cta_2_title'] ); ?></h5>
                                 <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo tp_kses($settings['tp_btn_text']); ?></a>
                                 
                              </div>
                           </div>
                        </div>  
                     </div>
                  </div>
               </div>
               <div class="col-xl-6 col-lg-6">
                  <div class="tp-cta-3-right-wrap black-bg">                     
                     <div class="tp-cta-3-right-box jarallax z-index" 
                     style="background-image: url('<?php echo esc_url( $tp_image_2 ); ?>'); "
                    >
                        <h4 class="tp-section-title text-white text-center z-index-3"><?php echo tp_kses( $settings['tp_cta_2_subtitle'] ); ?></h4>
                        <div class="tp-cta-3-right-shape">
                           <img src="<?php echo get_template_directory_uri(); ?>/assets/img/cta/shape-3-2.png" alt="">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>




<?php endif; 
	}
}

$widgets_manager->register( new TP_CTA_2() );