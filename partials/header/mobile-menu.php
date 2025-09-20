<div class="space-y-5 p-4">
    <form >
        <div class="flex items-center relative">
            <input type="text" id="mobile-ajax-search-form"
                class="form-input w-full h-10 !ring-0 !ring-offset-0 bg-secondary dark:bg-gray-700 border border-border focus:border-border rounded-xl text-sm text-foreground dark:text-white pr-10 placeholder:text-gray-500 dark:placeholder:text-gray-400"
                placeholder="دنبال چی میگردی؟" />
            <span class="absolute right-3 text-muted dark:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-5 h-5">
                    <path fill-rule="evenodd"
                        d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                        clip-rule="evenodd"></path>
                </svg>
            </span>
        </div>
        <!-- Mobile Search Results -->
        <div id="mobile-search-results" class="mt-3 max-h-64 overflow-y-auto"></div>
    </form>
    <div class="h-px bg-border"></div>
    <label class="relative w-full flex items-center justify-between cursor-pointer">
        <span class="font-bold text-sm text-foreground">تم تاریک</span>
        <input type="checkbox" class="sr-only peer" id="dark-mode-checkbox" />
        <div
            class="w-11 h-5 relative bg-background border-2 border-border peer-focus:outline-none rounded-full peer peer-checked:after:left-[26px] peer-checked:after:bg-background after:content-[''] after:absolute after:left-0.5 after:top-0.5 after:bg-border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-primary peer-checked:border-primary">
        </div>
    </label>
    <div class="h-px bg-border"></div>
    <?php
    // دریافت منوی موبایل
    $mobile_menu_name = 'mobile-menu';
    $mobile_locations = get_nav_menu_locations();
    
    if ($mobile_locations && isset($mobile_locations[$mobile_menu_name])) {
        $mobile_menu = wp_get_nav_menu_object($mobile_locations[$mobile_menu_name]);
        $mobile_menu_items = wp_get_nav_menu_items($mobile_menu->term_id);
        
        // سازماندهی آیتم‌های منوی موبایل به صورت سلسله مراتبی (3 سطح)
        $mobile_menu_tree = array();
        $mobile_submenu_items = array();
        $mobile_third_level_items = array();
        
        if ($mobile_menu_items) {
            foreach ($mobile_menu_items as $item) {
                if ($item->menu_item_parent == 0) {
                    // آیتم‌های سطح اول
                    $mobile_menu_tree[$item->ID] = $item;
                    $mobile_menu_tree[$item->ID]->children = array();
                } else {
                    // پیدا کردن والد این آیتم
                    $parent_found = false;
                    foreach ($mobile_menu_items as $potential_parent) {
                        if ($potential_parent->ID == $item->menu_item_parent && $potential_parent->menu_item_parent == 0) {
                            // این آیتم سطح دوم است
                            $mobile_submenu_items[$item->menu_item_parent][] = $item;
                            $parent_found = true;
                            break;
                        }
                    }
                    
                    if (!$parent_found) {
                        // این آیتم سطح سوم است
                        $mobile_third_level_items[$item->menu_item_parent][] = $item;
                    }
                }
            }
            
            // اضافه کردن زیرمنوهای سطح دوم به والدین سطح اول
            foreach ($mobile_submenu_items as $parent_id => $children) {
                if (isset($mobile_menu_tree[$parent_id])) {
                    foreach ($children as $child) {
                        $child->children = array();
                        $mobile_menu_tree[$parent_id]->children[$child->ID] = $child;
                    }
                }
            }
            
            // اضافه کردن آیتم‌های سطح سوم به والدین سطح دوم
            foreach ($mobile_third_level_items as $parent_id => $children) {
                foreach ($mobile_menu_tree as $first_level) {
                    if (isset($first_level->children[$parent_id])) {
                        $first_level->children[$parent_id]->children = $children;
                        break;
                    }
                }
            }
        }
    }
    ?>
    
    <ul class="flex flex-col space-y-1">
        
        <?php if (!empty($mobile_menu_tree)): ?>
            <?php foreach ($mobile_menu_tree as $first_level_item): ?>
                
                <?php if (!empty($first_level_item->children)): ?>
                    <!-- آیتم با زیرمنو -->
                    <li x-data="{ open: false }">
                        <button type="button"
                            class="w-full flex items-center gap-x-2 relative transition-all hover:text-foreground py-2"
                            x-bind:class="open ? 'text-foreground' : 'text-muted'" x-on:click="open = !open">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M3 9a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 9Zm0 6.75a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-semibold text-xs"><?php echo $first_level_item->title; ?></span>
                            <span class="absolute left-3" x-bind:class="open ? 'rotate-180' : ''">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                                </svg>
                            </span>
                        </button>
                        <ul class="flex flex-col relative before:content-[''] before:absolute before:inset-y-3 before:right-3 before:w-px before:bg-zinc-200 dark:before:bg-zinc-900 py-3 pr-5"
                            x-show="open">
                            
                            <?php foreach ($first_level_item->children as $second_level_item): ?>
                                
                                <?php if (!empty($second_level_item->children)): ?>
                                    <!-- آیتم سطح دوم با زیرمنو -->
                                    <li x-data="{ openChild: false }">
                                        <button type="button"
                                            class="w-full flex items-center gap-x-2 bg-transparent rounded-xl text-zinc-400 transition-all group/nav-item hover:text-black dark:hover:text-white py-2 px-3"
                                            x-on:click="openChild = !openChild">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4"
                                                x-bind:class="openChild ? '-rotate-45' : ''">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 19.5 8.25 12l7.5-7.5"></path>
                                            </svg>
                                            <span class="font-medium text-xs"><?php echo $second_level_item->title; ?></span>
                                        </button>
                                        <ul class="flex flex-col relative before:content-[''] before:absolute before:inset-y-3 before:right-3 before:w-px before:bg-zinc-200 dark:before:bg-zinc-900 py-3 pr-5"
                                            x-show="openChild">
                                            
                                            <?php foreach ($second_level_item->children as $third_level_item): ?>
                                                <li>
                                                    <a href="<?php echo $third_level_item->url; ?>"
                                                        class="w-full flex items-center gap-x-2 bg-transparent rounded-xl text-zinc-400 transition-all group/nav-item hover:text-black dark:hover:text-white py-2 px-3">
                                                        <span
                                                            class="inline-flex w-2 h-px bg-zinc-200 dark:bg-zinc-800 transition-all group-hover/nav-item:w-4 group-hover/nav-item:bg-black dark:group-hover/nav-item:bg-white"></span>
                                                        <span class="font-medium text-xs"><?php echo $third_level_item->title; ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                            
                                        </ul>
                                    </li>
                                <?php else: ?>
                                    <!-- آیتم سطح دوم بدون زیرمنو -->
                                    <li>
                                        <a href="<?php echo $second_level_item->url; ?>"
                                            class="w-full flex items-center gap-x-2 bg-transparent rounded-xl text-zinc-400 transition-all group/nav-item hover:text-black dark:hover:text-white py-2 px-3">
                                            <span
                                                class="inline-flex w-2 h-px bg-zinc-200 dark:bg-zinc-800 transition-all group-hover/nav-item:w-4 group-hover/nav-item:bg-black dark:group-hover/nav-item:bg-white"></span>
                                            <span class="font-medium text-xs"><?php echo $second_level_item->title; ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                            <?php endforeach; ?>
                            
                        </ul>
                    </li>
                <?php else: ?>
                    <!-- آیتم ساده بدون زیرمنو -->
                    <li>
                        <a href="<?php echo $first_level_item->url; ?>"
                            class="w-full flex items-center gap-x-2 relative text-muted transition-all hover:text-foreground py-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z">
                                </path>
                            </svg>
                            <span class="font-semibold text-xs"><?php echo $first_level_item->title; ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                
            <?php endforeach; ?>
        <?php else: ?>
            <!-- پیام در صورت عدم وجود منو -->
            <li>
                <div class="w-full flex items-center justify-center py-4">
                    <span class="text-muted text-xs">منوی موبایل تنظیم نشده است</span>
                </div>
            </li>
        <?php endif; ?>
        
    </ul>
</div>