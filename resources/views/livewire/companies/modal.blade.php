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
                <div>
                    <form wire:submit="store">
                        <div class="mb-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900"
                                for="name"
                                class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                            <input wire:model="name"
                                type="text"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                id="name"
                                placeholder="Enter name">
                            @error('name')
                                @include('shared.form-error', ['errorMessage' => $message])
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900"
                                for="website">Website</label>
                            <input wire:model="website"
                                type="text"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                id="website"
                                placeholder="Enter website">
                            @error('website')
                                @include('shared.form-error', ['errorMessage' => $message])
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900"
                                for="phone"
                                class="block text-sm font-medium leading-6 text-gray-900">Phone</label>
                            <input wire:model="phone"
                                type="text"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                id="phone"
                                placeholder="Enter phone">
                            @error('phone')
                                @include('shared.form-error', ['errorMessage' => $message])
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900"
                                for="linkedin">LinkedIn</label>
                            <input wire:model="linkedin"
                                type="text"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                id="linkedin"
                                placeholder="Enter linkedin">
                            @error('linkedin')
                                @include('shared.form-error', ['errorMessage' => $message])
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900"
                                for="twitter">Twitter/X</label>
                            <input wire:model="twitter"
                                type="text"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                id="twitter"
                                placeholder="Enter twitter">
                            @error('twitter')
                                @include('shared.form-error', ['errorMessage' => $message])
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900"
                                for="youtube">YouTube</label>
                            <input wire:model="youtube"
                                type="text"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                id="youtube"
                                placeholder="Enter youtube">
                            @error('youtube')
                                @include('shared.form-error', ['errorMessage' => $message])
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900"
                                for="notes">General Notes</label>
                            <textarea wire:model="notes"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                id="notes"
                                rows="3"></textarea>
                            @error('notes')
                                @include('shared.form-error', ['errorMessage' => $message])
                            @enderror
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit"
                                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 mr-2 border border-blue-500 hover:border-transparent rounded w-full">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
