<?php get_header(); ?>

<main class="flex-auto py-5">
    <div x-data="{ modalOpen: false, deleteItemKey: null }" id="cart-container">
        <!-- container -->
        <div class="max-w-7xl space-y-14 px-4 mx-auto">
            <div class="flex md:flex-nowrap flex-wrap items-start gap-5">
                <div class="md:w-8/12 w-full">
                    <!-- section:title -->
                    <div class="flex items-center justify-between gap-8 bg-gradient-to-l from-secondary to-background rounded-2xl p-5">
                        <div class="flex items-center gap-5">
                            <span class="flex items-center justify-center w-12 h-12 bg-primary text-primary-foreground rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M9.664 1.319a.75.75 0 0 1 .672 0 41.059 41.059 0 0 1 8.198 5.424.75.75 0 0 1-.254 1.285 31.372 31.372 0 0 0-7.86 3.83.75.75 0 0 1-.84 0 31.508 31.508 0 0 0-2.08-1.287V9.394c0-.244.116-.463.302-.592a35.504 35.504 0 0 1 3.305-2.033.75.75 0 0 0-.714-1.319 37 37 0 0 0-3.446 2.12A2.216 2.216 0 0 0 6 9.393v.38a31.293 31.293 0 0 0-4.28-1.746.75.75 0 0 1-.254-1.285 41.059 41.059 0 0 1 8.198-5.424ZM6 11.459a29.848 29.848 0 0 0-2.455-1.158 41.029 41.029 0 0 0-.39 3.114.75.75 0 0 0 .419.74c.528.256 1.046.53 1.554.82-.21.324-.455.63-.739.914a.75.75 0 1 0 1.06 1.06c.37-.369.69-.77.96-1.193a26.61 26.61 0 0 1 3.095 2.348.75.75 0 0 0 .992 0 26.547 26.547 0 0 1 5.93-3.95.75.75 0 0 0 .42-.739 41.053 41.053 0 0 0-.39-3.114 29.925 29.925 0 0 0-5.199 2.801 2.25 2.25 0 0 1-2.514 0c-.41-.275-.826-.541-1.25-.797a6.985 6.985 0 0 1-1.084 3.45 26.503 26.503 0 0 0-1.281-.78A5.487 5.487 0 0 0 6 12v-.54Z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <div class="flex flex-col space-y-2">
                                <span class="font-black xs:text-2xl text-lg text-primary">سبد خرید شما</span>
                                <span class="font-semibold text-xs text-muted" id="cart-count">
                                    <?php 
                                    $cart_count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
                                    echo $cart_count . ' دوره در سبد خرید';
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- end section:title -->

                    <!-- cart-items:wrapper -->
                    <div class="divide-y divide-dashed divide-border" id="cart-items-wrapper">
                        <?php if (WC()->cart && !WC()->cart->is_empty()) : ?>
                            <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) : 
                                $product = $cart_item['data'];
                                $product_id = $cart_item['product_id'];
                                $quantity = $cart_item['quantity'];
                                $product_permalink = $product->get_permalink($cart_item);
                                $thumbnail = $product->get_image();
                                $product_name = $product->get_name();
                                $product_price = WC()->cart->get_product_price($product);
                                $product_subtotal = WC()->cart->get_product_subtotal($product, $quantity);
                            ?>
                            <!-- cart-item -->
                            <div class="flex sm:flex-nowrap flex-wrap items-start gap-8 relative py-6 cart-item" data-cart-key="<?php echo esc_attr($cart_item_key); ?>">
                                <div class="sm:w-4/12 w-full relative z-10">
                                    <a href="<?php echo esc_url($product_permalink); ?>" class="block">
                                        <?php echo $thumbnail; ?>
                                    </a>
                                    <button type="button"
                                        class="remove-item flex-shrink-0 absolute right-1/2 translate-x-1/2 -translate-y-6 w-11 h-11 inline-flex items-center justify-center bg-error rounded-full text-error-foreground shadow-2xl"
                                        data-cart-key="<?php echo esc_attr($cart_item_key); ?>"
                                        x-on:click="deleteItemKey = '<?php echo esc_attr($cart_item_key); ?>'; modalOpen = true">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18 18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="sm:w-8/12 w-full">
                                    <div class="bg-gradient-to-b from-secondary to-background rounded-3xl">
                                        <div class="bg-background rounded-b-3xl space-y-2 p-5 mx-5">
                                            <div class="flex items-center gap-2">
                                                <span class="block w-1 h-1 bg-success rounded-full"></span>
                                                <span class="font-bold text-xs text-success">موجود</span>
                                            </div>
                                            <h2 class="font-bold text-sm">
                                                <a href="<?php echo esc_url($product_permalink); ?>"
                                                    class="line-clamp-1 text-foreground transition-colors hover:text-primary">
                                                    <?php echo esc_html($product_name); ?>
                                                </a>
                                            </h2>
                                        </div>
                                        <div class="space-y-3 p-5">
                                            <?php 
                                            // Check if product is a course
                                            $product_type = get_post_meta($product_id, '_product_type', true);
                                            
                                            if ($product_type === 'course') :
                                                // Get product meta data for courses only
                                                $chapters = get_post_meta($product_id, '_course_chapters', true) ?: '5';
                                                $duration = get_post_meta($product_id, '_course_duration', true) ?: '25';
                                                $instructor = get_post_meta($product_id, '_course_instructor', true) ?: 'مدرس دوره';
                                                $instructor_avatar = get_post_meta($product_id, '_course_instructor_avatar', true);
                                                
                                                // Use custom instructor avatar if available, otherwise use default
                                                if (empty($instructor_avatar)) {
                                                    $instructor_avatar = get_avatar_url(get_current_user_id(), array('size' => 40));
                                                }
                                            ?>
                                            <div class="flex flex-wrap items-center gap-3">
                                                <div class="flex items-center gap-1 text-muted">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="w-5 h-5">
                                                        <path
                                                            d="M7 3.5A1.5 1.5 0 0 1 8.5 2h3.879a1.5 1.5 0 0 1 1.06.44l3.122 3.12A1.5 1.5 0 0 1 17 6.622V12.5a1.5 1.5 0 0 1-1.5 1.5h-1v-3.379a3 3 0 0 0-.879-2.121L10.5 5.379A3 3 0 0 0 8.379 4.5H7v-1Z">
                                                        </path>
                                                        <path
                                                            d="M4.5 6A1.5 1.5 0 0 0 3 7.5v9A1.5 1.5 0 0 0 4.5 18h7a1.5 1.5 0 0 0 1.5-1.5v-5.879a1.5 1.5 0 0 0-.44-1.06L9.44 6.439A1.5 1.5 0 0 0 8.378 6H4.5Z">
                                                        </path>
                                                    </svg>
                                                    <span class="font-semibold text-xs"><?php echo esc_html($chapters); ?> فصل</span>
                                                </div>
                                                <span class="block w-1 h-1 bg-muted-foreground rounded-full"></span>
                                                <div class="flex items-center gap-1 text-muted">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="w-5 h-5">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="font-semibold text-xs"><?php echo esc_html($duration); ?> ساعت</span>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between gap-5">
                                                <div class="flex items-center gap-3">
                                                    <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                                                        <img src="<?php echo esc_url($instructor_avatar); ?>"
                                                            class="w-full h-full object-cover" alt="<?php echo esc_attr($instructor); ?>" />
                                                    </div>
                                                    <div class="flex flex-col items-start space-y-1">
                                                        <span class="line-clamp-1 font-semibold text-xs text-muted">مدرس دوره:</span>
                                                        <span class="line-clamp-1 font-bold text-xs text-foreground"><?php echo esc_html($instructor); ?></span>
                                                    </div>
                                                </div>
                                            <?php else : ?>
                                            <!-- For digital products, show minimal info -->
                                            <div class="flex items-center justify-between gap-5">
                                            <?php endif; ?>
                                                <div class="flex flex-col items-end justify-center h-14">
                                                    <?php if ($product->get_regular_price() && $product->get_regular_price() != $product->get_price()) : ?>
                                                        <span class="line-through text-muted"><?php echo wc_price($product->get_regular_price()); ?></span>
                                                    <?php endif; ?>
                                                    <div class="flex items-center gap-1">
                                                        <?php if ($product->get_price() == 0) : ?>
                                                            <span class="font-black text-xl text-success">رایگان!</span>
                                                        <?php else : ?>
                                                            <span class="font-black text-xl text-foreground"><?php echo $product_price; ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Quantity Controls -->
                                            <div class="flex items-center justify-between gap-3 mt-3">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-semibold text-sm text-muted">تعداد:</span>
                                                    <div class="flex items-center gap-1 bg-secondary rounded-full p-1">
                                                        <button type="button" 
                                                            class="quantity-decrease w-8 h-8 inline-flex items-center justify-center bg-background rounded-full text-foreground transition-colors hover:bg-primary hover:text-primary-foreground"
                                                            data-cart-key="<?php echo esc_attr($cart_item_key); ?>"
                                                            data-current-quantity="<?php echo esc_attr($cart_item['quantity']); ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                                <path fill-rule="evenodd" d="M4 10a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H4.75A.75.75 0 0 1 4 10Z" clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                        <span class="quantity-display min-w-[2rem] text-center font-bold text-sm text-foreground"><?php echo esc_html($cart_item['quantity']); ?></span>
                                                        <button type="button" 
                                                            class="quantity-increase w-8 h-8 inline-flex items-center justify-center bg-background rounded-full text-foreground transition-colors hover:bg-primary hover:text-primary-foreground"
                                                            data-cart-key="<?php echo esc_attr($cart_item_key); ?>"
                                                            data-current-quantity="<?php echo esc_attr($cart_item['quantity']); ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z" clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <span class="font-semibold text-sm text-muted">جمع:</span>
                                                    <span class="item-subtotal font-black text-lg text-foreground"><?php echo $cart_item['line_subtotal'] ? wc_price($cart_item['line_subtotal']) : wc_price(0); ?></span>
                                                </div>
                                            </div>
                                            
                                            <div class="flex gap-3 mt-3">
                                                <a href="<?php echo esc_url($product_permalink); ?>"
                                                    class="w-full h-11 inline-flex items-center justify-center gap-1 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                                                    <span class="line-clamp-1 font-semibold text-sm">مشاهده دوره</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="w-5 h-5">
                                                        <path fill-rule="evenodd"
                                                            d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end cart-item -->
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="text-center py-12">
                                <div class="flex flex-col items-center space-y-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-muted">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                    <h3 class="font-bold text-lg text-foreground">سبد خرید شما خالی است</h3>
                                    <p class="text-muted text-sm">هنوز هیچ دوره‌ای به سبد خرید اضافه نکرده‌اید</p>
                                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="inline-flex items-center gap-2 bg-primary text-primary-foreground px-6 py-3 rounded-full font-semibold transition-all hover:opacity-80">
                                        <span>مشاهده دوره‌ها</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                            <path fill-rule="evenodd" d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- end cart-items:wrapper -->
                        </div>

                        <!-- cart:detail -->
                        <div class="md:w-4/12 w-full md:sticky md:top-24">
                            <div class="space-y-5">
                                <div class="bg-gradient-to-b from-secondary to-background rounded-2xl px-5 pb-5">
                                    <div class="bg-background rounded-b-3xl space-y-2 p-5 mb-5">
                                        <div class="flex items-center gap-3">
                                            <div class="flex items-center gap-1">
                                                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                                <div class="w-2 h-2 bg-foreground rounded-full"></div>
                                            </div>
                                            <div class="font-black text-foreground">اطلاعات پرداخت</div>
                                        </div>
                                    </div>
                                    <div class="space-y-5">
                                        <form action="#" id="coupon-form">
                            <div class="flex items-center gap-3 relative">
                                <span class="absolute right-3 text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                            d="M4.5 2A2.5 2.5 0 0 0 2 4.5v3.879a2.5 2.5 0 0 0 .732 1.767l7.5 7.5a2.5 2.5 0 0 0 3.536 0l3.878-3.878a2.5 2.5 0 0 0 0-3.536l-7.5-7.5A2.5 2.5 0 0 0 8.38 2H4.5ZM5 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <input type="text" id="coupon-code" name="coupon_code" class="coupon-input form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-0 focus:border-border rounded-xl text-sm text-foreground pr-10"
                                    placeholder="کد تخفیف" />
                                <button type="submit" id="apply-coupon-btn" class="apply-coupon-btn h-11 inline-flex items-center justify-center gap-1 bg-primary rounded-xl text-primary-foreground transition-all hover:opacity-80 px-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Message container for coupon feedback -->
                            <div id="coupon-message" class="hidden mt-3"></div>
                            
                            <?php if (WC()->cart->get_applied_coupons()) : ?>
                                <div class="applied-coupons space-y-2 mt-3">
                                    <?php foreach (WC()->cart->get_applied_coupons() as $coupon_code) : ?>
                                        <div class="flex items-center justify-between bg-success/10 rounded-xl px-4 py-2">
                                            <span class="text-sm font-medium text-success"><?php echo esc_html($coupon_code); ?></span>
                                            <button type="button" class="remove-coupon-btn text-success hover:text-success/70" data-coupon-code="<?php echo esc_attr($coupon_code); ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </form>
                                        <div class="flex flex-col space-y-2" id="cart-summary">
                            <?php if (WC()->cart && !WC()->cart->is_empty()) : ?>
                                <?php if (WC()->cart->get_subtotal() != WC()->cart->get_total('edit')) : ?>
                                    <div class="cart-subtotal flex items-center justify-between gap-3">
                                        <div class="font-bold text-xs text-foreground">جمع جزء</div>
                                        <div class="flex items-center gap-1">
                                            <span class="amount font-black text-base text-foreground"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (WC()->cart->get_discount_total() > 0) : ?>
                                    <div class="cart-discount flex items-center justify-between gap-3">
                                        <div class="font-bold text-xs text-foreground">تخفیف</div>
                                        <div class="flex items-center gap-1">
                                            <span class="amount font-black text-base text-success">-<?php echo wc_price(WC()->cart->get_discount_total()); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <?php 
                                // Get wallet balance (you may need to adjust this based on your wallet system)
                                $wallet_balance = get_user_meta(get_current_user_id(), 'wallet_balance', true) ?: 0;
                                if ($wallet_balance > 0) :
                                ?>
                                    <div class="flex items-center justify-between gap-3">
                                        <div class="font-bold text-xs text-foreground">موجودی کیف پول</div>
                                        <div class="flex items-center gap-1">
                                            <span class="font-black text-base text-success"><?php echo wc_price($wallet_balance); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                                        <div class="h-px bg-secondary"></div>
                                        <div class="cart-total flex items-center justify-between gap-3 text-primary">
                            <div class="font-bold text-sm text-foreground">مبلغ قابل پرداخت</div>
                            <div class="flex items-center gap-1">
                                <?php if (WC()->cart && !WC()->cart->is_empty()) : ?>
                                    <span class="amount font-black text-xl text-foreground"><?php echo WC()->cart->get_total(); ?></span>
                                <?php else : ?>
                                    <span class="amount font-black text-xl text-foreground"><?php echo wc_price(0); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                                    </div>
                                </div>
                                <?php if (WC()->cart && !WC()->cart->is_empty()) : ?>
                    <a href="<?php echo esc_url(wc_get_checkout_url()); ?>"
                        class="w-full h-11 inline-flex items-center justify-center gap-1 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                        <span class="font-semibold text-sm">تکمیل فرایند خرید</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                <?php else : ?>
                    <button disabled
                        class="w-full h-11 inline-flex items-center justify-center gap-1 bg-muted rounded-full text-muted-foreground px-4 cursor-not-allowed">
                        <span class="font-semibold text-sm">سبد خرید خالی است</span>
                    </button>
                <?php endif; ?>
                            </div>
                        </div>
                        <!-- end cart:detail -->
                    </div>


                </div>
                <!-- end container -->

                <!-- modal:delete cart-item -->
                <div x-cloak x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen px-4">
                        <!-- modal:box -->
                        <div x-show="modalOpen" x-transition:enter="transition ease-out duration-300 transform"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="transition ease-in duration-200 transform"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            class="relative w-full max-w-sm my-20 overflow-hidden transition-all transform bg-background border border-border rounded-2xl shadow-2xl z-20">
                            <!-- modal:header -->
                            <div class="relative p-4">
                                <!-- modal:close-button -->
                                <button
                                    class="absolute left-4 text-muted-foreground focus:outline-none hover:text-error"
                                    x-on:click="modalOpen = false">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                        </path>
                                    </svg>
                                </button>
                                <!-- end modal:close-button -->
                            </div>
                            <!-- end modal:header -->

                            <!-- modal:content -->
                            <div class="p-6">
                                <div class="flex flex-col items-center justify-center space-y-5">
                                    <div
                                        class="flex items-center justify-center w-14 h-14 bg-error rounded-full text-error-foreground">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </div>
                                    <h3 class="font-bold text-foreground">آیا از حذف دوره از سبد اطمینان دارید؟</h3>
                                </div>
                            </div>
                            <!-- end modal:content -->

                            <!-- modal:footer -->
                            <div class="flex items-center gap-x-4 border-t border-border p-4">
                                <button type="button"
                                    class="flex items-center justify-center gap-x-2 w-full bg-background border border-border rounded-xl text-foreground py-2 px-4"
                                    x-on:click="modalOpen = false">
                                    <span class="font-bold text-xs">لغو</span>
                                </button>
                                <button type="button"
                                    class="flex items-center justify-center gap-x-2 w-full bg-error border border-transparent rounded-xl text-error-foreground py-2 px-4 confirm-delete-btn"
                                    x-on:click="modalOpen = false">
                                    <span class="font-bold text-xs">آره،حذف کن</span>
                                </button>
                            </div>
                            <!-- end modal:footer -->
                        </div>
                        <!-- end modal:box -->

                        <!-- modal:overlay -->
                        <div class="fixed inset-0 bg-secondary/80 cursor-pointer transition-all z-10"
                            x-bind:class="modalOpen ? 'opacity-100 visible' : 'opacity-0 invisible'"
                            x-on:click="modalOpen = false">
                        </div>
                        <!-- end modal:overlay -->
                    </div>
                </div>
                <!-- end modal:delete cart-item -->
            </div>
        </main>

        <script>
            // Initialize cart functionality when DOM is loaded
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof ArashCart !== 'undefined') {
                    window.cartInstance = new ArashCart();
                }
            });
        </script>

        <?php get_footer() ?>