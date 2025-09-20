<?php
define('ARASH_THEME_DIR', get_template_directory_uri());
define('SITE_URL', get_site_url());


function arash_enqueue_assets() {
    wp_enqueue_style('fadaee-dev-style', ARASH_THEME_DIR . '/style.css', array(), '1.3');
}
add_action('wp_enqueue_scripts', 'arash_enqueue_assets');




?>