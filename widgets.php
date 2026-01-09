<?php

/**
 * Declaring widgets
 *
 * @package vsstem
 */

function remove_some_widgets()
{
    unregister_sidebar('footer-widget-4');
}
add_action('widgets_init', 'remove_some_widgets', 11);



/*******  Widget Velocity Recent Posts  *******/

// Creating the widget 
class velocity_posts_widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            // Base ID of your widget
            'velocity_posts_widget',

            // Widget name will appear in UI
            __('Velocity Posts', 'velocity'),

            // Widget description
            array('description' => __('Latest post widget by Velocity Developer.', 'velocity'),)
        );
    }

    // Creating widget front-end
    public function widget($args, $instance)
    {
        $idwidget   = uniqid();
        $thetitle   = isset($instance['title']) ? $instance['title'] : '';
        $title      = apply_filters('widget_title', $thetitle);
        $layoutset  = (isset($instance['layout']) && !empty($instance['layout'])) ? $instance['layout'] : '';

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        echo '<div class="widget-' . $idwidget . ' posts-widget-' . $layoutset . '">';

        if (!empty($title)) :

            echo $args['before_title'] . $title . $args['after_title'];

        endif;
        // This is where you run the code and display the output
        //The Query args
        $query_args                         = array();
        $query_args['post_type']            = 'post';
        $query_args['posts_per_page']       = (isset($instance['jumlah']) && !empty($instance['jumlah'])) ? $instance['jumlah'] : '';
        $query_args['cat']                  = (isset($instance['kategori']) && !empty($instance['kategori'])) ? $instance['kategori'] : '';
        $query_args['order']                = (isset($instance['order']) && !empty($instance['order'])) ? $instance['order'] : '';

        ///urutkan berdasarkan view
        if (isset($instance['orderby']) &&  $instance['orderby'] == "view") {
            $query_args['orderby']          = 'meta_value';
            $query_args['meta_key']         = 'hit';
        }

        // The Query
        $the_query = new WP_Query($query_args);

        // The Loop
        $i = 1;
        if ($the_query->have_posts()) {
            $class  = ($layoutset == 'gallery') ? 'row' : '';
            echo '<div class="list-posts ' . $class . '">';
            while ($the_query->have_posts()) {
                $the_query->the_post();
                $this->layoutpost($layoutset, $instance, $i);
                $i++;
            }
            echo '</div>';
        }
        /* Restore original Post Data */
        wp_reset_postdata();

        echo '</div>';


        echo $args['after_widget'];
    }

    //widget Layout Post
    public function layoutpost($layout = 'layout1', $instance, $i = null)
    {

        $kutipan    = (isset($instance['kutipan']) && !empty($instance['kutipan'])) ? $instance['kutipan'] : '';
        $viewers    = (isset($instance['viewers']) && !empty($instance['viewers'])) ? $instance['viewers'] : 'tidak';
        $viewdate   = (isset($instance['viewdate']) && !empty($instance['viewdate'])) ? $instance['viewdate'] : 'ya';

        $class      = ($layout == 'gallery') ? 'col-6 pr-2 pl-2 pb-3 pt-0' : '';

        echo '<div class="list-post list-post-' . $i . ' ' . $class . '">';

        //Layout list
        if ($layout == 'list') :
?>
            <div class="row m-0 mb-3 pb-2 border-bottom">
                <div class="col-3 p-0 thumb-post">
                    <div class="ratio ratio-4x3  rounded rounded-2 bg-light overflow-hidden">
                        <?php
                        if (has_post_thumbnail()) {
                            $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                            echo '<a href="' . get_the_permalink() . '"><img src="' . $img_atr[0] . '" alt="' . get_the_title() . '" /></a>';
                        } else {
                            echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="' . $width . '" height="' . $height . '"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g> </svg>';
                        } ?>
                    </div>
                </div>
                <div class="col-9 ps-2 p-0 content-post">
                    <small class="d-block text-muted meta-post">
                        <?php $categories = get_the_category(get_the_ID(), array('numbers' => '2')); ?>
                        <span class="text-uppercase">
                            <?php foreach ($categories as $index => $cat) : ?>
                                <?php echo $index === 0 ? '' : ','; ?>
                                <a class="color-theme fw-bold" href="<?php echo get_tag_link($cat->term_id); ?>"> <?php echo $cat->name; ?> </a>
                                <?php if ($index > 1) {
                                    break;
                                } ?>
                            <?php endforeach; ?>
                        </span><br />
                        <?php if ($viewdate == 'ya') : ?>
                            <span class="date-post"><?php echo get_the_date('F j, Y'); ?></span>
                        <?php endif; ?>

                        <?php if ($viewers == 'ya' && $viewdate == 'ya') : ?>
                            <span class="mx-1 separator">/</span>
                        <?php endif; ?>

                        <?php if ($viewers == 'ya') : ?>
                            <span class="view-post"><?php echo get_post_meta(get_the_ID(), 'hit', true); ?> views</span>
                        <?php endif; ?>
                    </small>
                    <a href="<?php echo get_the_permalink(); ?>" class="secondary-font title-post fw-bold d-block text-dark"><?php echo vdlimit_title(get_the_title(), '6'); ?></a>
                    <?php if ($kutipan != 0 && !empty($kutipan)) : ?>
                        <div class="exceprt-post">
                            <?php $content = get_the_content();
                            $trimmed_content = wp_trim_words($content, $kutipan);
                            echo $trimmed_content; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        <?php
        //Layout gallery    
        elseif ($layout == 'gallery') : ?>
            <div class="gallery-posts position-relative">
                <div class="ratio ratio-4x3  rounded rounded-2 bg-light overflow-hidden">
                    <?php
                    if (has_post_thumbnail()) {
                        $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                        echo '<a href="' . get_the_permalink() . '"><img src="' . $img_atr[0] . '" alt="' . get_the_title() . '" /></a>';
                    } else {
                        echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="' . $width . '" height="' . $height . '"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g> </svg>';
                    } ?>
                </div>
                <a href="<?php echo get_the_permalink(); ?>" class="mask-post secondary-font"><span><?php echo vdlimit_title(get_the_title(), '4'); ?></span></a>
            </div>

        <?php
        //Endif layout    
        endif;

        echo '</div>';
    }

    // Widget Backend 
    public function form($instance)
    {
        //widget data
        $title          = isset($instance['title']) ? $instance['title'] : 'New Post';
        $layout         = isset($instance['layout']) ? $instance['layout'] : '';
        $kategori       = isset($instance['kategori']) ? $instance['kategori'] : '';
        $jumlah         = isset($instance['jumlah']) ? $instance['jumlah'] : '5';
        $kutipan        = isset($instance['kutipan']) ? $instance['kutipan'] : '0';
        $orderby        = isset($instance['orderby']) ? $instance['orderby'] : '';
        $order          = isset($instance['order']) ? $instance['order'] : '';
        $viewers        = isset($instance['viewers']) ? $instance['viewers'] : '';
        $viewdate       = isset($instance['viewdate']) ? $instance['viewdate'] : 'ya';

        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Judul:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('layout'); ?>">Layout:</label>
            <select class="widefat" name="<?php echo $this->get_field_name('layout'); ?>">
                <option value="list" <?php selected($layout, "list"); ?>>List</option>
                <option value="gallery" <?php selected($layout, "gallery"); ?>>Gallery</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('kategori'); ?>">Kategori:</label>
            <select class="widefat" name="<?php echo $this->get_field_name('kategori'); ?>">
                <option value="">Semua Kategori</option>
                <?php
                $categories = get_terms(array(
                    'taxonomy'      => 'category',
                    'orderby'       => 'name',
                    'parent'        => 0,
                    'hide_empty'    => 0,
                    'exclude'       => 1,
                ));
                foreach ($categories as $category) : ?>

                    <option value="<?php echo $category->term_id; ?>" <?php selected($kategori, $category->term_id); ?>><?php echo $category->name; ?> (<?php echo $category->count; ?>)</option>

                    <?php
                    $taxonomies = array(
                        'taxonomy' => 'category'
                    );
                    $args = array(
                        'child_of'      => $category->term_id,
                        'hide_empty'    => 0,
                    );
                    $terms = get_terms($taxonomies, $args);
                    ?>
                    <?php foreach ($terms as $term) : ?>
                        <option value="<?php echo $term->term_id; ?>" <?php selected($kategori, $term->term_id); ?>>&nbsp;&nbsp;&nbsp;<?php echo $term->name; ?> (<?php echo $term->count; ?>)</option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('jumlah'); ?>">Jumlah:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('jumlah'); ?>" name="<?php echo $this->get_field_name('jumlah'); ?>" type="number" value="<?php echo esc_attr($jumlah); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>">Urutkan Berdasarkan:</label>
            <select class="widefat" name="<?php echo $this->get_field_name('orderby'); ?>">
                <option value="date" <?php selected($orderby, "date"); ?>>Tanggal</option>
                <option value="view" <?php selected($orderby, "view"); ?>>Populer</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('order'); ?>">Urutan:</label>
            <select class="widefat" name="<?php echo $this->get_field_name('order'); ?>">
                <option value="DESC" <?php selected($order, "DESC"); ?>>DESC</option>
                <option value="ASC" <?php selected($order, "ASC"); ?>>ASC</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('kutipan'); ?>">Panjang Kutipan:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('kutipan'); ?>" name="<?php echo $this->get_field_name('kutipan'); ?>" type="number" value="<?php echo esc_attr($kutipan); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('viewers'); ?>">Tampilkan views:</label>
            <select class="widefat" name="<?php echo $this->get_field_name('viewers'); ?>">
                <option value="tidak" <?php selected($viewers, "tidak"); ?>>Tidak</option>
                <option value="ya" <?php selected($viewers, "ya"); ?>>Ya</option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('viewdate'); ?>">Tampilkan tanggal:</label>
            <select class="widefat" name="<?php echo $this->get_field_name('viewdate'); ?>">
                <option value="tidak" <?php selected($viewdate, "tidak"); ?>>Tidak</option>
                <option value="ya" <?php selected($viewdate, "ya"); ?>>Ya</option>
            </select>
        </p>
    <?php
    }

    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title']          = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['layout']         = (!empty($new_instance['layout'])) ? strip_tags($new_instance['layout']) : '';
        $instance['kategori']       = (!empty($new_instance['kategori'])) ? strip_tags($new_instance['kategori']) : '';
        $instance['jumlah']         = (!empty($new_instance['jumlah'])) ? strip_tags($new_instance['jumlah']) : '';
        $instance['kutipan']        = (!empty($new_instance['kutipan'])) ? strip_tags($new_instance['kutipan']) : '';
        $instance['orderby']        = (!empty($new_instance['orderby'])) ? strip_tags($new_instance['orderby']) : '';
        $instance['order']          = (!empty($new_instance['order'])) ? strip_tags($new_instance['order']) : '';
        $instance['viewers']        = (!empty($new_instance['viewers'])) ? strip_tags($new_instance['viewers']) : '';
        $instance['viewdate']       = (!empty($new_instance['viewdate'])) ? strip_tags($new_instance['viewdate']) : '';
        return $instance;
    }

    // Class velocity_posts_widget ends here
}


// Register and load the widget
function velocity_posts_load_widget()
{
    register_widget('velocity_posts_widget');
}
add_action('widgets_init', 'velocity_posts_load_widget');


/******* Akhir Widget Velocity Recent Posts  *******/





// [velocity-post-tabs]
function velocity_post_tabs_render_list($wp_query, $meta_type = 'date')
{
    if (!$wp_query->have_posts()) {
        _e('<p>Belum ada post.</p>');
        return;
    }

    echo '<div class="frame-kategori">';
    while ($wp_query->have_posts()) : $wp_query->the_post();
        echo '<div class="row m-0 py-2 px-1">';
        echo '<div class="col-4 col-sm-3 p-0">';
        echo '<div class="ratio ratio-4x3 rounded rounded-2 bg-light overflow-hidden">';
        if (has_post_thumbnail()) {
            $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            echo '<a href="' . get_the_permalink() . '"><img src="' . $img_atr[0] . '" alt="' . get_the_title() . '" /></a>';
        } else {
            echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="' . $width . '" height="' . $height . '"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g> </svg>';
        }
        echo '</div>';
        echo '</div>';
        echo '<div class="col-8 col-sm-9 py-1">';
        $vtitle = get_the_title();
        echo '<div class="vtitle"><a class="text-dark secondary-font" href="' . get_the_permalink() . '">' . vdlimit_title(get_the_title(), 5) . '</a></div>';

        if ($meta_type === 'views') {
            echo '<div class="text-muted"><small><i class="bi bi-calendar-event align-middle" aria-hidden="true"></i> ' . get_the_date('j F Y', get_the_ID()) . ' / <i class="bi bi-eye align-middle" aria-hidden="true"></i> ' . get_post_meta(get_the_ID(), 'hit', true) . '</small></div>';
        } elseif ($meta_type === 'comments') {
            echo '<div class="text-muted"><small><i class="bi bi-calendar-event align-middle" aria-hidden="true"></i> ' . get_the_date('j F Y', get_the_ID()) . ' / <i class="bi bi-chat-dots" aria-hidden="true"></i> ' . get_comments_number(get_the_ID()) . '</small></div>';
        } else {
            echo '<div class="text-muted"><small><i class="bi bi-calendar-event align-middle" aria-hidden="true"></i> ' . get_the_date('j F Y', get_the_ID()) . '</small></div>';
        }

        echo '</div>';
        echo '</div>';
    endwhile;
    echo '</div>';
}

function velocity_post_tabs()
{
    ob_start();
    $jumlah = 3; ?>

    <ul class="nav nav-tabs p-0 velocity-post-tabs" role="tablist">
        <li class="nav-item pb-0 border-0">
            <a class="nav-link active secondary-font" id="kategori1-tab" data-bs-toggle="tab" href="#kategori1" role="tab" aria-controls="kategori1" aria-selected="true">
                <strong>Popular</strong></a>
        </li>
        <li class="nav-item pb-0 border-0">
            <a class="nav-link secondary-font" id="kategori2-tab" data-bs-toggle="tab" href="#kategori2" role="tab" aria-controls="kategori2" aria-selected="false">
                <strong>Recent</strong></a>
        </li>
        <li class="nav-item pb-0 border-0">
            <a class="nav-link secondary-font" id="kategori3-tab" data-bs-toggle="tab" href="#kategori3" role="tab" aria-controls="kategori3" aria-selected="false">
                <strong>Comment</strong></a>
        </li>
    </ul>
    <div class="tab-content py-2 border-left border-right border-bottom" id="myTabContent">
        <div class="tab-pane fade show active" id="kategori1" role="tabpanel" aria-labelledby="kategori1-tab">
            <?php $args = array(
                'posts_per_page' => $jumlah,
                'showposts' => $jumlah,
                'meta_key' => 'hit',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
            );

            $wp_query = new WP_Query($args);
            velocity_post_tabs_render_list($wp_query, 'views');
            wp_reset_postdata(); ?>
        </div>
        <div class="tab-pane fade" id="kategori2" role="tabpanel" aria-labelledby="kategori2-tab">
            <?php $args2 = array(
                'posts_per_page' => $jumlah,
                'showposts' => $jumlah,
            );

            $wp_query2 = new WP_Query($args2);
            velocity_post_tabs_render_list($wp_query2, 'date');
            wp_reset_postdata(); ?>
        </div>

        <div class="tab-pane fade" id="kategori3" role="tabpanel" aria-labelledby="kategori3-tab">
            <?php $args3 = array(
                'posts_per_page' => $jumlah,
                'showposts' => $jumlah,
                'orderby' => 'comment_count',
                'order' => 'DESC',
            );

            $wp_query3 = new WP_Query($args3);
            velocity_post_tabs_render_list($wp_query3, 'comments');
            wp_reset_postdata(); ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('velocity-post-tabs', 'velocity_post_tabs');


