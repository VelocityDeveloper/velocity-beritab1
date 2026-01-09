<footer class="site-footer bg-light pt-5 py-2 px-3" id="colophon" style="text-align:inherit;">
    <div class="container bg-transparent">
    <div class="row">
        <?php
        if (is_active_sidebar('footer-widget-1')) {
            echo '<div class="col-md-4 widget widget-footer">';
            dynamic_sidebar('footer-widget-1');
            echo '</div>';
        }
        if (is_active_sidebar('footer-widget-2')) {
            echo '<div class="col-md-4 widget widget-footer">';
            dynamic_sidebar('footer-widget-2');
            echo '</div>';
        }
        if (is_active_sidebar('footer-widget-3')) {
            echo '<div class="col-md-4 widget widget-footer">';
            dynamic_sidebar('footer-widget-3');
            echo '</div>';
        }
        ?>
    </div>

    <div class="row align-items-center text-center">
        <div class="site-info text-muted">
            <small>
                © <?php echo date("Y"); ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.
                <br>
                Design by <a class="text-muted" href="https://velocitydeveloper.com" target="_blank" rel="noopener noreferrer">Velocity Developer</a>.
            </small>
        </div>
        <!-- .site-info -->
    </div>
    </div>
</footer>