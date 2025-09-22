<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>
<table class="shop_table woocommerce-checkout-review-order-table w-full">
    <thead>
        <tr class="border-b border-border">
            <th class="product-name text-right py-3 font-semibold text-foreground"><?php esc_html_e( 'محصول', 'woocommerce' ); ?></th>
            <th class="product-total text-left py-3 font-semibold text-foreground"><?php esc_html_e( 'مجموع', 'woocommerce' ); ?></th>
        </tr>
    </thead>
    <tbody class="divide-y divide-border">
        <?php
        do_action( 'woocommerce_review_order_before_cart_contents' );

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                ?>
                <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                    <td class="product-name py-4">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden bg-muted">
                                <?php
                                $thumbnail = $_product->get_image( array( 64, 64 ) );
                                if ( $thumbnail ) {
                                    echo $thumbnail;
                                } else {
                                    echo '<div class="w-full h-full bg-muted flex items-center justify-center text-muted-foreground">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                    </div>';
                                }
                                ?>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-medium text-foreground text-sm leading-tight">
                                    <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
                                </h4>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs text-muted-foreground">تعداد:</span>
                                    <span class="text-xs font-medium text-foreground"><?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                                </div>
                                <?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </div>
                        </div>
                    </td>
                    <td class="product-total py-4 text-left">
                        <span class="font-semibold text-foreground">
                            <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </span>
                    </td>
                </tr>
                <?php
            }
        }

        do_action( 'woocommerce_review_order_after_cart_contents' );
        ?>
    </tbody>
    <tfoot class="border-t border-border">

        <tr class="cart-subtotal">
            <th class="py-3 text-right font-medium text-muted-foreground"><?php esc_html_e( 'جمع جزء', 'woocommerce' ); ?></th>
            <td class="py-3 text-left font-semibold text-foreground"><?php wc_cart_totals_subtotal_html(); ?></td>
        </tr>

        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
            <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                <th class="py-2 text-right font-medium text-muted-foreground">
                    <?php wc_cart_totals_coupon_label( $coupon ); ?>
                </th>
                <td class="py-2 text-left font-semibold text-success">
                    <?php wc_cart_totals_coupon_html( $coupon ); ?>
                </td>
            </tr>
        <?php endforeach; ?>

        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

            <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

            <?php wc_cart_totals_shipping_html(); ?>

            <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

        <?php endif; ?>

        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
            <tr class="fee">
                <th class="py-2 text-right font-medium text-muted-foreground"><?php echo esc_html( $fee->name ); ?></th>
                <td class="py-2 text-left font-semibold text-foreground"><?php wc_cart_totals_fee_html( $fee ); ?></td>
            </tr>
        <?php endforeach; ?>

        <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
            <?php if ( 'itemized' === get_option( 'woocommerce_tax_display_cart' ) ) : ?>
                <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
                    <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                        <th class="py-2 text-right font-medium text-muted-foreground"><?php echo esc_html( $tax->label ); ?></th>
                        <td class="py-2 text-left font-semibold text-foreground"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr class="tax-total">
                    <th class="py-2 text-right font-medium text-muted-foreground"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
                    <td class="py-2 text-left font-semibold text-foreground"><?php wc_cart_totals_taxes_total_html(); ?></td>
                </tr>
            <?php endif; ?>
        <?php endif; ?>

        <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

        <tr class="order-total border-t border-border">
            <th class="py-4 text-right font-bold text-lg text-foreground"><?php esc_html_e( 'مجموع', 'woocommerce' ); ?></th>
            <td class="py-4 text-left font-bold text-lg text-primary"><?php wc_cart_totals_order_total_html(); ?></td>
        </tr>

        <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

    </tfoot>
</table>

<style>
/* Order Review Table Styling */
.woocommerce-checkout-review-order-table {
    border-collapse: collapse;
    background: transparent;
}

.woocommerce-checkout-review-order-table th,
.woocommerce-checkout-review-order-table td {
    border: none;
    vertical-align: top;
}

.woocommerce-checkout-review-order-table .product-name img {
    width: 64px;
    height: 64px;
    object-fit: cover;
    border-radius: 0.5rem;
}

.woocommerce-checkout-review-order-table .product-quantity {
    font-weight: 600;
    color: rgb(var(--primary));
}

.woocommerce-checkout-review-order-table .woocommerce-Price-amount {
    font-weight: 600;
}

.woocommerce-checkout-review-order-table .order-total .woocommerce-Price-amount {
    font-size: 1.125rem;
    font-weight: 700;
    color: rgb(var(--primary));
}

/* Shipping methods */
.woocommerce-shipping-methods {
    list-style: none;
    padding: 0;
    margin: 0;
}

.woocommerce-shipping-methods li {
    margin-bottom: 0.5rem;
}

.woocommerce-shipping-methods label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
    cursor: pointer;
    padding: 0.75rem;
    border: 1px solid rgb(var(--border));
    border-radius: 0.5rem;
    transition: all 0.2s ease;
}

.woocommerce-shipping-methods label:hover {
    border-color: rgb(var(--primary));
    background: rgb(var(--primary) / 0.05);
}

.woocommerce-shipping-methods input[type="radio"] {
    accent-color: rgb(var(--primary));
}

.woocommerce-shipping-methods input[type="radio"]:checked + label {
    border-color: rgb(var(--primary));
    background: rgb(var(--primary) / 0.1);
}

/* Coupon styling */
.cart-discount td {
    color: rgb(var(--success)) !important;
}

.cart-discount .woocommerce-remove-coupon {
    color: rgb(var(--error));
    text-decoration: none;
    margin-right: 0.5rem;
    font-size: 0.875rem;
}

.cart-discount .woocommerce-remove-coupon:hover {
    color: rgb(var(--error) / 0.8);
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .woocommerce-checkout-review-order-table th,
    .woocommerce-checkout-review-order-table td {
        padding: 0.75rem 0;
    }
    
    .woocommerce-checkout-review-order-table .product-name {
        padding-left: 0;
    }
    
    .woocommerce-checkout-review-order-table .product-total {
        padding-right: 0;
    }
}
</style>