<div class="absolute inset-x-4 hidden lg:flex flex-col h-full bg-background dark:bg-gray-900 transition-all"
                    x-bind:class="openSearchBox ? 'top-0' : '-top-full'">
                    <!-- Search Form - Fixed Height -->
                    <div class="flex-shrink-0 py-4">
                        <form>
                            <div class="flex items-center relative">
                                <input type="text" id="ajax-search-form"
                                    class="form-input w-full !ring-0 !ring-offset-0 bg-background dark:bg-gray-800 border-0 focus:border-0 text-foreground dark:text-white h-12 placeholder:text-gray-500 dark:placeholder:text-gray-400"
                                    placeholder="نام دوره،مقاله و یا دسته بندی را وارد نمایید.." />
                                <button type="button"
                                    class="absolute left-0 inline-flex items-center justify-center w-9 h-9 bg-secondary dark:bg-gray-700 rounded-full text-muted dark:text-gray-300 transition-colors hover:text-red-500 dark:hover:text-red-400"
                                    x-on:click="openSearchBox = false; document.getElementById('search-results').innerHTML = ''; document.getElementById('ajax-search-form').value = '';">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Search Results - Flexible Height -->
                    <div class="flex-1 min-h-0">
                        <div id="search-results" class="h-full overflow-y-auto bg-background dark:bg-gray-900 rounded-lg"></div>
                    </div>
                </div>