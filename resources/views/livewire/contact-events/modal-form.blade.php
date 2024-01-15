<div class="relative z-10"
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
                    wire:click="$dispatch('modal-closed')"
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

                <h2>{{ $this->title }}<h2>
                        <form wire:submit="store">
                            @empty($contact)
                                <livewire:contacts.select :contacts="auth()->user()->contacts" />
                            @endempty
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="block text-sm font-medium leading-6 text-gray-900"
                                        for="date">Date</label>
                                    <input wire:model="date"
                                        type="date"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        id="date">
                                    @error('date')
                                        @include('shared.form-error', ['errorMessage' => $message])
                                    @enderror
                                </div>
                                <div class="form-group">

                                    <label class="block text-sm font-medium leading-6 text-gray-900"
                                        for="contact_method_id">Contact Method</label>
                                    <select wire:model.live="contact_method_id"
                                        class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        id="contact_method_id">
                                        @foreach ($contact_methods as $cm)
                                            <option value="{{ $cm->id }}" wire:key="{{ $cm->id }}">{{ $cm->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('preferred_contact_method')
                                        @include('shared.form-error', ['errorMessage' => $message])
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="block text-sm font-medium leading-6 text-gray-900"
                                        for="general_notes">Recap</label>
                                    <textarea wire:model="general_notes"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        id="general_notes"
                                        rows="3"></textarea>
                                    @error('general_notes')
                                        @include('shared.form-error', ['errorMessage' => $message])
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="btn btn-primary">Submit</button>
                        </form>
            </div>
        </div>
    </div>
</div>
