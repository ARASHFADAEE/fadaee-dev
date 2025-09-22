<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-shipping-fields">
    <?php if ( true === WC()->cart->needs_shipping_address() ) : ?>

        <h3 class="text-lg font-bold text-foreground mb-4 flex items-center gap-2" id="ship-to-different-address">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-primary">
                <path d="M6.5 3c-1.051 0-2.041.49-2.68 1.324L2.48 6.233A1.5 1.5 0 0 0 2 7.5V10a1.5 1.5 0 0 0 1.5 1.5h1.043a3.001 3.001 0 0 0 5.914 0h2.086a3.001 3.001 0 0 0 5.914 0H20a1.5 1.5 0 0 0 1.5-1.5V8.5a1.5 1.5 0 0 0-1.5-1.5h-3.379a1.5 1.5 0 0 0-1.06.44L14.5 8.5H11V6a1.5 1.5 0 0 0-1.5-1.5h-3ZM5 12a1 1 0 1 1 0 2 1 1 0 0 1 0-2Zm12 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2Z" />
            </svg>
            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox flex items-center gap-3 cursor-pointer">
                <input id="ship-to-different-address-checkbox" 
                       class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox w-4 h-4 text-primary bg-background border-border rounded focus:ring-primary focus:ring-2" 
                       <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> 
                       type="checkbox" 
                       name="ship_to_different_address" 
                       value="1" />
                <span class="font-bold text-foreground"><?php esc_html_e( 'Ship to a different address?', 'woocommerce' ); ?></span>
            </label>
        </h3>

        <div class="shipping_address" style="<?php echo ! apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ) ? 'display: none;' : ''; ?>">

            <?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

            <div class="woocommerce-shipping-fields__field-wrapper">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php
                    $fields = $checkout->get_checkout_fields( 'shipping' );

                    foreach ( $fields as $key => $field ) {
                        // Determine grid span based on field type
                        $grid_class = 'col-span-1';
                        if ( in_array( $key, array( 'shipping_address_1', 'shipping_address_2', 'shipping_company' ) ) ) {
                            $grid_class = 'md:col-span-2';
                        }
                        
                        echo '<div class="' . esc_attr( $grid_class ) . '">';
                        woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

            <?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

        </div>

    <?php endif; ?>
</div>

<div class="woocommerce-additional-fields">
    <?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

    <?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

        <?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>
            <h3 class="text-lg font-bold text-foreground mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-primary">
                    <path fill-rule="evenodd" d="M18 5.25a2.25 2.25 0 0 0-2.25-2.25H4.25A2.25 2.25 0 0 0 2 5.25v9.5A2.25 2.25 0 0 0 4.25 17h11.5A2.25 2.25 0 0 0 18 14.75v-9.5Zm-2.25-.75A.75.75 0 0 1 16.5 5.25v.01a.75.75 0 0 1-.75.75h-.01a.75.75 0 0 1-.75-.75v-.01a.75.75 0 0 1 .75-.75h.01ZM4.25 5.5a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H5a.75.75 0 0 1-.75-.75V5.5ZM5 7.25a.75.75 0 0 0 0 1.5h10a.75.75 0 0 0 0-1.5H5Zm0 3.5a.75.75 0 0 0 0 1.5h10a.75.75 0 0 0 0-1.5H5Z" clip-rule="evenodd" />
                </svg>
                <?php esc_html_e( 'Additional information', 'woocommerce' ); ?>
            </h3>
        <?php endif; ?>

        <div class="woocommerce-additional-fields__field-wrapper">
            <?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
                <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

    <?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
</div>

<style>
/* Custom styling for shipping form fields */
.woocommerce-shipping-fields .woocommerce-form-row,
.woocommerce-additional-fields .woocommerce-form-row {
    margin-bottom: 0;
}

.woocommerce-shipping-fields .form-row,
.woocommerce-additional-fields .form-row {
    margin-bottom: 1rem;
}

.woocommerce-shipping-fields label,
.woocommerce-additional-fields label {
    display: block;
    font-weight: 600;
    color: var(--foreground);
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.woocommerce-shipping-fields label .required,
.woocommerce-additional-fields label .required {
    color: #ef4444;
    margin-right: 0.25rem;
}

.woocommerce-shipping-fields input[type="text"],
.woocommerce-shipping-fields input[type="email"],
.woocommerce-shipping-fields input[type="tel"],
.woocommerce-shipping-fields select,
.woocommerce-shipping-fields textarea,
.woocommerce-additional-fields input[type="text"],
.woocommerce-additional-fields input[type="email"],
.woocommerce-additional-fields input[type="tel"],
.woocommerce-additional-fields select,
.woocommerce-additional-fields textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid var(--border);
    border-radius: 0.75rem;
    background-color: var(--background);
    color: var(--foreground);
    font-size: 0.875rem;
    transition: all 0.2s ease;
}

.woocommerce-shipping-fields textarea,
.woocommerce-additional-fields textarea {
    min-height: 100px;
    resize: vertical;
}

.woocommerce-shipping-fields input:focus,
.woocommerce-shipping-fields select:focus,
.woocommerce-shipping-fields textarea:focus,
.woocommerce-additional-fields input:focus,
.woocommerce-additional-fields select:focus,
.woocommerce-additional-fields textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
}

.woocommerce-shipping-fields .woocommerce-input-wrapper,
.woocommerce-additional-fields .woocommerce-input-wrapper {
    position: relative;
}

.woocommerce-shipping-fields .select2-container,
.woocommerce-additional-fields .select2-container {
    width: 100% !important;
}

.woocommerce-shipping-fields .select2-selection,
.woocommerce-additional-fields .select2-selection {
    border: 1px solid var(--border) !important;
    border-radius: 0.75rem !important;
    padding: 0.5rem 1rem !important;
    min-height: 48px !important;
    background-color: var(--background) !important;
}

.woocommerce-shipping-fields .select2-selection__rendered,
.woocommerce-additional-fields .select2-selection__rendered {
    color: var(--foreground) !important;
    line-height: 32px !important;
    padding: 0 !important;
}

.woocommerce-shipping-fields .select2-selection__arrow,
.woocommerce-additional-fields .select2-selection__arrow {
    height: 46px !important;
    right: 8px !important;
}

/* Ship to different address checkbox styling */
#ship-to-different-address {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 1rem;
    padding: 1rem;
    margin-bottom: 1.5rem;
}

#ship-to-different-address label {
    margin-bottom: 0;
    font-size: 1rem;
}

#ship-to-different-address-checkbox {
    margin: 0;
}

/* Shipping address container */
.shipping_address {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 1rem;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
}

.shipping_address.show {
    animation: slideDown 0.3s ease;
}

/* Additional fields styling */
.woocommerce-additional-fields {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 1rem;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

/* Error styling */
.woocommerce-shipping-fields .woocommerce-error,
.woocommerce-additional-fields .woocommerce-error {
    background-color: #fef2f2;
    border: 1px solid #fecaca;
    color: #dc2626;
    padding: 0.75rem 1rem;
    border-radius: 0.75rem;
    margin-top: 0.5rem;
    font-size: 0.875rem;
}

.woocommerce-shipping-fields .woocommerce-validated input,
.woocommerce-shipping-fields .woocommerce-validated select,
.woocommerce-additional-fields .woocommerce-validated input,
.woocommerce-additional-fields .woocommerce-validated select {
    border-color: #10b981;
}

.woocommerce-shipping-fields .woocommerce-invalid input,
.woocommerce-shipping-fields .woocommerce-invalid select,
.woocommerce-additional-fields .woocommerce-invalid input,
.woocommerce-additional-fields .woocommerce-invalid select {
    border-color: #ef4444;
}

/* Country/State field styling */
.woocommerce-shipping-fields .country_to_state select,
.woocommerce-additional-fields .country_to_state select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: left 1rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-left: 3rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .woocommerce-shipping-fields .grid,
    .woocommerce-additional-fields .grid {
        grid-template-columns: 1fr;
    }
    
    .woocommerce-shipping-fields .md\\:col-span-2,
    .woocommerce-additional-fields .md\\:col-span-2 {
        grid-column: span 1;
    }
    
    .shipping_address,
    .woocommerce-additional-fields {
        padding: 1rem;
    }
}

/* Animation keyframes */
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
        max-height: 0;
    }
    to {
        opacity: 1;
        transform: translateY(0);
        max-height: 1000px;
    }
}

@keyframes slideUp {
    from {
        opacity: 1;
        transform: translateY(0);
        max-height: 1000px;
    }
    to {
        opacity: 0;
        transform: translateY(-20px);
        max-height: 0;
    }
}

/* Loading state */
.woocommerce-shipping-fields .blockUI,
.woocommerce-additional-fields .blockUI {
    background: rgba(255, 255, 255, 0.8) !important;
    border-radius: 0.75rem;
}

.woocommerce-shipping-fields .blockUI .blockMsg,
.woocommerce-additional-fields .blockUI .blockMsg {
    border: none !important;
    background: none !important;
    color: var(--primary) !important;
    font-weight: 600;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle ship to different address checkbox
    const shipToDifferentCheckbox = document.getElementById('ship-to-different-address-checkbox');
    const shippingAddressDiv = document.querySelector('.shipping_address');
    
    if (shipToDifferentCheckbox && shippingAddressDiv) {
        shipToDifferentCheckbox.addEventListener('change', function() {
            if (this.checked) {
                shippingAddressDiv.style.display = 'block';
                shippingAddressDiv.classList.add('show');
                shippingAddressDiv.style.animation = 'slideDown 0.3s ease';
                
                // Focus on first shipping field
                const firstField = shippingAddressDiv.querySelector('input, select');
                if (firstField) {
                    setTimeout(() => firstField.focus(), 300);
                }
            } else {
                shippingAddressDiv.style.animation = 'slideUp 0.3s ease';
                setTimeout(() => {
                    shippingAddressDiv.style.display = 'none';
                    shippingAddressDiv.classList.remove('show');
                }, 300);
            }
        });
    }
    
    // Real-time validation for shipping fields
    const shippingFields = document.querySelectorAll('.woocommerce-shipping-fields input, .woocommerce-shipping-fields select, .woocommerce-additional-fields input, .woocommerce-additional-fields select, .woocommerce-additional-fields textarea');
    
    shippingFields.forEach(function(field) {
        field.addEventListener('blur', function() {
            validateShippingField(this);
        });
        
        field.addEventListener('input', function() {
            // Remove error state on input
            const formRow = this.closest('.form-row');
            if (formRow) {
                formRow.classList.remove('woocommerce-invalid');
                const errorMsg = formRow.querySelector('.woocommerce-error');
                if (errorMsg) {
                    errorMsg.remove();
                }
            }
        });
    });
    
    function validateShippingField(field) {
        const formRow = field.closest('.form-row');
        const isRequired = field.hasAttribute('required') || formRow.classList.contains('validate-required');
        const fieldType = field.type;
        const fieldValue = field.value.trim();
        
        // Remove existing error
        const existingError = formRow.querySelector('.woocommerce-error');
        if (existingError) {
            existingError.remove();
        }
        
        formRow.classList.remove('woocommerce-invalid', 'woocommerce-validated');
        
        // Only validate if shipping to different address is checked or it's an order note
        const isShippingField = field.name && field.name.startsWith('shipping_');
        const isOrderNote = field.name === 'order_comments';
        const shippingEnabled = shipToDifferentCheckbox && shipToDifferentCheckbox.checked;
        
        if (isShippingField && !shippingEnabled) {
            return true; // Skip validation if shipping to different address is not checked
        }
        
        // Check if required field is empty
        if (isRequired && !fieldValue) {
            showShippingFieldError(formRow, 'این فیلد الزامی است.');
            return false;
        }
        
        // Postal code validation for shipping
        if (field.name === 'shipping_postcode' && fieldValue) {
            const postalRegex = /^[0-9]{10}$/;
            if (!postalRegex.test(fieldValue)) {
                showShippingFieldError(formRow, 'کد پستی باید ۱۰ رقم باشد.');
                return false;
            }
        }
        
        // If we get here, field is valid
        if (fieldValue) {
            formRow.classList.add('woocommerce-validated');
        }
        
        return true;
    }
    
    function showShippingFieldError(formRow, message) {
        formRow.classList.add('woocommerce-invalid');
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'woocommerce-error';
        errorDiv.textContent = message;
        
        const inputWrapper = formRow.querySelector('.woocommerce-input-wrapper');
        if (inputWrapper) {
            inputWrapper.appendChild(errorDiv);
        } else {
            formRow.appendChild(errorDiv);
        }
    }
    
    // Auto-copy billing to shipping functionality
    function copyBillingToShipping() {
        if (!shipToDifferentCheckbox || !shipToDifferentCheckbox.checked) {
            return;
        }
        
        const billingFields = {
            'billing_first_name': 'shipping_first_name',
            'billing_last_name': 'shipping_last_name',
            'billing_company': 'shipping_company',
            'billing_address_1': 'shipping_address_1',
            'billing_address_2': 'shipping_address_2',
            'billing_city': 'shipping_city',
            'billing_state': 'shipping_state',
            'billing_postcode': 'shipping_postcode',
            'billing_country': 'shipping_country'
        };
        
        Object.keys(billingFields).forEach(function(billingField) {
            const billingInput = document.querySelector('[name="' + billingField + '"]');
            const shippingInput = document.querySelector('[name="' + billingFields[billingField] + '"]');
            
            if (billingInput && shippingInput && !shippingInput.value) {
                shippingInput.value = billingInput.value;
                
                // Trigger change event for select2 fields
                if (shippingInput.tagName === 'SELECT') {
                    jQuery(shippingInput).trigger('change');
                }
            }
        });
    }
    
    // Add copy billing button
    if (shipToDifferentCheckbox && shippingAddressDiv) {
        const copyButton = document.createElement('button');
        copyButton.type = 'button';
        copyButton.className = 'copy-billing-btn inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-primary bg-primary/10 border border-primary/20 rounded-lg hover:bg-primary/20 transition-colors mb-4';
        copyButton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                <path fill-rule="evenodd" d="M15.988 3.012A2.25 2.25 0 0 1 18 5.25v6.5A2.25 2.25 0 0 1 15.75 14H13.5V7A2.5 2.5 0 0 0 11 4.5H8.128a2.252 2.252 0 0 1-.97-1.488A2.25 2.25 0 0 1 9.325 1h4.913a2.25 2.25 0 0 1 1.75 3.012ZM7.5 2.25A.75.75 0 0 1 8.25 3v.5h3V3a.75.75 0 0 1 1.5 0v.5H15a.75.75 0 0 1 0 1.5H6.75a.75.75 0 0 1 0-1.5H9V3a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
            </svg>
            کپی از آدرس صورتحساب
        `;
        copyButton.addEventListener('click', copyBillingToShipping);
        
        const fieldWrapper = shippingAddressDiv.querySelector('.woocommerce-shipping-fields__field-wrapper');
        if (fieldWrapper) {
            fieldWrapper.insertBefore(copyButton, fieldWrapper.firstChild);
        }
    }
});
</script>