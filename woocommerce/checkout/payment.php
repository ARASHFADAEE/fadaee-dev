<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.8.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! wp_doing_ajax() ) {
    do_action( 'woocommerce_review_order_before_payment' );
}
?>
<div id="payment" class="woocommerce-checkout-payment">
    <?php if ( WC()->cart && WC()->cart->needs_payment() ) : ?>
        <ul class="wc_payment_methods payment_methods methods space-y-4">
            <?php
            if ( ! empty( $available_gateways ) ) {
                foreach ( $available_gateways as $gateway ) {
                    wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
                }
            } else {
                echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info p-4 bg-info/10 border border-info/20 rounded-lg text-info">';
                wc_print_notice( apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'متأسفانه هیچ روش پرداختی در دسترس نیست. لطفاً با ما تماس بگیرید.', 'woocommerce' ) : esc_html__( 'لطفاً اطلاعات خود را در بالا تکمیل کنید تا روش‌های پرداخت نمایش داده شود.', 'woocommerce' ) ), 'notice' );
                echo '</li>';
            }
            ?>
        </ul>
    <?php endif; ?>

    <div class="form-row place-order mt-6">
        <noscript>
            <?php
            /* translators: $1 and $2 opening and closing emphasis tags respectively */
            printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
            ?>
            <br/><button type="submit" class="button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
        </noscript>

        <?php wc_get_template( 'checkout/terms.php' ); ?>

        <?php do_action( 'woocommerce_review_order_before_submit' ); ?>

        <button type="submit" class="button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> w-full bg-primary hover:bg-primary/90 text-primary-foreground font-bold py-4 px-6 rounded-xl transition-colors duration-200 flex items-center justify-center gap-3 mt-4" name="woocommerce_checkout_place_order" id="place_order" value="<?php esc_attr_e( 'Place order', 'woocommerce' ); ?>" data-value="<?php esc_attr_e( 'Place order', 'woocommerce' ); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 0 0-4.5 4.5V9H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-.5V5.5A4.5 4.5 0 0 0 10 1Zm3 8V5.5a3 3 0 1 0-6 0V9h6Z" clip-rule="evenodd" />
            </svg>
            <?php esc_html_e( 'تکمیل خرید', 'woocommerce' ); ?>
        </button>

        <?php do_action( 'woocommerce_review_order_after_submit' ); ?>

        <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
    </div>
</div>

<?php if ( ! wp_doing_ajax() ) : ?>
    <script type="text/javascript">
    /*<![CDATA[*/
    (function() {
        var c = document.body.className;
        c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
        document.body.className = c;
    })();
    /*]]>*/
    </script>
<?php endif; ?>

<style>
/* Payment Methods Styling */
.wc_payment_methods {
    list-style: none;
    padding: 0;
    margin: 0;
}

.wc_payment_method {
    background: rgb(var(--card));
    border: 1px solid rgb(var(--border));
    border-radius: 0.75rem;
    padding: 1rem;
    margin-bottom: 1rem;
    transition: all 0.2s ease;
}

.wc_payment_method:hover {
    border-color: rgb(var(--primary));
    box-shadow: 0 0 0 1px rgb(var(--primary) / 0.1);
}

.wc_payment_method input[type="radio"] {
    margin-left: 0.75rem;
    accent-color: rgb(var(--primary));
}

.wc_payment_method label {
    font-weight: 600;
    color: rgb(var(--foreground));
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.wc_payment_method .payment_method_title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 600;
}

.wc_payment_method .payment_box {
    margin-top: 1rem;
    padding: 1rem;
    background: rgb(var(--muted) / 0.1);
    border-radius: 0.5rem;
    border: 1px solid rgb(var(--border));
}

.wc_payment_method .payment_box p {
    margin: 0;
    color: rgb(var(--muted-foreground));
    font-size: 0.875rem;
    line-height: 1.5;
}

/* Loading state for place order button */
#place_order.loading {
    opacity: 0.7;
    cursor: not-allowed;
    pointer-events: none;
}

#place_order.loading::after {
    content: '';
    width: 16px;
    height: 16px;
    border: 2px solid transparent;
    border-top: 2px solid currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-right: 0.5rem;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

/* Terms and conditions */
.woocommerce-terms-and-conditions-wrapper {
    margin: 1rem 0;
}

.woocommerce-terms-and-conditions-checkbox-text {
    font-size: 0.875rem;
    color: rgb(var(--muted-foreground));
}

.woocommerce-terms-and-conditions-checkbox-text input[type="checkbox"] {
    margin-left: 0.5rem;
    accent-color: rgb(var(--primary));
}

.woocommerce-terms-and-conditions-checkbox-text a {
    color: rgb(var(--primary));
    text-decoration: underline;
}

.woocommerce-terms-and-conditions-checkbox-text a:hover {
    color: rgb(var(--primary) / 0.8);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const placeOrderButton = document.getElementById('place_order');
    const checkoutForm = document.querySelector('form.checkout');
    
    if (placeOrderButton && checkoutForm) {
        // Add loading state to place order button
        checkoutForm.addEventListener('submit', function() {
            placeOrderButton.classList.add('loading');
            placeOrderButton.disabled = true;
        });
        
        // Remove loading state if form submission fails
        document.addEventListener('checkout_error', function() {
            placeOrderButton.classList.remove('loading');
            placeOrderButton.disabled = false;
        });
    }
    
    // Payment method selection
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            // Hide all payment boxes
            document.querySelectorAll('.payment_box').forEach(box => {
                box.style.display = 'none';
            });
            
            // Show selected payment box
            const selectedBox = this.closest('.wc_payment_method').querySelector('.payment_box');
            if (selectedBox) {
                selectedBox.style.display = 'block';
            }
            
            // Update checkout
            document.body.dispatchEvent(new Event('update_checkout'));
        });
    });
    
    // Initialize payment method display
    const selectedMethod = document.querySelector('input[name="payment_method"]:checked');
    if (selectedMethod) {
        selectedMethod.dispatchEvent(new Event('change'));
    }
});
</script>