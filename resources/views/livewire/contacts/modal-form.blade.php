<div>
    <form wire:submit="store">
        <div class="form-group">
            <label class="block text-sm font-medium leading-6 text-gray-900" for="first_name">Name</label>
            <input wire:model="form.first_name"
                type="text"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                id="name"
                placeholder="Enter name">
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="block text-sm font-medium leading-6 text-gray-900" for="middle_name">Middle Name</label>
            <input wire:model="form.middle_name"
                type="text"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                id="middle_name"
                placeholder="Enter middle name">
            @error('middle_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="block text-sm font-medium leading-6 text-gray-900" for="last_name">Last Name</label>
            <input wire:model="form.last_name"
                type="text"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                id="last_name"
                placeholder="Enter last name">
            @error('last_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="block text-sm font-medium leading-6 text-gray-900" for="phone">Phone</label>
            <input wire:model="form.phone"
                type="text"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                id="phone"
                placeholder="Enter phone">
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="block text-sm font-medium leading-6 text-gray-900" for="email">Email</label>
            <input wire:model="form.email"
                type="text"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                id="email"
                placeholder="Enter email">
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="block text-sm font-medium leading-6 text-gray-900" for="linkedin">LinkedIn</label>
            <input wire:model="form.linkedin"
                type="text"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                id="linkedin"
                placeholder="Enter linkedin">
            @error('linkedin')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="block text-sm font-medium leading-6 text-gray-900" for="twitter">Twitter/X</label>
            <input wire:model="form.twitter"
                type="text"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                id="twitter"
                placeholder="Enter twitter">
            @error('twitter')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="block text-sm font-medium leading-6 text-gray-900" for="youtube">YouTube</label>
            <input wire:model="form.youtube"
                type="text"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                id="youtube"
                placeholder="Enter youtube">
            @error('youtube')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="form-group">
                <label class="block text-sm font-medium leading-6 text-gray-900" for="website">Website</label>
                <input wire:model="form.website"
                    type="text"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    id="website"
                    placeholder="Enter website">
                @error('website')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label class="block text-sm font-medium leading-6 text-gray-900" for="preferred_contact_method">Preferred Contact Method</label>
                    <select wire:model="form.preferred_contact_method"
                        class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        id="preferred_contact_method">
                        @foreach ($contact_methods as $cm)
                            <option value="{{ $cm->id }}">{{ $cm->name }}</option>
                        @endforeach
                    </select>
                    @error('preferred_contact_method')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <livewire:companies.select />
                <div class="form-group">
                    <label class="block text-sm font-medium leading-6 text-gray-900" for="general_notes">General Notes</label>
                    <textarea wire:model="form.general_notes"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        id="general_notes"
                        rows="3"></textarea>
                    @error('general_notes')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="btn btn-primary">Submit</button>
    </form>
</div>
