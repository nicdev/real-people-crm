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
        {{-- <div class="mb-2">
            <label class="block text-sm font-medium leading-6 text-gray-900"
                for="email">Email</label>
            <input wire:model="email"
                type="text"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                id="email"
                placeholder="Enter email">
            @error('email')
                @include('shared.form-error', ['errorMessage' => $message])
            @enderror
        </div> --}}
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

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>

    </form>
</div>
