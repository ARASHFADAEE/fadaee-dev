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




//add localize script
function arash_localize_script() {
    
    // Localize script for theme.js Ajax functionality
    wp_localize_script('theme-ajax-script', 'themeData', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'siteurl' => SITE_URL,
        'themedir' => ARASH_THEME_DIR,
        'nonce' => wp_create_nonce('ajax-nonce')
    ));
}
add_action('wp_enqueue_scripts', 'arash_localize_script');



//search ajax header

//search ajax header
function ajax_search(){
    check_ajax_referer('ajax-nonce', 'nonce');
    $search_query = sanitize_text_field($_POST['search_query']);
    
    $args = array(
        's' => $search_query,
        'post_type' => array('post', 'page'), // جستجو در پست‌ها و صفحات
        'posts_per_page' => 8,
        'post_status' => 'publish'
    );
    
    $query = new WP_Query($args);
    
    if($query->have_posts()){
        echo '<div class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg">';
        while($query->have_posts()){
            $query->the_post();
            $excerpt = wp_trim_words(get_the_excerpt(), 15, '...');
            $post_type_label = get_post_type() == 'post' ? 'مقاله' : 'صفحه';
            
            echo '<div class="border-b border-gray-100 dark:border-gray-700 last:border-b-0">';
            echo '<a href="'.get_permalink().'" class="block p-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors rounded-md">';
            echo '<div class="flex items-start justify-between">';
            echo '<div class="flex-1">';
            echo '<h4 class="text-sm font-medium text-gray-900 dark:text-white mb-1">'.get_the_title().'</h4>';
            if($excerpt) {
                echo '<p class="text-xs text-gray-600 dark:text-white mb-1">'.$excerpt.'</p>';
            }
            echo '<span class="text-xs text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 px-2 py-1 rounded-full">'.$post_type_label.'</span>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="p-6 text-center bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg">';
        echo '<svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">';
        echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />';
        echo '</svg>';
        echo '<p class="text-sm text-gray-700 dark:text-white mb-1">نتیجه‌ای برای "<strong class="text-gray-900 dark:text-white">'.$search_query.'</strong>" یافت نشد.</p>';
        echo '<p class="text-xs text-gray-500 dark:text-gray-300">کلمات کلیدی دیگری امتحان کنید.</p>';
        echo '</div>';
    }
    
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_ajax_search', 'ajax_search');
add_action('wp_ajax_nopriv_ajax_search', 'ajax_search');

// Mobile Ajax Search Function
function mobile_ajax_search() {
    check_ajax_referer('ajax-nonce', 'nonce');
    
    $search_query = sanitize_text_field($_POST['search_query']);
    
    $args = array(
        'post_type' => array('post', 'page'),
        'post_status' => 'publish',
        's' => $search_query,
        'posts_per_page' => 6, // کمتر برای موبایل
    );
    
    $query = new WP_Query($args);
    
    if($query->have_posts()){
        echo '<div class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">';
        while($query->have_posts()){
            $query->the_post();
            $excerpt = wp_trim_words(get_the_excerpt(), 10, '...');
            $post_type_label = get_post_type() == 'post' ? 'مقاله' : 'صفحه';
            
            echo '<div class="border-b border-gray-100 dark:border-gray-700 last:border-b-0">';
            echo '<a href="'.get_permalink().'" class="block p-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors rounded-md">';
            echo '<div class="flex items-start justify-between">';
            echo '<div class="flex-1">';
            echo '<h4 class="text-xs font-medium text-gray-900 dark:text-white mb-1">'.get_the_title().'</h4>';
            if($excerpt) {
                echo '<p class="text-xs text-gray-600 dark:text-white mb-1">'.$excerpt.'</p>';
            }
            echo '<span class="text-xs text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 px-1.5 py-0.5 rounded-full">'.$post_type_label.'</span>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="p-4 text-center bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">';
        echo '<svg class="mx-auto h-8 w-8 text-gray-400 dark:text-gray-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">';
        echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />';
        echo '</svg>';
        echo '<p class="text-xs text-gray-700 dark:text-white mb-1">نتیجه‌ای برای "<strong class="text-gray-900 dark:text-white">'.$search_query.'</strong>" یافت نشد.</p>';
        echo '<p class="text-xs text-gray-500 dark:text-gray-300">کلمات کلیدی دیگری امتحان کنید.</p>';
        echo '</div>';
    }
    
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_mobile_ajax_search', 'mobile_ajax_search');
add_action('wp_ajax_nopriv_mobile_ajax_search', 'mobile_ajax_search');




?>