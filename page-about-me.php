<?php get_header()?>

<main class="min-h-screen bg-background dark:bg-slate-900 text-foreground dark:text-slate-50">
    <div class="container mx-auto px-4 py-8 sm:py-12 lg:py-16 max-w-6xl">
        
        <!-- Hero Section -->
        <div class="text-center mb-12 lg:mb-20">
            <div class="relative inline-block mb-6 lg:mb-8">
                <img src="<?php echo get_template_directory_uri()?>/assets/images/arash-removebg-preview.png" 
                     alt="آرش فدایی - توسعه‌دهنده وردپرس" 
                     class="w-32 h-32 sm:w-40 sm:h-40 lg:w-48 lg:h-48 rounded-full object-cover mx-auto border-4 border-blue-200 dark:border-blue-500/30 hover:border-blue-400 dark:hover:border-blue-500/50 transition-all duration-300">
                <div class="absolute -bottom-2 -right-2 w-8 h-8 sm:w-10 sm:h-10 bg-green-500 rounded-full border-4 border-white dark:border-slate-900 flex items-center justify-center animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 sm:w-5 sm:h-5 text-white">
                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <h1 class="font-black text-3xl sm:text-4xl lg:text-5xl xl:text-6xl text-slate-900 dark:text-slate-50 mb-4 lg:mb-6">
                آرش فدایی
            </h1>
            <p class="text-lg sm:text-xl lg:text-2xl text-slate-600 dark:text-slate-400 mb-6 lg:mb-8 max-w-3xl mx-auto leading-relaxed">
                توسعه‌دهنده حرفه‌ای وردپرس با تخصص در طراحی قالب و توسعه افزونه
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-3 sm:gap-4">
                <a href="#contact" 
                   class="inline-flex items-center justify-center gap-2 h-12 sm:h-14 bg-blue-500 hover:bg-blue-600 rounded-full text-white transition-all px-6 sm:px-8 font-semibold text-sm sm:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path d="M3 4a2 2 0 0 0-2 2v1.161l8.441 4.221a1.25 1.25 0 0 0 1.118 0L19 7.162V6a2 2 0 0 0-2-2H3Z"></path>
                        <path d="m19 8.839-7.77 3.885a2.75 2.75 0 0 1-2.46 0L1 8.839V14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8.839Z"></path>
                    </svg>
                    تماس با من
                </a>
                <a href="<?php echo home_url('shop')?>" 
                   class="inline-flex items-center justify-center gap-2 h-12 sm:h-14 bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-600 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-full text-slate-900 dark:text-slate-50 transition-all px-6 sm:px-8 font-semibold text-sm sm:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M6 5v1H4.667a1.75 1.75 0 0 0-1.743 1.598l-.826 9.5A1.75 1.75 0 0 0 3.84 19H16.16a1.75 1.75 0 0 0 1.743-1.902l-.826-9.5A1.75 1.75 0 0 0 15.333 6H14V5a4 4 0 0 0-8 0Zm4-2.5A2.5 2.5 0 0 0 7.5 5v1h5V5A2.5 2.5 0 0 0 10 2.5Z" clip-rule="evenodd"></path>
                    </svg>
                    مشاهده محصولات
                </a>
            </div>
        </div>

        <!-- Skills & Expertise -->
        <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl lg:rounded-3xl p-6 sm:p-8 lg:p-10 mb-8 sm:mb-12 lg:mb-16 border border-slate-200 dark:border-slate-700">
            <div class="text-center mb-8 lg:mb-12">
                <h2 class="font-black text-2xl sm:text-3xl lg:text-4xl text-slate-900 dark:text-slate-50 mb-4">مهارت‌ها و تخصص‌ها</h2>
                <p class="text-slate-600 dark:text-slate-400 text-base sm:text-lg lg:text-xl max-w-3xl mx-auto leading-relaxed">
                    با بیش از ۵ سال تجربه در توسعه وردپرس، آماده ارائه بهترین راه‌حل‌های تکنیکی برای کسب و کار شما هستم
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                <div class="bg-white dark:bg-slate-800 rounded-xl sm:rounded-2xl p-4 sm:p-6 space-y-3 sm:space-y-4 border border-slate-200 dark:border-slate-700 hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-500/50 transition-all">
                    <div class="flex items-center gap-3">
                        <span class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                                <path d="M3.25 4A2.25 2.25 0 0 0 1 6.25v7.5A2.25 2.25 0 0 0 3.25 16h7.5A2.25 2.25 0 0 0 13 13.75v-7.5A2.25 2.25 0 0 0 10.75 4h-7.5ZM19 4.75a.75.75 0 0 0-1.28-.53l-3 3a.75.75 0 0 0-.22.53v4.5c0 .199.079.39.22.53l3 3a.75.75 0 0 0 1.28-.53V4.75Z"></path>
                            </svg>
                        </span>
                        <h3 class="font-bold text-base sm:text-lg text-slate-900 dark:text-slate-50">طراحی قالب سفارشی</h3>
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base leading-relaxed">
                        طراحی و توسعه قالب‌های اختصاصی مطابق با نیاز کسب و کار شما
                    </p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl sm:rounded-2xl p-4 sm:p-6 space-y-3 sm:space-y-4 border border-slate-200 dark:border-slate-700 hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-500/50 transition-all">
                    <div class="flex items-center gap-3">
                        <span class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-green-100 dark:bg-green-500/20 text-green-600 dark:text-green-400 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                                <path d="M12 4.467c0-.405.262-.75.559-1.027.276-.257.441-.584.441-.94 0-.828-.895-1.5-2-1.5s-2 .672-2 1.5c0 .362.171.694.456.953.29.265.544.6.544.994a.968.968 0 0 1-1.024.974 39.655 39.655 0 0 1-3.014-.306.75.75 0 0 0-.847.847c.14.993.242 1.999.306 3.014A.968.968 0 0 1 4.447 10c-.393 0-.729-.253-.994-.544C3.194 9.17 2.862 9 2.5 9 1.672 9 1 9.895 1 11s.672 2 1.5 2c.356 0 .683-.165.94-.441.276-.297.622-.559 1.027-.559a.997.997 0 0 1 1.004 1.03 39.747 39.747 0 0 1-.319 3.734.75.75 0 0 0 .64.842c1.05.146 2.111.252 3.184.318A.97.97 0 0 0 10 16.948c0-.394-.254-.73-.545-.995C9.171 15.693 9 15.362 9 15c0-.828.895-1.5 2-1.5s2 .672 2 1.5c0 .356-.165.683-.441.94-.297.276-.559.622-.559 1.027a.998.998 0 0 0 1.03 1.005c1.337-.05 2.659-.162 3.961-.337a.75.75 0 0 0 .644-.644c.175-1.302.288-2.624.337-3.961A.998.998 0 0 0 16.967 12c-.405 0-.75.262-1.027.559-.257.276-.584.441-.94.441-.828 0-1.5-.895-1.5-2s.672-2 1.5-2c.362 0 .694.17.953.455.265.291.601.545.995.545a.97.97 0 0 0 .976-1.024 41.159 41.159 0 0 0-.318-3.184.75.75 0 0 0-.842-.64c-1.228.164-2.473.271-3.734.319A.997.997 0 0 1 12 4.467Z"></path>
                            </svg>
                        </span>
                        <h3 class="font-bold text-base sm:text-lg text-slate-900 dark:text-slate-50">توسعه افزونه</h3>
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base leading-relaxed">
                        ساخت افزونه‌های کاربردی برای بهبود عملکرد و قابلیت‌های سایت
                    </p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl sm:rounded-2xl p-4 sm:p-6 space-y-3 sm:space-y-4 border border-slate-200 dark:border-slate-700 hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-500/50 transition-all">
                    <div class="flex items-center gap-3">
                        <span class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-purple-100 dark:bg-purple-500/20 text-purple-600 dark:text-purple-400 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                                <path d="M10.75 16.82A7.462 7.462 0 0 1 15 15.5c.71 0 1.396.098 2.046.282A.75.75 0 0 0 18 15.06v-11a.75.75 0 0 0-.546-.721A9.006 9.006 0 0 0 15 3a8.963 8.963 0 0 0-4.25 1.065V16.82ZM9.25 4.065A8.963 8.963 0 0 0 5 3c-.85 0-1.673.118-2.454.339A.75.75 0 0 0 2 4.06v11a.75.75 0 0 0 .954.721A7.506 7.506 0 0 1 5 15.5c1.579 0 3.042.487 4.25 1.32V4.065Z"></path>
                            </svg>
                        </span>
                        <h3 class="font-bold text-base sm:text-lg text-slate-900 dark:text-slate-50">بهینه‌سازی سئو</h3>
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base leading-relaxed">
                        بهینه‌سازی سایت برای موتورهای جستجو و افزایش رتبه در گوگل
                    </p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl sm:rounded-2xl p-4 sm:p-6 space-y-3 sm:space-y-4 border border-slate-200 dark:border-slate-700 hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-500/50 transition-all">
                    <div class="flex items-center gap-3">
                        <span class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-orange-100 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                                <path fill-rule="evenodd" d="M6 5v1H4.667a1.75 1.75 0 0 0-1.743 1.598l-.826 9.5A1.75 1.75 0 0 0 3.84 19H16.16a1.75 1.75 0 0 0 1.743-1.902l-.826-9.5A1.75 1.75 0 0 0 15.333 6H14V5a4 4 0 0 0-8 0Zm4-2.5A2.5 2.5 0 0 0 7.5 5v1h5V5A2.5 2.5 0 0 0 10 2.5Z" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <h3 class="font-bold text-base sm:text-lg text-slate-900 dark:text-slate-50">فروشگاه ووکامرس</h3>
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base leading-relaxed">
                        راه‌اندازی و سفارشی‌سازی فروشگاه‌های آنلاین با ووکامرس
                    </p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl sm:rounded-2xl p-4 sm:p-6 space-y-3 sm:space-y-4 border border-slate-200 dark:border-slate-700 hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-500/50 transition-all">
                    <div class="flex items-center gap-3">
                        <span class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-red-100 dark:bg-red-500/20 text-red-600 dark:text-red-400 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                                <path d="M3.505 2.365A41.369 41.369 0 0 1 9 2c1.863 0 3.697.124 5.495.365 1.247.167 2.18 1.108 2.435 2.268a4.45 4.45 0 0 0-.577-.069 43.141 43.141 0 0 0-4.706 0C9.229 4.696 7.5 6.727 7.5 8.998v2.24c0 1.413.67 2.735 1.76 3.562l-2.98 2.98A.75.75 0 0 1 5 17.25v-3.443c-.501-.048-1-.106-1.495-.172C2.033 13.438 1 12.162 1 10.72V5.28c0-1.441 1.033-2.717 2.505-2.914Z"></path>
                                <path d="M14 6c-.762 0-1.52.02-2.271.062C10.157 6.148 9 7.472 9 8.998v2.24c0 1.519 1.147 2.839 2.71 2.935.214.013.428.024.642.034.2.009.385.09.518.224l2.35 2.35a.75.75 0 0 0 1.28-.531v-2.07c1.453-.195 2.5-1.463 2.5-2.915V8.998c0-1.526-1.157-2.85-2.729-2.936A41.645 41.645 0 0 0 14 6Z"></path>
                            </svg>
                        </span>
                        <h3 class="font-bold text-base sm:text-lg text-slate-900 dark:text-slate-50">پشتیبانی و نگهداری</h3>
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base leading-relaxed">
                        پشتیبانی مداوم، آپدیت و نگهداری سایت‌های وردپرسی
                    </p>
                </div>
                
                <div class="bg-white dark:bg-slate-800 rounded-xl sm:rounded-2xl p-4 sm:p-6 space-y-3 sm:space-y-4 border border-slate-200 dark:border-slate-700 hover:shadow-lg hover:border-blue-300 dark:hover:border-blue-500/50 transition-all">
                    <div class="flex items-center gap-3">
                        <span class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-cyan-100 dark:bg-cyan-500/20 text-cyan-600 dark:text-cyan-400 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                                <path d="M10.75 16.82A7.462 7.462 0 0 1 15 15.5c.71 0 1.396.098 2.046.282A.75.75 0 0 0 18 15.06v-11a.75.75 0 0 0-.546-.721A9.006 9.006 0 0 0 15 3a8.963 8.963 0 0 0-4.25 1.065V16.82ZM9.25 4.065A8.963 8.963 0 0 0 5 3c-.85 0-1.673.118-2.454.339A.75.75 0 0 0 2 4.06v11a.75.75 0 0 0 .954.721A7.506 7.506 0 0 1 5 15.5c1.579 0 3.042.487 4.25 1.32V4.065Z"></path>
                            </svg>
                        </span>
                        <h3 class="font-bold text-base sm:text-lg text-slate-900 dark:text-slate-50">آموزش و مشاوره</h3>
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base leading-relaxed">
                        آموزش کار با وردپرس و مشاوره تکنیکی برای پروژه‌ها
                    </p>
                </div>
            </div>
        </div>

        <!-- Experience & Achievements -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 lg:gap-10 mb-8 sm:mb-12 lg:mb-16">
            <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl lg:rounded-3xl p-6 sm:p-8 lg:p-10 space-y-6 lg:space-y-8 border border-slate-200 dark:border-slate-700">
                <h2 class="font-black text-xl sm:text-2xl lg:text-3xl text-slate-900 dark:text-slate-50 flex items-center gap-3">
                    <span class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 0 0-4.5 4.5V9H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-.5V5.5A4.5 4.5 0 0 0 10 1Zm3 8V5.5a3 3 0 1 0-6 0V9h6Z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    تجربه و دستاوردها
                </h2>
                <div class="space-y-4 sm:space-y-6">
                    <div class="flex items-start gap-3 sm:gap-4">
                        <span class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 bg-green-100 dark:bg-green-500/20 text-green-600 dark:text-green-400 rounded-xl text-lg sm:text-xl font-bold border border-green-200 dark:border-green-500/30">5+</span>
                        <div class="flex-1">
                            <h4 class="font-semibold text-base sm:text-lg text-slate-900 dark:text-slate-50">سال تجربه</h4>
                            <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base">در توسعه وردپرس و ووکامرس</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 sm:gap-4">
                        <span class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-xl text-lg sm:text-xl font-bold border border-blue-200 dark:border-blue-500/30">50+</span>
                        <div class="flex-1">
                            <h4 class="font-semibold text-base sm:text-lg text-slate-900 dark:text-slate-50">پروژه موفق</h4>
                            <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base">قالب و افزونه تحویل داده شده</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 sm:gap-4">
                        <span class="flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 bg-purple-100 dark:bg-purple-500/20 text-purple-600 dark:text-purple-400 rounded-xl text-lg sm:text-xl font-bold border border-purple-200 dark:border-purple-500/30">100+</span>
                        <div class="flex-1">
                            <h4 class="font-semibold text-base sm:text-lg text-slate-900 dark:text-slate-50">مشتری راضی</h4>
                            <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base">از کیفیت محصولات و پشتیبانی</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl lg:rounded-3xl p-6 sm:p-8 lg:p-10 space-y-6 lg:space-y-8 border border-slate-200 dark:border-slate-700">
                <h2 class="font-black text-xl sm:text-2xl lg:text-3xl text-slate-900 dark:text-slate-50 flex items-center gap-3">
                    <span class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                            <path d="M10.75 16.82A7.462 7.462 0 0 1 15 15.5c.71 0 1.396.098 2.046.282A.75.75 0 0 0 18 15.06v-11a.75.75 0 0 0-.546-.721A9.006 9.006 0 0 0 15 3a8.963 8.963 0 0 0-4.25 1.065V16.82ZM9.25 4.065A8.963 8.963 0 0 0 5 3c-.85 0-1.673.118-2.454.339A.75.75 0 0 0 2 4.06v11a.75.75 0 0 0 .954.721A7.506 7.506 0 0 1 5 15.5c1.579 0 3.042.487 4.25 1.32V4.065Z"></path>
                        </svg>
                    </span>
                    تکنولوژی‌ها
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <div class="bg-white dark:bg-slate-800 rounded-lg p-3 sm:p-4 border border-slate-200 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-500/50 transition-all">
                        <span class="font-semibold text-sm sm:text-base text-slate-900 dark:text-slate-50">PHP & WordPress</span>
                    </div>
                    <div class="bg-white dark:bg-slate-800 rounded-lg p-3 sm:p-4 border border-slate-200 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-500/50 transition-all">
                        <span class="font-semibold text-sm sm:text-base text-slate-900 dark:text-slate-50">JavaScript & jQuery</span>
                    </div>
                    <div class="bg-white dark:bg-slate-800 rounded-lg p-3 sm:p-4 border border-slate-200 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-500/50 transition-all">
                        <span class="font-semibold text-sm sm:text-base text-slate-900 dark:text-slate-50">HTML5 & CSS3</span>
                    </div>
                    <div class="bg-white dark:bg-slate-800 rounded-lg p-3 sm:p-4 border border-slate-200 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-500/50 transition-all">
                        <span class="font-semibold text-sm sm:text-base text-slate-900 dark:text-slate-50">WooCommerce</span>
                    </div>
                    <div class="bg-white dark:bg-slate-800 rounded-lg p-3 sm:p-4 border border-slate-200 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-500/50 transition-all">
                        <span class="font-semibold text-sm sm:text-base text-slate-900 dark:text-slate-50">MySQL</span>
                    </div>
                    <div class="bg-white dark:bg-slate-800 rounded-lg p-3 sm:p-4 border border-slate-200 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-500/50 transition-all">
                        <span class="font-semibold text-sm sm:text-base text-slate-900 dark:text-slate-50">REST API</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div id="contact" class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl lg:rounded-3xl p-6 sm:p-8 lg:p-10 border border-slate-200 dark:border-slate-700">
            <div class="text-center space-y-4 sm:space-y-6">
                <h2 class="font-black text-2xl sm:text-3xl lg:text-4xl text-slate-900 dark:text-slate-50">بیایید همکاری کنیم</h2>
                <p class="text-slate-600 dark:text-slate-400 text-base sm:text-lg lg:text-xl max-w-2xl mx-auto leading-relaxed">
                    آماده همکاری در پروژه بعدی شما هستم. با من تماس بگیرید تا درباره نیازهای پروژه‌تان صحبت کنیم
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-3 sm:gap-4">
                    <a href="mailto:info@fadaee.dev" 
                       class="inline-flex items-center justify-center gap-2 h-12 sm:h-14 bg-primary hover:bg-primary/90 rounded-full text-primary-foreground transition-all px-6 sm:px-8 font-semibold text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path d="M3 4a2 2 0 0 0-2 2v1.161l8.441 4.221a1.25 1.25 0 0 0 1.118 0L19 7.162V6a2 2 0 0 0-2-2H3Z"></path>
                            <path d="m19 8.839-7.77 3.885a2.75 2.75 0 0 1-2.46 0L1 8.839V14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8.839Z"></path>
                        </svg>
                        ارسال ایمیل
                    </a>
                    <a href="<?php echo home_url('shop')?>" 
                       class="inline-flex items-center justify-center gap-2 h-12 sm:h-14 bg-background border-2 border-border hover:bg-muted/50 rounded-full text-foreground transition-all px-6 sm:px-8 font-semibold text-sm sm:text-base">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M6 5v1H4.667a1.75 1.75 0 0 0-1.743 1.598l-.826 9.5A1.75 1.75 0 0 0 3.84 19H16.16a1.75 1.75 0 0 0 1.743-1.902l-.826-9.5A1.75 1.75 0 0 0 15.333 6H14V5a4 4 0 0 0-8 0Zm4-2.5A2.5 2.5 0 0 0 7.5 5v1h5V5A2.5 2.5 0 0 0 10 2.5Z" clip-rule="evenodd"></path>
                        </svg>
                        مشاهده محصولات
                    </a>
                </div>
            </div>
        </div>

    </div>
</main>

<?php get_footer()?>
