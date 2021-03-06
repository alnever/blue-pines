<?php
/**
* The template for displaying attachement page
*
* The page displays specific post type - an attachement
*
* @package SWTK
* @subpackage blue_pines
* @since Funny Colors 1.0
*/
 ?>
<?php get_header(); ?>


  <div class="swtk-container">
    <div class="swtk-main">
        <?php get_template_part('nav'); ?>
        <?php get_template_part('head'); ?>

        <!-- header sidebar -->
        <div class="swtk-horizontal-sidebar swtk-header-sidebar">
          <?php dynamic_sidebar('header-sidebar'); ?>
        </div>

        <!-- content -->
        <div class="swtk-content">
            <!-- left sidebar -->
            <div class="swtk-vertical-sidebar swtk-left-sidebar">
                <?php wp_nav_menu([
                        'theme_location' => 'secondary',
                        'depth' => 3,
                        'container_class' => 'vertical-menu',
                    ]);
                ?>
                <?php dynamic_sidebar('left-sidebar'); ?>
            </div>
            <!-- sticky post -->

            <!-- posts -->
            <div class="swtk-posts">
                <?php if (have_posts()): the_post(); ?>
                    <div class="swtk-row">

                            <article class="swtk-post-single" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="swtk-post-image">
                                    <?php if (has_post_thumbnail()):  ?>
                                        <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                                    <?php endif; ?>
                                </div>
                                <div class="swtk-post-title">
                                    <?php
                                        if (get_the_title() == "") {
                                            echo get_the_date("F d, Y");
                                        } else {
                                            the_title();
                                        }
                                     ?>
                                </div>
                                <div class="swtk-post-author">
                                    <img class="swtk-icon" src="<?php echo get_theme_file_uri('/icons/author.svg'); ?>"/ >
                                    <?php the_author_link(); ?>
                                </div>
                                <div class="swtk-post-date">
                                    <?php the_date(); ?>
                                </div>
                                <div class="swtk-post-content">
                                    <?php if (has_excerpt()) { the_excerpt(); } ?>
                                    <?php echo wp_get_attachment_image( get_the_ID(), 'large' ); ?>
                                </div>
                                <?php if (has_category()): ?>
                                    <div class="swtk-post-categories">
                                        <img src="<?php echo get_theme_file_uri('/icons/category.svg') ?>" class="swtk-icon">
                                        <?php the_category(); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (has_tag()): ?>
                                    <div class="swtk-post-tags">
                                        <img src="<?php echo get_theme_file_uri('/icons/tags.svg') ?>" class="swtk-icon">
                                        <?php the_tags('','',''); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="swtk-post-pages">
                                    <?php wp_link_pages(); ?>
                                </div>
                            </article>
                            <!-- post pagination -->
                            <div class="swtk-posts-navigation">
                                <?php previous_post_link('%link'); ?>
                                <?php next_post_link('%link'); ?>
                            </div>
                            <!-- comments -->
                            <?php comments_template(); ?>
                    </div>
                <?php endif; ?>
            </div>
            <!-- posts -->

            <!-- right sidebar -->
            <div class="swtk-vertical-sidebar swtk-right-sidebar">
                <?php dynamic_sidebar('right-sidebar'); ?>
            </div>
        </div>

  <?php get_footer(); ?>
