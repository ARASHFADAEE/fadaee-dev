<?php get_header()?>

<main class="flex-auto py-5">
    <div class="max-w-7xl space-y-14 px-4 mx-auto">
        <div class="space-y-8">
            <!-- section:title -->
            <div class="flex items-center gap-5 bg-gradient-to-l from-secondary to-background rounded-2xl p-5">
                <span class="flex items-center justify-center w-12 h-12 bg-primary text-primary-foreground rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 4.23a2.25 2.25 0 00-2.15-1.705H6.911a2.25 2.25 0 00-2.15 1.705L2.35 13.177a2.25 2.25 0 00-.1.661z" clip-rule="evenodd" />
                    </svg>
                </span>
                <div class="flex flex-col space-y-2">
                    <span class="font-black xs:text-2xl text-lg text-primary">نمونه‌کارها</span>
                    <span class="font-semibold text-xs text-muted">مجموعه‌ای از آخرین پروژه‌ها و نمونه‌کارهای انجام شده</span>
                </div>
            </div>
            <!-- end section:title -->

            <div class="grid md:grid-cols-12 grid-cols-1 items-start gap-5">
            <div class="md:block hidden lg:col-span-3 md:col-span-4 md:sticky md:top-24">
                <div class="w-full flex flex-col space-y-3 mb-5">
                    <span class="font-bold text-sm text-foreground">جستجو نمونه‌کارها</span>
                    <form id="portfolio-search-form">
                        <div class="flex items-center relative">
                            <input type="text" id="portfolio-search-input"
                                class="form-input w-full !ring-0 !ring-offset-0 h-10 bg-secondary !border-0 rounded-xl text-sm text-foreground"
                                placeholder="عنوان نمونه‌کار..">
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

                <!-- accordion:container -->
                <div class="flex flex-col divide-y divide-border">
                    <!-- accordion -->
                    <div class="w-full space-y-2 py-3" x-data="{ open: false }">
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
                                            d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 4.23a2.25 2.25 0 00-2.15-1.705H6.911a2.25 2.25 0 00-2.15 1.705L2.35 13.177a2.25 2.25 0 00-.1.661z" />
                                    </svg>
                                </span>
                                <span class="font-semibold text-sm text-right">دسته بندی نمونه‌کارها</span>
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
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="portfolio-category" value="all" checked
                                        class="portfolio-category-filter form-radio !ring-0 !ring-offset-0 bg-border border-0" />
                                    <span class="text-sm text-muted">همه دسته‌ها</span>
                                </label>
                                <?php
                                $portfolio_categories = get_terms(array(
                                    'taxonomy' => 'portfolio_category',
                                    'hide_empty' => true,
                                    'orderby' => 'name',
                                    'order' => 'ASC'
                                ));
                                if (!empty($portfolio_categories) && !is_wp_error($portfolio_categories)) :
                                    foreach ($portfolio_categories as $category) :
                                ?>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="portfolio-category" value="<?php echo esc_attr($category->slug); ?>"
                                        class="portfolio-category-filter form-radio !ring-0 !ring-offset-0 bg-border border-0" />
                                    <span class="text-sm text-muted"><?php echo esc_html($category->name); ?></span>
                                </label>
                                <?php 
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div><!-- end accordion:content -->
                    </div><!-- end accordion -->
                </div><!-- end accordion:container -->
            </div>

            <div class="lg:col-span-9 md:col-span-8">
                <!-- Sort & Filter Section -->
                <div class="flex items-center gap-3 mb-3" x-data="{ offcanvasOpen: false }">
                    <!-- Sort -->
                    <div class="flex items-center gap-x-3">
                        <span class="font-bold text-sm text-foreground">مرتب سازی:</span>
                        <div class="relative" x-data="{ open: false, selected: 'جدیدترین', selectedValue: 'date_desc' }">
                            <button type="button"
                                class="flex items-center gap-x-2 h-10 bg-secondary rounded-xl px-3 text-sm text-foreground hover:text-primary transition"
                                x-on:click="open = !open">
                                <span x-text="selected"></span>
                                <span class="text-muted" x-bind:class="open ? 'rotate-180' : ''">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </button>
                            <div class="absolute top-full left-0 mt-1 bg-background border border-border rounded-xl shadow-lg z-10 min-w-32"
                                x-show="open" x-on:click.away="open = false">
                                <div class="p-1">
                                    <button type="button"
                                        class="portfolio-sort-option w-full text-right px-3 py-2 text-sm hover:bg-secondary rounded-lg transition"
                                        x-on:click="selected = 'جدیدترین'; selectedValue = 'date_desc'; open = false">جدیدترین</button>
                                    <button type="button"
                                        class="portfolio-sort-option w-full text-right px-3 py-2 text-sm hover:bg-secondary rounded-lg transition"
                                        x-on:click="selected = 'قدیمی‌ترین'; selectedValue = 'date_asc'; open = false">قدیمی‌ترین</button>
                                    <button type="button"
                                        class="portfolio-sort-option w-full text-right px-3 py-2 text-sm hover:bg-secondary rounded-lg transition"
                                        x-on:click="selected = 'عنوان'; selectedValue = 'title_asc'; open = false">عنوان</button>
                                </div>
                            </div>
                            <input type="hidden" id="portfolio-sort-input" x-model="selectedValue" />
                        </div>
                    </div>

                    <!-- Mobile Filter Button -->
                    <button type="button"
                        class="md:hidden flex items-center gap-x-2 h-10 bg-primary text-primary-foreground rounded-xl px-3 text-sm font-medium"
                        x-on:click="offcanvasOpen = true">
                        <span>فیلتر</span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m0 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3.75 0a1.5 1.5 0 00-3 0m-9.75 0h3.75" />
                            </svg>
                        </span>
                    </button>

                    <!-- Mobile Filter Offcanvas -->
                    <div x-cloak>
                        <!-- offcanvas:box -->
                        <div class="fixed inset-y-0 right-0 xs:w-80 w-72 h-full bg-background rounded-l-2xl overflow-y-auto transition-transform z-50"
                            x-bind:class="offcanvasOpen ? '!translate-x-0' : 'translate-x-full'">

                            <!-- offcanvas:header -->
                            <div class="flex items-center justify-between gap-x-4 sticky top-0 bg-background p-4 z-10">
                                <div class="font-bold text-sm text-foreground">فیلتر نمونه‌کارها</div>

                                <!-- offcanvas:close-button -->
                                <button x-on:click="offcanvasOpen = false"
                                    class="text-black dark:text-white focus:outline-none hover:text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button><!-- end offcanvas:close-button -->
                            </div><!-- end offcanvas header -->

                            <!-- offcanvas:content -->
                            <div class="p-4">
                                <!-- Mobile Search -->
                                <div class="w-full flex flex-col space-y-3 mb-5">
                                    <span class="font-bold text-sm text-foreground">جستجو نمونه‌کارها</span>
                                    <form id="mobile-portfolio-search-form">
                                        <div class="flex items-center relative">
                                            <input type="text" id="mobile-portfolio-search-input"
                                                class="form-input w-full !ring-0 !ring-offset-0 h-10 bg-secondary !border-0 rounded-xl text-sm text-foreground"
                                                placeholder="عنوان نمونه‌کار..">
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

                                <!-- Mobile Categories Filter -->
                                <div class="flex flex-col divide-y divide-border">
                                    <div class="w-full space-y-2 py-3" x-data="{ open: true }">
                                        <button type="button"
                                            class="w-full h-11 flex items-center justify-between gap-x-2 relative bg-secondary rounded-2xl transition hover:text-primary px-3"
                                            x-bind:class="open ? 'text-primary' : 'text-foreground'"
                                            x-on:click="open = !open">
                                            <span class="flex items-center gap-x-2">
                                                <span class="flex-shrink-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 4.23a2.25 2.25 0 00-2.15-1.705H6.911a2.25 2.25 0 00-2.15 1.705L2.35 13.177a2.25 2.25 0 00-.1.661z" />
                                                    </svg>
                                                </span>
                                                <span class="font-semibold text-sm text-right">دسته بندی نمونه‌کارها</span>
                                            </span>
                                            <span class="" x-bind:class="open ? 'rotate-180' : ''">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </span>
                                        </button>

                                        <div class="bg-secondary rounded-2xl relative p-3" x-show="open">
                                            <div class="space-y-2">
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="radio" name="mobile-portfolio-category" value="all" checked
                                                        class="mobile-portfolio-category-filter form-radio !ring-0 !ring-offset-0 bg-border border-0" />
                                                    <span class="text-sm text-muted">همه دسته‌ها</span>
                                                </label>
                                                <?php
                                                if (!empty($portfolio_categories) && !is_wp_error($portfolio_categories)) :
                                                    foreach ($portfolio_categories as $category) :
                                                ?>
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                    <input type="radio" name="mobile-portfolio-category" value="<?php echo esc_attr($category->slug); ?>"
                                                        class="mobile-portfolio-category-filter form-radio !ring-0 !ring-offset-0 bg-border border-0" />
                                                    <span class="text-sm text-muted"><?php echo esc_html($category->name); ?></span>
                                                </label>
                                                <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end offcanvas:content -->
                        </div><!-- end offcanvas:box -->

                        <!-- offcanvas:overlay -->
                        <div class="fixed inset-0 bg-black/10 dark:bg-white/10 cursor-pointer transition-all duration-1000 z-40"
                            x-bind:class="offcanvasOpen ? 'opacity-100 visible' : 'opacity-0 invisible'"
                            x-on:click="offcanvasOpen = false"></div><!-- end offcanvas:overlay -->
                    </div><!-- end filter:offcanvas -->
                </div>

                <div class="grid grid-cols-1 gap-5">
                    </div>



                    <!-- Portfolio Grid -->
                    <div id="portfolio-container" class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $portfolio_query = new WP_Query(array(
                        'post_type' => 'portfolio',
                        'posts_per_page' => 9,
                        'paged' => $paged,
                        'post_status' => 'publish',
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ));

                    if ($portfolio_query->have_posts()) :
                        while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                            $portfolio_id = get_the_ID();
                            $portfolio_image = wp_get_attachment_image_src(get_post_thumbnail_id($portfolio_id), 'large');
                            $portfolio_image_url = $portfolio_image ? $portfolio_image[0] : get_template_directory_uri() . '/assets/images/placeholder.jpg';
                            $portfolio_categories = wp_get_post_terms($portfolio_id, 'portfolio_category');
                    ?>
                    <article class="portfolio-item bg-background rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="relative group">
                            <a href="<?php echo esc_url(get_permalink()); ?>" class="block">
                                <img src="<?php echo esc_url($portfolio_image_url); ?>" 
                                    class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300 img-portfolio-archive" 
                                    alt="<?php echo esc_attr(get_the_title()); ?>" />
                            </a>
                            <?php if (!empty($portfolio_categories)) : ?>
                            <div class="absolute top-4 right-4">
                                <span class="bg-primary text-white px-3 py-1 rounded-full text-xs font-semibold">
                                    <?php echo esc_html($portfolio_categories[0]->name); ?>
                                </span>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-lg text-foreground mb-2 line-clamp-2">
                                <a href="<?php echo esc_url(get_permalink()); ?>" class="hover:text-primary transition-colors">
                                    <?php echo esc_html(get_the_title()); ?>
                                </a>
                            </h3>
                            <?php if (get_the_excerpt()) : ?>
                            <p class="text-muted text-sm line-clamp-3 mb-4">
                                <?php echo esc_html(get_the_excerpt()); ?>
                            </p>
                            <?php endif; ?>
                            <a href="<?php echo esc_url(get_permalink()); ?>" 
                                class="inline-flex items-center gap-2 text-primary font-semibold text-sm hover:text-primary/80 transition-colors">
                                مشاهده پروژه
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 4.5" />
                                </svg>
                            </a>
                        </div>
                    </article>
                    <?php 
                        endwhile;
                    else :
                    ?>
                    <div class="col-span-full text-center py-12">
                        <div class="text-muted mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 4.23a2.25 2.25 0 00-2.15-1.705H6.911a2.25 2.25 0 00-2.15 1.705L2.35 13.177a2.25 2.25 0 00-.1.661z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-foreground mb-2">هیچ نمونه‌کاری یافت نشد</h3>
                        <p class="text-muted">متأسفانه نمونه‌کاری با این فیلترها پیدا نشد.</p>
                    </div>
                    <?php endif; ?>
                    </div>

                    <!-- Load More Button -->
                    <?php if ($portfolio_query->max_num_pages > 1) : ?>
                    <div class="text-center mt-8">
                        <button id="load-more-portfolio" 
                            class="inline-flex items-center gap-2 bg-primary text-primary-foreground px-8 py-3 rounded-2xl font-semibold hover:bg-primary/90 transition-colors"
                            data-page="1" data-max-pages="<?php echo $portfolio_query->max_num_pages; ?>">
                            <span>بارگزاری بیشتر</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                            </svg>
                        </button>
                    </div>
                    <?php endif; ?>
                </div>

                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer()?>