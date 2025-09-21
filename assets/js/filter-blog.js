document.addEventListener('DOMContentLoaded', function() {
    let currentPage = 1;
    let isLoading = false;
    
    // Filter values
    let currentCategory = 'all';
    let currentSearch = '';
    let currentSort = 'newest';
    let currentTag = '';
    let maxPages = 1;
    
    // Get elements
    const searchForm = document.getElementById('blog-search-form');
    const searchInput = document.getElementById('blog-search-input');
    const categoryFilters = document.querySelectorAll('.blog-category-filter');
    const sortInput = document.getElementById('blog-sort-input');
    const postsContainer = document.getElementById('blog-posts-container');
    const loadMoreBtn = document.getElementById('load-more-btn');
    const loadingSpinner = document.getElementById('loading-spinner');
    
    // Filter function
    function filterPosts(loadMore = false) {
        if (isLoading) return;
        
        isLoading = true;
        
        // Show loading state
        if (loadMore) {
            loadingSpinner.classList.remove('hidden');
            loadingSpinner.classList.add('animate-spin');
        }
        
        // Get filter values
        const searchTerm = searchInput.value;
        const selectedCategory = document.querySelector('.blog-category-filter:checked')?.value || '';
        const sortBy = sortInput.value;
        const page = loadMore ? currentPage + 1 : 1;
        
        // Prepare data
        const formData = new FormData();
        formData.append('action', 'filter_blog');
        formData.append('search', searchTerm);
        formData.append('category', selectedCategory);
        formData.append('sort', sortBy);
        formData.append('tag', currentTag);
        formData.append('page', page);
        formData.append('nonce', blogAjax.nonce);
        
        // Make AJAX request
        fetch(blogAjax.ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (loadMore) {
                    // Append new posts
                    postsContainer.insertAdjacentHTML('beforeend', data.data.posts);
                    currentPage = page;
                } else {
                    // Replace all posts
                    postsContainer.innerHTML = data.data.posts;
                    currentPage = 1;
                    
                    // Update popular tags when filters change
                    updatePopularTags();
                }
                
                // Update load more button
                const maxPages = parseInt(data.data.max_pages);
                if (currentPage >= maxPages) {
                    loadMoreBtn.style.display = 'none';
                } else {
                    loadMoreBtn.style.display = 'flex';
                    loadMoreBtn.setAttribute('data-page', currentPage);
                    loadMoreBtn.setAttribute('data-max-pages', maxPages);
                }
            } else {
                console.error('خطا در پاسخ سرور:', data.data);
            }
        })
        .catch(error => {
            console.error('خطا در درخواست AJAX:', error);
        })
        .finally(() => {
            isLoading = false;
            loadingSpinner.classList.add('hidden');
            loadingSpinner.classList.remove('animate-spin');
        });
    }
    
    // Search form submit
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            filterPosts();
        });
    }
    
    // Search input change (with debounce)
    let searchTimeout;
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                filterPosts();
            }, 500);
        });
    }
    
    // Category filter change
    categoryFilters.forEach(filter => {
        filter.addEventListener('change', function() {
            filterPosts();
        });
    });

    // Tag filter event listeners
    const tagFilters = document.querySelectorAll('.tag-filter');
    tagFilters.forEach(filter => {
        filter.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all tag filters
            tagFilters.forEach(f => f.classList.remove('active'));
            
            // Add active class to clicked filter
            this.classList.add('active');
            
            // Update current tag
            currentTag = this.dataset.tag || '';
            currentPage = 1;
            
            // Apply filters
            filterPosts();
        });
    });
    
    // Sort change
    if (sortInput) {
        // Listen for Alpine.js changes
        const sortContainer = sortInput.closest('[x-data]');
        if (sortContainer) {
            sortContainer.addEventListener('change', function() {
                setTimeout(() => {
                    filterPosts();
                }, 100);
            });
        }
    }
    
    // Load more button
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            filterPosts(true);
        });
    }

    // Function to update popular tags
    function updatePopularTags() {
        const formData = new FormData();
        formData.append('action', 'ajax_get_popular_tags');
        formData.append('nonce', blogAjax.nonce);
        formData.append('filter', currentCategory !== 'all' ? currentCategory : '');

        fetch(blogAjax.ajaxurl, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(html => {
            const popularTagsList = document.getElementById('popular-tags');
            if (popularTagsList) {
                popularTagsList.innerHTML = html;
                
                // Re-attach event listeners to new tag elements
                const newTagFilters = popularTagsList.querySelectorAll('.tag-filter');
                newTagFilters.forEach(filter => {
                    filter.addEventListener('click', function(e) {
                        e.preventDefault();
                        
                        // Remove active class from all tag filters
                        document.querySelectorAll('.tag-filter').forEach(f => f.classList.remove('active'));
                        
                        // Add active class to clicked filter
                        this.classList.add('active');
                        
                        // Update current tag
                        currentTag = this.dataset.tag || '';
                        currentPage = 1;
                        
                        // Apply filters
                        filterPosts();
                    });
                });
            }
        })
        .catch(error => {
            console.error('خطا در بارگذاری تگ‌های محبوب:', error);
        });
    }

    // Initialize
    updatePopularTags();
});