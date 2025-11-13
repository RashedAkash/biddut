<?php
namespace TPCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Tp Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Portfolio_Post extends Widget_Base {

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
		return 'tp-portfolio-post';
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
		return __( 'Portfolio Post', 'tpcore' );
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
        $this->tp_section_title_render_controls('section', 'Section Title', 'Sub Title', 'your title here', $default_description = 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.',$control_condition = ['layout-3']);
        
        // Product Query
        $this->tp_query_controls('tp-portfolios-id', 'Portfolio', 'tp-portfolios', 'portfolios-cat', '6', '10', );

        // $this->tp_query_controls('blog', 'Blog');


        // tp_post__columns_section
        $this->tp_columns('col', ['layout-1','layout-2','layout-3']);

	}

    // style_tab_content
    protected function style_tab_content(){
        $this->tp_section_style_controls('portfolio_section', 'Section - Style', '.tp-el-section');
        $this->tp_basic_style_controls('section_sub_title', 'Section - Sub Title', '.tp-el-sub-title', 'layout-3');
        $this->tp_basic_style_controls('section_title', 'Section - Title', '.tp-el-title', 'layout-3');
        $this->tp_basic_style_controls('section_des', 'Section - Description', '.tp-el-des', 'layout-3');
        $this->tp_link_controls_style('section_btn', 'Section - Button', '.tp-el-btn', ['layout-1', 'layout-2', 'layout-3']);
        # repeater
        $this->tp_basic_style_controls('rep_subtitle', 'Repeater Subtitle', '.tp-el-rep-sub-title' , ['layout-1', 'layout-2', 'layout-3']);
        $this->tp_basic_style_controls('rep_title', 'Repeater Title', '.tp-el-rep-title' , ['layout-1', 'layout-2', 'layout-3']);

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
        $query_args = TP_Helper::get_query_args('tp-portfolios', 'portfolios-cat', $this->get_settings());

       // The Query
       $query = new \WP_Query($query_args);

       $filter_list = $settings['category'];

       $portfolio_filter_btn_active = 1; // for filter button active

        ?>

<?php if ( $settings['tp_design_style']  == 'layout-2' ): ?>

<div class="portfolio-area pt-100 pb-90 tp-el-section">
    <div class="container">
        
        <?php if( !empty($filter_list) ) : ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="tp-project-tab-wrapper d-flex justify-content-center portfolio-filter">
                    <ul class="nav nav-pills mb-60 wow fadeInUp masonary-menu" data-wow-duration="1s" data-wow-delay=".3s" id="pills-tab" role="tablist">
                        <?php 
                        $post_type = 'tp-portfolios';
                        $count_posts = wp_count_posts( $post_type );
                        $published_posts = $count_posts->publish;
                        foreach ( $filter_list as $list ):
                            $listSTR = str_replace('-', ' ', $list);
                            if ( $portfolio_filter_btn_active === 1 ): 
                            $portfolio_filter_btn_active++; 
                        ?>

                            <li class="nav-item active"><button class="nav-link tp-el-btn" data-filter="*"><span><?php echo esc_html__( 'See All','tpcore' ); ?></span></button></li>
                            <li class="nav-item"><button class="nav-link tp-el-btn" data-filter=".<?php echo esc_attr( $list ); ?>"><span><?php echo esc_html( $listSTR ); ?></span></button></li>
                            <?php else: ?>
                                <li class="nav-item"><button class="nav-link tp-el-btn" data-filter=".<?php echo esc_attr( $list ); ?>"><span><?php echo esc_html( $listSTR ); ?></span></button></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="row grid">
            <?php 
                while ($query->have_posts()) : 
                $query->the_post();
                global $post;
                $terms = get_the_terms($post->ID, 'portfolios-cat'); 
                $item_classes = '';
                $item_cat_names = '';
                $item_cats = get_the_terms( $post->ID, 'portfolios-cat' );
                if( !empty($item_cats) ):
                    $count = count($item_cats) - 1;
                    foreach($item_cats as $key => $item_cat) {
                        $item_classes .= $item_cat->slug . ' ';
                        $item_cat_names .= ( $count > $key ) ? $item_cat->name  . ', ' : $item_cat->name;
                    }
                endif; 
                $tp_portfolio_sub_thumbnail = function_exists('get_field') ? get_field('tp-portfolio_sub_thumbnail') : '';
                $categories = get_the_terms( $post->ID, 'portfolios-cat' );
            ?>
            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?> grid-item <?php echo $item_classes; ?>">
                 <div class="tp-project-thumb mb-25">
                    <?php if ( has_post_thumbnail() ): ?>
                        <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
                    <?php endif; ?>
                    <div class="tp-project-thumb-info">
                       <p class="tp-el-rep-sub-title"><?php echo $item_cat_names ; ?></p>
                       <h4 class="tp-project-thumb-title tp-el-rep-title"> <a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                    </div>
                 </div>
            </div>
            <?php endwhile; wp_reset_query(); ?>
        </div>
    </div>
</div>

<?php elseif ( $settings['tp_design_style']  == 'layout-3' ): 
    $this->add_render_attribute('title_args', 'class', 'tp-section-title tp-el-title');
?>
<div class="portfolio-area pt-100 pb-90 tp-el-section">
    <div class="container">
        
        <?php if( !empty($filter_list) ) : ?>
        <div class="row">
          <div class="col-lg-4">
             <div class="tp-project-title-wrapper-2 mb-60">
                <?php if ( !empty($settings['tp_section_sub_title']) ) : ?>
                <span class="tp-section-title-pre tp-el-sub-title"><?php echo tp_kses( $settings['tp_section_sub_title'] ); ?></span>
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
          </div>
            <div class="col-lg-8">
                <div class="tp-project-tab-wrapper tab-wrapper-2 d-flex justify-content-end">
                    <ul class="nav nav-pills mb-60 wow fadeInUp masonary-menu" data-wow-duration="1s" data-wow-delay=".3s" id="pills-tab" role="tablist">
                        <?php 
                        $post_type = 'tp-portfolios';
                        $count_posts = wp_count_posts( $post_type );
                        $published_posts = $count_posts->publish;
                        foreach ( $filter_list as $list ):
                            $listSTR = str_replace('-', ' ', $list);
                            if ( $portfolio_filter_btn_active === 1 ): 
                            $portfolio_filter_btn_active++; 
                        ?>

                            <li class="nav-item active"><button class="nav-link tp-el-btn" data-filter="*"><span><?php echo esc_html__( 'See All','tpcore' ); ?></span></button></li>
                            <li class="nav-item"><button class="nav-link tp-el-btn" data-filter=".<?php echo esc_attr( $list ); ?>"><span><?php echo esc_html( $listSTR ); ?></span></button></li>
                            <?php else: ?>
                                <li class="nav-item"><button class="nav-link tp-el-btn" data-filter=".<?php echo esc_attr( $list ); ?>"><span><?php echo esc_html( $listSTR ); ?></span></button></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="row grid">
            <?php 
                while ($query->have_posts()) : 
                $query->the_post();
                global $post;
                $terms = get_the_terms($post->ID, 'portfolios-cat'); 
                $item_classes = '';
                $item_cat_names = '';
                $item_cats = get_the_terms( $post->ID, 'portfolios-cat' );
                if( !empty($item_cats) ):
                    $count = count($item_cats) - 1;
                    foreach($item_cats as $key => $item_cat) {
                        $item_classes .= $item_cat->slug . ' ';
                        $item_cat_names .= ( $count > $key ) ? $item_cat->name  . ', ' : $item_cat->name;
                    }
                endif; 
                $tp_portfolio_sub_thumbnail = function_exists('get_field') ? get_field('tp-portfolio_sub_thumbnail') : '';
                $categories = get_the_terms( $post->ID, 'portfolios-cat' );
            ?>
            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?> grid-item <?php echo $item_classes; ?>">
                 <div class="tp-project-thumb mb-25">
                    <?php if ( has_post_thumbnail() ): ?>
                        <?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?>
                    <?php endif; ?>
                    <div class="tp-project-thumb-info">
                       <p class="tp-el-rep-sub-title"><?php echo $item_cat_names ; ?></p>
                       <h4 class="tp-project-thumb-title tp-el-rep-title"> <a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                    </div>
                 </div>
            </div>
            <?php endwhile; wp_reset_query(); ?>
        </div>
    </div>
</div>

<?php else: ?>

<div class="portfolio-area pt-100 pb-90 tp-el-section">
    <div class="container">
        
        <?php if( !empty($filter_list) ) : ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="tp-project-tab-wrapper d-flex justify-content-center portfolio-filter">
                    <ul class="nav nav-pills mb-60 wow fadeInUp masonary-menu" data-wow-duration="1s" data-wow-delay=".3s" id="pills-tab" role="tablist">
                        <?php 
                        $post_type = 'tp-portfolios';
                        $count_posts = wp_count_posts( $post_type );
                        $published_posts = $count_posts->publish;
                        foreach ( $filter_list as $list ):
                            $listSTR = str_replace('-', ' ', $list);
                            if ( $portfolio_filter_btn_active === 1 ): 
                            $portfolio_filter_btn_active++; 
                        ?>

                            <li class="nav-item active"><button class="nav-link tp-el-btn" data-filter="*"><span><?php echo esc_html__( 'See All','tpcore' ); ?></span></button></li>
                            <li class="nav-item"><button class="nav-link tp-el-btn" data-filter=".<?php echo esc_attr( $list ); ?>"><span><?php echo esc_html( $listSTR ); ?></span></button></li>
                            <?php else: ?>
                                <li class="nav-item"><button class="nav-link tp-el-btn" data-filter=".<?php echo esc_attr( $list ); ?>"><span><?php echo esc_html( $listSTR ); ?></span></button></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="row grid">
            <?php 
                while ($query->have_posts()) : 
                $query->the_post();
                global $post;
                $terms = get_the_terms($post->ID, 'portfolios-cat'); 
                $item_classes = '';
                $item_cat_names = '';
                $item_cats = get_the_terms( $post->ID, 'portfolios-cat' );
                if( !empty($item_cats) ):
                    $count = count($item_cats) - 1;
                    foreach($item_cats as $key => $item_cat) {
                        $item_classes .= $item_cat->slug . ' ';
                        $item_cat_names .= ( $count > $key ) ? $item_cat->name  . ', ' : $item_cat->name;
                    }
                endif; 
                $tp_portfolio_sub_thumbnail = function_exists('get_field') ? get_field('tp-portfolio_sub_thumbnail') : '';
                $categories = get_the_terms( $post->ID, 'portfolios-cat' );
            ?>
            <div class="col-xl-<?php echo esc_attr($settings['tp_col_for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tp_col_for_laptop']); ?> col-md-<?php echo esc_attr($settings['tp_col_for_tablet']); ?> col-<?php echo esc_attr($settings['tp_col_for_mobile']); ?> grid-item <?php echo $item_classes; ?>">
                 <div class="tp-project-item-3 text-center mb-40">
                    <?php if ( has_post_thumbnail() ): ?>
                    <div class="tp-project-thumb-3">
                       <a href="<?php the_permalink();?>"><?php the_post_thumbnail( 'full', ['class' => 'img-responsive'] );?></a>
                    </div>
                    <?php endif; ?>
                    <div class="tp-project-content-3">
                       <span class="tp-el-rep-sub-title"><?php echo $item_cat_names ; ?></span>
                       <h3 class="tp-project-title-3 tp-el-rep-title"> <a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    </div>
                 </div>
            </div>
            <?php endwhile; wp_reset_query(); ?>
        </div>
    </div>
</div>

<?php endif;
	}

}

$widgets_manager->register( new TP_Portfolio_Post() );