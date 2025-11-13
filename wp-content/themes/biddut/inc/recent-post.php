<?php
// ==============================
// Custom Recent Posts Widget
// ==============================
class TP_Custom_Recent_Posts_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'tp_custom_recent_posts', // Base ID
            __('TP: Custom Recent Posts', 'textdomain'),
            array( 'description' => __( 'Display latest posts with thumbnail, date and title', 'textdomain' ) )
        );
    }

    // Widget front-end display
    public function widget( $args, $instance ) {
        $title  = apply_filters( 'widget_title', $instance['title'] );
        $order  = isset( $instance['order'] ) ? $instance['order'] : 'DESC';
        $count  = 3;

        echo $args['before_widget'];

        if ( ! empty( $title ) ) {
            echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
        }

        // Query recent posts
        $recent_posts = new WP_Query( array(
            'post_type'           => 'post',
            'posts_per_page'      => $count,
            'orderby'             => 'date',
            'order'               => $order,
            'ignore_sticky_posts' => true,
        ) );

        if ( $recent_posts->have_posts() ) :
            echo '<div class="sidebar__widget-content"><div class="sidebar__post">';
            while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
                <div class="rc__post mb-25 d-flex align-items-center">
                    <div class="rc__post-thumb mr-20">
                        <a href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail() ) {
                                the_post_thumbnail('thumbnail');
                            } else {
                                echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/img/blog/default.jpg') . '" alt="' . get_the_title() . '">';
                            } ?>
                        </a>
                    </div>
                    <div class="rc__post-content">
                        <div class="rc__meta">
                            <span><i class="fa-light fa-clock"></i> <?php echo get_the_date(); ?></span>
                        </div>
                        <h3 class="rc__post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                    </div>
                </div>
            <?php endwhile;
            echo '</div></div>';
            wp_reset_postdata();
        endif;

        echo $args['after_widget'];
    }

    // Widget backend form
    public function form( $instance ) {
        $title = isset( $instance['title'] ) ? $instance['title'] : __( 'Our Latest Post', 'textdomain' );
        $order = isset( $instance['order'] ) ? $instance['order'] : 'DESC';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php _e( 'Order:' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" class="widefat">
                <option value="DESC" <?php selected( $order, 'DESC' ); ?>>Descending (Newest First)</option>
                <option value="ASC" <?php selected( $order, 'ASC' ); ?>>Ascending (Oldest First)</option>
            </select>
        </p>
        <?php 
    }

    // Save widget form values
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['order'] = sanitize_text_field( $new_instance['order'] );
        return $instance;
    }
}

// Register the widget
function tp_register_custom_recent_posts_widget() {
    register_widget( 'TP_Custom_Recent_Posts_Widget' );
}
add_action( 'widgets_init', 'tp_register_custom_recent_posts_widget' );
