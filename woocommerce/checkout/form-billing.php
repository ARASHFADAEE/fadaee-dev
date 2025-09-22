<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-billing-fields">
    <?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>
        <h3 class="text-lg font-bold text-foreground mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-primary">
                <path fill-rule="evenodd" d="m9.69 18.933.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 0 0 .281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 1 0 3 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 0 0 2.273 1.765 11.842 11.842 0 0 0 .976.544l.018.008.006.003ZM10 11.25a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5Z" clip-rule="evenodd" />
            </svg>
            <?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?>
        </h3>
    <?php else : ?>
        <h3 class="text-lg font-bold text-foreground mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-primary">
                <path fill-rule="evenodd" d="M4.5 2A1.5 1.5 0 0 0 3 3.5v13A1.5 1.5 0 0 0 4.5 18h11a1.5 1.5 0 0 0 1.5-1.5V7.621a1.5 1.5 0 0 0-.44-1.06L14.439 4.44A1.5 1.5 0 0 0 13.378 4H4.5Zm2.25 8.5a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Zm0 3a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Z" clip-rule="evenodd" />
            </svg>
            <?php esc_html_e( 'Billing details', 'woocommerce' ); ?>
        </h3>
    <?php endif; ?>

    <?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

    <div class="woocommerce-billing-fields__field-wrapper">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php
            $fields = $checkout->get_checkout_fields( 'billing' );

            foreach ( $fields as $key => $field ) {
                // Determine grid span based on field type
                $grid_class = 'col-span-1';
                if ( in_array( $key, array( 'billing_address_1', 'billing_address_2', 'billing_company' ) ) ) {
                    $grid_class = 'md:col-span-2';
                }
                
                echo '<div class="' . esc_attr( $grid_class ) . '">';
                woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
    <div class="woocommerce-account-fields mt-6">
        <?php if ( ! $checkout->is_registration_required() ) : ?>
            <div class="create-account-checkbox bg-card border border-border rounded-xl p-4">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox flex items-center gap-3 cursor-pointer">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox w-4 h-4 text-primary bg-background border-border rounded focus:ring-primary focus:ring-2" 
                           id="createaccount" 
                           <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> 
                           type="checkbox" 
                           name="createaccount" 
                           value="1" />
                    <span class="text-sm font-medium text-foreground"><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
                </label>
            </div>
        <?php endif; ?>

        <?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

        <?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>
            <div class="create-account mt-4" style="<?php echo ( ! $checkout->is_registration_required() ) ? 'display: none;' : ''; ?>">
                <div class="grid grid-cols-1 gap-4">
                    <?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
                        <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
    </div>
<?php endif; ?>

<style>
/* Custom styling for billing form fields */
.woocommerce-billing-fields .woocommerce-form-row {
    margin-bottom: 0;
}

.woocommerce-billing-fields .form-row {
    margin-bottom: 1rem;
}

.woocommerce-billing-fields label {
    display: block;
    font-weight: 600;
    color: var(--foreground);
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.woocommerce-billing-fields label .required {
    color: #ef4444;
    margin-right: 0.25rem;
}

.woocommerce-billing-fields input[type="text"],
.woocommerce-billing-fields input[type="email"],
.woocommerce-billing-fields input[type="tel"],
.woocommerce-billing-fields input[type="password"],
.woocommerce-billing-fields select,
.woocommerce-billing-fields textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid var(--border);
    border-radius: 0.75rem;
    background-color: var(--background);
    color: var(--foreground);
    font-size: 0.875rem;
    transition: all 0.2s ease;
}

.woocommerce-billing-fields input[type="text"]:focus,
.woocommerce-billing-fields input[type="email"]:focus,
.woocommerce-billing-fields input[type="tel"]:focus,
.woocommerce-billing-fields input[type="password"]:focus,
.woocommerce-billing-fields select:focus,
.woocommerce-billing-fields textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
}

.woocommerce-billing-fields .woocommerce-input-wrapper {
    position: relative;
}

.woocommerce-billing-fields .select2-container {
    width: 100% !important;
}

.woocommerce-billing-fields .select2-selection {
    border: 1px solid var(--border) !important;
    border-radius: 0.75rem !important;
    padding: 0.5rem 1rem !important;
    min-height: 48px !important;
    background-color: var(--background) !important;
}

.woocommerce-billing-fields .select2-selection__rendered {
    color: var(--foreground) !important;
    line-height: 32px !important;
    padding: 0 !important;
}

.woocommerce-billing-fields .select2-selection__arrow {
    height: 46px !important;
    right: 8px !important;
}

.woocommerce-billing-fields .woocommerce-error {
    background-color: #fef2f2;
    border: 1px solid #fecaca;
    color: #dc2626;
    padding: 0.75rem 1rem;
    border-radius: 0.75rem;
    margin-top: 0.5rem;
    font-size: 0.875rem;
}

.woocommerce-billing-fields .woocommerce-validated input,
.woocommerce-billing-fields .woocommerce-validated select {
    border-color: #10b981;
}

.woocommerce-billing-fields .woocommerce-invalid input,
.woocommerce-billing-fields .woocommerce-invalid select {
    border-color: #ef4444;
}

/* Country/State field styling */
.woocommerce-billing-fields .country_to_state {
    position: relative;
}

.woocommerce-billing-fields .country_to_state select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: left 1rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-left: 3rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .woocommerce-billing-fields .grid {
        grid-template-columns: 1fr;
    }
    
    .woocommerce-billing-fields .md\\:col-span-2 {
        grid-column: span 1;
    }
}

/* Loading state */
.woocommerce-billing-fields .blockUI {
    background: rgba(255, 255, 255, 0.8) !important;
    border-radius: 0.75rem;
}

.woocommerce-billing-fields .blockUI .blockMsg {
    border: none !important;
    background: none !important;
    color: var(--primary) !important;
    font-weight: 600;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle create account checkbox
    const createAccountCheckbox = document.getElementById('createaccount');
    const createAccountFields = document.querySelector('.create-account');
    
    if (createAccountCheckbox && createAccountFields) {
        createAccountCheckbox.addEventListener('change', function() {
            if (this.checked) {
                createAccountFields.style.display = 'block';
                createAccountFields.style.animation = 'fadeIn 0.3s ease';
            } else {
                createAccountFields.style.display = 'none';
            }
        });
    }
    
    // Real-time validation
    const billingFields = document.querySelectorAll('.woocommerce-billing-fields input, .woocommerce-billing-fields select');
    
    billingFields.forEach(function(field) {
        field.addEventListener('blur', function() {
            validateField(this);
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
    
    function validateField(field) {
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
        
        // Check if required field is empty
        if (isRequired && !fieldValue) {
            showFieldError(formRow, 'این فیلد الزامی است.');
            return false;
        }
        
        // Email validation
        if (fieldType === 'email' && fieldValue) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(fieldValue)) {
                showFieldError(formRow, 'لطفاً یک آدرس ایمیل معتبر وارد کنید.');
                return false;
            }
        }
        
        // Phone validation
        if (field.name === 'billing_phone' && fieldValue) {
            const phoneRegex = /^[\+]?[0-9\s\-\(\)]{10,}$/;
            if (!phoneRegex.test(fieldValue)) {
                showFieldError(formRow, 'لطفاً یک شماره تلفن معتبر وارد کنید.');
                return false;
            }
        }
        
        // Postal code validation
        if (field.name === 'billing_postcode' && fieldValue) {
            const postalRegex = /^[0-9]{10}$/;
            if (!postalRegex.test(fieldValue)) {
                showFieldError(formRow, 'کد پستی باید ۱۰ رقم باشد.');
                return false;
            }
        }
        
        // If we get here, field is valid
        if (fieldValue) {
            formRow.classList.add('woocommerce-validated');
        }
        
        return true;
    }
    
    function showFieldError(formRow, message) {
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
});

// Add fade in animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
`;
document.head.appendChild(style);
</script>