<?php get_header()?>


        <main class="flex-auto py-5">
            <div class="max-w-7xl space-y-14 px-4 mx-auto">
                <div class="space-y-8">
                    <!-- section:title -->
                    <div class="flex items-center gap-5 bg-gradient-to-l from-secondary to-background rounded-2xl p-5">
                        <span
                            class="flex items-center justify-center w-12 h-12 bg-primary text-primary-foreground rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <div class="flex flex-col space-y-2">
                            <span class="font-black xs:text-2xl text-lg text-primary">فرانت اند</span>
                            <span class="font-semibold text-xs text-muted">دوره ببین، تمرین کن، برنامه نویس شو</span>
                        </div>
                    </div>
                    <!-- end section:title -->

                    <div class="grid md:grid-cols-12 grid-cols-1 items-start gap-5">
                        <div class="md:block hidden lg:col-span-3 md:col-span-4 md:sticky md:top-24">
                            <div class="w-full flex flex-col space-y-3 mb-3">
                                <span class="font-bold text-sm text-foreground">جستجو دوره</span>
                                <form action="#">
                                    <div class="flex items-center relative">
                                        <input type="text" id="product-search"
                                            class="form-input w-full !ring-0 !ring-offset-0 h-10 bg-secondary !border-0 rounded-xl text-sm text-foreground"
                                            placeholder="عنوان محصوله..">
                                        <span class="absolute left-3 text-muted">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="w-5 h-5">
                                                <path fill-rule="evenodd"
                                                    d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <div class="w-full h-11 flex items-center bg-secondary rounded-2xl px-3">
                                <label class="relative w-full flex items-center justify-between cursor-pointer">
                                    <span class="font-bold text-sm text-foreground">در حال برگزاری</span>
                                    <input type="checkbox" value="" class="sr-only peer" />
                                    <div
                                        class="w-11 h-5 relative bg-background border-2 border-border peer-focus:outline-none rounded-full peer peer-checked:after:left-[26px] peer-checked:after:bg-background after:content-[''] after:absolute after:left-0.5 after:top-0.5 after:bg-border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-primary peer-checked:border-primary">
                                    </div>
                                </label>
                            </div>
                            <!-- accordion:container -->
                            <div class="flex flex-col divide-y divide-border">
                                <!-- accordion -->
                                <div class="w-full space-y-2 py-3" x-data="{ open: true }">
                                    <!-- accordion:button -->
                                    <button type="button"
                                        class="w-full h-11 flex items-center justify-between gap-x-2 relative bg-secondary rounded-2xl transition hover:text-primary px-3"
                                        x-bind:class="open ? 'text-primary' : 'text-foreground'"
                                        x-on:click="open = !open">
                                        <span class="flex items-center gap-x-2">
                                            <span class="flex-shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                                </svg>
                                            </span>
                                            <span class="font-semibold text-sm text-right">دسته‌بندی محصولات</span>
                                        </span>
                                        <span class="" x-bind:class="open ? 'rotate-180' : ''">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </span>
                                    </button><!-- end accordion:button -->

                                    <!-- accordion:content -->
                                    <div class="bg-secondary rounded-2xl relative p-3" x-show="open">
                                        <div id="product-type-filter" class="space-y-2">
                                            <?php
                                            // Get product categories
                                            $product_categories = get_terms(array(
                                                'taxonomy' => 'product_cat',
                                                'hide_empty' => true
                                            ));
                                            
                                            if (!empty($product_categories) && !is_wp_error($product_categories)) :
                                                foreach ($product_categories as $category) :
                                                    $product_count = $category->count;
                                            ?>
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" name="type" value="<?php echo esc_attr($category->slug); ?>"
                                                    class="form-radio !ring-0 !ring-offset-0 bg-border border-0" />
                                                <span class="text-sm text-muted"><?php echo esc_html($category->name); ?></span>
                                                <span class="text-sm text-muted mr-auto"><?php echo $product_count; ?></span>
                                            </label>
                                            <?php 
                                                endforeach;
                                            endif;
                                            ?>
                                        </div>
                                    </div><!-- end accordion:content -->
                                </div><!-- accordion -->
                            </div><!-- end accordion:container -->
                        </div>

                        <div class="lg:col-span-9 md:col-span-8">
                            <!-- sort & filter(offcanvas) -->
                            <div class="flex items-center gap-3 mb-3" x-data="{ offcanvasOpen: false }">
                                <!-- sort -->
                                <div
                                    x-data="{ range: function(start, end) { return Array(end - start + 1).fill().map((_, idx) => start + idx) } }">
                                    <!-- form:select container -->
                                    <div class="flex items-center gap-3">
                                        <!-- form:select:label -->
                                        <label
                                            class="sm:flex hidden items-center gap-1 font-semibold text-xs text-muted">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="w-5 h-5">
                                                <path
                                                    d="M10 3.75a2 2 0 1 0-4 0 2 2 0 0 0 4 0ZM17.25 4.5a.75.75 0 0 0 0-1.5h-5.5a.75.75 0 0 0 0 1.5h5.5ZM5 3.75a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 .75.75ZM4.25 17a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5h1.5ZM17.25 17a.75.75 0 0 0 0-1.5h-5.5a.75.75 0 0 0 0 1.5h5.5ZM9 10a.75.75 0 0 1-.75.75h-5.5a.75.75 0 0 1 0-1.5h5.5A.75.75 0 0 1 9 10ZM17.25 10.75a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5h1.5ZM14 10a2 2 0 1 0-4 0 2 2 0 0 0 4 0ZM10 16.25a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z" />
                                            </svg>
                                            مرتب سازی:
                                        </label><!-- end form:select:label -->

                                        <!-- form:select -->
                                        <div class="w-52 relative"
                                            x-data="{ 
                                                open: false, 
                                                selectedOption: 'انتخاب کنید', 
                                                selectedValue: '', 
                                                options: [
                                                    { label: 'جدید‌ترین', value: 'newest' },
                                                    { label: 'قدیمی‌ترین', value: 'oldest' },
                                                    { label: 'ارزان‌ترین', value: 'cheapest' },
                                                    { label: 'گران‌ترین', value: 'expensive' }
                                                ],
                                                selectOption(option) {
                                                    this.selectedOption = option.label;
                                                    this.selectedValue = option.value;
                                                    this.open = false;
                                                    if (window.shopManager) {
                                                        window.shopManager.updateSort(option.value);
                                                    }
                                                }
                                            }"
                                            x-init="
                                                if (window.shopManager) {
                                                    window.shopManager.sortSelect = $el;
                                                }
                                            ">

                                            <!-- The selected value is stored in this input. -->
                                            <input type="hidden" x-model="selectedValue" />

                                            <!-- form:select:button -->
                                            <button x-on:click="open = !open"
                                                class="flex items-center w-full h-11 relative bg-secondary rounded-2xl font-semibold text-xs text-foreground px-4">
                                                <span class="line-clamp-1" x-text="selectedOption"></span>
                                                <span class="absolute left-3 pointer-events-none transition-transform"
                                                    x-bind:class="open ? 'rotate-180' : ''">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </span>
                                            </button><!-- end form:select:button -->

                                            <!-- form:select:options container -->
                                            <div class="absolute w-full bg-background rounded-2xl shadow-lg overflow-hidden mt-2 z-30"
                                                x-show="open" x-on:click.away="open = false">
                                                <ul class="max-h-48 overflow-y-auto">
                                                    <template x-for="(option, index) in options" :key="index">
                                                        <!-- form:select option -->
                                                        <li class="font-medium text-xs text-foreground cursor-pointer hover:bg-secondary px-4 py-3"
                                                            x-on:click="selectOption(option)"
                                                            x-text="option.label"></li><!-- end form:select:option -->
                                                    </template>
                                                </ul>
                                            </div><!-- end form:select:options container -->
                                        </div><!-- end form:select -->
                                    </div><!-- end form:select container -->
                                </div>
                                <!-- end sort -->

                                <!-- filter:offcanvas:button -->
                                <button type="button" id="filter-toggle"
                                    class="md:hidden flex items-center gap-1 h-11 bg-secondary rounded-2xl text-foreground px-4"
                                    x-on:click="offcanvasOpen = true">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                                    </svg>
                                    <span class="hidden sm:block font-semibold text-xs">فیلتر محصولات</span>
                                </button>
                                <!-- end filter:offcanvas:button -->

                                <!-- filter:offcanvas -->
                                <div x-cloak>
                                    <!-- offcanvas:box -->
                                    <div class="fixed inset-y-0 right-0 xs:w-80 w-72 h-full bg-background rounded-l-2xl overflow-y-auto transition-transform z-50"
                                        x-bind:class="offcanvasOpen ? '!translate-x-0' : 'translate-x-full'">

                                        <!-- offcanvas:header -->
                                        <div
                                            class="flex items-center justify-between gap-x-4 sticky top-0 bg-background p-4 z-10">
                                            <div class="font-bold text-sm text-foreground">فیلتر محصولات</div>

                                            <!-- offcanvas:close-button -->
                                            <button x-on:click="offcanvasOpen = false"
                                                class="text-black dark:text-white focus:outline-none hover:text-red-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                            <!-- end offcanvas:close-button -->
                                        </div>
                                        <!-- end offcanvas header -->

                                        <!-- offcanvas:content -->
                                        <div class="p-4">
                                            <div class="w-full flex flex-col space-y-3 mb-3">
                                                <span class="font-bold text-sm text-foreground">جستجو دوره</span>
                                                <form action="#">
                                                    <div class="flex items-center relative">
                                                        <input type="text" id="product-search-mobile"
                                                            class="form-input w-full !ring-0 !ring-offset-0 h-10 bg-secondary !border-0 rounded-xl text-sm text-foreground"
                                                            placeholder="عنوان دوره..">
                                                        <span class="absolute left-3 text-muted">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor" class="w-5 h-5">
                                                                <path fill-rule="evenodd"
                                                                    d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="w-full h-11 flex items-center bg-secondary rounded-2xl px-3">
                                                <label
                                                    class="relative w-full flex items-center justify-between cursor-pointer">
                                                    <span class="font-bold text-sm text-foreground">در حال
                                                        برگزاری</span>
                                                    <input type="checkbox" value="" class="sr-only peer" />
                                                    <div
                                                        class="w-11 h-5 relative bg-background border-2 border-border peer-focus:outline-none rounded-full peer peer-checked:after:left-[26px] peer-checked:after:bg-background after:content-[''] after:absolute after:left-0.5 after:top-0.5 after:bg-border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-primary peer-checked:border-primary">
                                                    </div>
                                                </label>
                                            </div>
                                            <!-- accordion:container -->
                                            <div class="flex flex-col divide-y divide-border">
                                                <!-- accordion -->
                                                <div class="w-full space-y-2 py-3" x-data="{ open: true }">
                                                    <!-- accordion:button -->
                                                    <button type="button"
                                                        class="w-full h-11 flex items-center justify-between gap-x-2 relative bg-secondary rounded-2xl transition hover:text-primary px-3"
                                                        x-bind:class="open ? 'text-primary' : 'text-foreground'"
                                                        x-on:click="open = !open">
                                                        <span class="flex items-center gap-x-2">
                                                            <span class="flex-shrink-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-5 h-5">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                                                </svg>
                                                            </span>
                                                            <span class="font-semibold text-sm text-right">نوع
                                                                دوره</span>
                                                        </span>
                                                        <span class="" x-bind:class="open ? 'rotate-180' : ''">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                            </svg>
                                                        </span>
                                                    </button><!-- end accordion:button -->

                                                    <!-- accordion:content -->
                                                    <div class="bg-secondary rounded-2xl relative p-3" x-show="open">
                                                        <div id="product-type-filter-mobile" class="space-y-2">
                                                            <?php
                                                            // Get product categories for mobile filter
                                                            if (!empty($product_categories) && !is_wp_error($product_categories)) :
                                                                foreach ($product_categories as $category) :
                                                                    $product_count = $category->count;
                                                            ?>
                                                            <label class="flex items-center gap-2 cursor-pointer">
                                                                <input type="radio" name="type-mobile" value="<?php echo esc_attr($category->slug); ?>"
                                                                    class="form-radio !ring-0 !ring-offset-0 bg-border border-0" />
                                                                <span class="text-sm text-muted"><?php echo esc_html($category->name); ?></span>
                                                                <span class="text-sm text-muted mr-auto"><?php echo $product_count; ?></span>
                                                            </label>
                                                            <?php 
                                                                endforeach;
                                                            endif;
                                                            ?>
                                                        </div>
                                                    </div><!-- end accordion:content -->
                                                </div><!-- accordion -->
                                            </div><!-- end accordion:container -->
                                        </div>
                                        <!-- end offcanvas:content -->
                                    </div>
                                    <!-- end offcanvas:box -->

                                    <!-- offcanvas:overlay -->
                                    <div class="fixed inset-0 bg-black/10 dark:bg-white/10 cursor-pointer transition-all duration-1000 z-40"
                                        x-bind:class="offcanvasOpen ? 'opacity-100 visible' : 'opacity-0 invisible'"
                                        x-on:click="offcanvasOpen = false"></div>
                                    <!-- end offcanvas:overlay -->
                                </div>
                                <!-- end filter:offcanvas -->
                            </div>
                            <!-- end sort & filter(offcanvas) -->

                            <!-- Loading Overlay -->
                            <div id="loading-overlay" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center">
                                <div class="bg-background rounded-2xl p-6 flex items-center gap-3">
                                    <div class="animate-spin">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 text-primary">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-sm text-foreground">در حال بارگذاری...</span>
                                </div>
                            </div>

                            <!-- Error Message -->
                            <div id="error-message" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-2xl mb-4">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="font-semibold text-sm">خطا در بارگذاری محصولات. لطفاً دوباره تلاش کنید.</span>
                                </div>
                            </div>

                            <!-- courses:wrapper -->
                            <div id="products-container" class="grid lg:grid-cols-3 sm:grid-cols-2 gap-x-5 gap-y-10">
                                <?php
                                // Get current page
                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                
                                // WooCommerce products query
                                $args = array(
                                    'post_type' => 'product',
                                    'posts_per_page' => 6,
                                    'paged' => $paged,
                                    'post_status' => 'publish'
                                );

                                $products_query = new WP_Query($args);

                                if ($products_query->have_posts()) :
                                    while ($products_query->have_posts()) : $products_query->the_post();
                                        global $product;
                                        
                                        // Get product meta
                                        $product_type = get_post_meta(get_the_ID(), 'arash_product_type', true);
                                        
                                        // If no custom product type is set, determine based on WooCommerce product type
                                        if (empty($product_type)) {
                                            $wc_product_type = $product->get_type();
                                            $product_type = ($wc_product_type === 'simple' || $wc_product_type === 'downloadable') ? 'digital' : 'course';
                                        }
                                        
                                        // Get product categories
                                        $categories = get_the_terms(get_the_ID(), 'product_cat');
                                        $category_name = '';
                                        $category_link = '';
                                        if ($categories && !is_wp_error($categories)) {
                                            $category_name = $categories[0]->name;
                                            $category_link = get_term_link($categories[0]);
                                        }
                                        
                                        // Get product image
                                        $image_id = $product->get_image_id();
                                        $image_url = wp_get_attachment_image_url($image_id, 'medium');
                                        if (!$image_url) {
                                            $image_url = wc_placeholder_img_src();
                                        }
                                        
                                        // Get price
                                        $regular_price = $product->get_regular_price();
                                        $sale_price = $product->get_sale_price();
                                        $price = $product->get_price();
                                        
                                        // Format prices
                                        $formatted_price = $price ? number_format($price) : '';
                                        $formatted_regular_price = $regular_price ? number_format($regular_price) : '';
                                        
                                        // Get author info
                                        $author_id = get_the_author_meta('ID');
                                        $author_avatar = get_avatar_url($author_id, array('size' => 40));
                                ?>
                                <!-- product:card -->
                                <div class="relative product-card" data-product-id="<?php echo get_the_ID(); ?>" data-product-type="<?php echo esc_attr($product_type); ?>">
                                    <div class="relative z-10">
                                        <a href="<?php echo get_permalink(); ?>" class="block">
                                            <img src="<?php echo esc_url($image_url); ?>" class="max-w-full rounded-3xl"
                                                alt="<?php echo esc_attr(get_the_title()); ?>" />
                                        </a>
                                        <?php if ($category_name) : ?>
                                        <a href="<?php echo esc_url($category_link); ?>"
                                            class="absolute left-3 top-3 h-11 inline-flex items-center justify-center gap-1 bg-black/20 rounded-full text-white transition-all hover:opacity-80 px-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-6 h-6">
                                                <path fill-rule="evenodd"
                                                    d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="font-semibold text-sm"><?php echo esc_html($category_name); ?></span>
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="bg-background rounded-b-3xl -mt-12 pt-12">
                                        <div
                                            class="bg-gradient-to-b from-background to-secondary rounded-b-3xl space-y-2 p-5 mx-5">
                                            <div class="flex items-center gap-2">
                                                <span class="block w-1 h-1 bg-success rounded-full"></span>
                                                <span class="font-bold text-xs text-success">
                                                    <?php 
                                                    $status = get_post_meta(get_the_ID(), '_course_status', true);
                                                    echo $status ? esc_html($status) : 'تکمیل شده';
                                                    ?>
                                                </span>
                                            </div>
                                            <h2 class="font-bold text-sm">
                                                <a href="<?php echo get_permalink(); ?>"
                                                    class="line-clamp-1 text-foreground transition-colors hover:text-primary">
                                                    <?php echo get_the_title(); ?>
                                                </a>
                                            </h2>
                                        </div>
                                        <div class="space-y-3 p-5">
                                            <?php if ($product_type === 'course') : ?>
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
                                                    <span class="font-semibold text-xs">
                                                        <?php 
                                                        $chapters = get_post_meta(get_the_ID(), '_course_chapters', true);
                                                        echo $chapters ? $chapters . ' فصل' : '۵ فصل';
                                                        ?>
                                                    </span>
                                                </div>
                                                <span class="block w-1 h-1 bg-muted-foreground rounded-full"></span>
                                                <div class="flex items-center gap-1 text-muted">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="w-5 h-5">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="font-semibold text-xs">
                                                        <?php 
                                                        $duration = get_post_meta(get_the_ID(), '_course_duration', true);
                                                        echo $duration ? $duration . ' ساعت' : '۲۵ ساعت';
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            
                                            <div class="flex items-center justify-between gap-5">
                                                <div class="flex items-center gap-3">
                                                    <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                                                        <img src="<?php echo esc_url($author_avatar); ?>"
                                                            class="w-full h-full object-cover" alt="<?php echo get_the_author(); ?>" />
                                                    </div>
                                                    <div class="flex flex-col items-start space-y-1">
                                                        <span class="line-clamp-1 font-semibold text-xs text-muted">
                                                            <?php 
                                                            if ($product_type === 'course') {
                                                                echo 'مدرس دوره:';
                                                            } elseif ($product_type === 'digital') {
                                                                echo 'توسعه‌دهنده:';
                                                            } else {
                                                                echo 'نویسنده:';
                                                            }
                                                            ?>
                                                        </span>
                                                        <a href="<?php echo get_author_posts_url($author_id); ?>"
                                                            class="line-clamp-1 font-bold text-xs text-foreground hover:text-primary">
                                                            <?php echo get_the_author(); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col items-end justify-center h-14">
                                                    <?php if ($sale_price && $sale_price < $regular_price) : ?>
                                                    <span class="line-through text-muted"><?php echo $formatted_regular_price; ?></span>
                                                    <?php endif; ?>
                                                    <div class="flex items-center gap-1">
                                                        <?php if ($price > 0) : ?>
                                                        <span class="font-black text-xl text-foreground"><?php echo $formatted_price; ?></span>
                                                        <span class="text-xs text-muted">تومان</span>
                                                        <?php else : ?>
                                                        <span class="font-black text-xl text-success">رایگان!</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex gap-3 mt-3">
                                                <a href="<?php echo get_permalink(); ?>"
                                                    class="w-full h-11 inline-flex items-center justify-center gap-1 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                                                    <span class="line-clamp-1 font-semibold text-sm">
                                                        <?php 
                                                        if ($product_type === 'course') {
                                                            echo 'مشاهده دوره';
                                                        } else {
                                                            echo 'مشاهده محصول';
                                                        }
                                                        ?>
                                                    </span>
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
                                <!-- end product:card -->
                                <?php 
                                    endwhile;
                                else :
                                ?>
                                <div class="col-span-full text-center py-12">
                                    <p class="text-muted text-lg">هیچ محصولی یافت نشد.</p>
                                </div>
                                <?php 
                                endif;
                                wp_reset_postdata();
                                ?>
                            </div>
                            <!-- end courses:wrapper -->

                            <!-- Load More Button -->
                            <?php if ($products_query->max_num_pages > 1) : ?>
                            <div class="flex justify-center mt-10">
                                <button id="load-more-products" type="button" 
                                    class="h-11 inline-flex items-center justify-center gap-2 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-6 load-more-btn"
                                    data-page="1" data-max-pages="<?php echo $products_query->max_num_pages; ?>">
                                    <span class="font-semibold text-sm load-more-text">مشاهده بیشتر</span>
                                    <div class="hidden animate-spin load-more-spinner">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-5 h-5">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                            <?php endif; ?>
                        </div>
                        <!-- courses:wrapper -->
                        </div>
                    </div>
                </div>
            </div>
        </main>





<?php get_footer()?>