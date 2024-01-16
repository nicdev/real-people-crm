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
        <livewire:companies.select />
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
        @if ($editMode)
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
