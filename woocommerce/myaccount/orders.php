<main class="flex-auto py-5">
            <div class="max-w-7xl space-y-14 px-4 mx-auto">
                <div class="grid md:grid-cols-16 grid-cols-1 items-start gap-5">


                    <div class="lg:col-span-9 md:col-span-8">
                        <div class="space-y-10">
                            <div class="space-y-5">
                                <!-- section:title -->
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center gap-1">
                                        <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                        <div class="w-2 h-2 bg-foreground rounded-full"></div>
                                    </div>
                                    <div class="font-black text-foreground">تاریخچه تراکنشها</div>
                                </div>
                                <!-- end section:title -->

                                <?php
                                // Get customer orders
                                $current_page = empty( get_query_var( 'orders' ) ) ? 1 : absint( get_query_var( 'orders' ) );
                                $customer_orders = wc_get_orders( apply_filters( 'woocommerce_my_account_my_orders_query', array(
                                    'customer' => get_current_user_id(),
                                    'page'     => $current_page,
                                    'paginate' => true,
                                    'limit'    => 10,
                                ) ) );

                                $has_orders = 0 < $customer_orders->total;
                                ?>

                                <?php if ( $has_orders ) : ?>
                                <div class="relative overflow-x-auto">
                                    <table class="w-full text-sm text-right">
                                        <thead
                                            class="text-xs text-muted uppercase bg-background border-b border-border">
                                            <tr>
                                                <th class="whitespace-nowrap p-5">شماره سفارش</th>
                                                <th class="whitespace-nowrap p-5">وضعیت</th>
                                                <th class="whitespace-nowrap p-5">محصولات</th>
                                                <th class="whitespace-nowrap p-5">مبلغ</th>
                                                <th class="whitespace-nowrap p-5">تاریخ ایجاد</th>
                                                <th class="whitespace-nowrap p-5">عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ( $customer_orders->orders as $customer_order ) :
                                                $order = wc_get_order( $customer_order );
                                                $item_count = $order->get_item_count() - $order->get_item_count_refunded();
                                                $order_status = $order->get_status();
                                                
                                                // Status styling
                                                $status_color = '';
                                                $status_bg = '';
                                                switch ( $order_status ) {
                                                    case 'completed':
                                                        $status_color = 'text-green-500';
                                                        $status_bg = 'bg-green-500/20';
                                                        $status_dot = 'bg-green-500';
                                                        $status_text = 'تکمیل شده';
                                                        break;
                                                    case 'processing':
                                                        $status_color = 'text-blue-500';
                                                        $status_bg = 'bg-blue-500/20';
                                                        $status_dot = 'bg-blue-500';
                                                        $status_text = 'در حال پردازش';
                                                        break;
                                                    case 'on-hold':
                                                        $status_color = 'text-yellow-500';
                                                        $status_bg = 'bg-yellow-500/20';
                                                        $status_dot = 'bg-yellow-500';
                                                        $status_text = 'در انتظار';
                                                        break;
                                                    case 'cancelled':
                                                        $status_color = 'text-red-500';
                                                        $status_bg = 'bg-red-500/20';
                                                        $status_dot = 'bg-red-500';
                                                        $status_text = 'لغو شده';
                                                        break;
                                                    case 'refunded':
                                                        $status_color = 'text-purple-500';
                                                        $status_bg = 'bg-purple-500/20';
                                                        $status_dot = 'bg-purple-500';
                                                        $status_text = 'بازگردانده شده';
                                                        break;
                                                    case 'failed':
                                                        $status_color = 'text-red-600';
                                                        $status_bg = 'bg-red-600/20';
                                                        $status_dot = 'bg-red-600';
                                                        $status_text = 'ناموفق';
                                                        break;
                                                    default:
                                                        $status_color = 'text-gray-500';
                                                        $status_bg = 'bg-gray-500/20';
                                                        $status_dot = 'bg-gray-500';
                                                        $status_text = 'در انتظار پرداخت';
                                                        break;
                                                }
                                            ?>
                                            <tr class="odd:bg-secondary even:bg-background">
                                                <td class="p-5">
                                                    <div class="font-black text-sm text-foreground">
                                                        <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" class="hover:text-primary">
                                                            #<?php echo $order->get_order_number(); ?>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="p-5">
                                                    <div class="flex items-center gap-2">
                                                        <div class="flex-shrink-0 rounded-full <?php echo esc_attr( $status_bg ); ?> p-1">
                                                            <div class="h-1.5 w-1.5 rounded-full <?php echo esc_attr( $status_dot ); ?>"></div>
                                                        </div>
                                                        <span class="font-bold <?php echo esc_attr( $status_color ); ?>"><?php echo esc_html( $status_text ); ?></span>
                                                    </div>
                                                </td>
                                                <td class="p-5">
                                                    <div class="flex flex-col items-start gap-1 w-36">
                                                        <?php 
                                                        $items = $order->get_items();
                                                        $first_item = reset( $items );
                                                        if ( $first_item ) :
                                                        ?>
                                                            <span class="font-bold text-xs text-muted">
                                                                <?php printf( _n( '%s محصول', '%s محصول', $item_count, 'woocommerce' ), $item_count ); ?>
                                                            </span>
                                                            <span class="font-black text-sm text-foreground line-clamp-1">
                                                                <?php echo esc_html( $first_item->get_name() ); ?>
                                                                <?php if ( $item_count > 1 ) : ?>
                                                                    <span class="text-muted">و <?php echo ($item_count - 1); ?> مورد دیگر</span>
                                                                <?php endif; ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td class="p-5">
                                                    <div class="flex items-center gap-1">
                                                        <span class="font-black text-sm text-foreground">
                                                            <?php echo $order->get_formatted_order_total(); ?>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="p-5">
                                                    <div class="text-xs text-muted whitespace-nowrap">
                                                        <time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>">
                                                            <?php echo esc_html( wc_format_datetime( $order->get_date_created(), 'j F Y' ) ); ?>
                                                        </time>
                                                    </div>
                                                </td>
                                                <td class="p-5">
                                                    <div class="flex items-center gap-2">
                                                        <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" 
                                                           class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium text-primary bg-primary/10 rounded-full hover:bg-primary/20 transition-colors">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                            </svg>
                                                            مشاهده
                                                        </a>
                                                        
                                                        <?php if ( $order->get_status() === 'completed' && $order->has_downloadable_item() ) : ?>
                                                            <button class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium text-green-600 bg-green-100 rounded-full hover:bg-green-200 transition-colors show-downloads" 
                                                                    data-order="<?php echo esc_attr($order->get_id()); ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                                </svg>
                                                                دانلود
                                                            </button>
                                                        <?php endif; ?>
                                                        
                                                        <?php
                                                        $actions = wc_get_account_orders_actions( $order );
                                                        if ( ! empty( $actions ) ) {
                                                            foreach ( $actions as $key => $action ) {
                                                                $btn_class = 'text-gray-600 bg-gray-100 hover:bg-gray-200';
                                                                
                                                                if ( $key === 'cancel' ) {
                                                                    $btn_class = 'text-red-600 bg-red-100 hover:bg-red-200';
                                                                } elseif ( $key === 'pay' ) {
                                                                    $btn_class = 'text-blue-600 bg-blue-100 hover:bg-blue-200';
                                                                }
                                                                
                                                                echo '<a href="' . esc_url( $action['url'] ) . '" class="inline-flex items-center gap-1 px-3 py-1 text-xs font-medium ' . esc_attr( $btn_class ) . ' rounded-full transition-colors ' . sanitize_html_class( $key ) . '">';
                                                                echo esc_html( $action['name'] );
                                                                echo '</a>';
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <?php if ( 1 < $customer_orders->max_num_pages ) : ?>
                                    <div class="flex items-center justify-between mt-6 p-4 bg-background rounded-lg border border-border">
                                        <div class="text-sm text-muted">
                                            <?php printf( __( 'صفحه %d از %d', 'woocommerce' ), $current_page, $customer_orders->max_num_pages ); ?>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <?php if ( 1 !== $current_page ) : ?>
                                                <a class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-foreground bg-background border border-border rounded-lg hover:bg-secondary transition-colors" 
                                                   href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                                    </svg>
                                                    قبلی
                                                </a>
                                            <?php endif; ?>

                                            <?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
                                                <a class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-foreground bg-background border border-border rounded-lg hover:bg-secondary transition-colors" 
                                                   href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>">
                                                    بعدی
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                                    </svg>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php else : ?>
                                    <div class="flex flex-col items-center justify-center py-12 text-center">
                                        <div class="w-16 h-16 mb-4 text-muted">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-foreground mb-2"><?php _e( 'هیچ سفارشی یافت نشد', 'woocommerce' ); ?></h3>
                                        <p class="text-muted mb-6"><?php _e( 'شما هنوز هیچ خریدی انجام نداده‌اید.', 'woocommerce' ); ?></p>
                                        <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" 
                                           class="inline-flex items-center gap-2 px-6 py-3 text-sm font-medium text-primary-foreground bg-primary rounded-lg hover:bg-primary/90 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                            </svg>
                                            <?php _e( 'شروع خرید', 'woocommerce' ); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>