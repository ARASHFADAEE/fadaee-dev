<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


do_action( 'woocommerce_before_account_navigation' );

// Get current user data
$current_user = wp_get_current_user();
$user_display_name = $current_user->display_name;
$user_avatar = get_avatar_url($current_user->ID, array('size' => 80));

// Get user meta for additional info
$user_phone = get_user_meta($current_user->ID, 'billing_phone', true);
$user_email = $current_user->user_email;
?>

<!-- Navigation Wrapper Start -->
<div class="bg-background rounded-3xl p-6 shadow-sm border border-border/50 sticky top-8">
    <!-- user:info -->
    <div class="flex items-center gap-5 mb-5">
        <div class="flex items-center gap-3">
            <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                <?php if ($user_avatar): ?>
                    <img src="<?php echo esc_url($user_avatar); ?>" class="w-full h-full object-cover" alt="<?php echo esc_attr($user_display_name); ?>">
                <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/avatars/default.jpeg" class="w-full h-full object-cover" alt="Default Avatar">
                <?php endif; ?>
            </div>
            <div class="flex flex-col items-start space-y-1">
                <span class="text-xs text-muted">خوش آمدید</span>
                <span class="line-clamp-1 font-semibold text-sm text-foreground cursor-default">
                    <?php echo esc_html($user_display_name ? $user_display_name : 'کاربر گرامی'); ?>
                </span>
            </div>
        </div>
    </div>
    <!-- end user:info -->

    <!-- user:menus -->
    <ul class="flex flex-col space-y-3 bg-secondary rounded-2xl p-5">
        <?php 
        $menu_items = wc_get_account_menu_items();
        $custom_items = get_custom_menu_items();
        
        foreach ($menu_items as $endpoint => $label) :
            $url = esc_url(wc_get_account_endpoint_url($endpoint));
            $is_current = wc_is_current_account_menu_item($endpoint);
            $classes = $is_current ? 'bg-primary text-primary-foreground' : 'bg-background text-muted transition-colors hover:bg-primary hover:text-primary-foreground';
            
            // Get custom item data if available
            $custom_label = isset($custom_items[$endpoint]['label']) ? $custom_items[$endpoint]['label'] : $label;
            $icon = isset($custom_items[$endpoint]['icon']) ? $custom_items[$endpoint]['icon'] : '';
            
            // Handle logout differently
            if ($endpoint === 'customer-logout') :
        ?>
            <li>
                <a href="<?php echo $url; ?>" class="w-full h-11 inline-flex items-center text-right gap-3 <?php echo $classes; ?> rounded-full px-4">
                    <?php echo $icon; ?>
                    <span class="font-semibold text-xs"><?php echo esc_html($custom_label); ?></span>
                </a>
            </li>
        <?php else : ?>
            <li>
                <a href="<?php echo $url; ?>" class="w-full h-11 inline-flex items-center text-right gap-3 <?php echo $classes; ?> rounded-full px-4" <?php echo $is_current ? 'aria-current="page"' : ''; ?>>
                    <?php echo $icon; ?>
                    <span class="font-semibold text-xs"><?php echo esc_html($custom_label); ?></span>
                </a>
            </li>
        <?php 
            endif;
        endforeach; 
        ?>
    </ul>
    <!-- end user:menus -->
</div>
<!-- Navigation Wrapper End -->

<?php do_action('woocommerce_after_account_navigation'); ?>