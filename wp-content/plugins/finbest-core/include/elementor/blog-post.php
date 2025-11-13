<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Blog_Post extends Widget_Base {

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
		return 'tp-blog-post';
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
		return __( 'Blog Post', 'tpcore' );
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

        // Blog Query
		$this->tp_query_controls('blog', 'Blog');

        // section column
        $this->tp_columns('col', ['layout-1', 'layout-2', 'layout-3']);
        
	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('blog_section', 'Section - Style', '.tp-el-section');
        # repeater
        $this->tp_basic_style_controls('rep_meta', 'Repeater Meta', '.tp-el-rep-meta', ['layout-1', 'layout-2', 'layout-3']);
        $this->tp_basic_style_controls('rep_title', 'Repeater Title', '.tp-el-rep-title', ['layout-1', 'layout-2', 'layout-3']);
        $this->tp_basic_style_controls('rep_des', 'Repeater Description', '.tp-el-rep-des', ['layout-1', 'layout-2', 'layout-3']);
        $this->tp_link_controls_style('rep_btn', 'Repeater Button', '.tp-el-rep-btn', ['layout-1', 'layout-2', 'layout-3']);
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

        /**
         * Setup the post arguments.
        */
        $query_args = TP_Helper::get_query_args('post', 'category', $this->get_settings());

        // The Query
        $query = new \WP_Query($query_args);


        $filter_list = $settings['category'];

        ?>

<?php if ( $settings['tp_design_style']  == 'layout-2' ): 
?>

<!-- blog area start -->
<section class="tp-blog-area-3 tp-el-section">
    <div class="container">
        <div class="row">
            <?php if ($query->have_posts()) : 
					$i = 0;
					while ($query->have_posts()) : 
					$query->the_post();
					global $post;
					$categories = get_the_category($post->ID);
					$i++;
				?>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="tp-blog-item-wrapper-2 blog-3 p-relative mb-30 wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay=".3s">
                    <div class="tp-blog-item-thumb-2 thumb-height">
                        <?php if(has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail(); ?>
                        <?php endif; ?>
                        <div class="tp-blog-item-info-3 d-flex justify-content-center">
                            <span class="tp-el-rep-meta"><i class="fa-regular fa-calendar-days"></i><?php the_time( get_option('date_format') ); ?>
							</span>
                            <span class="tp-el-rep-meta">
								<i class="fa-regular fa-comments"></i><a
                                    href="#"><?php comments_number();?></a>
							</span>
                        </div>
                    </div>
                    <div class="tp-blog-item-content-3">
                      
                        <h4 class="tp-blog-item-title tp-el-rep-title"><a
                                href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a></h4>
                        <?php if (!empty($settings['tp_post_content'])):
                            $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                        ?>
                        <p class="tp-el-rep-des"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
                        <?php endif; ?>
                        <div class="tp-blog-item-btn-3">
						<a class="tp-el-rep-btn" href="<?php the_permalink(); ?>"><?php echo tp_kses($settings['tp_post_button']); ?><span><i
                                        class="fa-regular fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_query(); endif; ?>
        </div>
    </div>
</section>
<!-- blog area end -->

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ) : 
?>

<!-- blog area start -->
<section class="tp-blog-area-2 tp-el-section">
    <div class="container">
        <div class="row">
            <?php if ($query->have_posts()) : 
					$i = 0;
					while ($query->have_posts()) : 
					$query->the_post();
					global $post;
					$categories = get_the_category($post->ID);
					$i++;
				?>
            <div class="col-lg-4 col-md-6">
                <div class="tp-blog-item-wrapper-2 p-relative mb-30 wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay=".3s">
                    <div class="tp-blog-item-thumb-2 thumb-height">
                        <?php if(has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail(); ?>
                        <?php endif; ?>
                    </div>

                    <div class="tp-blog-item-date-2">
                        <span class="tp-el-rep-meta"> <?php the_time('j F '); ?></span>
                    </div>
                    
                    <div class="tp-blog-item-content-2">
                        <div class="tp-blog-item-info-2 d-flex">
						<span class="tp-el-rep-meta"><i class="fa-regular fa-user"></i><?php echo esc_html__('by ', 'tpcore'); ?><?php the_author(); ?></span>
                        <span class="tp-el-rep-meta"><i class="fa-regular fa-comments"></i><a
                                    href="#"><?php comments_number();?></a></span>
                        </div>
                        <h4 class="tp-blog-item-title tp-el-rep-title"><a
                                href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a></h4>
                        <?php if (!empty($settings['tp_post_content'])):
                            $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                        ?>
                        <p class="tp-el-rep-des"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?></p>
                        <?php endif; ?>
                        <div class="tp-blog-item-btn-2">
						<a class="tp-el-rep-btn" href="<?php the_permalink(); ?>"><?php echo tp_kses($settings['tp_post_button']); ?><span><i
                                        class="fa-regular fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_query(); endif; ?>
        </div>
    </div>
</section>
<!-- blog area end -->

<?php else : ?>
<!-- blog area start -->
<section class="tp-blog-area tp-el-section">
    <div class="container">
        <div class="row">
            <?php if ($query->have_posts()) : 
					$i = 0;
					while ($query->have_posts()) : 
					$query->the_post();
					global $post;
					$categories = get_the_category($post->ID);
					$i++;
				?>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="tp-blog-item-wrapper p-relative mb-30 wow fadeInUp" data-wow-duration="1s"
                    data-wow-delay=".3s">
                    <div class="tp-blog-item-thumb thumb-height">
                        <?php if(has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail(); ?>
                        <?php endif; ?>
                        <div class="tp-blog-item-date">
                        <h4 class="tp-el-rep-meta"><?php echo the_time("j")?></h4>
                        <p class="tp-el-rep-meta"><?php echo  the_time("F")?></p>
                    </div>
                    </div>
                    <div class="tp-blog-item-content">
                        <div class="tp-blog-item-info d-flex">
                            <span class="tp-el-rep-meta"><i class="fa-regular fa-user"></i><?php echo esc_html__('by ', 'tpcore'); ?><?php the_author(); ?></span>
                            <span class="tp-el-rep-meta"><i class="fa-regular fa-comments"></i><a href="#"><?php comments_number();?></a></span>
                        </div>
                        <h4 class="tp-blog-item-title tp-el-rep-title"><a
                                href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tp_blog_title_word'], ''); ?></a>
                        </h4>
                        <?php if (!empty($settings['tp_post_content'])):
                            $tp_post_content_limit = (!empty($settings['tp_post_content_limit'])) ? $settings['tp_post_content_limit'] : '';
                        ?>
                        <p class="tp-el-rep-des"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tp_post_content_limit, ''); ?>
                        </p>
                        <?php endif; ?>
                        <div class="tp-blog-item-btn text-end">
                            <a class="tp-el-rep-btn" href="<?php the_permalink(); ?>"><span><i class="fa-regular fa-arrow-right"></i></span><?php echo tp_kses($settings['tp_post_button']); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_query(); endif; ?>
        </div>
    </div>
</section>
<!-- blog area end -->
<?php endif;
	}

}

$widgets_manager->register( new TP_Blog_Post() );