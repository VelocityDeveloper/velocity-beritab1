<?php

/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('velocitychild_get_option')) {
    function velocitychild_get_option($setting, $default = '')
    {
        return function_exists('velocitytheme_option')
            ? velocitytheme_option($setting, $default)
            : get_theme_mod($setting, $default);
    }
}

if (!function_exists('velocitychild_post_thumbnail')) {
    function velocitychild_post_thumbnail($post_id = null, $size = 'large', $ratio = '16x9', $class = '')
    {
        $post_id = $post_id ?: get_the_ID();
        $title   = get_the_title($post_id);
        $image   = get_the_post_thumbnail_url($post_id, $size);
        $image   = $image ?: get_stylesheet_directory_uri() . '/img/no-image.webp';

        return sprintf(
            '<div class="ratio ratio-%1$s overflow-hidden %2$s"><a class="d-block w-100 h-100" href="%3$s" aria-label="%4$s"><img class="w-100 h-100 object-fit-cover" src="%5$s" alt="%6$s" loading="lazy"></a></div>',
            esc_attr($ratio), esc_attr(trim($class)), esc_url(get_permalink($post_id)),
            esc_attr($title), esc_url($image), esc_attr($title)
        );
    }
}

if (!function_exists('velocitychild_icon')) {
    function velocitychild_icon($name, $class = '')
    {
        $icons = [
            'search'   => '<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>',
            'calendar' => '<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>',
            'eye'      => '<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8C2.46 5.96 4.76 3.5 8 3.5S13.54 5.96 14.827 8C13.54 10.04 11.24 12.5 8 12.5S2.46 10.04 1.173 8"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5"/>',
            'chat'     => '<path d="M2.678 11.894 1.4 14.443a.5.5 0 0 0 .66.68l2.694-1.207A7 7 0 1 0 2.678 11.894M8 14a6 6 0 1 1 0-12 6 6 0 0 1 0 12"/>',
            'x'        => '<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>',
            'facebook' => '<path d="M16 8.049C16 3.603 12.418 0 8 0S0 3.603 0 8.049C0 12.067 2.925 15.397 6.75 16v-5.624H4.718V8.049H6.75V6.276c0-2.017 1.194-3.131 3.022-3.131.875 0 1.79.157 1.79.157v1.981h-1.009c-.994 0-1.303.621-1.303 1.258v1.508h2.219l-.355 2.327H9.25V16C13.075 15.397 16 12.067 16 8.049"/>',
            'twitter'  => '<path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q0-.211-.006-.423A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.084.797A3.286 3.286 0 0 0 7.875 6.03 9.32 9.32 0 0 1 1.108 2.6a3.29 3.29 0 0 0 1.016 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115q-.312 0-.617-.06a3.28 3.28 0 0 0 3.067 2.277A6.59 6.59 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15"/>',
            'telegram' => '<path d="M16 3.038c0-.987-.905-1.692-1.822-1.338L.986 6.786c-1.288.497-1.263 1.303-.218 1.624l3.385 1.057 7.836-4.945c.37-.225.71-.104.432.143l-6.35 5.733-.247 3.69c.362 0 .522-.166.724-.364l1.738-1.69 3.617 2.67c.667.368 1.145.179 1.311-.619z"/>',
            'whatsapp' => '<path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93a7.9 7.9 0 0 0-2.327-5.607M7.998 14.521a6.56 6.56 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.25a6.56 6.56 0 1 1 5.58 3.093m3.6-4.922c-.197-.099-1.17-.578-1.353-.642-.181-.066-.314-.099-.445.099-.133.197-.512.642-.63.775-.115.132-.23.148-.428.05-.197-.1-.833-.307-1.587-.98a6 6 0 0 1-1.097-1.364c-.115-.198-.012-.305.087-.403.088-.088.197-.23.296-.346.1-.115.132-.197.197-.33.066-.132.033-.247-.016-.346-.05-.099-.445-1.074-.611-1.47-.16-.389-.323-.335-.445-.34h-.38a.73.73 0 0 0-.528.247c-.181.198-.692.677-.692 1.654s.71 1.916.81 2.049c.098.132 1.397 2.132 3.383 2.992.473.205.842.327 1.13.418.475.151.907.13 1.25.079.38-.058 1.171-.48 1.337-.943.164-.462.164-.858.115-.943-.05-.082-.181-.13-.38-.23"/>',
        ];

        if (!isset($icons[$name])) {
            return '';
        }

        return '<svg class="bi ' . esc_attr($class) . '" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg">' . $icons[$name] . '</svg>';
    }
}

function velocity_categories()
{
    $args = array(
        'orderby' => 'name',
        'hide_empty' => false,
    );
    $cats = array(
        '' => 'Show All'
    );
    $categories = get_categories($args);
    foreach ($categories as $category) {
        $cats[$category->term_id] = $category->name;
    }
    return $cats;
}

function vdcari()
{
    ob_start(); ?>
    <div class="pencarian">
        <form role="search" method="get" class="search-form input-group" action="<?php echo esc_url(home_url('/')); ?>">
            <label class="visually-hidden" for="header-search"><?php esc_html_e('Search', 'justg'); ?></label>
            <input id="header-search" type="search" name="s" class="form-control" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php esc_attr_e('Search', 'justg'); ?>" required>
            <button type="submit" class="btn btn-search gradient-theme bg-color-theme text-white"><?php echo velocitychild_icon('search'); ?></button>
        </form>
    </div>
<?php
    return ob_get_clean();
}

function vddate()
{
    ob_start();
    $date   = date('F j, Y', current_time('timestamp', 0));

    echo '<div class="tgl-web">' . $date . '</div>';
    return ob_get_clean();
}

function vdpost_marquee($args = [])
{
    ob_start();
    $defaults = [
        'category' => velocitychild_get_option('headline_post'),
        'limit'    => 5,
    ];
    $args = array_merge($defaults, is_array($args) ? $args : []);
    $category   = $args['category'];
    $limit      = $args['limit'];

    $query_args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $limit,
    );

    if ($category) :
        $query_args['tax_query'] = [[
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $category,
        ]];
    endif;
    $the_query = new WP_Query($query_args);
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

    wp_reset_postdata();
    return ob_get_clean();
}

function vdshare($content = '')
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
        $content .= '<a class="btn btn-sm rounded-circle text-white me-2 mb-1 btn-facebook" href="' . $facebookURL . '" target="_blank" rel="nofollow" data-id="' . $post->ID . '"><span>' . velocitychild_icon('facebook') . '</span></a>';
        $content .= '<a class="btn btn-sm rounded-circle text-white me-2 mb-1 btn-twitter" href="' . $twitterURL . '" target="_blank" rel="nofollow" data-id="' . $post->ID . '"><span>' . velocitychild_icon('twitter') . '</span></a>';
        $content .= '<a class="btn btn-sm rounded-circle text-white me-2 mb-1 btn-telegram" href="' . $teleramURL . '" target="_blank" rel="nofollow" data-id="' . $post->ID . '"><span>' . velocitychild_icon('telegram') . '</span></a>';
        $content .= '<a class="btn btn-sm rounded-circle text-white me-2 mb-1 btn-whatsapp" href="' . $whatsappURL . '" target="_blank" rel="nofollow" data-id="' . $post->ID . '"><span>' . velocitychild_icon('whatsapp') . '</span></a>';
        $content .= '</div></div>';

        return $content;
    }

    return $content;
}

function vdpencarian()
{
    ob_start(); ?>
    <div class="text-end">
        <div class="vdcari">
            <button class="tombols" type="button" aria-label="<?php esc_attr_e('Toggle search', 'justg'); ?>">
                <span class="search-symbol"><?php echo velocitychild_icon('search'); ?></span>
                <span class="close-symbol d-none"><?php echo velocitychild_icon('x'); ?></span>
            </button>
            <form method="get" id="searchform" class="search-head" action="<?php echo esc_url(home_url('/')); ?>" role="search">
                <div class="input-group">
                    <input class="search-input" id="s" name="s" type="text" placeholder="<?php esc_attr_e('Search&hellip;', 'vsstem'); ?>" value="<?php the_search_query(); ?>" required>
                    <button class="search-button" type="submit">
                        <?php echo velocitychild_icon('search'); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php return ob_get_clean();
}

function velocitychild_sanitize_checkbox($value)
{
    return $value ? 1 : 0;
}

function velocitychild_sanitize_category($value)
{
    if ($value === '' || $value === null) {
        return '';
    }

    $value = absint($value);
    if ($value === 0) {
        return '';
    }

    $choices = velocity_categories();
    return array_key_exists($value, $choices) ? $value : '';
}

function velocitychild_customize_register_berita(WP_Customize_Manager $wp_customize)
{
    $wp_customize->add_panel('panel_berita', [
        'priority'    => 10,
        'title'       => esc_html__('Berita Setting', 'justg'),
        'description' => '',
    ]);

    $wp_customize->add_section('iklan_float', [
        'panel'    => 'panel_berita',
        'title'    => __('Iklan Float', 'justg'),
        'priority' => 10,
    ]);

    $wp_customize->add_setting('iklan_float_setting', [
        'default'           => 1,
        'sanitize_callback' => 'velocitychild_sanitize_checkbox',
    ]);

    $wp_customize->add_control('iklan_float_setting', [
        'type'     => 'checkbox',
        'label'    => esc_html__('Aktifkan Iklan Float', 'justg'),
        'section'  => 'iklan_float',
        'priority' => 10,
    ]);

    $wp_customize->add_setting('img_iklan_float_left', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'img_iklan_float_left', [
        'label'       => esc_html__('Image Iklan Kiri', 'justg'),
        'description' => '',
        'section'     => 'iklan_float',
        'priority'    => 20,
    ]));

    $wp_customize->add_setting('img_iklan_float_right', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'img_iklan_float_right', [
        'label'       => esc_html__('Image Iklan Kanan', 'justg'),
        'description' => '',
        'section'     => 'iklan_float',
        'priority'    => 30,
    ]));

    $wp_customize->add_section('setting_banner', [
        'panel'    => 'panel_berita',
        'title'    => __('Banner Setting', 'justg'),
        'priority' => 10,
    ]);

    $wp_customize->add_setting('banner_header1', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'banner_header1', [
        'label'       => esc_html__('Banner Header1', 'justg'),
        'description' => '',
        'section'     => 'setting_banner',
        'priority'    => 10,
    ]));

    $wp_customize->add_setting('banner_header2', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'banner_header2', [
        'label'       => esc_html__('Banner Header2', 'justg'),
        'description' => '',
        'section'     => 'setting_banner',
        'priority'    => 20,
    ]));

    $wp_customize->add_setting('banner_arsip', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'banner_arsip', [
        'label'       => esc_html__('Banner Archive', 'justg'),
        'description' => '',
        'section'     => 'setting_banner',
        'priority'    => 30,
    ]));

    $wp_customize->add_setting('banner_single1', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'banner_single1', [
        'label'       => esc_html__('Banner Single', 'justg'),
        'description' => esc_html__('Tampil di bawah feature image.', 'justg'),
        'section'     => 'setting_banner',
        'priority'    => 40,
    ]));

    $wp_customize->add_setting('banner_single2', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'banner_single2', [
        'label'       => esc_html__('Banner Single', 'justg'),
        'description' => esc_html__('Tampil di bawah konten.', 'justg'),
        'section'     => 'setting_banner',
        'priority'    => 50,
    ]));

    $wp_customize->add_setting('banner_home1', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'banner_home1', [
        'label'       => esc_html__('Banner Home', 'justg'),
        'description' => esc_html__('Tampil di bawah slide pertama.', 'justg'),
        'section'     => 'setting_banner',
        'priority'    => 60,
    ]));

    $wp_customize->add_setting('banner_home2', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'banner_home2', [
        'label'       => esc_html__('Banner Home', 'justg'),
        'description' => '',
        'section'     => 'setting_banner',
        'priority'    => 70,
    ]));

    $wp_customize->add_section('setting_homepost', [
        'panel'    => 'panel_berita',
        'title'    => __('Berita Home', 'justg'),
        'priority' => 10,
    ]);

    $wp_customize->add_setting('headline_post', [
        'default'           => '',
        'sanitize_callback' => 'velocitychild_sanitize_category',
    ]);
    $wp_customize->add_control('headline_post', [
        'type'        => 'select',
        'label'       => esc_html__('Headline Post', 'justg'),
        'section'     => 'setting_homepost',
        'priority'    => 10,
        'choices'     => velocity_categories(),
    ]);

    $wp_customize->add_setting('post_carousel_home1', [
        'default'           => '',
        'sanitize_callback' => 'velocitychild_sanitize_category',
    ]);
    $wp_customize->add_control('post_carousel_home1', [
        'type'     => 'select',
        'label'    => esc_html__('Post Carousel', 'justg'),
        'section'  => 'setting_homepost',
        'priority' => 20,
        'choices'  => velocity_categories(),
    ]);

    $wp_customize->add_setting('post_carousel_home2', [
        'default'           => '',
        'sanitize_callback' => 'velocitychild_sanitize_category',
    ]);
    $wp_customize->add_control('post_carousel_home2', [
        'type'     => 'select',
        'label'    => esc_html__('Post Carousel', 'justg'),
        'section'  => 'setting_homepost',
        'priority' => 30,
        'choices'  => velocity_categories(),
    ]);

    $wp_customize->add_setting('post_grid1', [
        'default'           => '',
        'sanitize_callback' => 'velocitychild_sanitize_category',
    ]);
    $wp_customize->add_control('post_grid1', [
        'type'     => 'select',
        'label'    => esc_html__('Post Grid Home', 'justg'),
        'section'  => 'setting_homepost',
        'priority' => 40,
        'choices'  => velocity_categories(),
    ]);
}
add_action('customize_register', 'velocitychild_customize_register_berita');

function velocitychild_output_customizer_css()
{
    $color = velocitychild_get_option('primary_color', '#740106');
    $color = sanitize_hex_color($color);
    if (!$color) {
        $color = '#740106';
    }
    echo '<style>:root{--color-theme:' . esc_html($color) . ';}.border-color-theme{--bs-border-color:' . esc_html($color) . ';}</style>';
}
add_action('wp_head', 'velocitychild_output_customizer_css');

add_action('after_setup_theme', 'velocitychild_theme_setup', 9);
function velocitychild_theme_setup()
{
    $locations = array(
        'secondary-menu'   => __('Secondary Menu', 'justg'),
    );
    register_nav_menus($locations);

    //remove action from Parent Theme
    remove_action('justg_header', 'justg_header_menu');
    remove_action('justg_do_footer', 'justg_the_footer_open');
    remove_action('justg_do_footer', 'justg_the_footer_content');
    remove_action('justg_do_footer', 'justg_the_footer_close');
}


// add action builder part
add_action('justg_header', 'justg_header_berita');
function justg_header_berita()
{
    require_once(get_stylesheet_directory() . '/inc/part-header.php');
}
add_action('justg_do_footer', 'justg_footer_berita');
function justg_footer_berita()
{
    require_once(get_stylesheet_directory() . '/inc/part-footer.php');
}

///
add_action('wp_footer', 'footer_vd_additional');
function footer_vd_additional()
{
    $widthcon    = '968px';

    foreach (['left', 'right'] as $keye) {
        if (true == velocitychild_get_option('iklan_float_setting', true)) :
            $imgiklan    = velocitychild_get_option('img_iklan_float_' . $keye);
            if ($imgiklan) :
                echo '<div class="floating-media" data-pos="' . esc_attr($keye) . '" data-container="' . esc_attr($widthcon) . '">';
                echo '<div class="position-relative">';
                echo '<button type="button" class="dismiss-media position-absolute top-0 end-0 mt-3 me-3" aria-label="' . esc_attr__('Close', 'justg') . '">' . velocitychild_icon('x') . '</button>';
                echo '<span><img src="' . esc_url($imgiklan) . '" alt="" loading="lazy"></span>';
                echo '</div>';
                echo '</div>';
            endif;
        endif;
    }
}

// excerpt
function vdberita_limit_text($text, $limit)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '[...]';
    }
    return $text;
}

function vdlimit_title($text, $limit)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

// banner func
function vdbanner($sett)
{
    $banner = '';
    $img = velocitychild_get_option($sett);
    if ($img) :
        $banner = '<div class="text-center"><img src="' . esc_url($img) . '" alt="" loading="lazy"></div>';
    endif;
    return $banner;
}

function vel_post_nav()
{
    // Don't print empty markup if there's nowhere to navigate.
    $previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
    $next     = get_adjacent_post(false, '', false);

    if (!$next && !$previous) {
        return;
    }
?>
    <nav class="container p-0 navigation block-primary">
        <h2 class="visually-hidden"><?php esc_html_e('Post navigation', 'justg'); ?></h2>
        <div class="d-flex gap-3 py-2 nav-links justify-content-between post-nav border-top border-bottom">
            <?php
            if (get_previous_post_link()) {
                previous_post_link('<span class="nav-previous">%link</span>', _x('%title', 'Previous post link', 'justg'));
            }
            if (get_next_post_link()) {
                next_post_link('<span class="nav-next">%link</span>', _x('%title', 'Next post link', 'justg'));
            }
            ?>
        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}

function vdpost_related()
{
    $post_id = get_the_ID();
    $cat_ids = array();
    $categories = get_the_category($post_id);

    if (!empty($categories) && !is_wp_error($categories)) :
        foreach ($categories as $category) :
            array_push($cat_ids, $category->term_id);
        endforeach;
    endif;

    $current_post_type = get_post_type($post_id);

    $query_args = array(
        'category__in'   => $cat_ids,
        'post_type'      => $current_post_type,
        'post__not_in'    => array($post_id),
        'posts_per_page'  => '6',
    );
    $related_query = new WP_Query($query_args);
    // The Loop
    if ($related_query->have_posts()) :
        echo '<div class="related-post block-primary py-3">';
        echo '<span class="fw-bold text-uppercase">Related posts</span>';
        echo '<div class="row m-0 mt-3">';
        while ($related_query->have_posts()) :
            $related_query->the_post(); ?>
            <div class="col-md-4 col-6 px-md-2 p-2">
                <?php echo velocitychild_post_thumbnail(null, 'large', '16x9', 'rounded rounded-2 bg-light'); ?>
                <span class="fw-bold"><a href="<?php echo get_the_permalink(); ?>"><?php echo vdlimit_title(get_the_title(), 6); ?></a></span>
            </div>
        <?php
        endwhile;
        echo '</div>';
        echo '</div>';
    endif;
    wp_reset_postdata();
}

function vdpost_carousel($catid, $limit)
{
    $query_args = array(
        'post_type' => 'post',
        'posts_per_page'  => $limit,
        'cat'   => $catid,
    );
    $related_query = new WP_Query($query_args);
    // The Loop
    if ($related_query->have_posts()) :
        echo '<div class="block-primary py-3">';
        echo '<span class="fw-bold text-uppercase">' . get_cat_name($catid) . '</span>';
        echo '<div class="carousel-posts m-0 mt-3">';
        while ($related_query->have_posts()) :
            $related_query->the_post(); ?>
            <div class="carousel-items px-2">
                <?php echo velocitychild_post_thumbnail(null, 'large', '16x9', 'rounded rounded-2 bg-light'); ?>
                <span class="fw-bold"><a href="<?php echo get_the_permalink(); ?>"><?php echo vdlimit_title(get_the_title(), 6); ?></a></span>
            </div>
        <?php
        endwhile;
        echo '</div>';
        echo '</div>';
    endif;
    wp_reset_postdata();
    return;
}

function vdpost_feed($idcat, $limit)
{
    $query_args = array(
        'post_type' => 'post',
        'posts_per_page'  => $limit,
        'cat'   => $idcat,
    );
    $myquery = new WP_Query($query_args);
    // The Loop
    if ($myquery->have_posts()) :
        ?>
        <?php while ($myquery->have_posts()) : $myquery->the_post(); ?>
            <div class="row mb-3">
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
        <?php endwhile; ?>
        <?php
    endif;
    wp_reset_postdata();
    return;
}

function vdpost_grid($idcat, $limit)
{
    $limit_int = (int) $limit;
    $col_class = in_array($limit_int, [1, 3], true) ? 'col-12 col-md-4' : 'col-6 col-md-4';
    $query_args = array(
        'post_type' => 'post',
        'posts_per_page'  => $limit,
        'cat' => $idcat,
    );
    $myquery = new WP_Query($query_args);
    // The Loop
    if ($myquery->have_posts()) :
        echo '<div class="related-post block-primary py-3">';
        echo '<div class="fw-bold text-uppercase">' . get_cat_name($idcat) . '</div>';
        echo '<div class="row p-2">';
        while ($myquery->have_posts()) :
            $myquery->the_post(); ?>
            <div class="<?php echo esc_attr($col_class); ?> px-md-2 p-2">
                <?php echo velocitychild_post_thumbnail(null, 'large', '16x9', 'rounded rounded-2 bg-light'); ?>
                <span class="fw-bold"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></span>
            </div>
<?php
        endwhile;
        echo '</div>';
        echo '</div>';
    endif;
    wp_reset_postdata();

    return;
}
