<?php get_header(); ?>

<main class="min-h-screen bg-background dark:bg-slate-900">
    <?php while (have_posts()) : the_post(); 
        // Get custom fields
        $project_image = get_post_meta(get_the_ID(), '_project_image', true);
        $project_url = get_post_meta(get_the_ID(), '_project_url', true);
        $project_technologies = get_post_meta(get_the_ID(), '_project_technologies', true);
        if (!is_array($project_technologies)) {
            $project_technologies = array();
        }
        
        // Get portfolio categories
        $portfolio_categories = wp_get_post_terms(get_the_ID(), 'portfolio_category');
        
        // Get featured image
        $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
        $main_image = $project_image ? $project_image : $featured_image;
    ?>
    
    <!-- Hero Section -->
    <section class="relative overflow-hidden">
        <div class="container mx-auto px-4 py-16 lg:py-24">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Content -->
                <div class="space-y-8">
                    <!-- Breadcrumb -->
                    <nav class="flex items-center gap-2 text-sm text-muted dark:text-slate-400">
                        <a href="<?php echo home_url(); ?>" class="hover:text-primary dark:hover:text-blue-400 transition-colors">خانه</a>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                        <a href="<?php echo home_url('/portfolio'); ?>" class="hover:text-primary dark:hover:text-blue-400 transition-colors">نمونه‌کارها</a>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-foreground dark:text-slate-50"><?php the_title(); ?></span>
                    </nav>
                    
                    <!-- Categories -->
                    <?php if (!empty($portfolio_categories)) : ?>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach ($portfolio_categories as $category) : ?>
                        <a href="<?php echo get_term_link($category); ?>" class="inline-flex items-center gap-1 px-3 py-1 bg-primary/10 dark:bg-blue-500/20 text-primary dark:text-blue-400 rounded-full text-sm font-medium hover:bg-primary/20 dark:hover:bg-blue-500/30 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M5.5 3A2.5 2.5 0 0 0 3 5.5v2.879a2.5 2.5 0 0 0 .732 1.767l6.5 6.5a2.5 2.5 0 0 0 3.536 0l2.878-2.878a2.5 2.5 0 0 0 0-3.536l-6.5-6.5A2.5 2.5 0 0 0 8.38 3H5.5ZM6 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                            </svg>
                            <?php echo esc_html($category->name); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Title -->
                    <h1 class="text-4xl lg:text-5xl font-black text-foreground dark:text-slate-50 leading-tight">
                        <?php the_title(); ?>
                    </h1>
                    
                    <!-- Excerpt -->
                    <?php if (has_excerpt()) : ?>
                    <p class="text-lg text-muted dark:text-slate-400 leading-relaxed">
                        <?php the_excerpt(); ?>
                    </p>
                    <?php endif; ?>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-4">
                        <?php if ($project_url) : ?>
                        <a href="<?php echo esc_url($project_url); ?>" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-primary dark:bg-blue-600 text-primary-foreground dark:text-white rounded-full font-semibold hover:opacity-90 transition-opacity">
                            <span>مشاهده پروژه</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M4.25 5.5a.75.75 0 0 0-.75.75v8.5c0 .414.336.75.75.75h8.5a.75.75 0 0 0 .75-.75v-4a.75.75 0 0 1 1.5 0v4A2.25 2.25 0 0 1 12.75 17h-8.5A2.25 2.25 0 0 1 2 14.75v-8.5A2.25 2.25 0 0 1 4.25 4h5a.75.75 0 0 1 0 1.5h-5Z" clip-rule="evenodd" />
                                <path fill-rule="evenodd" d="M6.194 12.753a.75.75 0 0 0 1.06.053L16.5 4.44v2.81a.75.75 0 0 0 1.5 0v-4.5a.75.75 0 0 0-.75-.75h-4.5a.75.75 0 0 0 0 1.5h2.553l-9.056 8.194a.75.75 0 0 0-.053 1.06Z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <?php endif; ?>
                        <button onclick="window.history.back()" class="inline-flex items-center gap-2 px-6 py-3 bg-secondary dark:bg-slate-800 text-foreground dark:text-slate-50 rounded-full font-semibold hover:bg-secondary/80 dark:hover:bg-slate-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z" clip-rule="evenodd" />
                            </svg>
                            <span>بازگشت</span>
                        </button>
                    </div>
                </div>
                
                <!-- Image -->
                <div class="relative">
                    <?php if ($main_image) : ?>
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="<?php echo esc_url($main_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="w-full h-auto aspect-[4/3] object-cover" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Content Section -->
    <section class="py-20 lg:py-32">
        <div class="container mx-auto px-4">
            <!-- Main Content - Centered -->
            <div class="max-w-4xl mx-auto text-center space-y-12">
                <!-- Description -->
                <div class="prose prose-lg max-w-none mx-auto">
                    <h2 class="text-3xl lg:text-4xl font-bold text-foreground dark:text-slate-50 mb-8">درباره این پروژه</h2>
                    <div class="text-muted dark:text-slate-400 leading-relaxed text-lg">
                        <?php the_content(); ?>
                    </div>
                </div>
                
                <!-- Technologies -->
                <?php if (!empty($project_technologies)) : ?>
                <div class="bg-secondary/50 dark:bg-slate-800/50 rounded-3xl p-8">
                    <h3 class="text-2xl font-bold text-foreground dark:text-slate-50 mb-6 flex items-center justify-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 text-primary dark:text-blue-400">
                            <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                        </svg>
                        تکنولوژی‌های استفاده شده
                    </h3>
                    <div class="flex flex-wrap justify-center gap-3">
                        <?php 
                        $tech_labels = array(
                            'figma' => 'Figma',
                            'wordpress' => 'WordPress',
                            'github' => 'GitHub',
                            'woocommerce' => 'WooCommerce',
                            'jetengine' => 'Jet Engine',
                            'react' => 'React',
                            'vue' => 'Vue.js',
                            'angular' => 'Angular',
                            'javascript' => 'JavaScript',
                            'php' => 'PHP',
                            'mysql' => 'MySQL',
                            'html' => 'HTML',
                            'css' => 'CSS',
                            'sass' => 'Sass',
                            'bootstrap' => 'Bootstrap',
                            'tailwind' => 'Tailwind CSS',
                            'laravel' => 'Laravel',
                            'nodejs' => 'Node.js',
                            'python' => 'Python',
                            'photoshop' => 'Photoshop',
                            'illustrator' => 'Illustrator',
                            'xd' => 'Adobe XD',
                        );
                        
                        foreach ($project_technologies as $tech) : 
                            $label = isset($tech_labels[$tech]) ? $tech_labels[$tech] : $tech;
                        ?>
                        <span class="inline-flex items-center px-4 py-2 bg-background dark:bg-slate-900 border border-border dark:border-slate-600 rounded-full text-sm font-medium text-foreground dark:text-slate-50 hover:bg-primary/10 dark:hover:bg-blue-500/20 hover:border-primary/20 dark:hover:border-blue-500/30 transition-colors">
                            <?php echo esc_html($label); ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                

                </div>
            </div>
        </div>
    </section>
    
    <!-- Related Projects -->
    <section class="py-16 lg:py-24 bg-secondary/30 dark:bg-slate-800/30">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-foreground dark:text-slate-50 mb-12 text-center">پروژه‌های مرتبط</h2>
            
            <?php
            $related_args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => 3,
                'post__not_in' => array(get_the_ID()),
                'orderby' => 'rand'
            );
            
            if (!empty($portfolio_categories)) {
                $related_args['tax_query'] = array(
                    array(
                        'taxonomy' => 'portfolio_category',
                        'field' => 'term_id',
                        'terms' => wp_list_pluck($portfolio_categories, 'term_id')
                    )
                );
            }
            
            $related_query = new WP_Query($related_args);
            
            if ($related_query->have_posts()) : ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ($related_query->have_posts()) : $related_query->the_post(); 
                    $related_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    $related_categories = wp_get_post_terms(get_the_ID(), 'portfolio_category');
                ?>
                <article class="group">
                    <div class="relative overflow-hidden rounded-2xl bg-background dark:bg-slate-900 shadow-lg hover:shadow-xl dark:shadow-slate-900/50 transition-shadow">
                        <?php if ($related_image) : ?>
                        <div class="relative">
                            <img src="<?php echo esc_url($related_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="p-6">
                            <?php if (!empty($related_categories)) : ?>
                            <div class="flex flex-wrap gap-1 mb-3">
                                <?php foreach (array_slice($related_categories, 0, 2) as $category) : ?>
                                <span class="inline-block px-2 py-1 bg-primary/10 dark:bg-blue-500/20 text-primary dark:text-blue-400 rounded text-xs font-medium">
                                    <?php echo esc_html($category->name); ?>
                                </span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                            
                            <h3 class="text-lg font-bold text-foreground dark:text-slate-50 mb-2 group-hover:text-primary dark:group-hover:text-blue-400 transition-colors">
                                <a href="<?php the_permalink(); ?>" class="line-clamp-2">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            
                            <?php if (has_excerpt()) : ?>
                            <p class="text-sm text-muted dark:text-slate-400 line-clamp-2 mb-4">
                                <?php the_excerpt(); ?>
                            </p>
                            <?php endif; ?>
                            
                            <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 text-primary dark:text-blue-400 font-medium text-sm hover:text-primary/80 dark:hover:text-blue-300 transition-colors">
                                <span>مشاهده پروژه</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                <?php endwhile; ?>
            </div>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </section>
    
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>