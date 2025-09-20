<?php
// دریافت مگامنو
$mega_menu_name = 'mega-menu';
$mega_locations = get_nav_menu_locations();

if ($mega_locations && isset($mega_locations[$mega_menu_name])) {
    $mega_menu = wp_get_nav_menu_object($mega_locations[$mega_menu_name]);
    $mega_menu_items = wp_get_nav_menu_items($mega_menu->term_id);
    
    // سازماندهی آیتم‌های مگامنو به صورت سلسله مراتبی (3 سطح)
    $mega_menu_tree = array();
    $mega_submenu_items = array();
    $mega_third_level_items = array();
    
    if ($mega_menu_items) {
        foreach ($mega_menu_items as $item) {
            if ($item->menu_item_parent == 0) {
                // آیتم‌های سطح اول (دسته‌بندی‌های اصلی)
                $mega_menu_tree[$item->ID] = $item;
                $mega_menu_tree[$item->ID]->children = array();
            } else {
                // پیدا کردن والد این آیتم
                $parent_found = false;
                foreach ($mega_menu_items as $potential_parent) {
                    if ($potential_parent->ID == $item->menu_item_parent && $potential_parent->menu_item_parent == 0) {
                        // این آیتم سطح دوم است
                        $mega_submenu_items[$item->menu_item_parent][] = $item;
                        $parent_found = true;
                        break;
                    }
                }
                
                if (!$parent_found) {
                    // این آیتم سطح سوم است
                    $mega_third_level_items[$item->menu_item_parent][] = $item;
                }
            }
        }
        
        // اضافه کردن زیرمنوهای سطح دوم به والدین سطح اول
        foreach ($mega_submenu_items as $parent_id => $children) {
            if (isset($mega_menu_tree[$parent_id])) {
                foreach ($children as $child) {
                    $child->children = array();
                    $mega_menu_tree[$parent_id]->children[$child->ID] = $child;
                }
            }
        }
        
        // اضافه کردن آیتم‌های سطح سوم به والدین سطح دوم
        foreach ($mega_third_level_items as $parent_id => $children) {
            foreach ($mega_menu_tree as $first_level) {
                if (isset($first_level->children[$parent_id])) {
                    $first_level->children[$parent_id]->children = $children;
                    break;
                }
            }
        }
    }
}
?>

<div class="relative group/categories">
    <a href="#"
        class="inline-flex items-center gap-1 text-muted transition-colors hover:text-foreground">
        <span class="font-semibold text-sm">دسته بندی محصولات</span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m19.5 8.25-7.5 7.5-7.5-7.5" />
        </svg>
    </a>
    <div
        class="absolute right-0 top-full opacity-0 invisible transition-all group-hover/categories:opacity-100 group-hover/categories:visible pt-5 z-10">
        
        <?php if (!empty($mega_menu_tree)): ?>
            <ul class="flex flex-col relative w-56 min-h-[300px] bg-background border border-border shadow-2xl shadow-black/5">
                
                <?php foreach ($mega_menu_tree as $first_level_item): ?>
                    <li class="group">
                        <a href="<?php echo $first_level_item->url; ?>"
                            class="flex items-center relative text-foreground transition-colors hover:text-primary p-3">
                            <span class="font-semibold text-sm"><?php echo $first_level_item->title; ?></span>
                            <?php if (!empty($first_level_item->children)): ?>
                                <span class="absolute left-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 19.5 8.25 12l7.5-7.5" />
                                    </svg>
                                </span>
                            <?php endif; ?>
                        </a>
                        
                        <?php if (!empty($first_level_item->children)): ?>
                            <ul class="absolute -top-px -bottom-px right-full flex flex-wrap flex-col w-96 bg-background border border-border shadow-2xl shadow-black/5 space-y-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible px-3 pt-8 pb-3">
                                
                                <?php 
                                // بررسی اینکه آیا زیرمنوهای سطح سوم وجود دارد
                                $has_third_level = false;
                                foreach ($first_level_item->children as $second_level_item) {
                                    if (!empty($second_level_item->children)) {
                                        $has_third_level = true;
                                        break;
                                    }
                                }
                                ?>
                                
                                <?php if ($has_third_level): ?>
                                    <li class="absolute top-2">
                                        <span class="font-bold text-sm text-muted cursor-default">محبوب ترین موضوعات</span>
                                    </li>
                                    
                                    <?php foreach ($first_level_item->children as $second_level_item): ?>
                                        <?php if (!empty($second_level_item->children)): ?>
                                            <?php foreach ($second_level_item->children as $third_level_item): ?>
                                                <li class="w-1/2">
                                                    <a href="<?php echo $third_level_item->url; ?>"
                                                        class="flex items-center gap-2 text-muted before:content-[''] before:inline-block before:w-1 before:h-1 before:bg-border before:rounded-full transition-colors hover:text-primary hover:before:bg-primary">
                                                        <span class="font-semibold text-sm"><?php echo $third_level_item->title; ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    
                                <?php else: ?>
                                    <!-- اگر سطح سوم وجود ندارد، آیتم‌های سطح دوم را نمایش بده -->
                                    <?php foreach ($first_level_item->children as $second_level_item): ?>
                                        <li class="w-1/2">
                                            <a href="<?php echo $second_level_item->url; ?>"
                                                class="flex items-center gap-2 text-muted before:content-[''] before:inline-block before:w-1 before:h-1 before:bg-border before:rounded-full transition-colors hover:text-primary hover:before:bg-primary">
                                                <span class="font-semibold text-sm"><?php echo $second_level_item->title; ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
                
            </ul>
        <?php else: ?>
            <!-- پیام در صورت عدم وجود منو -->
            <div class="w-56 min-h-[100px] bg-background border border-border shadow-2xl shadow-black/5 p-4 flex items-center justify-center">
                <span class="text-muted text-sm">مگامنو تنظیم نشده است</span>
            </div>
        <?php endif; ?>
        
    </div>
</div>