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
class TP_Hero_Banner extends Widget_Base {

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
		return 'hero-banner';
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
		return __( 'Hero Banner', 'tp-core' );
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


	protected function register_controls_section() {

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
                    'layout-2' => esc_html__('Layout 2', 'tp-core')
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        $this->tp_section_title_render_controls('banner', 'Banner Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1', 'layout-2','layout-3','layout-4','layout-5']);
        // button
        $this->tp_button_render('banner', 'Button', ['layout-1', 'layout-2', 'layout-3','layout-4', 'layout-5']);
        // button 2

        // social links
        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'tpcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-3'
                ]
            ]
        );

        $repeater = new Repeater();
        
        $repeater->add_control(
            'tp_social_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
            ]
        );

        $repeater->add_control(
            'tp_social_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_social_icon_type' => 'image',
                ]

            ]
        );

        $repeater->add_control(
            'tp_social_icon_svg',
            [
                    'show_label' => false,
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                    'condition' => [
                        'tp_social_icon_type' => 'svg'
                    ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_social_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fas fa-facebook-f',
                    'condition' => [
                        'tp_social_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_social_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fab fa-facebook-f',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_social_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
			'tp_social_link',
			[
				'label' => esc_html__( 'Social Profile Link', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'textdomain' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
			]
		);

        $repeater->add_control(
            'tp_social_title',
            [
                'label' => esc_html__('Social Profile Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TP Profile Title', 'tpcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tpcore'),
                'label_block' => true,
            ]
        );
        
        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tp_social_title }}}',
                'default' => [
                    [
                        'tp_social_link' => ['url' => 'https://facebook.com/'],
                        'tp_social_title' => 'facebook',
                        'tp_social_selected_icon' => ['value' => 'fab fa-facebook-f']
                    ],
                    [
                        'tp_social_link' => ['url' => 'https://linkedin.com/'],
                        'tp_social_title' => 'linkedin',
                        'tp_social_selected_icon' => ['value' => 'fab fa-linkedin-in']
                    ],
                    [
                        'tp_social_link' => ['url' => 'https://twitter.com/'],
                        'tp_social_title' => 'twitter',
                        'tp_social_selected_icon' => ['value' => 'fab fa-twitter']
                    ]
                ],
            ]
        );

        $this->end_controls_section();

        // banner shape
        $this->start_controls_section(
         'tp_banner_shape',
             [
               'label' => esc_html__( 'Hero Shape', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
             ]
         
        );

        $this->add_control(
         'tp_banner_shape_switch',
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
                    'tp_banner_shape_switch' => 'yes'
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
                    'tp_banner_shape_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_shape_image_3',
            [
                'label' => esc_html__( 'Choose Shape Image 3', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_banner_shape_switch' => 'yes',
                    'tp_design_style' => ['layout-1', 'layout-5']
                ]
            ]
        );

        $this->add_control(
            'tp_shape_image_4',
            [
                'label' => esc_html__( 'Choose Shape Image 4', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_banner_shape_switch' => 'yes',
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'tp_banner_shape_switch' => 'yes'
                ]
            ]
        );
        
        $this->end_controls_section();


        // thumbnail image
        $this->start_controls_section(
        'tp_thumbnail_section',
            [
                'label' => esc_html__( 'Thumbnail', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tp_thumbnail_image',
            [
                'label' => esc_html__( 'Choose Thumbnail Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_thumbnail_image2',
            [
                'label' => esc_html__( 'Choose Thumbnail Tow Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_thumbnail_image_2',
            [
                'label' => esc_html__( 'Choose Thumbnail Image 2', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-4', 'layout-5']
                ]
            ]
        );

        $this->add_control(
            'tp_thumbnail_image_3',
            [
                'label' => esc_html__( 'Choose Thumbnail Image 3', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-5']
                ]
            ]
        );

        $this->add_control(
            'tp_thumbnail_image_4',
            [
                'label' => esc_html__( 'Choose Thumbnail Image 4', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_design_style' => 'layout-4'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_thumbnail_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->add_control(
            'tp_slider_number',
            [
                'label' => esc_html__('Number Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Number', 'tpcore'),
                'title' => esc_html__('0125485546 ', 'tpcore'),
                'label_block' => true,
           
            ]
        );
        $this->end_controls_section();

        // background
        $this->start_controls_section(
        'tp_background_section',
            [
                'label' => esc_html__( 'Background Image', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-3'
                ]
            ]
        );

        $this->add_control(
            'tp_bg_image',
            [
                'label' => esc_html__( 'Choose Background Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_bg_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
            
        $this->end_controls_section();

        // scroll down
        $this->start_controls_section(
            'section_scroll',
            [
                'label' => esc_html__('Scroll Down', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-4'
                ]
            ]
        );

        $this->add_control(
            'tp_scroll_switch',
            [
              'label'        => esc_html__( 'Scroll Down On/Off', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => '0',
            ]
        );

        $this->add_control(
            'tp_scroll_title',
            [
                'label'       => esc_html__( 'Scroll Down Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Scroll Down', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Title Text', 'tpcore' ),
                'description' => 'Type Your Scroll Down Title In This Field',
                'label_block' => true,
                'condition'   => [
                    'tp_scroll_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_scroll_id',
            [
                'label'       => esc_html__( 'Section ID', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '#', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Section ID', 'tpcore' ),
                'description' => 'Note: Please, insert "#" before your section ID text here',
                'condition'   => [
                    'tp_scroll_switch' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // client area
        $this->start_controls_section(
            'section_client',
            [
                'label' => esc_html__('Client Area', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-4'
                ]
            ]
        );

        $this->add_control(
            'tp_client_switch',
            [
              'label'        => esc_html__( 'Client On/Off', 'tpcore' ),
              'type'         => \Elementor\Controls_Manager::SWITCHER,
              'label_on'     => esc_html__( 'Show', 'tpcore' ),
              'label_off'    => esc_html__( 'Hide', 'tpcore' ),
              'return_value' => 'yes',
              'default'      => '0',
            ]
        );

        $this->add_control(
            'tp_client_title',
            [
                'label'       => esc_html__( 'Client Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Over 5Ok+ Client all over the world', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Title Text', 'tpcore' ),
                'description' => 'Type Your Client Title In This Field',
                'label_block' => true,
                'condition'   => [
                    'tp_client_switch' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tp_client_image',
            [
                'label' => esc_html__( 'Choose Client Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_client_switch' => 'yes'
                ]
            ]
        );


        $this->end_controls_section();

        
        // hero slider
        $this->start_controls_section(
            'tpcore_hero_sider_area',
            [
                'label' => esc_html__('Hero Slider Area', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-4'
                ]
            ]
        );

        // repeter field with text 
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tpcore_hero_slider_title',
            [
                'label'       => esc_html__( 'Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Your Title', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Title Text', 'tpcore' ),
                'description' => 'Type Your Title In This Field',
                'label_block' => true,
            ]
        );


        $this->add_control(
            'tpcore_hero_slider_list',
            [
                'label' => esc_html__( 'Hero Slider List', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();


       
	}
    

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('banner_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_sub_title', 'Section - Sub Title', '.tp-el-sub-title', ['layout-1', 'layout-2']);
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title', ['layout-1', 'layout-2']);
        $this->tp_basic_style_controls('section_des', 'Section - Description', '.tp-el-des', ['layout-1', 'layout-2']);
        $this->tp_link_controls_style('section_btn', 'Section - Button', '.tp-el-btn', ['layout-1', 'layout-2']);
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

    // thumbnail image
    if ( !empty($settings['tp_thumbnail_image']['url']) ) {
        $tp_thumbnail_image = !empty($settings['tp_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image']['url'];
        $tp_thumbnail_image_alt = get_post_meta($settings["tp_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
    }

    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_2']['url']) ) {
        $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
        $tp_shape_image_alt_2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_3']['url']) ) {
        $tp_shape_image_3 = !empty($settings['tp_shape_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_3']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_3']['url'];
        $tp_shape_image_alt_3 = get_post_meta($settings["tp_shape_image_3"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_4']['url']) ) {
        $tp_shape_image_4 = !empty($settings['tp_shape_image_4']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_4']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_4']['url'];
        $tp_shape_image_alt_4 = get_post_meta($settings["tp_shape_image_4"]["id"], "_wp_attachment_image_alt", true);
    }

    // client img
    if ( !empty($settings['tp_client_image']['url']) ) {
        $tp_client_image = !empty($settings['tp_client_image']['id']) ? wp_get_attachment_image_url( $settings['tp_client_image']['id']) : $settings['tp_client_image']['url'];
        $tp_client_image_alt = get_post_meta($settings["tp_client_image"]["id"], "_wp_attachment_image_alt", true);
    }

    // Link
    if ('2' == $settings['tp_banner_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_banner_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-btn');
    } else {
        if ( ! empty( $settings['tp_banner_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_banner_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-hero-title-3 wow fadeInUp tp-el-title');

?>

<?php if(!empty($tp_shape_image_2)) : ?>
<img class="shape-1" src="<?php echo esc_url($tp_shape_image_2); ?>"
    alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
<?php endif; ?>
<?php if(!empty($tp_shape_image_3)) : ?>
<img class="shape-2" src="<?php echo esc_url($tp_shape_image_3); ?>"
    alt="<?php echo esc_attr($tp_shape_image_alt_3); ?>">
<?php endif; ?>
<!-- hero area start -->
<section class="tp-hero-area-3 tp-hero-hight-3 p-relative pt-220 tp-el-section">
    <div class="tp-hero-thumb-shape-3">
        <img class="shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/home-3/shape-1.png"
            alt="">
    </div>
    <div class="tp-hero-thumb-shape-3-two">
        <img class="shape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/home-3/shape-2.png"
            alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="tp-hero-content-3 p-relative">
                    <div class="tp-hero-title-wrapper-3 p-relative z-index-1">

                        <?php if ( !empty($settings['tp_banner_sub_title' ]) ) : ?>
                        <span class="tp-hero-subtitle-3 wow fadeInUp tp-el-sub-title" data-wow-duration="1s"
                            data-wow-delay=".3s"><?php echo tp_kses($settings['tp_banner_sub_title']); ?></span>
                        <?php endif; ?>
                        <?php if ( !empty($settings['tp_banner_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_banner_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_banner_title' ] )
                                );
                        endif; ?>
                        <?php if ( !empty($settings['tp_banner_description' ]) ) : ?>
                        <p class=" wow fadeInUp tp-el-des" data-wow-duration="1s" data-wow-delay=".5s">
                            <?php echo tp_kses($settings['tp_banner_description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="tp-hero-button-wrapper-3 d-flex wow fadeInUp" data-wow-duration="1s"
                        data-wow-delay=".7s">
                        <?php if ( !empty($settings['tp_banner_btn_text']) ) : ?>
                        <div class="tp-hero-btn-3">
                            <a
                                <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo tp_kses($settings['tp_banner_btn_text']); ?><span><i
                                        class="fa-regular fa-plus"></i></span></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tp-hero-thumb-main-3">
        <div class="tp-hero-thumb-3">
            <img src="<?php echo esc_url($tp_thumbnail_image); ?>"
                alt="<?php echo esc_url($tp_thumbnail_image_alt); ?>">
        </div>
    </div>
</section>
<!-- hero area end -->

<?php else:

    // thumbnail image
    if ( !empty($settings['tp_thumbnail_image']['url']) ) {
        $tp_thumbnail_image = !empty($settings['tp_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image']['url'];
        $tp_thumbnail_image_alt = get_post_meta($settings["tp_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
    }
    // thumbnail image2
    if ( !empty($settings['tp_thumbnail_image2']['url']) ) {
        $tp_thumbnail_image2 = !empty($settings['tp_thumbnail_image2']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image2']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image2']['url'];
        $tp_thumbnail_image_alt2 = get_post_meta($settings["tp_thumbnail_image2"]["id"], "_wp_attachment_image_alt", true);
    }
    
    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_2']['url']) ) {
        $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
        $tp_shape_image_alt_2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_3']['url']) ) {
        $tp_shape_image_3 = !empty($settings['tp_shape_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_3']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_3']['url'];
        $tp_shape_image_alt_3 = get_post_meta($settings["tp_shape_image_3"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_4']['url']) ) {
        $tp_shape_image_4 = !empty($settings['tp_shape_image_4']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_4']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_4']['url'];
        $tp_shape_image_alt_4 = get_post_meta($settings["tp_shape_image_4"]["id"], "_wp_attachment_image_alt", true);
    }
    
    $this->add_render_attribute('title_args', 'class', 'tp-hero-title-2 wow fadeInUp tp-el-title');
    // Link
    if ('2' == $settings['tp_banner_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_banner_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-btn');
    } else {
        if ( ! empty( $settings['tp_banner_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_banner_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-btn');
        }
    }
?>


<!-- hero area start -->
<section class="tp-hero-area-2 tp-hero-height-2 p-relative pt-120 pb-110 tp-el-section">
    <?php if(!empty($tp_shape_image)) : ?>
    <div class="tp-hero-bg-2">
        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-xxl-7 col-lg-6">
                <div class="tp-hero-content-2 p-relative">
                    <div class="tp-hero-title-wrapper-2">
                        <?php if ( !empty($settings['tp_banner_sub_title' ]) ) : ?>
                        <span class="tp-hero-subtitle-2 wow fadeInUp tp-el-sub-title" data-wow-duration="1s"
                            data-wow-delay=".3s"><?php echo tp_kses($settings['tp_banner_sub_title']); ?></span>
                        <?php endif; ?>
                        <?php if ( !empty($settings['tp_banner_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_banner_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_banner_title' ] )
                                );
                        endif; ?>

                        <?php if ( !empty($settings['tp_banner_description' ]) ) : ?>
                        <p class=" wow fadeInUp tp-el-des" data-wow-duration="1s" data-wow-delay=".5s">
                            <?php echo tp_kses($settings['tp_banner_description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="tp-hero-button-wrapper-2 d-flex flex-wrap wow fadeInUp" data-wow-duration="1s"
                        data-wow-delay=".7s">
                        <?php if ( !empty($settings['tp_banner_btn_text']) ) : ?>
                        <div class="tp-hero-btn mr-30">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo tp_kses($settings['tp_banner_btn_text']); ?><span><i
                                        class="fa-regular fa-plus"></i></span></a>
                        </div>
                        <?php endif; ?>
                        <?php if ( !empty($settings['tp_slider_number']) ) : ?>
                        <div class="tp-hero-call-2 d-flex align-items-center">
                            <span>
                                <svg width="37" height="36" viewBox="0 0 37 36" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M29.6887 13.0168H25.1079C25.1079 13.0168 27.5332 8.62052 27.9335 8.12946C28.3382 7.63298 28.7214 7.94264 28.758 8.38069C28.7945 8.81866 28.7397 15.1698 28.7397 15.1698M22.9387 15.2699C22.9387 15.2699 19.4019 15.3144 19.2343 15.2585C19.0667 15.2027 19.503 14.9077 21.8218 11.5945C22.2549 10.9757 22.4932 10.4537 22.5947 10.0163L22.6306 9.73512C22.6306 8.70778 21.7978 7.875 20.7705 7.875C19.8665 7.875 19.1132 8.51977 18.9453 9.37455"
                                        stroke="url(#paint0_linear_3043_11)" stroke-width="2.10938"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M32.7861 26.6714L29.7163 23.6016C28.7645 22.6497 27.2212 22.6497 26.2694 23.6016L23.6842 26.1867C21.5426 28.3284 18.0577 27.4539 13.7745 23.1708C9.49123 18.8875 8.61683 15.4026 10.7585 13.2611L13.3436 10.6759C14.2954 9.72406 14.2954 8.18084 13.3436 7.22902L10.2737 4.15918C9.32192 3.20736 7.7787 3.20736 6.82688 4.15918L4.24177 6.74429C-0.279393 11.2655 2.32723 20.3406 9.46592 27.4793C16.6046 34.618 25.6798 37.2246 30.201 32.7035L32.7862 30.1183C33.7379 29.1665 33.7379 27.6233 32.7861 26.6714Z"
                                        stroke="url(#paint1_linear_3043_11)" stroke-width="2.10938"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M34.2298 21.7512C35.2892 19.7749 35.8906 17.5164 35.8906 15.1172C35.8906 7.35068 29.5946 1.05469 21.8281 1.05469C19.4289 1.05469 17.1704 1.65614 15.1941 2.71554M32.7861 26.6715L29.7163 23.6017C28.7645 22.6498 27.2212 22.6498 26.2694 23.6017L23.6842 26.1868C21.5426 28.3285 18.0577 27.454 13.7745 23.1709C9.49123 18.8876 8.61683 15.4027 10.7585 13.2611L13.3436 10.676C14.2954 9.72415 14.2954 8.18093 13.3436 7.22911L10.2737 4.15927C9.32192 3.20745 7.7787 3.20745 6.82688 4.15927L4.24177 6.74437C-0.279393 11.2655 2.32723 20.3407 9.46592 27.4794C16.6046 34.6181 25.6798 37.2247 30.201 32.7035L32.7862 30.1184C33.7379 29.1665 33.7379 27.6234 32.7861 26.6715Z"
                                        stroke="url(#paint2_linear_3043_11)" stroke-width="2.10938"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <defs>
                                        <linearGradient id="paint0_linear_3043_11" x1="18.9453" y1="11.5808"
                                            x2="29.6887" y2="11.5808" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#004D6E" />
                                            <stop offset="1" stop-color="#00ACCC" />
                                        </linearGradient>
                                        <linearGradient id="paint1_linear_3043_11" x1="2" y1="19.1953" x2="33.5"
                                            y2="19.1953" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#004D6E" />
                                            <stop offset="1" stop-color="#00ACCC" />
                                        </linearGradient>
                                        <linearGradient id="paint2_linear_3043_11" x1="2" y1="18" x2="35.8906" y2="18"
                                            gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#004D6E" />
                                            <stop offset="1" stop-color="#00ACCC" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </span>
                            <div class="tp-hero-call-inner-2">
                                <p><?php echo esc_html__("Need help?","finbest") ?></p>
                                <span><a
                                        href="tel:<?php echo tp_kses($settings['tp_slider_number']); ?>"><?php echo tp_kses($settings['tp_slider_number']); ?></a></span>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-xxl-5 col-lg-6">
                <div class="tp-hero-thumb-2 d-flex p-relative wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <div class="tp-hero-img-1">
                        <img src="<?php echo esc_url($tp_thumbnail_image); ?>"
                            alt="<?php echo esc_url($tp_thumbnail_image_alt); ?>">
                    </div>
                    <div class="tp-hero-img-2">
                        <img src="<?php echo esc_url($tp_thumbnail_image2); ?>"
                            alt="<?php echo esc_url($tp_thumbnail_image_alt2); ?>">
                    </div>
                    <div class="tp-hero-shape-2">
                        <?php if(!empty($tp_shape_image_2)) : ?>
                        <img class="shape-1" src="<?php echo esc_url($tp_shape_image_2); ?>"
                            alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
                        <?php endif; ?>
                        <?php if(!empty($tp_shape_image_3)) : ?>
                        <img class="shape-2" src="<?php echo esc_url($tp_shape_image_3); ?>"
                            alt="<?php echo esc_attr($tp_shape_image_alt_3); ?>">
                        <?php endif; ?>
                        <?php if(!empty($tp_shape_image_4)) : ?>
                        <div class="shape-3">
                            <img src="<?php echo esc_url($tp_shape_image_4); ?>"
                                alt="<?php echo esc_attr($tp_shape_image_alt_4); ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- hero area end -->

<?php endif; 
		
	}

}

$widgets_manager->register( new TP_Hero_Banner() );