<?php
/**
 * Checkout Form - Optimized UX/UI Design
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<!-- Optimized Checkout Header -->
<header class="checkout-header bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="flex items-center justify-between">

            
            <!-- Navigation & Trust Signals -->
            <div class="flex items-center space-x-6 space-x-reverse">
                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white flex items-center">

                    بازگشت به سبد خرید
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>

            </div>
        </div>
    </div>
</header>

<main class="checkout-main bg-gray-50 dark:bg-gray-900 min-h-screen pb-20 lg:pb-8">
    <div class="max-w-7xl mx-auto px-4 py-6 lg:py-8">

        <?php
        do_action( 'woocommerce_before_checkout_form', $checkout );

        // If checkout registration is disabled and not logged in, the user cannot checkout.
        if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
            echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
            return;
        }
        ?>

        <!-- Mobile: Collapsible Order Summary -->
        <div class="lg:hidden mb-6">
            <button type="button" id="mobile-order-toggle" class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-4 flex items-center justify-between shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="text-sm text-white-600 dark:text-gray-300">مشاهده خلاصه سفارش</span>
                </div>
                <div class="flex items-center">
                    <span class="text-lg font-bold text-gray-900 dark:text-white ml-2"><?php echo WC()->cart->get_total(); ?></span>
                    <svg id="toggle-icon" class="w-5 h-5 text-gray-400 dark:text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </button>
            
            <div id="mobile-order-summary" class="hidden bg-white dark:bg-gray-800 border-x border-b border-gray-200 dark:border-gray-600 rounded-b-lg p-4 shadow-sm">
                <?php wc_get_template( 'checkout/review-order.php' ); ?>
            </div>
        </div>

        <form name="checkout" id="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                <!-- Desktop: Left Column (Form Fields) - Mobile: Single Column -->
                <div class="lg:col-span-2 space-y-6">
                    <?php if ( $checkout->get_checkout_fields() ) : ?>

                        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                        <!-- Customer Information Section -->
                        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-6 shadow-sm">

                            <div class="space-y-4">
                                <?php do_action( 'woocommerce_checkout_billing' ); ?>
                            </div>
                        </div>

                        <!-- Shipping Information Section -->
                        <?php if ( WC()->cart->needs_shipping_address() === true ) : ?>
                            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-6 shadow-sm">
                                <div class="flex items-center mb-6">
                                    <div class="flex items-center justify-center w-8 h-8 bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-400 rounded-full ml-3">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">اطلاعات ارسال</h2>
                                </div>
                                <div class="space-y-4">
                                    <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Payment Method Section -->
                        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-6 shadow-sm">
                            <div class="flex items-center mb-6">
                                <div class="flex items-center justify-center w-8 h-8 bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-400 rounded-full ml-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">روش پرداخت</h2>
                            </div>
                            <?php wc_get_template( 'checkout/payment.php' ); ?>
                        </div>

                        <!-- Additional Fields -->
                        <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

                    <?php endif; ?>

                    <!-- Order Notes -->
                    <?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_checkout_notes_field' ) ) ) : ?>
                        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-6 shadow-sm">
                            <div class="flex items-center mb-6">
                                <div class="flex items-center justify-center w-8 h-8 bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-400 rounded-full ml-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">یادداشت سفارش</h2>
                            </div>
                            <?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
                                <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Coupon Form -->
                    <?php if ( wc_coupons_enabled() ) : ?>
                        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-6 shadow-sm">
                            <div class="flex items-center mb-6">
                                <div class="flex items-center justify-center w-8 h-8 bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-400 rounded-full ml-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">کد تخفیف</h2>
                            </div>
                            <?php wc_get_template( 'checkout/form-coupon.php' ); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Desktop: Right Column (Sticky Order Summary) -->
                <div class="hidden lg:block lg:col-span-1">
                    <div class="sticky top-24 space-y-6">
                        <!-- Order Review -->
                        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg p-6 shadow-sm">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">خلاصه سفارش</h3>
                            <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
                            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                            <div id="order_review" class="woocommerce-checkout-review-order">
                                <?php wc_get_template( 'checkout/review-order.php' ); ?>
                            </div>

                            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
                        </div>


                    </div>
                </div>
            </div>

        </form>


        <!-- Mobile: Sticky CTA Button -->
        <div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-600 p-4 shadow-lg z-40">
            <button type="submit" form="checkout" class="w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-semibold py-4 px-6 rounded-lg transition-colors duration-200 text-center">
                پرداخت و ثبت سفارش
            </button>
        </div>

        <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
    </div>
</main>

<!-- Optimized Checkout Footer -->
<footer class="checkout-footer bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 py-6 mt-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-center space-x-6 space-x-reverse text-sm text-gray-600 dark:text-gray-400">
            <a href="<?php echo get_privacy_policy_url(); ?>" class="hover:text-gray-900 dark:hover:text-white">حریم خصوصی</a>
            <span class="text-gray-300 dark:text-gray-600">|</span>
            <a href="<?php echo get_permalink( wc_terms_and_conditions_page_id() ); ?>" class="hover:text-gray-900 dark:hover:text-white">شرایط و قوانین</a>
        </div>
    </div>
</footer>

<style>
/* Enhanced Form Styling */
.woocommerce-checkout .form-row input[type="text"],
.woocommerce-checkout .form-row input[type="email"],
.woocommerce-checkout .form-row input[type="tel"],
.woocommerce-checkout .form-row input[type="number"],
.woocommerce-checkout .form-row select,
.woocommerce-checkout .form-row textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.2s, box-shadow 0.2s;
    background-color: transparent;
    color: #000000;
}

/* Dark mode form inputs - using Tailwind's dark mode */
.dark .woocommerce-checkout .form-row input[type="text"],
.dark .woocommerce-checkout .form-row input[type="email"],
.dark .woocommerce-checkout .form-row input[type="tel"],
.dark .woocommerce-checkout .form-row input[type="number"],
.dark .woocommerce-checkout .form-row select,
.dark .woocommerce-checkout .form-row textarea {
    background-color: #374151;
    border-color: #4b5563;
    color: #ffffff;
}

.woocommerce-checkout .form-row input:focus,
.woocommerce-checkout .form-row select:focus,
.woocommerce-checkout .form-row textarea:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.woocommerce-checkout .form-row label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: #374151;
    font-size: 14px;
}

/* Dark mode labels */
.dark .woocommerce-checkout .form-row label {
    color: #d1d5db;
}

.woocommerce-checkout .form-row {
    margin-bottom: 20px;
}

/* Error States */
.woocommerce-checkout .form-row.woocommerce-invalid input,
.woocommerce-checkout .form-row.woocommerce-invalid select,
.woocommerce-checkout .form-row.woocommerce-invalid textarea {
    border-color: #ef4444;
    background-color: #fef2f2;
}

/* Dark mode error states */
.dark .woocommerce-checkout .form-row.woocommerce-invalid input,
.dark .woocommerce-checkout .form-row.woocommerce-invalid select,
.dark .woocommerce-checkout .form-row.woocommerce-invalid textarea {
    border-color: #ef4444;
    background-color: #7f1d1d;
    color: #ffffff;
}

.woocommerce-checkout .woocommerce-error {
    background-color: #fef2f2;
    border: 1px solid #fecaca;
    color: #dc2626;
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 14px;
}

/* Dark mode error messages */
.dark .woocommerce-checkout .woocommerce-error {
    background-color: #7f1d1d;
    border-color: #991b1b;
    color: #fca5a5;
}

/* Success States */
.woocommerce-checkout .form-row.woocommerce-validated input,
.woocommerce-checkout .form-row.woocommerce-validated select {
    border-color: #10b981;
    background-color: #f0fdf4;
}

/* Dark mode success states */
.dark .woocommerce-checkout .form-row.woocommerce-validated input,
.dark .woocommerce-checkout .form-row.woocommerce-validated select {
    border-color: #10b981;
    background-color: #064e3b;
    color: #ffffff;
}

/* Payment Methods */
.woocommerce-checkout #payment .payment_methods {
    list-style: none;
    padding: 0;
    margin: 0;
}

.woocommerce-checkout #payment .payment_methods li {
    margin-bottom: 12px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    overflow: hidden;
}

/* Dark mode payment methods */
.dark .woocommerce-checkout #payment .payment_methods li {
    border-color: #4b5563;
}

.woocommerce-checkout #payment .payment_methods li label {
    display: block;
    padding: 16px;
    cursor: pointer;
    background-color: #f9fafb;
    border: none;
    font-weight: 500;
    transition: background-color 0.2s ease;
}

/* Dark mode payment method labels */
.dark .woocommerce-checkout #payment .payment_methods li label {
    background-color: #4b5563;
    color: #ffffff;
}

.woocommerce-checkout #payment .payment_methods li label:hover {
    background-color: #f3f4f6;
}

/* Dark mode payment method hover */
.dark .woocommerce-checkout #payment .payment_methods li label:hover {
    background-color: #6b7280;
}

.woocommerce-checkout #payment .payment_methods li input[type="radio"]:checked + label {
    background-color: #eff6ff;
    border-color: #3b82f6;
}

/* Dark mode selected payment method */
.dark .woocommerce-checkout #payment .payment_methods li input[type="radio"]:checked + label {
    background-color: #1e3a8a;
    color: #ffffff;
}

/* Order Review */
.woocommerce-checkout-review-order-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.woocommerce-checkout-review-order-table th,
.woocommerce-checkout-review-order-table td {
    padding: 12px 0;
    border-bottom: 1px solid #e5e7eb;
    text-align: right;
}

/* Dark mode order review table */
.dark .woocommerce-checkout-review-order-table th,
.dark .woocommerce-checkout-review-order-table td {
    border-bottom-color: #4b5563;
    color: #d1d5db;
}

.woocommerce-checkout-review-order-table .cart_item td {
    color: #6b7280;
}

/* Dark mode cart items */
.dark .woocommerce-checkout-review-order-table .cart_item td {
    color: #9ca3af;
}

.woocommerce-checkout-review-order-table .order-total td {
    font-weight: 600;
    font-size: 18px;
    color: #111827;
}

/* Dark mode order total */
.dark .woocommerce-checkout-review-order-table .order-total td {
    color: #ffffff;
}

/* Responsive Adjustments */
@media (max-width: 1023px) {
    .checkout-main {
        padding-bottom: 100px; /* Space for sticky button */
    }
}

/* Button Styles */
.woocommerce-checkout button[type="submit"],
.woocommerce-checkout .button,
.woocommerce-checkout input[type="submit"] {
    background-color: #3b82f6;
    color: #ffffff;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.woocommerce-checkout button[type="submit"]:hover,
.woocommerce-checkout .button:hover,
.woocommerce-checkout input[type="submit"]:hover {
    background-color: #2563eb;
}

/* Dark mode buttons */
.dark .woocommerce-checkout button[type="submit"],
.dark .woocommerce-checkout .button,
.dark .woocommerce-checkout input[type="submit"] {
    background-color: #1d4ed8;
}

.dark .woocommerce-checkout button[type="submit"]:hover,
.dark .woocommerce-checkout .button:hover,
.dark .woocommerce-checkout input[type="submit"]:hover {
    background-color: #1e40af;
}

/* Secondary buttons */
.woocommerce-checkout .button.alt {
    background-color: #6b7280;
    color: #ffffff;
}

.woocommerce-checkout .button.alt:hover {
    background-color: #4b5563;
}

/* Dark mode secondary buttons */
.dark .woocommerce-checkout .button.alt {
    background-color: #9ca3af;
    color: #111827;
}

.dark .woocommerce-checkout .button.alt:hover {
    background-color: #d1d5db;
}

/* Loading States */
.woocommerce-checkout.processing {
    opacity: 0.6;
    pointer-events: none;
}

.woocommerce-checkout .blockUI.blockOverlay {
    background: rgba(255, 255, 255, 0.8) !important;
}

/* Dark mode loading overlay */
.dark .woocommerce-checkout .blockUI.blockOverlay {
    background: rgba(17, 24, 39, 0.8) !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile Order Summary Toggle
    const mobileToggle = document.getElementById('mobile-order-toggle');
    const mobileOrderSummary = document.getElementById('mobile-order-summary');
    const toggleIcon = document.getElementById('toggle-icon');
    
    if (mobileToggle && mobileOrderSummary) {
        mobileToggle.addEventListener('click', function() {
            const isHidden = mobileOrderSummary.classList.contains('hidden');
            
            if (isHidden) {
                mobileOrderSummary.classList.remove('hidden');
                toggleIcon.style.transform = 'rotate(180deg)';
            } else {
                mobileOrderSummary.classList.add('hidden');
                toggleIcon.style.transform = 'rotate(0deg)';
            }
        });
    }
    
    // Mobile Sticky Button Handler
    const mobileSubmitBtn = document.querySelector('.lg\\:hidden button[form="checkout"]');
    const checkoutForm = document.querySelector('form#checkout');
    
    if (mobileSubmitBtn && checkoutForm) {
        mobileSubmitBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Trigger form validation and submission
            const submitEvent = new Event('submit', {
                bubbles: true,
                cancelable: true
            });
            
            checkoutForm.dispatchEvent(submitEvent);
        });
    }

    // Enhanced Form Validation
    if (checkoutForm) {
        // Real-time validation
        const inputs = checkoutForm.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('error')) {
                    validateField(this);
                }
            });
        });
        
        // Form submission validation
        checkoutForm.addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = checkoutForm.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!validateField(field)) {
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                // Scroll to first error
                const firstError = checkoutForm.querySelector('.error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
        });
    }
    
    // Field validation function
    function validateField(field) {
        const value = field.value.trim();
        const isRequired = field.hasAttribute('required');
        let isValid = true;
        
        // Remove previous error states
        field.classList.remove('error');
        const errorMsg = field.parentNode.querySelector('.field-error');
        if (errorMsg) errorMsg.remove();
        
        if (isRequired && !value) {
            isValid = false;
            showFieldError(field, 'این فیلد الزامی است');
        } else if (field.type === 'email' && value && !isValidEmail(value)) {
            isValid = false;
            showFieldError(field, 'لطفاً ایمیل معتبر وارد کنید');
        } else if (field.type === 'tel' && value && !isValidPhone(value)) {
            isValid = false;
            showFieldError(field, 'لطفاً شماره تلفن معتبر وارد کنید');
        }
        
        return isValid;
    }
    
    function showFieldError(field, message) {
        field.classList.add('error');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'field-error text-red-600 text-sm mt-1';
        errorDiv.textContent = message;
        field.parentNode.appendChild(errorDiv);
    }
    
    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
    
    function isValidPhone(phone) {
        return /^[\d\s\-\+\(\)]+$/.test(phone) && phone.length >= 10;
    }
    
    // Update checkout on field changes
    const updateFields = ['input[name^="billing_"]', 'input[name^="shipping_"]', 'select[name^="billing_"]', 'select[name^="shipping_"]'];
    updateFields.forEach(selector => {
        document.querySelectorAll(selector).forEach(field => {
            field.addEventListener('change', function() {
                document.body.dispatchEvent(new Event('update_checkout'));
            });
        });
    });
    
    // Smooth scrolling for form navigation
    const formSections = document.querySelectorAll('.checkout-main .space-y-6 > div');
    formSections.forEach((section, index) => {
        section.style.scrollMarginTop = '100px';
    });
    
    // Auto-focus first empty required field
    const firstEmptyRequired = checkoutForm?.querySelector('[required]:not([value])');
    if (firstEmptyRequired) {
        setTimeout(() => firstEmptyRequired.focus(), 500);
    }
});
</script>

<?php get_footer(); ?>