<?php

/**
 * Archive/search loop template.
 *
 * @package justg
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$vd_show_banner = isset($vd_archive_show_banner) ? (bool) $vd_archive_show_banner : false;

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
                <?php if ($vd_show_banner) : ?>
                    <div class="pt-3">
                        <?php echo vdbanner('banner_arsip'); ?>
                    </div>
                <?php endif; ?>
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
<!-- Display the pagination component. -->
<?php if (function_exists('justg_pagination')) {
    justg_pagination();
} ?>
