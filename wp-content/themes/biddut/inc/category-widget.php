<?php
// ==============================
// Custom Categories Widget
// ==============================
class TP_Custom_Categories_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'tp_custom_categories', // Base ID
            __('TP: Blog Categories', 'textdomain'),
            array( 'description' => __( 'Display post categories with custom design', 'textdomain' ) )
        );
    }

    // Frontend Output
    public function widget( $args, $instance ) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Categories', 'textdomain');

        echo $args['before_widget'];
        if ( $title ) echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

        $categories = get_categories( array(
            'taxonomy'   => 'category',
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => true,
        ) );

        if ( !empty($categories) ) :
            echo '<div class="sidebar__widget-content">';
            echo '<ul>';
            foreach ( $categories as $cat ) {
                $cat_link = get_category_link( $cat->term_id );
                $active = ( is_category($cat->term_id) ) ? ' class="active"' : '';
                echo '<li' . $active . '><a href="' . esc_url( $cat_link ) . '">' . esc_html( $cat->name ) . '<span><i class="fa-sharp fa-solid fa-arrow-right"></i></span></a></li>';
            }
            echo '</ul>';
            echo '</div>';
        endif;

        echo $args['after_widget'];
    }

    // Backend Form
    public function form( $instance ) {
        $title = isset($instance['title']) ? $instance['title'] : __('Categories', 'textdomain');
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    // Save Form Data
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        return $instance;
    }
}

// Register the widget
function tp_register_custom_categories_widget() {
    register_widget( 'TP_Custom_Categories_Widget' );
}
add_action( 'widgets_init', 'tp_register_custom_categories_widget' );
