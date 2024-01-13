<div class="relative z-10 {{ $showModal ? '' : 'hidden' }}"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                <!-- Close button -->
                <button type="button"
                    wire:click="closeModal"
                    class="absolute top-0 right-0 mt-4 mr-4 mb-4 rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <!-- Modal content -->
                @if ($showModal)
                    <!-- edit model form -->
                    @if($model)
                    <livewire:dynamic-component :component="$component" :model="$model" />
                    <!-- new model form -->
                    @else
                    <livewire:dynamic-component :component="$component" />
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
