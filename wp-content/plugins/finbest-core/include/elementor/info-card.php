<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Info_Card extends Widget_Base {

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
		return 'tp-info-card';
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
		return __( 'Info Card', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'tpcore_contact',
            [
                'label' => esc_html__('Contact Form', 'tpcore'),
            ]
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
		$this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-1'] );
        // Contact info list
        $this->start_controls_section(
            '_tp_contact_info',
            [
                'label' => esc_html__('Contact  List', 'tpcore'),
                'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
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
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],

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
                    'tp_box_icon_type' => 'image',
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
            'tp_contact_title',
            [
                'label'       => esc_html__( 'Title', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Your Title here', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Heading Text', 'tpcore' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_contact_des',
            [
                'label'       => esc_html__( 'Description', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => esc_html__( 'Your Description here', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Descripion Text', 'tpcore' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_list',
            [
                'label' => esc_html__('Contact - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_contact_title' => esc_html__('Text 1', 'tpcore'),
                    ],
                    [
                        'tp_contact_title' => esc_html__('Text 2', 'tpcore')
                    ],
                ],
                'title_field' => '{{{ tp_contact_title }}}',
            ]
        );
        $this->end_controls_section();
                // Contact info list
                $this->start_controls_section(
                    'social_tp_contact_info',
                    [
                        'label' => esc_html__('Contact  social', 'tpcore'),
                        'description' => esc_html__( 'Control all the style settings from Style tab', 'tpcore' ),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    ]
                );
        
                $repeater = new \Elementor\Repeater();
        
                $repeater->add_control(
                    'social_repeater_condition',
                    [
                        'label' => __( 'Field condition', 'tpcore' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            'style_1' => __( 'Style 1', 'tpcore' ),
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
                        'default' => 'icon',
                        'options' => [
                            'image' => esc_html__('Image', 'tpcore'),
                            'icon' => esc_html__('Icon', 'tpcore'),
                            'svg' => esc_html__('SVG', 'tpcore'),
                        ],
        
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
                            'tp_box_icon_type' => 'image',
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
                
        $this->add_control(
            'tp_list_social',
            [
                'label' => esc_html__('Contact - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tp_box_icon_svg }}}',
            ]
        );
        $this->end_controls_section();

        
    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('card_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_sub_title', 'Section - Sub Title', '.tp-el-sub-title');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('section_des', 'Section - Description', '.tp-el-des');
        # repeater
        $this->tp_icon_style('rep_icon', 'Repeater Icon', '.tp-el-rep-icon');
        $this->tp_basic_style_controls('rep_title', 'Repeater Title', '.tp-el-rep-title');
        $this->tp_basic_style_controls('rep_des', 'Repeater Description', '.tp-el-rep-des');
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

<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>

<?php else: 
     $this->add_render_attribute('title_args', 'class', 'tp-contact-breadcrumb-title tp-el-title');
 ?>

<!-- contact area start -->
<section class="tp-contact-breadcrumb-area pt-120 pb-90 tp-el-section">
    <div class="container">
        <div class="tp-contact-breadcrumb-box">
            <div class="tp-contact-breadcrumb-social">

                <?php foreach ($settings['tp_list_social'] as $key => $item) : ?>
                <a href="#">
                    <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                    <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                    <span><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                    <?php endif; ?>
                    <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                    <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                    <span><img src="<?php echo $item['tp_box_icon_image']['url']; ?>"
                            alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>"></span>
                    <?php endif; ?>
                    <?php else : ?>
                    <?php if (!empty($item['tp_box_icon_svg'])): ?>
                    <span><?php echo $item['tp_box_icon_svg']; ?></span>
                    <?php endif; ?>
                    <?php endif; ?>
                </a>
                <?php endforeach; ?>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="tp-contact-breadcrumb-content">
                        
                        <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                        <span class="tp-section-title-pre tp-el-sub-title">
                            <?php echo tp_kses( $settings['tp_section_sub_title'] ); ?>
                        </span>
                        <?php endif; ?>
                        <?php
                        if ( !empty($settings['tp_section_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['tp_section_title_tag'] ),
                            $this->get_render_attribute_string( 'title_args' ),
                            tp_kses( $settings['tp_section_title' ] )
                            );
                        endif;
                        ?>
                        <?php if ( !empty($settings['tp_section_description']) ) : ?>
                        <p class="tp-el-des"><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                        <?php endif; ?>
                        <div id="contact-form">
                        <?php if( !empty($settings['tpcore_select_contact_form']) ) : ?>
                        <?php echo do_shortcode( '[contact-form-7  id="'.$settings['tpcore_select_contact_form'].'"]' ); ?>
                        <?php else : ?>
                        <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore' ). '</p></div>'; ?>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="tp-contact-breadcrumb-wrapper">
                        <?php foreach ($settings['tp_list'] as $key => $item) : 
                            $class = '';
                            if($key == 0){
                                $class = 'theme-color';
                            } elseif ($key == 1){
                                $class = 'theme-background';
                            } elseif ($key == 2){
                                $class = 'theme-color-2';
                            }
                            ?>
                        <div class="tp-contact-breadcrumb-item mb-40 d-flex">
                            <div class="tp-contact-breadcrumb-item-icon">
                                <span class="tp-el-rep-icon">
                                    <?php if($item['tp_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($item['tp_box_icon']) || !empty($item['tp_box_selected_icon']['value'])) : ?>
                                    <span><?php tp_render_icon($item, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                                    <?php endif; ?>
                                    <?php elseif( $item['tp_box_icon_type'] == 'image' ) : ?>
                                    <?php if (!empty($item['tp_box_icon_image']['url'])): ?>
                                    <span><img src="<?php echo $item['tp_box_icon_image']['url']; ?>"
                                            alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>"></span>
                                    <?php endif; ?>
                                    <?php else : ?>
                                    <?php if (!empty($item['tp_box_icon_svg'])): ?>
                                    <span><?php echo $item['tp_box_icon_svg']; ?></span>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                            <div class="tp-contact-breadcrumb-item-content">

                                <?php if(!empty($item['tp_contact_title'])) : ?>
                                <h3 class="tp-contact-breadcrumb-item-title tp-el-rep-title">
                                    <?php echo tp_kses($item['tp_contact_title']); ?></h3>
                                <?php endif; ?>
                                <?php if(!empty($item['tp_contact_des'])) : ?>
                                <p class="tp-el-rep-des"><?php echo tp_kses($item['tp_contact_des']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact area end -->
<?php endif; 
	}
}

$widgets_manager->register( new TP_Info_Card() );