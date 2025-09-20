<?php 

// add feacher suport theme
function theme_support(){
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'theme_support');

//register menu theme item
function register_menu_theme(){
    register_nav_menus(array(
        'main-menu' => 'منو اصلی',
        'footer-menu' => 'منو فوتر',
        "mega-menu" => "مگا منو محصولات",
        "mobile-menu" => "منو موبایل"
    ));
}
add_action('after_setup_theme','register_menu_theme');



?>