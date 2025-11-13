<?php
/**
 * Template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package biddut
 */

get_header();

// Check if sidebar is active
$blog_column = is_active_sidebar('blog-sidebar') ? 8 : 12;
?>

<section class="tp-postbox-area pt-120 pb-120">
    <div class="container">
        <div class="row">

            <!-- Main Content -->
            <div class="col-xxl-<?php echo esc_attr($blog_column); ?> col-xl-<?php echo esc_attr($blog_column); ?> col-lg-<?php echo esc_attr($blog_column); ?>">
                <div class="tp-postbox-wrapper">
                    <div class="postbox__wrapper blog__wrapper postbox__details mb-50">

                        <?php
                        while (have_posts()) :
                            the_post();

                            // Load content by format
                            get_template_part('template-parts/content', get_post_format());
                        ?>

                            <!-- Post Navigation -->
                            <?php if (get_previous_post_link() || get_next_post_link()) : ?>
                                <div class="blog-details-border mt-60 mb-60">
                                    <div class="row align-items-center">

                                        <?php if (get_previous_post_link()) : ?>
                                            <div class="col-md-6">
                                                <div class="theme-navigation b-prev-post mb-30">
                                                    <span><?php esc_html_e('Prev Post', 'biddut'); ?></span>
                                                    <h4><?php previous_post_link('%link', '%title'); ?></h4>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (get_next_post_link()) : ?>
                                            <div class="col-md-6 text-md-end">
                                                <div class="theme-navigation b-next-post mb-30">
                                                    <span><?php esc_html_e('Next Post', 'biddut'); ?></span>
                                                    <h4><?php next_post_link('%link', '%title'); ?></h4>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Author Bio -->
                            <?php get_template_part('template-parts/biography'); ?>

                            <!-- Comments -->
                            <?php
                            if (comments_open() || get_comments_number()) :
                                comments_template();
                            endif;

                        endwhile; // End of the loop.
                        ?>

                    </div>
                </div>
            </div>
            <!-- /Main Content -->

            <!-- Sidebar -->
            <?php if (is_active_sidebar('blog-sidebar')) : ?>
                <div class="col-lg-4">
                    <div class="tp-sidebar-wrapper">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- /Sidebar -->

        </div>
    </div>
</section>

<?php get_footer(); ?>
