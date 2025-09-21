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
    wp_enqueue_script('theme-ajax-script', ARASH_THEME_DIR . '/assets/js/theme.js', array('jquery'), '1.0', true);
        wp_enqueue_script('shop-ajax-script', ARASH_THEME_DIR . '/assets/js/shop.js', array('jquery'), '1.0', true);
    
}
add_action('wp_enqueue_scripts', 'arash_enqueue_assets');

//feacher site

get_template_part('inc/feacher');


//register post types
get_template_part('inc/PostTypes');

//register Taxonomies
get_template_part('inc/Taxonomies');


//register fields
get_template_part('inc/fields');


get_template_part('inc/shop/archive-products');

//add localize script
function arash_localize_script() {
    
    // Localize script for theme.js Ajax functionality
    wp_localize_script('theme-ajax-script', 'themeData', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'siteurl' => SITE_URL,
        'themedir' => ARASH_THEME_DIR,
        'nonce' => wp_create_nonce('ajax-nonce'),
        'comment_nonce' => wp_create_nonce('comment_nonce'),
        'isUserLoggedIn' => is_user_logged_in()
    ));
    
    // Localize script for shop.js Ajax functionality
    wp_localize_script('shop-ajax-script', 'arash_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax-nonce'),
        'siteurl' => SITE_URL,
        'themedir' => ARASH_THEME_DIR,
        'isUserLoggedIn' => is_user_logged_in()
    ));
}
add_action('wp_enqueue_scripts', 'arash_localize_script');






?>