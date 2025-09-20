<?php
/**
 * Custom Taxonomies 
 */
function arash_register_taxonomies() {
    // Portfolio Categories
    register_taxonomy('portfolio_category', 'portfolio', array(
        'labels' => array(
            'name' => __('دسته‌بندی نمونه‌کارها', 'arash-theme'),
            'singular_name' => __('دسته‌بندی', 'arash-theme'),
            'search_items' => __('جستجوی دسته‌بندی‌ها', 'arash-theme'),
            'all_items' => __('همه دسته‌بندی‌ها', 'arash-theme'),
            'edit_item' => __('ویرایش دسته‌بندی', 'arash-theme'),
            'update_item' => __('به‌روزرسانی دسته‌بندی', 'arash-theme'),
            'add_new_item' => __('افزودن دسته‌بندی جدید', 'arash-theme'),
            'new_item_name' => __('نام دسته‌بندی جدید', 'arash-theme'),
        ),
        'hierarchical' => true,
        'public' => true,
        'rewrite' => array('slug' => 'portfolio-category'),
    ));
}
add_action('init', 'arash_register_taxonomies');