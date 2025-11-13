<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;
use Elementor\Core\Utils\ImportExport\Url;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Team_Details extends Widget_Base {

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
        return 'tp-team-details-contact';
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
        return __( 'Team Details Contact', 'tpcore' );
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

     protected static function get_profile_names()
    {
        return [
            'apple' => esc_html__('Apple', 'tpcore'),
            'behance' => esc_html__('Behance', 'tpcore'),
            'bitbucket' => esc_html__('BitBucket', 'tpcore'),
            'codepen' => esc_html__('CodePen', 'tpcore'),
            'delicious' => esc_html__('Delicious', 'tpcore'),
            'deviantart' => esc_html__('DeviantArt', 'tpcore'),
            'digg' => esc_html__('Digg', 'tpcore'),
            'dribbble' => esc_html__('Dribbble', 'tpcore'),
            'email' => esc_html__('Email', 'tpcore'),
            'facebook-f' => esc_html__('Facebook', 'tpcore'),
            'flickr' => esc_html__('Flicker', 'tpcore'),
            'foursquare' => esc_html__('FourSquare', 'tpcore'),
            'github' => esc_html__('Github', 'tpcore'),
            'houzz' => esc_html__('Houzz', 'tpcore'),
            'instagram' => esc_html__('Instagram', 'tpcore'),
            'jsfiddle' => esc_html__('JS Fiddle', 'tpcore'),
            'linkedin-in' => esc_html__('LinkedIn', 'tpcore'),
            'medium' => esc_html__('Medium', 'tpcore'),
            'pinterest' => esc_html__('Pinterest', 'tpcore'),
            'product-hunt' => esc_html__('Product Hunt', 'tpcore'),
            'reddit' => esc_html__('Reddit', 'tpcore'),
            'slideshare' => esc_html__('Slide Share', 'tpcore'),
            'snapchat' => esc_html__('Snapchat', 'tpcore'),
            'soundcloud' => esc_html__('SoundCloud', 'tpcore'),
            'spotify' => esc_html__('Spotify', 'tpcore'),
            'stack-overflow' => esc_html__('StackOverflow', 'tpcore'),
            'tripadvisor' => esc_html__('TripAdvisor', 'tpcore'),
            'tumblr' => esc_html__('Tumblr', 'tpcore'),
            'twitch' => esc_html__('Twitch', 'tpcore'),
            'twitter' => esc_html__('Twitter', 'tpcore'),
            'vimeo' => esc_html__('Vimeo', 'tpcore'),
            'vk' => esc_html__('VK', 'tpcore'),
            'website' => esc_html__('Website', 'tpcore'),
            'whatsapp' => esc_html__('WhatsApp', 'tpcore'),
            'wordpress' => esc_html__('WordPress', 'tpcore'),
            'xing' => esc_html__('Xing', 'tpcore'),
            'yelp' => esc_html__('Yelp', 'tpcore'),
            'youtube' => esc_html__('YouTube', 'tpcore'),
        ];
    }
     
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

        // tp_section_title
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1','layout-2']);



        // Team Extra Info
        $this->start_controls_section(
            'tp_info_sec',
            [
                'label' => esc_html__('Team Extra Info', 'tp-core'),
            ]
        );
        
        $this->add_control(
            'tp_thumbnail_image',
            [
                'label' => esc_html__( 'Choose Member Image', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tp_thumbnail_image_2',
            [
                'label' => esc_html__( 'Choose Member Image 2', 'tp-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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

        // icon image svg

        $this->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Phone Image', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tpcore'),
                    'icon' => esc_html__('Icon', 'tpcore'),
                    'svg' => esc_html__('SVG', 'tpcore'),
                ]
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
                    'tp_box_icon_type' => 'image'
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
            'tp_team_phone',
            [
                'label' => esc_html__('Phone', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('+880 17823-63794', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_team_phone_url',
            [
                'label' => esc_html__('Phone Url', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('+8801782363794', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_team_email',
            [
                'label' => esc_html__('Email', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('info@themepure.com', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_team_email_url',
            [
                'label' => esc_html__('Email Url', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('info@themepure.com', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

       
        // Items
        $this->start_controls_section(
            'tp_skill_sec',
            [
                'label' => esc_html__('Team Details Items', 'tp-core'),
            ]
        );

        $repeater = new \Elementor\Repeater();

         // icon image svg

         $repeater->add_control(
            'tp_box_icon_type',
            [
                'label' => esc_html__('Select Country Image Type', 'tpcore'),
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
            'tp_team_items_title',
            [
                'label' => esc_html__('Items Title', 'tpcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('WordPress Developer', 'tpcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_items_title_list',
            [
                'label' => esc_html__('Items', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_team_items_title' => esc_html__('Research beyond the business plan', 'tpcore'),
                    ],
                    [
                        'tp_team_items_title' => esc_html__('Marketing options and rates', 'tpcore')
                    ],
                    [
                        'tp_team_items_title' => esc_html__('The ability to turnaround consulting', 'tpcore')
                    
                    ]
                ],
                'title_field' => '{{{ tp_team_items_title }}}',
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

    }

    protected function style_tab_content(){
        $this->tp_section_style_controls('comint_section', 'Section - Style', '.tp-el-section');
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
        

<?php if ( $settings['tp_design_style']  == 'layout-2' ) : ?>



<?php else :
    // thumbnail image
    if ( !empty($settings['tp_thumbnail_image']['url']) ) {
        $tp_thumbnail_image = !empty($settings['tp_thumbnail_image']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image']['url'];
        $tp_thumbnail_image_alt = get_post_meta($settings["tp_thumbnail_image"]["id"], "_wp_attachment_image_alt", true);
    }
    if ( !empty($settings['tp_thumbnail_image_2']['url']) ) {
        $tp_thumbnail_image_2 = !empty($settings['tp_thumbnail_image_2']['id']) ? wp_get_attachment_image_url( $settings['tp_thumbnail_image_2']['id'], $settings['tp_thumbnail_size_size']) : $settings['tp_thumbnail_image_2']['url'];
        $tp_thumbnail_image_2_alt = get_post_meta($settings["tp_thumbnail_image_2"]["id"], "_wp_attachment_image_alt", true);
    }
    $this->add_render_attribute('title_args', 'class', 'tp-section-title pb-25');  
?>


<div class="tp-register__area pt-115 pb-120">
    <div class="container">
    <?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="tp-register__section-title pb-25">
                    <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                        <span class="tp-section-subtitle"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></span>
                    <?php endif; ?>
                    <?php if ( !empty($settings['tp_section_title' ]) ) :
                        printf( '<%1$s %2$s data-wow-duration=".9s"
                        data-wow-delay=".5s" >%3$s</%1$s>',
                        tag_escape( $settings['tp_section_title_tag'] ),
                        $this->get_render_attribute_string( 'title_args' ),
                        tp_kses( $settings['tp_section_title' ] )
                        );
                    endif;  ?>                            
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="tp-register__left-box">
                    <div class="tp-register__thumb pb-25 d-flex justify-content-between">
                        <?php  if ( !empty($tp_thumbnail_image) ) : ?>
                        <img src="<?php echo esc_url($tp_thumbnail_image); ?>" alt="<?php echo esc_attr($tp_thumbnail_image_alt); ?>">  
                        <?php endif; ?>
                        <?php  if ( !empty($tp_thumbnail_image_2) ) : ?>                      
                        <img src="<?php echo esc_url($tp_thumbnail_image_2); ?>" alt="<?php echo esc_attr($tp_thumbnail_image_2_alt); ?>"> 
                        <?php endif; ?>                       
                    </div>                          
                    <div class="tp-register__text">
                    <?php if ( !empty($settings['tp_section_description']) ) : ?>
                        <p class="pb-20"><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
                        <?php endif; ?>
                        <div class="tp-register__list">
                            <ul>
                            <?php if ( !empty($settings['tp_items_title_list']) ) : 
                                foreach ($settings['tp_items_title_list'] as $item) : ?>
                                <li>
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
                                <?php if (!empty($item['tp_team_items_title'])): ?>    
                                    <?php echo tp_kses( $item['tp_team_items_title'] ); ?>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; endif; ?>
                            </ul>
                        </div>                       
                    </div>    
                    <div class="tp-register__tel-box d-flex align-items-center">
                        <div class="tp-register__tel-icon">
                            <span>
                                <?php if($settings['tp_box_icon_type'] == 'icon') : ?>
                                    <?php if (!empty($settings['tp_box_icon']) || !empty($settings['tp_box_selected_icon']['value'])) : ?>
                                    <?php tp_render_icon($settings, 'tp_box_icon', 'tp_box_selected_icon'); ?>
                                    <?php endif; ?>
                                    <?php elseif( $settings['tp_box_icon_type'] == 'image' ) : ?>
                                    <?php if (!empty($settings['tp_box_icon_image']['url'])): ?>
                                    <img src="<?php echo $settings['tp_box_icon_image']['url']; ?>"
                                        alt="<?php echo get_post_meta(attachment_url_to_postid($settings['tp_box_icon_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                    <?php endif; ?>
                                    <?php else : ?>
                                    <?php if (!empty($settings['tp_box_icon_svg'])): ?>
                                    <?php echo $settings['tp_box_icon_svg']; ?>
                                    <?php endif; ?>
                                <?php endif; ?> 
                            </span>
                        </div>
                        <div class="tp-register__tel-text">
                            <?php  if ( !empty($settings['tp_team_phone']) ) : ?>
                            <a class="number" href="tel:<?php echo esc_attr( $settings['tp_team_phone_url'] ); ?>"><?php echo tp_kses( $settings['tp_team_phone'] ); ?></a>
                            <?php endif; ?>
                            <?php  if ( !empty($settings['tp_team_email']) ) : ?>
                            <a href="mailto:<?php echo esc_attr( $settings['tp_team_phone_url'] ); ?>"><?php echo tp_kses( $settings['tp_team_email'] ); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>                        
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="tp-register__form-box">
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

<?php endif; 
    }
}

$widgets_manager->register( new TP_Team_Details() );
