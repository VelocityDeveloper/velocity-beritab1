<?php

/**
 * The template for displaying all single posts
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container  = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="single-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">
        <div class="row">

            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <main class="site-main col order-2" id="main">

                <?php

                while (have_posts()) {
                    the_post(); ?>
                    <article <?php post_class('block-primary'); ?> id="post-<?php the_ID(); ?>">
                        <header class="entry-header">
                            <?php
                            do_action('justg_before_title');
                            the_title('<h1 class="entry-title">', '</h1>');
                            ?>

                            <div class="row m-0 entry-meta mb-2">
                                <div class="col-md-6 col-12 p-0">
                                    <?php //justg_posted_on(); 
                                    echo '<div class="d-flex">';
                                    echo '<div class="me-2 d-inline-block"><img class="rounded rounded-5" src="' . get_avatar_url(get_the_author_ID(), array("size" => 40)) . '"/></div>';
                                    echo '<div class="ms-2 d-inline-block" style="color:#787878;">';
                                    echo '<small>' . the_author_meta('user_nicename', get_the_author_ID()) . '</small><br/>';
                                    echo '<small>' . get_the_date() . '</small>';
                                    echo '<small><span class="view-post ms-2">' . get_post_meta(get_the_ID(), 'hit', true) . ' views</span></small>';
                                    echo '</div>';
                                    echo '</div>';
                                    ?>
                                </div>
                                <div class="col-6 d-none d-md-block p-0">
                                    <?php echo vdshare(); ?>
                                </div>
                            </div><!-- .entry-meta -->

                        </header><!-- .entry-header -->

                        <?php
                        if (has_post_thumbnail($post->ID)) :
                            $full_url   = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
                            $caption    = get_the_post_thumbnail_caption();
                            echo '<div class="imgfeature-single py-2 mb-2">';
                            echo '<img class="w-100 mb-2" src="' . $full_url . '" loading="lazy">';
                            echo '<small style="color:#787878;">' . $caption . '</small></div>';
                        endif;
                        echo '<div class="mb-3 text-center">' . vdbanner('banner_single1') . '</div>';
                        ?>

                        <div class="entry-content">

                            <?php the_content(); ?>

                            <?php
                            wp_link_pages(
                                array(
                                    'before' => '<div class="page-links">' . __('Pages:', 'justg'),
                                    'after'  => '</div>',
                                )
                            );
                            ?>

                        </div><!-- .entry-content -->

                        <?php $gettags = get_the_tags(get_the_ID()); ?>
                        <?php if ($gettags) : ?>
                            <div class="post-tag mb-3">
                                <?php foreach ($gettags as $index => $tag) : ?>
                                    <a class="border me-2 px-3 py-2" style="color:#666;" href="<?php echo get_tag_link($tag->term_id); ?>"> <?php echo $tag->name; ?> </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="text-end">
                            <?php echo vdshare(); ?>
                        </div>
                    </article><!-- #post-## -->
                <?php
                    vel_post_nav();
                    vdpost_related();

                    echo '<div class="mt-3 text-center">' . vdbanner('banner_single2') . '</div>';
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) {

                        do_action('justg_before_comments');
                        comments_template();
                        do_action('justg_after_comments');
                    }
                }
                ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
