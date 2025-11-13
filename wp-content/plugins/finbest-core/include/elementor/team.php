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
class TP_Team extends Widget_Base {

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
        return 'tp-team';
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
        return __( 'Team', 'tpcore' );
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

        // member list
        $this->start_controls_section(
            '_section_teams',
            [
                'label' => __( 'Members', 'tpcore' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

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

        $repeater->start_controls_tabs(
            '_tab_style_member_box_itemr'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Information', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'tpcore' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                      

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'tpcore' ),
                'default' => __( 'TP Member Name', 'tpcore' ),
                'placeholder' => __( 'Type title here', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Job Title', 'tpcore' ),
                'default' => __( 'TP Officer', 'tpcore' ),
                'placeholder' => __( 'Type designation here', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );  

        $repeater->add_control(
            'item_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __( 'Type link here', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'tpcore' ),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __( 'Show Social Links?', 'tpcore' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'tpcore' ),
                'label_off' => __( 'No', 'tpcore' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'tpcore' ),
                'placeholder' => __( 'Add your profile link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Email', 'tpcore' ),
                'placeholder' => __( 'Add your email link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );           

        $repeater->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Phone', 'tpcore' ),
                'placeholder' => __( 'Add your phone link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your facebook link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                

        $repeater->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your twitter link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'tpcore' ),
                'default' => __( '#', 'tpcore' ),
                'placeholder' => __( 'Add your instagram link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );       

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'LinkedIn', 'tpcore' ),
                'placeholder' => __( 'Add your linkedin link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Youtube', 'tpcore' ),
                'placeholder' => __( 'Add your youtube link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Google Plus', 'tpcore' ),
                'placeholder' => __( 'Add your Google Plus link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Flickr', 'tpcore' ),
                'placeholder' => __( 'Add your flickr link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Vimeo', 'tpcore' ),
                'placeholder' => __( 'Add your vimeo link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Behance', 'tpcore' ),
                'placeholder' => __( 'Add your hehance link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Dribbble', 'tpcore' ),
                'placeholder' => __( 'Add your dribbble link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'tpcore' ),
                'placeholder' => __( 'Add your pinterest link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Github', 'tpcore' ),
                'placeholder' => __( 'Add your github link', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // REPEATER
        $this->add_control(
            'teams',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'tpcore' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'tpcore' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'tpcore' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'tpcore' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'tpcore' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'tpcore' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'tpcore' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'tpcore' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'tpcore' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'tpcore' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .single-carousel-item' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        // colum controls
        $this->tp_columns('col',['layout-1', 'layout-2', 'layout-3']);

    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('team_section', 'Section - Style', '.tp-el-section');
        # repeater
        $this->tp_basic_style_controls('rep_name', 'Repeater Name', '.tp-el-rep-name' , ['layout-1', 'layout-2', 'layout-3']);
        $this->tp_basic_style_controls('rep_designation', 'Repeater Designation', '.tp-el-rep-designation' , ['layout-1', 'layout-2', 'layout-3']);
        $this->tp_link_controls_style('rep_social', 'Repeater Social Icon', '.tp-el-rep-social a', ['layout-1', 'layout-2', 'layout-3']);
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

<!-- style 2 -->
<?php if ( $settings['tp_design_style'] === 'layout-2' ) :
    $this->add_render_attribute('title_args', 'class', 'tp-section-title');   
?>
<section class="tp-team-area-2 p-relative tp-el-section">
    <div class="container">
        <div class="row">
            <?php foreach ( $settings['teams'] as $key => $item ) :
                $title = tp_kses( $item['title' ] );
                $item_url = esc_url($item['item_url']);
                $key = $key+1;
                if ( !empty($item['image']['url']) ) {
                    $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                    $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                }     
                $this->add_render_attribute( 'title_team', 'class', 'tp-team-info-title tp-el-rep-name' );       
            ?>
            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                <div class="tp-team-item-2 p-relative wow fadeInUp mb-30" data-wow-duration="1s" data-wow-delay=".3s">
                    <?php if(!empty($tp_team_image_url)) : ?>
                    <div class="tp-team-item-thumb-2">
                        <img src="<?php echo esc_url($tp_team_image_url); ?>"
                            alt="<?php echo esc_attr($tp_team_image_alt); ?>">
                            <img class="shape" src="<?php echo get_template_directory_uri(); ?>/assets/img/team/home-2/polygon.png" alt="">
                    </div>
                    <?php endif; ?>
                    <div class="tp-team-info-2 text-center">
                        <?php if( !empty($item['show_social'] ) ) : ?>
                        <div class="tp-team-social-2 tp-el-rep-social">
                            <?php if( !empty($item['web_title'] ) ) : ?>
                            <a class="icon-1" href="<?php echo esc_url( $item['web_title'] ); ?>"><i
                                    class="fas fa-globe"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['phone_title'] ) ) : ?>
                            <a class="icon-2" href="<?php echo esc_url( $item['phone_title'] ); ?>"><i
                                    class="fas fa-phone"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['facebook_title'] ) ) : ?>
                            <a class="icon-3" href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i
                                    class="fab fa-facebook-f"></i></a>
                            <?php endif; ?>
                            <?php  if( !empty($item['twitter_title'] ) ) : ?>
                            <a class="icon-4" href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i
                                    class="fab fa-twitter"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['linkedin_title'] ) ) : ?>
                            <a class="icon-5" href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i
                                    class="fab fa-linkedin"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['instagram_title'] ) ) : ?>
                            <a class="icon-6" href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i
                                    class="fa-brands fa-instagram"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['youtube_title'] ) ) : ?>
                            <a class="icon-7" href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i
                                    class="fab fa-youtube"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['googleplus_title'] ) ) : ?>
                            <a class="icon-8" href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i
                                    class="fab fa-google-plus-g"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['flickr_title'] ) ) : ?>
                            <a class="icon-9" href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i
                                    class="fab fa-flickr"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['vimeo_title'] ) ) : ?>
                            <a class="icon-10" href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i
                                    class="fab fa-vimeo-v"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['behance_title'] ) ) : ?>
                            <a class="icon-11" href="<?php echo esc_url( $item['behance_title'] ); ?>"><i
                                    class="fab fa-behance"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['dribble_title'] ) ) : ?>
                            <a class="icon-12" href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i
                                    class="fab fa-dribbble"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['pinterest_title'] ) ) : ?>
                            <a class="icon-13" href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i
                                    class="fab fa-pinterest-p"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['gitub_title'] ) ) : ?>
                            <a class="icon-14" href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i
                                    class="fab fa-github"></i></a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                            tag_escape( $settings['title_tag'] ),
                            $this->get_render_attribute_string( 'title_team' ),
                            $title,
                            $item_url
                        ); ?>

                        <?php if( !empty($item['designation']) ) : ?>
                        <p class="tp-el-rep-designation"><?php echo tp_kses( $item['designation'] ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- style 3 -->
<?php elseif ( $settings['tp_design_style'] === 'layout-3' ) :
      $this->add_render_attribute('title_args', 'class', 'tp-section-title');   
?>



<section class="tp-team-area-3 p-relative tp-team-bg-3 tp-el-section">
    <div class="container">
            <div class="row">
                <?php foreach ( $settings['teams'] as $key => $item ) :
                    $title = tp_kses( $item['title' ] );
                    $item_url = esc_url($item['item_url']);
                    $key = $key+1;
                    if ( !empty($item['image']['url']) ) {
                        $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                        $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                    }     
                    $this->add_render_attribute( 'title_team', 'class', 'tp-team-info-title  tp-el-rep-name' );       
                ?>
                <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?>">
                    <div class="tp-team-item-3 p-relative mb-30 wow fadeInUp" data-wow-duration="1s"
                        data-wow-delay=".3s">
                        <?php if(!empty($tp_team_image_url)) : ?>
                        <div class="tp-team-item-thumb">
                            <img src="<?php echo esc_url($tp_team_image_url); ?>" alt="<?php echo esc_attr($tp_team_image_alt); ?>">
                        </div>
                        <?php endif; ?>
                        <div class="tp-team-info-2 text-center">
                            <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title_team' ),
                                $title,
                                $item_url
                            ); ?>
                            <?php if( !empty($item['designation']) ) : ?>
                            <p class="tp-el-rep-designation"><?php echo tp_kses( $item['designation'] ); ?></p>
                            <?php endif; ?>
                        </div>

                        <?php if( !empty($item['show_social'] ) ) : ?>
                        <div class="tp-team-social-3 tp-el-rep-social">
                            <?php if( !empty($item['web_title'] ) ) : ?>
                            <a class="icon-1" href="<?php echo esc_url( $item['web_title'] ); ?>"><i
                                    class="fas fa-globe"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['phone_title'] ) ) : ?>
                            <a class="icon-2" href="<?php echo esc_url( $item['phone_title'] ); ?>"><i
                                    class="fas fa-phone"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['facebook_title'] ) ) : ?>
                            <a class="icon-3" href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i
                                    class="fab fa-facebook-f"></i></a>
                            <?php endif; ?>
                            <?php  if( !empty($item['twitter_title'] ) ) : ?>
                            <a class="icon-4" href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i
                                    class="fab fa-twitter"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['linkedin_title'] ) ) : ?>
                            <a class="icon-5" href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i
                                    class="fab fa-linkedin"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['instagram_title'] ) ) : ?>
                            <a class="icon-6" href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i
                                    class="fa-brands fa-instagram"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['youtube_title'] ) ) : ?>
                            <a class="icon-7" href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i
                                    class="fab fa-youtube"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['googleplus_title'] ) ) : ?>
                            <a class="icon-8" href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i
                                    class="fab fa-google-plus-g"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['flickr_title'] ) ) : ?>
                            <a class="icon-9" href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i
                                    class="fab fa-flickr"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['vimeo_title'] ) ) : ?>
                            <a class="icon-10" href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i
                                    class="fab fa-vimeo-v"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['behance_title'] ) ) : ?>
                            <a class="icon-11" href="<?php echo esc_url( $item['behance_title'] ); ?>"><i
                                    class="fab fa-behance"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['dribble_title'] ) ) : ?>
                            <a class="icon-12" href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i
                                    class="fab fa-dribbble"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['pinterest_title'] ) ) : ?>
                            <a class="icon-13" href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i
                                    class="fab fa-pinterest-p"></i></a>
                            <?php endif; ?>
                            <?php if( !empty($item['gitub_title'] ) ) : ?>
                            <a class="icon-14" href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i
                                    class="fab fa-github"></i></a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- style default -->
<?php else : ?>
    <div class="tp-team-3-area fix pt-120 pb-120 tp-el-section">
    <div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="tp-team-3-section-box z-index text-center mb-50">
                <span class="tp-section-subtitle"><span>//</span>OUR EXPERT TEAM</span>
                <h4 class="tp-section-title">Meet our experienced <br>team people</h4>
            </div>
            <div class="tp-team-3-wrapper">
                <div class="swiper-container tp-team-3-active">
                <div class="swiper-wrapper">
                    <?php foreach ( $settings['teams'] as $key => $item ) :
                    $title = tp_kses( $item['title' ] );
                    $item_url = esc_url($item['item_url']);
                    $key = $key+1;
                    if ( !empty($item['image']['url']) ) {
                        $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                        $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                    }     
                    $this->add_render_attribute( 'title_team', 'class', 'tp-team-info-title  tp-el-rep-name' );       
                ?>
                    <div class="swiper-slide">
                        <div class="tp-team-3-item text-center p-relative">
                            <?php if(!empty($tp_team_image_url)) : ?>
                    <div class="tp-team-3-thumb p-relative">
                        <img src="<?php echo esc_url($tp_team_image_url); ?>"
                            alt="<?php echo esc_attr($tp_team_image_alt); ?>">                    
                    <?php endif; ?> 

                            <?php if( !empty($item['show_social'] ) ) : ?>
                    <div class="tp-team-3-social-box tp-el-rep-social">
                        <?php if( !empty($item['web_title'] ) ) : ?>
                        <a class="icon-1" href="<?php echo esc_url( $item['web_title'] ); ?>"><i
                                class="fas fa-globe"></i></a>
                        <?php endif; ?>
                        <?php if( !empty($item['phone_title'] ) ) : ?>
                        <a class="icon-2" href="<?php echo esc_url( $item['phone_title'] ); ?>"><i
                                class="fas fa-phone"></i></a>
                        <?php endif; ?>
                        <?php if( !empty($item['facebook_title'] ) ) : ?>
                        <a class="icon-3" href="<?php echo esc_url( $item['facebook_title'] ); ?>"><i
                                class="fab fa-facebook-f"></i></a>
                        <?php endif; ?>
                        <?php  if( !empty($item['twitter_title'] ) ) : ?>
                        <a class="icon-4" href="<?php echo esc_url( $item['twitter_title'] ); ?>"><i
                                class="fab fa-twitter"></i></a>
                        <?php endif; ?>
                        <?php if( !empty($item['linkedin_title'] ) ) : ?>
                        <a class="icon-5" href="<?php echo esc_url( $item['linkedin_title'] ); ?>"><i
                                class="fab fa-linkedin"></i></a>
                        <?php endif; ?>
                        <?php if( !empty($item['instagram_title'] ) ) : ?>
                        <a class="icon-6" href="<?php echo esc_url( $item['instagram_title'] ); ?>"><i
                                class="fa-brands fa-instagram"></i></a>
                        <?php endif; ?>
                        <?php if( !empty($item['youtube_title'] ) ) : ?>
                        <a class="icon-7" href="<?php echo esc_url( $item['youtube_title'] ); ?>"><i
                                class="fab fa-youtube"></i></a>
                        <?php endif; ?>
                        <?php if( !empty($item['googleplus_title'] ) ) : ?>
                        <a class="icon-8" href="<?php echo esc_url( $item['googleplus_title'] ); ?>"><i
                                class="fab fa-google-plus-g"></i></a>
                        <?php endif; ?>
                        <?php if( !empty($item['flickr_title'] ) ) : ?>
                        <a class="icon-9" href="<?php echo esc_url( $item['flickr_title'] ); ?>"><i
                                class="fab fa-flickr"></i></a>
                        <?php endif; ?>
                        <?php if( !empty($item['vimeo_title'] ) ) : ?>
                        <a class="icon-10" href="<?php echo esc_url( $item['vimeo_title'] ); ?>"><i
                                class="fab fa-vimeo-v"></i></a>
                        <?php endif; ?>
                        <?php if( !empty($item['behance_title'] ) ) : ?>
                        <a class="icon-11" href="<?php echo esc_url( $item['behance_title'] ); ?>"><i
                                class="fab fa-behance"></i></a>
                        <?php endif; ?>
                        <?php if( !empty($item['dribble_title'] ) ) : ?>
                        <a class="icon-12" href="<?php echo esc_url( $item['dribble_title'] ); ?>"><i
                                class="fab fa-dribbble"></i></a>
                        <?php endif; ?>
                        <?php if( !empty($item['pinterest_title'] ) ) : ?>
                        <a class="icon-13" href="<?php echo esc_url( $item['pinterest_title'] ); ?>"><i
                                class="fab fa-pinterest-p"></i></a>
                        <?php endif; ?>
                        <?php if( !empty($item['gitub_title'] ) ) : ?>
                        <a class="icon-14" href="<?php echo esc_url( $item['gitub_title'] ); ?>"><i
                                class="fab fa-github"></i></a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>                    
                           
                            <div class="tp-team-3-thumb-shape-1">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/team/shape-3-1.png" alt="">
                            </div>
                            <div class="tp-team-3-thumb-shape-2">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/team/shape-3-2.png" alt="">
                            </div> 
                            </div>
                            <div class="tp-team-3-text">
                                <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                            tag_escape( $settings['title_tag'] ),
                            $this->get_render_attribute_string( 'tp-team-3-title' ),
                            $title,
                            $item_url
                        ); ?>

                        <?php if( !empty($item['designation']) ) : ?>
                        <span class="tp-el-rep-designation"><?php echo tp_kses( $item['designation'] ); ?></span>
                        <?php endif; ?>
                            
                            
                            </div>                    
                        </div>
                    </div>
                    <?php endforeach; ?>
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

$widgets_manager->register( new TP_Team() );