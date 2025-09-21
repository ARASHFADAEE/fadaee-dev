<?php
// Query for latest articles
$latest_articles = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC'
));
?>

        <div class="max-w-7xl space-y-14 px-4 mx-auto">
            <!-- articles -->
            <div
                class="lg:flex lg:items-center lg:gap-10 bg-gradient-to-l from-secondary to-background rounded-2xl sm:p-10 p-5">
                <div class="lg:w-4/12 flex items-start gap-5 lg:mb-0 mb-8">
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
                        <span class="font-black xs:text-2xl text-lg text-primary">از گوشه و اطراف دنیای
                            برنامه‌نویسی</span>
                        <span class="font-semibold xs:text-base text-sm text-muted">
                            نوشتن کار جالبیه که از هزاران سال همراه ما بوده و کمک کرده تا همیشه به روز باشیم، ما
                            در نابغه فضای رو به شکلی آماده کردیم تا شما بتونید ایده‌ها و مطالب جالب حوزه
                            برنامه‌نویسی رو در اختیار هزاران برنامه‌نویس عضو نابغه قرار بدید.
                        </span>
                    </div>
                </div>
                <div class="lg:w-8/12 w-full lg:mx-auto">
                    <?php if ($latest_articles->have_posts()) : ?>
                        <div class="grid sm:grid-cols-2 grid-cols-1 gap-x-5 gap-y-8">
                            <?php 
                            $column_count = 0;
                            $left_column = array();
                            $right_column = array();
                            
                            // Distribute posts into two columns
                            while ($latest_articles->have_posts()) : 
                                $latest_articles->the_post();
                                if ($column_count % 2 == 0) {
                                    $left_column[] = get_post();
                                } else {
                                    $right_column[] = get_post();
                                }
                                $column_count++;
                            endwhile;
                            wp_reset_postdata();
                            ?>
                            
                            <!-- Left Column -->
                            <div class="space-y-5">
                                <?php foreach ($left_column as $post) : 
                                    setup_postdata($post);
                                    $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
                                    $default_image = ARASH_THEME_DIR . '/assets/images/courses/01.jpg';
                                    $post_image = $featured_image ? $featured_image : $default_image;
                                    
                                    $author_id = get_the_author_meta('ID');
                                    $author_avatar = get_avatar_url($author_id, array('size' => 32));
                                    $author_name = get_the_author();
                                    
                                    $categories = get_the_category();
                                    $primary_category = !empty($categories) ? $categories[0] : null;
                                    
                                    // Calculate reading time (approximate)
                                    $content = get_the_content();
                                    $word_count = str_word_count(strip_tags($content));
                                    $reading_time = ceil($word_count / 200); // 200 words per minute
                                ?>
                                    <!-- article:card -->
                                    <div class="relative bg-background rounded-xl p-4">
                                        <div class="relative mb-3 z-20">
                                            <a href="<?php the_permalink(); ?>" class="block">
                                                <img src="<?php echo esc_url($post_image); ?>" class="max-w-full rounded-xl"
                                                    alt="<?php the_title_attribute(); ?>" />
                                            </a>

                                        </div>
                                        <div class="relative space-y-3 z-10">
                                            <h2 class="font-bold text-sm">
                                                <a href="<?php the_permalink(); ?>"
                                                    class="line-clamp-1 text-foreground transition-colors hover:text-primary"><?php the_title(); ?></a>
                                            </h2>
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-1">
                                                    <div
                                                        class="flex-shrink-0 w-8 h-8 border border-white rounded-full overflow-hidden">
                                                        <img src="<?php echo esc_url($author_avatar); ?>"
                                                            class="w-full h-full object-cover" alt="<?php echo esc_attr($author_name); ?>">
                                                    </div>
                                                    <a href="<?php echo get_author_posts_url($author_id); ?>"
                                                        class="line-clamp-1 font-bold text-xs text-foreground transition-colors hover:text-primary"><?php echo esc_html($author_name); ?></a>
                                                </div>
                                                <?php if ($primary_category) : ?>
                                                    <a href="<?php echo get_category_link($primary_category->term_id); ?>"
                                                        class="bg-primary/10 rounded-full text-primary transition-all hover:opacity-80 py-1 px-4">
                                                        <span class="font-bold text-xxs"><?php echo esc_html($primary_category->name); ?></span>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex justify-end">
                                                <div class="flex items-center gap-1 text-muted">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    <span class="font-semibold text-xs text-muted">زمان مطالعه:</span>
                                                    <span class="font-semibold text-xs text-foreground"><?php echo $reading_time; ?> دقیقه</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end article:card -->
                                <?php endforeach; ?>
                            </div>
                            
                            <!-- Right Column -->
                            <div class="space-y-5">
                                <?php foreach ($right_column as $post) : 
                                    setup_postdata($post);
                                    $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                                    $default_image = ARASH_THEME_DIR . '/assets/images/courses/02.jpg';
                                    $post_image = $featured_image ? $featured_image : $default_image;
                                    
                                    $author_id = get_the_author_meta('ID');
                                    $author_avatar = get_avatar_url($author_id, array('size' => 32));
                                    $author_name = get_the_author();
                                    
                                    $categories = get_the_category();
                                    $primary_category = !empty($categories) ? $categories[0] : null;
                                    
                                    // Calculate reading time (approximate)
                                    $content = get_the_content();
                                    $word_count = str_word_count(strip_tags($content));
                                    $reading_time = ceil($word_count / 200); // 200 words per minute
                                ?>
                                    <!-- article:card -->
                                    <div class="relative bg-background rounded-xl p-4">
                                        <div class="relative mb-3 z-20">
                                            <a href="<?php the_permalink(); ?>" class="block">
                                                <img src="<?php echo esc_url($post_image); ?>" class="max-w-full rounded-xl"
                                                    alt="<?php the_title_attribute(); ?>" />
                                            </a>

                                        </div>
                                        <div class="relative space-y-3 z-10">
                                            <h2 class="font-bold text-sm">
                                                <a href="<?php the_permalink(); ?>"
                                                    class="line-clamp-1 text-foreground transition-colors hover:text-primary"><?php the_title(); ?></a>
                                            </h2>
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-1">
                                                    <div
                                                        class="flex-shrink-0 w-8 h-8 border border-white rounded-full overflow-hidden">
                                                        <img src="<?php echo esc_url($author_avatar); ?>"
                                                            class="w-full h-full object-cover" alt="<?php echo esc_attr($author_name); ?>">
                                                    </div>
                                                    <a href="<?php echo get_author_posts_url($author_id); ?>"
                                                        class="line-clamp-1 font-bold text-xs text-foreground transition-colors hover:text-primary"><?php echo esc_html($author_name); ?></a>
                                                </div>
                                                <?php if ($primary_category) : ?>
                                                    <a href="<?php echo get_category_link($primary_category->term_id); ?>"
                                                        class="bg-primary/10 rounded-full text-primary transition-all hover:opacity-80 py-1 px-4">
                                                        <span class="font-bold text-xxs"><?php echo esc_html($primary_category->name); ?></span>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex justify-end">
                                                <div class="flex items-center gap-1 text-muted">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    <span class="font-semibold text-xs text-muted">زمان مطالعه:</span>
                                                    <span class="font-semibold text-xs text-foreground"><?php echo $reading_time; ?> دقیقه</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end article:card -->
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                        <div class="text-center py-8">
                            <p class="text-muted">هنوز مقاله‌ای منتشر نشده است.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- end articles -->
        </div>