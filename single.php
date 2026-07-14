<?php

/**
 * The template for displaying all single posts
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container  = velocitychild_get_option('justg_container_type', 'container');
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
                                    echo '<div class="ms-2 d-inline-block text-muted">';
                                    echo '<small>' . esc_html(get_the_author_meta('display_name', get_the_author_ID())) . '</small><br/>';
                                    echo '<small>' . get_the_date() . '</small>';
                                    echo '<small class="mx-2">|</small>';
                                    echo '<small><span class="view-post">' . get_post_meta(get_the_ID(), 'hit', true) . ' views</span></small>';
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
                        $caption = has_post_thumbnail() ? get_the_post_thumbnail_caption() : '';
                        echo '<figure class="featured-media py-2 mb-2">';
                        echo velocitychild_post_thumbnail(null, 'full', '16x9', 'bg-light');
                        if ($caption) {
                            echo '<figcaption class="small text-muted mt-2">' . wp_kses_post($caption) . '</figcaption>';
                        }
                        echo '</figure>';
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

                        <div class="text-end mb-3">
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
