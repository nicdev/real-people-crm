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
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
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
                <div class="w-full p-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="introduction">
                        Default Introduction Message
                    </label>
                    <textarea wire:model.live.debounce.300ms="introduction"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        id="introduction"
                        rows="5"
                        placeholder="Leave blank to use the default message or create your own"></textarea>
                    <button wire:click.prevent="appendToIntroduction('FIRST_CONTACT_FIRST_NAME')"
                        class="rounded-full mt-2 bg-green-400 px-2.5 py-1 text-xs font-semibold text-white shadow-sm hover:bg-green-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">FIRST_CONTACT_FIRST_NAME</button>
                    <button wire:click.prevent="appendToIntroduction('FIRST_CONTACT_LAST_NAME')"
                        class="rounded-full mt-2 bg-green-400 px-2.5 py-1 text-xs font-semibold text-white shadow-sm hover:bg-green-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">FIRST_CONTACT_LAST_NAME</button>
                    <button wire:click.prevent="appendToIntroduction('SECOND_CONTACT_FIRST_NAME')"
                        class="rounded-full mt-2 bg-green-400 px-2.5 py-1 text-xs font-semibold text-white shadow-sm hover:bg-green-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">SECOND_CONTACT_FIRST_NAME</button>
                    <button wire:click.prevent="appendToIntroduction('SECOND_CONTACT_LAST_NAME')"
                        class="rounded-full mt-2 bg-green-400 px-2.5 py-1 text-xs font-semibold text-white shadow-sm hover:bg-green-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">SECOND_CONTACT_LAST_NAME</button>
                    @error('introduction')
                        @include('shared.form-error', ['errorMessage' => $message])
                    @enderror

                </div>
                <div class="flex flex-wrap -mx-3 mb-6 justify-left items-center px-3">
                    <div class="w-full px-3">
                        <button type="submit"
                            class="bg-transparent font-semibold hover:text-white py-2 px-4 mr-2 border hover:border-transparent rounded text-blue-700 border-blue-500  hover:bg-blue-500">
                            Save Settings
                        </button>

                        {{-- @if (!auth()->user()->google_id || !auth()->user()->google_token)
                    <button wire:click="connectToGoogle" class="bg-transparent font-semibold hover:text-white py-2 px-4 mr-2 border hover:border-transparent rounded text-blue-700 border-blue-500  hover:bg-blue-500">
                        Connect to Google
                    </button>
                    </a>
                    @endif --}}

                        <button wire:click="deleteUser"
                            wire:confirm="Your account and all associated data will be deleted"
                            class="bg-transparent font-semibold hover:text-white py-2 px-4 mr-2 border hover:border-transparent rounded text-red-700 border-red-500  hover:bg-red-500">
                            Delete Account
                        </button>
                    </div>
                </div>
        </form>
    </div>
    @script
        <script>
            $wire.on('append-to-introduction', (data) => {
                const textarea = document.getElementById('introduction');
                const startPos = textarea.selectionStart;
                const endPos = textarea.selectionEnd;
                const currentValue = textarea.value;
                const newValue = `${currentValue.substring(0, startPos)} ${data[0].trim()} ${currentValue.substring(endPos)}`;
                textarea.value = newValue;
                $wire.set('introduction', newValue);
                textarea.focus();
                textarea.selectionStart = startPos + data[0].length + 2;
                textarea.selectionEnd = startPos + data[0].length + 2;
            });
        </script>
    @endscript
</div>
