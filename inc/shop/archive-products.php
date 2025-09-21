<?php
/**
 * Ajax handlers for dynamic product archive functionality
 */

// Hook Ajax actions for both logged-in and non-logged-in users
add_action('wp_ajax_filter_products', 'arash_filter_products_ajax');
add_action('wp_ajax_nopriv_filter_products', 'arash_filter_products_ajax');

/**
 * Main Ajax handler for filtering products
 */
function arash_filter_products_ajax() {
    // Verify nonce for security
    if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
        wp_die('Security check failed');
    }

    // Get filter parameters
    $search_query = sanitize_text_field($_POST['search'] ?? '');
    $product_type = sanitize_text_field($_POST['product_type'] ?? '');
    $price_type = sanitize_text_field($_POST['price_type'] ?? '');
    $sort_by = sanitize_text_field($_POST['sort_by'] ?? 'date');
    $is_ongoing = isset($_POST['is_ongoing']) ? (bool) $_POST['is_ongoing'] : false;
    $paged = intval($_POST['paged'] ?? 1);

    // Build WP_Query arguments
    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 12,
        'paged' => $paged,
        'meta_query' => array(),
        'tax_query' => array()
    );

    // Add search query
    if (!empty($search_query)) {
        $args['s'] = $search_query;
    }

    // Filter by product category
    if (!empty($product_type)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $product_type,
        );
    }

    // Filter by price type
    if (!empty($price_type)) {
        switch ($price_type) {
            case 'free':
                $args['meta_query'][] = array(
                    'relation' => 'OR',
                    array(
                        'key' => '_price',
                        'value' => '0',
                        'compare' => '='
                    ),
                    array(
                        'key' => '_price',
                        'compare' => 'NOT EXISTS'
                    )
                );
                break;
            case 'paid':
                $args['meta_query'][] = array(
                    'key' => '_price',
                    'value' => '0',
                    'compare' => '>'
                );
                break;
            case 'premium':
                // Add custom logic for premium products if needed
                $args['meta_query'][] = array(
                    'key' => '_premium_product',
                    'value' => 'yes',
                    'compare' => '='
                );
                break;
        }
    }

    // Filter by ongoing status (for courses)
    if ($is_ongoing) {
        $args['meta_query'][] = array(
            'key' => '_course_status',
            'value' => 'ongoing',
            'compare' => '='
        );
    }

    // Handle sorting
    switch ($sort_by) {
        case 'newest':
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
        case 'oldest':
            $args['orderby'] = 'date';
            $args['order'] = 'ASC';
            break;
        case 'ongoing':
            $args['meta_key'] = '_course_status';
            $args['meta_value'] = 'ongoing';
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
        case 'completed':
            $args['meta_key'] = '_course_status';
            $args['meta_value'] = 'completed';
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
        case 'purchased':
            // Add logic for purchased products if user is logged in
            if (is_user_logged_in()) {
                $user_id = get_current_user_id();
                $purchased_products = arash_get_user_purchased_products($user_id);
                if (!empty($purchased_products)) {
                    $args['post__in'] = $purchased_products;
                } else {
                    $args['post__in'] = array(0); // No results
                }
            } else {
                $args['post__in'] = array(0); // No results for non-logged users
            }
            break;
        case 'watching':
            // Add logic for currently watching products
            if (is_user_logged_in()) {
                $user_id = get_current_user_id();
                $watching_products = arash_get_user_watching_products($user_id);
                if (!empty($watching_products)) {
                    $args['post__in'] = $watching_products;
                } else {
                    $args['post__in'] = array(0); // No results
                }
            } else {
                $args['post__in'] = array(0); // No results for non-logged users
            }
            break;
        case 'cheapest':
            $args['meta_key'] = '_regular_price';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'ASC';
            break;
        case 'expensive':
            $args['meta_key'] = '_regular_price';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        default:
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
    }

    // Execute query
    $products_query = new WP_Query($args);

    // Prepare response
    $response = array(
        'success' => true,
        'products' => array(),
        'pagination' => array(
            'current_page' => $paged,
            'total_pages' => $products_query->max_num_pages,
            'total_products' => $products_query->found_posts,
            'has_more' => $paged < $products_query->max_num_pages
        )
    );

    // Generate products HTML
    if ($products_query->have_posts()) {
        ob_start();
        while ($products_query->have_posts()) {
            $products_query->the_post();
            arash_render_product_card(get_the_ID());
        }
        $response['products_html'] = ob_get_clean();
        wp_reset_postdata();
    } else {
        $response['products_html'] = arash_render_no_products_message();
    }

    // Send JSON response
    wp_send_json($response);
}

/**
 * Render individual product card
 */
function arash_render_product_card($product_id) {
    $product = wc_get_product($product_id);
    if (!$product) return;

    $product_type = get_post_meta($product_id, '_product_type', true);
    $product_type = $product_type ?: 'course';
    
    $price = $product->get_price();
    $regular_price = $product->get_regular_price();
    $sale_price = $product->get_sale_price();
    
    $is_free = empty($price) || $price == 0;
    $is_on_sale = !empty($sale_price) && $sale_price < $regular_price;
    
    $course_status = get_post_meta($product_id, '_course_status', true);
    $course_status = $course_status ?: 'ongoing';
    
    ?>
    <div class="bg-background rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300" data-product-id="<?php echo $product_id; ?>" data-product-type="<?php echo esc_attr($product_type); ?>">
        <!-- Product Image -->
        <div class="relative aspect-video overflow-hidden">
            <?php if (has_post_thumbnail($product_id)): ?>
                <img src="<?php echo get_the_post_thumbnail_url($product_id, 'medium_large'); ?>" 
                     alt="<?php echo esc_attr(get_the_title($product_id)); ?>" 
                     class="w-full h-full object-cover">
            <?php else: ?>
                <div class="w-full h-full bg-secondary flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-muted">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>
            <?php endif; ?>
            
            <!-- Product Type Badge -->
            <div class="absolute top-3 right-3">
                <?php if ($product_type === 'course'): ?>
                    <span class="inline-flex items-center gap-1 bg-primary text-primary-foreground text-xs font-medium px-2 py-1 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3">
                            <path d="M10 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM6 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM1.49 15.326a.78.78 0 0 1-.358-.442 3 3 0 0 1 4.308-3.516 6.484 6.484 0 0 0-1.905 3.959c-.023.222-.014.442.025.654a4.97 4.97 0 0 1-2.07-.655ZM16.44 15.98a4.97 4.97 0 0 0 2.07-.654.78.78 0 0 0 .357-.442 3 3 0 0 0-4.308-3.517 6.484 6.484 0 0 1 1.907 3.96 2.32 2.32 0 0 1-.026.654ZM18 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM5.304 16.19a.844.844 0 0 1-.277-.71 5 5 0 0 1 9.947 0 .843.843 0 0 1-.277.71A6.975 6.975 0 0 1 10 18a6.974 6.974 0 0 1-4.696-1.81Z" />
                        </svg>
                        دوره
                    </span>
                <?php else: ?>
                    <span class="inline-flex items-center gap-1 bg-secondary text-foreground text-xs font-medium px-2 py-1 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3">
                            <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 0 1 3.5 2h1.148a1.5 1.5 0 0 1 1.465 1.175l.716 3.223a1.5 1.5 0 0 1-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 0 0 6.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 0 1 1.767-1.052l3.223.716A1.5 1.5 0 0 1 18 15.352V16.5a1.5 1.5 0 0 1-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 0 1 2.43 8.326 13.019 13.019 0 0 1 2 5V3.5Z" clip-rule="evenodd" />
                        </svg>
                        محصول دیجیتال
                    </span>
                <?php endif; ?>
            </div>
            
            <!-- Course Status Badge -->
            <?php if ($product_type === 'course'): ?>
                <div class="absolute top-3 left-3">
                    <?php if ($course_status === 'ongoing'): ?>
                        <span class="inline-flex items-center gap-1 bg-green-500 text-white text-xs font-medium px-2 py-1 rounded-full">
                            <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
                            در حال برگزاری
                        </span>
                    <?php else: ?>
                        <span class="inline-flex items-center gap-1 bg-gray-500 text-white text-xs font-medium px-2 py-1 rounded-full">
                            تکمیل شده
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Product Content -->
        <div class="p-4 space-y-3">
            <!-- Title -->
            <h3 class="font-bold text-sm text-foreground line-clamp-2 leading-relaxed">
                <a href="<?php echo get_permalink($product_id); ?>" class="hover:text-primary transition-colors">
                    <?php echo get_the_title($product_id); ?>
                </a>
            </h3>
            
            <!-- Excerpt -->
            <p class="text-xs text-muted line-clamp-2 leading-relaxed">
                <?php echo wp_trim_words(get_the_excerpt($product_id), 15, '...'); ?>
            </p>
            
            <!-- Price and Action -->
            <div class="flex items-center justify-between pt-2">
                <div class="flex flex-col">
                    <?php if ($is_free): ?>
                        <span class="font-bold text-sm text-green-600">رایگان</span>
                    <?php else: ?>
                        <?php if ($is_on_sale): ?>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-sm text-primary"><?php echo wc_price($sale_price); ?></span>
                                <span class="text-xs text-muted line-through"><?php echo wc_price($regular_price); ?></span>
                            </div>
                        <?php else: ?>
                            <span class="font-bold text-sm text-primary"><?php echo wc_price($price); ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                

            </div>
        </div>
    </div>
    <?php
}

/**
 * Render no products message
 */
function arash_render_no_products_message() {
    ob_start();
    ?>
    <div class="col-span-full flex flex-col items-center justify-center py-16 text-center">
        <div class="w-24 h-24 bg-secondary rounded-full flex items-center justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-muted">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </div>
        <h3 class="font-bold text-lg text-foreground mb-2">محصولی یافت نشد</h3>
        <p class="text-sm text-muted max-w-md">متأسفانه با فیلترهای انتخابی شما محصولی پیدا نکردیم. لطفاً فیلترها را تغییر دهید یا جستجوی جدیدی انجام دهید.</p>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Helper function to get user purchased products
 */
function arash_get_user_purchased_products($user_id) {
    $purchased_products = array();
    
    $orders = wc_get_orders(array(
        'customer' => $user_id,
        'status' => array('completed', 'processing'),
        'limit' => -1
    ));
    
    foreach ($orders as $order) {
        foreach ($order->get_items() as $item) {
            $product_id = $item['variation_id'] ? $item['variation_id'] : $item['product_id'];
            if (!in_array($product_id, $purchased_products)) {
                $purchased_products[] = $product_id;
            }
        }
    }
    
    return $purchased_products;
}

/**
 * Helper function to get user currently watching products
 */
function arash_get_user_watching_products($user_id) {
    // This would integrate with your course progress tracking system
    // For now, return empty array - implement based on your progress tracking
    return array();
}

/**
 * Ajax handler for loading more products (pagination)
 */
add_action('wp_ajax_load_more_products', 'arash_load_more_products_ajax');
add_action('wp_ajax_nopriv_load_more_products', 'arash_load_more_products_ajax');

function arash_load_more_products_ajax() {
    // This uses the same logic as filter_products_ajax but specifically for pagination
    arash_filter_products_ajax();
}