<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Box_Shadow;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Skill extends Widget_Base {

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
		return 'skill-bar';
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
		return __( 'Skill', 'tpcore' );
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
                ],
                'default' => 'layout-1',
            ]
		);

		$this->end_controls_section();

        $this->tp_section_title_render_controls('skill', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-1', 'layout-2']);

        
		// icon/image Panel
		$this->start_controls_section(
            'icon_layout',
            [
                'label' => esc_html__('Icon/Image Section', 'tpcore'),
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
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
        $this->add_control(
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

        $this->add_control(
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
            $this->add_control(
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
            $this->add_control(
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
            'tp_thumb_img',
            [
                'label' => esc_html__( 'Choose Small Thumbnail', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumb_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
            ]
        );

        $this->end_controls_section();

        // Skill
        $this->start_controls_section(
            'tp_progress_bar',
            [
                'label' => esc_html__('Skill Bar', 'tpcore', ['layout-1', 'layout-2']),
            ]
        );

        $repeater = new Repeater();

        
        $repeater->add_control(
            'tp_skill_box_title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Skill Title', 'tpcore' ),
                'default' => esc_html__( 'Design', 'tpcore' ),
                'placeholder' => esc_html__( 'Type a skill name', 'tpcore' ),
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'tp_skill_num',
            [
                'label'       => esc_html__( 'Skill Number', 'tpcore' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '85', 'tpcore' ),
                'placeholder' => esc_html__( 'Your Number', 'tpcore' ),
            ]
        );

        $this->add_control(
            'tp_skill_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_skill_box_title' => esc_html__('Design', 'tpcore'),
                        'tp_skill_num' => '70',
                    ],
                    [
                        'tp_skill_box_title' => esc_html__('Development', 'tpcore'),
                        'tp_skill_num' => '80',
                    ],
                    [
                        'tp_skill_box_title' => esc_html__('Customization', 'tpcore'),
                        'tp_skill_num' => '95',
                    ],
                ],
                'title_field' => '{{{ tp_skill_box_title }}}',
            ]
        );

        $this->end_controls_section();

        // shape
        $this->start_controls_section(
        'tp_shape',
            [
                'label' => esc_html__( 'Shape Section', 'tpcore' ),
                'condition' => [
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
                'label' => esc_html__( 'Choose Shape Image 1', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_shape_switch' => 'yes'
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
                    'tp_shape_switch' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'tp_shape_switch' => 'yes'
                ]
            ]
        );
        
        $this->end_controls_section();
	}


    protected function style_tab_content(){
        $this->tp_section_style_controls('skill_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_sub_title', 'Section - Sub Title', '.tp-el-sub-title', ['layout-1', 'layout-2']);
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title', ['layout-1', 'layout-2']);
        $this->tp_basic_style_controls('section_des', 'Section - Description', '.tp-el-des', ['layout-1', 'layout-2']);
        # repeater
        $this->tp_basic_style_controls('rep_title', 'Repeater Title', '.tp-el-rep-title', ['layout-1', 'layout-2']);
        $this->tp_link_controls_style('rep_bar', 'Progress Bar Color', '.tp-el-rep-bar', ['layout-1', 'layout-2']);
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

<?php if ( $settings['tp_design_style']  == 'layout-2' ) : 
        $this->add_render_attribute('title_args', 'class', 'tp-team-details-title tp-el-title');    
    ?>
<div class="tp-team-details-skills fix ele-section">
    <?php if ( !empty($settings['tp_skill_sub_title']) ) : ?>
    <span class="tp-section-title-pre tp-el-sub-title">
        <?php echo tp_kses( $settings['tp_skill_sub_title'] ); ?>
    </span>
    <?php endif; ?>
    <?php
        if ( !empty($settings['tp_skill_title' ]) ) :
            printf( '<%1$s %2$s>%3$s</%1$s>',
            tag_escape( $settings['tp_skill_title_tag'] ),
            $this->get_render_attribute_string( 'title_args' ),
            tp_kses( $settings['tp_skill_title' ] )
            );
        endif;
        ?>
    <?php if ( !empty($settings['tp_skill_description']) ) : ?>
    <p class="tp-el-des"><?php echo tp_kses( $settings['tp_skill_description'] ); ?></p>
    <?php endif; ?>
    <div class="tp-team-details-skills-progress">
    <?php foreach ( $settings['tp_skill_list'] as $key => $item ) : ?>
        <div class="tp-team-details-progress-item">
            <div class="tp-team-details-progress-title p-relative">
                <h5 class="tp-el-rep-title"><?php echo tp_kses($item['tp_skill_box_title']); ?><span class="pursent-1 wow slideInLeft" data-wow-duration=".8s"
                        data-wow-delay=".3s"><?php echo tp_kses($item['tp_skill_num']); ?>%</span></h5>

            </div>
            <div class="progress">
                <div class="progress-bar wow slideInLeft tp-el-rep-bar" data-wow-duration=".8s" data-wow-delay=".3s"
                    role="progressbar" data-width="<?php echo esc_attr($item['tp_skill_num']); ?>%" aria-valuenow="<?php echo esc_attr($item['tp_skill_num']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>


<?php else:
    // shape image
    if ( !empty($settings['tp_shape_image_1']['url']) ) {
        $tp_shape_image = !empty($settings['tp_shape_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_1']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_1']['url'];
        $tp_shape_image_alt = get_post_meta($settings["tp_shape_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_shape_image_2']['url']) ) {
        $tp_shape_image_2 = !empty($settings['tp_shape_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_shape_image_2']['id'], $settings['shape_image_size_size']) : $settings['tp_shape_image_2']['url'];
        $tp_shape_image_alt_2 = get_post_meta($settings["tp_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    // small thumbnail
    if ( !empty($settings['tp_thumb_img']['url']) ) {
        $tp_thumb_img = !empty($settings['tp_thumb_img']['id']) ? wp_get_attachment_image_url( $settings['tp_thumb_img']['id'], $settings['thumb_image_size_size']) : $settings['tp_thumb_img']['url'];
        $tp_thumb_img_alt = get_post_meta($settings["tp_thumb_img"]["id"], "_wp_attachment_image_alt", true);
    }
    $this->add_render_attribute('title_args', 'class', 'tp-section__title mb-50 tp-el-title');
?>

<section class="choose-area tp-choose-3-responsive-padding pt-10 pb-120 p-relative fix tp-el-section">
    <?php if(!empty($tp_shape_image)) : ?>
    <div class="tp-choose-3__shap-1">
        <img src="<?php echo esc_url($tp_shape_image); ?>" alt="<?php echo esc_attr($tp_shape_image_alt); ?>">
    </div>
    <?php endif; ?>
    <?php if(!empty($tp_shape_image_2)) : ?>
    <div class="tp-choose-3__shap-2 d-none d-xxl-block">
        <img src="<?php echo esc_url($tp_shape_image_2); ?>" alt="<?php echo esc_attr($tp_shape_image_alt_2); ?>">
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row pt-120">
            <div class="col-xl-7 col-lg-6 col-md-12  col-12 wow fadeInUp  " data-wow-duration=".9s"
                data-wow-delay=".5s">
                <div class="tp-choose-3__section-title z-index ">
                    <?php
                        if ( !empty($settings['tp_skill_title' ]) ) :
                            printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['tp_skill_title_tag'] ),
                            $this->get_render_attribute_string( 'title_args' ),
                            tp_kses( $settings['tp_skill_title' ] )
                            );
                        endif;
                    ?>
                </div>

                <div class="tp-choose-3__box d-flex align-items-center">
                    <div class="tp-choose-3__thumb-img p-relative mr-60">
                        <?php if(!empty($tp_thumb_img)) : ?>
                        <img src="<?php echo esc_url($tp_thumb_img); ?>"
                            alt="<?php echo esc_attr($tp_thumb_img_alt); ?>">
                        <?php endif; ?>

                        <?php if($settings['tp_box_icon_type'] == 'icon') : ?>
                        <?php if (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value'])) : ?>
                        <div class="icon">
                            <span><?php tp_render_icon($settings, 'tp_box_icon', 'tp_box_selected_icon'); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php elseif( $settings['tp_box_icon_type'] == 'image' ) : ?>
                        <?php if (!empty($settings['tp_box_icon_image']['url'])): ?>
                        <div class="icon">
                            <span><img src="<?php echo $settings['tp_box_icon_image']['url']; ?>"
                                    alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>"></span>
                        </div>
                        <?php endif; ?>
                        <?php else : ?>
                        <?php if (!empty($settings['tp_box_icon_svg'])): ?>
                        <div class="icon">
                            <span><?php echo $settings['tp_box_icon_svg']; ?></span>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>

                    </div>
                    <div class="tp-choose-3__box-content">
                        <?php if ( !empty($settings['tp_skill_sub_title']) ) : ?>
                        <h3 class="tp-choose-3-title tp-el-sub-title"><?php echo tp_kses( $settings['tp_skill_sub_title'] ); ?></h3>
                        <?php endif; ?>
                        <?php if ( !empty($settings['tp_skill_description']) ) : ?>
                        <p class="tp-el-des"><?php echo tp_kses( $settings['tp_skill_description'] ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6 col-md-12 col-12  wow fadeInUp  " data-wow-duration=".9s"
                data-wow-delay=".7s">
                <div class="tp-choose-3__progress-bar mb-50 fix">

                    <?php foreach ( $settings['tp_skill_list'] as $key => $item ) : ?>
                    <?php if(!empty($item['tp_skill_box_title'])) : ?>
                    <span class="tp-el-rep-title"><?php echo tp_kses($item['tp_skill_box_title']); ?></span>
                    <?php endif; ?>
                    <div class="tp-choose-3__bar mb-25">
                        <div class="tp-choose-3__bar-item">
                            <div class="tp-choose-3__bar-progress">
                                <?php if(!empty($item['tp_skill_num'])) : ?>
                                <div class="progress">
                                    <div class="progress-bar tp-el-rep-bar wow slideInLeft" data-wow-delay="0s"
                                        data-wow-duration=".8s" role="progressbar"
                                        data-width="<?php echo esc_attr($item['tp_skill_num']); ?>%"
                                        aria-valuenow="<?php echo esc_attr($item['tp_skill_num']); ?>" aria-valuemin="0"
                                        aria-valuemax="100">
                                        <span><?php echo tp_kses($item['tp_skill_num']); ?>%</span>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php endif; 
	}

}

$widgets_manager->register( new TP_Skill() );