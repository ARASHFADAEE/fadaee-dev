                <div class="absolute inset-x-4 hidden lg:flex flex-col h-full bg-background transition-all"
                    x-bind:class="openSearchBox ? 'top-0' : '-top-full'">
                    <form action="#" class="h-full">
                        <div class="flex items-center h-full relative">
                            <input type="text"
                                class="form-input w-full !ring-0 !ring-offset-0 bg-background border-0 focus:border-0 text-foreground"
                                placeholder="نام دوره،مقاله و یا دسته بندی را وارد نمایید.." />
                            <button type="button"
                                class="absolute left-0 inline-flex items-center justify-center w-9 h-9 bg-secondary rounded-full text-muted transition-colors hover:text-red-500"
                                x-on:click="openSearchBox = false">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                </svg>
                            </button>

                        </div>
                    </form>
                </div>