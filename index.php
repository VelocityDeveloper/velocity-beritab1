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

$container = velocitytheme_option('justg_container_type', 'container');
$headline_post = velocitytheme_option('headline_post');
$carousel1  = velocitytheme_option('post_carousel_home1');
$carousel2  = velocitytheme_option('post_carousel_home2');
$gridpost1  = velocitytheme_option('post_grid1');
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
                        <article class="block-primary mb-4 border-bottom">
                            <?php if ($postcount === 1) : ?>
                                <div class="post-tumbnail position-relative">
                                    <div class="ratio ratio-16x9 rounded rounded-3 bg-light overflow-hidden">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                            echo '<a href="' . get_the_permalink() . '"><img src="' . $img_atr[0] . '" alt="' . get_the_title() . '" /></a>';
                                        } else {
                                            echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="' . $width . '" height="' . $height . '"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g> </svg>';
                                        } ?>
                                    </div>
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
                                            <div class="ratio ratio-16x9 rounded rounded-3 bg-light overflow-hidden">
                                                <?php
                                                if (has_post_thumbnail()) {
                                                    $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                                                    echo '<a href="' . get_the_permalink() . '"><img src="' . $img_atr[0] . '" alt="' . get_the_title() . '" loading="lazy"/></a>';
                                                } else {
                                                    echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="' . $width . '" height="' . $height . '"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g> </svg>';
                                                } ?>
                                            </div>
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
                <div class="text-center"><?php justg_pagination(); ?></div>

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
