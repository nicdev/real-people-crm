<div class="relative z-10 {{ $showModal ? '' : 'hidden' }}"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 w-full sm:max-w-sm sm:p-6">
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
                <div class="mt-6">
                    <form wire:submit="sendIntroduction">
                        <select wire:model.live="first_contact"
                            name="first_contact"
                            class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="">Select Contact</option>
                            @foreach ($contacts as $c)
                                <option value="{{ $c->id }}"
                                    wire:key="first-{{ $c->id }}">{{ $c->first_name }} {{ $c->middle_name }}
                                    {{ $c->last_name }}</option>
                            @endforeach
                        </select>
                        <select wire:model.live="second_contact"
                            name="second_contact"
                            class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="">Select Contact</option>
                            @foreach ($contacts as $c)
                                <option value="{{ $c->id }}"
                                    wire:key="second-{{ $c->id }}">{{ $c->first_name }} {{ $c->middle_name }}
                                    {{ $c->last_name }}</option>
                            @endforeach
                        </select>
                        <div class="mt-4 p-2 bg-gray-200 rounded-md">
                            <div class="flex justify-end">
                                <button wire:click.prevent="toggleEditIntro"
                                    title="Edit the message">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-6 h-6">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </button>
                                
                                <button wire:click.prevent="resetIntroMessage"
                                    title="Reset to default">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-6 h-6">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m15 15-6 6m0 0-6-6m6 6V9a6 6 0 0 1 12 0v3" />
                                    </svg>
                                </button>
                                
                            </div>
                            @if (!$editIntro)
                                {!! $introduction !!}
                            @else
                                <textarea wire:model="introduction"
                                    class="w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    rows="5"></textarea>
                            @endif
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit"
                                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 mr-2 border border-blue-500 hover:border-transparent rounded w-full">Send
                                Introduction</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
