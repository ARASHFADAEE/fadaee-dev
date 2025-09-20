<?php
$menu_name = 'main-menu';
$locations = get_nav_menu_locations();

if ($locations && isset($locations[$menu_name])) {
    $menu = wp_get_nav_menu_object($locations[$menu_name]);
    $menu_items = wp_get_nav_menu_items($menu->term_id);
    
    // سازماندهی آیتم‌های منو به صورت سلسله مراتبی
    $menu_tree = array();
    $submenu_items = array();
    
    if ($menu_items) {
        foreach ($menu_items as $item) {
            if ($item->menu_item_parent == 0) {
                // آیتم‌های سطح اول
                $menu_tree[$item->ID] = $item;
                $menu_tree[$item->ID]->children = array();
            } else {
                // زیرمنوها
                $submenu_items[$item->menu_item_parent][] = $item;
            }
        }
        
        // اضافه کردن زیرمنوها به والدین
        foreach ($submenu_items as $parent_id => $children) {
            if (isset($menu_tree[$parent_id])) {
                $menu_tree[$parent_id]->children = $children;
            }
        }
    }
}

?>
<ul class="flex items-center gap-5">

<?php if(!empty($menu_tree)): ?>

    <?php foreach($menu_tree as $item): ?>
        <?php if(!empty($item->children)): ?>
            <!-- آیتم با زیرمنو -->
            <li class="relative group/submenu">
                <a href="<?php echo $item->url; ?>"
                    class="inline-flex items-center gap-1 text-muted transition-colors hover:text-foreground">
                    <span class="font-semibold text-sm"><?php echo $item->title; ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor"
                        class="w-5 h-5 transition-transform group-hover/submenu:rotate-180">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </a>
                <ul
                    class="absolute top-full right-0 w-56 bg-background border border-border rounded-xl shadow-2xl shadow-black/5 opacity-0 invisible transition-all group-hover/submenu:opacity-100 group-hover/submenu:visible p-3 mt-2">
                    <?php foreach($item->children as $child): ?>
                        <li>
                            <a href="<?php echo $child->url; ?>"
                                class="flex items-center gap-2 w-full text-foreground transition-colors hover:text-primary px-3 py-2">
                                <span class="font-semibold text-xs"><?php echo $child->title; ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php else: ?>
            <!-- آیتم بدون زیرمنو -->
            <li>
                <a href="<?php echo $item->url; ?>"
                    class="inline-flex text-muted transition-colors hover:text-foreground">
                    <span class="font-semibold text-sm"><?php echo $item->title; ?></span>
                </a>
            </li>
        <?php endif; ?>
    <?php endforeach; ?>

<?php endif; ?>
</ul>
