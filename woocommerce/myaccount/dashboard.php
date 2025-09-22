<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Hook: woocommerce_before_account_dashboard
 * 
 * Custom hook for adding content before the dashboard
 */
do_action( 'woocommerce_before_account_dashboard' );

// Get current user data
$current_user = wp_get_current_user();
$customer = new WC_Customer( get_current_user_id() );

// Get user statistics
$orders = wc_get_orders( array(
    'customer' => get_current_user_id(),
    'status' => array( 'wc-completed', 'wc-processing', 'wc-on-hold' ),
    'limit' => -1,
) );

$total_orders = count( $orders );
$total_spent = 0;
foreach ( $orders as $order ) {
    $total_spent += $order->get_total();
}

// Get downloads
$downloads = WC()->customer->get_downloadable_products();
$total_downloads = count( $downloads );

// Get user avatar
$avatar_url = get_avatar_url( get_current_user_id(), array( 'size' => 96 ) );

// Format numbers for Persian display
function format_persian_number( $number ) {
    $persian_digits = array( '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' );
    $english_digits = array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' );
    return str_replace( $english_digits, $persian_digits, number_format( $number ) );
}

// Get recent orders for display
$recent_orders = wc_get_orders( array(
    'customer' => get_current_user_id(),
    'limit' => 3,
    'orderby' => 'date',
    'order' => 'DESC',
) );
?>




<div class="flex-1 bg-background">
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-16 gap-8">

            <!-- main content -->
            <div class="col-span-12 lg:col-span-9 md:col-span-8">
                <div class="space-y-8">
                    <!-- welcome message -->
                    <div class="bg-gradient-to-l from-primary to-secondary rounded-3xl p-8">
                        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-5">
                            <div class="space-y-3">
                                <h1 class="font-black text-2xl text-primary-foreground">
                                    <?php
                                    printf(
                                        /* translators: 1: user display name 2: logout url */
                                        __( 'سلام %1$s، خوش آمدید!', 'woocommerce' ),
                                        '<strong>' . esc_html( $current_user->display_name ) . '</strong>'
                                    );
                                    ?>
                                </h1>
                                <p class="text-primary-foreground/80 leading-7">
                                    از طریق پیشخوان حساب کاربری خود می‌توانید سفارش‌های اخیر خود را مشاهده کنید، آدرس‌های حمل و نقل و صورتحساب خود را مدیریت کنید و جزئیات حساب کاربری و رمز عبور خود را ویرایش کنید.
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-primary-foreground/20">
                                    <img src="<?php echo esc_url( $avatar_url ); ?>" 
                                         class="w-full h-full object-cover" 
                                         alt="<?php echo esc_attr( $current_user->display_name ); ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end welcome message -->

                    <!-- statistics:wrapper -->
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
                        <!-- statistics:item -->
                        <div class="flex items-center gap-3 bg-secondary rounded-2xl cursor-default p-3">
                            <span class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M6 3.75A2.75 2.75 0 0 1 8.75 1h2.5A2.75 2.75 0 0 1 14 3.75v.443c.572.055 1.14.122 1.706.2C17.053 4.582 18 5.75 18 7.07v3.469c0 1.126-.694 2.191-1.83 2.54-1.952.599-4.024.921-6.17.921s-4.219-.322-6.17-.921C2.694 12.73 2 11.665 2 10.539V7.07c0-1.321.947-2.489 2.294-2.676A41.047 41.047 0 0 1 6 4.193V3.75Zm6.5 0v.325a41.622 41.622 0 0 0-5 0V3.75c0-.69.56-1.25 1.25-1.25h2.5c.69 0 1.25.56 1.25 1.25ZM10 10a1 1 0 0 0-1 1v.01a1 1 0 0 0 1 1h.01a1 1 0 0 0 1-1V11a1 1 0 0 0-1-1H10Z" clip-rule="evenodd" />
                                    <path d="M3 15.055v-.684c.126.053.255.1.39.142 2.092.642 4.313.987 6.61.987 2.297 0 4.518-.345 6.61-.987.135-.041.264-.089.39-.142v.684c0 1.347-.985 2.53-2.363 2.686a41.454 41.454 0 0 1-9.274 0C3.985 17.585 3 16.402 3 15.055Z" />
                                </svg>
                            </span>
                            <div class="flex flex-col items-start text-right space-y-1">
                                <span class="font-bold text-xs text-muted line-clamp-1">سفارش‌ها</span>
                                <span class="font-bold text-sm text-foreground line-clamp-1"><?php echo format_persian_number( $total_orders ); ?> سفارش</span>
                            </div>
                        </div>
                        <!-- end statistics:item -->

                        <!-- statistics:item -->
                        <div class="flex items-center gap-3 bg-secondary rounded-2xl cursor-default p-3">
                            <span class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M1 6a3 3 0 0 1 3-3h10a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H4a3 3 0 0 1-3-3V6Zm5.5 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Zm2.45-1.5a2.5 2.5 0 0 0-4.9 0h4.9ZM12 12a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm3-1a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <div class="flex flex-col items-start text-right space-y-1">
                                <span class="font-bold text-xs text-muted line-clamp-1">دانلودها</span>
                                <span class="font-bold text-sm text-foreground line-clamp-1"><?php echo format_persian_number( $total_downloads ); ?> فایل</span>
                            </div>
                        </div>
                        <!-- end statistics:item -->

                        <!-- statistics:item -->
                        <div class="flex items-center gap-3 bg-secondary rounded-2xl cursor-default p-3">
                            <span class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-yellow-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <div class="flex flex-col items-start text-right space-y-1">
                                <span class="font-bold text-xs text-muted line-clamp-1">امتیازات</span>
                                <span class="font-bold text-sm text-foreground line-clamp-1"><?php echo format_persian_number( get_user_meta( get_current_user_id(), 'user_points', true ) ?: 0 ); ?> ستاره</span>
                            </div>
                        </div>
                        <!-- end statistics:item -->

                        <!-- statistics:item -->
                        <div class="flex items-center gap-3 bg-secondary rounded-2xl cursor-default p-3">
                            <span class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-violet-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path d="M1 4.25a3.733 3.733 0 0 1 2.25-.75h13.5c.844 0 1.623.279 2.25.75A2.25 2.25 0 0 0 16.75 2H3.25A2.25 2.25 0 0 0 1 4.25ZM1 7.25a3.733 3.733 0 0 1 2.25-.75h13.5c.844 0 1.623.279 2.25.75A2.25 2.25 0 0 0 16.75 5H3.25A2.25 2.25 0 0 0 1 7.25ZM7 8a1 1 0 0 1 1 1 2 2 0 1 0 4 0 1 1 0 0 1 1-1h3.75A2.25 2.25 0 0 1 19 10.25v5.5A2.25 2.25 0 0 1 16.75 18H3.25A2.25 2.25 0 0 1 1 15.75v-5.5A2.25 2.25 0 0 1 3.25 8H7Z" />
                                </svg>
                            </span>
                            <div class="flex flex-col items-start text-right space-y-1">
                                <span class="font-bold text-xs text-muted line-clamp-1">مجموع خرید</span>
                                <div class="flex items-center gap-1">
                                    <span class="font-bold text-sm text-foreground"><?php echo format_persian_number( $total_spent ); ?></span>
                                    <span class="text-xs text-muted">تومان</span>
                                </div>
                            </div>
                        </div>
                        <!-- end statistics:item -->
                    </div>
                    <!-- end statistics:wrapper -->

                    <?php if ( ! empty( $recent_orders ) ) : ?>
                    <!-- section:recent-orders -->
                    <div class="space-y-5">
                        <!-- section:title -->
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-1">
                                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                <div class="w-2 h-2 bg-foreground rounded-full"></div>
                            </div>
                            <div class="font-black text-foreground">سفارش‌های اخیر</div>
                        </div>
                        <!-- end section:title -->

                        <!-- orders list -->
                        <div class="space-y-3">
                            <?php foreach ( $recent_orders as $order ) : ?>
                            <div class="bg-secondary rounded-2xl p-4">
                                <div class="flex items-center justify-between">
                                    <div class="space-y-2">
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-sm text-foreground">سفارش #<?php echo format_persian_number( $order->get_order_number() ); ?></span>
                                            <span class="px-2 py-1 bg-<?php echo $order->get_status() === 'completed' ? 'green' : 'yellow'; ?>-100 text-<?php echo $order->get_status() === 'completed' ? 'green' : 'yellow'; ?>-800 rounded-full text-xs font-semibold">
                                                <?php echo wc_get_order_status_name( $order->get_status() ); ?>
                                            </span>
                                        </div>
                                        <div class="text-xs text-muted">
                                            <?php echo $order->get_date_created()->date_i18n( 'j F Y' ); ?>
                                        </div>
                                    </div>
                                    <div class="text-left">
                                        <div class="font-bold text-sm text-foreground"><?php echo format_persian_number( $order->get_total() ); ?> تومان</div>
                                        <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" class="text-xs text-primary hover:underline">مشاهده جزئیات</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- end orders list -->

                        <div class="text-center">
                            <a href="<?php echo esc_url( wc_get_endpoint_url( 'orders', '', wc_get_page_permalink( 'myaccount' ) ) ); ?>" 
                               class="inline-flex items-center gap-2 text-primary hover:underline">
                                <span>مشاهده همه سفارش‌ها</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd" d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <!-- end section:recent-orders -->
                    <?php endif; ?>

                    <?php if ( ! empty( $downloads ) ) : ?>
                    <!-- section:downloads -->
                    <div class="space-y-5">
                        <!-- section:title -->
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-1">
                                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                <div class="w-2 h-2 bg-foreground rounded-full"></div>
                            </div>
                            <div class="font-black text-foreground">دانلودهای اخیر</div>
                        </div>
                        <!-- end section:title -->

                        <!-- downloads list -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <?php foreach ( array_slice( $downloads, 0, 6 ) as $download ) : ?>
                            <div class="bg-secondary rounded-2xl p-4">
                                <div class="space-y-3">
                                    <h3 class="font-bold text-sm text-foreground line-clamp-2"><?php echo esc_html( $download['product_name'] ); ?></h3>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-muted"><?php echo esc_html( $download['download_name'] ); ?></span>
                                        <a href="<?php echo esc_url( $download['download_url'] ); ?>" 
                                           class="inline-flex items-center gap-1 text-primary hover:underline text-xs">
                                            <span>دانلود</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                <path d="M10.75 2.75a.75.75 0 0 0-1.5 0v8.614L6.295 8.235a.75.75 0 1 0-1.09 1.03l4.25 4.5a.75.75 0 0 0 1.09 0l4.25-4.5a.75.75 0 0 0-1.09-1.03L10.75 11.364V2.75Z" />
                                                <path d="M3.5 12.75a.75.75 0 0 0-1.5 0v2.5A2.75 2.75 0 0 0 4.75 18h10.5A2.75 2.75 0 0 0 18 15.25v-2.5a.75.75 0 0 0-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5Z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- end downloads list -->

                        <div class="text-center">
                            <a href="<?php echo esc_url( wc_get_endpoint_url( 'downloads', '', wc_get_page_permalink( 'myaccount' ) ) ); ?>" 
                               class="inline-flex items-center gap-2 text-primary hover:underline">
                                <span>مشاهده همه دانلودها</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd" d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <!-- end section:downloads -->
                    <?php endif; ?>
                </div>
            </div>
            <!-- end main content -->
        </div>
    </div>
</div>

<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_account_dashboard' );

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_before_my_account' );

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_after_my_account' );

/**
 * Hook: woocommerce_after_account_dashboard
 * 
 * Custom hook for adding content after the dashboard
 */
do_action( 'woocommerce_after_account_dashboard' );