document.addEventListener('DOMContentLoaded', function() {
    // Portfolio AJAX functionality
    let currentPage = 1;
    let isLoading = false;
    let currentCategory = 'all';
    let currentSearch = '';
    let currentSort = 'date_desc';

    // Elements
    const portfolioContainer = document.getElementById('portfolio-container');
    const loadMoreBtn = document.getElementById('load-more-portfolio');
    const searchInput = document.getElementById('portfolio-search-input');
    const mobileSearchInput = document.getElementById('mobile-portfolio-search-input');
    const sortInput = document.getElementById('portfolio-sort-input');
    const categoryFilters = document.querySelectorAll('.portfolio-category-filter, .mobile-portfolio-category-filter');

    // Initialize
    if (loadMoreBtn) {
        currentPage = parseInt(loadMoreBtn.dataset.page) || 1;
    }

    // Search functionality
    let searchTimeout;
    function handleSearch(searchValue) {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            currentSearch = searchValue;
            currentPage = 1;
            filterPortfolio(false);
        }, 500);
    }

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            handleSearch(this.value);
            // Sync with mobile search
            if (mobileSearchInput) {
                mobileSearchInput.value = this.value;
            }
        });
    }

    if (mobileSearchInput) {
        mobileSearchInput.addEventListener('input', function() {
            handleSearch(this.value);
            // Sync with desktop search
            if (searchInput) {
                searchInput.value = this.value;
            }
        });
    }

    // Category filter functionality
    categoryFilters.forEach(filter => {
        filter.addEventListener('change', function() {
            if (this.checked) {
                currentCategory = this.value;
                currentPage = 1;
                
                // Sync all category filters
                categoryFilters.forEach(f => {
                    if (f !== this && f.value === this.value) {
                        f.checked = true;
                    } else if (f !== this) {
                        f.checked = false;
                    }
                });
                
                filterPortfolio(false);
            }
        });
    });

    // Sort functionality
    if (sortInput) {
        // Watch for changes in the sort input (Alpine.js will update this)
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'value') {
                    const newSort = sortInput.value;
                    if (newSort !== currentSort) {
                        currentSort = newSort;
                        currentPage = 1;
                        filterPortfolio(false);
                    }
                }
            });
        });
        
        observer.observe(sortInput, {
            attributes: true,
            attributeFilter: ['value']
        });

        // Also listen for input events
        sortInput.addEventListener('input', function() {
            const newSort = this.value;
            if (newSort !== currentSort) {
                currentSort = newSort;
                currentPage = 1;
                filterPortfolio(false);
            }
        });
    }

    // Load more functionality
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            if (!isLoading) {
                currentPage++;
                filterPortfolio(true);
            }
        });
    }

    // Main filter function
    function filterPortfolio(loadMore = false) {
        if (isLoading) return;

        isLoading = true;
        
        // Show loading state
        if (loadMore && loadMoreBtn) {
            const originalText = loadMoreBtn.querySelector('span').textContent;
            loadMoreBtn.querySelector('span').textContent = 'در حال بارگزاری...';
            loadMoreBtn.disabled = true;
        } else {
            showLoadingState();
        }

        // Prepare data
        const formData = new FormData();
        formData.append('action', 'filter_portfolio');
        formData.append('category', currentCategory);
        formData.append('search', currentSearch);
        formData.append('sort', currentSort);
        formData.append('page', currentPage);
        formData.append('load_more', loadMore ? '1' : '0');
        formData.append('nonce', portfolio_ajax.nonce);

        // Make AJAX request
        fetch(portfolio_ajax.ajax_url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (loadMore) {
                    // Append new posts
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = data.data.html;
                    
                    while (tempDiv.firstChild) {
                        portfolioContainer.appendChild(tempDiv.firstChild);
                    }
                } else {
                    // Replace all posts
                    portfolioContainer.innerHTML = data.data.html;
                }

                // Update load more button
                updateLoadMoreButton(data.data.has_more, data.data.max_pages);
                
                // Update URL without page reload
                updateURL();
                
            } else {
                console.error('Portfolio filter error:', data.data);
                showErrorState();
            }
        })
        .catch(error => {
            console.error('Portfolio AJAX error:', error);
            showErrorState();
        })
        .finally(() => {
            isLoading = false;
            hideLoadingState();
            
            if (loadMore && loadMoreBtn) {
                loadMoreBtn.querySelector('span').textContent = 'بارگزاری بیشتر';
                loadMoreBtn.disabled = false;
            }
        });
    }

    // Update load more button state
    function updateLoadMoreButton(hasMore, maxPages) {
        if (!loadMoreBtn) return;

        if (hasMore && currentPage < maxPages) {
            loadMoreBtn.style.display = 'inline-flex';
            loadMoreBtn.dataset.maxPages = maxPages;
        } else {
            loadMoreBtn.style.display = 'none';
        }
    }

    // Show loading state
    function showLoadingState() {
        if (!portfolioContainer) return;
        
        const loadingHTML = `
            <div class="col-span-full flex items-center justify-center py-12">
                <div class="text-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary mx-auto mb-4"></div>
                    <p class="text-muted">در حال بارگزاری...</p>
                </div>
            </div>
        `;
        portfolioContainer.innerHTML = loadingHTML;
    }

    // Hide loading state
    function hideLoadingState() {
        // Loading state is replaced by actual content
    }

    // Show error state
    function showErrorState() {
        if (!portfolioContainer) return;
        
        const errorHTML = `
            <div class="col-span-full text-center py-12">
                <div class="text-muted mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-foreground mb-2">خطا در بارگزاری</h3>
                <p class="text-muted mb-4">متأسفانه مشکلی در بارگزاری نمونه‌کارها پیش آمد.</p>
                <button onclick="location.reload()" class="bg-primary text-white px-6 py-2 rounded-xl font-semibold hover:bg-primary/90 transition-colors">
                    تلاش مجدد
                </button>
            </div>
        `;
        portfolioContainer.innerHTML = errorHTML;
    }

    // Update URL for better UX and SEO
    function updateURL() {
        const url = new URL(window.location);
        
        // Update search params
        if (currentSearch) {
            url.searchParams.set('search', currentSearch);
        } else {
            url.searchParams.delete('search');
        }
        
        if (currentCategory && currentCategory !== 'all') {
            url.searchParams.set('category', currentCategory);
        } else {
            url.searchParams.delete('category');
        }
        
        if (currentSort && currentSort !== 'date_desc') {
            url.searchParams.set('sort', currentSort);
        } else {
            url.searchParams.delete('sort');
        }
        
        // Remove page param for filters (not load more)
        url.searchParams.delete('paged');
        
        // Update URL without page reload
        window.history.replaceState({}, '', url);
    }

    // Initialize from URL parameters
    function initFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        
        // Set search
        const searchParam = urlParams.get('search');
        if (searchParam) {
            currentSearch = searchParam;
            if (searchInput) searchInput.value = searchParam;
            if (mobileSearchInput) mobileSearchInput.value = searchParam;
        }
        
        // Set category
        const categoryParam = urlParams.get('category');
        if (categoryParam) {
            currentCategory = categoryParam;
            categoryFilters.forEach(filter => {
                filter.checked = filter.value === categoryParam;
            });
        }
        
        // Set sort
        const sortParam = urlParams.get('sort');
        if (sortParam) {
            currentSort = sortParam;
            if (sortInput) sortInput.value = sortParam;
        }
    }

    // Initialize from URL on page load
    initFromURL();

    // Handle browser back/forward buttons
    window.addEventListener('popstate', function() {
        initFromURL();
        currentPage = 1;
        filterPortfolio(false);
    });
});