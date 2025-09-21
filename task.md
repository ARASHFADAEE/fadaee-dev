jquery-migrate.js?ver=3.4.1:104 JQMIGRATE: Migrate is installed with logging active, version 3.4.1
varDump.js:8 response Object
5a2d4e94f11188ebc7ab27406bc0a8fb8177a825c6860591697485a48131612c?s=52&d=mm&r=g:1  Failed to load resource: net::ERR_CONNECTION_CLOSED
5a2d4e94f11188ebc7ab27406bc0a8fb8177a825c6860591697485a48131612c?s=128&d=mm&r=g:1  Failed to load resource: net::ERR_CONNECTION_CLOSED
alpinejs.min.js?ver=1.0:1 Alpine Expression Error: Cannot read properties of undefined (reading 'preventDefault')

Expression: "ArashCart.confirmDelete(); modalOpen = false"

 <button type=​"button" class=​"flex items-center justify-center gap-x-2 w-full bg-error border border-transparent rounded-xl text-error-foreground py-2 px-4 confirm-delete-btn" x-on:click=​"ArashCart.confirmDelete()​;​ modalOpen = false">​…​</button>​flex
te @ alpinejs.min.js?ver=1.0:1
(anonymous) @ alpinejs.min.js?ver=1.0:5
Promise.catch
(anonymous) @ alpinejs.min.js?ver=1.0:5
fr @ alpinejs.min.js?ver=1.0:1
(anonymous) @ alpinejs.min.js?ver=1.0:5
o @ alpinejs.min.js?ver=1.0:5
(anonymous) @ alpinejs.min.js?ver=1.0:5
(anonymous) @ alpinejs.min.js?ver=1.0:5
alpinejs.min.js?ver=1.0:5 Uncaught TypeError: Cannot read properties of undefined (reading 'preventDefault')
    at Object.confirmDelete (cart.js?ver=1.2:111:15)
    at [Alpine] ArashCart.confirmDelete(cart/); modalOpen = false (eval at <anonymous> (http://localhost:8888/arash/wp-content/themes/fadaee-dev/assets/js/dependencies/alpinejs.min.js?ver=1.0:5:665), <anonymous>:3:42)
    at alpinejs.min.js?ver=1.0:5:1068
    at fr (alpinejs.min.js?ver=1.0:1:6642)
    at alpinejs.min.js?ver=1.0:5:36516
    at o (alpinejs.min.js?ver=1.0:5:25808)
    at alpinejs.min.js?ver=1.0:5:26797
    at HTMLButtonElement.<anonymous> (alpinejs.min.js?ver=1.0:5:25830)
confirmDelete @ cart.js?ver=1.2:111
[Alpine] ArashCart.confirmDelete(); modalOpen = false @ VM1192:3
(anonymous) @ alpinejs.min.js?ver=1.0:5
fr @ alpinejs.min.js?ver=1.0:1
(anonymous) @ alpinejs.min.js?ver=1.0:5
o @ alpinejs.min.js?ver=1.0:5
(anonymous) @ alpinejs.min.js?ver=1.0:5
(anonymous) @ alpinejs.min.js?ver=1.0:5
alpinejs.min.js?ver=1.0:1 Alpine Expression Error: Cannot read properties of undefined (reading 'preventDefault')

Expression: "ArashCart.confirmDelete(); modalOpen = false"

 <button type=​"button" class=​"flex items-center justify-center gap-x-2 w-full bg-error border border-transparent rounded-xl text-error-foreground py-2 px-4 confirm-delete-btn" x-on:click=​"ArashCart.confirmDelete()​;​ modalOpen = false">​…​</button>​flex
te @ alpinejs.min.js?ver=1.0:1
(anonymous) @ alpinejs.min.js?ver=1.0:5
Promise.catch
(anonymous) @ alpinejs.min.js?ver=1.0:5
fr @ alpinejs.min.js?ver=1.0:1
(anonymous) @ alpinejs.min.js?ver=1.0:5
o @ alpinejs.min.js?ver=1.0:5
(anonymous) @ alpinejs.min.js?ver=1.0:5
(anonymous) @ alpinejs.min.js?ver=1.0:5
alpinejs.min.js?ver=1.0:5 Uncaught TypeError: Cannot read properties of undefined (reading 'preventDefault')
    at Object.confirmDelete (cart.js?ver=1.2:111:15)
    at [Alpine] ArashCart.confirmDelete(cart/); modalOpen = false (eval at <anonymous> (http://localhost:8888/arash/wp-content/themes/fadaee-dev/assets/js/dependencies/alpinejs.min.js?ver=1.0:5:665), <anonymous>:3:42)
    at alpinejs.min.js?ver=1.0:5:1068
    at fr (alpinejs.min.js?ver=1.0:1:6642)
    at alpinejs.min.js?ver=1.0:5:36516
    at o (alpinejs.min.js?ver=1.0:5:25808)
    at alpinejs.min.js?ver=1.0:5:26797
    at HTMLButtonElement.<anonymous> (alpinejs.min.js?ver=1.0:5:25830)
confirmDelete @ cart.js?ver=1.2:111
[Alpine] ArashCart.confirmDelete(); modalOpen = false @ VM1192:3
(anonymous) @ alpinejs.min.js?ver=1.0:5
fr @ alpinejs.min.js?ver=1.0:1
(anonymous) @ alpinejs.min.js?ver=1.0:5
o @ alpinejs.min.js?ver=1.0:5
(anonymous) @ alpinejs.min.js?ver=1.0:5
(anonymous) @ alpinejs.min.js?ver=1.0:5

مشکلاتی که وجود داره و احتمالات 


فکر کنم مقداری که در جمع جزء نمایش داده میشه به صورت تکست و احتمالا ارور هست برسی کن چون مقدار رو به صورت کلی زمانی که سفحه رفرش میشه یا به صفحه کارت میریم ساختار زیر رو نمایش میده 


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
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M4.5 2A2.5 2.5 0 0 0 2 4.5v3.879a2.5 2.5 0 0 0 .732 1.767l7.5 7.5a2.5 2.5 0 0 0 3.536 0l3.878-3.878a2.5 2.5 0 0 0 0-3.536l-7.5-7.5A2.5 2.5 0 0 0 8.38 2H4.5ZM5 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <input type="text" id="coupon-code" name="coupon_code" class="coupon-input form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-0 focus:border-border rounded-xl text-sm text-foreground pr-10" placeholder="کد تخفیف">
                                <button type="submit" id="apply-coupon-btn" class="apply-coupon-btn h-11 inline-flex items-center justify-center gap-1 bg-primary rounded-xl text-primary-foreground transition-all hover:opacity-80 px-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Message container for coupon feedback -->
                            <div id="coupon-message" class="hidden mt-3"></div>
                            
                                                    </form>
                                        <div class="flex flex-col space-y-2" id="cart-summary">
                                                                                                <div class="cart-subtotal flex items-center justify-between gap-3">
                                        <div class="font-bold text-xs text-foreground">جمع جزء</div>
                                        <div class="flex items-center gap-1">
                                            <span class="amount font-black text-base text-foreground">ناعدد تومان</span>
                                        </div>
                                    </div>
                                                                
                                                                
                                                                                    </div>
                                        <div class="h-px bg-secondary"></div>
                                        <div class="cart-total flex items-center justify-between gap-3 text-primary">
                            <div class="font-bold text-sm text-foreground">مبلغ قابل پرداخت</div>
                            <div class="flex items-center gap-1">
                                                                    <span class="amount font-black text-xl text-foreground">ناعدد تومان</span>
                                                            </div>
                        </div>
                                    </div>
                                </div>




و زمانی که تعداد محصول رو افزایش میدیم ساختار به شکل زیر هست 
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
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M4.5 2A2.5 2.5 0 0 0 2 4.5v3.879a2.5 2.5 0 0 0 .732 1.767l7.5 7.5a2.5 2.5 0 0 0 3.536 0l3.878-3.878a2.5 2.5 0 0 0 0-3.536l-7.5-7.5A2.5 2.5 0 0 0 8.38 2H4.5ZM5 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <input type="text" id="coupon-code" name="coupon_code" class="coupon-input form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-0 focus:border-border rounded-xl text-sm text-foreground pr-10" placeholder="کد تخفیف">
                                <button type="submit" id="apply-coupon-btn" class="apply-coupon-btn h-11 inline-flex items-center justify-center gap-1 bg-primary rounded-xl text-primary-foreground transition-all hover:opacity-80 px-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Message container for coupon feedback -->
                            <div id="coupon-message" class="hidden mt-3"></div>
                            
                                                    </form>
                                        <div class="flex flex-col space-y-2" id="cart-summary">
                                                                                                <div class="cart-subtotal flex items-center justify-between gap-3">
                                        <div class="font-bold text-xs text-foreground">جمع جزء</div>
                                        <div class="flex items-center gap-1">
                                            <span class="amount font-black text-base text-foreground">ناعدد تومان</span>
                                        </div>
                                    </div>
                                                                
                                                                
                                                                                    </div>
                                        <div class="h-px bg-secondary"></div>
                                        <div class="cart-total flex items-center justify-between gap-3 text-primary">10,000,000 تومان</div>
                                    </div>
                                </div>


                                و زمانی که تعداد کارت رو به زیر ۳ میخوایم بیاریم کم تر از ۳ نمیشه 
                                و نمایش ساختار باکس اطلاعات پرداخت  به این صورت هست 


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
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M4.5 2A2.5 2.5 0 0 0 2 4.5v3.879a2.5 2.5 0 0 0 .732 1.767l7.5 7.5a2.5 2.5 0 0 0 3.536 0l3.878-3.878a2.5 2.5 0 0 0 0-3.536l-7.5-7.5A2.5 2.5 0 0 0 8.38 2H4.5ZM5 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <input type="text" id="coupon-code" name="coupon_code" class="coupon-input form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-0 focus:border-border rounded-xl text-sm text-foreground pr-10" placeholder="کد تخفیف">
                                <button type="submit" id="apply-coupon-btn" class="apply-coupon-btn h-11 inline-flex items-center justify-center gap-1 bg-primary rounded-xl text-primary-foreground transition-all hover:opacity-80 px-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Message container for coupon feedback -->
                            <div id="coupon-message" class="hidden mt-3"></div>
                            
                                                    </form>
                                        <div class="flex flex-col space-y-2" id="cart-summary">
                                                                                                <div class="cart-subtotal flex items-center justify-between gap-3">
                                        <div class="font-bold text-xs text-foreground">جمع جزء</div>
                                        <div class="flex items-center gap-1">
                                            <span class="amount font-black text-base text-foreground">ناعدد تومان</span>
                                        </div>
                                    </div>
                                                                
                                                                
                                                                                    </div>
                                        <div class="h-px bg-secondary"></div>
                                        <div class="cart-total flex items-center justify-between gap-3 text-primary">7,500,000 تومان</div>
                                    </div>
                                </div>



                                و همچنین ساختار خود کارت محصول و ایتم های سبد خرید به این صورت هست 
                                <div class="flex sm:flex-nowrap flex-wrap items-start gap-8 relative py-6 cart-item" data-cart-key="979d472a84804b9f647bc185a877a8b5">
                                <div class="sm:w-4/12 w-full relative z-10">
                                    <a href="http://localhost:8888/arash/product/qwic-order/" class="block">
                                        <img loading="lazy" decoding="async" width="300" height="300" src="http://localhost:8888/arash/wp-content/uploads/2025/09/Screenshot-1404-06-16-at-10.17.22-scaled-1-300x300.webp" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="افزونه ثبت سفارش سریع ووکامرس" srcset="http://localhost:8888/arash/wp-content/uploads/2025/09/Screenshot-1404-06-16-at-10.17.22-scaled-1-300x300.webp 300w, http://localhost:8888/arash/wp-content/uploads/2025/09/Screenshot-1404-06-16-at-10.17.22-scaled-1-100x100.webp 100w, http://localhost:8888/arash/wp-content/uploads/2025/09/Screenshot-1404-06-16-at-10.17.22-scaled-1-150x150.webp 150w" sizes="auto, (max-width: 300px) 100vw, 300px">                                    </a>
                                    <button type="button" class="remove-item flex-shrink-0 absolute right-1/2 translate-x-1/2 -translate-y-6 w-11 h-11 inline-flex items-center justify-center bg-error rounded-full text-error-foreground shadow-2xl" data-cart-key="979d472a84804b9f647bc185a877a8b5" x-on:click="deleteItemKey = '979d472a84804b9f647bc185a877a8b5'; modalOpen = true">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path>
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
                                                <a href="http://localhost:8888/arash/product/qwic-order/" class="line-clamp-1 text-foreground transition-colors hover:text-primary">
                                                    افزونه ثبت سفارش سریع ووکامرس                                                </a>
                                            </h2>
                                        </div>
                                        <div class="space-y-3 p-5">
                                                                                        <!-- For digital products, show minimal info -->
                                            <div class="flex items-center justify-between gap-5">
                                                                                            <div class="flex flex-col items-end justify-center h-14">
                                                                                                            <span class="line-through text-muted"><span class="woocommerce-Price-amount amount"><bdi>4,000,000<span class="woocommerce-Price-currencySymbol">تومان</span></bdi></span></span>
                                                                                                        <div class="flex items-center gap-1">
                                                                                                                    <span class="font-black text-xl text-foreground"><span class="woocommerce-Price-amount amount"><bdi>2,500,000<span class="woocommerce-Price-currencySymbol">تومان</span></bdi></span></span>
                                                                                                            </div>
                                                </div>
                                            </div>
                                            <!-- Quantity Controls -->
                                            <div class="flex items-center justify-between gap-3 mt-3">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-semibold text-sm text-muted">تعداد:</span>
                                                    <div class="flex items-center gap-1 bg-secondary rounded-full p-1">
                                                        <button type="button" class="quantity-decrease w-8 h-8 inline-flex items-center justify-center bg-background rounded-full text-foreground transition-colors hover:bg-primary hover:text-primary-foreground" data-cart-key="979d472a84804b9f647bc185a877a8b5" data-current-quantity="3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                                <path fill-rule="evenodd" d="M4 10a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H4.75A.75.75 0 0 1 4 10Z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                        <span class="quantity-display min-w-[2rem] text-center font-bold text-sm text-foreground">3</span>
                                                        <button type="button" class="quantity-increase w-8 h-8 inline-flex items-center justify-center bg-background rounded-full text-foreground transition-colors hover:bg-primary hover:text-primary-foreground" data-cart-key="979d472a84804b9f647bc185a877a8b5" data-current-quantity="3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-11.25a.75.75 0 0 0-1.5 0v2.5h-2.5a.75.75 0 0 0 0 1.5h2.5v2.5a.75.75 0 0 0 1.5 0v-2.5h2.5a.75.75 0 0 0 0-1.5h-2.5v-2.5Z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <span class="font-semibold text-sm text-muted">جمع:</span>
                                                    <span class="item-subtotal font-black text-lg text-foreground">ناعدد تومان</span>
                                                </div>
                                            </div>
                                            
                                            <div class="flex gap-3 mt-3">
                                                <a href="http://localhost:8888/arash/product/qwic-order/" class="w-full h-11 inline-flex items-center justify-center gap-1 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                                                    <span class="line-clamp-1 font-semibold text-sm">مشاهده دوره</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                        <path fill-rule="evenodd" d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            روی آره حذف کن هم که کلیک میکنیم ارور در کنسول داریم و هیچ اتفاقی نمیفته 



                            میخوام تماما مشکلات و باگ هارو فیکس کنی 
                            در هر پروسه ای از کار لاگ بگیر تا راحت تر بتونیم باگ رو فیکس کنیم 

                            