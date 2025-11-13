<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
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
class TP_Services extends Widget_Base {

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
        return 'tp-services';
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
        return __( 'Services', 'tpcore' );
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
                    'layout-4' => esc_html__('Layout 4', 'tpcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // title/content
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', 'layout-1' );

        // Service group
        $this->start_controls_section(
            'tp_services',
            [
                'label' => esc_html__('Services List', 'tpcore'),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tp_service_icon_type',
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
            'tp_service_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tpcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_service_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_service_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_service_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_service_selected_icon',
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
                        'tp_service_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tp_service_icon_svg',
            [
                'show_label' => false,
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => esc_html__('SVG Code Here', 'tp-core'),
                'condition' => [
                    'tp_service_icon_type' => 'svg',
                ]
            ]
        );

        $repeater->add_control(
            'tp_service_number', [
                'label' => esc_html__('Number Field', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('a', 'tpcore'),
                'condition' => [
                    'repeater_condition' => 'style_2'
                ]
            ]
        );

        $repeater->add_control(
            'tp_service_title', [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tpcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tp_service_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('There are many variations of passages of Lorem Ipsum available, but the majority have suffered.', 'tpcore'),
                'label_block' => true,
                'condition' => [
                    'repeater_condition' => ['style_1', 'style_2', 'style_4', 'style_5']
                ]
            ]
        );

        $repeater->add_control(
            'tp_services_link_switcher',
            [
                'label' => esc_html__( 'Add Services link', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'tpcore' ),
                'label_off' => esc_html__( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tp_services_btn_text',
            [
                'label' => esc_html__('Button Text', 'tpcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tpcore'),
                'title' => esc_html__('Enter button text', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_services_link_type',
            [
                'label' => esc_html__( 'Service Link Type', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tp_services_link_switcher' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'tp_services_link',
            [
                'label' => esc_html__( 'Service Link link', 'tpcore' ),
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
                    'tp_services_link_type' => '1',
                    'tp_services_link_switcher' => 'yes',
                ]
            ]
        );

        $repeater->add_control(
            'tp_services_page_link',
            [
                'label' => esc_html__( 'Select Service Link Page', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_services_link_type' => '2',
                    'tp_services_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tp_image_thumb',
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
        $this->add_control(
            'tp_service_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_service_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_service_title' => esc_html__('Website Development', 'tpcore')
                    ],
                    [
                        'tp_service_title' => esc_html__('Marketing & Reporting', 'tpcore')
                    ]
                ],
                'title_field' => '{{{ tp_service_title }}}',
            ]
        );

        


        $this->end_controls_section();
        
        // button
        $this->tp_button_render('services', 'Button', ['layout-6']);
    

        // section column
        $this->tp_columns('col', ['layout-3', 'layout-4', 'layout-5']);

    }

    // style_tab_content
    protected function style_tab_content(){

        $this->tp_section_style_controls('services_section', 'Section Style', '.ele-section');
        $this->tp_basic_style_controls('section_sub_title', 'Section - Sub Title', '.tp-el-sub-title');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('section_des', 'Section - Description', '.tp-el-des');
        $this->tp_link_controls_style('section_btn', 'Section - Button', '.tp-el-btn');
        # repeater
        $this->tp_basic_style_controls('rep_title', 'Repeater Title', '.tp-el-rep-title', ['layout-1', 'layout-2', 'layout-3', 'layout-4']);
        $this->tp_basic_style_controls('rep_des', 'Repeater Description', '.tp-el-rep-des', ['layout-1', 'layout-2', 'layout-3', 'layout-4']);
        $this->tp_icon_style('rep_icon', 'Repeater Icon', '.tp-el-rep-icon', ['layout-1', 'layout-2', 'layout-4']);
        $this->tp_link_controls_style('rep_btn', 'Repeater Button', '.tp-el-rep-btn', 'layout-3');
        
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

    if ( !empty($settings['tp_image_thumb']['url']) ) {
        $tp_image_thumb = !empty($settings['tp_image_thumb']['id']) ? wp_get_attachment_image_url( $settings['tp_image_thumb']['id'], $settings['tp_image_size_size']) : $settings['tp_image_thumb']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image_thumb"]["id"], "_wp_attachment_image_alt", true);
    }     

    // Link
    if ('2' == $settings['tp_services_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_services_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
    } else {
        if ( ! empty( $settings['tp_services_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_services_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>

<!-- service area start -->
<section class="tp-service-area-2 ele-section">
    <div class="container">
        <div class="row">
            <?php foreach ($settings['tp_service_list'] as $key => $item) :
            // Link
            if ( !empty($item['tp_image_thumb']['url']) ) {
            $tp_image_thumb = !empty($item['tp_image_thumb']['id']) ? wp_get_attachment_image_url( $item['tp_image_thumb']['id'], $settings['tp_image_size_size']) : $item['tp_image_thumb']['url'];
            $tp_image_alt = get_post_meta($item["tp_image_thumb"]["id"], "_wp_attachment_image_alt", true);
        } 

            // Link
            if ('2' == $item['tp_services_link_type']) {
                $link = get_permalink($item['tp_services_page_link']);
                $target = '_self';
                $rel = 'nofollow';
            } else {
                $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
            }
        ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <div class="tp-service-item-2 p-relative wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <?php if(!empty($tp_image_thumb)) : ?>
                    <div class="tp-service-thumb-2 text-center">
                        <img src="<?php echo esc_url($tp_image_thumb); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
                    </div>
                    <?php endif; ?>
                    <div class="tp-service-icon-2">
                        <span>
                            <?php if($item['tp_service_icon_type'] == 'icon') : ?>
                            <?php if (!empty($item['tp_service_icon']) || !empty($item['tp_service_selected_icon']['value'])) : ?>
                            <span class="tp-el-rep-icon">
                                <?php tp_render_icon($item, 'tp_service_icon', 'tp_service_selected_icon'); ?>
                            </span>
                            <?php endif; ?>
                            <?php elseif( $item['tp_service_icon_type'] == 'image' ) : ?>
                            <?php if (!empty($item['tp_service_image']['url'])): ?>
                            <span class="tp-el-rep-icon">
                                <img src="<?php echo $item['tp_service_image']['url']; ?>"
                                    alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            </span>
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if (!empty($item['tp_service_icon_svg'])): ?>
                            <span class="tp-el-rep-icon">
                                <?php echo $item['tp_service_icon_svg']; ?>
                            </span>
                            <?php endif; ?>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="tp-service-content-2">
                        <?php if (!empty($item['tp_service_description' ])): ?>
                        <p class="tp-el-rep-des"><?php echo tp_kses($item['tp_service_description']); ?></p>
                        <?php endif; ?>
                        <h4 class="tp-service-title-2 tp-el-rep-title">
                            <?php if ($item['tp_services_link_switcher'] == 'yes') : ?> <a
                                href="<?php echo esc_url($link); ?>">
                                <?php echo tp_kses($item['tp_service_title' ]); ?></a>
                            <?php else : ?>
                            <?php echo tp_kses($item['tp_service_title' ]); ?>
                            <?php endif; ?>
                        </h4>
                    </div>
                    <div class="tp-service-btn-2">
                        <a href="https://wphix.com/wp/finbest/service-details/"><i
                                class="fa-regular fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- service area end -->

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ):
    if ( !empty($settings['tp_image_thumb']['url']) ) {
        $tp_image_thumb = !empty($settings['tp_image_thumb']['id']) ? wp_get_attachment_image_url( $settings['tp_image_thumb']['id'], $settings['tp_image_size_size']) : $settings['tp_image_thumb']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image_thumb"]["id"], "_wp_attachment_image_alt", true);
    }     
    // Link
    if ('2' == $settings['tp_services_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_services_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
    } else {
        if ( ! empty( $settings['tp_services_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_services_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>

<!-- service area start -->
<section class="tp-service-area-3 ele-section">
    <div class="container">
        <div class="row">
            <?php foreach ($settings['tp_service_list'] as $key => $item) :
                        // Link
                        if ('2' == $item['tp_services_link_type']) {
                            $link = get_permalink($item['tp_services_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                            $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                        }
                    ?>
            <div class="col-lg-4 col-md-6">
                <div class="tp-service-item-wrapper-3 p-relative mb-30 wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay=".3s">
                    <div class="tp-service-item-content-3">
                        <div class="tp-service-item-icon-3">
                            <?php if($item['tp_service_icon_type'] == 'icon') : ?>
                            <?php if (!empty($item['tp_service_icon']) || !empty($item['tp_service_selected_icon']['value'])) : ?>
                            <span>
                                <?php tp_render_icon($item, 'tp_service_icon', 'tp_service_selected_icon'); ?>
                            </span>
                            <?php endif; ?>
                            <?php elseif( $item['tp_service_icon_type'] == 'image' ) : ?>
                            <?php if (!empty($item['tp_service_image']['url'])): ?>
                            <span>
                                <img src="<?php echo $item['tp_service_image']['url']; ?>"
                                    alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                            </span>
                            <?php endif; ?>
                            <?php else : ?>
                            <?php if (!empty($item['tp_service_icon_svg'])): ?>
                            <span>
                                <?php echo $item['tp_service_icon_svg']; ?>
                            </span>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <h4 class="tp-service-item-title-3 el-rep-title">
                            <?php if ($item['tp_services_link_switcher'] == 'yes') : ?> <a
                                href="<?php echo esc_url($link); ?>">
                                <?php echo tp_kses($item['tp_service_title' ]); ?></a>
                            <?php else : ?>
                            <?php echo tp_kses($item['tp_service_title' ]); ?>
                            <?php endif; ?>
                        </h4>
                        <?php if (!empty($item['tp_service_description' ])): ?>
                        <p class="tp-el-rep-des"><?php echo tp_kses($item['tp_service_description']); ?></p>
                        <?php endif; ?>

                    </div>

                    <?php if ( !empty($item['tp_services_btn_text']) ) : ?>
                    <div class="tp-service-item-btn-3">
                        <a class="tp-el-rep-btn" href="<?php echo esc_url($link); ?>" <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                            <?php echo tp_kses($item['tp_services_btn_text']); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                    <div class="tp-service-item-number">
                        <span>0<?php echo ( $key+1); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- service area end -->

<?php elseif ( $settings['tp_design_style']  == 'layout-4' ):
    if ( !empty($settings['tp_image_thumb']['url']) ) {
        $tp_image_thumb = !empty($settings['tp_image_thumb']['id']) ? wp_get_attachment_image_url( $settings['tp_image_thumb']['id'], $settings['tp_image_size_size']) : $settings['tp_image_thumb']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image_thumb"]["id"], "_wp_attachment_image_alt", true);
    }     
    // Link
    if ('2' == $settings['tp_services_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_services_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
    } else {
        if ( ! empty( $settings['tp_services_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_services_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', 'tp-btn');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title');
?>

<!-- service area start -->
<section class="tp-service-breadcrumb-area pt-90 pb-40 ele-section">
    <div class="container">
        <div class="row">
        <?php foreach ($settings['tp_service_list'] as $key => $item) :
                // Link
                if ( !empty($item['tp_image_thumb']['url']) ) {
                    $tp_image_thumb = !empty($item['tp_image_thumb']['id']) ? wp_get_attachment_image_url( $item['tp_image_thumb']['id'], $settings['tp_image_size_size']) : $item['tp_image_thumb']['url'];
                    $tp_image_alt = get_post_meta($item["tp_image_thumb"]["id"], "_wp_attachment_image_alt", true);
                } 

                if ('2' == $item['tp_services_link_type']) {
                    $link = get_permalink($item['tp_services_page_link']);
                    $target = '_self';
                    $rel = 'nofollow';
                } else {
                    $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                    $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                    $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                }
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="tp-service-item-wrapper p-relative mb-80 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInUp;">
                <div class="tp-service-item-icon">
                <?php if($item['tp_service_icon_type'] == 'icon') : ?>
                        <?php if (!empty($item['tp_service_icon']) || !empty($item['tp_service_selected_icon']['value'])) : ?>
                        <span class="tp-el-rep-icon">
                            <?php tp_render_icon($item, 'tp_service_icon', 'tp_service_selected_icon'); ?>
                        </span>
                        <?php endif; ?>
                        <?php elseif( $item['tp_service_icon_type'] == 'image' ) : ?>
                        <?php if (!empty($item['tp_service_image']['url'])): ?>
                        <span class="tp-el-rep-icon">
                            <img src="<?php echo $item['tp_service_image']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        </span>
                        <?php endif; ?>
                        <?php else : ?>
                        <?php if (!empty($item['tp_service_icon_svg'])): ?>
                        <span class="tp-el-rep-icon">
                            <?php echo $item['tp_service_icon_svg']; ?>
                        </span>
                        <?php endif; ?>
                        <?php endif; ?>
                </div>
                <div class="tp-service-item-content">
                        <h4 class="tp-service-item-title tp-el-rep-title">
                            <?php if ($item['tp_services_link_switcher'] == 'yes') : ?> <a
                                href="<?php echo esc_url($link); ?>">
                                <?php echo tp_kses($item['tp_service_title' ]); ?></a>
                            <?php else : ?>
                            <?php echo tp_kses($item['tp_service_title' ]); ?>
                            <?php endif; ?>
                        </h4>
                        <?php if (!empty($item['tp_service_description' ])): ?>
                        <p class="tp-el-rep-des"><?php echo tp_kses($item['tp_service_description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="tp-service-item-thumb">
                        <?php if(!empty($tp_image_thumb)) : ?>
                        <div class="tp-about-wrapper-thumb text-center text-xl-start fadeLeft">
                            <img src="<?php echo esc_url($tp_image_thumb); ?>"
                                alt="<?php echo esc_attr($tp_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- service area end -->

<?php else:
    // Link
    if ('2' == $settings['tp_services_btn_link_type']) {
        $this->add_render_attribute('tp-button-arg', 'href', get_permalink($settings['tp_services_btn_page_link']));
        $this->add_render_attribute('tp-button-arg', 'target', '_self');
        $this->add_render_attribute('tp-button-arg', 'rel', 'nofollow');
        $this->add_render_attribute('tp-button-arg', 'class', '');
    } else {
        if ( ! empty( $settings['tp_services_btn_link']['url'] ) ) {
            $this->add_link_attributes( 'tp-button-arg', $settings['tp_services_btn_link'] );
            $this->add_render_attribute('tp-button-arg', 'class', '');
        }
    }

    $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title');
?>
<!-- service area start -->


 <div class="tp-service-3-area grey-bg p-relative fix pt-120 pb-90 ele-section">
         <div class="tp-service-3-shape-1 d-none d-xl-block">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/shape-3-1.png" alt="">
         </div>
         <div class="tp-service-3-shape-2 d-none d-xl-block">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/shape-3-3.png" alt="">
         </div>
         <div class="container">
            <div class="row">
               
                <?php foreach ($settings['tp_service_list'] as $key => $item) :
                        // Link
                        if ( !empty($item['tp_image_thumb']['url']) ) {
                            $tp_image_thumb = !empty($item['tp_image_thumb']['id']) ? wp_get_attachment_image_url( $item['tp_image_thumb']['id'], $settings['tp_image_size_size']) : $item['tp_image_thumb']['url'];
                            $tp_image_alt = get_post_meta($item["tp_image_thumb"]["id"], "_wp_attachment_image_alt", true);
                        } 

                        if ('2' == $item['tp_services_link_type']) {
                            $link = get_permalink($item['tp_services_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($item['tp_services_link']['url']) ? $item['tp_services_link']['url'] : '';
                            $target = !empty($item['tp_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($item['tp_services_link']['nofollow']) ? 'nofollow' : '';
                        }
                    ?>
                    <?php $active = $key == 1? 'active':''; ?>
               <div class="col-xl-4 col-lg-4 col-md-6 mb-30  wow tpfadeUp" data-wow-duration=".9s" data-wow-delay=".5s">
                  <div class="tp-service-3-item <?php echo esc_attr($active); ?> fix"  style="background-image: url('<?php 
                            if ( !empty($item['tp_image_thumb']['url']) ) {
                                $tp_image_thumb = !empty($item['tp_image_thumb']['id']) 
                                    ? wp_get_attachment_image_url( $item['tp_image_thumb']['id'], $settings['tp_image_size_size'] ) 
                                    : $item['tp_image_thumb']['url'];
                                echo esc_url( $tp_image_thumb );
                            } 
                            ?>');">
                     <div class="tp-service-3-shape-3">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/service/shape-3-2.png" alt="">
                     </div>
                     <div class="tp-service-3-content z-index">
                        <div class="tp-service-3-icon pb-40">
                             <?php if($item['tp_service_icon_type'] == 'icon') : ?>
                        <?php if (!empty($item['tp_service_icon']) || !empty($item['tp_service_selected_icon']['value'])) : ?>
                        <span class="tp-el-rep-icon">
                            <?php tp_render_icon($item, 'tp_service_icon', 'tp_service_selected_icon'); ?>
                        </span>
                        <?php endif; ?>
                        <?php elseif( $item['tp_service_icon_type'] == 'image' ) : ?>
                        <?php if (!empty($item['tp_service_image']['url'])): ?>
                        <span class="tp-el-rep-icon">
                            <img src="<?php echo $item['tp_service_image']['url']; ?>"
                                alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                        </span>
                        <?php endif; ?>
                        <?php else : ?>
                        <?php if (!empty($item['tp_service_icon_svg'])): ?>
                        <span class="tp-el-rep-icon">
                            <?php echo $item['tp_service_icon_svg']; ?>
                        </span>
                        <?php endif; ?>
                        <?php endif; ?>
                          
                        </div>
                        <div class="tp-service-3-text pb-30">
                            <h4 class="tp-service-3-title pb-15 tp-el-rep-title">
                                    <?php if ($item['tp_services_link_switcher'] == 'yes') : ?> <a
                                        href="<?php echo esc_url($link); ?>">
                                        <?php echo tp_kses($item['tp_service_title' ]); ?></a>
                                    <?php else : ?>
                                    <?php echo tp_kses($item['tp_service_title' ]); ?>
                                    <?php endif; ?>
                                </h4>
                          
                           <p class='class="tp-el-rep-des"'><?php echo tp_kses($item['tp_service_description']); ?></p>
                        </div>

                      

                    <?php if ( !empty($item['tp_services_btn_text']) ) : ?>
                     <a class="tp-el-rep-btn" href="<?php echo esc_url($link); ?>" <?php echo $this->get_render_attribute_string( 'tp-button-arg' ); ?>>
                           <div class="tp-service-3-link d-flex justify-content-between">
                              <?php echo tp_kses($item['tp_services_btn_text']); ?>
                              <i class="flaticon-right-arrow"></i>
                           </div>
                        </a>
                        <?php endif; ?>

                      
                     </div>
                  </div>
               </div>
               <?php endforeach; ?>
              
            </div>
         </div>
      </div>



<!-- service area end -->


<?php endif; 
    }
}

$widgets_manager->register( new TP_Services() ); 