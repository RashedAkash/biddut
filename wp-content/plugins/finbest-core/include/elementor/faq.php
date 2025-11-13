<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_FAQ extends Widget_Base {

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
		return 'tp-faq';
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
		return __( 'FAQ', 'tpcore' );
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

		 // tp_section_title
		$this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',['layout-1']);


		$this->start_controls_section(
            '_accordion',
            [
                'label' => esc_html__( 'Accordion', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT
            ]
        );


        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
            'tp_accordion_active_switch',
            [
                'label' => esc_html__( 'Show', 'tp-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-core' ),
                'label_off' => esc_html__( 'Hide', 'tp-core' ),
                'return_value' => 'yes',
                'default' => '0',
            ]
        );

        $repeater->add_control(
            'accordion_title', [
                'label' => esc_html__( 'Accordion Item', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'This is accordion item title' , 'tpcore' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'accordion_description',
            [
                'label' => esc_html__('Description', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Facilis fugiat hic ipsam iusto laudantium libero maiores minima molestiae mollitia repellat rerum sunt ullam voluptates? Perferendis, suscipit.',
                'label_block' => true,
            ]
        );
        $this->add_control(
            'accordions',
            [
                'label' => esc_html__( 'Repeater Accordion', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #1', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #2', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #3', 'tpcore' ),
                    ],
                    [
                        'accordion_title' => esc_html__( 'This is accordion item title #4', 'tpcore' ),
                    ],
                ],
                'title_field' => '{{{ accordion_title }}}',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
            'accordion_image_area',
            [
                'label' => esc_html__( 'Accordion Extra', 'tpcore' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
                    'tp_design_style' => "layout-7" 
                ],

            ]
        );

		$this->add_control(
			'accordion_image',
			[
				'label' => esc_html__('Fag Image', 'tpcore'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]

			]
		);

		$this->add_control(
			'accordion_video_url',
			[
				'label' => esc_html__('Video Url', 'tpcore'),
				'type' => Controls_Manager::TEXTAREA,

			]
		);

		$this->add_control(
			'accordion_extra_text',
			[
				'label' => esc_html__('Extra Text', 'tpcore'),
				'type' => Controls_Manager::TEXTAREA,

			]
		);

		$this->add_control(
			'accordion_extra_shape',
			[
				'label' => esc_html__('Accordion Shape', 'tpcore'),
				'type' => Controls_Manager::SWITCHER,

			]
		);

		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'default' => 'full',
            ]
        );
		
		$this->end_controls_section();

           // counter
           $this->start_controls_section(
            'tp_counter_bg',
                [
                    'label' => esc_html__( 'Process counter', 'tpcore' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'tp_design_style' => ['layout-1']
                    ]
                ]
            );
            $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'tp_counter_fact_number', [
                'label' => esc_html__('Number', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'basic' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('17', 'tpcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_counter_fact_title',
            [
                'label' => esc_html__('Title', 'tpcore'),
                'description' => tp_get_allowed_html_desc( 'intermediate' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Food', 'tpcore'),
                'label_block' => true,
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
        $this->add_control(
            'tp_counter_fact_title_2_list',
            [
                'label' => esc_html__('Services - List', 'tpcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_counter_fact_title' => esc_html__('Business Stratagy', 'tpcore'),
                    ],
                    [
                        'tp_counter_fact_number' => esc_html__('654655445', 'tpcore'),
                    ]
                ],
                'title_field' => '{{{ tp_counter_fact_title }}}',
            ]
        );

        $this->end_controls_section();
	}

	protected function style_tab_content(){
		$this->tp_section_style_controls('faq_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_sub_title', 'Section - Sub Title', '.tp-el-sub-title');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title');
        $this->tp_basic_style_controls('section_des', 'Section - Description', '.tp-el-des');
        $this->tp_icon_style('fact_rep_icon', 'Fact Repeater Icon', '.tp-el-frep-icon');
        $this->tp_basic_style_controls('fact_rep_num', 'Fact Repeater Number', '.tp-el-frep-num');
        $this->tp_basic_style_controls('fact_rep_title', 'Fact Repeater Title', '.tp-el-frep-title');
        $this->tp_basic_style_controls('faq_rep_title', 'FAQ Repeater Title', '.tp-el-faq-rep-title', ['layout-1', 'layout-2', 'layout-3']);
        $this->tp_basic_style_controls('faq_rep_des', 'FAQ Repeater Description', '.tp-el-faq-rep-des', ['layout-1', 'layout-2', 'layout-3']);
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
    $this->add_render_attribute('title_args', 'class', 'tp-section-title');  
    if ( !empty($settings['accordion_image']['url']) ) {
        $accordion_image = !empty($settings['accordion_image']['id']) ? wp_get_attachment_image_url( $settings['accordion_image']['id'], $settings['thumbnail_size_size']) : $settings['accordion_image']['url'];
        $accordion_image_alt = get_post_meta($settings["accordion_image"]["id"], "_wp_attachment_image_alt", true);
    } 
?>
<div class="tp-faq-breadcrumb-tab-content tp-accordion">
    <div class="accordion" id="general_accordion-22">
        <?php foreach ( $settings['accordions'] as $index => $item) :
                $collapsed = ($index == '0' ) ? '' : 'collapsed';
                $aria_expanded = ($index == '0' ) ? "true" : "false";
                $show = $item['tp_accordion_active_switch'] ? "show" : "";
                $active = $item['tp_accordion_active_switch'] ? "tp-faq-active" : "";
                ?>
        <div class="accordion-item <?php echo esc_attr($active); ?>">
            <h2 class="accordion-header tp-el-faq-rep-title" id="headingOne1-<?php echo esc_attr($index); ?>">
                <button class="accordion-button <?php echo esc_attr($collapsed); ?>" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseOne1-<?php echo esc_attr($index); ?>"
                    aria-expanded="true" aria-controls="collapseOne1-<?php echo esc_attr($index); ?>">
                    <?php echo esc_html($item['accordion_title']); ?>
                </button>
            </h2>
            <div id="collapseOne1-<?php echo esc_attr($index); ?>"
                class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
                aria-labelledby="headingOne1-<?php echo esc_attr($index); ?>" data-bs-parent="#general_accordion-22">
                <div class="accordion-body">
                    <p class="tp-el-faq-rep-des"><?php echo tp_kses($item['accordion_description']); ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ):

	$this->add_render_attribute('title_args', 'class', 'tp-section-title');  
	if ( !empty($settings['accordion_image']['url']) ) {
		$accordion_image = !empty($settings['accordion_image']['id']) ? wp_get_attachment_image_url( $settings['accordion_image']['id'], $settings['thumbnail_size_size']) : $settings['accordion_image']['url'];
		$accordion_image_alt = get_post_meta($settings["accordion_image"]["id"], "_wp_attachment_image_alt", true);
	} 
?>
<div class="tp-faq-breadcrumb-tab-content tp-accordion">
    <div class="accordion" id="general_accordion-2">
        <?php foreach ( $settings['accordions'] as $index => $item) :
				$collapsed = ($index == '0' ) ? '' : 'collapsed';
				$aria_expanded = ($index == '0' ) ? "true" : "false";
				$show = $item['tp_accordion_active_switch'] ? "show" : "";
				$active = $item['tp_accordion_active_switch'] ? "tp-faq-active" : "";
				?>
        <div class="accordion-item <?php echo esc_attr($active); ?>">
            <h2 class="accordion-header tp-el-faq-rep-title" id="headingOne-<?php echo esc_attr($index); ?>">
                <button class="accordion-button <?php echo esc_attr($collapsed); ?>" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo esc_attr($index); ?>"
                    aria-expanded="true" aria-controls="collapseOne-<?php echo esc_attr($index); ?>">
                    <?php echo esc_html($item['accordion_title']); ?>
                </button>
            </h2>
            <div id="collapseOne-<?php echo esc_attr($index); ?>"
                class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
                aria-labelledby="headingOne-<?php echo esc_attr($index); ?>" data-bs-parent="#general_accordion-2">
                <div class="accordion-body">
                    <p class="tp-el-faq-rep-des"><?php echo tp_kses($item['accordion_description']); ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php else : 
	$this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title');  
	if ( !empty($settings['accordion_image']['url']) ) {
		$accordion_image = !empty($settings['accordion_image']['id']) ? wp_get_attachment_image_url( $settings['accordion_image']['id'], $settings['thumbnail_size_size']) : $settings['accordion_image']['url'];
		$accordion_image_alt = get_post_meta($settings["accordion_image"]["id"], "_wp_attachment_image_alt", true);
	}
?>
<!-- faq area start -->
 <div class="tp-faq-area p-relative pt-120 pb-120">
    <div class="tp-faq-thumb" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/cta/faq-bg.jpg)" ></div>
    <div class="tp-faq-text d-none d-xxl-block">
    <h5>OUR FAQ’S</h5>
    </div>
    <div class="container">
    <div class="row">
        <div class="col-xxl-7 col-xl-6 col-lg-6 wow tpfadeLeft" data-wow-duration=".9s" data-wow-delay=".s">
            <div class="tp-custom-accordion">
                <div class="accordion" id="accordionExample">

                    <?php foreach ( $settings['accordions'] as $index => $item) : 
		                $collapsed = ($index == '0' ) ? '' : 'collapsed';
		                $show = ($index == '0' ) ? "show" : "";
		            ?>
                <div class="accordion-items tp-faq-active">
                    <h2 class="accordion-header" id="headingOne-<?php echo esc_attr($index); ?>">
                        <button class="accordion-buttons <?php echo esc_attr($collapsed); ?> " type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne-<?php echo esc_attr($index); ?>" aria-expanded="true" aria-controls="collapseOne-<?php echo esc_attr($index); ?>">
                            <?php echo esc_html($item['accordion_title']); ?>
                        </button>
                    </h2>
                    <div id="collapseOne-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>"
                        aria-labelledby="headingOne-<?php echo esc_attr($index); ?>" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                           <?php echo tp_kses($item['accordion_description']); ?>
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



<!-- faq area end -->

<?php endif;
	}

}

$widgets_manager->register( new TP_FAQ() );