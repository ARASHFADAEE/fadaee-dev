/**
 * WooCommerce Checkout JavaScript
 * Enhanced checkout functionality with validation, UX improvements, and RTL support
 */

(function($) {
    'use strict';

    // Checkout object
    const FadaeeCheckout = {
        
        // Initialize checkout functionality
        init: function() {
            this.bindEvents();
            this.initFormValidation();
            this.initPaymentMethods();
            this.initShippingToggle();
            this.initCouponForm();
            this.initProgressIndicator();
            this.initAutoSave();
            this.initAccessibility();
        },

        // Bind event handlers
        bindEvents: function() {
            const self = this;

            // Form submission
            $('form.checkout').on('submit', function(e) {
                return self.validateForm(this);
            });

            // Field validation on blur
            $('form.checkout').on('blur', 'input, select, textarea', function() {
                self.validateField($(this));
            });

            // Real-time validation on input
            $('form.checkout').on('input', 'input[type="email"], input[type="tel"]', function() {
                self.debounce(function() {
                    self.validateField($(this));
                }, 500).call(this);
            });

            // Checkout update events
            $('body').on('update_checkout', function() {
                self.handleCheckoutUpdate();
            });

            // Payment method change
            $('form.checkout').on('change', 'input[name="payment_method"]', function() {
                self.handlePaymentMethodChange($(this));
            });

            // Country/state change
            $('form.checkout').on('change', 'select[name*="country"], select[name*="state"]', function() {
                self.handleLocationChange($(this));
            });

            // Shipping same as billing
            $('form.checkout').on('change', '#ship-to-different-address-checkbox', function() {
                self.handleShippingToggle($(this));
            });

            // Create account toggle
            $('form.checkout').on('change', '#createaccount', function() {
                self.handleCreateAccountToggle($(this));
            });
        },

        // Initialize form validation
        initFormValidation: function() {
            // Add validation classes to required fields
            $('form.checkout .validate-required input, form.checkout .validate-required select, form.checkout .validate-required textarea').each(function() {
                const $field = $(this);
                const $wrapper = $field.closest('.form-row');
                
                if (!$wrapper.hasClass('woocommerce-validated') && !$wrapper.hasClass('woocommerce-invalid')) {
                    $wrapper.addClass('woocommerce-pending');
                }
            });
        },

        // Validate individual field
        validateField: function($field) {
            const $wrapper = $field.closest('.form-row');
            const fieldValue = $field.val();
            const value = fieldValue ? fieldValue.trim() : '';
            const fieldType = $field.attr('type');
            const fieldName = $field.attr('name');
            let isValid = true;
            let errorMessage = '';

            // Remove previous validation classes
            $wrapper.removeClass('woocommerce-validated woocommerce-invalid woocommerce-pending');

            // Required field validation
            if ($wrapper.hasClass('validate-required') && !value) {
                isValid = false;
                errorMessage = 'این فیلد الزامی است.';
            }

            // Email validation
            if (fieldType === 'email' && value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    isValid = false;
                    errorMessage = 'لطفاً یک آدرس ایمیل معتبر وارد کنید.';
                }
            }

            // Phone validation
            if (fieldType === 'tel' && value) {
                const phoneRegex = /^[\+]?[0-9\s\-\(\)]{10,}$/;
                if (!phoneRegex.test(value)) {
                    isValid = false;
                    errorMessage = 'لطفاً یک شماره تلفن معتبر وارد کنید.';
                }
            }

            // Postal code validation (Iran)
            if (fieldName && fieldName.includes('postcode') && value) {
                const postalRegex = /^\d{10}$/;
                if (!postalRegex.test(value)) {
                    isValid = false;
                    errorMessage = 'کد پستی باید ۱۰ رقم باشد.';
                }
            }

            // Password validation
            if (fieldType === 'password' && value) {
                if (value.length < 6) {
                    isValid = false;
                    errorMessage = 'رمز عبور باید حداقل ۶ کاراکتر باشد.';
                }
            }

            // Apply validation result
            if (isValid) {
                $wrapper.addClass('woocommerce-validated');
                this.removeFieldError($field);
            } else {
                $wrapper.addClass('woocommerce-invalid');
                this.showFieldError($field, errorMessage);
            }

            return isValid;
        },

        // Validate entire form
        validateForm: function(form) {
            const $form = $(form);
            let isValid = true;

            // Validate all required fields
            $form.find('.validate-required input, .validate-required select, .validate-required textarea').each((index, field) => {
                if (!this.validateField($(field))) {
                    isValid = false;
                }
            });

            // Validate payment method selection
            if (!$form.find('input[name="payment_method"]:checked').length) {
                isValid = false;
                this.showNotice('لطفاً یک روش پرداخت انتخاب کنید.', 'error');
            }

            // Validate terms and conditions
            if ($form.find('#terms').length && !$form.find('#terms:checked').length) {
                isValid = false;
                this.showNotice('لطفاً قوانین و مقررات را بپذیرید.', 'error');
            }

            if (!isValid) {
                // Scroll to first error
                const $firstError = $form.find('.woocommerce-invalid').first();
                if ($firstError.length) {
                    $('html, body').animate({
                        scrollTop: $firstError.offset().top - 100
                    }, 500);
                }
            }

            return isValid;
        },

        // Show field error
        showFieldError: function($field, message) {
            const $wrapper = $field.closest('.form-row');
            let $error = $wrapper.find('.field-error');

            if (!$error.length) {
                $error = $('<div class="field-error"></div>');
                $wrapper.append($error);
            }

            $error.text(message).show();
        },

        // Remove field error
        removeFieldError: function($field) {
            const $wrapper = $field.closest('.form-row');
            $wrapper.find('.field-error').hide();
        },

        // Initialize payment methods
        initPaymentMethods: function() {
            const self = this;

            // Style payment methods
            $('.wc_payment_methods .wc_payment_method').each(function() {
                const $method = $(this);
                const $input = $method.find('input[type="radio"]');
                const $label = $method.find('label');

                $method.addClass('payment-method');
                
                if ($input.is(':checked')) {
                    $method.addClass('selected');
                }
            });

            // Handle payment method selection
            $('.wc_payment_methods').on('change', 'input[type="radio"]', function() {
                $('.wc_payment_method').removeClass('selected');
                $(this).closest('.wc_payment_method').addClass('selected');
            });
        },

        // Handle payment method change
        handlePaymentMethodChange: function($input) {
            const method = $input.val();
            
            // Add loading state
            $('.payment-methods').addClass('checkout-loading');
            
            // Trigger WooCommerce update
            $('body').trigger('update_checkout');
            
            // Remove loading state after update
            setTimeout(() => {
                $('.payment-methods').removeClass('checkout-loading');
            }, 1000);
        },

        // Initialize shipping toggle
        initShippingToggle: function() {
            const $checkbox = $('#ship-to-different-address-checkbox');
            const $shippingFields = $('.shipping_address');

            if ($checkbox.length) {
                // Initial state
                if (!$checkbox.is(':checked')) {
                    $shippingFields.hide();
                }

                // Toggle animation
                $checkbox.on('change', function() {
                    if ($(this).is(':checked')) {
                        $shippingFields.slideDown(300);
                    } else {
                        $shippingFields.slideUp(300);
                        // Copy billing to shipping
                        this.copyBillingToShipping();
                    }
                }.bind(this));
            }
        },

        // Handle shipping toggle
        handleShippingToggle: function($checkbox) {
            const $shippingFields = $('.shipping_address');
            
            if ($checkbox.is(':checked')) {
                $shippingFields.slideDown(300);
            } else {
                $shippingFields.slideUp(300);
                this.copyBillingToShipping();
            }
        },

        // Copy billing to shipping
        copyBillingToShipping: function() {
            const billingFields = [
                'first_name', 'last_name', 'company', 'address_1', 
                'address_2', 'city', 'state', 'postcode', 'country'
            ];

            billingFields.forEach(field => {
                const $billingField = $(`#billing_${field}`);
                const $shippingField = $(`#shipping_${field}`);
                
                if ($billingField.length && $shippingField.length) {
                    $shippingField.val($billingField.val());
                }
            });
        },

        // Handle create account toggle
        handleCreateAccountToggle: function($checkbox) {
            const $passwordField = $('.create-account-password');
            
            if ($checkbox.is(':checked')) {
                $passwordField.slideDown(300);
            } else {
                $passwordField.slideUp(300);
            }
        },

        // Initialize coupon form
        initCouponForm: function() {
            const $couponToggle = $('.coupon-toggle');
            const $couponForm = $('.coupon-form');

            if ($couponToggle.length && $couponForm.length) {
                // Initial state
                if (!$couponForm.is(':visible')) {
                    $couponForm.hide();
                }

                // Toggle coupon form
                $couponToggle.on('click', function(e) {
                    e.preventDefault();
                    $couponForm.slideToggle(300);
                    $(this).toggleClass('active');
                });

                // Handle coupon submission
                $couponForm.on('submit', function(e) {
                    e.preventDefault();
                    this.applyCoupon($(this));
                }.bind(this));
            }
        },

        // Apply coupon
        applyCoupon: function($form) {
            const $couponCode = $form.find('#coupon_code');
            const $submitBtn = $form.find('button[type="submit"]');
            const couponCode = $couponCode.val().trim();

            if (!couponCode) {
                this.showNotice('لطفاً کد تخفیف را وارد کنید.', 'error');
                return;
            }

            // Add loading state
            $submitBtn.prop('disabled', true).text('در حال اعمال...');
            $form.addClass('checkout-loading');

            // AJAX request to apply coupon
            $.ajax({
                url: wc_checkout_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'woocommerce_apply_coupon',
                    security: wc_checkout_params.apply_coupon_nonce,
                    coupon_code: couponCode
                },
                success: (response) => {
                    if (response.success) {
                        this.showNotice('کد تخفیف با موفقیت اعمال شد.', 'success');
                        $('body').trigger('update_checkout');
                        $couponCode.val('');
                    } else {
                        this.showNotice(response.data || 'خطا در اعمال کد تخفیف.', 'error');
                    }
                },
                error: () => {
                    this.showNotice('خطا در اتصال به سرور.', 'error');
                },
                complete: () => {
                    $submitBtn.prop('disabled', false).text('اعمال کد تخفیف');
                    $form.removeClass('checkout-loading');
                }
            });
        },

        // Initialize progress indicator
        initProgressIndicator: function() {
            const steps = [
                { id: 'cart', label: 'سبد خرید', completed: true },
                { id: 'checkout', label: 'تسویه حساب', active: true },
                { id: 'payment', label: 'پرداخت', pending: true },
                { id: 'complete', label: 'تکمیل', pending: true }
            ];

            const $progress = $('.checkout-progress');
            if ($progress.length) {
                let progressHTML = '';
                
                steps.forEach((step, index) => {
                    let classes = 'progress-step';
                    if (step.completed) classes += ' completed';
                    if (step.active) classes += ' active';
                    
                    progressHTML += `<div class="${classes}">
                        <span class="step-number">${index + 1}</span>
                        <span class="step-label">${step.label}</span>
                    </div>`;
                });
                
                $progress.html(progressHTML);
            }
        },

        // Initialize auto-save
        initAutoSave: function() {
            let saveTimeout;
            const self = this;

            $('form.checkout').on('input change', 'input, select, textarea', function() {
                clearTimeout(saveTimeout);
                saveTimeout = setTimeout(() => {
                    self.autoSaveFormData();
                }, 2000);
            });

            // Load saved data on page load
            this.loadSavedFormData();
        },

        // Auto-save form data
        autoSaveFormData: function() {
            const formData = {};
            
            $('form.checkout').find('input, select, textarea').each(function() {
                const $field = $(this);
                const name = $field.attr('name');
                
                if (name && !name.includes('password') && !name.includes('payment_method')) {
                    formData[name] = $field.val();
                }
            });

            localStorage.setItem('checkout_form_data', JSON.stringify(formData));
        },

        // Load saved form data
        loadSavedFormData: function() {
            const savedData = localStorage.getItem('checkout_form_data');
            
            if (savedData) {
                try {
                    const formData = JSON.parse(savedData);
                    
                    Object.keys(formData).forEach(name => {
                        const $field = $(`[name="${name}"]`);
                        if ($field.length && !$field.val()) {
                            $field.val(formData[name]);
                        }
                    });
                } catch (e) {
                    console.warn('Error loading saved form data:', e);
                }
            }
        },

        // Clear saved form data
        clearSavedFormData: function() {
            localStorage.removeItem('checkout_form_data');
        },

        // Handle checkout update
        handleCheckoutUpdate: function() {
            // Re-initialize payment methods after update
            this.initPaymentMethods();
            
            // Re-validate visible fields
            $('form.checkout .woocommerce-validated input:visible, form.checkout .woocommerce-validated select:visible').each((index, field) => {
                this.validateField($(field));
            });
        },

        // Handle location change
        handleLocationChange: function($field) {
            // Add loading state to form
            $('form.checkout').addClass('checkout-loading');
            
            // Trigger WooCommerce update
            $('body').trigger('update_checkout');
        },

        // Initialize accessibility features
        initAccessibility: function() {
            // Add ARIA labels
            $('form.checkout input[required], form.checkout select[required]').attr('aria-required', 'true');
            
            // Add role attributes
            $('.woocommerce-error, .woocommerce-message, .woocommerce-info').attr('role', 'alert');
            
            // Keyboard navigation for payment methods
            $('.wc_payment_methods').on('keydown', 'input[type="radio"]', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    $(this).click();
                }
            });
        },

        // Show notice
        showNotice: function(message, type = 'info') {
            const $notices = $('.woocommerce-notices-wrapper');
            const noticeClass = `woocommerce-${type}`;
            
            // Remove existing notices of the same type
            $notices.find(`.${noticeClass}`).remove();
            
            // Create new notice
            const $notice = $(`<div class="${noticeClass}" role="alert">${message}</div>`);
            $notices.append($notice);
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                $notice.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 5000);
            
            // Scroll to notice
            $('html, body').animate({
                scrollTop: $notices.offset().top - 100
            }, 300);
        },

        // Debounce function
        debounce: function(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func.apply(this, args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        },

        // Handle location change
        handleLocationChange: function($field) {
            const $form = $field.closest('form');
            $form.addClass('checkout-loading');
            
            // Trigger checkout update
            $('body').trigger('update_checkout');
            
            // Remove loading state after update
            setTimeout(() => {
                $form.removeClass('checkout-loading');
            }, 2000);
        }
    };

    // Initialize when document is ready
    $(document).ready(function() {
        FadaeeCheckout.init();
    });

    // Clear saved data on successful checkout
    $(document).on('checkout_place_order_success', function() {
        FadaeeCheckout.clearSavedFormData();
    });

    // Handle checkout errors
    $(document).on('checkout_error', function() {
        $('.checkout-loading').removeClass('checkout-loading');
    });

    // Export for global access
    window.FadaeeCheckout = FadaeeCheckout;

})(jQuery);

// Additional utility functions
document.addEventListener('DOMContentLoaded', function() {
    
    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add loading states to buttons
    document.querySelectorAll('button[type="submit"], input[type="submit"]').forEach(button => {
        button.addEventListener('click', function() {
            if (this.form && this.form.checkValidity()) {
                this.classList.add('loading');
                this.disabled = true;
                
                // Re-enable after 10 seconds as fallback
                setTimeout(() => {
                    this.classList.remove('loading');
                    this.disabled = false;
                }, 10000);
            }
        });
    });

    // Add focus management for better accessibility
    const focusableElements = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            const focusable = Array.from(document.querySelectorAll(focusableElements));
            const index = focusable.indexOf(document.activeElement);
            
            if (e.shiftKey) {
                if (index === 0) {
                    e.preventDefault();
                    focusable[focusable.length - 1].focus();
                }
            } else {
                if (index === focusable.length - 1) {
                    e.preventDefault();
                    focusable[0].focus();
                }
            }
        }
    });

    // Add visual feedback for form interactions
    document.querySelectorAll('input, select, textarea').forEach(field => {
        field.addEventListener('focus', function() {
            this.closest('.form-row')?.classList.add('focused');
        });
        
        field.addEventListener('blur', function() {
            this.closest('.form-row')?.classList.remove('focused');
        });
    });
});