<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use TPCore\Elementor\Controls\Group_Control_TPBGGradient;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Fact extends Widget_Base {

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
		return 'tp-fact';
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
		return __( 'Fact', 'tpcore' );
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


        // fact group
        $this->start_controls_section(
            'tp_fact',
            [
                'label' => esc_html__('Fact List', 'tpcore'),
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
                    'style_4' => __( 'Style 4', 'tpcore' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        //icon image svg

        $repeater->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'svg',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ],
                'condition' => [
                    'repeater_condition' => ['style_1'],
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
                    'tp_box_icon_type' => 'svg',
                    'repeater_condition' => ['style_1','style-2'],
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
                    'repeater_condition' => ['style_1','style-2'],
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
                        'tp_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_1','style-2'],
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
                        'tp_box_icon_type' => 'icon',
                        'repeater_condition' => ['style_1','style-2'],
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_fact_number', [
                'label' => esc_html__('Number', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('17', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_fact_number_unit', [
                'label' => esc_html__('Number Unit', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('K', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_fact_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Food', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_fact_des',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Average time to resolve.', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_2'
                ]
            ]
        );    

        // creative animation
        $repeater->add_control(
			'tp_creative_anima_switcher',
			[
				'label' => esc_html__( 'Active Animation', 'tpcore' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'tpcore   ' ),
				'label_off' => esc_html__( 'No', 'tpcore   ' ),
				'return_value' => 'yes',
				'default' => '0',
                'separator' => 'before',
                'condition' => [
                    'repeater_condition' => ['style_2']
                ]
			]
		);

        $repeater->add_control(
            'tp_anima_type',
            [
                'label' => __( 'Animation Type', 'tpcore' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fadeUp' => __( 'fadeUp', 'tpcore' ),
                    'fadeDown' => __( 'fadeDown', 'tpcore' ),
                    'fadeLeft' => __( 'fadeLeft', 'tpcore' ),
                    'fadeRight' => __( 'fadeRight', 'tpcore' ),
                ],
                'default' => 'fadeUp',
                'frontend_available' => true,
                'style_transfer' => true,
                'condition' => [
                    'tp_creative_anima_switcher' => 'yes',
                    'repeater_condition' => ['style_2']
                ],
            ]
        );

        $this->add_control(
            'tp_fact_list',
            [
                'label' => esc_html__('Fact - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_fact_number' => esc_html__('23', 'tpcore'),
                        'tp_fact_title' => esc_html__('Business', 'tpcore'),
                    ],
                    [
                        'tp_fact_number' => esc_html__('45', 'tpcore'),
                        'tp_fact_title' => esc_html__('Website', 'tpcore')
                    ],
                    [
                        'tp_fact_number' => esc_html__('129', 'tpcore'),
                        'tp_fact_title' => esc_html__('Marketing', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_fact_title }}}',
            ]
        );
        $this->end_controls_section();

        
        // _tp_image
		$this->start_controls_section(
            '_tp_image',
            [
                'label' => esc_html__('Thumbnail', 'tp-core'),
                'condition' => [
                    'tp_design_style' => 'layout-5'
                ]
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


        // title/content
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', ['layout-5'] );

        // list
        $this->start_controls_section(
        'tp_list_sec',
            [
                'label' => esc_html__( 'Info List', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-5'
                ]
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
        'tp_text_list_title',
            [
            'label'   => esc_html__( 'Title', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__( 'Default-value', 'tpcore' ),
            'label_block' => true,
            ]
        );
        
        $this->add_control(
            'tp_text_list_list',
            [
            'label'       => esc_html__( 'Features List', 'tpcore' ),
            'type'        => \Elementor\Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'default'     => [
                [
                'tp_text_list_title'   => esc_html__( 'Neque sodales', 'tpcore' ),
                ],
                [
                'tp_text_list_title'   => esc_html__( 'Adipiscing elit', 'tpcore' ),
                ],
                [
                'tp_text_list_title'   => esc_html__( 'Mauris commodo', 'tpcore' ),
                ],
            ],
            'title_field' => '{{{ tp_text_list_title }}}',
            ]
        );
        $this->end_controls_section();

        // fact bg
        $this->start_controls_section(
        'tp_fact_bg',
            [
                'label' => esc_html__( 'BG Image', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-1',
                    'tp_design_style' => 'layout-2'
                ]
            ]
        );


        $this->add_control(
            'tp_bg_image',
            [
                'label' => esc_html__( 'Choose Bg Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ]
            ]
        );


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom']
            ]
        );
        
        $this->end_controls_section();

        
        // section column
        $this->tp_columns('col', ['layout-1', 'layout-2']);
        
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('fact_section', 'Section - Style', '.tp-el-section');
        # repeater
        $this->tp_icon_style('rep_icon', 'Repeater Icon', '.tp-el-rep-icon', ['layout-1', 'layout-2']);
        $this->tp_basic_style_controls('rep_num', 'Repeater Number', '.tp-el-rep-number', ['layout-1', 'layout-2']);
        $this->tp_basic_style_controls('rep_title', 'Repeater Title', '.tp-el-rep-title', ['layout-1', 'layout-2']);
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
        if ( !empty($settings['tp_bg_image']['url']) ) {
            $tp_bg_image = !empty($settings['tp_bg_image']['id']) ? wp_get_attachment_image_url( $settings['tp_bg_image']['id'], $settings['shape_image_size_size']) : $settings['tp_bg_image']['url'];
            $tp_bg_image_alt = get_post_meta($settings["tp_bg_image"]["id"], "_wp_attachment_image_alt", true);
        }
		?>

<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>
<!-- counter area start -->
<section class="tp-counter-area-2 p-relative pt-120 pb-90 tp-el-section tp-black-bg">
    <div class="tp-counter-bg-shape-2">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/counter/home-3/bg-shape.png" alt="">
    </div>
    <div class="container">
        <div class="row">
            <?php foreach ($settings['tp_fact_list'] as $key => $item) : ?>
            <div
                class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?> mb-30">
                <div class="tp-counter-item-2 text-center mb-30">
                    <div class="tp-counter-item-2-icon">
                        <span class="tp-el-rep-icon">
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

                    <?php if(!empty($item['tp_fact_number'])) : ?>
                    <h4 class="tp-counter-title-2 tp-el-rep-number">
                        <span class="purecounter" data-purecounter-duration="3" data-purecounter-end="<?php echo esc_attr($item['tp_fact_number' ]); ?>"></span><?php echo esc_attr($item['tp_fact_number_unit' ]); ?>
                    </h4>
                    <?php endif; ?>

                    <?php if(!empty($item['tp_fact_title'])) : ?>
                    <p class="tp-el-rep-title"><?php echo tp_kses($item['tp_fact_title']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- counter area end -->

<?php else: 
     if ( !empty($settings['tp_bg_image']['url']) ) {
        $tp_bg_image = !empty($settings['tp_bg_image']['id']) ? wp_get_attachment_image_url( $settings['tp_bg_image']['id'], $settings['shape_image_size_size']) : $settings['tp_bg_image']['url'];
        $tp_bg_image_alt = get_post_meta($settings["tp_bg_image"]["id"], "_wp_attachment_image_alt", true);
    }
?>
<section class="tp-counter-area tp-counter-overlay p-relative pt-70 pb-40 tp-el-section">
    <div class="container">
        <div class="tp-counter-bg"></div>
        <div class="tp-counter-shape">
            <img class="shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/counter/img-1.png" alt="">
            <img class="shape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/counter/img-2.png" alt="">
            <img class="shape-3" src="<?php echo get_template_directory_uri(); ?>/assets/img/counter/img-3.png" alt="">
            <img class="shape-4" src="<?php echo get_template_directory_uri(); ?>/assets/img/counter/img-4.png" alt="">
        </div>
        <div class="row justify-content-center">
            <?php foreach ($settings['tp_fact_list'] as $key => $item) :
                $arrCount = count($settings['tp_fact_list']) - 1 ;
                $border = $key == $arrCount ? '' : 'tp-counter-border';
            ?>
            <div class="col-lg-3">
                <div class="tp-counter-wrapper d-flex align-items-center justify-content-center mb-30">
                    <div class="tp-counter-icon">
                        <span class="tp-el-rep-icon">
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
                    <div class="tp-counter-content">
                        <h4 class="tp-counter-title tp-el-rep-number">
                            <span class="purecounter" data-purecounter-duration="3" data-purecounter-end="<?php echo esc_attr($item['tp_fact_number' ]); ?>"></span>+
                        </h4>
                        <?php if(!empty($item['tp_fact_title'])) : ?>
                        <p class="tp-el-rep-title"><?php echo tp_kses($item['tp_fact_title']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php endif; 
	}
}

$widgets_manager->register( new TP_Fact() );