<x-slot:title>
    {{ $title }}
</x-slot>
<div>
    <livewire:shared.nav>

        @session('message')
            @include('shared.success', ['message' => session('message')])
        @endsession
        <nav class="pb-4">
            <span class="my-4 mr-2">
                <button wire:click="$toggle('showCompanyForm')"
                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 mr-2 border border-blue-500 hover:border-transparent rounded">
                    Edit</button>
                <button wire:click="$toggle('showContactForm')"
                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 mr-2 border border-blue-500 hover:border-transparent rounded">
                    New Contact</button>
                <button
                    class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 mr-2 border border-red-500 hover:border-transparent rounded"
                    wire:click="delete"
                    wire:confirm="Are you sure you want to delete {{ $company->name }}?">Delete</button>
            </span>
        </nav>
        <h1 class="text-xl font-semibold my-4 flex justify-left items-center">
            @if ($company->logo)
                <img class="h-12 w-12 rounded-full mr-2"
                    src="{{ $company->logo }}"
                    alt="">
            @endif
            {{ $company->name }}
        </h1>

        <h2 class="text-lg mb-2 font-semibold">Contacts at {{ $company->name }}</h2>

        @forelse ($company->contacts as $c)
            <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6"
                wire:key="{{ $c->id }}">
                <div class="-ml-4 -mt-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
                    <div class="ml-4 mt-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <img class="h-12 w-12 rounded-full"
                                    src="{{ $c->photo ?? gravatar($c->email) }}"
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
                            wire:click="removeFromCompany({{ $c->id }})"
                            wire:confirm="Are you sure you want to remove {{ $c->first_name }} from {{ $company->name }} ?">Remove
                            From Company</button>
                    </div>
                </div>
            </div>
        @empty
            <p>No contacts at this company yet.</p>
        @endforelse

        <h2 class="text-lg mb-2 mt-4 font-semibold">Company Information</h2>
        <div>
            <div class="mt-6 border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 sm:grid-cols-2">
                    @if ($company->website)
                        <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Website</dt>
                            <dd class="flex justify-left items-center mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                                <a href="{{ $company->website }}"
                                    target="_blank">{{ $company->website }}</a>
                            </dd>
                        </div>
                    @endif
                    @if ($company->phone)
                        <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Phone</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2 flex justify-left items-center">
                                <span id="phone">{{ $company->phone }}</span><livewire:shared.copy-to-clipboard
                                    elementId="phone"></dd>
                        </div>
                    @endif
                    @if ($company->address)
                        <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Address</dt>
                            <dd class="flex justify-left items-center mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                                <span id="address">
                                    {{ $company->address }}<br>
                                    {{ $company->city }}, {{ $company->state }} {{ $company->zip }}<br>
                                    {{ $company->country }}
                                </span <livewire:shared.copy-to-clipboard elementId="address">
                            </dd>
                        </div>
                    @endif
                    @if ($company->industry)
                        <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Industry</dt>
                            <dd class="flex justify-left items-center mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                                {{ $contact->industry }}
                            </dd>
                        </div>
                    @endif
                    @if ($company->linkedin)
                        <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">LinkedIn</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><a
                                    href="https://x.com/{{ $company->linkedin }}"
                                    target="_blank">@{{ $company - > linkedin }}</a></dd>
                        </div>
                    @endif
                    @if ($company->twitter)
                        <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">X/Twitter</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><a
                                    href="https://x.com/{{ $company->twitter }}"
                                    target="_blank">{{ '@' . $company->twitter }}</a></dd>
                        </div>
                    @endif
                    @if ($company->threads)
                        <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">Threads</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><a
                                    href="https://www.threads.net/{{ '@' . $company->threads }}"
                                    target="_blank">{{ $company->threads }}</a></dd>
                        </div>
                    @endif
                    @if ($company->youtube)
                        <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                            <dt class="text-sm font-medium leading-6 text-gray-900">YouTube</dt>
                            <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2"><a href="{{ $company->youtube }}"
                                    target="_blank">{{ $company->youtube }}</a></dd>
                        </div>
                    @endif
                    <div class="px-4 py-6 sm:col-span-2 sm:px-0">
                        <dt class="text-sm font-medium leading-6 text-gray-900">General Notes</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ $company->notes }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <livewire:companies.modal :show-modal="$showCompanyForm"
            :company="$company"
            @companycreatedorupdated="$refresh" />
        <livewire:shared.modal component="contacts.modal"
            :show-modal="$showContactForm"
            :company="$company" />

</div>
