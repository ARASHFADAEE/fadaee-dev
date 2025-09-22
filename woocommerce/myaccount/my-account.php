<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_account_navigation
 * 
 * @hooked woocommerce_account_navigation - 10
 */
do_action( 'woocommerce_before_account_navigation' );
?>

<div class="woocommerce-MyAccount-wrapper min-h-screen bg-background">
    <?php
    /**
     * Hook: woocommerce_before_my_account_wrapper
     * 
     * Custom hook for adding content before the main account wrapper
     */
    do_action( 'woocommerce_before_my_account_wrapper' );
    ?>
    
    <div class="container mx-auto px-4 py-8">
        <?php
        /**
         * Hook: woocommerce_before_account_content_wrapper
         * 
         * Custom hook for adding content before the account content wrapper
         */
        do_action( 'woocommerce_before_account_content_wrapper' );
        ?>
        
        <div class="grid grid-cols-12 gap-8">
            <!-- Navigation Sidebar -->
            <div class="col-span-12 lg:col-span-3 md:col-span-4">
                <?php
                /**
                 * My Account navigation.
                 *
                 * @since 2.6.0
                 */
                do_action( 'woocommerce_account_navigation' );
                ?>
            </div>
            
            <!-- Main Content Area -->
            <div class="col-span-12 lg:col-span-9 md:col-span-8">
                <?php
                /**
                 * Hook: woocommerce_before_account_content
                 * 
                 * Custom hook for adding content before the main account content
                 */
                do_action( 'woocommerce_before_account_content' );
                ?>
                
                <div class="bg-background rounded-3xl">
                    <?php
                    /**
                     * My Account content.
                     *
                     * @since 2.6.0
                     */
                    do_action( 'woocommerce_account_content' );
                    ?>
                </div>
                
                <?php
                /**
                 * Hook: woocommerce_after_account_content
                 * 
                 * Custom hook for adding content after the main account content
                 */
                do_action( 'woocommerce_after_account_content' );
                ?>
            </div>
        </div>
        
        <?php
        /**
         * Hook: woocommerce_after_account_content_wrapper
         * 
         * Custom hook for adding content after the account content wrapper
         */
        do_action( 'woocommerce_after_account_content_wrapper' );
        ?>
    </div>
    
    <?php
    /**
     * Hook: woocommerce_after_my_account_wrapper
     * 
     * Custom hook for adding content after the main account wrapper
     */
    do_action( 'woocommerce_after_my_account_wrapper' );
    ?>
</div>

<?php
/**
 * Hook: woocommerce_after_account_navigation
 * 
 * @since 2.6.0
 */
do_action( 'woocommerce_after_account_navigation' );
?>