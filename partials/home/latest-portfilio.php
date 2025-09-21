<?php
// Query for latest Portfolio items
$args = array(
    'post_type' => 'portfolio',
    'post_status' => 'publish',
    'posts_per_page' => 6,
    'orderby' => 'date',
    'order' => 'DESC'
);

$portfolios = new WP_Query($args);

if ($portfolios->have_posts()) : ?>
<div class="space-y-8">
    <!-- section:title -->
    <div class="flex items-center justify-between gap-8 bg-gradient-to-l from-secondary to-background rounded-2xl p-5">
        <div class="flex items-center gap-5">
            <span class="flex items-center justify-center w-12 h-12 bg-primary text-primary-foreground rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M9.664 1.319a.75.75 0 0 1 .672 0 41.059 41.059 0 0 1 8.198 5.424.75.75 0 0 1-.254 1.285 31.372 31.372 0 0 0-7.86 3.83.75.75 0 0 1-.84 0 31.508 31.508 0 0 0-2.08-1.287V9.394c0-.244.116-.463.302-.592a35.504 35.504 0 0 1 3.305-2.033.75.75 0 0 0-.714-1.319 37 37 0 0 0-3.446 2.12A2.216 2.216 0 0 0 6 9.393v.38a31.293 31.293 0 0 0-4.28-1.746.75.75 0 0 1-.254-1.285 41.059 41.059 0 0 1 8.198-5.424ZM6 11.459a29.848 29.848 0 0 0-2.455-1.158 41.029 41.029 0 0 0-.39 3.114.75.75 0 0 0 .419.74c.528.256 1.046.53 1.554.82-.21.324-.455.63-.739.914a.75.75 0 1 0 1.06 1.06c.37-.369.69-.77.96-1.193a26.61 26.61 0 0 1 3.095 2.348.75.75 0 0 0 .992 0 26.547 26.547 0 0 1 5.93-3.95.75.75 0 0 0 .42-.739 41.053 41.053 0 0 0-.39-3.114 29.925 29.925 0 0 0-5.199 2.801 2.25 2.25 0 0 1-2.514 0c-.41-.275-.826-.541-1.25-.797a6.985 6.985 0 0 1-1.084 3.45 26.503 26.503 0 0 0-1.281-.78A5.487 5.487 0 0 0 6 12v-.54Z" clip-rule="evenodd"></path>
                </svg>
            </span>
            <div class="flex flex-col font-black text-2xl space-y-2">
                <span class="font-black xs:text-2xl text-lg text-primary">آخرین نمونه کار ها</span>
                <span class="font-semibold xs:text-base text-sm text-foreground">پروژه های انجام شده</span>
            </div>
        </div>
        <a href="<?php echo esc_url(home_url('/portfolio')); ?>" class="sm:w-auto w-11 h-11 inline-flex items-center justify-center gap-1 bg-secondary rounded-full text-foreground transition-colors hover:text-primary sm:px-4">
            <span class="font-semibold text-sm sm:block hidden">مشاهده همه</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd"></path>
            </svg>
        </a>
    </div>
    <!-- end section:title -->

    <!-- section:latest-products:slider -->
    <div class="swiper col3-swiper-slider">
        <div class="swiper-wrapper">
            <?php while ($portfolios->have_posts()) : $portfolios->the_post(); 
                $portfolio_id = get_the_ID();
                $portfolio_image = wp_get_attachment_image_src(get_post_thumbnail_id($portfolio_id), 'large');
                $portfolio_image_url = $portfolio_image ? $portfolio_image[0] : get_template_directory_uri() . '/assets/images/placeholder.jpg';
                $portfolio_link = get_permalink($portfolio_id);
                $portfolio_title = get_the_title();
                $portfolio_excerpt = get_the_excerpt();
            ?>
            <div class="swiper-slide">
                <!-- product:card -->
                <div class="relative">
                    <div class="relative z-10">
                        <a href="<?php echo esc_url($portfolio_link); ?>" class="block">
                            <img src="<?php echo esc_url($portfolio_image_url); ?>" class="w-full h-64 rounded-3xl object-cover img-custon-pro" alt="<?php echo esc_attr($portfolio_title); ?>" />
                        </a>
                        <?php 
                        $portfolio_categories = wp_get_post_terms($portfolio_id, 'portfolio_category');
                        if (!empty($portfolio_categories)) :
                            $first_category = $portfolio_categories[0];
                        ?>
                        <a href="<?php echo esc_url(get_term_link($first_category)); ?>" class="absolute left-3 top-3 h-11 inline-flex items-center justify-center gap-1 bg-black/20 rounded-full text-white transition-all hover:opacity-80 px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5V3z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-semibold text-sm"><?php echo esc_html($first_category->name); ?></span>
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="bg-background rounded-b-3xl -mt-12 pt-12">
                        
                        <div class="space-y-3 p-5">
                            <h2 class="font-bold text-lg">
                                <a href="<?php echo esc_url($portfolio_link); ?>" class="line-clamp-2 text-foreground transition-colors hover:text-primary">
                                    <?php echo esc_html($portfolio_title); ?>
                                </a>
                            </h2>
                            <?php if ($portfolio_excerpt) : ?>
                            <p class="text-sm text-muted line-clamp-2">
                                <?php echo esc_html($portfolio_excerpt); ?>
                            </p>
                            <?php endif; ?>
                            <div class="flex items-center justify-between pt-2">
                                <a href="<?php echo esc_url($portfolio_link); ?>" class="inline-flex items-center gap-2 text-primary font-semibold text-sm transition-colors hover:text-primary/80">
                                    <span>مشاهده پروژه</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                        <path fill-rule="evenodd" d="M12.97 3.97a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06l6.22-6.22H3a.75.75 0 0 1 0-1.5h16.19l-6.22-6.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end product:card -->
            </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
        </div>
    </div>
    <!-- end section:latest-products:slider -->
</div>