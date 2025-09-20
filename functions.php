<?php
define('ARASH_THEME_DIR', get_template_directory_uri());
define('SITE_URL', get_site_url());

function arash_enqueue_assets() {
    // Enqueue stylesheets
    wp_enqueue_style('swiper-css', ARASH_THEME_DIR . '/assets/css/dependencies/swiper-bundle.min.css', array(), '1.0');
    wp_enqueue_style('plyr-css', ARASH_THEME_DIR . '/assets/css/dependencies/plyr.min.css', array(), '1.0');
    wp_enqueue_style('fonts-css', ARASH_THEME_DIR . '/assets/css/fonts.css', array(), '1.0');
    wp_enqueue_style('main-css', ARASH_THEME_DIR . '/assets/css/app.css', array(), '1.0');

    // Add favicon
    add_action('wp_head', function() {
        echo '<link rel="icon" type="image/svg+xml" href="' . ARASH_THEME_DIR . '/assets/images/favicon.svg" />';
    });

    // Enqueue scripts
    wp_enqueue_script('alpine-js', ARASH_THEME_DIR . '/assets/js/dependencies/alpinejs.min.js', array(), '1.0', true);
    wp_enqueue_script('swiper-js', ARASH_THEME_DIR . '/assets/js/dependencies/swiper-bundle.min.js', array(), '1.0', true);
    wp_enqueue_script('plyr-js', ARASH_THEME_DIR . '/assets/js/dependencies/plyr.min.js', array(), '1.0', true);
    wp_enqueue_script('fadaee-dev-script', ARASH_THEME_DIR . '/assets/js/app.js', array('alpine-js', 'swiper-js', 'plyr-js'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'arash_enqueue_assets');


// add feacher suport theme
function theme_support(){
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'theme_support');


//add localize script
function arash_localize_script() {
    wp_localize_script('fadaee-dev-script', 'themeData', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'siteurl' => SITE_URL,
        'themedir' => ARASH_THEME_DIR,
        'nonce' => wp_create_nonce('ajax-nonce')
    ));
}
add_action('wp_enqueue_scripts', 'arash_localize_script');







?>