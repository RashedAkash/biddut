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
use TPCore\Elementor\Controls\Group_Control_TPGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_About extends Widget_Base {

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
		return 'about';
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
		return __( 'About', 'tp-core' );
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
                    'layout-2' => esc_html__('Layout 2', 'tp-core'),
                    'layout-3' => esc_html__('Layout 3', 'tp-core'),
                    'layout-4' => esc_html__('Layout 4', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        $this->tp_section_title_render_controls('about', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1', 'layout-2','layout-3','layout-4','layout-5']);

   
        $this->start_controls_section(
         'about_features_list_sec',
             [
               'label' => esc_html__( 'Features List', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'tp_design_style' => ['layout-2', 'layout-3']
               ]
             ]
        );
        
        // repeater for about features list with text , testarea and icon
        $repeater = new Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ]
            ]
        );
        $repeater->add_control(
            'tp_box_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tpcore'),
                'condition' => [
                    'tp_box_icon_type' => 'svg'
                ]
            ]
        );

        $repeater->add_control(
            'tp_box_icon_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_box_icon_type' => 'image'
                ]
            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_box_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_box_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_box_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tp_box_icon_type' => 'icon'
                    ]
                ]
            );
        }
        
        $repeater->add_control(
            'tp_about_features_list_title',
            [
                'label' => esc_html__('Title', 'tp-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Title', 'tp-core'),
                'title' => esc_html__('Enter title', 'tp-core'),
                'label_block' => true
                
            ]
        );
        $repeater->add_control(
            'tp_about_features_list_description',
            [
                'label' => esc_html__('Description', 'tp-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Description', 'tp-core'),
                'title' => esc_html__('Enter description', 'tp-core'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_2'
                ]
            ]
        );

        $this->add_control(
            'tp_about_features_list',
            [
                'label' => esc_html__('Features List', 'tp-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_about_features_list_title' => esc_html__('Custom shortcodes', 'tp-core'),
                        'tp_about_features_list_description' => esc_html__('No matter how much you know
                        about a part icular medical', 'tp-core'),
                    ],
                    [
                        'tp_about_features_list_title' => esc_html__('IT Consultant & Tech', 'tp-core'),
                        'tp_about_features_list_description' => esc_html__('No matter how much you know
                        about a part icular medical', 'tp-core'),
                    ]
                ],
                'title_field' => '{{{ tp_about_features_list_title }}}',
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
            '_tp_image',
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
        // progress bar section
        $this->start_controls_section(
            'tp_about_progress_bar',
                [
                'label' => esc_html__( 'Progress Bar', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => ['layout-2','layout-4']
                ]
            ]
        );
        $this->add_control(
            'extra_condition_prograss_bar',
            [
                'label' => __( 'Field condition', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'tpcore' ),
                    'style_2' => __( 'Style 2', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        $this->add_control(
            'tp_about_progress_bar_title',
            [
                'label' => esc_html__( 'Progress Bar Title', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );
        $this->add_control(
            'tp_about_progress_bar_value',
            [
                'label' => esc_html__( 'Progress Bar Value', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );
        $this->add_control(
            'tp_about_progress_bar_title_2',
            [
                'label' => esc_html__( 'Progress Bar Title 2', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'extra_condition_prograss_bar' => 'style_2'
                ]
            ]
        );
        $this->add_control(
            'tp_about_progress_bar_value_2',
            [
                'label' => esc_html__( 'Progress Bar Value 2', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'extra_condition_prograss_bar' => 'style_2'
                ]
            ]
        );
        $this->end_controls_section();

        // client section
        $this->start_controls_section(
            'tp_about_client',
                [
                'label' => esc_html__( 'Client', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-2'
                ]
            ]
        );
        $this->add_control(
            'tp_about_client_title',
            [
                'label' => esc_html__( 'Client Title', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'tp_about_client_subtitle',
            [
                'label' => esc_html__( 'Client subtitle', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );
        //client image
        $this->add_control(
            'tp_about_client_image',
            [
                'label' => esc_html__( 'Choose Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // client image size
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tp_about_client_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->end_controls_section();

        // shape section
        $this->start_controls_section(
            'tp_about_shape',
                [
                'label' => esc_html__( 'Shape', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => []
                ]
            ]
        );

        $this->add_control(
            'tp_about_shape_switch',
            [
            'label'        => esc_html__( 'Shape On/Off', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => '1',
            ]
        );

        $this->end_controls_section();

        // list
        $this->start_controls_section(
            'tp_about_list',
                [
                    'label' => esc_html__( 'Info List', 'tpcore' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'tp_design_style' => ['layout-1', 'layout-4']
                    ]
                ]
            );
            
            $repeater = new \Elementor\Repeater();
            
            $repeater->add_control(
            'tp_about_list_title_1',
                [
                'label'   => esc_html__( 'Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Default-value', 'tpcore' ),
                'label_block' => true,
                ]
            );
            
            $this->add_control(
                'tp_about_list_list_1',
                [
                'label'       => esc_html__( 'Features List', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                    'tp_about_list_title_1'   => esc_html__( ' Mistakes To Avoid to dum Auam. ', 'tpcore' ),
                    ],
                    [
                    'tp_about_list_title_1'   => esc_html__( 'Avoid to the dumy mistakes', 'tpcore' ),
                    ],
                    [
                    'tp_about_list_title_1'   => esc_html__( ' Your Startup industry stan', 'tpcore' ),
                    ],
                ],
                'title_field' => '{{{ tp_about_list_title_1 }}}',
                ]
            );
            $this->end_controls_section();
        // tp_video
        $this->start_controls_section(
            'tp_video',
            [
                'label' => esc_html__('Video', 'tpcore'),
                'condition' => [
                    'tp_design_style' => ['layout-3']
                ]
            ]
        );

        $this->add_control(
            'tp_video_url',
            [
                'label' => esc_html__('Video URL', 'tpcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'https://www.youtube.com/watch?v=_RpLvsA1SNM',
                'label_block' => true,
                'description' => __("We recommended to put video url form video website such as 'youtube', 'vimeo'.", 'tpcore')
            ]
        );
        $this->add_control(
            'tp_video_title',
                [
                'label'   => esc_html__( 'Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Default-value', 'tpcore' ),
                'label_block' => true,
                ]
            );

        $this->end_controls_section();

        // shape
        $this->start_controls_section(
        'tp_shape',
            [
                'label' => esc_html__( 'Shape Section', 'tpcore' ),
                'condition' =>[
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
        'tp_shape_switch',
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
                'label' => esc_html__( 'Choose Shape Image 1', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_shape_switch' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tp_shape_image_2',
            [
                'label' => esc_html__( 'Choose Shape Image 2', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_shape_switch' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tp_shape_image_3',
            [
                'label' => esc_html__( 'Choose Shape Image 3', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_shape_switch' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tp_shape_image_4',
            [
                'label' => esc_html__( 'Choose Shape Image 4', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_shape_switch' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'default' => 'full',
                'condition' => [
                    'tp_shape_switch' => 'yes'
                ]
            ]
        );
        
        $this->end_controls_section();

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('about_section', 'Section - Style', '.tp-el-section'); 
        $this->tp_basic_style_controls('section_sub_title', 'Section - Sub Title', '.tp-el-sub-title', ['layout-1', 'layout-2', 'layout-3', 'layout-4']);
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title', ['layout-1', 'layout-2', 'layout-3', 'layout-4']);
        $this->tp_basic_style_controls('section_des', 'Section - Description', '.tp-el-des', ['layout-1', 'layout-2', 'layout-3', 'layout-4']);
        $this->tp_basic_style_controls('section_list', 'Section - List', '.tp-el-list', ['layout-1', 'layout-4']);
        $this->tp_link_controls_style('section_btn', 'Section - Button', '.tp-el-btn', ['layout-1', 'layout-2', 'layout-3', 'layout-4']);
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
     if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_2']['url']) ) {
        $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
        $tp_image_alt_2 = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_about_client_image']['url']) ) {
        $tp_about_client_image = !empty($settings['tp_about_client_image']['id']) ? wp_get_attachment_image_url( $settings['tp_about_client_image']['id'], $settings['tp_about_client_image_size_size']) : $settings['tp_about_client_image']['url'];
        $tp_about_client_image_alt = get_post_meta($settings["tp_about_client_image"]["id"], "_wp_attachment_image_alt", true);
    }
    
    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-btn');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title');
?>
<!-- about area start -->
<section class="tp-about-area-2 p-relative tp-el-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="tp-about-thumb-wrapper-2 p-relative wow fadeInLeft" data-wow-duration="1s"
                    data-wow-delay=".3s">
                    <?php if(!empty($tp_image)) : ?>
                    <img class="img-1" src="<?php echo esc_url($tp_image); ?>"
                        alt="<?php echo esc_attr($tp_image_alt); ?>">
                    <?php endif; ?>
                    <?php if(!empty($tp_image_2)) : ?>
                    <div class="img-2">
                        <img src="<?php echo esc_url($tp_image_2); ?>" alt="<?php echo esc_attr($tp_image_alt_2); ?>">
                    </div>
                    <?php endif; ?>

                    <img class="img-3"
                        src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/home-2/shape-2.png" alt="">
                    <div class="tp-about-progressbar">
                        <div class="circular tl-progress">
                            <input type="text" class="knob" value="0"
                                data-rel="<?php echo esc_attr($settings['tp_about_progress_bar_value']); ?>"
                                data-linecap="round" data-width="100%" data-height="100" data-bgcolor="#ECEEF3"
                                data-fgcolor="#00A3C3" data-thickness=".07" data-readonly="true" disabled />
                        </div>

                        <?php if ( !empty($settings['tp_about_progress_bar_title']) ) : ?>
                        <h3><?php echo tp_kses($settings['tp_about_progress_bar_title']); ?></h3>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="tp-about-wrapper-2">
                    <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
                    <div class="tp-about-title-wrapper">
                        <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                        <span class="tp-section-title-pre tp-el-sub-title"><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></span>
                        <?php endif; ?>
                       
                       
                    </div>
                    <?php endif; ?>
                    <?php if ( !empty($settings['tp_about_description']) ) : ?>
                    <p class="tp-el-des"><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                    <?php endif; ?>
                    <div class="tp-about-item-2 d-flex">
                        <?php 
                            if ( !empty($settings['tp_about_features_list']) ) :
                                foreach ( $settings['tp_about_features_list'] as $item ) :
                                    $title = $item['tp_about_features_list_title'];
                                    $description = $item['tp_about_features_list_description']; 
                            ?>
                        <div class="tp-about-item-2-inner d-flex">
                            <div class="tp-about-item-2-icon">
                                <span>
                                    <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                    <?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                                    <?php endif; ?>
                                    <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                    <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                    <img src="<?php echo $item['tp_box_icon_image']['url']; ?>"
                                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>
                                    <?php else : ?>
                                    <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                    <?php echo $item['tp_box_icon_svg']; ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="tp-about-item-2-content">
                                <?php  if ( !empty('tp_about_features_list_title') ) : ?>
                                <h5 class="tp-about-item-2-title">
                                    <?php echo tp_kses( $item['tp_about_features_list_title'] ); ?></h5>
                                <?php endif; ?>
                                <?php  if ( !empty($item['tp_about_features_list_description']) ) : ?>
                                <p><?php echo tp_kses( $item['tp_about_features_list_description'] ); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; endif; ?>

                    </div>
                    <div class="tp-about-btn-wrapper-2 d-flex align-items-center">
                        <?php if ( !empty($settings['tp_btn_text']) ) : ?>
                        <div class="tp-about-btn-2">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo tp_kses($settings['tp_btn_text']); ?></a>
                        </div>
                        <?php endif; ?>
                        <div class="tp-about-user d-flex align-items-center">
                            <?php if(!empty($tp_about_client_image)) : ?>
                            <div class="tp-about-user-thumb">
                                <img src="<?php echo esc_url($tp_about_client_image); ?>"
                                    alt="<?php echo esc_attr($tp_about_client_image_alt); ?>">
                            </div>
                            <?php endif; ?>
                            <div class="tp-about-user-content">
                                <?php if(!empty($settings['tp_about_client_subtitle'])) : ?>
                                <p><?php echo tp_kses($settings['tp_about_client_subtitle']); ?></p>
                                <?php endif; ?>
                                <?php if(!empty($settings['tp_about_client_title'])) : ?>
                                <h4>
                                    <?php echo tp_kses($settings['tp_about_client_title']); ?>
                                </h4>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_2']['url']) ) {
        $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
        $tp_image_alt_2 = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_about_client_image']['url']) ) {
        $tp_about_client_image = !empty($settings['tp_about_client_image']['id']) ? wp_get_attachment_image_url( $settings['tp_about_client_image']['id'], $settings['tp_about_client_image_size_size']) : $settings['tp_about_client_image']['url'];
        $tp_about_client_image_alt = get_post_meta($settings["tp_about_client_image"]["id"], "_wp_attachment_image_alt", true);
    }

    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-btn');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title');
?>

<!-- about area start -->
<section class="tp-about-area-3 p-relative pt-130 pb-110 tp-el-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="tp-about-thumb-wrapper-3 p-relative text-center text-lg-end wow fadeInLeft"
                    data-wow-duration="1s" data-wow-delay=".3s">
                    <img class="shape"
                        src="<?php echo get_template_directory_uri(); ?>/assets/img/about/home-3/shape-1.png" alt="">
                    <img class="shape-2"
                        src="<?php echo get_template_directory_uri(); ?>/assets/img/about/home-3/shape-2.jpg" alt="">
                    <?php if(!empty($tp_image)) : ?>
                    <div class="main">
                        <img class="text-end" src="<?php echo esc_url($tp_image); ?>"
                            alt="<?php echo esc_attr($tp_image_alt); ?>">
                    </div>
                    <?php endif; ?>

                    <div class="tp-about-thumb-counter text-center">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/home-3/icon-1.svg"
                            alt="">
                        <h4 class="tp-about-thumb-title">
                            <span class="purecounter" data-purecounter-duration="3" data-purecounter-end="5000"></span>+
                        </h4>
                        <p>Satisfied Clients</p>    
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="tp-about-wrapper-3">
                    <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
                    <div class="tp-about-title-wrapper">
                        <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                        <span class="tp-section-title-pre tp-el-sub-title"><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></span>
                        <?php endif; ?>
                        <?php if ( !empty($settings['tp_about_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_about_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_about_title' ] )
                                );
                            endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php if ( !empty($settings['tp_about_description']) ) : ?>
                    <p class="tp-el-des"><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                    <?php endif; ?>
                    <div class="tp-about-item-wrapper-3 d-flex flex-wrap">
                        <?php 
                            if ( !empty($settings['tp_about_features_list']) ) :
                                foreach ( $settings['tp_about_features_list'] as $item ) :
                                    $title = $item['tp_about_features_list_title'];
                                    $description = $item['tp_about_features_list_description']; 
                            ?>
                        <div class="tp-about-item-3 d-flex align-items-center mb-20 mr-30">
                            <div class="tp-about-item-icon-3">
                                <span>
                                    <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                    <?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                                    <?php endif; ?>
                                    <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                    <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                    <img src="<?php echo $item['tp_box_icon_image']['url']; ?>"
                                        alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>
                                    <?php else : ?>
                                    <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                    <?php echo $item['tp_box_icon_svg']; ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <?php  if ( !empty('tp_about_features_list_title') ) : ?>
                            <h3 class="tp-about-item-title-3">
                                <?php echo tp_kses( $item['tp_about_features_list_title'] ); ?></h3>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; endif; ?>
                    </div>
                    <?php if ( !empty($settings['tp_about_description']) ) : ?>
                    <p><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                    <?php endif; ?>
                    <div class="tp-about-btn-wrapper-2 d-flex align-items-center">
                        <?php if ( !empty($settings['tp_btn_text']) ) : ?>
                        <div class="tp-about-btn-3 mr-80">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo tp_kses($settings['tp_btn_text']); ?><span><i
                                        class="fa-regular fa-plus"></i></span></a>
                        </div>
                        <?php endif; ?>
                        <div class="tp-about-video">
                            <a class="popup-video" href="<?php echo tp_kses($settings['tp_video_url']); ?>"> <span><i
                                        class="fa-sharp fa-solid fa-play"></i></span>
                                <?php echo tp_kses($settings['tp_video_title']); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about area end -->

<?php elseif ( $settings['tp_design_style']  == 'layout-4' ): 
    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_2']['url']) ) {
        $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
        $tp_image_alt_2 = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_about_client_image']['url']) ) {
        $tp_about_client_image = !empty($settings['tp_about_client_image']['id']) ? wp_get_attachment_image_url( $settings['tp_about_client_image']['id'], $settings['tp_about_client_image_size_size']) : $settings['tp_about_client_image']['url'];
        $tp_about_client_image_alt = get_post_meta($settings["tp_about_client_image"]["id"], "_wp_attachment_image_alt", true);
    }

    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-btn');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title');
?>

<!-- support area start -->
<section class="tp-support-area tp-support-bg p-relative tp-el-section">
    <div class="container">
        <div class="tp-support-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <div class="tp-support-thumb d-flex justify-content-center justify-content-lg-end p-relative wow fadeInLeft"
                        data-wow-duration="1s" data-wow-delay=".3s">
                        <?php if(!empty($tp_image)) : ?>
                        <img class="main" src="<?php echo esc_url($tp_image); ?>"
                            alt="<?php echo esc_attr($tp_image_alt); ?>">
                        <?php endif; ?>
                        <img class="shape-1"
                            src="<?php echo get_template_directory_uri(); ?>/assets/img/support/shape-1.png" alt="">
                        <img class="shape-2"
                            src="<?php echo get_template_directory_uri(); ?>/assets/img/support/shape-2.png" alt="">
                        <div class="tp-support-count text-center">
                            <div class="counter-border">
                                <div class="circular tl-progress">
                                    <input type="text" class="knob" value="0" data-rel="<?php echo esc_attr($settings['tp_about_progress_bar_value']); ?>" data-linecap="round"
                                        data-width="140" data-height="140" data-bgcolor="#ECEEF3" data-fgcolor="#00A3C3"
                                        data-thickness="0.2" data-readonly="true" disabled />
                                </div>
                                <?php if ( !empty($settings['tp_about_progress_bar_title']) ) : ?>
                                <span><?php echo tp_kses($settings['tp_about_progress_bar_title']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tp-support-wrapper-inner">
                        <div class="tp-support-title-wrapper">
                            <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                            <span class="tp-section-title-pre tp-el-sub-title"><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></span>
                            <?php endif; ?>
                            <?php if ( !empty($settings['tp_about_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_about_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_about_title' ] )
                                );
                            endif; ?>
                        </div>
                        <?php if ( !empty($settings['tp_about_description']) ) : ?>
                        <p class="tp-el-des"><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                        <?php endif; ?>
                        <ul>
                            <?php foreach ($settings['tp_about_list_list_1'] as $key => $item) : ?>
                            <li class="tp-el-list"><i class="fa-regular fa-check"></i>
                                <?php echo tp_kses($item['tp_about_list_title_1']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php if ( !empty($settings['tp_btn_text']) ) : ?>
                        <div class="tp-support-btn">
                            <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo tp_kses($settings['tp_btn_text']); ?><span><i
                                        class="fa-regular fa-plus"></i></span></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- support area end -->
<?php else:

    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_image_2']['url']) ) {
        $tp_image_2 = !empty($settings['tp_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_image_2']['id'], $settings['tp_image_size_size']) : $settings['tp_image_2']['url'];
        $tp_image_alt_2 = get_post_meta($settings["tp_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_about_client_image']['url']) ) {
        $tp_about_client_image = !empty($settings['tp_about_client_image']['id']) ? wp_get_attachment_image_url( $settings['tp_about_client_image']['id'], $settings['tp_about_client_image_size_size']) : $settings['tp_about_client_image']['url'];
        $tp_about_client_image_alt = get_post_meta($settings["tp_about_client_image"]["id"], "_wp_attachment_image_alt", true);
    }

    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }

    if ( !empty($settings['tp_shape_image_2']['url']) ) {
        $tp_shape_image2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
        $tp_shape_image_alt2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }

    if ( !empty($settings['tp_shape_image_3']['url']) ) {
        $tp_shape_image3 = !empty($settings['tp_shape_image_3']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_3']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_3']['url'];
        $tp_shape_image_alt3 = get_post_meta($settings["tp_shape_image_3"]["id"], "_wp_attachment_image_alt", true);
    }

    if ( !empty($settings['tp_shape_image_4']['url']) ) {
        $tp_shape_image4 = !empty($settings['tp_shape_image_4']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_4']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_4']['url'];
        $tp_shape_image_alt4 = get_post_meta($settings["tp_shape_image_4"]["id"], "_wp_attachment_image_alt", true);
    }

    // Link
    if ('2' == $settings['tp_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-btn');
    } else {
        if ( ! empty( $settings['tp_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn tp-el-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title');
?>
<!-- about area start -->
<section class="tp-about-area p-relative pt-130 pb-210 tp-el-section">
    <?php if(!empty($tp_shape_image)) : ?>
    <div class="tp-about-shape">
        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="tp-about-thumb-wrapper p-relative wow fadeInLeft" data-wow-duration="1s"
                    data-wow-delay=".3s">
                    <?php if(!empty($tp_image)) : ?>
                    <div class="main">
                        <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($tp_image_2)) : ?>
                    <img class="shape-1" src="<?php echo esc_url($tp_image_2); ?>"
                        alt="<?php echo esc_attr($tp_image_alt_2); ?>">
                    <?php endif; ?>

                    <?php if(!empty($tp_shape_image2)) : ?>
                    <img class="shape-2" src="<?php echo esc_url($tp_shape_image2); ?>" alt="<?php echo esc_attr($tp_shape_image_alt2); ?>">
                    <?php endif; ?>
                    <?php if(!empty($tp_shape_image3)) : ?>
                    <img class="shape-3" src="<?php echo esc_url($tp_shape_image3); ?>" alt="<?php echo esc_attr($tp_shape_image_alt3); ?>">
                    <?php endif; ?>
                    <?php if(!empty($tp_shape_image4)) : ?>
                    <img class="shape-4" src="<?php echo esc_url($tp_shape_image4); ?>" alt="<?php echo esc_attr($tp_shape_image_alt4); ?>">
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="tp-about-wrapper">
                    <?php if ( !empty($settings['tp_about_section_title_show']) ) : ?>
                    <div class="tp-about-title-wrapper">
                        <?php if ( !empty($settings['tp_about_sub_title']) ) : ?>
                        <span class="tp-section-title-pre tp-el-sub-title"><?php echo tp_kses( $settings['tp_about_sub_title'] ); ?></span>
                        <?php endif; ?>
                        <?php if ( !empty($settings['tp_about_title' ]) ) :
                                printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['tp_about_title_tag'] ),
                                $this->get_render_attribute_string( 'title_args' ),
                                tp_kses( $settings['tp_about_title' ] )
                                );
                            endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php if ( !empty($settings['tp_about_description']) ) : ?>
                    <p class="tp-el-des"><?php echo tp_kses( $settings['tp_about_description'] ); ?></p>
                    <?php endif; ?>
                    <div class="tp-about-wrapper-list">
                        <ul>
                            <?php foreach ($settings['tp_about_list_list_1'] as $key => $item) : ?>
                            <li class="tp-el-list"><span><i class="fa-regular fa-circle"></i></span>
                                <?php echo tp_kses($item['tp_about_list_title_1']); ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div> 

                    <?php if ( !empty($settings['tp_btn_text']) ) : ?>
                    <div class="tp-about-btn">
                        <a <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>><?php echo tp_kses($settings['tp_btn_text']); ?><span><i class="fa-regular fa-plus"></i></span></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about area end -->

<?php endif; 
	}
}

$widgets_manager->register( new TP_About() );