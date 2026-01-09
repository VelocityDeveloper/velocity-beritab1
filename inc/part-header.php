<?php
$bannertop1 = velocitytheme_option('banner_header1');
$bannertop2 = velocitytheme_option('banner_header2');
?>
<div class="container">
    <?php if ($bannertop1) : ?>
        <div class="banner-header pb-2">
            <?php echo vdbanner('banner_header1'); ?>
        </div>
    <?php endif; ?>
    <div class="row py-3 m-0 d-md-flex d-none align-items-center">
        <div class="col-md-3 p-md-0">
            <!-- Your site title as branding in the menu -->
            <?php if (!has_custom_logo()) { ?>

                <?php if (is_front_page() && is_home()) : ?>

                    <h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><?php bloginfo('name'); ?></a></h1>

                <?php else : ?>

                    <a class="navbar-brand" rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><?php bloginfo('name'); ?></a>

                <?php endif; ?>

            <?php
            } else {
                the_custom_logo();
            }
            ?>
            <!-- end custom logo -->
        </div>
        <div class="col-md-6 p-md-0"><?php echo vdcari(); ?></div>
        <div class="col-md-3 p-md-0 text-end"><strong><?php echo vddate(); ?></strong></div>
    </div>

    <div class="header-position bg-white">
        <div class="row m-0 border-bottom">
            <div class="col-md-11 col-3 p-md-0 primary-menuset">
                <nav id="main-nav" class="navbar navbar-expand-md navbar-light p-0" aria-labelledby="main-nav-label">
                    <div class="menu-utama">
                        <button class="navbar-toggler p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'justg'); ?>">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarNavOffcanvas">

                            <div class="offcanvas-header justify-content-end">
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div><!-- .offcancas-header -->

                            <!-- The WordPress Menu goes here -->
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location'  => 'primary',
                                    'container_class' => 'offcanvas-body',
                                    'container_id'    => '',
                                    'menu_class'      => 'navbar-nav justify-content-end flex-grow-1 pe-3',
                                    'fallback_cb'     => '',
                                    'menu_id'         => 'main-menu',
                                    'depth'           => 4,
                                    'walker'          => new justg_WP_Bootstrap_Navwalker(),
                                )
                            );
                            ?>
                        </div><!-- .offcanvas -->
                    </div><!-- .menu-utama -->
                </nav><!-- .site-navigation -->
            </div><!-- .primary-menuset -->

            <div class="col-6 d-block d-md-none p-0">
                <!-- Your site title as branding in the menu -->
                <?php if (!has_custom_logo()) { ?>

                    <?php if (is_front_page() && is_home()) : ?>

                        <h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><?php bloginfo('name'); ?></a></h1>

                    <?php else : ?>

                        <a class="navbar-brand" rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><?php bloginfo('name'); ?></a>

                    <?php endif; ?>

                <?php
                } else {
                    the_custom_logo();
                }
                ?>
                <!-- end custom logo -->
            </div>
            <div class="col-1 p-0"><?php echo vdpencarian(); ?></div>
        </div><!-- .row -->

        <div class="secondary-menuset py-1">
            <nav id="secondary-nav" class="p-0">
                <div class="menu-second">
                    <!-- The WordPress Menu goes here -->
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'secondary-menu',
                            'container_class' => '',
                            'container_id'    => '',
                            'menu_class'      => 'p-0 m-0',
                            'fallback_cb'     => '',
                            'menu_id'         => 'secondary-menu',
                            'depth'           => 4,
                            // 'walker'          => new justg_WP_Bootstrap_Navwalker(),
                        )
                    );
                    ?>
                </div><!-- .menu-utama -->
            </nav><!-- .site-navigation -->
        </div><!-- .secondary-menuset -->
    </div>

    <div>
        <?php echo vdpost_marquee(); ?>
    </div>

    <?php if ($bannertop2) : ?>
        <div class="banner-header pt-3">
            <?php echo vdbanner('banner_header2'); ?>
        </div>
    <?php endif; ?>
</div><!-- .container -->
