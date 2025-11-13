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
class TP_Text_Slider extends Widget_Base {

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
		return 'tp-text-slider';
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
		return __( 'Text', 'tpcore' );
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
                    'layout-2' => esc_html__('Layout 2', 'tp-core'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

   
        $this->start_controls_section(
			'about_team_list_sec',
				[
				  'label' => esc_html__( 'Features List', 'tpcore' ),
				  'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				  'condition' => [
					   'tp_design_style' => ['layout-1', 'layout-2']
				  ]
				]
		   );
		   $this->add_control(
            'team_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'titile', 'tpcore' ),
                'placeholder' => __( 'titile', 'tpcore' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );         
	
		   // repeater for about features list with text , testarea and icon
		   $repeater = new Repeater();
		   
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
			'tp_about_features_list_des',
			[
				'label' => esc_html__('des', 'tp-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__(' tp des', 'tp-core'),
				'title' => esc_html__('Enter des', 'tp-core'),
				'label_block' => true
				
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
					   ]
				   ],
				   'title_field' => '{{{ tp_about_features_list_title }}}',
			   ]
		   );
   
		   $this->end_controls_section();
		   
   
    }

    protected function style_tab_content(){
		$this->tp_basic_style_controls('history_title', 'Title', '.tp-el-box-title');
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
<div class="tp-team-details-value">
    <?php 
		if ( !empty($settings['tp_about_features_list']) ) :
			foreach ( $settings['tp_about_features_list'] as $item ) :
			$title = $item['tp_about_features_list_title'];
	?>
    <ul>
        <?php  if ( !empty('tp_about_features_list_title') ) : ?>
        <li class="txt"><i class="fa-solid fa-check"></i><?php echo tp_kses( $item['tp_about_features_list_title'] ); ?>
        </li>
        <?php endif; ?>
		<p><?php echo tp_kses( $item['tp_about_features_list_des'] ); ?></p>
    </ul>
    <?php endforeach; endif; ?>
</div>

<?php else: ?>

<div class="tp-team-details-value">
	
	<?php  if ( !empty('team_title') ) : ?>
	<h3 class="tp-team-details-title"><?php echo tp_kses( $settings['team_title'] ); ?></h3>
	<?php endif; ?>
    <ul>
	    <?php 
			if ( !empty($settings['tp_about_features_list']) ) :
				foreach ( $settings['tp_about_features_list'] as $item ) :
				$title = $item['tp_about_features_list_title'];
		?>
        <?php  if ( !empty('tp_about_features_list_title') ) : ?>
        <li><i class="fa-solid fa-check"></i><?php echo tp_kses( $item['tp_about_features_list_title'] ); ?></li>
        <?php endif; ?>
        <?php endforeach; endif; ?>
    </ul>
    
</div>
<?php endif; 
	}
}

$widgets_manager->register( new TP_Text_Slider() );