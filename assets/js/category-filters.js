document.addEventListener('DOMContentLoaded', function() {
    // Get elements
    const searchInput = document.getElementById('blog-search-input');
    const mobileSearchInputs = document.querySelectorAll('.blog-search-input');
    const sortInput = document.getElementById('blog-sort-input');
    const categoryFilters = document.querySelectorAll('.blog-category-filter');
    const postsContainer = document.getElementById('blog-posts-container');
    
    let currentPage = 1;
    let isLoading = false;
    
    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // Get current URL parameters
    function getUrlParams() {
        const urlParams = new URLSearchParams(window.location.search);
        return {
            search: urlParams.get('s') || '',
            sort: urlParams.get('sort') || 'date_desc',
            category: urlParams.get('category') || 'all',
            page: urlParams.get('paged') || 1
        };
    }
    
    // Update URL without page reload
    function updateUrl(params) {
        const url = new URL(window.location);
        
        // Remove old parameters
        url.searchParams.delete('s');
        url.searchParams.delete('sort');
        url.searchParams.delete('category');
        url.searchParams.delete('paged');
        
        // Add new parameters
        if (params.search) url.searchParams.set('s', params.search);
        if (params.sort && params.sort !== 'date_desc') url.searchParams.set('sort', params.sort);
        if (params.category && params.category !== 'all') url.searchParams.set('category', params.category);
        if (params.page && params.page > 1) url.searchParams.set('paged', params.page);
        
        window.history.pushState({}, '', url);
    }
    
    // Load posts via AJAX
    function loadPosts(params, append = false) {
        if (isLoading) return;
        isLoading = true;
        
        // Show loading state
        if (!append) {
            postsContainer.innerHTML = '<div class="col-span-full text-center py-8"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary mx-auto"></div></div>';
        }
        
        // Prepare AJAX data
        const ajaxData = {
            action: 'filter_posts',
            search: params.search || '',
            sort: params.sort || 'date_desc',
            category: params.category || 'all',
            page: params.page || 1,
            nonce: blog_ajax.nonce
        };
        
        // Make AJAX request
        fetch(blog_ajax.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(ajaxData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (append) {
                    postsContainer.insertAdjacentHTML('beforeend', data.data.html);
                } else {
                    postsContainer.innerHTML = data.data.html;
                }
                
                // Update pagination if needed
                const paginationContainer = document.querySelector('.pagination-container');
                if (paginationContainer && data.data.pagination) {
                    paginationContainer.innerHTML = data.data.pagination;
                }
            } else {
                postsContainer.innerHTML = '<div class="col-span-full text-center py-8"><p class="text-muted">خطا در بارگذاری مقالات.</p></div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            postsContainer.innerHTML = '<div class="col-span-full text-center py-8"><p class="text-muted">خطا در بارگذاری مقالات.</p></div>';
        })
        .finally(() => {
            isLoading = false;
        });
    }
    
    // Handle search input
    const debouncedSearch = debounce((searchTerm) => {
        const params = getUrlParams();
        params.search = searchTerm;
        params.page = 1;
        
        updateUrl(params);
        loadPosts(params);
    }, 500);
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            debouncedSearch(this.value);
        });
    }
    
    // Handle mobile search inputs
    mobileSearchInputs.forEach(input => {
        input.addEventListener('input', function() {
            debouncedSearch(this.value);
        });
    });
    
    // Handle sort change
    if (sortInput) {
        // Watch for changes in Alpine.js data
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'value') {
                    const params = getUrlParams();
                    params.sort = sortInput.value;
                    params.page = 1;
                    
                    updateUrl(params);
                    loadPosts(params);
                }
            });
        });
        
        observer.observe(sortInput, {
            attributes: true,
            attributeFilter: ['value']
        });
    }
    
    // Handle category filter
    categoryFilters.forEach(filter => {
        filter.addEventListener('change', function() {
            if (this.checked) {
                const params = getUrlParams();
                params.category = this.value;
                params.page = 1;
                
                updateUrl(params);
                loadPosts(params);
            }
        });
    });
    
    // Initialize filters based on URL parameters
    function initializeFilters() {
        const params = getUrlParams();
        
        // Set search input values
        if (searchInput && params.search) {
            searchInput.value = params.search;
        }
        
        mobileSearchInputs.forEach(input => {
            if (params.search) {
                input.value = params.search;
            }
        });
        
        // Set category filter
        categoryFilters.forEach(filter => {
            if (filter.value === params.category) {
                filter.checked = true;
            }
        });
    }
    
    // Initialize on page load
    initializeFilters();
});