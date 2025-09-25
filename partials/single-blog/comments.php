<?php
// Get current post ID
$post_id = get_the_ID();

// Get comments for this post
$comments = get_comments(array(
    'post_id' => $post_id,
    'status' => 'approve',
    'parent' => 0, // Only top-level comments
    'order' => 'DESC'
));

// Get current user info
$current_user = wp_get_current_user();
$user_avatar = get_avatar_url($current_user->ID);
$user_name = $current_user->display_name;

// Function to get comment likes count
function get_comment_likes($comment_id) {
    return get_comment_meta($comment_id, 'likes_count', true) ?: 0;
}

// Function to check if user liked a comment
function user_liked_comment($comment_id, $user_id) {
    $liked_users = get_comment_meta($comment_id, 'liked_users', true);
    return is_array($liked_users) && in_array($user_id, $liked_users);
}

// Function to get Persian time ago
function persian_time_ago($datetime) {
    $time = time() - strtotime($datetime);
    
    if ($time < 60) return 'همین الان';
    if ($time < 3600) return floor($time/60) . ' دقیقه پیش';
    if ($time < 86400) return floor($time/3600) . ' ساعت پیش';
    if ($time < 2592000) return floor($time/86400) . ' روز پیش';
    if ($time < 31536000) return floor($time/2592000) . ' ماه پیش';
    return floor($time/31536000) . ' سال پیش';
}
?>

<div class="space-y-5">
    <!-- article:comments:title -->
    <div class="flex items-center gap-3 mb-5">
        <div class="flex items-center gap-1">
            <div class="w-1 h-1 bg-foreground rounded-full"></div>
            <div class="w-2 h-2 bg-foreground rounded-full"></div>
        </div>
        <div class="font-black text-foreground">دیدگاه و پرسش</div>
    </div>
    <!-- end article:comments:container -->

    <!-- article:comments:form:wrapper -->
    <div class="bg-background border border-border rounded-3xl p-5 mb-5">
        <div class="flex items-center gap-3 mb-5">
            <div class="flex items-center gap-1">
                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                <div class="w-2 h-2 bg-foreground rounded-full"></div>
            </div>
            <div class="font-black text-xs text-foreground">
                ارسال دیدگاه یا پرسش
            </div>
        </div>
        
        <!-- Reply info section (hidden by default) -->
        <div id="reply-info" class="flex flex-wrap items-center gap-3 mb-5" style="display: none;">
            <?php if (is_user_logged_in()): ?>
                <?php 
                $current_user_avatar = get_avatar_url($current_user->ID);
                $current_user_name = $current_user->display_name;
                ?>
                <div class="flex items-center gap-3 sm:w-auto w-full">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                        <img src="<?php echo $current_user_avatar; ?>" class="w-full h-full object-cover" alt="..." />
                    </div>
                    <div class="flex flex-col items-start space-y-1">
                        <span class="line-clamp-1 font-semibold text-sm text-foreground"><?php echo $current_user_name; ?></span>
                        <span class="text-xs text-muted">همین الان</span>
                    </div>
                </div>
                <span class="block w-1 h-1 bg-border rounded-full"></span>
                <span class="font-semibold text-xs text-muted">در پاسخ به</span>
                <span class="block w-1 h-1 bg-border rounded-full"></span>
                <span id="reply-to-name" class="line-clamp-1 font-semibold text-sm text-foreground"></span>
                <button type="button" id="cancel-reply" class="line-clamp-1 font-semibold text-sm text-red-500 mr-auto">لغو پاسخ</button>
            <?php endif; ?>
        </div>

        <?php if (is_user_logged_in()): ?>
            <form id="comment-form" class="flex flex-col space-y-5">
                <input type="hidden" id="post-id" name="post_id" value="<?php echo $post_id; ?>">
                <input type="hidden" id="parent-comment-id" name="parent_id" value="0">
                <textarea name="comment_content" id="comment-content" rows="10"
                    class="form-textarea w-full !ring-0 !ring-offset-0 bg-secondary border-0 focus:border-border border-border rounded-xl text-sm text-foreground p-5"
                    placeholder="متن مورد نظر خود را وارد کنید ..." required></textarea>
                <button type="submit"
                    class="h-10 inline-flex items-center justify-center gap-1 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4 mr-auto">
                    <span class="font-semibold text-sm">ثبت دیدگاه یا پرسش</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                            d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </form>
        <?php else: ?>
            <div class="text-center py-8">
                <p class="text-muted mb-4">برای ارسال دیدگاه باید وارد حساب کاربری خود شوید.</p>
                <a href="<?php echo get_home_url()?>/my-account" 
                   class="h-10 inline-flex items-center justify-center gap-1 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-6">
                    <span class="font-semibold text-sm">ورود به حساب کاربری</span>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <!-- end article:comments:form:wrapper -->

    <!-- article:comments:wrapper -->
    <div id="comments-container" class="space-y-3">
        <?php if ($comments): ?>
            <?php foreach ($comments as $comment): ?>
                <?php
                $comment_author = get_comment_author($comment->comment_ID);
                $comment_avatar = get_avatar_url($comment->user_id ?: $comment->comment_author_email);
                $comment_date = persian_time_ago($comment->comment_date);
                $comment_content = get_comment_text($comment->comment_ID);
                $likes_count = get_comment_likes($comment->comment_ID);
                $user_liked = user_liked_comment($comment->comment_ID, $current_user->ID);
                
                // Get replies for this comment
                $replies = get_comments(array(
                    'post_id' => $post_id,
                    'status' => 'approve',
                    'parent' => $comment->comment_ID,
                    'order' => 'ASC'
                ));
                ?>
                
                <!-- article:comment -->
                <div class="space-y-3" data-comment-id="<?php echo $comment->comment_ID; ?>">
                    <div class="bg-background border border-border rounded-3xl space-y-3 p-5">
                        <div class="flex sm:flex-nowrap flex-wrap sm:flex-row flex-col sm:items-center sm:justify-between gap-5 border-b border-border pb-3">
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                                    <img src="<?php echo $comment_avatar; ?>" class="w-full h-full object-cover" alt="..." />
                                </div>
                                <div class="flex flex-col items-start space-y-1">
                                    <span class="line-clamp-1 font-semibold text-sm text-foreground"><?php echo $comment_author; ?></span>
                                    <span class="text-xs text-muted"><?php echo $comment_date; ?></span>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 sm:mr-0 mr-auto">
                                <button type="button" class="reply-btn flex items-center h-9 gap-1 bg-secondary rounded-full text-muted transition-colors hover:text-primary px-4"
                                    data-comment-id="<?php echo $comment->comment_ID; ?>" data-author-name="<?php echo $comment_author; ?>">
                                    <span class="text-xs">پاسخ</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M12.207 2.232a.75.75 0 0 0 .025 1.06l4.146 3.958H6.375a5.375 5.375 0 0 0 0 10.75H9.25a.75.75 0 0 0 0-1.5H6.375a3.875 3.875 0 0 1 0-7.75h10.003l-4.146 3.957a.75.75 0 0 0 1.036 1.085l5.5-5.25a.75.75 0 0 0 0-1.085l-5.5-5.25a.75.75 0 0 0-1.06.025Z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <button type="button" class="like-btn flex items-center justify-center relative w-9 h-9 bg-secondary rounded-full text-muted transition-colors hover:text-red-500 <?php echo $user_liked ? 'text-red-500' : ''; ?>"
                                    data-comment-id="<?php echo $comment->comment_ID; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z"></path>
                                    </svg>
                                    <?php if ($likes_count > 0): ?>
                                        <span class="like-count absolute -top-1 -right-1 inline-flex bg-red-500 rounded-full text-xs text-white px-1">
                                            <?php echo $likes_count; ?>
                                        </span>
                                    <?php endif; ?>
                                </button>
                            </div>
                        </div>
                        <p class="text-sm text-muted"><?php echo $comment_content; ?></p>
                    </div>

                    <?php if ($replies): ?>
                        <!-- article:comment replies -->
                        <div class="relative before:content-[''] before:absolute before:-top-3 before:right-8 before:w-px before:h-[calc(100%-24px)] before:bg-border after:content-[''] after:absolute after:bottom-9 after:right-8 after:w-8 after:h-px after:bg-border space-y-3 pr-16">
                            <?php foreach ($replies as $reply): ?>
                                <?php
                                $reply_author = get_comment_author($reply->comment_ID);
                                $reply_avatar = get_avatar_url($reply->user_id ?: $reply->comment_author_email);
                                $reply_date = persian_time_ago($reply->comment_date);
                                $reply_content = get_comment_text($reply->comment_ID);
                                $reply_likes_count = get_comment_likes($reply->comment_ID);
                                $user_liked_reply = user_liked_comment($reply->comment_ID, $current_user->ID);
                                ?>
                                
                                <!-- article:comment reply -->
                                <div class="bg-background border border-border rounded-3xl space-y-3 p-5" data-comment-id="<?php echo $reply->comment_ID; ?>">
                                    <div class="flex sm:flex-nowrap flex-wrap sm:flex-row flex-col sm:items-center sm:justify-between gap-5 border-b border-border pb-3">
                                        <div class="flex items-center gap-3">
                                            <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                                                <img src="<?php echo $reply_avatar; ?>" class="w-full h-full object-cover" alt="..." />
                                            </div>
                                            <div class="flex flex-col items-start space-y-1">
                                                <span class="line-clamp-1 font-semibold text-sm text-foreground"><?php echo $reply_author; ?></span>
                                                <span class="text-xs text-muted"><?php echo $reply_date; ?></span>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-3 sm:mr-0 mr-auto">
                                            <button type="button" class="reply-btn flex items-center h-9 gap-1 bg-secondary rounded-full text-muted transition-colors hover:text-primary px-4"
                                                data-comment-id="<?php echo $comment->comment_ID; ?>" data-author-name="<?php echo $reply_author; ?>">
                                                <span class="text-xs">پاسخ</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd" d="M12.207 2.232a.75.75 0 0 0 .025 1.06l4.146 3.958H6.375a5.375 5.375 0 0 0 0 10.75H9.25a.75.75 0 0 0 0-1.5H6.375a3.875 3.875 0 0 1 0-7.75h10.003l-4.146 3.957a.75.75 0 0 0 1.036 1.085l5.5-5.25a.75.75 0 0 0 0-1.085l-5.5-5.25a.75.75 0 0 0-1.06.025Z" clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                            <button type="button" class="like-btn flex items-center justify-center relative w-9 h-9 bg-secondary rounded-full text-muted transition-colors hover:text-red-500 <?php echo $user_liked_reply ? 'text-red-500' : ''; ?>"
                                                data-comment-id="<?php echo $reply->comment_ID; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                    <path d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z"></path>
                                                </svg>
                                                <?php if ($reply_likes_count > 0): ?>
                                                    <span class="like-count absolute -top-1 -right-1 inline-flex bg-red-500 rounded-full text-xs text-white px-1">
                                                        <?php echo $reply_likes_count; ?>
                                                    </span>
                                                <?php endif; ?>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="text-sm text-muted"><?php echo $reply_content; ?></p>
                                </div>
                                <!-- end article:comment reply -->
                            <?php endforeach; ?>
                        </div>
                        <!-- end article:comment replies -->
                    <?php endif; ?>
                </div>
                <!-- end article:comment -->
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center py-10">
                <p class="text-muted">هنوز دیدگاهی ثبت نشده است. اولین نفر باشید!</p>
            </div>
        <?php endif; ?>
    </div>
    <!-- end article:comments:wrapper -->
</div>