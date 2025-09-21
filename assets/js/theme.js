jQuery(document).ready(function ($) {
    // Ajax Search functionality for Desktop
    $("#ajax-search-form").on('input', function(){
        var searchQuery = $(this).val().trim();
        
        // جلوگیری از ارسال درخواست برای جستجوهای خالی یا کوتاه
        if (searchQuery.length < 2) {
            $('#search-results').html('');
            return;
        }
        
        console.log('Search Query:', searchQuery);
        
        $.ajax({
            url: themeData.ajaxurl,
            type: 'POST',
            data: {
                action: 'mobile_ajax_search',
                search_query: searchQuery,
                nonce: themeData.nonce
            },
            beforeSend: function() {
                $('#search-results').html('<div class="p-6 text-center bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg"><div class="animate-spin inline-block w-6 h-6 border-2 border-blue-600 border-t-transparent rounded-full mb-2"></div><p class="text-sm text-gray-600 dark:text-gray-300">در حال جستجو...</p></div>');
            },
            success: function (response) {
                $('#search-results').html(response);
            },
            error: function (xhr, status, error) {
                console.error('Ajax Error:', error);
                $('#search-results').html('<div class="p-6 text-center bg-white dark:bg-gray-800 border border-red-200 dark:border-red-700 rounded-lg shadow-lg"><svg class="mx-auto h-12 w-12 text-red-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" /></svg><p class="text-sm text-red-600 dark:text-red-400">خطا در جستجو. لطفاً دوباره تلاش کنید.</p></div>');
            }
        });
    });

    // Ajax Search functionality for Mobile
    $("#mobile-ajax-search-form").on('input', function(){
        var searchQuery = $(this).val().trim();
        
        // جلوگیری از ارسال درخواست برای جستجوهای خالی یا کوتاه
        if (searchQuery.length < 2) {
            $('#mobile-search-results').html('');
            return;
        }
        
        console.log('Mobile Search Query:', searchQuery);
        
        $.ajax({
            url: themeData.ajaxurl,
            type: 'POST',
            data: {
                action: 'ajax_search',
                search_query: searchQuery,
                nonce: themeData.nonce
            },
            beforeSend: function() {
                $('#mobile-search-results').html('<div class="p-4 text-center bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg"><div class="animate-spin inline-block w-5 h-5 border-2 border-blue-600 border-t-transparent rounded-full mb-2"></div><p class="text-xs text-gray-600 dark:text-gray-300">در حال جستجو...</p></div>');
            },
            success: function (response) {
                $('#mobile-search-results').html(response);
            },
            error: function (xhr, status, error) {
                console.error('Mobile Ajax Error:', error);
                $('#mobile-search-results').html('<div class="p-4 text-center bg-white dark:bg-gray-800 border border-red-200 dark:border-red-700 rounded-lg shadow-lg"><svg class="mx-auto h-8 w-8 text-red-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" /></svg><p class="text-xs text-red-600 dark:text-red-400">خطا در جستجو. لطفاً دوباره تلاش کنید.</p></div>');
            }
        });
    });

    // Comments AJAX functionality
    
    // Comment form submission
    $(document).on('submit', '#comment-form', function(e) {
        e.preventDefault();
        
        // Check if user is logged in
        if (!themeData.isUserLoggedIn) {
            showMessage('برای ثبت نظر ابتدا وارد حساب کاربری خود شوید.', 'error');
            return;
        }
        
        var form = $(this);
        var submitBtn = form.find('button[type="submit"]');
        var submitBtnText = submitBtn.find('span');
        var textarea = form.find('textarea[name="comment_content"]');
        var commentContent = textarea.val().trim();
        var postId = form.find('input[name="post_id"]').val();
        var parentId = form.find('input[name="parent_id"]').val() || 0;
        
        // Validation
        if (commentContent === '') {
            showMessage('لطفاً متن کامنت را وارد کنید.', 'error');
            textarea.focus();
            return;
        }
        
        if (commentContent.length < 3) {
            showMessage('متن کامنت باید حداقل ۳ کاراکتر باشد.', 'error');
            textarea.focus();
            return;
        }
        
        if (!postId || postId === '0') {
            showMessage('خطا در شناسایی پست. لطفاً صفحه را رفرش کنید.', 'error');
            return;
        }
        
        // Disable submit button and show loading
        submitBtn.prop('disabled', true);
        submitBtnText.text('در حال ارسال...');
        
        $.ajax({
            url: themeData.ajaxurl,
            type: 'POST',
            data: {
                action: 'submit_comment',
                post_id: postId,
                parent_id: parentId,
                comment_content: commentContent,
                nonce: themeData.nonce
            },
            success: function(response) {
                if (response.success) {
                    // Clear the form
                    textarea.val('');
                    form.find('input[name="parent_id"]').val('0');
                    
                    // Hide reply info if it was a reply
                    $('.reply-info').addClass('hidden');
                    
                    // Add the new comment to the appropriate location
                    if (response.data.parent_id == 0) {
                        // Top-level comment - add to comments container
                        $('#comments-container').prepend(response.data.html);
                    } else {
                        // Reply comment - add to parent's replies
                        var parentComment = $('[data-comment-id="' + response.data.parent_id + '"]').first();
                        var repliesContainer = parentComment.find('.replies-container').first();
                        if (repliesContainer.length === 0) {
                            // Create replies container if it doesn't exist
                            repliesContainer = $('<div class="replies-container space-y-3 mr-8"></div>');
                            parentComment.append(repliesContainer);
                        }
                        repliesContainer.append(response.data.html);
                    }
                    
                    // Show success message
                    showMessage('کامنت شما با موفقیت ارسال شد.', 'success');
                    
                    // Update comments count if exists
                    var commentsCount = $('.comments-count');
                    if (commentsCount.length) {
                        var currentCount = parseInt(commentsCount.text()) || 0;
                        commentsCount.text(currentCount + 1);
                    }
                } else {
                    var errorMessage = response.data || 'خطا در ارسال کامنت. لطفاً دوباره تلاش کنید.';
                    showMessage(errorMessage, 'error');
                    console.error('Comment submission error:', response);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', {xhr: xhr, status: status, error: error});
                
                var errorMessage = 'خطا در ارسال کامنت. ';
                if (xhr.status === 0) {
                    errorMessage += 'لطفاً اتصال اینترنت خود را بررسی کنید.';
                } else if (xhr.status === 403) {
                    errorMessage += 'دسترسی مجاز نیست. لطفاً دوباره وارد شوید.';
                } else if (xhr.status === 500) {
                    errorMessage += 'خطای سرور. لطفاً بعداً تلاش کنید.';
                } else {
                    errorMessage += 'لطفاً دوباره تلاش کنید.';
                }
                
                showMessage(errorMessage, 'error');
            },
            complete: function() {
                // Re-enable submit button
                submitBtn.prop('disabled', false);
                submitBtnText.text('ثبت دیدگاه یا پرسش');
            }
        });
    });
    
    // Reply button click
    $(document).on('click', '.reply-btn', function() {
        // Check if user is logged in
        if (!themeData.isUserLoggedIn) {
            showMessage('برای پاسخ دادن به نظرات ابتدا وارد حساب کاربری خود شوید.', 'error');
            return;
        }
        
        var commentId = $(this).data('comment-id');
        var authorName = $(this).data('author-name');
        
        // Update form for reply
        $('#comment-form input[name="parent_id"]').val(commentId);
        
        // Show reply info
        var replyInfo = $('.reply-info');
        replyInfo.removeClass('hidden');
        replyInfo.find('.reply-author').text(authorName);
        
        // Focus on textarea
        $('#comment-form textarea[name="comment_content"]').focus();
        
        // Scroll to form
        $('html, body').animate({
            scrollTop: $('#comment-form').offset().top - 100
        }, 500);
    });
    
    // Cancel reply button
    $(document).on('click', '.cancel-reply', function() {
        $('#comment-form input[name="parent_id"]').val('0');
        $('.reply-info').addClass('hidden');
    });
    
    // Like button click
    $(document).on('click', '.like-btn', function() {
        // Check if user is logged in
        if (!themeData.isUserLoggedIn) {
            showMessage('برای لایک کردن نظرات ابتدا وارد حساب کاربری خود شوید.', 'error');
            return;
        }
        
        var btn = $(this);
        var commentId = btn.data('comment-id');
        
        // Prevent multiple clicks
        if (btn.hasClass('processing')) {
            return;
        }
        
        btn.addClass('processing');
        
        $.ajax({
            url: themeData.ajaxurl,
            type: 'POST',
            data: {
                action: 'like_comment',
                comment_id: commentId,
                nonce: themeData.nonce
            },
            success: function(response) {
                if (response.success) {
                    var data = response.data;
                    
                    // Update button appearance
                    var heartIcon = btn.find('svg');
                    var likesCount = btn.find('.likes-count');
                    
                    if (data.user_liked) {
                        btn.addClass('liked');
                        heartIcon.removeClass('text-gray-400').addClass('text-red-500');
                        heartIcon.attr('fill', 'currentColor');
                    } else {
                        btn.removeClass('liked');
                        heartIcon.removeClass('text-red-500').addClass('text-gray-400');
                        heartIcon.attr('fill', 'none');
                    }
                    
                    // Update likes count
                    if (likesCount.length) {
                        likesCount.text(data.likes_count);
                    }
                    
                    // Show feedback
                    if (data.action === 'liked') {
                        showMessage('کامنت لایک شد.', 'success');
                    } else {
                        showMessage('لایک کامنت حذف شد.', 'info');
                    }
                } else {
                    var errorMessage = response.data || 'خطا در لایک کردن. لطفاً دوباره تلاش کنید.';
                    showMessage(errorMessage, 'error');
                    console.error('Like error:', response);
                }
            },
            error: function(xhr, status, error) {
                console.error('Like AJAX Error:', {xhr: xhr, status: status, error: error});
                
                var errorMessage = 'خطا در لایک کردن. ';
                if (xhr.status === 403) {
                    errorMessage += 'لطفاً دوباره وارد شوید.';
                } else {
                    errorMessage += 'لطفاً دوباره تلاش کنید.';
                }
                
                showMessage(errorMessage, 'error');
            },
            complete: function() {
                btn.removeClass('processing');
            }
        });
    });
    
    // Helper function to show messages
    function showMessage(message, type) {
        var alertClass = type === 'success' ? 'bg-green-100 text-green-800 border-green-200' : 
                        type === 'error' ? 'bg-red-100 text-red-800 border-red-200' : 
                        'bg-blue-100 text-blue-800 border-blue-200';
        
        var messageHtml = '<div class="fixed top-4 right-4 z-50 p-4 border rounded-lg shadow-lg ' + alertClass + ' max-w-sm">' +
                         '<div class="flex items-center justify-between">' +
                         '<span class="text-sm font-medium">' + message + '</span>' +
                         '<button type="button" class="mr-2 text-lg font-bold close-message">&times;</button>' +
                         '</div>' +
                         '</div>';
        
        $('body').append(messageHtml);
        
        // Auto remove after 5 seconds
        setTimeout(function() {
            $('.fixed.top-4.right-4').fadeOut(300, function() {
                $(this).remove();
            });
        }, 5000);
    }
    
    // Close message manually
    $(document).on('click', '.close-message', function() {
        $(this).closest('.fixed').fadeOut(300, function() {
            $(this).remove();
        });
    });
});