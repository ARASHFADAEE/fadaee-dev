/**
 * Shop Dynamic Filtering and Ajax Functionality
 * Handles product filtering, search, sorting, and pagination
 */

class ShopManager {
    constructor() {
        this.isLoading = false;
        this.currentPage = 1;
        this.filters = {
            search: '',
            product_type: '',
            price_type: '',
            sort_by: 'newest',
            is_ongoing: false
        };
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.setupInfiniteScroll();
        this.initializeFilters();
    }

    bindEvents() {
        // Search functionality
        const searchInput = document.querySelector('#product-search');
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.filters.search = e.target.value.trim();
                    this.resetAndFilter();
                }, 500);
            });
        }

        // Product type filter
        const productTypeFilter = document.querySelector('#product-type-filter');
        if (productTypeFilter) {
            productTypeFilter.addEventListener('change', (e) => {
                this.filters.product_type = e.target.value;
                this.resetAndFilter();
            });
        }

        // Price type filter
        const priceTypeFilter = document.querySelector('#price-type-filter');
        if (priceTypeFilter) {
            priceTypeFilter.addEventListener('change', (e) => {
                this.filters.price_type = e.target.value;
                this.resetAndFilter();
            });
        }

        // Sort filter
        const sortFilter = document.querySelector('#sort-filter');
        if (sortFilter) {
            sortFilter.addEventListener('change', (e) => {
                this.filters.sort_by = e.target.value;
                this.resetAndFilter();
            });
        }

        // Ongoing courses toggle
        const ongoingToggle = document.querySelector('#ongoing-toggle');
        if (ongoingToggle) {
            ongoingToggle.addEventListener('change', (e) => {
                this.filters.is_ongoing = e.target.checked;
                this.resetAndFilter();
            });
        }

        // Clear filters button
        const clearFiltersBtn = document.querySelector('#clear-filters');
        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', () => {
                this.clearAllFilters();
            });
        }

        // Load more button
        const loadMoreBtn = document.querySelector('#load-more-products');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', () => {
                this.loadMoreProducts();
            });
        }

        // Filter toggle for mobile
        const filterToggle = document.querySelector('#filter-toggle');
        const filterPanel = document.querySelector('#filter-panel');
        if (filterToggle && filterPanel) {
            filterToggle.addEventListener('click', () => {
                filterPanel.classList.toggle('hidden');
                filterPanel.classList.toggle('block');
            });
        }

        // Mobile search functionality
        const mobileSearchInput = document.querySelector('#product-search-mobile');
        if (mobileSearchInput) {
            let searchTimeout;
            mobileSearchInput.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.filters.search = e.target.value.trim();
                    this.resetAndFilter();
                }, 500);
            });
        }

        // Mobile product type filter
        const mobileProductTypeFilter = document.querySelector('#product-type-filter-mobile');
        if (mobileProductTypeFilter) {
            mobileProductTypeFilter.addEventListener('change', (e) => {
                this.filters.product_type = e.target.value;
                this.resetAndFilter();
            });
        }
    }

    initializeFilters() {
        // Get initial filter values from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        
        this.filters.search = urlParams.get('search') || '';
        this.filters.product_type = urlParams.get('product_type') || '';
        this.filters.price_type = urlParams.get('price_type') || '';
        this.filters.sort_by = urlParams.get('sort_by') || 'newest';
        this.filters.is_ongoing = urlParams.get('is_ongoing') === 'true';

        // Update form elements with URL values
        this.updateFormElements();
    }

    updateFormElements() {
        const searchInput = document.querySelector('#product-search');
        if (searchInput) searchInput.value = this.filters.search;

        const mobileSearchInput = document.querySelector('#product-search-mobile');
        if (mobileSearchInput) mobileSearchInput.value = this.filters.search;

        const productTypeFilter = document.querySelector('#product-type-filter');
        if (productTypeFilter) productTypeFilter.value = this.filters.product_type;

        const mobileProductTypeFilter = document.querySelector('#product-type-filter-mobile');
        if (mobileProductTypeFilter) mobileProductTypeFilter.value = this.filters.product_type;

        const priceTypeFilter = document.querySelector('#price-type-filter');
        if (priceTypeFilter) priceTypeFilter.value = this.filters.price_type;

        const sortFilter = document.querySelector('#sort-filter');
        if (sortFilter) sortFilter.value = this.filters.sort_by;

        const ongoingToggle = document.querySelector('#ongoing-toggle');
        if (ongoingToggle) ongoingToggle.checked = this.filters.is_ongoing;
    }

    resetAndFilter() {
        this.currentPage = 1;
        this.filterProducts(true);
        this.updateURL();
    }

    async filterProducts(replace = false) {
        if (this.isLoading) return;

        this.isLoading = true;
        this.showLoading();

        try {
            const formData = new FormData();
            formData.append('action', 'filter_products');
            formData.append('nonce', arash_ajax.nonce);
            formData.append('search', this.filters.search);
            formData.append('product_type', this.filters.product_type);
            formData.append('price_type', this.filters.price_type);
            formData.append('sort_by', this.filters.sort_by);
            formData.append('is_ongoing', this.filters.is_ongoing ? '1' : '0');
            formData.append('paged', this.currentPage);

            const response = await fetch(arash_ajax.ajax_url, {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                const productsContainer = document.querySelector('#products-container');
                if (productsContainer) {
                    if (replace) {
                        productsContainer.innerHTML = data.products_html;
                        this.scrollToProducts();
                    } else {
                        productsContainer.insertAdjacentHTML('beforeend', data.products_html);
                    }
                }

                this.updatePagination(data.pagination);
                this.updateResultsCount(data.pagination.total_products);
                this.animateNewProducts();
            } else {
                this.showError('خطا در بارگذاری محصولات. لطفاً دوباره تلاش کنید.');
            }
        } catch (error) {
            console.error('Filter error:', error);
            this.showError('خطا در ارتباط با سرور. لطفاً دوباره تلاش کنید.');
        } finally {
            this.isLoading = false;
            this.hideLoading();
        }
    }

    async loadMoreProducts() {
        this.currentPage++;
        await this.filterProducts(false);
    }

    clearAllFilters() {
        this.filters = {
            search: '',
            product_type: '',
            price_type: '',
            sort_by: 'newest',
            is_ongoing: false
        };

        this.updateFormElements();
        this.resetAndFilter();
    }

    updateURL() {
        const url = new URL(window.location);
        
        // Clear existing parameters
        url.searchParams.delete('search');
        url.searchParams.delete('product_type');
        url.searchParams.delete('price_type');
        url.searchParams.delete('sort_by');
        url.searchParams.delete('is_ongoing');

        // Add current filters
        if (this.filters.search) url.searchParams.set('search', this.filters.search);
        if (this.filters.product_type) url.searchParams.set('product_type', this.filters.product_type);
        if (this.filters.price_type) url.searchParams.set('price_type', this.filters.price_type);
        if (this.filters.sort_by !== 'newest') url.searchParams.set('sort_by', this.filters.sort_by);
        if (this.filters.is_ongoing) url.searchParams.set('is_ongoing', 'true');

        // Update URL without page reload
        window.history.replaceState({}, '', url);
    }

    updatePagination(pagination) {
        const loadMoreBtn = document.querySelector('#load-more-products');
        const paginationInfo = document.querySelector('#pagination-info');

        if (loadMoreBtn) {
            if (pagination.has_more) {
                loadMoreBtn.style.display = 'block';
                loadMoreBtn.disabled = false;
            } else {
                loadMoreBtn.style.display = 'none';
            }
        }

        if (paginationInfo) {
            paginationInfo.textContent = `صفحه ${pagination.current_page} از ${pagination.total_pages}`;
        }
    }

    updateResultsCount(totalProducts) {
        const resultsCount = document.querySelector('#results-count');
        if (resultsCount) {
            if (totalProducts === 0) {
                resultsCount.textContent = 'محصولی یافت نشد';
            } else if (totalProducts === 1) {
                resultsCount.textContent = '1 محصول یافت شد';
            } else {
                resultsCount.textContent = `${totalProducts} محصول یافت شد`;
            }
        }
    }

    setupInfiniteScroll() {
        let isNearBottom = false;
        
        window.addEventListener('scroll', () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const windowHeight = window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight;
            
            // Check if user is near bottom (within 200px)
            const nearBottom = scrollTop + windowHeight >= documentHeight - 200;
            
            if (nearBottom && !isNearBottom && !this.isLoading) {
                isNearBottom = true;
                
                const loadMoreBtn = document.querySelector('#load-more-products');
                if (loadMoreBtn && loadMoreBtn.style.display !== 'none') {
                    this.loadMoreProducts();
                }
            } else if (!nearBottom) {
                isNearBottom = false;
            }
        });
    }

    showLoading() {
        const loadingOverlay = document.querySelector('#loading-overlay');
        if (loadingOverlay) {
            loadingOverlay.classList.remove('hidden');
        }

        // Disable filter controls
        const filterControls = document.querySelectorAll('#product-search, #product-type-filter, #price-type-filter, #sort-filter, #ongoing-toggle');
        filterControls.forEach(control => {
            control.disabled = true;
        });
    }

    hideLoading() {
        const loadingOverlay = document.querySelector('#loading-overlay');
        if (loadingOverlay) {
            loadingOverlay.classList.add('hidden');
        }

        // Re-enable filter controls
        const filterControls = document.querySelectorAll('#product-search, #product-type-filter, #price-type-filter, #sort-filter, #ongoing-toggle');
        filterControls.forEach(control => {
            control.disabled = false;
        });
    }

    showError(message) {
        // Create or update error message
        let errorDiv = document.querySelector('#error-message');
        if (!errorDiv) {
            errorDiv = document.createElement('div');
            errorDiv.id = 'error-message';
            errorDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4';
            
            const productsContainer = document.querySelector('#products-container');
            if (productsContainer) {
                productsContainer.parentNode.insertBefore(errorDiv, productsContainer);
            }
        }
        
        errorDiv.textContent = message;
        errorDiv.style.display = 'block';
        
        // Auto-hide after 5 seconds
        setTimeout(() => {
            errorDiv.style.display = 'none';
        }, 5000);
    }

    scrollToProducts() {
        const productsContainer = document.querySelector('#products-container');
        if (productsContainer) {
            productsContainer.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        }
    }

    animateNewProducts() {
        // Add animation to newly loaded products
        const products = document.querySelectorAll('#products-container > div:not(.animated)');
        products.forEach((product, index) => {
            product.classList.add('animated');
            product.style.opacity = '0';
            product.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                product.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                product.style.opacity = '1';
                product.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }

    // Public method to trigger filtering from external sources
    applyFilters(newFilters) {
        Object.assign(this.filters, newFilters);
        this.updateFormElements();
        this.resetAndFilter();
    }

    // Public method to get current filters
    getCurrentFilters() {
        return { ...this.filters };
    }

    // Public method to update sort from Alpine.js component
    updateSort(sortValue) {
        this.filters.sort_by = sortValue;
        this.resetAndFilter();
    }
}

// Initialize shop manager when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Check if we're on the shop page
    if (document.querySelector('#products-container')) {
        window.shopManager = new ShopManager();
    }
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ShopManager;
}