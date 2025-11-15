<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Utils;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;
use TPCore\Elementor\Controls\Group_Control_TPGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Slider extends Widget_Base {

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
		return 'tp-slider';
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
		return __( 'Slider', 'tp-core' );
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
		return [ 'tp-core' ];
	}


    protected static function get_profile_names()
    {
        return [
            'apple' => esc_html__('Apple', 'tp-core'),
            'behance' => esc_html__('Behance', 'tp-core'),
            'bitbucket' => esc_html__('BitBucket', 'tp-core'),
            'codepen' => esc_html__('CodePen', 'tp-core'),
            'delicious' => esc_html__('Delicious', 'tp-core'),
            'deviantart' => esc_html__('DeviantArt', 'tp-core'),
            'digg' => esc_html__('Digg', 'tp-core'),
            'dribbble' => esc_html__('Dribbble', 'tp-core'),
            'email' => esc_html__('Email', 'tp-core'),
            'facebook' => esc_html__('Facebook', 'tp-core'),
            'flickr' => esc_html__('Flicker', 'tp-core'),
            'foursquare' => esc_html__('FourSquare', 'tp-core'),
            'github' => esc_html__('Github', 'tp-core'),
            'houzz' => esc_html__('Houzz', 'tp-core'),
            'instagram' => esc_html__('Instagram', 'tp-core'),
            'jsfiddle' => esc_html__('JS Fiddle', 'tp-core'),
            'linkedin' => esc_html__('LinkedIn', 'tp-core'),
            'medium' => esc_html__('Medium', 'tp-core'),
            'pinterest' => esc_html__('Pinterest', 'tp-core'),
            'product-hunt' => esc_html__('Product Hunt', 'tp-core'),
            'reddit' => esc_html__('Reddit', 'tp-core'),
            'slideshare' => esc_html__('Slide Share', 'tp-core'),
            'snapchat' => esc_html__('Snapchat', 'tp-core'),
            'soundcloud' => esc_html__('SoundCloud', 'tp-core'),
            'spotify' => esc_html__('Spotify', 'tp-core'),
            'stack-overflow' => esc_html__('StackOverflow', 'tp-core'),
            'tripadvisor' => esc_html__('TripAdvisor', 'tp-core'),
            'tumblr' => esc_html__('Tumblr', 'tp-core'),
            'twitch' => esc_html__('Twitch', 'tp-core'),
            'twitter' => esc_html__('Twitter', 'tp-core'),
            'vimeo' => esc_html__('Vimeo', 'tp-core'),
            'vk' => esc_html__('VK', 'tp-core'),
            'website' => esc_html__('Website', 'tp-core'),
            'whatsapp' => esc_html__('WhatsApp', 'tp-core'),
            'wordpress' => esc_html__('WordPress', 'tp-core'),
            'xing' => esc_html__('Xing', 'tp-core'),
            'yelp' => esc_html__('Yelp', 'tp-core'),
            'youtube' => esc_html__('YouTube', 'tp-core'),
        ];
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

	protected function register_controls_section() {
		

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tpcore'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tpcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tpcore'),
                    'layout-2' => esc_html__('Layout 2', 'tpcore'),
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                    'layout-4' => esc_html__('Layout 4', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->end_controls_section();

		
		$this->start_controls_section(
            'tp_main_slider',
            [
                'label' => esc_html__('Main Slider', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                    'style_3' => __( 'Style 3', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_slider_image',
            [
                'label' => esc_html__('Upload Background Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'tp_slider_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Subtitle',
                'placeholder' => esc_html__('Type Before Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_slider_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Grow business.', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_slider_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration.', 'tpcore'),
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
            ]
        );

        $repeater->add_control(
            'tp_slider_video_text',
            [
                'label' => esc_html__('Video Text', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Watch Our Showcase', 'tpcore'),
                'placeholder' => esc_html__('Type section description here', 'tpcore'),
                'condition' => [
                    'repeater_condition' => 'style_2',
                ],
            ]
        );
        $repeater->add_control(
            'tp_slider_video_url',
            [
                'label' => esc_html__('Video URL', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'placeholder' => esc_html__('Video url here here', 'tpcore'),
                'condition' => [
                    'repeater_condition' => 'style_2',
                ],
            ]
        );

        
		$repeater->add_control(
            'tp_slider_shape_switch',
            [
                'label' => esc_html__( 'Enable Inner Shape ?', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
                'condition' => [
                    'repeater_condition' => 'style_1',
                ],
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

        
		$repeater->add_control(
            'tp_btn_link_switcher',
            [
                'label' => esc_html__( 'Add Button link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'tp_btn_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_link_switcher' => 'yes',
                ],
            ]
        );
        $repeater->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__( 'Button Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_btn_link_switcher' => 'yes',
                ]
            ]
        );
        
        $repeater->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__( 'Button Link link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'tpcore' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tp_btn_link_type' => '1',
                    'tp_btn_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__( 'Select Button Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'slider_list',
            [
                'label' => esc_html__('Slider List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_slider_title' => esc_html__('Grow business.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Development.', 'tpcore')
                    ],
                    [
                        'tp_slider_title' => esc_html__('Marketing.', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_slider_title }}}',
            ]
        );

        $this->add_control(
            'tp_slider_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'tpcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'tpcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'tpcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'tpcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'tpcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'tpcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'tpcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tp-portfolio-thumb',
            ]
        );

        $this->add_control(
            'tp_slider_shape_icon_switch',
            [
                'label' => esc_html__( 'Enable Shape ?', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'tp_scroll_section',
            [
                'label' => esc_html__('Scroll', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => ['layout-1','layout-4'],
                ]
            ]
        );

        $this->add_control(
            'tp_scroll_text',
            [
                'label' => esc_html__('Scroll Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('SCROLL DOWN', 'tpcore'),
                'title' => esc_html__('Enter scroll text', 'tpcore'),
                'label_block' => true,
            ]
        );        

        $this->add_control(
            'tp_scroll_url',
            [
                'label' => esc_html__('Scroll URL', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tpcore'),
                'title' => esc_html__('Enter scroll url', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        
	}

    
    protected function style_tab_content(){
        $this->tp_section_style_controls('slider_section', 'Section Style', '.ele-section');
        $this->tp_basic_style_controls('slider_subtitle', 'Subtitle Style', '.ele-sub-title');
        $this->tp_basic_style_controls('slider_title', 'Title Style', '.ele-title');
        $this->tp_basic_style_controls('slider_des', 'Description Style', '.ele-des');
        $this->tp_link_controls_style('slider_btn', 'Button Style', '.ele-btn');
    }

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *Video Youtube link

	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		?>

<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>
  <div class="tp-slider-2-area p-relative">
    <?php if (!empty($settings['tp_slider_shape_icon_switch'])) : ?> 
     <div class="tp-slider-2-shape-3">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/shape-2-3.png" alt="">
     </div>
     <?php endif; ?>
     <div class="tp-slider-2-wrapper p-relative">
        <div class="tp-slider-2-arrow-box">
           <button class="slider-next">
              <i class="fa-regular fa-arrow-right-long"></i>
           </button>
           <button class="slider-prev active">
              <i class="fa-regular fa-arrow-left-long"></i>
           </button>
       </div>
       <div class="tp-slider-dots"></div>
        <div class="swiper-container tp-slider-2-active">
           <div class="swiper-wrapper">
            <?php foreach ($settings['slider_list'] as $item) : 
                $this->add_render_attribute('title_args', 'class', 'tp-slider-2-title mb-40');

                if ( !empty($item['tp_slider_image']['url']) ) {
                    $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                    $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                }

                // btn Link
                if ('2' == $item['tp_btn_link_type']) {
                    $link = get_permalink($item['tp_btn_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                    $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>
              <div class="swiper-slide">
                 <div class="tp-slider-2-height p-relative">
                    <?php if (!empty($item['tp_slider_shape_switch'])) : ?> 
                    <div class="tp-slider-2-shape-1">
                       <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/shape-2-1.png" alt="">
                    </div>
                    <div class="tp-slider-2-shape-2 d-none d-xl-block">
                       <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/shape-2-2.png" alt="">
                    </div>
                    <?php endif; ?>
                    <div class="tp-slider-2-bg" style="background-image: url(<?php echo esc_url($tp_slider_image_url); ?>);"></div>
                    <div class="container">
                       <div class="row">
                          <div class="col-xl-12">
                             <div class="tp-slider-2-content z-index-3">
                                <div class="tp-slider-2-title-box">
  
                                   <?php if (!empty($item['tp_slider_sub_title'])) : ?> 
                                   <span class="tp-slider-2-subtitle"><?php echo tp_kses($item['tp_slider_sub_title']); ?></span>
                                    <?php endif; ?>

                                    <?php
                                    if ($settings['tp_slider_title_tag']) :
                                        printf('<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['tp_slider_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            tp_kses($item['tp_slider_title'])
                                        );
                                    endif; ?>

                                    <?php if (!empty($item['tp_slider_description'])) : ?>
                                    <p><?php echo tp_kses($item['tp_slider_description']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="tp-slider-2-play-box d-flex align-items-center">
                                    <?php if(!empty($link)) : ?>
                                    <a class="tp-btn hover-2" rel="<?php echo esc_attr($rel); ?>" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>"><span><?php echo tp_kses($item['tp_btn_btn_text']); ?></span></a>
                                    <?php endif; ?>

                                   <?php if(!empty($item['tp_slider_video_url'])) : ?> 
                                   <div class="tp-slider-2-play-icon d-flex align-items-center">
                                      <a class="popup-video" href="<?php echo esc_url($item['tp_slider_video_url']); ?>"><i class="fas fa-play"></i></a>

                                      <div class="tp-slider-2-play-text">
                                         <span><?php echo tp_kses($item['tp_slider_video_text']); ?></span>
                                      </div>
                                   </div>
                                   <?php endif; ?>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
            <?php endforeach; ?>  
           </div>
        </div>
     </div>
  </div>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ): ?>
<div class="tp-slider-area z-index p-relative">
 <div class="tp-slider-arrow-box">
    <button class="slider-prev">
       <i class="fa-regular fa-arrow-left-long"></i>
    </button>
    <button class="slider-next active">
       <i class="fa-regular fa-arrow-right-long"></i>
    </button>
 </div>
 <div class="tp-slider-wrapper">
    <div class="swiper-container tp-slider-active">
       <div class="swiper-wrapper">
            <?php foreach ($settings['slider_list'] as $item) : 
                $this->add_render_attribute('title_args', 'class', 'tp-slider-title');

                if ( !empty($item['tp_slider_image']['url']) ) {
                    $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                    $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                }

                // btn Link
                if ('2' == $item['tp_btn_link_type']) {
                    $link = get_permalink($item['tp_btn_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                    $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>
          <div class="swiper-slide">
             <div class="tp-slider-height tp-slider-overly">
                <?php if (!empty($item['tp_slider_shape_switch'])) : ?> 
                <div class="tp-slider-shape-2 d-none d-xl-block">
                   <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/bg-1-2.png" alt="">
                </div>
                <div class="tp-slider-shape-3 d-none d-md-block">
                   <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/bg-1-3.png" alt="">
                </div>
                <?php endif; ?>
                <div class="tp-slider-bg" style="background-image: url(<?php echo esc_url($tp_slider_image_url); ?>);"></div>
                <div class="container z-index-5">
                   <div class="row">
                      <div class="col-xl-8 col-lg-8">
                         <div class="tp-slider-content">
                            <div class="tp-slider-title-box">  
                               <?php if (!empty($item['tp_slider_sub_title'])) : ?> 
                               <span class="tp-slider-2-subtitle pb-5"><?php echo tp_kses($item['tp_slider_sub_title']); ?></span>
                                <?php endif; ?>

                                <?php
                                if ($settings['tp_slider_title_tag']) :
                                    printf('<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['tp_slider_title_tag']),
                                        $this->get_render_attribute_string('title_args'),
                                        tp_kses($item['tp_slider_title'])
                                    );
                                endif; ?>
                            </div>
                            <div class="tp-slider-text">
                                <?php if (!empty($item['tp_slider_description'])) : ?>
                                <p><?php echo tp_kses($item['tp_slider_description']); ?></p>
                                <?php endif; ?>
                                 <?php if(!empty($link)) : ?>
                                    <a class="tp-btn" rel="<?php echo esc_attr($rel); ?>" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>"><span><?php echo tp_kses($item['tp_btn_btn_text']); ?></span></a>
                               <?php endif; ?>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <?php endforeach; ?>
       </div>
    </div>
 </div>
</div>

<?php elseif ( $settings['tp_design_style']  == 'layout-4' ): ?>
      <div class="tp-slider-4-area p-relative">
        <?php if (!empty($settings['tp_scroll_url'])) : ?> 
         <div class="tp-scroll-bottom-2 smooth">
            <a href="#<?php echo esc_attr($settings['tp_scroll_url']); ?>"><i class="flaticon-arrow-down"></i> <?php echo esc_attr($settings['tp_scroll_text']); ?></a>
         </div>
         <?php endif; ?>

         <div class="tp-slider-4-wrapper p-relative">
            <div class="tp-slider-4-arrow-box">
               <button class="slider-prev">
                  <i class="fal fa-angle-left"></i>
               </button>
               <button class="slider-next">
                  <i class="fal fa-angle-right"></i>
               </button>
           </div>
            <div class="swiper-container tp-slider-4-active">
               <div class="swiper-wrapper">
                <?php foreach ($settings['slider_list'] as $item) : 
                    $this->add_render_attribute('title_args', 'class', 'tp-slider-3-title mb-55');

                    if ( !empty($item['tp_slider_image']['url']) ) {
                        $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                        $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                    }

                    // btn Link
                    if ('2' == $item['tp_btn_link_type']) {
                        $link = get_permalink($item['tp_btn_page_link']);
                        $target = '_self';
                        $rel = 'nofollow';
                    } else {
                        $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                        $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                        $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                    }
                ?>
                  <div class="swiper-slide">
                     <div class="tp-slider-4-height">
                        <div class="tp-slider-4-bg" style="background-image: url(<?php echo esc_url($tp_slider_image_url); ?>);"></div>
                        <div class="container">
                           <div class="row">
                              <div class="col-xl-12">                  
                                 <div class="tp-slider-4-content text-center z-index-3">
                                    <div class="tp-slider-4-title-box">
                                       <?php if (!empty($item['tp_slider_sub_title'])) : ?> 
                                       <span class="tp-slider-2-subtitle pb-5"><?php echo tp_kses($item['tp_slider_sub_title']); ?></span>
                                        <?php endif; ?>

                                        <?php
                                        if ($settings['tp_slider_title_tag']) :
                                            printf('<%1$s %2$s>%3$s</%1$s>',
                                                tag_escape($settings['tp_slider_title_tag']),
                                                $this->get_render_attribute_string('title_args'),
                                                tp_kses($item['tp_slider_title'])
                                            );
                                        endif; ?>
                                        <?php if (!empty($item['tp_slider_description'])) : ?>
                                        <p><?php echo tp_kses($item['tp_slider_description']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if(!empty($link)) : ?>
                                    <div class="tp-slider-4-button">
                                       <a class="tp-btn hover-2" rel="<?php echo esc_attr($rel); ?>" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>"><span><?php echo tp_kses($item['tp_btn_btn_text']); ?></span></a>
                                    </div>
                                    <?php endif; ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                <?php endforeach; ?>  
               </div>
            </div>
         </div> 
      </div>


<?php else: ?>

  <div class="tp-slider-3-area  black-bg p-relative">
    <?php if (!empty($settings['tp_scroll_url'])) : ?> 
     <div class="tp-scroll-bottom smooth d-none d-md-block">
        <a href="#<?php echo esc_attr($settings['tp_scroll_url']); ?>"><?php echo esc_attr($settings['tp_scroll_text']); ?></a>
     </div>
     <?php endif; ?>

     <div class="tp-slider-3-wrapper fix p-relative">
        <div class="tp-slider-3-arrow-box">
           <button class="slider-prev active">
              <i class="fa-regular fa-arrow-left-long"></i>
           </button>
           <button class="slider-next">
              <i class="fa-regular fa-arrow-right-long"></i>
           </button>
       </div>
       <div class="tp-slider-dots dots-color"></div>
        <div class="swiper-container tp-slider-3-active">
           <div class="swiper-wrapper">
              <?php if (!empty($settings['tp_slider_shape_icon_switch'])) : ?> 
              <div class="tp-slider-3-shape-2 d-none d-sm-block">
                 <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/shape-3-2.png" alt="">
              </div>
              <div class="tp-slider-3-shape-3 d-none d-md-block">
                 <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/shape-3-3.png" alt="">
              </div>
              <?php endif; ?>

                <?php foreach ($settings['slider_list'] as $index => $item) : 
                $this->add_render_attribute('title_args', 'class', 'tp-slider-3-title mb-40');

                

                if ( !empty($item['tp_slider_image']['url']) ) {
                    $tp_slider_image_url = !empty($item['tp_slider_image']['id']) ? wp_get_attachment_image_url( $item['tp_slider_image']['id'], $settings['thumbnail_size']) : $item['tp_slider_image']['url'];
                    $tp_slider_image_alt = get_post_meta($item["tp_slider_image"]["id"], "_wp_attachment_image_alt", true);
                }


                // $item_role = $this->get_repeater_setting_key( 'tp_btn_link', 'slider_list', $index );
                // $this->add_link_attributes( 'tp_btn_link', $item_role['tp_btn_link'] );
                // var_dump($item_role);

                // btn Link
                if ('2' == $item['tp_btn_link_type']) {
                    $link = get_permalink($item['tp_btn_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['tp_btn_link']['url']) ? $item['tp_btn_link']['url'] : '';
                    $target = !empty($item['tp_btn_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['tp_btn_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>
              <div class="swiper-slide">
                 <div class="tp-slider-3-height p-relative">
                    <?php if (!empty($item['tp_slider_shape_switch'])) : ?> 
                    <div class="tp-slider-3-shape-1 d-none d-xl-block">
                       <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/shape-3-1.png" alt="">
                    </div>
                    <?php endif; ?>

                    <div class="tp-slider-3-bg" style="background-image: url(<?php echo esc_url($tp_slider_image_url); ?>);"></div>
                    <div class="container">
                       <div class="row">
                          <div class="col-xl-12">
                             <div class="tp-slider-3-content z-index-3">
                                <div class="tp-slider-3-title-box">
                                   <?php if (!empty($item['tp_slider_sub_title'])) : ?> 
                                   <span class="tp-slider-2-subtitle pb-5"><?php echo tp_kses($item['tp_slider_sub_title']); ?></span>
                                    <?php endif; ?>

                                    <?php
                                    if ($settings['tp_slider_title_tag']) :
                                        printf('<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['tp_slider_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            tp_kses($item['tp_slider_title'])
                                        );
                                    endif; ?>
                                    <?php if (!empty($item['tp_slider_description'])) : ?>
                                    <p><?php echo tp_kses($item['tp_slider_description']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php if(!empty($link)) : ?>
                                <div class="tp-slider-3-button">
                                   <a class="tp-btn hover-2" rel="<?php echo esc_attr($rel); ?>" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($link); ?>"><span><?php echo tp_kses($item['tp_btn_btn_text']); ?></span></a>
                                </div>
                                <?php endif; ?>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
             <?php endforeach; ?>
           </div>
        </div>
     </div>
  </div>



<?php endif; 
		
	}

}

$widgets_manager->register( new TP_Slider() );