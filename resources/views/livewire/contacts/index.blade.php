<div>
    <livewire:shared.nav />

    
        @session('message')
            @include('shared.success', ['message' => session('message')])
        @endsession
    

    <nav class="my-4">
        <span class="my-4 mr-2">
            <button wire:click="$toggle('showContactForm')"
                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 mr-2 border border-blue-500 hover:border-transparent rounded">
                New Contact</button>
        </span>
        <span class="my-4 mr-2">
            <button type="button"
                wire:click="importFromGoogle"
                class="bg-transparent hover:bg-blue-500 font-semibold hover:text-white py-2 px-4 mr-2 border hover:border-transparent rounded {{ $importingContacts ? 'text-blue-400 border-blue-200  hover:bg-blue-100' : 'text-blue-700 border-blue-500  hover:bg-blue-500' }}"
                {{ $importingContacts ? 'disabled' : '' }}>
                Import Contacts From Google</button>
        </span>
        @if ($importingContacts)
            <span>Import in progress. You will be notified via email upon completion.</span>
        @endif
    </nav>

    @foreach ($contacts as $c)
        <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6"
            wire:key="{{ $c->id }}">
            <div class="-ml-4 -mt-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
                <div class="ml-4 mt-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full"
                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                alt="">
                        </div>
                        <div class="ml-4">
                            <a href="{{ route('contacts.show', $c) }}">
                                <h3 class="text-base font-semibold leading-6 text-gray-900">{{ $c->first_name }}
                                    {{ $c->middle_name ? substr($c->middle_name, 0, 1) . '.' : '' }}
                                    {{ $c->last_name }}</h3>
                            </a>
                            <p class="text-sm text-gray-500">
                                @if ($c->title)
                                    {{ $c->title }}
                                    @endif @if ($c->company)
                                        at {{ $c->company }}
                                    @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="ml-4 mt-4 flex flex-shrink-0">
                    @if ($c->phone)
                        <a type="button"
                            href="tel:{{ $c->phone }}"
                            class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Phone</span>
                        </a>
                    @endif
                    @if ($c->email)
                        <a type="button"
                            href="mailto:{{ $c->email }}"
                            class="relative ml-3 inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true">
                                <path
                                    d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                <path
                                    d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                            </svg>
                            <span>Email</span>
                        </a>
                    @endif
                    <button
                        class="relative ml-3 inline-flex items-center rounded-md bg-white hover:bg-red-500 hover:text-gray-100 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-red-500"
                        wire:click="delete"
                        wire:confirm="Are you sure you want to delete {{ $c->first_name }}?">Delete</button>
                </div>
            </div>
        </div>
    @endforeach
    {{ $contacts->links() }}

    <livewire:shared.modal component="contacts.modal"
        :show-modal="$showContactForm" />
</div>
