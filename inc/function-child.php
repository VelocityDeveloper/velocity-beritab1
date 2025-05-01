<?php

/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
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

add_action('after_setup_theme', 'velocitychild_theme_setup', 9);
function velocitychild_theme_setup()
{


    if (class_exists('Kirki')) :

        /**
         * Customizer control in child themes
         * Sample Panel
         * 
         */
        Kirki::add_panel('panel_berita', [
            'priority'    => 10,
            'title'       => esc_html__('Berita Setting', 'justg'),
            'description' => esc_html__('', 'justg'),
        ]);

        // section color
        Kirki::add_section('vd_theme_color', [
            'panel'    => 'panel_berita',
            'title'    => __('Theme Color', 'justg'),
            'priority' => 10,
        ]);
        Kirki::add_field('justg_config', [
            'type'        => 'color',
            'settings' => 'vd_color_setting',
            'label' => esc_html__('Color Theme', 'kirki'),
            'description' => esc_html__('', 'kirki'),
            'section' => 'vd_theme_color',
            'default' => '#ff5722',
            'transport' => 'auto',
            'output' => [
                [
                    'element'   => ':root',
                    'property'  => '--color-theme',
                ],
                [
                    'element'   => '.border-color-theme',
                    'property'  => '--bs-border-color',
                ]
            ],
        ]);

        // Section Iklan Float
        Kirki::add_section('iklan_float', [
            'panel'    => 'panel_berita',
            'title'    => __('Iklan Float', 'justg'),
            'priority' => 10,
        ]);
        Kirki::add_field('justg_config', [
            'type'        => 'toggle',
            'settings'    => 'iklan_float_setting',
            'label'       => esc_html__('Aktifkan Iklan Float', 'kirki'),
            'section'     => 'iklan_float',
            'default'     => '1',
            'priority'    => 10,
        ]);
        Kirki::add_field('justg_config', [
            'type'        => 'image',
            'settings'    => 'img_iklan_float_left',
            'label'       => esc_html__('Image Iklan Kiri', 'kirki'),
            'description' => esc_html__('', 'kirki'),
            'section'     => 'iklan_float',
            'default'     => '',
        ]);
        Kirki::add_field('justg_config', [
            'type'        => 'image',
            'settings'    => 'img_iklan_float_right',
            'label'       => esc_html__('Image Iklan Kanan', 'kirki'),
            'description' => esc_html__('', 'kirki'),
            'section'     => 'iklan_float',
            'default'     => '',
        ]);


        // Section Iklan
        Kirki::add_section('setting_banner', [
            'panel'    => 'panel_berita',
            'title'    => __('Banner Setting', 'justg'),
            'priority' => 10,
        ]);
        Kirki::add_field('justg_config', [
            'type'        => 'image',
            'settings'    => 'banner_header1',
            'label'       => esc_html__('Banner Header1', 'kirki'),
            'description' => esc_html__('', 'kirki'),
            'section'     => 'setting_banner',
            'default'     => '',
        ]);
        Kirki::add_field('justg_config', [
            'type'        => 'image',
            'settings'    => 'banner_header2',
            'label'       => esc_html__('Banner Header2', 'kirki'),
            'description' => esc_html__('', 'kirki'),
            'section'     => 'setting_banner',
            'default'     => '',
        ]);
        Kirki::add_field('justg_config', [
            'type'        => 'image',
            'settings'    => 'banner_arsip',
            'label'       => esc_html__('Banner Archive', 'kirki'),
            'description' => esc_html__('', 'kirki'),
            'section'     => 'setting_banner',
            'default'     => '',
        ]);
        Kirki::add_field('justg_config', [
            'type'        => 'image',
            'settings'    => 'banner_single1',
            'label'       => esc_html__('Banner Single', 'kirki'),
            'description' => esc_html__('Tampil di bawah feature image.', 'kirki'),
            'section'     => 'setting_banner',
            'default'     => '',
        ]);
        Kirki::add_field('justg_config', [
            'type'        => 'image',
            'settings'    => 'banner_single2',
            'label'       => esc_html__('Banner Single', 'kirki'),
            'description' => esc_html__('Tampil di bawah konten.', 'kirki'),
            'section'     => 'setting_banner',
            'default'     => '',
        ]);
        Kirki::add_field('justg_config', [
            'type'        => 'image',
            'settings'    => 'banner_home1',
            'label'       => esc_html__('Banner Home', 'kirki'),
            'description' => esc_html__('Tampil di bawah slide pertama.', 'kirki'),
            'section'     => 'setting_banner',
            'default'     => '',
        ]);
        Kirki::add_field('justg_config', [
            'type'        => 'image',
            'settings'    => 'banner_home2',
            'label'       => esc_html__('Banner Home', 'kirki'),
            'description' => esc_html__('', 'kirki'),
            'section'     => 'setting_banner',
            'default'     => '',
        ]);


        // Section Berita Home
        Kirki::add_section('setting_homepost', [
            'panel'    => 'panel_berita',
            'title'    => __('Berita Home', 'justg'),
            'priority' => 10,
        ]);
        Kirki::add_field('justg_config', [
            'type'  => 'select',
            'settings'  => 'headline_post',
            'label'     => esc_html__('Headline Post', 'kirki'),
            'section'   => 'setting_homepost',
            'default'   => '',
            'placeholder' => esc_html__('Pilih Kategori', 'kirki'),
            'priority'  => 10,
            'multiple'  => 1,
            'choices'   => velocity_categories(),
        ]);
        Kirki::add_field('justg_config', [
            'type'  => 'select',
            'settings'  => 'post_carousel_home1',
            'label'     => esc_html__('Post Carousel', 'kirki'),
            'section'   => 'setting_homepost',
            'default'   => '',
            'placeholder' => esc_html__('Pilih Kategori', 'kirki'),
            'priority'  => 10,
            'multiple'  => 1,
            'choices'   => velocity_categories(),
        ]);
        Kirki::add_field('justg_config', [
            'type'  => 'select',
            'settings'  => 'post_carousel_home2',
            'label'     => esc_html__('Post Carousel', 'kirki'),
            'section'   => 'setting_homepost',
            'default'   => '',
            'placeholder' => esc_html__('Pilih Kategori', 'kirki'),
            'priority'  => 10,
            'multiple'  => 1,
            'choices'   => velocity_categories(),
        ]);
        Kirki::add_field('justg_config', [
            'type'  => 'select',
            'settings'  => 'post_grid1',
            'label'     => esc_html__('Post Grid Home', 'kirki'),
            'section'   => 'setting_homepost',
            'default'   => '',
            'placeholder' => esc_html__('Pilih Kategori', 'kirki'),
            'priority'  => 10,
            'multiple'  => 1,
            'choices'   => velocity_categories(),
        ]);

    ///Section Sosmed
    // Kirki::add_section('section_sosmedberita', [
    //     'panel'    => 'panel_berita',
    //     'title'    => __('Sosial Media', 'justg'),
    //     'priority' => 10,
    // ]);
    // $fieldsosmed = [
    //     'facebook'  => [
    //         'label'    => 'Facebook',
    //     ],
    //     'twitter'  => [
    //         'label'    => 'Twitter',
    //     ],
    //     'instagram'  => [
    //         'label'    => 'Instagram',
    //     ],
    //     'youtube'  => [
    //         'label'    => 'Youtube',
    //     ]
    // ];
    // foreach ($fieldsosmed as $idfield => $datafield) {
    //     Kirki::add_field('justg_config', [
    //         'type'     => 'link',
    //         'settings' => 'link_sosmed_' . $idfield,
    //         'label'    => __('Link ' . $datafield['label'], 'kirki'),
    //         'section'  => 'section_sosmedberita',
    //         'default'  => 'https://' . $idfield . '.com/',
    //         'priority' => 10,
    //     ]);
    // }

    endif;

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
        if (true == velocitytheme_option('iklan_float_setting', true)) :
            $imgiklan    = velocitytheme_option('img_iklan_float_' . $keye);
            if ($imgiklan) :
                echo '<div class="iklanfloating" data-pos="' . $keye . '" data-container="' . $widthcon . '">';
                echo '<div class="position-relative">';
                echo '<div class="close-iklan position-absolute top-0 end-0">Tutup</div>';
                echo '<span><img src="' . $imgiklan . '" loading="lazy"></span>';
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
    $img = velocitytheme_option($sett);
    if ($img) :
        $banner = '<div class="text-center"><img src="' . $img . '" /></div>';
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
    <nav class="container p-0 navigation post-navigation block-primary">
        <h2 class="sr-only"><?php esc_html_e('Post navigation', 'justg'); ?></h2>
        <div class="d-flex py-2 nav-links justify-content-between post-nav border-top border-bottom">
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
                <div class="relate-thumb ratio ratio-16x9">
                    <?php
                    if (has_post_thumbnail()) {
                        $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                        echo '<img class="rounded rounded-2" src="' . $img_atr[0] . '" alt="' . get_the_title() . '" />';
                    } else {
                        echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="' . $width . '" height="' . $height . '"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g> </svg>';
                    }
                    ?>
                </div>
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
                <div class="relate-thumb ratio ratio-16x9">
                    <?php
                    if (has_post_thumbnail()) {
                        $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                        echo '<img class="rounded rounded-2" src="' . $img_atr[0] . '" alt="' . get_the_title() . '" />';
                    } else {
                        echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="' . $width . '" height="' . $height . '"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g> </svg>';
                    }
                    ?>
                </div>
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
            <div class="row mb-2">
                <div class="col-12 col-md-4">
                    <div class="post-tumbnail position-relative">
                        <div class="ratio ratio-16x9 rounded rounded-3 bg-light overflow-hidden">
                            <?php
                            if (has_post_thumbnail()) {
                                $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                                echo '<img src="' . $img_atr[0] . '" alt="' . get_the_title() . '" loading="lazy"/>';
                            } else {
                                echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="' . $width . '" height="' . $height . '"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g> </svg>';
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="col px-md-0 p-2">
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
                        <small class="ms-2" style="color:#787878;">
                            <?php echo get_the_date(); ?>
                        </small>
                        <?php
                        the_title(
                            sprintf('<h2 class="h6 mb-md-2 fw-bold"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                            '</a></h2>'
                        );
                        ?>
                        <div class="post-excerpt text-muted">
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
    $query_args = array(
        'post_type' => 'post',
        'posts_per_page'  => $limit,
        'cat' => $idcat,
    );
    $myquery = new WP_Query($query_args);
    // The Loop
    if ($myquery->have_posts()) :
        echo '<div class="related-post block-primary py-3">';
        echo '<span class="fw-bold text-uppercase">' . get_cat_name($idcat) . '</span>';
        echo '<div class="row m-0 mt-3">';
        while ($myquery->have_posts()) :
            $myquery->the_post(); ?>
            <div class="col-md-4 col-6 px-md-2 p-2">
                <div class="relate-thumb ratio ratio-16x9">
                    <?php
                    if (has_post_thumbnail()) {
                        $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                        echo '<img class="rounded rounded-2" src="' . $img_atr[0] . '" alt="' . get_the_title() . '" />';
                    } else {
                        echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="' . $width . '" height="' . $height . '"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g> </svg>';
                    }
                    ?>
                </div>
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
