<?php

/**
 * The template for displaying search results pages
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="search-wrapper">

    <div class="<?php echo esc_attr($container); ?> vd-container" id="content" tabindex="-1">

        <div class="row">

            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <main class="site-main col order-2" id="main">
                <?php
                if (have_posts()) {
                ?>
                    <header class="page-header block-primary">
                        <h1 class="page-title text-uppercase">
                            <?php
                            printf(
                                esc_html__('Search Results for: %s', 'justg'),
                                '<span>' . esc_html(get_search_query()) . '</span>'
                            );
                            ?>
                        </h1>
                    </header><!-- .page-header -->
                    <?php
                }
                $vd_archive_show_banner = false;
                get_template_part('loop-templates/content', 'archive');
                ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #search-wrapper -->

<?php
get_footer();

