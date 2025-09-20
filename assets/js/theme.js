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
});