<?php
/**
 * Dynamic Comment System for WooCommerce Products
 * Handles comment display, reply system, and like functionality
 */

// Get post ID and comments
$post_id = isset($post_id) ? $post_id : get_the_ID();
$comments = get_comments(array(
    'post_id' => $post_id,
    'status' => 'approve',
    'parent' => 0,
    'order' => 'DESC'
));

// Get current user info
$current_user = wp_get_current_user();
$is_user_logged_in = is_user_logged_in();
$user_avatar_url = $is_user_logged_in ? get_avatar_url($current_user->ID, array('size' => 40)) : '';
$user_display_name = $is_user_logged_in ? ($current_user->display_name ?: 'کاربر مهمان') : 'کاربر مهمان';

// Helper functions
function get_comment_likes_count($comment_id) {
    $likes = get_comment_meta($comment_id, 'likes_count', true);
    return $likes ? intval($likes) : 0;
}

function user_has_liked_comment($comment_id, $user_id = null) {
    if (!$user_id) {
        $user_id = get_current_user_id();
    }
    if (!$user_id) return false;
    $liked_users = get_comment_meta($comment_id, 'liked_users', true);
    return is_array($liked_users) && in_array($user_id, $liked_users);
}

function persian_time_ago($time) {
    $time_diff = time() - strtotime($time);
    
    if ($time_diff < 60) {
        return 'همین الان';
    } elseif ($time_diff < 3600) {
        $minutes = floor($time_diff / 60);
        return $minutes . ' دقیقه پیش';
    } elseif ($time_diff < 86400) {
        $hours = floor($time_diff / 3600);
        return $hours . ' ساعت پیش';
    } elseif ($time_diff < 604800) {
        $days = floor($time_diff / 86400);
        return $days . ' روز پیش';
    } elseif ($time_diff < 2419200) {
        $weeks = floor($time_diff / 604800);
        return $weeks . ' هفته پیش';
    } else {
        $months = floor($time_diff / 2419200);
        return $months . ' ماه پیش';
    }
}

function render_comment($comment, $depth = 0) {
    global $is_user_logged_in;
    $comment_id = $comment->comment_ID;
    $author_name = $comment->comment_author;
    $comment_content = $comment->comment_content;
    $comment_date = $comment->comment_date;
    $author_avatar = get_avatar_url($comment->user_id ?: $comment->comment_author_email, array('size' => 40));
    $likes_count = get_comment_likes_count($comment_id);
    $user_liked = user_has_liked_comment($comment_id);
    $time_ago = persian_time_ago($comment_date);
    
    $margin_class = $depth > 0 ? 'pr-16' : '';
    $border_class = $depth > 0 ? 'relative before:content-[\'\'] before:absolute before:-top-3 before:right-8 before:w-px before:h-[calc(100%-24px)] before:bg-border after:content-[\'\'] after:absolute after:bottom-9 after:right-8 after:w-8 after:h-px after:bg-border' : '';
    ?>
    
    <div class="<?php echo $margin_class; ?> <?php echo $border_class; ?> space-y-3">
        <div class="bg-background border border-border rounded-3xl space-y-3 p-5">
            <div class="flex sm:flex-nowrap flex-wrap sm:flex-row flex-col sm:items-center sm:justify-between gap-5 border-b border-border pb-3">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                        <img src="<?php echo esc_url($author_avatar); ?>" class="w-full h-full object-cover" alt="<?php echo esc_attr($author_name); ?>" />
                    </div>
                    <div class="flex flex-col items-start space-y-1">
                        <span class="line-clamp-1 font-semibold text-sm text-foreground"><?php echo esc_html($author_name); ?></span>
                        <span class="text-xs text-muted"><?php echo esc_html($time_ago); ?></span>
                    </div>
                </div>
                <?php if ($is_user_logged_in): ?>
                <div class="flex items-center gap-3 sm:mr-0 mr-auto">
                    <button type="button" class="reply-btn flex items-center h-9 gap-1 bg-secondary rounded-full text-muted transition-colors hover:text-primary px-4" data-comment-id="<?php echo $comment_id; ?>" data-author-name="<?php echo esc_attr($author_name); ?>">
                        <span class="text-xs">پاسخ</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M12.207 2.232a.75.75 0 0 0 .025 1.06l4.146 3.958H6.375a5.375 5.375 0 0 0 0 10.75H9.25a.75.75 0 0 0 0-1.5H6.375a3.875 3.875 0 0 1 0-7.75h10.003l-4.146 3.957a.75.75 0 0 0 1.036 1.085l5.5-5.25a.75.75 0 0 0 0-1.085l-5.5-5.25a.75.75 0 0 0-1.06.025Z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <button type="button" class="like-btn flex items-center justify-center relative w-9 h-9 bg-secondary rounded-full text-muted transition-colors hover:text-red-500 <?php echo $user_liked ? 'text-red-500' : ''; ?>" data-comment-id="<?php echo $comment_id; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z"></path>
                        </svg>
                        <?php if ($likes_count > 0): ?>
                            <span class="absolute -top-1 -right-1 inline-flex bg-red-500 rounded-full text-xs text-white px-1 likes-count"><?php echo $likes_count; ?></span>
                        <?php endif; ?>
                    </button>
                </div>
                <?php else: ?>
                    <?php if ($likes_count > 0): ?>
                    <div class="flex items-center gap-3 sm:mr-0 mr-auto">
                        <div class="flex items-center justify-center relative w-9 h-9 bg-secondary rounded-full text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z"></path>
                            </svg>
                            <span class="absolute -top-1 -right-1 inline-flex bg-red-500 rounded-full text-xs text-white px-1"><?php echo $likes_count; ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <p class="text-sm text-muted"><?php echo wp_kses_post($comment_content); ?></p>
        </div>
        
        <?php
        // Get and render child comments (replies)
        $child_comments = get_comments(array(
            'post_id' => $comment->comment_post_ID,
            'status' => 'approve',
            'parent' => $comment_id,
            'order' => 'ASC'
        ));
        
        if ($child_comments) {
            foreach ($child_comments as $child_comment) {
                render_comment($child_comment, $depth + 1);
            }
        }
        ?>
    </div>
    
    <?php
}
?>

<!-- Comment Form Wrapper -->
<div class="bg-background border border-border rounded-3xl p-5 mb-5" id="comment-form-wrapper">
    <div class="flex items-center gap-3 mb-5">
        <div class="flex items-center gap-1">
            <div class="w-1 h-1 bg-foreground rounded-full"></div>
            <div class="w-2 h-2 bg-foreground rounded-full"></div>
        </div>
        <div class="font-black text-xs text-foreground">ارسال دیدگاه یا پرسش</div>
    </div>
    
    <!-- Reply Info (hidden by default) -->
    <div class="flex flex-wrap items-center gap-3 mb-5 hidden" id="reply-info">
        <div class="flex items-center gap-3 sm:w-auto w-full">
            <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                <img src="<?php echo esc_url($user_avatar_url); ?>" class="w-full h-full object-cover" alt="<?php echo esc_attr($user_display_name); ?>" />
            </div>
            <div class="flex flex-col items-start space-y-1">
                <span class="line-clamp-1 font-semibold text-sm text-foreground"><?php echo esc_html($user_display_name); ?></span>
                <span class="text-xs text-muted">همین الان</span>
            </div>
        </div>
        <span class="block w-1 h-1 bg-border rounded-full"></span>
        <span class="font-semibold text-xs text-muted">در پاسخ به</span>
        <span class="block w-1 h-1 bg-border rounded-full"></span>
        <span class="line-clamp-1 font-semibold text-sm text-foreground" id="reply-to-name"></span>
        <button type="button" class="line-clamp-1 font-semibold text-sm text-red-500 mr-auto" id="cancel-reply">لغو پاسخ</button>
    </div>

    <?php if ($is_user_logged_in): ?>
        <!-- Comment Form -->
        <form id="comment-form" class="flex flex-col space-y-5">
            <?php wp_nonce_field('submit_comment_nonce', 'comment_nonce'); ?>
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <input type="hidden" name="parent_id" value="0" id="parent-comment-id">
            
            <textarea name="comment_content" id="comment-content" rows="10" 
                      class="form-textarea w-full !ring-0 !ring-offset-0 bg-secondary border-0 focus:border-border border-border rounded-xl text-sm text-foreground p-5" 
                      placeholder="متن مورد نظر خود را وارد کنید ..." required></textarea>
            
            <button type="submit" class="h-10 inline-flex items-center justify-center gap-1 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4 mr-auto">
                <span class="font-semibold text-sm">ثبت دیدگاه یا پرسش</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </form>
    <?php else: ?>
        <div class="text-center py-8 space-y-4">
            <div class="w-16 h-16 mx-auto bg-secondary rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-8 h-8 text-muted">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="space-y-2">
                <h4 class="text-lg font-semibold text-foreground">برای ثبت نظر وارد شوید</h4>
                <p class="text-sm text-muted">برای ثبت نظر و پاسخ به دیگران، ابتدا باید وارد حساب کاربری خود شوید.</p>
            </div>
            <div class="flex items-center justify-center gap-3">
                <a href="<?php echo get_home_url()?>/my-account" class="bg-primary text-primary-foreground px-6 py-2 rounded-full text-sm font-medium hover:bg-primary/90 transition-colors">
                    ورود به حساب
                </a>
                <a href="?php echo get_home_url()?>/my-account" class="bg-secondary text-foreground px-6 py-2 rounded-full text-sm font-medium hover:bg-secondary/80 transition-colors">
                    ثبت نام
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Comments Wrapper -->
<div class="space-y-3" id="comments-list">
    <?php if ($comments): ?>
        <?php foreach ($comments as $comment): ?>
            <?php render_comment($comment); ?>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center py-10">
            <p class="text-muted">هنوز دیدگاهی ثبت نشده است. اولین نفر باشید!</p>
        </div>
    <?php endif; ?>
</div>

<script>
// Add AJAX URL for JavaScript
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
var current_user_avatar = '<?php echo esc_url($user_avatar_url); ?>';
var current_user_name = '<?php echo esc_js($user_display_name); ?>';
</script>