<?php
/**
 * Custom Post Types 
 */
function arash_register_post_types() {
    // Portfolio Post Type
    register_post_type('portfolio', array(
        'labels' => array(
            'name' => __('نمونه‌کارها', 'arash-theme'),
            'singular_name' => __('نمونه‌کار', 'arash-theme'),
            'add_new' => __('افزودن نمونه‌کار', 'arash-theme'),
            'add_new_item' => __('افزودن نمونه‌کار جدید', 'arash-theme'),
            'edit_item' => __('ویرایش نمونه‌کار', 'arash-theme'),
            'new_item' => __('نمونه‌کار جدید', 'arash-theme'),
            'view_item' => __('مشاهده نمونه‌کار', 'arash-theme'),
            'search_items' => __('جستجوی نمونه‌کارها', 'arash-theme'),
            'not_found' => __('نمونه‌کاری یافت نشد', 'arash-theme'),
            'not_found_in_trash' => __('نمونه‌کاری در زباله‌دان یافت نشد', 'arash-theme'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-portfolio',
        'rewrite' => array('slug' => 'portfolio'),
    ));
    
    // Testimonials Post Type
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => __('نظرات مشتریان', 'arash-theme'),
            'singular_name' => __('نظر مشتری', 'arash-theme'),
            'add_new' => __('افزودن نظر', 'arash-theme'),
            'add_new_item' => __('افزودن نظر جدید', 'arash-theme'),
            'edit_item' => __('ویرایش نظر', 'arash-theme'),
            'new_item' => __('نظر جدید', 'arash-theme'),
            'view_item' => __('مشاهده نظر', 'arash-theme'),
            'search_items' => __('جستجوی نظرات', 'arash-theme'),
            'not_found' => __('نظری یافت نشد', 'arash-theme'),
            'not_found_in_trash' => __('نظری در زباله‌دان یافت نشد', 'arash-theme'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-testimonial',
        'menu_position' => 25,
    ));
}
add_action('init', 'arash_register_post_types');



