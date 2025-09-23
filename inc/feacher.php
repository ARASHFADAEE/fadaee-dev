<?php 

// add feacher suport theme
function theme_support(){
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('woocommerce');
    add_theme_support('custom_logo');
}
add_action('after_setup_theme', 'theme_support');

//register menu theme item
function register_menu_theme(){
    register_nav_menus(array(
        'main-menu' => 'منو اصلی',
        'footer-menu' => 'منو فوتر',
        "mega-menu" => "مگا منو محصولات",
        "mobile-menu" => "منو موبایل"
    ));
}
add_action('after_setup_theme','register_menu_theme');

//register widget areas
function arash_widgets_init() {
    register_sidebar(array(
        'name'          => 'نوار کناری اصلی',
        'id'            => 'sidebar-1',
        'description'   => 'نوار کناری اصلی سایت',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Footer Widget Areas
    register_sidebar(array(
        'name'          => 'فوتر - اطلاعات تماس',
        'id'            => 'footer-contact',
        'description'   => 'ناحیه ویجت برای اطلاعات تماس در فوتر (شماره تلفن و ساعات کاری)',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => 'فوتر - درباره ما',
        'id'            => 'footer-about',
        'description'   => 'ناحیه ویجت برای بخش درباره ما در فوتر',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => 'فوتر - لینک های مفید',
        'id'            => 'footer-links',
        'description'   => 'ناحیه ویجت برای لینک های مفید در فوتر',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => 'فوتر - خبرنامه',
        'id'            => 'footer-newsletter',
        'description'   => 'ناحیه ویجت برای فرم خبرنامه در فوتر',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => 'فوتر - شبکه های اجتماعی',
        'id'            => 'footer-social',
        'description'   => 'ناحیه ویجت برای شبکه های اجتماعی در فوتر',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'arash_widgets_init');

//search ajax header
function ajax_search(){
    check_ajax_referer('ajax-nonce', 'nonce');
    $search_query = sanitize_text_field($_POST['search_query']);
    
    $args = array(
        's' => $search_query,
        'post_type' => array('post', 'page'), // جستجو در پست‌ها و صفحات
        'posts_per_page' => 8,
        'post_status' => 'publish'
    );
    
    $query = new WP_Query($args);
    
    if($query->have_posts()){
        echo '<div class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg">';
        while($query->have_posts()){
            $query->the_post();
            $excerpt = wp_trim_words(get_the_excerpt(), 15, '...');
            $post_type_label = get_post_type() == 'post' ? 'مقاله' : 'صفحه';
            
            echo '<div class="border-b border-gray-100 dark:border-gray-700 last:border-b-0">';
            echo '<a href="'.get_permalink().'" class="block p-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors rounded-md">';
            echo '<div class="flex items-start justify-between">';
            echo '<div class="flex-1">';
            echo '<h4 class="text-sm font-medium text-gray-900 dark:text-white mb-1">'.get_the_title().'</h4>';
            if($excerpt) {
                echo '<p class="text-xs text-gray-600 dark:text-white mb-1">'.$excerpt.'</p>';
            }
            echo '<span class="text-xs text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 px-2 py-1 rounded-full">'.$post_type_label.'</span>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="p-6 text-center bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg">';
        echo '<svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">';
        echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />';
        echo '</svg>';
        echo '<p class="text-sm text-gray-700 dark:text-white mb-1">نتیجه‌ای برای "<strong class="text-gray-900 dark:text-white">'.$search_query.'</strong>" یافت نشد.</p>';
        echo '<p class="text-xs text-gray-500 dark:text-gray-300">کلمات کلیدی دیگری امتحان کنید.</p>';
        echo '</div>';
    }
    
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_ajax_search', 'ajax_search');
add_action('wp_ajax_nopriv_ajax_search', 'ajax_search');

// Mobile Ajax Search Function
function mobile_ajax_search() {
    check_ajax_referer('ajax-nonce', 'nonce');
    
    $search_query = sanitize_text_field($_POST['search_query']);
    
    $args = array(
        'post_type' => array('post', 'page'),
        'post_status' => 'publish',
        's' => $search_query,
        'posts_per_page' => 6, // کمتر برای موبایل
    );
    
    $query = new WP_Query($args);
    
    if($query->have_posts()){
        echo '<div class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">';
        while($query->have_posts()){
            $query->the_post();
            $excerpt = wp_trim_words(get_the_excerpt(), 10, '...');
            $post_type_label = get_post_type() == 'post' ? 'مقاله' : 'صفحه';
            
            echo '<div class="border-b border-gray-100 dark:border-gray-700 last:border-b-0">';
            echo '<a href="'.get_permalink().'" class="block p-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors rounded-md">';
            echo '<div class="flex items-start justify-between">';
            echo '<div class="flex-1">';
            echo '<h4 class="text-xs font-medium text-gray-900 dark:text-white mb-1">'.get_the_title().'</h4>';
            if($excerpt) {
                echo '<p class="text-xs text-gray-600 dark:text-white mb-1">'.$excerpt.'</p>';
            }
            echo '<span class="text-xs text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 px-1.5 py-0.5 rounded-full">'.$post_type_label.'</span>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<div class="p-4 text-center bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md">';
        echo '<svg class="mx-auto h-8 w-8 text-gray-400 dark:text-gray-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">';
        echo '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />';
        echo '</svg>';
        echo '<p class="text-xs text-gray-700 dark:text-white mb-1">نتیجه‌ای برای "<strong class="text-gray-900 dark:text-white">'.$search_query.'</strong>" یافت نشد.</p>';
        echo '<p class="text-xs text-gray-500 dark:text-gray-300">کلمات کلیدی دیگری امتحان کنید.</p>';
        echo '</div>';
    }
    
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_mobile_ajax_search', 'mobile_ajax_search');
add_action('wp_ajax_nopriv_mobile_ajax_search', 'mobile_ajax_search');

// AJAX Comment Submission
function ajax_submit_comment() {
    check_ajax_referer('comment_nonce', 'nonce');
    
    // Check if user is logged in first
    if (!is_user_logged_in()) {
        wp_send_json_error('برای ارسال کامنت باید وارد شوید.');
        return;
    }
    
    // Validate POST data
    if (!isset($_POST['post_id']) || !isset($_POST['parent_id']) || !isset($_POST['comment_content'])) {
        wp_send_json_error('اطلاعات ارسالی ناقص است.');
        return;
    }
    
    $post_id = intval($_POST['post_id']);
    $parent_id = intval($_POST['parent_id']);
    $comment_content = sanitize_textarea_field($_POST['comment_content']);
    
    if (empty($comment_content)) {
        wp_send_json_error('محتوای کامنت نمی‌تواند خالی باشد.');
        return;
    }
    
    if ($post_id <= 0) {
        wp_send_json_error('شناسه پست نامعتبر است.');
        return;
    }
    
    $current_user = wp_get_current_user();
    
    $comment_data = array(
        'comment_post_ID' => $post_id,
        'comment_content' => $comment_content,
        'comment_parent' => $parent_id,
        'user_id' => $current_user->ID,
        'comment_author' => $current_user->display_name,
        'comment_author_email' => $current_user->user_email,
        'comment_approved' => 1, // Auto-approve for logged-in users
    );
    
    $comment_id = wp_insert_comment($comment_data);
    
    if ($comment_id) {
        // Get the new comment data
        $comment = get_comment($comment_id);
        $comment_author = get_comment_author($comment_id);
        $comment_avatar = get_avatar_url($current_user->ID);
        $comment_content = get_comment_text($comment_id);
        
        // Persian time ago function
        function persian_time_ago_ajax($datetime) {
            $time = time() - strtotime($datetime);
            
            if ($time < 60) return 'همین الان';
            if ($time < 3600) return floor($time/60) . ' دقیقه پیش';
            if ($time < 86400) return floor($time/3600) . ' ساعت پیش';
            if ($time < 2592000) return floor($time/86400) . ' روز پیش';
            if ($time < 31536000) return floor($time/2592000) . ' ماه پیش';
            return floor($time/31536000) . ' سال پیش';
        }
        
        $comment_date = persian_time_ago_ajax($comment->comment_date);
        
        // Build HTML for the new comment
        $html = '';
        
        if ($parent_id == 0) {
            // Top-level comment
            $html .= '<div class="space-y-3" data-comment-id="' . $comment_id . '">';
            $html .= '<div class="bg-background border border-border rounded-3xl space-y-3 p-5">';
        } else {
            // Reply comment
            $html .= '<div class="bg-background border border-border rounded-3xl space-y-3 p-5" data-comment-id="' . $comment_id . '">';
        }
        
        $html .= '<div class="flex sm:flex-nowrap flex-wrap sm:flex-row flex-col sm:items-center sm:justify-between gap-5 border-b border-border pb-3">';
        $html .= '<div class="flex items-center gap-3">';
        $html .= '<div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">';
        $html .= '<img src="' . $comment_avatar . '" class="w-full h-full object-cover" alt="..." />';
        $html .= '</div>';
        $html .= '<div class="flex flex-col items-start space-y-1">';
        $html .= '<span class="line-clamp-1 font-semibold text-sm text-foreground">' . $comment_author . '</span>';
        $html .= '<span class="text-xs text-muted">' . $comment_date . '</span>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="flex items-center gap-3 sm:mr-0 mr-auto">';
        $html .= '<button type="button" class="reply-btn flex items-center h-9 gap-1 bg-secondary rounded-full text-muted transition-colors hover:text-primary px-4" data-comment-id="' . ($parent_id == 0 ? $comment_id : $parent_id) . '" data-author-name="' . $comment_author . '">';
        $html .= '<span class="text-xs">پاسخ</span>';
        $html .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">';
        $html .= '<path fill-rule="evenodd" d="M12.207 2.232a.75.75 0 0 0 .025 1.06l4.146 3.958H6.375a5.375 5.375 0 0 0 0 10.75H9.25a.75.75 0 0 0 0-1.5H6.375a3.875 3.875 0 0 1 0-7.75h10.003l-4.146 3.957a.75.75 0 0 0 1.036 1.085l5.5-5.25a.75.75 0 0 0 0-1.085l-5.5-5.25a.75.75 0 0 0-1.06.025Z" clip-rule="evenodd"></path>';
        $html .= '</svg>';
        $html .= '</button>';
        $html .= '<button type="button" class="like-btn flex items-center justify-center relative w-9 h-9 bg-secondary rounded-full text-muted transition-colors hover:text-red-500" data-comment-id="' . $comment_id . '">';
        $html .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">';
        $html .= '<path d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z"></path>';
        $html .= '</svg>';
        $html .= '</button>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<p class="text-sm text-muted">' . $comment_content . '</p>';
        $html .= '</div>';
        
        if ($parent_id == 0) {
            $html .= '</div>';
        }
        
        wp_send_json_success(array(
            'comment_id' => $comment_id,
            'parent_id' => $parent_id,
            'html' => $html
        ));
    } else {
        wp_send_json_error('خطا در ارسال کامنت. لطفاً دوباره تلاش کنید.');
    }
}
add_action('wp_ajax_submit_comment', 'ajax_submit_comment');
add_action('wp_ajax_nopriv_submit_comment', 'ajax_submit_comment');

// AJAX Comment Like/Unlike
function ajax_like_comment() {
    check_ajax_referer('comment_nonce', 'nonce');
    
    // Check if user is logged in first
    if (!is_user_logged_in()) {
        wp_send_json_error('برای لایک کردن باید وارد شوید.');
        return;
    }
    
    // Validate POST data
    if (!isset($_POST['comment_id'])) {
        wp_send_json_error('شناسه کامنت ارسال نشده است.');
        return;
    }
    
    $comment_id = intval($_POST['comment_id']);
    
    if ($comment_id <= 0) {
        wp_send_json_error('شناسه کامنت نامعتبر است.');
        return;
    }
    
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;
    
    // Get current likes
    $liked_users = get_comment_meta($comment_id, 'liked_users', true);
    if (!is_array($liked_users)) {
        $liked_users = array();
    }
    
    $likes_count = get_comment_meta($comment_id, 'likes_count', true) ?: 0;
    
    // Check if user already liked
    $user_liked = in_array($user_id, $liked_users);
    
    if ($user_liked) {
        // Unlike
        $liked_users = array_diff($liked_users, array($user_id));
        $likes_count = max(0, $likes_count - 1);
        $action = 'unliked';
    } else {
        // Like
        $liked_users[] = $user_id;
        $likes_count++;
        $action = 'liked';
    }
    
    // Update meta
    update_comment_meta($comment_id, 'liked_users', $liked_users);
    update_comment_meta($comment_id, 'likes_count', $likes_count);
    
    wp_send_json_success(array(
        'action' => $action,
        'likes_count' => $likes_count,
        'user_liked' => !$user_liked
    ));
}
add_action('wp_ajax_like_comment', 'ajax_like_comment');
add_action('wp_ajax_nopriv_like_comment', 'ajax_like_comment');

// AJAX Blog Filter
function ajax_filter_blog() {
    check_ajax_referer('blog_filter_nonce', 'nonce');
    
    // Get filter parameters
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    $sort = isset($_POST['sort']) ? sanitize_text_field($_POST['sort']) : 'newest';
    $tag = isset($_POST['tag']) ? sanitize_text_field($_POST['tag']) : '';
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 6;
    
    // Build query arguments
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged' => $paged,
        'posts_per_page' => $posts_per_page,
    );
    
    // Add search parameter
    if (!empty($search)) {
        $args['s'] = $search;
    }
    
    // Add category filter
    if (!empty($category) && $category !== 'all') {
        $args['category_name'] = $category;
    }
    
    // Add tag filter
    if (!empty($tag)) {
        $args['tag'] = $tag;
    }
    
    // Add sorting
    switch ($sort) {
        case 'oldest':
            $args['orderby'] = 'date';
            $args['order'] = 'ASC';
            break;
        case 'title':
            $args['orderby'] = 'title';
            $args['order'] = 'ASC';
            break;
        case 'popular':
            $args['meta_key'] = 'post_views';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        case 'newest':
        default:
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
    }
    
    $query = new WP_Query($args);
    
    ob_start();
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $categories = get_the_category();
            $author_id = get_the_author_meta('ID');
            $reading_time = get_post_meta(get_the_ID(), 'reading_time', true);
            if (!$reading_time) $reading_time = '5 دقیقه';
            ?>
            <!-- article:card -->
            <div class="relative bg-background rounded-xl shadow-xl shadow-black/5 p-4">
                <div class="relative mb-3 z-20">
                    <a href="<?php the_permalink(); ?>" class="block">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium', array('class' => 'max-w-full rounded-xl')); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/courses/01.jpg" class="max-w-full rounded-xl" alt="<?php the_title(); ?>" />
                        <?php endif; ?>
                    </a>
                    <button type="button"
                        class="absolute left-3 -bottom-3 w-9 h-9 inline-flex items-center justify-center bg-secondary rounded-full shadow-xl text-muted transition-colors hover:text-red-500 z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" class="w-5 h-5">
                            <path
                                d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z">
                            </path>
                        </svg>
                    </button>
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
                                 <?php 
                                 $avatar = get_avatar($author_id, 32, 'mystery', '', array('class' => 'w-full h-full object-cover'));
                                 if ($avatar) {
                                     echo $avatar;
                                 } else {
                                     echo '<div class="w-full h-full bg-gray-300 flex items-center justify-center text-gray-600 text-xs">' . substr(get_the_author(), 0, 1) . '</div>';
                                 }
                                 ?>
                             </div>
                            <a href="<?php echo get_author_posts_url($author_id); ?>"
                                class="line-clamp-1 font-bold text-xs text-foreground transition-colors hover:text-primary"><?php the_author(); ?></a>
                        </div>
                        <?php if (!empty($categories)) : ?>
                        <a href="<?php echo get_category_link($categories[0]->term_id); ?>"
                            class="bg-primary/10 rounded-full text-primary transition-all hover:opacity-80 py-1 px-4">
                            <span class="font-bold text-xxs"><?php echo esc_html($categories[0]->name); ?></span>
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="flex justify-end">
                        <div class="flex items-center gap-1 text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span class="font-semibold text-xs text-muted">زمان مطالعه:</span>
                            <span class="font-semibold text-xs text-foreground"><?php echo esc_html($reading_time); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end article:card -->
            <?php
        }
        wp_reset_postdata();
    } else {
        ?>
        <div class="col-span-full text-center py-8">
            <p class="text-muted">هیچ مقاله‌ای یافت نشد.</p>
        </div>
        <?php
    }
    
    $posts_html = ob_get_clean();
    
    $response = array(
        'posts' => $posts_html,
        'max_pages' => $query->max_num_pages,
        'current_page' => $paged,
        'found_posts' => $query->found_posts
    );
    
    wp_send_json_success($response);
}
add_action('wp_ajax_filter_blog', 'ajax_filter_blog');
add_action('wp_ajax_nopriv_filter_blog', 'ajax_filter_blog');

// AJAX handler for popular tags
function ajax_get_popular_tags() {
    check_ajax_referer('blog_filter_nonce', 'nonce');
    
    // Get filter parameters
    $search = sanitize_text_field($_POST['search'] ?? '');
    $category = sanitize_text_field($_POST['category'] ?? '');
    $sort = sanitize_text_field($_POST['sort'] ?? 'newest');
    
    // Build query args to get posts matching current filters
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1, // Get all posts to analyze tags
        'fields' => 'ids' // Only get IDs for performance
    );
    
    // Apply same filters as main query
    if (!empty($search)) {
        $args['s'] = $search;
    }
    
    if (!empty($category) && $category !== 'all') {
        $args['category_name'] = $category;
    }
    
    $query = new WP_Query($args);
    $post_ids = $query->posts;
    
    if (empty($post_ids)) {
        wp_send_json_success(array('tags' => ''));
        return;
    }
    
    // Get tags from filtered posts
    $tags = wp_get_object_terms($post_ids, 'post_tag', array(
        'orderby' => 'count',
        'order' => 'DESC',
        'number' => 10 // Limit to top 10 popular tags
    ));
    
    if (is_wp_error($tags) || empty($tags)) {
        wp_send_json_success(array('tags' => ''));
        return;
    }
    
    // Generate HTML for tags
    ob_start();
    foreach ($tags as $tag) {
        ?>
        <li>
            <a href="#" data-tag="<?php echo esc_attr($tag->slug); ?>"
                class="tag-filter inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                # <?php echo esc_html($tag->name); ?>
            </a>
        </li>
        <?php
    }
    $tags_html = ob_get_clean();
    
    wp_send_json_success(array('tags' => $tags_html));
}
add_action('wp_ajax_get_popular_tags', 'ajax_get_popular_tags');
add_action('wp_ajax_nopriv_get_popular_tags', 'ajax_get_popular_tags');

// Custom Footer Widgets

// Contact Info Widget
class Arash_Footer_Contact_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'arash_footer_contact',
            'اطلاعات تماس فوتر',
            array('description' => 'ویجت اطلاعات تماس برای فوتر')
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        $phone = !empty($instance['phone']) ? $instance['phone'] : '۰۲۱−۱۲۳۴۵۶۷';
        $hours = !empty($instance['hours']) ? $instance['hours'] : '۰۹:۰۰ - ۱۷:۰۰';
        ?>
        <div class="flex flex-wrap items-center gap-10">
            <div class="flex items-center gap-5">
                <span class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 0 1 3.5 2h1.148a1.5 1.5 0 0 1 1.465 1.175l.716 3.223a1.5 1.5 0 0 1-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 0 0 6.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 0 1 1.767-1.052l3.223.716A1.5 1.5 0 0 1 18 15.352V16.5a1.5 1.5 0 0 1-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 0 1 2.43 8.326 13.019 13.019 0 0 1 2 5V3.5Z" clip-rule="evenodd"></path>
                    </svg>
                </span>
                <div class="flex flex-col font-black space-y-2">
                    <span class="text-sm text-primary">شماره تلفن</span>
                    <span class="text-foreground"><?php echo esc_html($phone); ?></span>
                </div>
            </div>
            <div class="flex items-center gap-5">
                <span class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z" clip-rule="evenodd"></path>
                    </svg>
                </span>
                <div class="flex flex-col font-black space-y-2">
                    <span class="text-sm text-primary">ساعات کاری</span>
                    <span class="text-foreground"><?php echo esc_html($hours); ?></span>
                </div>
            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $phone = !empty($instance['phone']) ? $instance['phone'] : '۰۲۱−۱۲۳۴۵۶۷';
        $hours = !empty($instance['hours']) ? $instance['hours'] : '۰۹:۰۰ - ۱۷:۰۰';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('phone'); ?>">شماره تلفن:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($phone); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('hours'); ?>">ساعات کاری:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('hours'); ?>" name="<?php echo $this->get_field_name('hours'); ?>" type="text" value="<?php echo esc_attr($hours); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['phone'] = (!empty($new_instance['phone'])) ? sanitize_text_field($new_instance['phone']) : '';
        $instance['hours'] = (!empty($new_instance['hours'])) ? sanitize_text_field($new_instance['hours']) : '';
        return $instance;
    }
}

// About Widget
class Arash_Footer_About_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'arash_footer_about',
            'درباره ما فوتر',
            array('description' => 'ویجت درباره ما برای فوتر')
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        $title = !empty($instance['title']) ? $instance['title'] : 'دربــــاره';
        $content = !empty($instance['content']) ? $instance['content'] : 'نابغه یکی از پرتلاش‌ترین و بروزترین وبسایت های آموزشی در سطح ایران است که همیشه تلاش کرده تا بتواند جدیدترین و بروزترین مقالات و دوره‌های آموزشی را در اختیار علاقه‌مندان ایرانی قرار دهد. تبدیل کردن برنامه نویسان ایرانی به بهترین برنامه نویسان جهان هدف ماست.';
        ?>
        <div class="bg-secondary rounded-3xl space-y-5 p-8">
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1">
                    <div class="w-1 h-1 bg-foreground rounded-full"></div>
                    <div class="w-2 h-2 bg-foreground rounded-full"></div>
                </div>
                <div class="font-black text-foreground"><?php echo esc_html($title); ?></div>
            </div>
            <p class="font-semibold text-sm text-muted"><?php echo esc_html($content); ?></p>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'دربــــاره';
        $content = !empty($instance['content']) ? $instance['content'] : 'نابغه یکی از پرتلاش‌ترین و بروزترین وبسایت های آموزشی در سطح ایران است که همیشه تلاش کرده تا بتواند جدیدترین و بروزترین مقالات و دوره‌های آموزشی را در اختیار علاقه‌مندان ایرانی قرار دهد. تبدیل کردن برنامه نویسان ایرانی به بهترین برنامه نویسان جهان هدف ماست.';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">عنوان:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('content'); ?>">متن:</label>
            <textarea class="widefat" rows="5" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo esc_textarea($content); ?></textarea>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['content'] = (!empty($new_instance['content'])) ? sanitize_textarea_field($new_instance['content']) : '';
        return $instance;
    }
}

// Links Widget
class Arash_Footer_Links_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'arash_footer_links',
            'لینک های مفید فوتر',
            array('description' => 'ویجت لینک های مفید برای فوتر')
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        $title = !empty($instance['title']) ? $instance['title'] : 'لینک های مفید';
        $links = !empty($instance['links']) ? $instance['links'] : "قوانین و مقررات|#\nمدرسان|#\nدرباره نابغه|#\nارتباط با ما|#";
        ?>
        <div class="space-y-5">
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1">
                    <div class="w-1 h-1 bg-foreground rounded-full"></div>
                    <div class="w-2 h-2 bg-foreground rounded-full"></div>
                </div>
                <div class="font-black text-foreground"><?php echo esc_html($title); ?></div>
            </div>
            <ul class="flex flex-col space-y-1">
                <?php
                $links_array = explode("\n", $links);
                foreach ($links_array as $link) {
                    if (!empty(trim($link))) {
                        $parts = explode('|', $link);
                        $link_text = trim($parts[0]);
                        $link_url = isset($parts[1]) ? trim($parts[1]) : '#';
                        ?>
                        <li>
                            <a href="<?php echo esc_url($link_url); ?>" class="inline-flex font-semibold text-sm text-muted hover:text-primary"><?php echo esc_html($link_text); ?></a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'لینک های مفید';
        $links = !empty($instance['links']) ? $instance['links'] : "قوانین و مقررات|#\nمدرسان|#\nدرباره نابغه|#\nارتباط با ما|#";
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">عنوان:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('links'); ?>">لینک ها (هر خط: متن|آدرس):</label>
            <textarea class="widefat" rows="5" id="<?php echo $this->get_field_id('links'); ?>" name="<?php echo $this->get_field_name('links'); ?>"><?php echo esc_textarea($links); ?></textarea>
            <small>مثال: درباره ما|/about</small>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['links'] = (!empty($new_instance['links'])) ? sanitize_textarea_field($new_instance['links']) : '';
        return $instance;
    }
}

// Newsletter Widget
class Arash_Footer_Newsletter_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'arash_footer_newsletter',
            'خبرنامه فوتر',
            array('description' => 'ویجت خبرنامه برای فوتر')
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        $title = !empty($instance['title']) ? $instance['title'] : 'خبرنامه';
        $description = !empty($instance['description']) ? $instance['description'] : 'برای اطلاع از جدیدترین اخبار و جشنوراه‌های تخفیفی نابغه ایمیل خود را وارد کنید.';
        $placeholder = !empty($instance['placeholder']) ? $instance['placeholder'] : 'آدرس ایمیل';
        $button_text = !empty($instance['button_text']) ? $instance['button_text'] : 'ثبت ایمیل';
        ?>
        <div class="space-y-5">
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1">
                    <div class="w-1 h-1 bg-foreground rounded-full"></div>
                    <div class="w-2 h-2 bg-foreground rounded-full"></div>
                </div>
                <div class="font-black text-foreground"><?php echo esc_html($title); ?></div>
            </div>
            <p class="text-sm text-muted"><?php echo esc_html($description); ?></p>
            <form action="#" method="post">
                <div class="flex items-center gap-3 relative">
                    <span class="absolute right-3 text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path d="M3 4a2 2 0 0 0-2 2v1.161l8.441 4.221a1.25 1.25 0 0 0 1.118 0L19 7.162V6a2 2 0 0 0-2-2H3Z"></path>
                            <path d="m19 8.839-7.77 3.885a2.75 2.75 0 0 1-2.46 0L1 8.839V14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8.839Z"></path>
                        </svg>
                    </span>
                    <input type="email" name="newsletter_email" class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-0 focus:border-border rounded-xl text-sm text-foreground pr-10" placeholder="<?php echo esc_attr($placeholder); ?>" required />
                    <button type="submit" class="h-11 inline-flex items-center justify-center gap-3 bg-primary rounded-xl whitespace-nowrap text-xs text-primary-foreground transition-all hover:opacity-80 px-4"><?php echo esc_html($button_text); ?></button>
                </div>
            </form>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'خبرنامه';
        $description = !empty($instance['description']) ? $instance['description'] : 'برای اطلاع از جدیدترین اخبار و جشنوراه‌های تخفیفی نابغه ایمیل خود را وارد کنید.';
        $placeholder = !empty($instance['placeholder']) ? $instance['placeholder'] : 'آدرس ایمیل';
        $button_text = !empty($instance['button_text']) ? $instance['button_text'] : 'ثبت ایمیل';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">عنوان:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('description'); ?>">توضیحات:</label>
            <textarea class="widefat" rows="3" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo esc_textarea($description); ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('placeholder'); ?>">متن placeholder:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('placeholder'); ?>" name="<?php echo $this->get_field_name('placeholder'); ?>" type="text" value="<?php echo esc_attr($placeholder); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('button_text'); ?>">متن دکمه:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo esc_attr($button_text); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['description'] = (!empty($new_instance['description'])) ? sanitize_textarea_field($new_instance['description']) : '';
        $instance['placeholder'] = (!empty($new_instance['placeholder'])) ? sanitize_text_field($new_instance['placeholder']) : '';
        $instance['button_text'] = (!empty($new_instance['button_text'])) ? sanitize_text_field($new_instance['button_text']) : '';
        return $instance;
    }
}

// Social Media Widget
class Arash_Footer_Social_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'arash_footer_social',
            'شبکه های اجتماعی فوتر',
            array('description' => 'ویجت شبکه های اجتماعی برای فوتر')
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        $title = !empty($instance['title']) ? $instance['title'] : 'شبکه های اجتماعی';
        $instagram = !empty($instance['instagram']) ? $instance['instagram'] : '#';
        $telegram = !empty($instance['telegram']) ? $instance['telegram'] : '#';
        $youtube = !empty($instance['youtube']) ? $instance['youtube'] : '#';
        ?>
        <div class="space-y-5">
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1">
                    <div class="w-1 h-1 bg-foreground rounded-full"></div>
                    <div class="w-2 h-2 bg-foreground rounded-full"></div>
                </div>
                <div class="font-black text-foreground"><?php echo esc_html($title); ?></div>
            </div>
            <ul class="flex flex-wrap items-center gap-5">
                <li>
                    <a href="<?php echo esc_url($instagram); ?>" class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-foreground transition-colors hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url($telegram); ?>" class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-foreground transition-colors hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                            <path d="m22 2-7 20-4-9-9-4Z"></path>
                            <path d="M22 2 11 13"></path>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url($youtube); ?>" class="flex items-center justify-center w-12 h-12 bg-secondary rounded-full text-foreground transition-colors hover:text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                            <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"></path>
                            <path d="m10 15 5-3-5-3z"></path>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'شبکه های اجتماعی';
        $instagram = !empty($instance['instagram']) ? $instance['instagram'] : '#';
        $telegram = !empty($instance['telegram']) ? $instance['telegram'] : '#';
        $youtube = !empty($instance['youtube']) ? $instance['youtube'] : '#';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">عنوان:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('instagram'); ?>">لینک اینستاگرام:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="url" value="<?php echo esc_attr($instagram); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('telegram'); ?>">لینک تلگرام:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('telegram'); ?>" name="<?php echo $this->get_field_name('telegram'); ?>" type="url" value="<?php echo esc_attr($telegram); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('youtube'); ?>">لینک یوتیوب:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="url" value="<?php echo esc_attr($youtube); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['instagram'] = (!empty($new_instance['instagram'])) ? esc_url_raw($new_instance['instagram']) : '';
        $instance['telegram'] = (!empty($new_instance['telegram'])) ? esc_url_raw($new_instance['telegram']) : '';
        $instance['youtube'] = (!empty($new_instance['youtube'])) ? esc_url_raw($new_instance['youtube']) : '';
        return $instance;
    }
}

// Register widgets
function arash_register_footer_widgets() {
    register_widget('Arash_Footer_Contact_Widget');
    register_widget('Arash_Footer_About_Widget');
    register_widget('Arash_Footer_Links_Widget');
    register_widget('Arash_Footer_Newsletter_Widget');
    register_widget('Arash_Footer_Social_Widget');
}
add_action('widgets_init', 'arash_register_footer_widgets');

// Enqueue blog filter script
function enqueue_blog_filter_script() {
    if (is_home() || is_front_page()) {
        wp_enqueue_script(
            'blog-filter',
            get_template_directory_uri() . '/assets/js/filter-blog.js',
            array(),
            '1.0.0',
            true
        );
        
        wp_localize_script('blog-filter', 'blogAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('blog_filter_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_blog_filter_script');

?>