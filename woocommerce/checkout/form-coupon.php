<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}
?>

<div class="woocommerce-form-coupon-toggle">
	<div class="woocommerce-info bg-card border border-border rounded-xl p-4 mb-6">
		<div class="flex items-center gap-3">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-primary flex-shrink-0">
				<path fill-rule="evenodd" d="M4.5 2A1.5 1.5 0 0 0 3 3.5v.793c.026.009.051.02.076.032L7.674 6.233a.5.5 0 0 1 0 .928L3.076 9.069A.25.25 0 0 1 3 9.044V13.5A1.5 1.5 0 0 0 4.5 15h11a1.5 1.5 0 0 0 1.5-1.5V9.044a.25.25 0 0 1-.076.025l-4.598-1.908a.5.5 0 0 1 0-.928L16.924 4.325c.025-.012.05-.023.076-.032V3.5A1.5 1.5 0 0 0 15.5 2h-11Z" clip-rule="evenodd" />
			</svg>
			<span class="text-foreground">
				<?php esc_html_e( 'Have a coupon?', 'woocommerce' ); ?>
				<a href="#" class="showcoupon text-primary font-semibold hover:text-primary/80 transition-colors">
					<?php esc_html_e( 'Click here to enter your code', 'woocommerce' ); ?>
				</a>
			</span>
		</div>
	</div>
</div>

<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">
	<div class="bg-card border border-border rounded-xl p-6 mb-6">
		<div class="flex items-center gap-3 mb-4">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6 text-primary">
				<path fill-rule="evenodd" d="M4.5 2A1.5 1.5 0 0 0 3 3.5v.793c.026.009.051.02.076.032L7.674 6.233a.5.5 0 0 1 0 .928L3.076 9.069A.25.25 0 0 1 3 9.044V13.5A1.5 1.5 0 0 0 4.5 15h11a1.5 1.5 0 0 0 1.5-1.5V9.044a.25.25 0 0 1-.076.025l-4.598-1.908a.5.5 0 0 1 0-.928L16.924 4.325c.025-.012.05-.023.076-.032V3.5A1.5 1.5 0 0 0 15.5 2h-11Z" clip-rule="evenodd" />
			</svg>
			<h3 class="text-lg font-bold text-foreground"><?php esc_html_e( 'Coupon code', 'woocommerce' ); ?></h3>
		</div>
		
		<p class="form-row form-row-first">
			<label for="coupon_code" class="block text-sm font-semibold text-foreground mb-2">
				<?php esc_html_e( 'If you have a coupon code, please apply it below.', 'woocommerce' ); ?>
			</label>
			<input type="text" 
				   name="coupon_code" 
				   class="input-text w-full px-4 py-3 border border-border rounded-xl bg-background text-foreground placeholder-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all" 
				   placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" 
				   id="coupon_code" 
				   value="" />
		</p>
		
		<p class="form-row form-row-last mt-4">
			<button type="submit" 
					class="button inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-primary-foreground font-semibold rounded-xl hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all disabled:opacity-50 disabled:cursor-not-allowed" 
					name="apply_coupon" 
					value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
					<path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
				</svg>
				<?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?>
			</button>
		</p>
		
		<div class="clear"></div>
	</div>
</form>

<style>
/* Coupon form styling */
.woocommerce-form-coupon-toggle .woocommerce-info {
	background: var(--card);
	border: 1px solid var(--border);
	color: var(--foreground);
	margin: 0;
	padding: 1rem 1.5rem;
	border-radius: 0.75rem;
}

.woocommerce-form-coupon-toggle .woocommerce-info::before {
	display: none;
}

.checkout_coupon {
	animation: slideDown 0.3s ease;
}

.checkout_coupon.hiding {
	animation: slideUp 0.3s ease;
}

.checkout_coupon .form-row {
	margin-bottom: 0;
}

.checkout_coupon .form-row-first {
	width: 100%;
	margin-right: 0;
}

.checkout_coupon .form-row-last {
	width: 100%;
	margin-left: 0;
}

.checkout_coupon input[type="text"] {
	font-size: 0.875rem;
	line-height: 1.5;
}

.checkout_coupon input[type="text"]:focus {
	box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
}

.checkout_coupon button {
	width: 100%;
	font-size: 0.875rem;
	font-weight: 600;
	text-transform: none;
	letter-spacing: 0;
}

.checkout_coupon button:hover {
	transform: translateY(-1px);
	box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.3);
}

.checkout_coupon button:active {
	transform: translateY(0);
}

.checkout_coupon button:disabled {
	transform: none;
	box-shadow: none;
}

/* Loading state */
.checkout_coupon.processing button {
	position: relative;
	color: transparent;
}

.checkout_coupon.processing button::after {
	content: '';
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	width: 20px;
	height: 20px;
	border: 2px solid transparent;
	border-top: 2px solid currentColor;
	border-radius: 50%;
	animation: spin 1s linear infinite;
	color: var(--primary-foreground);
}

/* Success/Error messages */
.woocommerce-message,
.woocommerce-error {
	margin: 1rem 0;
	padding: 1rem 1.5rem;
	border-radius: 0.75rem;
	font-size: 0.875rem;
	font-weight: 500;
}

.woocommerce-message {
	background-color: #f0fdf4;
	border: 1px solid #bbf7d0;
	color: #166534;
}

.woocommerce-error {
	background-color: #fef2f2;
	border: 1px solid #fecaca;
	color: #dc2626;
}

.woocommerce-message::before,
.woocommerce-error::before {
	display: none;
}

/* Responsive design */
@media (min-width: 640px) {
	.checkout_coupon .form-row-first {
		width: calc(70% - 0.5rem);
		margin-right: 1rem;
		display: inline-block;
		vertical-align: top;
	}
	
	.checkout_coupon .form-row-last {
		width: 30%;
		margin-left: 0;
		display: inline-block;
		vertical-align: top;
	}
	
	.checkout_coupon button {
		width: 100%;
		margin-top: 1.75rem;
	}
}

/* Animation keyframes */
@keyframes slideDown {
	from {
		opacity: 0;
		transform: translateY(-20px);
		max-height: 0;
		padding-top: 0;
		padding-bottom: 0;
		margin-top: 0;
		margin-bottom: 0;
	}
	to {
		opacity: 1;
		transform: translateY(0);
		max-height: 200px;
		padding-top: 1.5rem;
		padding-bottom: 1.5rem;
		margin-top: 0;
		margin-bottom: 1.5rem;
	}
}

@keyframes slideUp {
	from {
		opacity: 1;
		transform: translateY(0);
		max-height: 200px;
		padding-top: 1.5rem;
		padding-bottom: 1.5rem;
		margin-top: 0;
		margin-bottom: 1.5rem;
	}
	to {
		opacity: 0;
		transform: translateY(-20px);
		max-height: 0;
		padding-top: 0;
		padding-bottom: 0;
		margin-top: 0;
		margin-bottom: 0;
	}
}

@keyframes spin {
	to {
		transform: translate(-50%, -50%) rotate(360deg);
	}
}

/* Focus states for accessibility */
.showcoupon:focus {
	outline: 2px solid var(--primary);
	outline-offset: 2px;
	border-radius: 0.25rem;
}

.checkout_coupon input:focus,
.checkout_coupon button:focus {
	outline: none;
	box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
}

/* High contrast mode support */
@media (prefers-contrast: high) {
	.checkout_coupon input,
	.checkout_coupon button {
		border-width: 2px;
	}
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
	.checkout_coupon,
	.checkout_coupon.hiding,
	.checkout_coupon button {
		animation: none;
		transition: none;
	}
	
	.checkout_coupon button:hover {
		transform: none;
	}
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
	// Handle coupon toggle
	const showCouponLink = document.querySelector('.showcoupon');
	const couponForm = document.querySelector('.checkout_coupon');
	
	if (showCouponLink && couponForm) {
		showCouponLink.addEventListener('click', function(e) {
			e.preventDefault();
			
			if (couponForm.style.display === 'none' || !couponForm.style.display) {
				couponForm.style.display = 'block';
				couponForm.classList.remove('hiding');
				
				// Focus on coupon input
				const couponInput = couponForm.querySelector('#coupon_code');
				if (couponInput) {
					setTimeout(() => couponInput.focus(), 300);
				}
				
				// Update link text
				this.textContent = '<?php esc_html_e( 'Hide coupon form', 'woocommerce' ); ?>';
			} else {
				couponForm.classList.add('hiding');
				setTimeout(() => {
					couponForm.style.display = 'none';
					couponForm.classList.remove('hiding');
				}, 300);
				
				// Update link text
				this.textContent = '<?php esc_html_e( 'Click here to enter your code', 'woocommerce' ); ?>';
			}
		});
	}
	
	// Handle coupon form submission
	if (couponForm) {
		const couponInput = couponForm.querySelector('#coupon_code');
		const submitButton = couponForm.querySelector('button[name="apply_coupon"]');
		
		// Real-time validation
		if (couponInput) {
			couponInput.addEventListener('input', function() {
				const value = this.value.trim();
				
				if (submitButton) {
					submitButton.disabled = value.length === 0;
				}
				
				// Remove any existing error styling
				this.classList.remove('error');
				const errorMsg = couponForm.querySelector('.coupon-error');
				if (errorMsg) {
					errorMsg.remove();
				}
			});
			
			// Format coupon code (uppercase, remove spaces)
			couponInput.addEventListener('blur', function() {
				this.value = this.value.trim().toUpperCase();
			});
		}
		
		// Handle form submission
		couponForm.addEventListener('submit', function(e) {
			e.preventDefault();
			
			const couponCode = couponInput ? couponInput.value.trim() : '';
			
			if (!couponCode) {
				showCouponError('لطفاً کد تخفیف را وارد کنید.');
				return;
			}
			
			// Show loading state
			if (submitButton) {
				submitButton.disabled = true;
				couponForm.classList.add('processing');
			}
			
			// Apply coupon via AJAX
			applyCoupon(couponCode);
		});
	}
	
	function applyCoupon(couponCode) {
		const formData = new FormData();
		formData.append('action', 'woocommerce_apply_coupon');
		formData.append('security', wc_checkout_params.apply_coupon_nonce);
		formData.append('coupon_code', couponCode);
		
		fetch(wc_checkout_params.wc_ajax_url.toString().replace('%%endpoint%%', 'apply_coupon'), {
			method: 'POST',
			body: formData
		})
		.then(response => response.text())
		.then(data => {
			// Remove loading state
			const submitButton = couponForm.querySelector('button[name="apply_coupon"]');
			if (submitButton) {
				submitButton.disabled = false;
				couponForm.classList.remove('processing');
			}
			
			// Parse response
			if (data.includes('woocommerce-message')) {
				// Success
				showCouponSuccess('کد تخفیف با موفقیت اعمال شد.');
				
				// Clear input
				if (couponInput) {
					couponInput.value = '';
				}
				
				// Update checkout
				jQuery('body').trigger('update_checkout');
				
				// Hide coupon form after success
				setTimeout(() => {
					if (showCouponLink) {
						showCouponLink.click();
					}
				}, 2000);
				
			} else if (data.includes('woocommerce-error')) {
				// Error
				const errorMatch = data.match(/<ul[^>]*class="[^"]*woocommerce-error[^"]*"[^>]*>(.*?)<\/ul>/s);
				let errorMessage = 'کد تخفیف نامعتبر است.';
				
				if (errorMatch && errorMatch[1]) {
					const liMatch = errorMatch[1].match(/<li[^>]*>(.*?)<\/li>/);
					if (liMatch && liMatch[1]) {
						errorMessage = liMatch[1].replace(/<[^>]*>/g, '').trim();
					}
				}
				
				showCouponError(errorMessage);
			} else {
				showCouponError('خطا در اعمال کد تخفیف. لطفاً مجدداً تلاش کنید.');
			}
		})
		.catch(error => {
			console.error('Coupon application error:', error);
			
			// Remove loading state
			const submitButton = couponForm.querySelector('button[name="apply_coupon"]');
			if (submitButton) {
				submitButton.disabled = false;
				couponForm.classList.remove('processing');
			}
			
			showCouponError('خطا در برقراری ارتباط. لطفاً مجدداً تلاش کنید.');
		});
	}
	
	function showCouponError(message) {
		// Remove existing messages
		const existingError = couponForm.querySelector('.coupon-error');
		if (existingError) {
			existingError.remove();
		}
		
		// Create error message
		const errorDiv = document.createElement('div');
		errorDiv.className = 'coupon-error woocommerce-error';
		errorDiv.textContent = message;
		
		// Insert after form
		couponForm.parentNode.insertBefore(errorDiv, couponForm.nextSibling);
		
		// Add error styling to input
		if (couponInput) {
			couponInput.classList.add('error');
		}
		
		// Auto-remove after 5 seconds
		setTimeout(() => {
			if (errorDiv.parentNode) {
				errorDiv.remove();
			}
			if (couponInput) {
				couponInput.classList.remove('error');
			}
		}, 5000);
	}
	
	function showCouponSuccess(message) {
		// Remove existing messages
		const existingMessages = couponForm.parentNode.querySelectorAll('.coupon-error, .coupon-success');
		existingMessages.forEach(msg => msg.remove());
		
		// Create success message
		const successDiv = document.createElement('div');
		successDiv.className = 'coupon-success woocommerce-message';
		successDiv.textContent = message;
		
		// Insert after form
		couponForm.parentNode.insertBefore(successDiv, couponForm.nextSibling);
		
		// Auto-remove after 3 seconds
		setTimeout(() => {
			if (successDiv.parentNode) {
				successDiv.remove();
			}
		}, 3000);
	}
});
</script>