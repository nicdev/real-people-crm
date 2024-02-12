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
                <div>
                    <form wire:submit="store">
                        <div class="form-group">
                            <label class="block text-sm font-medium leading-6 text-gray-900"
                                for="first_name">Name</label>
                            @error('form.first_name')
                                @include('shared.form-error', ['errorMessage' => $message])
                            @enderror
                            <input wire:model.blur="form.first_name"
                                type="text"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                id="first_name"
                                placeholder="Enter name">
                        </div>
                        @if ($editMode)
                            <div class="form-group">
                                <label class="block text-sm font-medium leading-6 text-gray-900"
                                    for="middle_name">Middle Name</label>
                                @error('form.middle_name')
                                    @include('shared.form-error', ['errorMessage' => $message])
                                @enderror
                                <input wire:model.blur="form.middle_name"
                                    type="text"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    id="middle_name"
                                    placeholder="Enter middle name">

                            </div>
                        @endif
                        <div class="form-group">
                            <label class="block text-sm font-medium leading-6 text-gray-900"
                                for="last_name">Last Name</label>
                            @error('form.last_name')
                                @include('shared.form-error', ['errorMessage' => $message])
                            @enderror
                            <input wire:model.blur="form.last_name"
                                type="text"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                id="last_name"
                                placeholder="Enter last name">

                        </div>

                        <div class="form-group">
                            <label class="block text-sm font-medium leading-6 text-gray-900"
                                for="email">Email</label>
                            @error('form.email')
                                @include('shared.form-error', ['errorMessage' => $message])
                            @enderror
                            <input wire:model.blur="form.email"
                                type="text"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                id="email"
                                placeholder="Enter email">

                        </div>
                        @if ($editMode)
                            <div class="form-group">
                                <label class="block text-sm font-medium leading-6 text-gray-900"
                                    for="phone">Phone</label>
                                @error('form.phone')
                                    @include('shared.form-error', ['errorMessage' => $message])
                                @enderror
                                <input wire:model.blur="form.phone"
                                    type="text"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    id="phone"
                                    placeholder="Enter phone">

                            </div>
                            <livewire:companies.select :company_id="$form->company_id ?? 0" />
                            <div class="form-group">
                                <label class="block text-sm font-medium leading-6 text-gray-900"
                                    for="follow_up_date">Follow Up Date</label>
                                @error('form.follow_up_date')
                                    @include('shared.form-error', ['errorMessage' => $message])
                                @enderror
                                <input wire:model.blur="form.follow_up_date"
                                    type="date"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    id="follow_up_date"
                                    placeholder="">

                            </div>
                            <div class="form-group">
                                <label class="block text-sm font-medium leading-6 text-gray-900"
                                    for="frequency">Contact Frequency (in days)</label>
                                @error('form.frequency')
                                    @include('shared.form-error', ['errorMessage' => $message])
                                @enderror
                                <input wire:model.blur="form.frequency"
                                    type="number"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    id="frequency"
                                    placeholder="">

                            </div>
                            <div class="form-group">
                                <label class="block text-sm font-medium leading-6 text-gray-900"
                                    for="preferred_contact_method">Preferred Contact Method</label>
                                @error('form.preferred_contact_method')
                                    @include('shared.form-error', ['errorMessage' => $message])
                                @enderror
                                <select wire:model.blur="form.preferred_contact_method"
                                    class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    id="preferred_contact_method">
                                    @foreach ($contact_methods as $cm)
                                        <option value="{{ $cm->id }}"
                                            wire:key="{{ $cm->id }}">{{ $cm->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        @endif

                        <div class="form-group">
                            <label class="block text-sm font-medium leading-6 text-gray-900"
                                for="linkedin">LinkedIn</label>
                            @error('form.linkedin')
                                @include('shared.form-error', ['errorMessage' => $message])
                            @enderror
                            <input wire:model.blur="form.linkedin"
                                type="text"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                id="linkedin"
                                placeholder="Enter linkedin">

                        </div>
                        @if ($editMode)
                            <div class="form-group">
                                <label class="block text-sm font-medium leading-6 text-gray-900"
                                    for="twitter">Twitter/X</label>
                                @error('form.twitter')
                                    @include('shared.form-error', ['errorMessage' => $message])
                                @enderror
                                <input wire:model.blur="form.twitter"
                                    type="text"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    id="twitter"
                                    placeholder="Enter twitter">

                            </div>
                            <div class="form-group">
                                <label class="block text-sm font-medium leading-6 text-gray-900"
                                    for="youtube">YouTube</label>
                                @error('form.youtube')
                                    @include('shared.form-error', ['errorMessage' => $message])
                                @enderror
                                <input wire:model.blur="form.youtube"
                                    type="text"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    id="youtube"
                                    placeholder="Enter youtube">
                            </div>
                            <div class="form-group">
                                <label class="block text-sm font-medium leading-6 text-gray-900"
                                    for="website">Website</label>
                                @error('form.website')
                                    @include('shared.form-error', ['errorMessage' => $message])
                                @enderror
                                <input wire:model.blur="form.website"
                                    type="text"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    id="website"
                                    placeholder="Enter website">
                            </div>
                            <div class="form-group">
                                <label class="block text-sm font-medium leading-6 text-gray-900"
                                    for="general_notes">General Notes</label>
                                @error('form.general_notes')
                                    @include('shared.form-error', ['errorMessage' => $message])
                                @enderror
                                <textarea wire:model.blur="form.general_notes"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    id="general_notes"
                                    rows="3"></textarea>
                            </div>
                        @endif
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
