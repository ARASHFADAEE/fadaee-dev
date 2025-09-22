<div class="overflow-x-hidden py-20">
            <!-- container -->
            <div class="max-w-7xl px-4 mx-auto">
                <div class="md:grid md:grid-cols-12 md:gap-10 md:space-y-0 space-y-5">
                    <div class="md:col-span-4 flex items-center gap-5">
                        <span
                            class="flex-shrink-0 flex items-center justify-center w-12 h-12 bg-primary text-primary-foreground rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M9.664 1.319a.75.75 0 0 1 .672 0 41.059 41.059 0 0 1 8.198 5.424.75.75 0 0 1-.254 1.285 31.372 31.372 0 0 0-7.86 3.83.75.75 0 0 1-.84 0 31.508 31.508 0 0 0-2.08-1.287V9.394c0-.244.116-.463.302-.592a35.504 35.504 0 0 1 3.305-2.033.75.75 0 0 0-.714-1.319 37 37 0 0 0-3.446 2.12A2.216 2.216 0 0 0 6 9.393v.38a31.293 31.293 0 0 0-4.28-1.746.75.75 0 0 1-.254-1.285 41.059 41.059 0 0 1 8.198-5.424ZM6 11.459a29.848 29.848 0 0 0-2.455-1.158 41.029 41.029 0 0 0-.39 3.114.75.75 0 0 0 .419.74c.528.256 1.046.53 1.554.82-.21.324-.455.63-.739.914a.75.75 0 1 0 1.06 1.06c.37-.369.69-.77.96-1.193a26.61 26.61 0 0 1 3.095 2.348.75.75 0 0 0 .992 0 26.547 26.547 0 0 1 5.93-3.95.75.75 0 0 0 .42-.739 41.053 41.053 0 0 0-.39-3.114 29.925 29.925 0 0 0-5.199 2.801 2.25 2.25 0 0 1-2.514 0c-.41-.275-.826-.541-1.25-.797a6.985 6.985 0 0 1-1.084 3.45 26.503 26.503 0 0 0-1.281-.78A5.487 5.487 0 0 0 6 12v-.54Z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <div class="flex flex-col space-y-2">
                            <span class="font-black xs:text-2xl text-lg text-primary">در مورد آرش فدایی چه میشنویم ؟</span>
                            <span class="font-semibold xs:text-base text-sm text-muted">این‌ها، بخش خیلی کوچکی
                                از نظراتی
                                هستند
                                که افراد
                                مختلف در مورد آرش فدایی  دارند.</span>
                        </div>
                    </div>
                    <div class="md:col-span-8 w-full max-w-xl mx-auto">
                        <?php
                        // Get featured testimonials
                        $testimonials_query = new WP_Query(array(
                            'post_type' => 'testimonial',
                            'posts_per_page' => 6,
                            'post_status' => 'publish',
                            'meta_query' => array(
                                array(
                                    'key' => '_testimonial_featured',
                                    'value' => '1',
                                    'compare' => '='
                                )
                            ),
                            'orderby' => 'date',
                            'order' => 'DESC'
                        ));

                        if ($testimonials_query->have_posts()) : ?>
                        <div class="swiper card-swiper-slider">
                            <div class="swiper-wrapper">
                                <?php while ($testimonials_query->have_posts()) : $testimonials_query->the_post();
                                    // Get testimonial meta data
                                    $client_name = get_post_meta(get_the_ID(), '_client_name', true);
                                    $client_position = get_post_meta(get_the_ID(), '_client_position', true);
                                    $client_company = get_post_meta(get_the_ID(), '_client_company', true);
                                    $client_avatar = get_post_meta(get_the_ID(), '_client_avatar', true);
                                    $testimonial_rating = get_post_meta(get_the_ID(), '_testimonial_rating', true);
                                    $project_name = get_post_meta(get_the_ID(), '_project_name', true);
                                    
                                    // Fallback avatar if none provided
                                    if (empty($client_avatar)) {
                                        $client_avatar = ARASH_THEME_DIR . '/assets/images/avatars/default.svg';
                                    }
                                ?>
                                <div class="swiper-slide pb-8">
                                    <div class="flex flex-col items-center justify-center bg-background border border-border rounded-2xl shadow-xl shadow-black/5 space-y-8 p-8">
                                        <!-- Testimonial Content -->
                                        <div class="font-semibold text-sm text-muted text-center">
                                            <?php echo wp_kses_post(get_the_content()); ?>
                                        </div>
                                        
                                        <!-- Rating Stars -->
                                        <?php if ($testimonial_rating) : ?>
                                        <div class="flex items-center gap-1">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" 
                                                     class="w-4 h-4 <?php echo $i <= $testimonial_rating ? 'text-yellow-400' : 'text-gray-300'; ?>">
                                                    <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                                                </svg>
                                            <?php endfor; ?>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <!-- Client Info -->
                                        <div class="flex items-center gap-3">
                                            <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                                                <img src="<?php echo esc_url($client_avatar); ?>" 
                                                     class="w-full h-full object-cover" 
                                                     alt="<?php echo esc_attr($client_name); ?>">
                                            </div>
                                            <div class="flex flex-col items-start space-y-1">
                                                <span class="line-clamp-1 font-bold text-xs text-foreground">
                                                    <?php echo esc_html($client_name); ?>
                                                </span>
                                                <span class="font-semibold text-xs text-muted">
                                                    <?php 
                                                    if ($project_name) {
                                                        echo esc_html($project_name);
                                                    } elseif ($client_position && $client_company) {
                                                        echo esc_html($client_position . ' - ' . $client_company);
                                                    } elseif ($client_position) {
                                                        echo esc_html($client_position);
                                                    } elseif ($client_company) {
                                                        echo esc_html($client_company);
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </div>
                        <?php else : ?>
                        <!-- Fallback content if no testimonials found -->
                        <div class="swiper card-swiper-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide pb-8">
                                    <div class="flex flex-col items-center justify-center bg-background border border-border rounded-2xl shadow-xl shadow-black/5 space-y-8 p-8">
                                        <div class="font-semibold text-sm text-muted text-center">
                                            هنوز نظری ثبت نشده است. اولین نظر خود را در پنل مدیریت اضافه کنید.
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden bg-gray-200">
                                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-start space-y-1">
                                                <span class="line-clamp-1 font-bold text-xs text-foreground">
                                                    نام مشتری
                                                </span>
                                                <span class="font-semibold text-xs text-muted">
                                                    نام پروژه
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; 
                        wp_reset_postdata(); ?>

                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end container -->
        </div>