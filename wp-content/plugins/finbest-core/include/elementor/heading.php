<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;

use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Heading extends Widget_Base {

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
		return 'tp-heading';
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
		return __( 'Heading', 'tpcore' );
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

        // title/content
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',$control_condition = ['layout-1','layout-2','layout-3','layout-4']);


	}

    protected function style_tab_content(){
        $this->tp_section_style_controls('heading_section', 'Section - Style', '.tp-el-section');

        $this->tp_basic_style_controls('heading_subtitle', 'Section - Subtitle', '.tp-el-subtitle', ['layout-1', 'layout-2']);
        $this->tp_basic_style_controls('heading_title', 'Section - Title', '.tp-el-title', ['layout-1', 'layout-2']);
        $this->tp_basic_style_controls('heading_desc', 'Section - Description', '.tp-el-des', ['layout-1', 'layout-2']);
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


<?php if($settings['tp_design_style']  == 'layout-2'):
	$this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title');
?>

<?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
    <div class="tp-team-title-wrapper-2 mb-60 tp-el-section">
        <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
        <span class="tp-section-title-pre tp-el-subtitle"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></span>
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
<?php endif; ?>



<?php else:
	$this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title');
?>
<?php if ( !empty($settings['tp_section_section_title_show']) ) : ?>
<div class="tp-section-wrapper tp-el-section">
    <div class="tp-section-title-wrapper">
        <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
        <span class="tp-section-title-pre tp-el-subtitle"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></span>
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
    </div>
    <?php if ( !empty($settings['tp_section_description']) ) : ?>
    <p class="tp-el-des"><?php echo tp_kses( $settings['tp_section_description'] ); ?></p>
    <?php endif; ?>
</div>
<?php endif; ?>

<?php endif;
	}
}

$widgets_manager->register( new TP_Heading() );