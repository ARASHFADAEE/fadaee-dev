<?php 

// add feacher suport theme
function theme_support(){
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('woocommerce');
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

?>