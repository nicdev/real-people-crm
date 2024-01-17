<div>
    <livewire:shared.nav>

        @session('message')
            @include('shared.success', ['message' => session('message')])
        @endsession
        <nav class="pb-4">
            <span class="my-4 mr-2">
                <button wire:click="$toggle('showContactForm')"
                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 mr-2 border border-blue-500 hover:border-transparent rounded">
                    Edit</button>
                <button wire:click="$toggle('showContactEventModal')"
                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 mr-2 border border-blue-500 hover:border-transparent rounded">
                    New Contact Event</button>
                <button
                    class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 mr-2 border border-red-500 hover:border-transparent rounded"
                    wire:click="delete"
                    wire:confirm="Are you sure you want to delete {{ $contact->first_name }}?">Delete</button>
            </span>
        </nav>
        <h1 class="text-xl font-semibold my-4 flex justify-left items-center">
                            <img class="h-12 w-12 rounded-full mr-2"
                                src="{{ $contact->photo ?? gravatar($contact->email) }}"
                                alt="">
                         {{ $contact->first_name }}{{ $contact->middle_name ? ' ' . substr($contact->middle_name, 0, 1) : '' }}
                    {{ $contact->last_name }}</h1>
        
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
                                {{ $contact->email }}
                                <livewire:shared.copy-to-clipboard elementId="email">
                            </dd>
                        </div>
                    @endif
                    @if ($contact->linkedin)
                        <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">LinkedIn</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ $contact->linkedin }}</dd>
                        </div>
                    @endif
                    @if ($contact->phone)
                        <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Phone</dt>
                            <dd class="flex justify-left items-center mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                                {{ $contact->phone }}
                                <livewire:shared.copy-to-clipboard elementId="phone">
                            </dd>
                        </div>
                    @endif
                    @if ($contact->website)
                        <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Phone</dt>
                            <dd class="flex justify-left items-center mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><a
                                    href="{{ $contact->website }}"
                                    target="_blank">{{ $contact->website }}</a>
                            </dd>
                        </div>
                    @endif
                    @if ($contact->twitter)
                        <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">X/Twitter</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><a
                                    href="https://x.com/{{ $contact->twitter }}"
                                    target="_blank">{{ $contact->twitter }}</a></dd>
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
                    <div class="px-4 py-6 sm:col-span-2 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">General Notes</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ $contact->general_notes }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        @if ($showContactEventModal)
            <livewire:contact-events.modal :contact="$contact" />
        @endif
        
        <livewire:shared.modal component="contacts.modal"
            :show-modal="$showContactForm"
            :model="$contact" 
            @contactcreatedorupdated="$refresh"/>

</div>
