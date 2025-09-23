<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;

get_header(); ?>

<main class="flex-auto py-5">
    <div class="max-w-4xl px-4 mx-auto">
        
        <div class="woocommerce-order">

            <?php
            if ( $order ) :
                do_action( 'woocommerce_before_thankyou', $order->get_id() );
            ?>

                <?php if ( $order->has_status( 'failed' ) ) : ?>
                    <!-- Failed Order -->
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-error/10 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-10 h-10 text-error">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-error mb-4">خطا در پردازش سفارش</h1>
                        <p class="text-muted-foreground mb-6">متأسفانه سفارش شما قابل پردازش نیست. لطفاً مجدداً تلاش کنید.</p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" 
                               class="inline-flex items-center justify-center px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-xl hover:bg-primary/90 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 ml-2">
                                    <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 0 0-4.5 4.5V9H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-.5V5.5A4.5 4.5 0 0 0 10 1Zm3 8V5.5a3 3 0 1 0-6 0V9h6Z" clip-rule="evenodd" />
                                </svg>
                                پرداخت مجدد
                            </a>
                            <?php if ( is_user_logged_in() ) : ?>
                                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" 
                                   class="inline-flex items-center justify-center px-6 py-3 bg-secondary text-secondary-foreground font-semibold rounded-xl hover:bg-secondary/90 transition-colors">
                                    حساب کاربری من
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php else : ?>
                    <!-- Successful Order -->
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-success/10 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-10 h-10 text-success">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.236 4.53L8.23 10.661a.75.75 0 0 0-1.06 1.06l1.5 1.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold text-success mb-4">سفارش شما با موفقیت ثبت شد!</h1>
                        <p class="text-lg text-muted-foreground mb-2">از خرید شما متشکریم</p>
                        <p class="text-sm text-muted-foreground mb-8">شماره سفارش: <span class="font-semibold text-foreground">#<?php echo $order->get_order_number(); ?></span></p>
                    </div>

                    <!-- Order Details -->
                    <div class="grid md:grid-cols-2 gap-8 mb-8">
                        <!-- Order Information -->
                        <div class="bg-card border border-border rounded-2xl p-6">
                            <h3 class="font-bold text-lg text-foreground mb-4 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-primary">
                                    <path fill-rule="evenodd" d="M4.5 2A1.5 1.5 0 0 0 3 3.5v13A1.5 1.5 0 0 0 4.5 18h11a1.5 1.5 0 0 0 1.5-1.5V7.621a1.5 1.5 0 0 0-.44-1.06L14.439 4.44A1.5 1.5 0 0 0 13.378 4H4.5Zm2.25 8.5a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Zm0 3a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Z" clip-rule="evenodd" />
                                </svg>
                                اطلاعات سفارش
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center py-2 border-b border-border">
                                    <span class="text-muted-foreground">شماره سفارش:</span>
                                    <span class="font-semibold text-foreground">#<?php echo $order->get_order_number(); ?></span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-border">
                                    <span class="text-muted-foreground">تاریخ:</span>
                                    <span class="font-semibold text-foreground"><?php echo wc_format_datetime( $order->get_date_created() ); ?></span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-border">
                                    <span class="text-muted-foreground">ایمیل:</span>
                                    <span class="font-semibold text-foreground"><?php echo $order->get_billing_email(); ?></span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-border">
                                    <span class="text-muted-foreground">تلفن:</span>
                                    <span class="font-semibold text-foreground"><?php echo $order->get_billing_phone(); ?></span>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <span class="text-muted-foreground">روش پرداخت:</span>
                                    <span class="font-semibold text-foreground"><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></span>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- Order Items -->
                    <div class="bg-card border border-border rounded-2xl p-6 mb-8">
                        <h3 class="font-bold text-lg text-foreground mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-primary">
                                <path fill-rule="evenodd" d="M6 5v1H4.667a1.75 1.75 0 0 0-1.743 1.598l-.826 9.5A1.75 1.75 0 0 0 3.84 19H16.16a1.75 1.75 0 0 0 1.742-1.902l-.826-9.5A1.75 1.75 0 0 0 15.333 6H14V5a4 4 0 0 0-8 0Zm4-2.5A2.5 2.5 0 0 0 7.5 5v1h5V5A2.5 2.5 0 0 0 10 2.5ZM7.5 10a2.5 2.5 0 0 0 5 0V8.75a.75.75 0 0 1 1.5 0V10a4 4 0 0 1-8 0V8.75a.75.75 0 0 1 1.5 0V10Z" clip-rule="evenodd" />
                            </svg>
                            آیتم‌های سفارش
                        </h3>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-border">
                                        <th class="text-right py-3 font-semibold text-foreground">محصول</th>
                                        <th class="text-center py-3 font-semibold text-foreground">تعداد</th>
                                        <th class="text-left py-3 font-semibold text-foreground">قیمت</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-border">
                                    <?php
                                    foreach ( $order->get_items() as $item_id => $item ) {
                                        $product_id = $item['product_id'] ?? 0;
                                        $product = $product_id ? wc_get_product( $product_id ) : null;
                                        ?>
                                        <tr>
                                            <td class="py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-12 h-12 rounded-lg overflow-hidden bg-muted flex-shrink-0">
                                                        <?php
                                                        if ( $product && is_a( $product, 'WC_Product' ) ) {
                                                            echo $product->get_image( array( 48, 48 ) );
                                                        } else {
                                                            echo '<div class="w-full h-full bg-muted flex items-center justify-center text-muted-foreground">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                                </svg>
                                                            </div>';
                                                        }
                                                        ?>
                                                    </div>
                                                    <div>
                                                        <h4 class="font-medium text-foreground text-sm"><?php echo wp_kses_post( $item->get_name() ); ?></h4>
                                                        <?php
                                                        $item_meta = wc_display_item_meta( $item, array(
                                                            'before'    => '<div class="text-xs text-muted-foreground mt-1">',
                                                            'after'     => '</div>',
                                                            'separator' => '<br>',
                                                            'echo'      => false,
                                                        ) );
                                                        echo wp_kses_post( $item_meta );
                                                        ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 text-center font-semibold text-foreground"><?php echo esc_html( $item->get_quantity() ); ?></td>
                                            <td class="py-4 text-left font-semibold text-foreground"><?php echo $order->get_formatted_line_subtotal( $item ); ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="border-t border-border">
                                    <tr>
                                        <td colspan="2" class="py-3 text-right font-semibold text-foreground">مجموع:</td>
                                        <td class="py-3 text-left font-bold text-lg text-primary"><?php echo $order->get_formatted_order_total(); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                           class="inline-flex items-center justify-center px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-xl hover:bg-primary/90 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 ml-2">
                                <path fill-rule="evenodd" d="M6 5v1H4.667a1.75 1.75 0 0 0-1.743 1.598l-.826 9.5A1.75 1.75 0 0 0 3.84 19H16.16a1.75 1.75 0 0 0 1.742-1.902l-.826-9.5A1.75 1.75 0 0 0 15.333 6H14V5a4 4 0 0 0-8 0Zm4-2.5A2.5 2.5 0 0 0 7.5 5v1h5V5A2.5 2.5 0 0 0 10 2.5ZM7.5 10a2.5 2.5 0 0 0 5 0V8.75a.75.75 0 0 1 1.5 0V10a4 4 0 0 1-8 0V8.75a.75.75 0 0 1 1.5 0V10Z" clip-rule="evenodd" />
                            </svg>
                            ادامه خرید
                        </a>
                        <?php if ( is_user_logged_in() ) : ?>
                            <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" 
                               class="inline-flex items-center justify-center px-6 py-3 bg-secondary text-secondary-foreground font-semibold rounded-xl hover:bg-secondary/90 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 ml-2">
                                    <path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z" />
                                </svg>
                                حساب کاربری من
                            </a>
                        <?php endif; ?>
                    </div>

                <?php endif; ?>

                <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

            <?php else : ?>
                <!-- No Order Found -->
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-muted rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-10 h-10 text-muted-foreground">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-foreground mb-4">سفارشی یافت نشد</h1>
                    <p class="text-muted-foreground mb-6">متأسفانه اطلاعات سفارش شما در دسترس نیست.</p>
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" 
                       class="inline-flex items-center justify-center px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-xl hover:bg-primary/90 transition-colors">
                        بازگشت به فروشگاه
                    </a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</main>

<?php get_footer(); ?>