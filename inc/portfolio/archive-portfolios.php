<?php
// Portfolio AJAX Filter Handler

// Handle portfolio filtering AJAX request
function filter_portfolio_ajax() {
    // Verify nonce for security
    if (!wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
        wp_die('Security check failed');
    }

    // Get parameters
    $category = sanitize_text_field($_POST['category'] ?? 'all');
    $search = sanitize_text_field($_POST['search'] ?? '');
    $sort = sanitize_text_field($_POST['sort'] ?? 'date_desc');
    $page = intval($_POST['page'] ?? 1);
    $load_more = $_POST['load_more'] === '1';
    $posts_per_page = 9;

    // Build query arguments
    $args = array(
        'post_type' => 'portfolio',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged' => $page,
    );

    // Handle search
    if (!empty($search)) {
        $args['s'] = $search;
    }

    // Handle category filter
    if ($category !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'portfolio_category',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    }

    // Handle sorting
    switch ($sort) {
        case 'date_asc':
            $args['orderby'] = 'date';
            $args['order'] = 'ASC';
            break;
        case 'title_asc':
            $args['orderby'] = 'title';
            $args['order'] = 'ASC';
            break;
        case 'date_desc':
        default:
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
    }

    // Execute query
    $portfolio_query = new WP_Query($args);

    // Generate HTML
    ob_start();
    
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
    <?php endif;

    $html = ob_get_clean();
    wp_reset_postdata();

    // Prepare response
    $response = array(
        'html' => $html,
        'has_more' => $page < $portfolio_query->max_num_pages,
        'max_pages' => $portfolio_query->max_num_pages,
        'current_page' => $page,
        'total_posts' => $portfolio_query->found_posts
    );

    wp_send_json_success($response);
}

// Register AJAX handlers
add_action('wp_ajax_filter_portfolio', 'filter_portfolio_ajax');
add_action('wp_ajax_nopriv_filter_portfolio', 'filter_portfolio_ajax');
?>