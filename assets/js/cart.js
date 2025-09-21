/**
 * Cart Ajax Functionality
 * Handles all cart-related Ajax operations for the Arash theme
 */

(function($) {
    'use strict';

    // Cart object to handle all cart operations
    const ArashCart = {
        
        // Initialize cart functionality
        init: function() {
            this.bindEvents();
            this.loadCartData();
        },

        // Bind all cart-related events
        bindEvents: function() {
            // Add to cart buttons
            $(document).on('click', '.add-to-cart-btn', this.addToCart);
            
            // Remove from cart buttons
            $(document).on('click', '.remove-cart-item', this.removeFromCart);
            
            // Quantity increase/decrease buttons
            $(document).on('click', '.quantity-increase', this.handleQuantityIncrease.bind(this));
            $(document).on('click', '.quantity-decrease', this.handleQuantityDecrease.bind(this));
            
            // Coupon operations
            $(document).on('click', '.apply-coupon-btn', this.applyCoupon);
            $(document).on('click', '.remove-coupon-btn', this.removeCoupon);
            
            // Clear cart
            $(document).on('click', '.clear-cart-btn', this.clearCart);
            
            // Delete confirmation modal
            $(document).on('click', '.confirm-delete', this.confirmDelete);
            $(document).on('click', '.cancel-delete', this.cancelDelete);
            $(document).on('click', '.modal-overlay', this.cancelDelete);
        },

        // Load initial cart data
        loadCartData: function() {
            this.makeAjaxRequest('arash_get_cart_data', {}, function(response) {
                if (response.success) {
                    ArashCart.updateCartDisplay(response.data.cart_data);
                }
            });
        },

        // Add product to cart
        addToCart: function(e) {
            e.preventDefault();
            
            const $button = $(this);
            const productId = $button.data('product-id');
            const quantity = $button.data('quantity') || 1;
            const variationId = $button.data('variation-id') || 0;
            
            if (!productId) {
                ArashCart.showMessage('خطا در شناسایی محصول', 'error');
                return;
            }

            // Show loading state
            $button.addClass('loading').prop('disabled', true);
            
            const data = {
                product_id: productId,
                quantity: quantity,
                variation_id: variationId
            };

            ArashCart.makeAjaxRequest('arash_add_to_cart', data, function(response) {
                $button.removeClass('loading').prop('disabled', false);
                
                if (response.success) {
                    ArashCart.showMessage(response.data.message, 'success');
                    ArashCart.updateCartDisplay(response.data.cart_data);
                    ArashCart.updateCartCount(response.data.cart_count);
                } else {
                    ArashCart.showMessage(response.data.message, 'error');
                }
            });
        },

        // Remove item from cart
        removeFromCart: function(e) {
            e.preventDefault();
            
            const $button = $(this);
            const cartItemKey = $button.data('cart-item-key');
            
            if (!cartItemKey) {
                ArashCart.showMessage('خطا در شناسایی آیتم سبد خرید', 'error');
                return;
            }

            // Show delete confirmation modal
            ArashCart.showDeleteModal(cartItemKey);
        },

        // Confirm delete action
        confirmDelete: function(e) {
            if (e && e.preventDefault) {
                e.preventDefault();
            }
            
            const cartItemKey = $('.delete-modal').data('cart-item-key');
            
            if (!cartItemKey) {
                return;
            }

            const data = {
                cart_item_key: cartItemKey
            };

            ArashCart.makeAjaxRequest('arash_remove_from_cart', data, function(response) {
                ArashCart.hideDeleteModal();
                
                if (response.success) {
                    ArashCart.showMessage(response.data.message, 'success');
                    ArashCart.updateCartDisplay(response.data.cart_data);
                    ArashCart.updateCartCount(response.data.cart_count);
                } else {
                    ArashCart.showMessage(response.data.message, 'error');
                }
            });
        },

        // Handle quantity increase
        handleQuantityIncrease: function(e) {
            e.preventDefault();
            console.log('=== QUANTITY INCREASE CLICKED ===');
            
            const $button = $(e.currentTarget);
            console.log('Button element:', $button[0]);
            console.log('Button disabled state:', $button.prop('disabled'));
            
            // Prevent multiple clicks
            if ($button.prop('disabled')) {
                console.log('Button is disabled, returning');
                return;
            }
            
            const cartKey = $button.data('cart-key');
            // Get current quantity from the display element instead of data attribute
            const $quantityDisplay = $button.closest('.flex').find('.quantity-display');
            const currentQuantity = parseInt($quantityDisplay.text()) || 1;
            const newQuantity = currentQuantity + 1;
            
            console.log('Increase details:', {
                cartKey: cartKey,
                currentQuantity: currentQuantity,
                newQuantity: newQuantity,
                displayText: $quantityDisplay.text()
            });

            this.updateQuantity(cartKey, newQuantity, $button);
        },

        // Handle quantity decrease
        handleQuantityDecrease: function(e) {
            e.preventDefault();
            console.log('=== QUANTITY DECREASE CLICKED ===');
            
            const $button = $(e.currentTarget);
            console.log('Button element:', $button[0]);
            console.log('Button disabled state:', $button.prop('disabled'));
            
            // Prevent multiple clicks
            if ($button.prop('disabled')) {
                console.log('Button is disabled, returning');
                return;
            }
            
            const cartKey = $button.data('cart-key');
            // Get current quantity from the display element instead of data attribute
            const $quantityDisplay = $button.closest('.flex').find('.quantity-display');
            const currentQuantity = parseInt($quantityDisplay.text()) || 1;
            
            console.log('Decrease details:', {
                cartKey: cartKey,
                currentQuantity: currentQuantity,
                displayText: $quantityDisplay.text()
            });
            
            if (currentQuantity <= 1) {
                console.log('Quantity is already at minimum (1)');
                this.showMessage('حداقل تعداد یک عدد است', 'warning');
                return;
            }
            
            const newQuantity = currentQuantity - 1;
            console.log('New quantity will be:', newQuantity);
            this.updateQuantity(cartKey, newQuantity, $button);
        },

        // Cancel delete action
        cancelDelete: function(e) {
            e.preventDefault();
            ArashCart.hideDeleteModal();
        },




        updateQuantity: function(cartKey, quantity, $button) {
            console.log('=== UPDATE QUANTITY CALLED ===');
            console.log('Parameters:', { cartKey, quantity, buttonElement: $button[0] });
            
            // Show loading state and disable buttons
            const $quantityDisplay = $button.closest('.flex').find('.quantity-display');
            const $quantityButtons = $button.closest('.flex').find('.quantity-increase, .quantity-decrease');
            const originalText = $quantityDisplay.text();
            
            console.log('UI elements found:', {
                quantityDisplay: $quantityDisplay.length,
                quantityButtons: $quantityButtons.length,
                originalText: originalText
            });
            
            $quantityDisplay.text('...');
            $quantityButtons.prop('disabled', true);
            $quantityDisplay.addClass('opacity-50');
            
            console.log('Making AJAX request to arash_update_cart_quantity with:', {
                cart_item_key: cartKey,
                quantity: quantity
            });
            
            this.makeAjaxRequest('arash_update_cart_quantity', {
                cart_item_key: cartKey,
                quantity: quantity
            }, (response) => {
                console.log('=== AJAX RESPONSE RECEIVED ===');
                console.log('Full response object:', response);
                console.log('Response success:', response.success);
                console.log('Response data:', response.data);
                
                // Update quantity display
                $quantityDisplay.text(quantity);
                console.log('Updated quantity display to:', quantity);
                
                // Update data-current-quantity attributes for both buttons
                const $quantityContainer = $button.closest('.flex').find('.quantity-increase, .quantity-decrease');
                $quantityContainer.attr('data-current-quantity', quantity);
                console.log('Updated button data-current-quantity to:', quantity);
                
                if (response.success) {
                    console.log('Response successful - updating UI components');
                    console.log('Cart data received:', response.data.cart_data);
                    console.log('Cart totals:', response.data.cart_data ? response.data.cart_data.totals : 'No totals');
                    
                    // Update item subtotal using new method
                    ArashCart.updateItemSubtotal(cartKey, response.data.cart_data);
                    
                    // Update cart totals using new method
                    ArashCart.updateCartTotals(response.data.cart_data.totals);
                    
                    // Update cart count
                    ArashCart.updateCartCount(response.data.cart_count);
                    
                    // Update cart total in header
                    $('.cart-total .amount').text(ArashCart.formatPrice(response.data.cart_total));
                    
                    console.log('All UI updates completed successfully');
                } else {
                    console.log('Response failed with message:', response.data ? response.data.message : 'No message');
                    ArashCart.showMessage(response.data.message, 'error');
                }
                
                // Re-enable buttons in both success and error cases
                $quantityButtons.prop('disabled', false);
                $quantityDisplay.removeClass('opacity-50');
                console.log('Buttons re-enabled and loading state removed');
            }, (error) => {
                console.log('=== AJAX ERROR ===');
                console.log('Error details:', error);
                this.showMessage('خطا در به‌روزرسانی تعداد محصول', 'error');
                $quantityDisplay.text(originalText);
                
                // Re-enable buttons
                $quantityButtons.prop('disabled', false);
                $quantityDisplay.removeClass('opacity-50');
            });
        },

        // Apply coupon
        applyCoupon: function(e) {
            e.preventDefault();
            
            const $button = $(this);
            const $couponInput = $('.coupon-input');
            const couponCode = $couponInput.val().trim();
            
            if (!couponCode) {
                ArashCart.showCouponMessage('لطفاً کد تخفیف را وارد کنید', 'error');
                $couponInput.focus();
                return;
            }

            // Show loading state
            $button.addClass('loading').prop('disabled', true);
            
            const data = {
                coupon_code: couponCode
            };

            ArashCart.makeAjaxRequest('arash_apply_coupon', data, function(response) {
                $button.removeClass('loading').prop('disabled', false);
                
                if (response.success) {
                    ArashCart.showCouponMessage(response.data.message, 'success');
                    ArashCart.updateCartDisplay(response.data.cart_data);
                    $couponInput.val(''); // Clear input
                    
                    // Reload page to show updated coupons
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    ArashCart.showCouponMessage(response.data.message, 'error');
                }
            });
        },

        // Remove coupon
        removeCoupon: function(e) {
            e.preventDefault();
            
            const $button = $(this);
            const couponCode = $button.data('coupon-code');
            
            if (!couponCode) {
                ArashCart.showCouponMessage('خطا در شناسایی کد تخفیف', 'error');
                return;
            }

            const data = {
                coupon_code: couponCode
            };

            ArashCart.makeAjaxRequest('arash_remove_coupon', data, function(response) {
                if (response.success) {
                    ArashCart.showCouponMessage(response.data.message, 'success');
                    ArashCart.updateCartDisplay(response.data.cart_data);
                    
                    // Reload page to show updated coupons
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    ArashCart.showCouponMessage(response.data.message, 'error');
                }
            });
        },

        // Clear entire cart
        clearCart: function(e) {
            e.preventDefault();
            
            if (!confirm('آیا مطمئن هستید که می‌خواهید سبد خرید را خالی کنید؟')) {
                return;
            }

            ArashCart.makeAjaxRequest('arash_clear_cart', {}, function(response) {
                if (response.success) {
                    ArashCart.showMessage(response.data.message, 'success');
                    ArashCart.updateCartDisplay(response.data.cart_data);
                    ArashCart.updateCartCount(0);
                } else {
                    ArashCart.showMessage(response.data.message, 'error');
                }
            });
        },

        // Update cart display with new data
        updateCartDisplay: function(cartData) {
            if (cartData.is_empty) {
                this.showEmptyCart();
                return;
            }

            // Update cart items
            this.updateCartItems(cartData.items);
            
            // Update cart totals
            this.updateCartTotals(cartData.totals);
            
            // Update applied coupons
            this.updateAppliedCoupons(cartData.coupons);
            
            // Update cart count in header
            this.updateCartCount(cartData.count);
        },

        // Update cart items display
        updateCartItems: function(items) {
            const $cartContainer = $('.cart-items-container');
            
            if (!$cartContainer.length) {
                return;
            }

            let itemsHtml = '';
            
            items.forEach(function(item) {
                itemsHtml += ArashCart.generateCartItemHtml(item);
            });

            $cartContainer.html(itemsHtml);
            
            // Update cart count text
            $('.cart-count-text').text(items.length + ' دوره به سبد اضافه کرده اید');
        },

        // Generate HTML for a single cart item
        generateCartItemHtml: function(item) {
            const salePrice = item.sale_price && item.sale_price > 0 ? item.sale_price : null;
            const displayPrice = salePrice || item.price;
            const isOnSale = item.is_on_sale && salePrice;
            
            return `
                <div class="cart-item" data-cart-item-key="${item.key}">
                    <div class="cart-item-image">
                        <img src="${item.image_url}" alt="${item.name}">
                    </div>
                    <div class="cart-item-details">
                        <h3 class="cart-item-title">
                            <a href="${item.product_url}">${item.name}</a>
                        </h3>
                        <div class="cart-item-meta">
                            <span class="chapters">${item.course_meta.chapters} فصل</span>
                            <span class="duration">${item.course_meta.duration} ساعت</span>
                            <span class="status ${item.course_meta.status}">${ArashCart.getStatusLabel(item.course_meta.status)}</span>
                        </div>
                        <div class="cart-item-instructor">
                            <img src="${item.course_meta.instructor_avatar}" alt="${item.course_meta.instructor}">
                            <span>${item.course_meta.instructor}</span>
                        </div>
                    </div>
                    <div class="cart-item-price">
                        ${isOnSale ? `<span class="original-price">${ArashCart.formatPrice(item.regular_price)}</span>` : ''}
                        <span class="current-price ${isOnSale ? 'sale-price' : ''}">${ArashCart.formatPrice(displayPrice)}</span>
                    </div>
                    <div class="cart-item-actions">
                        <a href="${item.product_url}" class="view-course-btn">مشاهده دوره</a>
                        <button class="remove-cart-item" data-cart-item-key="${item.key}">حذف</button>
                    </div>
                </div>
            `;
        },

        // Update cart totals
        updateCartTotals: function(totals) {
            // Update total amount - the only element that exists in the template
            if ($('.cart-total .amount').length > 0) {
                $('.cart-total .amount').text(this.formatPrice(totals.total));
            }
            
            // Show/hide discount row if it exists
            if (totals.discount > 0) {
                $('.cart-discount').show();
                $('.cart-discount .amount').text('-' + this.formatPrice(totals.discount));
            } else {
                $('.cart-discount').hide();
            }
        },

        // Update applied coupons
        updateAppliedCoupons: function(coupons) {
            const $couponsContainer = $('.applied-coupons');
            
            if (!coupons.length) {
                $couponsContainer.hide();
                return;
            }

            let couponsHtml = '';
            coupons.forEach(function(coupon) {
                couponsHtml += `
                    <div class="applied-coupon">
                        <span class="coupon-code">${coupon.code}</span>
                        <span class="coupon-amount">-${ArashCart.formatPrice(coupon.amount)}</span>
                        <button class="remove-coupon-btn" data-coupon-code="${coupon.code}">×</button>
                    </div>
                `;
            });

            $couponsContainer.html(couponsHtml).show();
        },

        // Show empty cart state
        showEmptyCart: function() {
            const $cartContainer = $('.cart-items-container');
            $cartContainer.html(`
                <div class="empty-cart">
                    <p>سبد خرید شما خالی است</p>
                    <a href="/shop" class="continue-shopping-btn">ادامه خرید</a>
                </div>
            `);
            
            // Hide cart totals and checkout section
            $('.cart-sidebar').hide();
        },

        // Update cart count in header/navigation
        updateCartCount: function(count) {
            $('.cart-count').text(count);
            $('.cart-count-badge').text(count);
            
            if (count > 0) {
                $('.cart-count-badge').show();
            } else {
                $('.cart-count-badge').hide();
            }
        },

        // Show delete confirmation modal
        showDeleteModal: function(cartItemKey) {
            const $modal = $('.delete-modal');
            $modal.data('cart-item-key', cartItemKey);
            $modal.addClass('active');
            $('.modal-overlay').addClass('active');
        },

        // Hide delete confirmation modal
        hideDeleteModal: function() {
            $('.delete-modal').removeClass('active');
            $('.modal-overlay').removeClass('active');
        },

        // Show message to user
        showMessage: function(message, type) {
            // Remove existing messages
            $('.cart-message').remove();
            
            const messageClass = type === 'success' ? 'success' : 'error';
            const messageHtml = `
                <div class="cart-message ${messageClass}">
                    <span>${message}</span>
                    <button class="close-message">×</button>
                </div>
            `;
            
            $('body').prepend(messageHtml);
            
            // Auto-hide after 5 seconds
            setTimeout(function() {
                $('.cart-message').fadeOut(function() {
                    $(this).remove();
                });
            }, 5000);
            
            // Manual close
            $(document).on('click', '.close-message', function() {
                $(this).parent().fadeOut(function() {
                    $(this).remove();
                });
            });
        },

        // Show coupon-specific message
        showCouponMessage: function(message, type) {
            const $messageContainer = $('#coupon-message');
            
            if ($messageContainer.length === 0) {
                // Fallback to general message if container not found
                this.showMessage(message, type);
                return;
            }
            
            const messageClass = type === 'success' ? 'text-success bg-success/10 border-success/20' : 'text-destructive bg-destructive/10 border-destructive/20';
            const iconSvg = type === 'success' 
                ? '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                : '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>';
            
            const messageHtml = `
                <div class="flex items-center gap-3 p-4 rounded-xl border ${messageClass}">
                    ${iconSvg}
                    <span class="text-sm font-medium">${message}</span>
                </div>
            `;
            
            $messageContainer.html(messageHtml).removeClass('hidden').show();
            
            // Auto-hide after 4 seconds
            setTimeout(function() {
                $messageContainer.fadeOut(function() {
                    $(this).addClass('hidden').empty();
                });
            }, 4000);
        },

        // Make Ajax request
        makeAjaxRequest: function(action, data, callback, errorCallback) {
            const requestData = {
                action: action,
                nonce: arash_ajax.nonce,
                ...data
            };

            $.ajax({
                url: arash_ajax.ajax_url,
                type: 'POST',
                data: requestData,
                dataType: 'json',
                success: function(response) {
                    if (callback && typeof callback === 'function') {
                        callback(response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Ajax request failed:', error);
                    console.error('Response:', xhr.responseText);
                    console.error('Status:', status);
                    if (errorCallback && typeof errorCallback === 'function') {
                        errorCallback(error);
                    } else {
                        ArashCart.showMessage('خطا در ارتباط با سرور', 'error');
                    }
                }
            });
        },

        // Update individual item subtotal
        updateItemSubtotal: function(cartItemKey, cartData) {
            // Find the specific cart item and update its subtotal
            const cartItem = cartData.items.find(item => item.key === cartItemKey);
            
            if (cartItem) {
                const $cartItemElement = $(`.cart-item[data-cart-key="${cartItemKey}"]`);
                const $subtotalElement = $cartItemElement.find('.item-subtotal');
                
                if ($subtotalElement.length) {
                    const formattedPrice = this.formatPrice(cartItem.line_total);
                    $subtotalElement.text(formattedPrice);
                }
            }
        },

        // Format price for display
        formatPrice: function(price) {
            // Handle undefined, null, or invalid price values
            if (price === undefined || price === null || isNaN(price)) {
                return '0 تومان';
            }
            
            // Convert to number if it's a string
            const numericPrice = typeof price === 'string' ? parseFloat(price) : price;
            
            // Check if conversion was successful
            if (isNaN(numericPrice)) {
                return '0 تومان';
            }
            
            return new Intl.NumberFormat('fa-IR').format(numericPrice) + ' تومان';
        },

        // Get status label
        getStatusLabel: function(status) {
            const labels = {
                'completed': 'تکمیل شده',
                'ongoing': 'در حال برگزاری',
                'upcoming': 'به زودی'
            };
            return labels[status] || 'تکمیل شده';
        }
    };

    // Initialize cart when document is ready
    $(document).ready(function() {
        ArashCart.init();
    });

    // Make ArashCart globally available
    window.ArashCart = ArashCart;

})(jQuery);