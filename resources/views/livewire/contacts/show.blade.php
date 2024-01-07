<div>
    <livewire:shared.nav>
        <nav>
            <button
                        wire:click="$dispatch('openModal', {component: 'contact-events.modal', arguments: {{ json_encode(['contact' => $contact->id]) }} })"
                        class="relative ml-3 inline-flex items-center rounded-md bg-white hover:bg-indigo-400 hover:text-gray-100 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-indigo-400">New Contact Event with {{ $contact->first_name }}</button>
        </nav>
        {{-- <livewire:shared.actions> --}}
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900">{{ $contact->name }}</h3>
            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">{{ $contact->first_name }} @if ($contact->company)
                    at {{ $contact->company }}
                @endif
            </p>
        </div>
        @if ($contact->contactEvents->count() > 0)
            <div class="mt-6 border-t border-gray-100">
                @foreach ($contact->contactEvents as $ce)
                    Display contact event here {{ $ce }}
                @endforeach
            </div>
        @endif
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Full name</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $contact->first_name }}
                        {{ $contact->middle_name ? substr($contact->middle_name, 0, 1) . '.' : '' }}
                        {{ $contact->last_name }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Email</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $contact->email }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">X/Twitter</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $contact->twitter }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Phone</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $contact->phone }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Preferred contact method</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ $contact->preferred_contact_method }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">General notes</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ $contact->general_notes }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Threads</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $contact->threads }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Website</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $contact->website }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Youtube</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $contact->youtube }}</dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Linkedin</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $contact->linkedin }}
                    </dd>
                </div>
                <div>
                    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Attachments</dt>
                        <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            <ul role="list"
                                class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                    <div class="flex w-0 flex-1 items-center">
                                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                            <span class="truncate font-medium">resume_back_end_developer.pdf</span>
                                            <span class="flex-shrink-0 text-gray-400">2.4mb</span>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="#"
                                            class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                                    </div>
                                </li>
                                <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                    <div class="flex w-0 flex-1 items-center">
                                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                            <span class="truncate font-medium">coverletter_back_end_developer.pdf</span>
                                            <span class="flex-shrink-0 text-gray-400">4.5mb</span>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-shrink-0">
                                        <a href="#"
                                            class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                                    </div>
                                </li>
                            </ul>
                        </dd>
                    </div>
            </dl>
        </div>
</div>
