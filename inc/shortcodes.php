<?php

/**
 * Kumpulan shortcode yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
//[resize-thumbnail width="300" height="150" linked="true" class="w-100"]
add_shortcode('resize-thumbnail', 'resize_thumbnail');
function resize_thumbnail($atts)
{
    ob_start();
    global $post;
    $atribut = shortcode_atts(array(
        'output'    => 'image', /// image or url
        'width'        => '300', ///width image
        'height'    => '150', ///height image
        'crop'      => 'false',
        'upscale'       => 'true',
        'linked'       => 'true', ///return link to post	
        'class'       => 'w-100', ///return class name to img	
        'attachment'     => 'true'
    ), $atts);

    $output            = $atribut['output'];
    $attach         = $atribut['attachment'];
    $width          = $atribut['width'];
    $height         = $atribut['height'];
    $crop           = $atribut['crop'];
    $upscale        = $atribut['upscale'];
    $linked            = $atribut['linked'];
    $class            = $atribut['class'] ? 'class="' . $atribut['class'] . '"' : '';
    $urlimg            = get_the_post_thumbnail_url($post->ID, 'full');

    if (empty($urlimg) && $attach == 'true') {
        $attachments = get_posts(array(
            'post_type'         => 'attachment',
            'posts_per_page'     => 1,
            'post_parent'         => $post->ID,
            'orderby'          => 'date',
            'order'            => 'DESC',
        ));
        if ($attachments) {
            $urlimg = wp_get_attachment_url($attachments[0]->ID, 'full');
        }
    }

    if ($urlimg) :
        $urlresize      = aq_resize($urlimg, $width, $height, $crop, true, $upscale);
        if ($output == 'image') :
            if ($linked == 'true') :
                echo '<a href="' . get_the_permalink($post->ID) . '" title="' . get_the_title($post->ID) . '">';
            endif;
            echo '<img src="' . $urlresize . '" width="' . $width . '" height="' . $height . '" loading="lazy" ' . $class . '>';
            if ($linked == 'true') :
                echo '</a>';
            endif;
        else :
            echo $urlresize;
        endif;

    else :
        if ($linked == 'true') :
            echo '<a href="' . get_the_permalink($post->ID) . '" title="' . get_the_title($post->ID) . '">';
        endif;
        echo '<svg style="background-color: #ececec;width: 100%;height: auto;" width="' . $width . '" height="' . $height . '"></svg>';
        if ($linked == 'true') :
            echo '</a>';
        endif;
    endif;

    return ob_get_clean();
}

//[excerpt count="150"]
add_shortcode('excerpt', 'vd_getexcerpt');
function vd_getexcerpt($atts)
{
    ob_start();
    global $post;
    $atribut = shortcode_atts(array(
        'count'    => '150', /// count character
    ), $atts);

    $count        = $atribut['count'];
    $excerpt    = get_the_content();
    $excerpt     = strip_tags($excerpt);
    $excerpt     = substr($excerpt, 0, $count);
    $excerpt     = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt     = '' . $excerpt . '...';

    echo $excerpt;

    return ob_get_clean();
}

// [vd-breadcrumbs]
add_shortcode('vd-breadcrumbs', 'vd_breadcrumbs');
function vd_breadcrumbs()
{
    ob_start();
    echo justg_breadcrumb();
    return ob_get_clean();
}

//[ratio-thumbnail size="medium" ratio="16:9"]
add_shortcode('ratio-thumbnail', 'ratio_thumbnail');
function ratio_thumbnail($atts)
{
    ob_start();
    global $post;

    $atribut = shortcode_atts(array(
        'size'      => 'medium', // thumbnail, medium, large, full
        'ratio'     => '16:9', // 16:9, 8:5, 4:3, 3:2, 1:1
    ), $atts);

    $size       = $atribut['size'];
    $ratio      = $atribut['ratio'];
    $ratio      = $ratio ? str_replace(":", "-", $ratio) : '';
    $urlimg     = get_the_post_thumbnail_url($post->ID, $size);

    echo '<div class="ratio-thumbnail">';
    echo '<a class="ratio-thumbnail-link" href="' . get_the_permalink($post->ID) . '" title="' . get_the_title($post->ID) . '">';
    echo '<div class="ratio-thumbnail-box ratio-thumbnail-' . $ratio . '" style="background-image: url(' . $urlimg . ');">';
    echo '<img src="' . $urlimg . '" loading="lazy" class="ratio-thumbnail-image"/>';
    echo '</div>';
    echo '</a>';
    echo '</div>';

    return ob_get_clean();
}


// [vdcari]
add_shortcode('vdcari', 'vdcari');
function vdcari()
{
    ob_start(); ?>
    <div class="pencarian">
        <form role="search" method="get" class="search-form">
            <div class="form-group">
                <input type="text" name="s" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-sm btn-search gradient-theme bg-color-theme text-white">Search</button>
        </form>
    </div>
<?php
    return ob_get_clean();
}

// [vddate]
add_shortcode('vddate', 'vddate');
function vddate()
{
    ob_start();
    $date   = date('F j, Y', current_time('timestamp', 0));

    echo '<div class="tgl-web">' . $date . '</div>';
    return ob_get_clean();
}

// [vdpost-marquee]
add_shortcode('vdpost-marquee', 'vdpost_marquee');
function vdpost_marquee($atts)
{
    ob_start();
    $cat = velocitytheme_option('headline_post');
    $atribut = shortcode_atts(array(
        'category' => $cat,
        'limit'    => '5',
    ), $atts);
    $category   = $atribut['category'];
    $limit      = $atribut['limit'];

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $limit,
    );

    //if set category id
    if ($category) :
        $args['tax_query'] = [[
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $category,
        ]];
    endif;
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) :
        echo '<div class="headline-content gradient-theme bg-color-theme">';
        echo '<div class="text-marquee text-color-theme">Special Content</div>';
        echo '<div class="wrap-marquee">';
        echo '<div class="ticker-headline">';
        while ($the_query->have_posts()) : $the_query->the_post();
            echo '<div class="ticker-title me-2">';
            echo '<a class="text-white" href="' . get_the_permalink() . '">' . get_the_title() . '</a> - ';
            echo '</div>';
        endwhile;
        echo '</div>';
        echo '</div>';
        echo '</div>';
    endif;



    return ob_get_clean();
}

// [vdshare]
add_shortcode('vdshare', 'vdshare');
function vdshare($content = null)
{
    $content = $content ? $content : '';
    global $post;
    if (is_singular() || is_home()) {

        // Get current page URL 
        $sb_url = urlencode(get_permalink());

        // Get current page title
        $sb_title = str_replace(' ', '%20', get_the_title());

        // Construct sharing URL without using any script
        $twitterURL     = 'https://twitter.com/intent/tweet?text=' . $sb_title . '&amp;url=' . $sb_url . '&amp;via=wpvkp';
        $facebookURL    = 'https://www.facebook.com/sharer/sharer.php?u=' . $sb_url;
        $whatsappURL    = 'https://wa.me/?text=' . $sb_url . '';
        $teleramURL     = 'https://t.me/share/url?url=' . $sb_url . '';

        // Add sharing button at the end of page/page content
        $content .= '<div class="social-box text-end"><div class="social-btn">';
        $content .= '<a class="btn btn-sm rounded-circle text-white me-2 mb-1 btn-facebook" href="' . $facebookURL . '" target="_blank" rel="nofollow" data-id="' . $post->ID . '"><span><i class="bi bi-facebook" aria-hidden="true"></i></span></a>';
        $content .= '<a class="btn btn-sm rounded-circle text-white me-2 mb-1 btn-twitter" href="' . $twitterURL . '" target="_blank" rel="nofollow" data-id="' . $post->ID . '"><span><i class="bi bi-twitter" aria-hidden="true"></i></span></a>';
        $content .= '<a class="btn btn-sm rounded-circle text-white me-2 mb-1 btn-telegram" href="' . $whatsappURL . '" target="_blank" rel="nofollow" data-id="' . $post->ID . '"><span><i class="bi bi-telegram" aria-hidden="true"></i></span></a>';
        $content .= '<a class="btn btn-sm rounded-circle text-white me-2 mb-1 btn-whatsapp" href="' . $whatsappURL . '" target="_blank" rel="nofollow" data-id="' . $post->ID . '"><span><i class="bi bi-whatsapp" aria-hidden="true"></i></span></a>';
        $content .= '</div></div>';

        return $content;
    } else {
        // if not a post/page then don't include sharing button
        return $content;
    }
};

add_shortcode('vd-pencarian', 'vdpencarian');
function vdpencarian()
{
    ob_start(); ?>
    <div class="text-end">
        <div class="vdcari">
            <button class="tombols" type="button" aria-label="<?php esc_attr_e('Toggle search', 'justg'); ?>">
                <i class="bi bi-search" aria-hidden="true"></i>
            </button>
            <form method="get" id="searchform" class="search-head" action="<?php echo esc_url(home_url('/')); ?>" role="search">
                <div class="input-group">
                    <input class="search-input" id="s" name="s" type="text" placeholder="<?php esc_attr_e('Search&hellip;', 'vsstem'); ?>" value="<?php the_search_query(); ?>">
                    <button class="search-button" type="submit">
                        <i class="bi bi-search" aria-hidden="true"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php return ob_get_clean();
}
