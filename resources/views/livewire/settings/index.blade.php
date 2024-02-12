<x-slot:title>
    {{ $title }}
</x-slot>
<div>
    <livewire:shared.nav />

    @session('message')
        @include('shared.success', ['message' => session('message')])
    @endsession

    <div class="container mx-auto p-4">
        <form wire:submit="updateUser">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block text-sm font-medium leading-6 text-gray-900"
                        for="name">Name</label>
                    <input wire:model.blur="name"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        id="name"
                        type="text"
                        placeholder="Full Name">
                    @error('name')
                        @include('shared.form-error', ['errorMessage' => $message])
                    @enderror
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="email">
                        Email
                    </label>
                    <input wire:model.blur="email"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        id="email"
                        type="text"
                        placeholder="you@email.com">
                    @error('email')
                        @include('shared.form-error', ['errorMessage' => $message])
                    @enderror
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6 justify-left items-center">
                <div class="w-full px-3">
                    <button type="submit" class="bg-transparent font-semibold hover:text-white py-2 px-4 mr-2 border hover:border-transparent rounded text-blue-700 border-blue-500  hover:bg-blue-500">
                        Save Settings
                    </button>

                    {{-- @if(! auth()->user()->google_id || ! auth()->user()->google_token)
                    <button wire:click="connectToGoogle" class="bg-transparent font-semibold hover:text-white py-2 px-4 mr-2 border hover:border-transparent rounded text-blue-700 border-blue-500  hover:bg-blue-500">
                        Connect to Google
                    </button>
                    </a>
                    @endif --}}

                    <button wire:click="deleteUser" wire:confirm="Your account and all associated data will be deleted" class="bg-transparent font-semibold hover:text-white py-2 px-4 mr-2 border hover:border-transparent rounded text-red-700 border-red-500  hover:bg-red-500">
                        Delete Account
                    </button>
                </div>
            </div>
            
        </form>
    </div>

</div>
