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
class TP_Project_Deatils extends Widget_Base {

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
		return 'tp-portfolio-details';
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
		return __( 'Portfolio Details', 'tp-core' );
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();


        $this->tp_section_title_render_controls('project', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1', 'layout-2','layout-3','layout-4','layout-5']);

   
        $this->start_controls_section(
         'about_features_list_sec',
             [
               'label' => esc_html__( 'Features List', 'tpcore' ),
               'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
               'condition' => [
                    'tp_design_style' => ['layout-1', 'layout-2']
               ]
             ]
        );
        
        // repeater for about features list with text , testarea and icon
        $repeater = new Repeater();

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
            'tp_project_features_list_title',
            [
                'label' => esc_html__('Title', 'tp-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Title', 'tp-core'),
                'title' => esc_html__('Enter title', 'tp-core'),
                'label_block' => true
                
            ]
        );
        $repeater->add_control(
            'tp_project_features_list_description',
            [
                'label' => esc_html__('Description', 'tp-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Description', 'tp-core'),
                'title' => esc_html__('Enter description', 'tp-core'),
                'label_block' => true
            ]
        );

        $this->add_control(
            'tp_project_features_list',
            [
                'label' => esc_html__('Features List', 'tp-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_project_features_list_title' => esc_html__('Title 01', 'tp-core'),
                        'tp_project_features_list_description' => esc_html__('Sub Content', 'tp-core'),
                    ],
                    [
                        'tp_project_features_list_title' => esc_html__('Title 02', 'tp-core'),
                        'tp_project_features_list_description' => esc_html__('Sub Content', 'tp-core'),
                    ]
                ],
                'title_field' => '{{{ tp_project_features_list_title }}}',
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


	}

    

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('portfolio_section', 'Section - Style', '.tp-el-section'); 
        $this->tp_basic_style_controls('section_sub_title', 'Section - Sub Title', '.tp-el-sub-title', ['layout-1', 'layout-2']);
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title', ['layout-1', 'layout-2']);
        $this->tp_basic_style_controls('section_des', 'Section - Description', '.tp-el-des', ['layout-1', 'layout-2']);
        # repeater
        $this->tp_basic_style_controls('rep_title', 'Repeater Title', '.tp-el-rep-title', ['layout-1', 'layout-2']);
        $this->tp_basic_style_controls('rep_des', 'Repeater Description', '.tp-el-rep-des', ['layout-1', 'layout-2']);
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

    $this->add_render_attribute('title_args', 'class', 'tp-project-details-subtitle tp-el-title');
?>
 <section class="tp-el-section">
    <div class="container">
       <div class="row">
          <div class="col-lg-12">
             <div class="tp-project-details-subtitle-wrapper">
                
                <?php if ( !empty($settings['tp_project_sub_title']) ) : ?>
                <h4 class="tp-project-title-pre tp-el-sub-title">
                    <?php echo tp_kses( $settings['tp_project_sub_title'] ); ?>
                </h4>
                <?php endif; ?>
                <?php if ( !empty($settings['tp_project_title' ]) ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                    tag_escape( $settings['tp_project_title_tag'] ),
                    $this->get_render_attribute_string( 'title_args' ),
                    tp_kses( $settings['tp_project_title' ] )
                    );
                endif; ?>
               <?php if ( !empty($settings['tp_project_description']) ) : ?>
                <p class="tp-el-des"><?php echo tp_kses( $settings['tp_project_description'] ); ?></p>
                <?php endif; ?>
             </div>
          </div>
       </div> 
       
       <div class="row">
          <div class="col-lg-8">
             <div class="tp-project-details-list border-0">
                <div class="row">
                    <?php 
                    if ( !empty($settings['tp_project_features_list']) ) :
                        foreach ( $settings['tp_project_features_list'] as $item ) :
                            $title = $item['tp_project_features_list_title'];
                            $description = $item['tp_project_features_list_description']; 
                    ?>
                   <div class="col-md-6">
                      <span class="tp-project-details-list-title tp-el-rep-title"><i class="fa-solid fa-check"></i> <?php echo tp_kses( $item['tp_project_features_list_title'] ); ?></span>
                      <p class="tp-el-rep-des"><?php echo tp_kses( $item['tp_project_features_list_description'] ); ?></p>
                   </div>
                   <?php endforeach; endif; ?>
                </div>
             </div>
          </div>
          <?php if(!empty($tp_image)) : ?>
          <div class="col-lg-4">
             <div class="tp-project-details-list-thumb">
                <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
             </div>
          </div>
          <?php endif; ?>
       </div>
    </div>
 </section>

<?php else:

    if ( !empty($settings['tp_image']['url']) ) {
        $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url( $settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
        $tp_image_alt = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
    }

    $this->add_render_attribute('title_args', 'class', 'tp-project-details-title tp-el-title');
?>


 <section class="tp-el-section">
    <div class="container">
       <div class="row">
          <div class="col-lg-12">
            <?php if(!empty($tp_image)) : ?>
             <div class="tp-project-details-thumb">
                <img src="<?php echo esc_url($tp_image); ?>" alt="<?php echo esc_attr($tp_image_alt); ?>">
             </div>
             <?php endif; ?>
             <div class="tp-project-details-title-wrapper p-relative">
                
                <?php if ( !empty($settings['tp_project_sub_title']) ) : ?>
                <h4 class="tp-project-title-pre tp-el-sub-title">
                    <?php echo tp_kses( $settings['tp_project_sub_title'] ); ?>
                </h4>
                <?php endif; ?>
                <?php if ( !empty($settings['tp_project_title' ]) ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                    tag_escape( $settings['tp_project_title_tag'] ),
                    $this->get_render_attribute_string( 'title_args' ),
                    tp_kses( $settings['tp_project_title' ] )
                    );
                endif; ?>
                <?php if ( !empty($settings['tp_project_description']) ) : ?>
                <p class="tp-el-des"><?php echo tp_kses( $settings['tp_project_description'] ); ?></p>
                <?php endif; ?>

                <div class="tp-project-details-box">
                    <?php 
                    if ( !empty($settings['tp_project_features_list']) ) :
                        foreach ( $settings['tp_project_features_list'] as $item ) :
                            $title = $item['tp_project_features_list_title'];
                            $description = $item['tp_project_features_list_description']; 
                    ?>
                   <div class="tp-project-details-box-1 m-0">
                      <h4 class="tp-project-details-box-title tp-el-rep-title"><?php echo tp_kses( $item['tp_project_features_list_title'] ); ?></h4>
                      <p class="tp-el-rep-des"><?php echo tp_kses( $item['tp_project_features_list_description'] ); ?></p>
                   </div>
                   <?php endforeach; endif; ?>
                </div>
             </div>
          </div>
       </div> 
    </div>
 </section>

<?php endif; 
	}
}

$widgets_manager->register( new TP_Project_Deatils() );