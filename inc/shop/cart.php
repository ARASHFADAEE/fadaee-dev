<?php
/**
 * Cart Ajax Handlers
 * 
 * Handles all cart-related Ajax operations for the Arash theme
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Hook Ajax actions
add_action('wp_ajax_add_to_cart', 'arash_add_to_cart_ajax');
add_action('wp_ajax_nopriv_add_to_cart', 'arash_add_to_cart_ajax');

// Removed duplicate actions - using arash_remove_from_cart instead

// Removed duplicate actions - using arash_update_cart_quantity instead

/**
 * Add product to cart via Ajax
 */

function arash_add_to_cart_ajax() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
        wp_die('Security check failed');
    }

    $product_id = intval($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    $variation_id = isset($_POST['variation_id']) ? intval($_POST['variation_id']) : 0;
    $variation = isset($_POST['variation']) ? $_POST['variation'] : array();

    // Add to cart
    $cart_item_key = WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation);

    if ($cart_item_key) {
        // Get updated cart data
        $cart_data = arash_get_cart_data();
        
        wp_send_json_success(array(
            'message' => 'محصول با موفقیت به سبد خرید اضافه شد',
            'cart_data' => $cart_data,
            'cart_count' => WC()->cart->get_cart_contents_count(),
            'cart_total' => arash_format_price(WC()->cart->get_total(''))
        ));
    } else {
        wp_send_json_error(array(
            'message' => 'خطا در افزودن محصول به سبد خرید'
        ));
    }
}

/**
 * Remove item from cart via Ajax
 */
add_action('wp_ajax_arash_remove_from_cart', 'arash_remove_from_cart_ajax');
add_action('wp_ajax_nopriv_arash_remove_from_cart', 'arash_remove_from_cart_ajax');

function arash_remove_from_cart_ajax() {
    // Initialize WooCommerce session if not already done
    if (!WC()->session->has_session()) {
        WC()->session->set_customer_session_cookie(true);
    }
    
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
        wp_die('Security check failed');
    }

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);

    if (WC()->cart->remove_cart_item($cart_item_key)) {
        // Get updated cart data
        $cart_data = arash_get_cart_data();
        
        wp_send_json_success(array(
            'message' => 'محصول با موفقیت از سبد خرید حذف شد',
            'cart_data' => $cart_data,
            'cart_count' => WC()->cart->get_cart_contents_count(),
            'cart_total' => arash_format_price(WC()->cart->get_total(''))
        ));
    } else {
        wp_send_json_error(array(
            'message' => 'خطا در حذف محصول از سبد خرید'
        ));
    }
}

/**
 * Update cart item quantity via Ajax
 */
add_action('wp_ajax_arash_update_cart_quantity', 'arash_update_cart_quantity_ajax');
add_action('wp_ajax_nopriv_arash_update_cart_quantity', 'arash_update_cart_quantity_ajax');

function arash_update_cart_quantity_ajax() {
    error_log('=== PHP: QUANTITY UPDATE AJAX CALLED ===');
    error_log('PHP: POST data: ' . print_r($_POST, true));
    
    // Check nonce for security
    if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
        error_log('PHP: Security check failed - nonce verification failed');
        wp_send_json_error(array('message' => 'Security check failed'));
    }
    error_log('PHP: Security check passed');

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = intval($_POST['quantity']);
    
    error_log('PHP: Sanitized data - cart_item_key: ' . $cart_item_key . ', quantity: ' . $quantity);

    if ($quantity <= 0) {
        error_log('PHP: Quantity is 0 or negative, removing item from cart');
        // Remove item from cart
        WC()->cart->remove_cart_item($cart_item_key);
        $message = 'محصول از سبد خرید حذف شد';
    } else {
        error_log('PHP: Updating quantity to: ' . $quantity);
        
        // Check if cart item exists
        $cart_item = WC()->cart->get_cart_item($cart_item_key);
        error_log('PHP: Cart item found: ' . ($cart_item ? 'YES' : 'NO'));
        
        if (!$cart_item) {
            error_log('PHP: Cart item not found, sending error');
            wp_send_json_error(array('message' => 'محصول در سبد خرید یافت نشد'));
        }
        
        error_log('PHP: Current cart item quantity before update: ' . $cart_item['quantity']);
        
        // Get product and check stock
        $product = $cart_item['data'];
        error_log('PHP: Product managing stock: ' . ($product->managing_stock() ? 'YES' : 'NO'));
        
        if ($product->managing_stock() && $quantity > $product->get_stock_quantity()) {
            error_log('PHP: Stock check failed - requested: ' . $quantity . ', available: ' . $product->get_stock_quantity());
            wp_send_json_error(array('message' => 'تعداد درخواستی بیش از موجودی است'));
        }
        
        // Update quantity
        error_log('PHP: Calling WC()->cart->set_quantity with key: ' . $cart_item_key . ', quantity: ' . $quantity);
        $result = WC()->cart->set_quantity($cart_item_key, $quantity);
        error_log('PHP: set_quantity result: ' . ($result ? 'TRUE' : 'FALSE'));
        
        // Check quantity after update
        $updated_cart_item = WC()->cart->get_cart_item($cart_item_key);
        if ($updated_cart_item) {
            error_log('PHP: Cart item quantity after update: ' . $updated_cart_item['quantity']);
        } else {
            error_log('PHP: ERROR - Cart item not found after update!');
        }
        
        // Force cart calculation and session save
        error_log('PHP: Calculating totals and saving session');
        WC()->cart->calculate_totals();
        WC()->session->save_data();
        
        // Log all cart contents after update
        $all_cart_items = WC()->cart->get_cart();
        error_log('PHP: All cart items after update: ' . print_r($all_cart_items, true));
    }

    // Get updated cart data
    error_log('PHP: Getting updated cart data');
    
    // Force WooCommerce to recalculate everything
    WC()->cart->calculate_totals();
    WC()->session->save_data();
    
    // Calculate cart count manually to ensure accuracy
    $manual_count = 0;
    foreach (WC()->cart->get_cart() as $cart_item) {
        $manual_count += $cart_item['quantity'];
    }
    
    $cart_data = arash_get_cart_data();
    $cart_total = WC()->cart->get_total('raw');
    $cart_count = WC()->cart->get_cart_contents_count();
    
    error_log('PHP: WooCommerce cart_count: ' . $cart_count);
    error_log('PHP: Manual calculated count: ' . $manual_count);
    error_log('PHP: Final data - cart_total: ' . $cart_total . ', using manual_count: ' . $manual_count);
    error_log('PHP: Cart data structure: ' . print_r($cart_data, true));
    
    // Use manual count if WooCommerce count is wrong
    $final_count = ($manual_count > 0) ? $manual_count : $cart_count;

    $response_data = array(
        'message' => isset($message) ? $message : 'تعداد محصول به‌روزرسانی شد',
        'cart_data' => $cart_data,
        'cart_total' => $cart_total,
        'cart_count' => $final_count
    );
    
    error_log('PHP: Sending success response: ' . print_r($response_data, true));
    wp_send_json_success($response_data);
}

/**
 * Apply coupon via Ajax
 */
add_action('wp_ajax_arash_apply_coupon', 'arash_apply_coupon_ajax');
add_action('wp_ajax_nopriv_arash_apply_coupon', 'arash_apply_coupon_ajax');

function arash_apply_coupon_ajax() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
        wp_die('Security check failed');
    }

    $coupon_code = sanitize_text_field($_POST['coupon_code']);

    if (empty($coupon_code)) {
        wp_send_json_error(array(
            'message' => 'لطفاً کد تخفیف را وارد کنید'
        ));
    }

    $result = WC()->cart->apply_coupon($coupon_code);

    if ($result) {
        // Get updated cart data
        $cart_data = arash_get_cart_data();
        
        wp_send_json_success(array(
            'message' => 'کد تخفیف با موفقیت اعمال شد',
            'cart_data' => $cart_data,
            'cart_total' => arash_format_price(WC()->cart->get_total(''))
        ));
    } else {
        wp_send_json_error(array(
            'message' => 'کد تخفیف نامعتبر است'
        ));
    }
}

/**
 * Remove coupon via Ajax
 */
add_action('wp_ajax_arash_remove_coupon', 'arash_remove_coupon_ajax');
add_action('wp_ajax_nopriv_arash_remove_coupon', 'arash_remove_coupon_ajax');

function arash_remove_coupon_ajax() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
        wp_die('Security check failed');
    }

    $coupon_code = sanitize_text_field($_POST['coupon_code']);

    if (WC()->cart->remove_coupon($coupon_code)) {
        // Get updated cart data
        $cart_data = arash_get_cart_data();
        
        wp_send_json_success(array(
            'message' => 'کد تخفیف با موفقیت حذف شد',
            'cart_data' => $cart_data,
            'cart_total' => arash_format_price(WC()->cart->get_total(''))
        ));
    } else {
        wp_send_json_error(array(
            'message' => 'خطا در حذف کد تخفیف'
        ));
    }
}

/**
 * Get cart data via Ajax
 */
add_action('wp_ajax_arash_get_cart_data', 'arash_get_cart_data_ajax');
add_action('wp_ajax_nopriv_arash_get_cart_data', 'arash_get_cart_data_ajax');

function arash_get_cart_data_ajax() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
        wp_die('Security check failed');
    }

    $cart_data = arash_get_cart_data();
    
    wp_send_json_success(array(
        'cart_data' => $cart_data,
        'cart_count' => WC()->cart->get_cart_contents_count(),
        'cart_total' => arash_format_price(WC()->cart->get_total(''))
    ));
}

/**
 * Helper function to get formatted cart data
 */
function arash_get_cart_data() {
    error_log('PHP: arash_get_cart_data called');
    
    if (WC()->cart->is_empty()) {
        error_log('PHP: Cart is empty');
        return array(
            'items' => array(),
            'totals' => array(
                'subtotal' => 0,
                'discount' => 0,
                'total' => 0
            ),
            'coupons' => array(),
            'is_empty' => true
        );
    }

    $cart_items = array();
    $cart_contents = WC()->cart->get_cart();
    error_log('PHP: Cart contents count: ' . count($cart_contents));
    
    foreach ($cart_contents as $cart_item_key => $cart_item) {
        error_log('PHP: Processing cart item key: ' . $cart_item_key);
        error_log('PHP: Cart item data: ' . print_r($cart_item, true));
        
        $product = $cart_item['data'];
        $product_id = $cart_item['product_id'];
        $variation_id = $cart_item['variation_id'];
        
        error_log('PHP: Product ID: ' . $product_id . ', Variation ID: ' . $variation_id);
        error_log('PHP: Product name: ' . $product->get_name());
        error_log('PHP: Cart item quantity: ' . $cart_item['quantity']);
        
        // Get product image
        $image_id = $product->get_image_id();
        $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'medium') : wc_placeholder_img_src();
        
        // Get product URL
        $product_url = get_permalink($product_id);
        
        // Get product meta (for courses)
        $course_chapters = get_post_meta($product_id, '_course_chapters', true);
        $course_duration = get_post_meta($product_id, '_course_duration', true);
        $course_status = get_post_meta($product_id, '_course_status', true);
        $course_instructor = get_post_meta($product_id, '_course_instructor', true);
        $course_instructor_avatar = get_post_meta($product_id, '_course_instructor_avatar', true);
        
        $price = floatval($product->get_price());
        $line_total = floatval($cart_item['line_total']);
        $line_subtotal = floatval($cart_item['line_subtotal']);
        
        error_log('PHP: Price: ' . $price . ', Line total: ' . $line_total . ', Line subtotal: ' . $line_subtotal);
        
        $item_data = array(
            'key' => $cart_item_key,
            'product_id' => $product_id,
            'variation_id' => $variation_id,
            'name' => $product->get_name(),
            'price' => $price,
            'regular_price' => floatval($product->get_regular_price()),
            'sale_price' => $product->get_sale_price() ? floatval($product->get_sale_price()) : 0,
            'quantity' => $cart_item['quantity'],
            'line_total' => $line_total,
            'line_subtotal' => $line_subtotal,
            'image_url' => $image_url,
            'product_url' => $product_url,
            'is_on_sale' => $product->is_on_sale(),
            'course_meta' => array(
                'chapters' => $course_chapters ? $course_chapters : '5',
                'duration' => $course_duration ? $course_duration : '25',
                'status' => $course_status ? $course_status : 'completed',
                'instructor' => $course_instructor ? $course_instructor : 'جلال بهرامی راد',
                'instructor_avatar' => $course_instructor_avatar ? $course_instructor_avatar : get_template_directory_uri() . '/assets/images/avatars/01.jpeg'
            )
        );
        
        error_log('PHP: Item data prepared: ' . print_r($item_data, true));
        $cart_items[] = $item_data;
    }

    // Get cart totals
    $cart_totals = WC()->cart->get_totals();
    error_log('PHP: Cart totals: ' . print_r($cart_totals, true));
    
    // Get applied coupons
    $applied_coupons = array();
    foreach (WC()->cart->get_applied_coupons() as $coupon_code) {
        $coupon = new WC_Coupon($coupon_code);
        $applied_coupons[] = array(
            'code' => $coupon_code,
            'amount' => WC()->cart->get_coupon_discount_amount($coupon_code),
            'type' => $coupon->get_discount_type()
        );
    }

    // Calculate count manually to ensure accuracy
    $manual_count = 0;
    foreach ($cart_items as $item) {
        $manual_count += $item['quantity'];
    }
    
    $final_data = array(
        'items' => $cart_items,
        'totals' => array(
            'subtotal' => floatval($cart_totals['subtotal']),
            'discount' => floatval($cart_totals['discount_total']),
            'total' => floatval($cart_totals['total'])
        ),
        'coupons' => $applied_coupons,
        'is_empty' => false,
        'count' => $manual_count
    );
    
    error_log('PHP: Final cart data array: ' . print_r($final_data, true));
    return $final_data;
}

/**
 * Clear cart via Ajax
 */
add_action('wp_ajax_arash_clear_cart', 'arash_clear_cart_ajax');
add_action('wp_ajax_nopriv_arash_clear_cart', 'arash_clear_cart_ajax');

function arash_clear_cart_ajax() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
        wp_die('Security check failed');
    }

    WC()->cart->empty_cart();
    
    wp_send_json_success(array(
        'message' => 'سبد خرید با موفقیت خالی شد',
        'cart_data' => arash_get_cart_data(),
        'cart_count' => 0,
        'cart_total' => arash_format_price(WC()->cart->get_total(''))
    ));
}

/**
 * Format price for display - returns numeric value for JavaScript processing
 */
function arash_format_price($price) {
    // Convert to float and handle empty/null values
    return floatval($price);
}

/**
 * Get course status label
 */
function arash_get_course_status_label($status) {
    $statuses = array(
        'completed' => 'تکمیل شده',
        'ongoing' => 'در حال برگزاری',
        'upcoming' => 'به زودی'
    );
    
    return isset($statuses[$status]) ? $statuses[$status] : 'تکمیل شده';
}