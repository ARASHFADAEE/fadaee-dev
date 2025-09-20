<?php get_header()?>


        <main class="flex-auto py-5">
            <div class="max-w-7xl space-y-14 px-4 mx-auto">
                <div class="space-y-8">
                    <!-- section:title -->
                    <div class="flex items-center gap-5 bg-gradient-to-l from-secondary to-background rounded-2xl p-5">
                        <span
                            class="flex items-center justify-center w-12 h-12 bg-primary text-primary-foreground rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <div class="flex flex-col space-y-2">
                            <span class="font-black xs:text-2xl text-lg text-primary">فرانت اند</span>
                            <span class="font-semibold text-xs text-muted">از گوشه و اطراف دنیای برنامه‌نویسی</span>
                        </div>
                    </div>
                    <!-- end section:title -->

                    <div class="grid md:grid-cols-12 grid-cols-1 items-start gap-5">
                        <div class="md:block hidden lg:col-span-3 md:col-span-4 md:sticky md:top-24">
                            <div class="w-full flex flex-col space-y-3 mb-5">
                                <span class="font-bold text-sm text-foreground">جستجو مقالات</span>
                                <form action="#">
                                    <div class="flex items-center relative">
                                        <input type="text"
                                            class="form-input w-full !ring-0 !ring-offset-0 h-10 bg-secondary !border-0 rounded-xl text-sm text-foreground"
                                            placeholder="عنوان مقاله..">
                                        <span class="absolute left-3 text-muted">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="w-5 h-5">
                                                <path fill-rule="evenodd"
                                                    d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <div class="w-full flex flex-col space-y-5">
                                <span class="font-bold text-sm text-foreground">تگ های محبوب</span>
                                <ul class="flex flex-wrap gap-3">
                                    <li>
                                        <a href="#"
                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                            # لاراول
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                            # طراحی_وب
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                            # جاوااسکریپت
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                            # php
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                            # ریکت
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                            # وردپرس
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                            # فلاتر
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                            # تیلویند
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                            # برنامه نویسی
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                            # متفرقه
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- accordion:container -->
                            <div class="flex flex-col divide-y divide-border">
                                <!-- accordion -->
                                <div class="w-full space-y-2 py-3" x-data="{ open: false }">
                                    <!-- accordion:button -->
                                    <button type="button"
                                        class="w-full h-11 flex items-center justify-between gap-x-2 relative bg-secondary rounded-2xl transition hover:text-primary px-3"
                                        x-bind:class="open ? 'text-primary' : 'text-foreground'"
                                        x-on:click="open = !open">
                                        <span class="flex items-center gap-x-2">
                                            <span class="flex-shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                                                </svg>
                                            </span>
                                            <span class="font-semibold text-sm text-right">دسته بندی مقالات</span>
                                        </span>
                                        <span class="" x-bind:class="open ? 'rotate-180' : ''">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </span>
                                    </button><!-- end accordion:button -->

                                    <!-- accordion:content -->
                                    <div class="bg-secondary rounded-2xl relative p-3" x-show="open">
                                        <div class="space-y-2">
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" name="category"
                                                    class="form-radio !ring-0 !ring-offset-0 bg-border border-0" />
                                                <span class="text-sm text-muted">لاراول</span>
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" name="category"
                                                    class="form-radio !ring-0 !ring-offset-0 bg-border border-0" />
                                                <span class="text-sm text-muted">وردپرس</span>
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" name="category"
                                                    class="form-radio !ring-0 !ring-offset-0 bg-border border-0" />
                                                <span class="text-sm text-muted">جاوااسکریپت</span>
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" name="category"
                                                    class="form-radio !ring-0 !ring-offset-0 bg-border border-0" />
                                                <span class="text-sm text-muted">اندروید</span>
                                            </label>
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="radio" name="category"
                                                    class="form-radio !ring-0 !ring-offset-0 bg-border border-0" />
                                                <span class="text-sm text-muted">پایتون</span>
                                            </label>
                                        </div>
                                    </div><!-- end accordion:content -->
                                </div><!-- accordion -->
                            </div><!-- end accordion:container -->
                        </div>

                        <div class="lg:col-span-9 md:col-span-8">
                            <!-- sort & filter(offcanvas) -->
                            <div class="flex items-center gap-3 mb-3" x-data="{ offcanvasOpen: false }">
                                <!-- sort -->
                                <div
                                    x-data="{ range: function(start, end) { return Array(end - start + 1).fill().map((_, idx) => start + idx) } }">
                                    <!-- form:select container -->
                                    <div class="flex items-center gap-3">
                                        <!-- form:select:label -->
                                        <label
                                            class="sm:flex hidden items-center gap-1 font-semibold text-xs text-muted">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="w-5 h-5">
                                                <path
                                                    d="M10 3.75a2 2 0 1 0-4 0 2 2 0 0 0 4 0ZM17.25 4.5a.75.75 0 0 0 0-1.5h-5.5a.75.75 0 0 0 0 1.5h5.5ZM5 3.75a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 .75.75ZM4.25 17a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5h1.5ZM17.25 17a.75.75 0 0 0 0-1.5h-5.5a.75.75 0 0 0 0 1.5h5.5ZM9 10a.75.75 0 0 1-.75.75h-5.5a.75.75 0 0 1 0-1.5h5.5A.75.75 0 0 1 9 10ZM17.25 10.75a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5h1.5ZM14 10a2 2 0 1 0-4 0 2 2 0 0 0 4 0ZM10 16.25a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z" />
                                            </svg>
                                            مرتب سازی:
                                        </label><!-- end form:select:label -->

                                        <!-- form:select -->
                                        <div class="w-52 relative"
                                            x-data="{ open: false, selectedOption: 'انتخاب کنید', selectedValue: '', options: ['جدید‌ترین', 'در حال برگزاری', 'تکمیل ضبط‌', 'دوره‌های خریداری شده', 'در حال مشاهده', 'قدیمی‌ترین'] }">

                                            <!-- The selected value is stored in this input. -->
                                            <input type="hidden" x-model="selectedValue" />

                                            <!-- form:select:button -->
                                            <button x-on:click="open = !open"
                                                class="flex items-center w-full h-11 relative bg-secondary rounded-2xl font-semibold text-xs text-foreground px-4">
                                                <span class="line-clamp-1" x-text="selectedOption"></span>
                                                <span class="absolute left-3 pointer-events-none transition-transform"
                                                    x-bind:class="open ? 'rotate-180' : ''">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </span>
                                            </button><!-- end form:select:button -->

                                            <!-- form:select:options container -->
                                            <div class="absolute w-full bg-background rounded-2xl shadow-lg overflow-hidden mt-2 z-30"
                                                x-show="open" x-on:click.away="open = false">
                                                <ul class="max-h-48 overflow-y-auto">
                                                    <template x-for="(month, index) in options" :key="index">
                                                        <!-- form:select option -->
                                                        <li class="font-medium text-xs text-foreground cursor-pointer hover:bg-secondary px-4 py-3"
                                                            x-on:click="selectedOption = month; selectedValue = (index + 1).toString(); open = false"
                                                            x-text="month"></li><!-- end form:select:option -->
                                                    </template>
                                                </ul>
                                            </div><!-- end form:select:options container -->
                                        </div><!-- end form:select -->
                                    </div><!-- end form:select container -->
                                </div>
                                <!-- end sort -->

                                <!-- filter:offcanvas:button -->
                                <button type="button"
                                    class="md:hidden flex items-center gap-1 h-11 bg-secondary rounded-2xl text-foreground px-4"
                                    x-on:click="offcanvasOpen = true">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                                    </svg>
                                    <span class="hidden sm:block font-semibold text-xs">فیلتر مقالات</span>
                                </button>
                                <!-- end filter:offcanvas:button -->

                                <!-- filter:offcanvas -->
                                <div x-cloak>
                                    <!-- offcanvas:box -->
                                    <div class="fixed inset-y-0 right-0 xs:w-80 w-72 h-full bg-background rounded-l-2xl overflow-y-auto transition-transform z-50"
                                        x-bind:class="offcanvasOpen ? '!translate-x-0' : 'translate-x-full'">

                                        <!-- offcanvas:header -->
                                        <div
                                            class="flex items-center justify-between gap-x-4 sticky top-0 bg-background p-4 z-10">
                                            <div class="font-bold text-sm text-foreground">فیلتر مقالات آموزشی</div>

                                            <!-- offcanvas:close-button -->
                                            <button x-on:click="offcanvasOpen = false"
                                                class="text-black dark:text-white focus:outline-none hover:text-red-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button><!-- end offcanvas:close-button -->
                                        </div><!-- end offcanvas header -->

                                        <!-- offcanvas:content -->
                                        <div class="p-4">
                                            <div class="w-full flex flex-col space-y-3 mb-5">
                                                <span class="font-bold text-sm text-foreground">جستجو مقالات</span>
                                                <form action="#">
                                                    <div class="flex items-center relative">
                                                        <input type="text"
                                                            class="form-input w-full !ring-0 !ring-offset-0 h-10 bg-secondary !border-0 rounded-xl text-sm text-foreground"
                                                            placeholder="عنوان مقاله..">
                                                        <span class="absolute left-3 text-muted">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor" class="w-5 h-5">
                                                                <path fill-rule="evenodd"
                                                                    d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="w-full flex flex-col space-y-5">
                                                <span class="font-bold text-sm text-foreground">تگ های محبوب</span>
                                                <ul class="flex flex-wrap gap-3">
                                                    <li>
                                                        <a href="#"
                                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                                            # لاراول
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                                            # طراحی_وب
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                                            # جاوااسکریپت
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                                            # php
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                                            # ریکت
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                                            # وردپرس
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                                            # فلاتر
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                                            # تیلویند
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                                            # برنامه نویسی
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="inline-flex items-center h-9 bg-secondary rounded-xl font-semibold text-xs text-muted transition-colors hover:text-primary px-4">
                                                            # متفرقه
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- accordion:container -->
                                            <div class="flex flex-col divide-y divide-border">
                                                <!-- accordion -->
                                                <div class="w-full space-y-2 py-3" x-data="{ open: false }">
                                                    <!-- accordion:button -->
                                                    <button type="button"
                                                        class="w-full h-11 flex items-center justify-between gap-x-2 relative bg-secondary rounded-2xl transition hover:text-primary px-3"
                                                        x-bind:class="open ? 'text-primary' : 'text-foreground'"
                                                        x-on:click="open = !open">
                                                        <span class="flex items-center gap-x-2">
                                                            <span class="flex-shrink-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-5 h-5">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                                                                </svg>
                                                            </span>
                                                            <span class="font-semibold text-sm text-right">دسته بندی
                                                                مقالات</span>
                                                        </span>
                                                        <span class="" x-bind:class="open ? 'rotate-180' : ''">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                            </svg>
                                                        </span>
                                                    </button><!-- end accordion:button -->

                                                    <!-- accordion:content -->
                                                    <div class="bg-secondary rounded-2xl relative p-3" x-show="open">
                                                        <div class="space-y-2">
                                                            <label class="flex items-center gap-2 cursor-pointer">
                                                                <input type="radio" name="category"
                                                                    class="form-radio !ring-0 !ring-offset-0 bg-border border-0" />
                                                                <span class="text-sm text-muted">لاراول</span>
                                                            </label>
                                                            <label class="flex items-center gap-2 cursor-pointer">
                                                                <input type="radio" name="category"
                                                                    class="form-radio !ring-0 !ring-offset-0 bg-border border-0" />
                                                                <span class="text-sm text-muted">وردپرس</span>
                                                            </label>
                                                            <label class="flex items-center gap-2 cursor-pointer">
                                                                <input type="radio" name="category"
                                                                    class="form-radio !ring-0 !ring-offset-0 bg-border border-0" />
                                                                <span class="text-sm text-muted">جاوااسکریپت</span>
                                                            </label>
                                                            <label class="flex items-center gap-2 cursor-pointer">
                                                                <input type="radio" name="category"
                                                                    class="form-radio !ring-0 !ring-offset-0 bg-border border-0" />
                                                                <span class="text-sm text-muted">اندروید</span>
                                                            </label>
                                                            <label class="flex items-center gap-2 cursor-pointer">
                                                                <input type="radio" name="category"
                                                                    class="form-radio !ring-0 !ring-offset-0 bg-border border-0" />
                                                                <span class="text-sm text-muted">پایتون</span>
                                                            </label>
                                                        </div>
                                                    </div><!-- end accordion:content -->
                                                </div><!-- accordion -->
                                            </div><!-- end accordion:container -->
                                        </div><!-- end offcanvas:content -->
                                    </div><!-- end offcanvas:box -->

                                    <!-- offcanvas:overlay -->
                                    <div class="fixed inset-0 bg-black/10 dark:bg-white/10 cursor-pointer transition-all duration-1000 z-40"
                                        x-bind:class="offcanvasOpen ? 'opacity-100 visible' : 'opacity-0 invisible'"
                                        x-on:click="offcanvasOpen = false"></div><!-- end offcanvas:overlay -->
                                </div><!-- end filter:offcanvas -->
                            </div>

                            <!-- articles:wrapper -->
                            <div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-x-5 gap-y-10">
                                <!-- article:card -->
                                <div class="relative bg-background rounded-xl shadow-xl shadow-black/5 p-4">
                                    <div class="relative mb-3 z-20">
                                        <a href="./article-detail.html" class="block">
                                            <img src="./assets/images/courses/01.jpg" class="max-w-full rounded-xl"
                                                alt="..." />
                                        </a>
                                        <button type="button"
                                            class="absolute left-3 -bottom-3 w-9 h-9 inline-flex items-center justify-center bg-secondary rounded-full shadow-xl text-muted transition-colors hover:text-red-500 z-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="w-5 h-5">
                                                <path
                                                    d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="relative space-y-3 z-10">
                                        <h2 class="font-bold text-sm">
                                            <a href="./article-detail.html"
                                                class="line-clamp-1 text-foreground transition-colors hover:text-primary">دوره
                                                پروژه محور React و Next</a>
                                        </h2>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-1">
                                                <div
                                                    class="flex-shrink-0 w-8 h-8 border border-white rounded-full overflow-hidden">
                                                    <img src="./assets/images/avatars/01.jpeg"
                                                        class="w-full h-full object-cover" alt="...">
                                                </div>
                                                <a href="./lecturer.html"
                                                    class="line-clamp-1 font-bold text-xs text-foreground transition-colors hover:text-primary">جلال
                                                    بهرامی راد</a>
                                            </div>
                                            <a href="./article-category.html"
                                                class="bg-primary/10 rounded-full text-primary transition-all hover:opacity-80 py-1 px-4">
                                                <span class="font-bold text-xxs">فرانت اند</span>
                                            </a>
                                        </div>
                                        <div class="flex justify-end">
                                            <div class="flex items-center gap-1 text-muted">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <span class="font-semibold text-xs text-muted">زمان مطالعه:</span>
                                                <span class="font-semibold text-xs text-foreground">۲۰ دقیقه</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end article:card -->

                                <!-- article:card -->
                                <div class="relative bg-background rounded-xl shadow-xl shadow-black/5 p-4">
                                    <div class="relative mb-3 z-20">
                                        <a href="./article-detail.html" class="block">
                                            <img src="./assets/images/courses/02.jpg" class="max-w-full rounded-xl"
                                                alt="..." />
                                        </a>
                                        <button type="button"
                                            class="absolute left-3 -bottom-3 w-9 h-9 inline-flex items-center justify-center bg-secondary rounded-full shadow-xl text-muted transition-colors hover:text-red-500 z-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="w-5 h-5">
                                                <path
                                                    d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="relative space-y-3 z-10">
                                        <h2 class="font-bold text-sm">
                                            <a href="./article-detail.html"
                                                class="line-clamp-1 text-foreground transition-colors hover:text-primary">دوره
                                                پروژه محور React و Next</a>
                                        </h2>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-1">
                                                <div
                                                    class="flex-shrink-0 w-8 h-8 border border-white rounded-full overflow-hidden">
                                                    <img src="./assets/images/avatars/01.jpeg"
                                                        class="w-full h-full object-cover" alt="...">
                                                </div>
                                                <a href="./lecturer.html"
                                                    class="line-clamp-1 font-bold text-xs text-foreground transition-colors hover:text-primary">جلال
                                                    بهرامی راد</a>
                                            </div>
                                            <a href="./article-category.html"
                                                class="bg-primary/10 rounded-full text-primary transition-all hover:opacity-80 py-1 px-4">
                                                <span class="font-bold text-xxs">فرانت اند</span>
                                            </a>
                                        </div>
                                        <div class="flex justify-end">
                                            <div class="flex items-center gap-1 text-muted">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <span class="font-semibold text-xs text-muted">زمان مطالعه:</span>
                                                <span class="font-semibold text-xs text-foreground">۲۰ دقیقه</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end article:card -->

                                <!-- article:card -->
                                <div class="relative bg-background rounded-xl shadow-xl shadow-black/5 p-4">
                                    <div class="relative mb-3 z-20">
                                        <a href="./article-detail.html" class="block">
                                            <img src="./assets/images/courses/03.jpg" class="max-w-full rounded-xl"
                                                alt="..." />
                                        </a>
                                        <button type="button"
                                            class="absolute left-3 -bottom-3 w-9 h-9 inline-flex items-center justify-center bg-secondary rounded-full shadow-xl text-muted transition-colors hover:text-red-500 z-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="w-5 h-5">
                                                <path
                                                    d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="relative space-y-3 z-10">
                                        <h2 class="font-bold text-sm">
                                            <a href="./article-detail.html"
                                                class="line-clamp-1 text-foreground transition-colors hover:text-primary">دوره
                                                پروژه محور React و Next</a>
                                        </h2>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-1">
                                                <div
                                                    class="flex-shrink-0 w-8 h-8 border border-white rounded-full overflow-hidden">
                                                    <img src="./assets/images/avatars/01.jpeg"
                                                        class="w-full h-full object-cover" alt="...">
                                                </div>
                                                <a href="./lecturer.html"
                                                    class="line-clamp-1 font-bold text-xs text-foreground transition-colors hover:text-primary">جلال
                                                    بهرامی راد</a>
                                            </div>
                                            <a href="./article-category.html"
                                                class="bg-primary/10 rounded-full text-primary transition-all hover:opacity-80 py-1 px-4">
                                                <span class="font-bold text-xxs">فرانت اند</span>
                                            </a>
                                        </div>
                                        <div class="flex justify-end">
                                            <div class="flex items-center gap-1 text-muted">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <span class="font-semibold text-xs text-muted">زمان مطالعه:</span>
                                                <span class="font-semibold text-xs text-foreground">۲۰ دقیقه</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end article:card -->

                                <!-- article:card -->
                                <div class="relative bg-background rounded-xl shadow-xl shadow-black/5 p-4">
                                    <div class="relative mb-3 z-20">
                                        <a href="./article-detail.html" class="block">
                                            <img src="./assets/images/courses/04.jpg" class="max-w-full rounded-xl"
                                                alt="..." />
                                        </a>
                                        <button type="button"
                                            class="absolute left-3 -bottom-3 w-9 h-9 inline-flex items-center justify-center bg-secondary rounded-full shadow-xl text-muted transition-colors hover:text-red-500 z-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="w-5 h-5">
                                                <path
                                                    d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="relative space-y-3 z-10">
                                        <h2 class="font-bold text-sm">
                                            <a href="./article-detail.html"
                                                class="line-clamp-1 text-foreground transition-colors hover:text-primary">دوره
                                                پروژه محور React و Next</a>
                                        </h2>
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-1">
                                                <div
                                                    class="flex-shrink-0 w-8 h-8 border border-white rounded-full overflow-hidden">
                                                    <img src="./assets/images/avatars/01.jpeg"
                                                        class="w-full h-full object-cover" alt="...">
                                                </div>
                                                <a href="./lecturer.html"
                                                    class="line-clamp-1 font-bold text-xs text-foreground transition-colors hover:text-primary">جلال
                                                    بهرامی راد</a>
                                            </div>
                                            <a href="./article-category.html"
                                                class="bg-primary/10 rounded-full text-primary transition-all hover:opacity-80 py-1 px-4">
                                                <span class="font-bold text-xxs">فرانت اند</span>
                                            </a>
                                        </div>
                                        <div class="flex justify-end">
                                            <div class="flex items-center gap-1 text-muted">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <span class="font-semibold text-xs text-muted">زمان مطالعه:</span>
                                                <span class="font-semibold text-xs text-foreground">۲۰ دقیقه</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end article:card -->
                            </div>
                            <!-- end articles:wrapper -->

                            <div class="flex justify-center mt-8">
                                <!-- load more:button -->
                                <button type="button"
                                    class="h-11 inline-flex items-center justify-center gap-1 bg-secondary rounded-full text-primary px-8">
                                    <span class="font-semibold text-sm">در حال بارگذاری</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-5 h-5 animate-spin">
                                        <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                                    </svg>
                                </button>
                                <!-- end load more:button -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>



<?php get_footer()?>