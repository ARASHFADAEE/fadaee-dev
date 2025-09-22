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
    // wp_enqueue_script('plyr-js', ARASH_THEME_DIR . '/assets/js/dependencies/plyr.min.js', array(), '1.0', true);
    wp_enqueue_script('fadaee-dev-script', ARASH_THEME_DIR . '/assets/js/app.js', array('alpine-js', 'swiper-js'), '1.0', true);
    if(is_single()){
    wp_enqueue_script('theme-ajax-script', ARASH_THEME_DIR . '/assets/js/theme.js', array('jquery'), '1.0', true);
    }
    if(is_shop()){
        wp_enqueue_script('shop-ajax-script', ARASH_THEME_DIR . '/assets/js/shop.js', array('jquery'), '1.0', true);
    }

    if(is_cart()){
    wp_enqueue_script('cart-ajax-script', ARASH_THEME_DIR . '/assets/js/cart.js', array('jquery'), '1.2', true);
    }


    wp_enqueue_script('portfolio-archive-ajax-script', ARASH_THEME_DIR . '/assets/js/portfolio.js', array('jquery'), '1.2', true);

    
    // Enqueue category filters script on category pages
    if (is_category() || is_home() || is_archive()) {
        wp_enqueue_script('category-filters-script', ARASH_THEME_DIR . '/assets/js/category-filters.js', array('jquery'), '1.0', true);
        wp_localize_script('category-filters-script', 'blog_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('blog_filter_nonce')
        ));
    }

    // Enqueue checkout styles and scripts on checkout page
    if (is_checkout() || is_wc_endpoint_url('order-received')) {
        wp_enqueue_style('checkout-css', ARASH_THEME_DIR . '/assets/css/checkout.css', array('main-css'), '1.0');
        wp_enqueue_script('checkout-js', ARASH_THEME_DIR . '/assets/js/checkout.js', array('jquery', 'wc-checkout'), '1.0', true);
    }
    
    // Enqueue account override styles on my-account pages
    if (is_account_page()) {
        wp_enqueue_style('account-override-css', ARASH_THEME_DIR . '/assets/css/account-override.css', array('main-css'), '1.0');
    }
    
}
add_action('wp_enqueue_scripts', 'arash_enqueue_assets');

// Remove WooCommerce default content wrappers and add custom ones
function arash_remove_woocommerce_wrappers() {
    // Remove default WooCommerce content wrappers
    remove_action( 'woocommerce_output_content_wrapper', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_output_content_wrapper_end', 'woocommerce_output_content_wrapper_end', 10 );
    
    // Add our custom empty wrappers to prevent default div.woocommerce
    add_action( 'woocommerce_output_content_wrapper', 'arash_woocommerce_output_content_wrapper', 10 );
    add_action( 'woocommerce_output_content_wrapper_end', 'arash_woocommerce_output_content_wrapper_end', 10 );
}
add_action( 'init', 'arash_remove_woocommerce_wrappers' );

// Custom empty wrapper functions
function arash_woocommerce_output_content_wrapper() {
    // Empty function - no wrapper output
}

function arash_woocommerce_output_content_wrapper_end() {
    // Empty function - no wrapper output
}

// Custom hooks for my-account page structure
function arash_my_account_custom_hooks() {
    /**
     * Add custom hooks for better my-account page structure
     */
    
    // Hook before my-account wrapper
    add_action('woocommerce_before_my_account_wrapper', function() {
        // Custom content can be added here
    });
    
    // Hook after my-account wrapper  
    add_action('woocommerce_after_my_account_wrapper', function() {
        // Custom content can be added here
    });
    
    // Hook before account content wrapper
    add_action('woocommerce_before_account_content_wrapper', function() {
        // Custom content can be added here
    });
    
    // Hook after account content wrapper
    add_action('woocommerce_after_account_content_wrapper', function() {
        // Custom content can be added here
    });
    
    // Hook before account content
    add_action('woocommerce_before_account_content', function() {
        // Custom content can be added here
    });
    
    // Hook after account content
    add_action('woocommerce_after_account_content', function() {
        // Custom content can be added here
    });
    
    // Hook before account dashboard
    add_action('woocommerce_before_account_dashboard', function() {
        // Custom content can be added here
    });
    
    // Hook after account dashboard
    add_action('woocommerce_after_account_dashboard', function() {
        // Custom content can be added here
    });
}
add_action('init', 'arash_my_account_custom_hooks');

// Custom menu items for my-account navigation
if (!function_exists('get_custom_menu_items')) {
    function get_custom_menu_items() {
        return array(
            'dashboard' => array(
                'label' => 'پیشخوان',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M1.5 7.125c0-1.036.84-1.875 1.875-1.875h6c1.036 0 1.875.84 1.875 1.875v3.75c0 1.036-.84 1.875-1.875 1.875h-6A1.875 1.875 0 0 1 1.5 10.875v-3.75Zm12 1.5c0-1.036.84-1.875 1.875-1.875h5.25c1.035 0 1.875.84 1.875 1.875v8.25c0 1.035-.84 1.875-1.875 1.875h-5.25a1.875 1.875 0 0 1-1.875-1.875v-8.25ZM3 16.125c0-1.036.84-1.875 1.875-1.875h5.25c1.036 0 1.875.84 1.875 1.875v2.25c0 1.035-.84 1.875-1.875 1.875h-5.25A1.875 1.875 0 0 1 3 18.375v-2.25Z" clip-rule="evenodd"></path>
                          </svg>'
            ),
            'orders' => array(
                'label' => 'سفارش ها',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"></path>
                          </svg>'
            ),
            'downloads' => array(
                'label' => 'دانلود ها',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
                          </svg>'
            ),
            'edit-address' => array(
                'label' => 'آدرس',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"></path>
                          </svg>'
            ),
            'edit-account' => array(
                'label' => 'اطلاعات حساب کاربری',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"></path>
                          </svg>'
            ),
            'customer-logout' => array(
                'label' => 'خروج',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15"></path>
                          </svg>'
            )
        );
    }
}

//feacher site

get_template_part('inc/feacher');


//register post types
get_template_part('inc/PostTypes');

//register Taxonomies
get_template_part('inc/Taxonomies');


//register fields
get_template_part('inc/fields');

//archive shop ajax handlers
get_template_part('inc/shop/archive-products');

//cart shop ajax handlers
get_template_part('inc/shop/cart');


get_template_part('inc/porfolio/archive-portfolios');

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

    // Localize script for cart.js Ajax functionality
    wp_localize_script('cart-ajax-script', 'arash_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax-nonce'),
        'siteurl' => SITE_URL,
        'themedir' => ARASH_THEME_DIR,
        'isUserLoggedIn' => is_user_logged_in()
    ));

    // Localize script for portfolio.js Ajax functionality
    wp_localize_script('portfolio-archive-ajax-script', 'portfolio_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax-nonce'),
        'siteurl' => SITE_URL,
        'themedir' => ARASH_THEME_DIR,
        'isUserLoggedIn' => is_user_logged_in()
    ));
}
add_action('wp_enqueue_scripts', 'arash_localize_script');

add_action('init' , function(){
    $cart_page_id = wc_get_page_id('cart');
    if ($cart_page_id && get_post($cart_page_id)){
        $cart_content = get_post_field('post_content' , $cart_page_id);
        if(strpos($cart_content , '[woocommerce_cart]') === false){
            wp_update_post([
                'ID' => $cart_page_id,
                'post_content' => '[woocommerce_cart]'
            ]);
        }
    }

    $checkout_page_id = wc_get_page_id('checkout');
    if ($checkout_page_id && get_post($checkout_page_id)){
        $checkout_content = get_post_field('post_content' , $checkout_page_id);
        if(strpos($checkout_content , '[woocommerce_checkout]') === false){
            wp_update_post([
                'ID' => $checkout_page_id,
                'post_content' => '[woocommerce_checkout]'
            ]);
        }
    }
});

// Include portfolio AJAX handler
require_once get_template_directory() . '/inc/portfolio/archive-portfolios.php';

// Customize woocommerce body classes on my-account pages
function customize_woocommerce_body_class($classes) {
    if (is_account_page()) {
        // حذف کلاس‌های پیش‌فرض woocommerce
        $classes = array_diff($classes, array('woocommerce', 'woocommerce-page', 'woocommerce-account'));
        
        // اضافه کردن کلاس‌های سفارشی (اختیاری)
        //$classes[] = '';
        // $classes[] = 'arash-account';
    }
    return $classes;
}
add_filter('body_class', 'customize_woocommerce_body_class');

// AJAX handler for blog filtering
function handle_blog_filter() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'blog_filter_nonce')) {
        wp_die('Security check failed');
    }
    
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    $orderby = isset($_POST['orderby']) ? sanitize_text_field($_POST['orderby']) : 'date';
    
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'paged' => $paged,
        'post_status' => 'publish'
    );
    
    // Add category filter
    if (!empty($category) && $category !== 'all') {
        $args['cat'] = $category;
    }
    
    // Add search filter
    if (!empty($search)) {
        $args['s'] = $search;
    }
    
    // Add sorting
    switch ($orderby) {
        case 'title':
            $args['orderby'] = 'title';
            $args['order'] = 'ASC';
            break;
        case 'oldest':
            $args['orderby'] = 'date';
            $args['order'] = 'ASC';
            break;
        default:
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
    }
    
    $query = new WP_Query($args);
    
    ob_start();
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $categories = get_the_category();
            $author_id = get_the_author_meta('ID');
            $reading_time = get_post_meta($post_id, 'reading_time', true);
            if (empty($reading_time)) {
                $reading_time = '5 دقیقه';
            }
            ?>
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="aspect-video overflow-hidden">
                        <img src="<?php echo get_the_post_thumbnail_url($post_id, 'large'); ?>" 
                             alt="<?php echo esc_attr(get_the_title()); ?>" 
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                <?php endif; ?>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">
                        <a href="<?php the_permalink(); ?>" class="hover:text-blue-600 transition-colors">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    
                    <div class="flex items-center gap-4 mb-4">
                        <div class="flex items-center gap-2">
                            <?php echo get_avatar($author_id, 32, '', '', array('class' => 'w-8 h-8 rounded-full')); ?>
                            <span class="text-sm text-gray-600"><?php the_author(); ?></span>
                        </div>
                        
                        <?php if (!empty($categories)) : ?>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                <?php echo esc_html($categories[0]->name); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span><?php echo esc_html($reading_time); ?></span>
                        <span><?php echo get_the_date('j F Y'); ?></span>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo '<div class="col-span-full text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">📝</div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">هیچ مقاله‌ای یافت نشد</h3>
                <p class="text-gray-500">متأسفانه مقاله‌ای با این فیلترها پیدا نکردیم.</p>
              </div>';
    }
    
    $content = ob_get_clean();
    
    wp_reset_postdata();
    
    wp_send_json_success(array(
        'content' => $content,
        'max_pages' => $query->max_num_pages,
        'current_page' => $paged
    ));
}
add_action('wp_ajax_blog_filter', 'handle_blog_filter');
add_action('wp_ajax_nopriv_blog_filter', 'handle_blog_filter');

?>