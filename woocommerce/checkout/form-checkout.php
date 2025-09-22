<?php
/**
 * Checkout Form
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

<main class="flex-auto py-5">
    <div class="max-w-7xl px-4 mx-auto">
        <!-- Page Header -->
        <div class="flex items-center justify-between gap-8 bg-gradient-to-l from-secondary to-background rounded-2xl p-5 mb-8">
            <div class="flex items-center gap-5">
                <span class="flex items-center justify-center w-12 h-12 bg-primary text-primary-foreground rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M10 2.5c-1.31 0-2.526.386-3.546 1.051a.75.75 0 0 1-.82-1.256A8.25 8.25 0 0 1 18.75 10c0 1.455-.309 2.84-.865 4.092a.75.75 0 0 1-1.373-.596A6.75 6.75 0 0 0 17.25 10 6.75 6.75 0 0 0 10 3.25c-.414 0-.828.034-1.23.1a.75.75 0 1 1-.14-1.492c.466-.077.947-.108 1.37-.108ZM3.107 4.393a.75.75 0 0 1 .82 1.256A6.75 6.75 0 0 0 2.75 10c0 1.455.309 2.84.865 4.092a.75.75 0 0 1-1.373.596A8.25 8.25 0 0 1 1.25 10c0-1.455.309-2.84.865-4.092a.75.75 0 0 1 .992-.515Z" clip-rule="evenodd" />
                    </svg>
                </span>
                <div class="flex flex-col space-y-2">
                    <span class="font-black xs:text-2xl text-lg text-primary">تکمیل خرید</span>
                    <span class="font-semibold text-xs text-muted">اطلاعات خود را وارد کنید</span>
                </div>
            </div>
        </div>

        <?php
        do_action( 'woocommerce_before_checkout_form', $checkout );

        // If checkout registration is disabled and not logged in, the user cannot checkout.
        if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
            echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
            return;
        }
        ?>

        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

            <div class="grid lg:grid-cols-2 grid-cols-1 gap-8">
                <!-- Billing & Shipping Information -->
                <div class="space-y-6">
                    <?php if ( $checkout->get_checkout_fields() ) : ?>

                        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                        <!-- Coupon Form -->
                        <?php if ( wc_coupons_enabled() ) : ?>
                            <div class="bg-card border border-border rounded-2xl p-6">
                                <h3 class="font-bold text-lg text-foreground mb-4">کد تخفیف</h3>
                                <?php wc_get_template( 'checkout/form-coupon.php' ); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Billing Fields -->
                        <div class="bg-card border border-border rounded-2xl p-6">
                            <h3 class="font-bold text-lg text-foreground mb-4">اطلاعات صورتحساب</h3>
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>
                        </div>

                        <!-- Shipping Fields -->
                        <?php if ( WC()->cart->needs_shipping_address() === true ) : ?>
                            <div class="bg-card border border-border rounded-2xl p-6">
                                <h3 class="font-bold text-lg text-foreground mb-4">اطلاعات ارسال</h3>
                                <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Additional Fields -->
                        <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

                    <?php endif; ?>

                    <!-- Order Notes -->
                    <?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_checkout_notes_field' ) ) ) : ?>
                        <div class="bg-card border border-border rounded-2xl p-6">
                            <h3 class="font-bold text-lg text-foreground mb-4">یادداشت سفارش</h3>
                            <?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
                                <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Order Review & Payment -->
                <div class="space-y-6">
                    <!-- Order Review -->
                    <div class="bg-card border border-border rounded-2xl p-6">
                        <h3 class="font-bold text-lg text-foreground mb-4">بررسی سفارش</h3>
                        <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
                        <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                        <div id="order_review" class="woocommerce-checkout-review-order">
                            <?php wc_get_template( 'checkout/review-order.php' ); ?>
                        </div>

                        <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
                    </div>

                    <!-- Payment Methods -->
                    <div class="bg-card border border-border rounded-2xl p-6">
                        <h3 class="font-bold text-lg text-foreground mb-4">روش پرداخت</h3>
                        <?php wc_get_template( 'checkout/payment.php' ); ?>
                    </div>
                </div>
            </div>

        </form>

        <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const checkoutForm = document.querySelector('form.checkout');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function(e) {
            const requiredFields = checkoutForm.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('border-error');
                    
                    // Remove error class on input
                    field.addEventListener('input', function() {
                        this.classList.remove('border-error');
                    });
                } else {
                    field.classList.remove('border-error');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                // Scroll to first error field
                const firstError = checkoutForm.querySelector('.border-error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
        });
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
});
</script>

<?php get_footer(); ?>