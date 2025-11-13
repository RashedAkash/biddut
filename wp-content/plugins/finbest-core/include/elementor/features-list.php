<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_features extends Widget_Base {

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
		return 'tp-features-list';
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
		return __( 'features-list', 'tpcore' );
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
                    'layout-3' => esc_html__('Layout 3', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();
        // title/content
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', 'layout-3' );
        // features group
        $this->start_controls_section(
            'tp_features',
            [
                'label' => esc_html__('features List', 'tpcore'),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );
        
        

        $repeater->add_control(
            'tp_features_icon_type',
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
            'tp_features_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_features_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_features_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_features_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_features_selected_icon',
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
                        'tp_features_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_features_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tp-core'),
                'condition' => [
                    'tp_features_icon_type' => 'svg',
                ]
            ]
        );

        $repeater->add_control(
            'tp_features_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('features Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_features_des', [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('onec suscipit ante ipsum. Donec quam at tortor hendrerit', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => 'style_1',
                ]
            ]
        );

        $this->add_control(
            'tp_features_list',
            [
                'label' => esc_html__('featuress - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_features_title' => esc_html__('Discover', 'tpcore'),
                    ],
                    [
                        'tp_features_title' => esc_html__('Define', 'tpcore')
                    ],
                    [
                        'tp_features_title' => esc_html__('Develop', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_features_title }}}',
            ]
        );

        $this->add_control(
            'tp_bottom_text', [
                'label' => esc_html__('Bottom Text', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('BRING THEM TOGETHER AND YOU OVERCOME THE ORDINARY.', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'tp_design_style' => 'layout-1'
                ]
            ]
        );

        $this->end_controls_section();

        // features shape
        $this->start_controls_section(
        'tp_features_shape',
            [
                'label' => esc_html__( 'Thumb Image', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => 'layout-3'
                ]
            ]
        );



        $this->add_control(
            'tp_thumb_image_1',
            [
                'label' => esc_html__( 'Thumb Image 1', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tp_thumb_image_2',
            [
                'label' => esc_html__( 'Thumb Image 2', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'shape_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'default' => 'full'
            ]
        );
        
        $this->end_controls_section();

        // Backround
        $this->start_controls_section(
        'tp_features_bg',
            [
                'label' => esc_html__( 'features Background', 'tpcore' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tp_design_style' => ['layout-2']
                ]
            ]
        );

        $this->add_control(
        'tp_features_bg_switch',
        [
            'label'        => esc_html__( 'Background On/Off', 'tpcore' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'tpcore' ),
            'label_off'    => esc_html__( 'Hide', 'tpcore' ),
            'return_value' => 'yes',
            'default'      => '1',
        ]
        );

        $this->add_control(
            'tp_bg_image_1',
            [
                'label' => esc_html__( 'Choose Background', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_features_bg_switch' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'bg_image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'condition' => [
                    'tp_features_bg_switch' => 'yes'
                ],
                'default' => 'full'
            ]
        );
        
        $this->end_controls_section();
                // counter
                $this->start_controls_section(
                    'tp_counter_bg',
                        [
                            'label' => esc_html__( 'features counter', 'tpcore' ),
                            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                            'condition' => [
                                'tp_design_style' => ['layout-3']
                            ]
                        ]
                    );
                $this->add_control(
                    'tp_counter_fact_number', [
                        'label' => esc_html__('Number', 'tpcore'),
                        'description' => tp_get_allowed_html_desc( 'basic' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('17', 'tpcore'),
                        'label_block' => true,
                    ]
                );
                $this->add_control(
                    'tp_counter_fact_title',
                    [
                        'label' => esc_html__('Title', 'tpcore'),
                        'description' => tp_get_allowed_html_desc( 'intermediate' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Food', 'tpcore'),
                        'label_block' => true,
                    ]
                );
                $this->add_control(
                    'tp_counter_fact_number_2', [
                        'label' => esc_html__('Number 2', 'tpcore'),
                        'description' => tp_get_allowed_html_desc( 'basic' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('17', 'tpcore'),
                        'label_block' => true,
                    ]
                );
                $this->add_control(
                    'tp_counter_fact_title_2',
                    [
                        'label' => esc_html__('Title 2', 'tpcore'),
                        'description' => tp_get_allowed_html_desc( 'intermediate' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__('Food', 'tpcore'),
                        'label_block' => true,
                    ]
                );
      
                $this->end_controls_section();

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('features_section', 'Section - Style', '.tp-el-section'); 
        $this->tp_basic_style_controls('section_sub_title', 'Section - Sub Title', '.tp-el-sub-title', 'layout-3');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title', 'layout-3');
        $this->tp_basic_style_controls('section_des', 'Section - Description', '.tp-el-des', 'layout-3');
        # repeate
        $this->tp_basic_style_controls('rep_title', 'Repeater Title', '.tp-el-rep-title', ['layout-1', 'layout-2', 'layout-3']);
        $this->tp_basic_style_controls('rep_des', 'Repeater Description', '.tp-el-rep-des', ['layout-1', 'layout-2', 'layout-3']);
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

    if ( !empty($settings['tp_bg_image_1']['url']) ) {
        $tp_bg_image = !empty($settings['tp_bg_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_bg_image_1']['id'], $settings['bg_image_size_size']) : $settings['tp_bg_image_1']['url'];
        $tp_bg_image_alt = get_post_meta($settings["tp_bg_image_1"]["id"], "_wp_attachment_image_alt", true);
    }

?>
<section class="tp-features-area-3 tp-el-section">
    <div class="container">
        <div class="row">
            <?php foreach ($settings['tp_features_list'] as $key => $item) : ?>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="tp-features-item-3 text-center mb-30 wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay=".3s">
                    <div class="tp-features-item-3-icon">
                        <span>
                            <?php if($item['tp_features_icon_type'] == 'icon') : ?>
                            <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                            <?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?>
                            <?php endif; ?>
                            <?php elseif( $item['tp_features_icon_type'] == 'image' ) : ?>
                            <?php if (!empty($item['tp_features_image']['url'])): ?>
                            <img src="<?php echo $item['tp_features_image']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if (!empty($item['tp_features_icon_svg'])): ?>
                            <?php echo $item['tp_features_icon_svg']; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        </span>
                    </div>
                    <?php if (!empty($item['tp_features_title'])): ?>
                    <h4 class="tp-features-title-3 tp-el-rep-title"><?php echo tp_kses($item['tp_features_title' ]); ?></h4>
                    <?php endif; ?>
                    <?php if (!empty($item['tp_features_des'])): ?>
                    <p class="tp-el-rep-des"><?php echo tp_kses($item['tp_features_des' ]); ?></p>
                    <?php endif; ?>
                    <b>0<?php echo ( $key+1); ?></b>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ) :
 
    if ( !empty($settings['tp_thumb_image_1']['url']) ) {
        $tp_thumb_image_1 = !empty($settings['tp_thumb_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_thumb_image_1']['id'], $settings['bg_image_size_size']) : $settings['tp_thumb_image_1']['url'];
        $tp_bg_image_alt = get_post_meta($settings["tp_thumb_image_1"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_thumb_image_2']['url']) ) {
        $tp_thumb_image_2 = !empty($settings['tp_thumb_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_thumb_image_2']['id'], $settings['bg_image_size_size']) : $settings['tp_thumb_image_2']['url'];
        $tp_bg_image_alt_2 = get_post_meta($settings["tp_thumb_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title');
?>

<!-- features area start -->
<section class="tp-features-arae pt-120 pb-50 tp-el-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="tp-features-wrapper">
                    <div class="tp-features-title mb-70">
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
                    </div>
                    <?php foreach ($settings['tp_features_list'] as $key => $item) : ?>

                    <div class="tp-features-item d-flex align-items-center">
                        <div class="tp-features-item-icon">
                            <span>
                                <?php if($item['tp_features_icon_type'] == 'icon') : ?>
                                <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                                <?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?>
                                <?php endif; ?>
                                <?php elseif( $item['tp_features_icon_type'] == 'image' ) : ?>
                                <?php if (!empty($item['tp_features_image']['url'])): ?>
                                <img src="<?php echo $item['tp_features_image']['url']; ?>"
                                    alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                <?php endif; ?>
                                <?php else : ?>
                                <?php if (!empty($item['tp_features_icon_svg'])): ?>
                                <?php echo $item['tp_features_icon_svg']; ?>
                                <?php endif; ?>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div class="tp-features-item-content">
                            <?php if (!empty($item['tp_features_title'])): ?>
                            <h4 class="tp-features-item-title tp-el-rep-title"><?php echo tp_kses($item['tp_features_title' ]); ?></h4>
                            <?php endif; ?>
                            <?php if (!empty($item['tp_features_des'])): ?>
                            <p class="tp-el-rep-des"><?php echo tp_kses($item['tp_features_des' ]); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="tp-features-thumb-wrapper p-relative wow fadeInRight" data-wow-duration="1s"
                    data-wow-delay=".3s">
                    <div class="tp-features-thumb p-relative">
                        <?php if(!empty($tp_thumb_image_1)) : ?>
                        <div class="main">
                            <img src="<?php echo esc_url($tp_thumb_image_1); ?>"
                                alt="<?php echo esc_attr($tp_bg_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($tp_thumb_image_2)) : ?>
                        <div class="shape-1">
                            <img src="<?php echo esc_url($tp_thumb_image_2); ?>"
                                alt="<?php echo esc_attr($tp_bg_image_alt_2); ?>">
                        </div>
                        <?php endif; ?>

                    </div>
                    <div class="tp-features-counter d-flex align-items-center">
                        <div class="tp-features-counter-icon">
                            <span>
                                <i class="flaticon-030-machine-repair"></i>
                            </span>
                        </div>
                        <div class="tp-features-content">
                            <h4 class="tp-features-counter-title"><span class="purecounter" data-purecounter-duration="3"
                                    data-purecounter-end="<?php echo tp_kses($settings['tp_counter_fact_number']); ?>"></span>k+</h4>
                            <?php if ( !empty($settings['tp_counter_fact_title']) ) : ?>
                            <p><?php echo tp_kses($settings['tp_counter_fact_title']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="tp-features-trusted text-center">
                        <p><?php echo tp_kses($settings['tp_counter_fact_title_2']); ?><br> <span class="purecounter" data-purecounter-duration="10"
                                    data-purecounter-end="<?php echo tp_kses($settings['tp_counter_fact_number']); ?>"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>
<!-- features area end -->

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

     if ( !empty($settings['tp_bg_image_1']['url']) ) {
        $tp_bg_image = !empty($settings['tp_bg_image_1']['id']) ? wp_get_attachment_image_url( $settings['tp_bg_image_1']['id'], $settings['bg_image_size_size']) : $settings['tp_bg_image_1']['url'];
        $tp_bg_image_alt = get_post_meta($settings["tp_bg_image_1"]["id"], "_wp_attachment_image_alt", true);
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title'); 
?>

<!-- features area start -->
 <div id="feature-box" class="tp-feature-2-area  p-relative grey-bg">
         <div class="tp-feature-2-bg pt-120 pb-90" data-background="assets/img/feature/bg-1.png">
            <div class="container">
               <div class="row">
                 <?php foreach ($settings['tp_features_list'] as $key => $item) : ?>
                    <?php $active = $key == 1? 'active':''; ?>
                  <div class="col-xl-3 col-lg-4 col-md-6 mb-30 wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".7s">
                     <div class="tp-feature-2-item <?php echo esc_attr($active); ?>">
                        <div class="tp-feature-2-icon">
                             <?php if($item['tp_features_icon_type'] == 'icon') : ?>
                                <?php if (!empty($item['tp_features_icon']) || !empty($item['tp_features_selected_icon']['value'])) : ?>
                                <?php tp_render_icon($item, 'tp_features_icon', 'tp_features_selected_icon'); ?>
                                <?php endif; ?>
                                <?php elseif( $item['tp_features_icon_type'] == 'image' ) : ?>
                                <?php if (!empty($item['tp_features_image']['url'])): ?>
                                <img src="<?php echo $item['tp_features_image']['url']; ?>"
                                    alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                <?php endif; ?>
                                <?php else : ?>
                                <?php if (!empty($item['tp_features_icon_svg'])): ?>
                                <?php echo $item['tp_features_icon_svg']; ?>
                                <?php endif; ?>
                                <?php endif; ?>
                           
                        </div>
                        <div class="tp-feature-2-text">
                            <?php if (!empty($item['tp_features_title'])): ?>
                            <h4 class="tp-feature-2-title"><?php echo tp_kses($item['tp_features_title' ]); ?></h4>
                            <?php endif; ?>
                            <?php if (!empty($item['tp_features_des'])): ?>
                            <p class="tp-el-rep-des"><?php echo tp_kses($item['tp_features_des' ]); ?></p>
                            <?php endif; ?>
                           
                        </div>
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </div>
      </div>



<!-- features area end -->
<?php endif;
	}
}

$widgets_manager->register( new TP_features() );