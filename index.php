<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitychild_get_option('justg_container_type', 'container');
$headline_post = velocitychild_get_option('headline_post');
$carousel1  = velocitychild_get_option('post_carousel_home1');
$carousel2  = velocitychild_get_option('post_carousel_home2');
$gridpost1  = velocitychild_get_option('post_grid1');
?>

<div class="wrapper" id="index-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="row">

        <div class="content-area col-sm-8 order-2">

            <!-- Do the left sidebar check -->
            <?php //do_action('justg_before_content'); ?>

            <main class="site-main" id="main">

                <?php
                if (have_posts()) {
                    // Start the loop.
                    $postcount = 1;
                    while (have_posts()) {
                        the_post();
                 ?>
                        <article class="block-primary mb-3">
                            <?php if ($postcount === 1) : ?>
                                <div class="post-tumbnail position-relative">
                                    <?php echo velocitychild_post_thumbnail(null, 'large', '16x9', 'rounded rounded-3 bg-light'); ?>
                                    <div class="pt-2 bottom-0 end-0 start-0" style="--bs-bg-opacity: 0.90;">
                                        <small class="text-muted">
                                            <?php echo get_the_date(); ?>
                                        </small>
                                        <?php
                                        the_title(
                                            sprintf('<h2 class="h5 fw-bold"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                                            '</a></h2>'
                                        );
                                        ?>
                                        <?php echo vdberita_limit_text(strip_tags(get_the_content()), 18); ?>
                                    </div>
                                </div>
                                <div class="pt-3">
                                    <?php echo vdpost_carousel($headline_post, '6'); ?>
                                </div>
                                <?php echo vdbanner('banner_home1'); ?>
                                <div class="pt-3">
                                    <?php echo vdpost_carousel($carousel1, '6'); ?>
                                </div>
                                <?php echo '<div class="w-100">';
                                echo vdpost_feed($carousel1, '3');
                                echo vdbanner('banner_home2');
                                echo vdpost_grid($gridpost1, '3');
                                echo '</div>';
                                ?>
                            <?php else : ?>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="post-tumbnail position-relative">
                                            <?php echo velocitychild_post_thumbnail(null, 'large', '16x9', 'rounded rounded-3 bg-light'); ?>
                                        </div>
                                    </div>
                                    <div class="col px-0">
                                        <div class="post-text">
                                            <?php $categories = get_the_category(get_the_ID()); ?>
                                            <small class="text-uppercase">
                                                <?php foreach ($categories as $index => $cat) : ?>
                                                    <?php echo $index === 0 ? '' : ','; ?>
                                                    <a class="color-theme fw-bold" href="<?php echo get_tag_link($cat->term_id); ?>"> <?php echo $cat->name; ?> </a>
                                                    <?php if ($index > 1) {
                                                        break;
                                                    } ?>
                                                <?php endforeach; ?>
                                            </small>
                                            <small class="ms-2 text-muted">
                                                <?php echo get_the_date(); ?>
                                            </small>
                                            <?php
                                            the_title(
                                                sprintf('<h2 class="h6 mb-md-2 fw-bold"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                                                '</a></h2>'
                                            );
                                            ?>
                                            <div class="post-excerpt text-muted d-md-block d-none">
                                                <?php echo vdberita_limit_text(strip_tags(get_the_content()), 14); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </article>

                <?php
                        $postcount++;
                    }
                } else {
                    get_template_part('loop-templates/content', 'none');
                }
                ?>

                <!-- The pagination component -->
                <?php if (function_exists('justg_pagination')) : ?>
                    <div class="text-center"><?php justg_pagination(); ?></div>
                <?php endif; ?>

            </main><!-- #main -->
            </div>

            <div class="widget-area right-sidebar ps-md-3 col-sm-4 order-3">
                <?php do_action('justg_before_main_sidebar'); ?>
                <?php dynamic_sidebar('main-sidebar'); ?>
                <?php do_action('justg_after_main_sidebar'); ?>
            <!-- Do the right sidebar check. -->
            <?php //do_action('justg_after_content'); ?>
            </div>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
