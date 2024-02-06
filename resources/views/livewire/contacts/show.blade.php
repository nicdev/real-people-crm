<x-slot:title>
    {{ $title }}
</x-slot>
<div>
    <livewire:shared.nav />

    @session('message')
        @include('shared.success', ['message' => session('message')])
    @endsession
    <nav class="pb-4">
        <span class="my-4 mr-2">
            <span class="my-4 mr-2">
                <button wire:click="$toggle('showContactForm')"
                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 mr-2 border border-blue-500 hover:border-transparent rounded">
                    Edit</button>
            </span>
            <span class="my-4 mr-2">
            <button wire:click="$toggle('showContactEventModal')"
                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 mr-2 border border-blue-500 hover:border-transparent rounded">
                New Contact Event</button>
            </span>
            <span class="my-4 mr-2">
            <button wire:click="augmentWithLinkedIn"
                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 mr-2 border border-blue-500 hover:border-transparent rounded">
                Augment with LinkedIn</button>
            </span>
            {{-- <button
                class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 mr-2 border border-red-500 hover:border-transparent rounded"
                wire:click="delete"
                wire:confirm="Are you sure you want to delete {{ $contact->first_name }}?">Delete</button> --}}
        </span>
    </nav>
    <h1 class="text-xl font-semibold my-4 flex justify-left items-center">
        <img class="h-12 w-12 rounded-full mr-2 object-cover"
            src="{{ $contact->photo ?? gravatar($contact->email) }}"
            alt="">
        {{ $contact->first_name }}{{ $contact->middle_name ? ' ' . substr($contact->middle_name, 0, 1) : '' }}
        {{ $contact->last_name }}
    </h1>

    <livewire:contact-events.next-follow_up :contact="$contact" />

    <h2 class="text-lg mb-2 font-semibold">Recent Contact Events</h2>

    <livewire:contact-events.index :contact="$contact" />

    <h2 class="text-lg mb-2 font-semibold">Contact Information</h2>
    <div>

        <div class="mt-6 border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
            <dl class="grid grid-cols-1 sm:grid-cols-2">
                <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Preferred Contact Method</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                        {{ $contact->preferredContactMethod->name }}
                    </dd>
                </div>
                @if ($contact->email)
                    <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Email address</dt>
                        <dd class="flex justify-left items-center mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                            <span id="email">{{ $contact->email }}</span><livewire:shared.copy-to-clipboard
                                elementId="email">
                        </dd>
                    </div>
                @endif
                @if ($contact->linkedin)
                    <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">LinkedIn</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><a href="{{ $contact->linkedin }}" target="_blank">{{ $contact->linkedin }}</a></dd>
                    </div>
                @endif
                @if ($contact->phone)
                    <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Phone</dt>
                        <dd class="flex justify-left items-center mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                            <span id="phone">{{ $contact->phone }}</span>
                            <livewire:shared.copy-to-clipboard elementId="phone">
                        </dd>
                    </div>
                @endif
                @if ($contact->website)
                    <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Website</dt>
                        <dd class="flex justify-left items-center mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><a
                                href="{{ $contact->website }}"
                                target="_blank">{{ $contact->website }}</a>
                        </dd>
                    </div>
                @endif
                @if ($contact->twitter)
                    @php
                        $twitterParts = explode('/', $contact->twitter);
                    @endphp
                    <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">X/Twitter</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><a
                                href="{{ $contact->twitter }}"
                                target="_blank">{{ '@'.array_pop($twitterParts) }}</a></dd>
                    </div>
                @endif
                @if ($contact->threads)
                    <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">Threads</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><a
                                href="https://www.threads.net/@{{ $contact - > threads }}"
                                target="_blank">{{ $contact->threads }}</a></dd>
                    </div>
                @endif
                @if ($contact->youtube)
                    <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">YouTube</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><a href="{{ $contact->youtube }}"
                                target="_blank">{{ $contact->youtube }}</a></dd>
                    </div>
                @endif
                @if($contact->general_notes)
                <div class="px-4 py-6 sm:col-span-2 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">General Notes</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ $contact->general_notes }}</dd>
                </div>
                @endif
            </dl>
        </div>

    <livewire:contacts.modal :showModal="$showContactForm"
        :contact="$contact"
        @contactcreatedorupdated="$refresh" />
    </div>
    <livewire:contact-events.modal :contact="$contact"  :showModal="$showContactEventModal"/>
    

</div>
