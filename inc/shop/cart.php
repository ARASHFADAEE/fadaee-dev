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

add_action('wp_ajax_remove_from_cart', 'arash_remove_from_cart_ajax');
add_action('wp_ajax_nopriv_remove_from_cart', 'arash_remove_from_cart_ajax');

add_action('wp_ajax_update_cart_quantity', 'arash_update_cart_quantity_ajax');
add_action('wp_ajax_nopriv_update_cart_quantity', 'arash_update_cart_quantity_ajax');

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
            'cart_total' => WC()->cart->get_cart_total()
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
            'cart_total' => WC()->cart->get_cart_total()
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
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
        wp_die('Security check failed');
    }

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = intval($_POST['quantity']);

    if ($quantity <= 0) {
        // Remove item if quantity is 0 or less
        WC()->cart->remove_cart_item($cart_item_key);
    } else {
        // Update quantity
        WC()->cart->set_quantity($cart_item_key, $quantity);
    }

    // Get updated cart data
    $cart_data = arash_get_cart_data();
    
    wp_send_json_success(array(
        'message' => 'تعداد محصول با موفقیت به‌روزرسانی شد',
        'cart_data' => $cart_data,
        'cart_count' => WC()->cart->get_cart_contents_count(),
        'cart_total' => WC()->cart->get_cart_total()
    ));
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
            'cart_total' => WC()->cart->get_cart_total()
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
            'cart_total' => WC()->cart->get_cart_total()
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
        'cart_total' => WC()->cart->get_cart_total()
    ));
}

/**
 * Helper function to get formatted cart data
 */
function arash_get_cart_data() {
    if (WC()->cart->is_empty()) {
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
    
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $product = $cart_item['data'];
        $product_id = $cart_item['product_id'];
        $variation_id = $cart_item['variation_id'];
        
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
        
        $cart_items[] = array(
            'key' => $cart_item_key,
            'product_id' => $product_id,
            'variation_id' => $variation_id,
            'name' => $product->get_name(),
            'price' => $product->get_price(),
            'regular_price' => $product->get_regular_price(),
            'sale_price' => $product->get_sale_price(),
            'quantity' => $cart_item['quantity'],
            'line_total' => $cart_item['line_total'],
            'line_subtotal' => $cart_item['line_subtotal'],
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
    }

    // Get cart totals
    $cart_totals = WC()->cart->get_totals();
    
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

    return array(
        'items' => $cart_items,
        'totals' => array(
            'subtotal' => $cart_totals['subtotal'],
            'discount' => $cart_totals['discount_total'],
            'total' => $cart_totals['total']
        ),
        'coupons' => $applied_coupons,
        'is_empty' => false,
        'count' => WC()->cart->get_cart_contents_count()
    );
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
        'cart_total' => WC()->cart->get_cart_total()
    ));
}

/**
 * Format price for display
 */
function arash_format_price($price) {
    return number_format($price) . ' تومان';
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