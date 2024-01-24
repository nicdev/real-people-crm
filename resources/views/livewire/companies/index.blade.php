<div>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <livewire:shared.nav />
    <nav class="my-4">
        <span class="my-4 mr-2">
            <button wire:click="$toggle('showCompanyForm')"
                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 mr-2 border border-blue-500 hover:border-transparent rounded">
                New Company</button>
        </span>
        @session('message')
            @include('shared.success', ['message' => session('message')])
        @endsession
    </nav>
    @foreach ($companies as $c)
        <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6"
            wire:key="{{ $c->id }}">
            <div class="-ml-4 -mt-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
                <div class="ml-4 mt-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            @if ($c->logo)
                                <img class="h-12 w-12 rounded-full"
                                    src="src="{{ $c->logo }}"
                                    alt="">
                            @else
                                <span class="no-photo">{{ substr($c->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="ml-4">
                            <a href="{{ route('companies.show', $c) }}">
                                <h3 class="text-base font-semibold leading-6 text-gray-900">{{ $c->name }}</h3>
                            </a>
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
                    @if ($c->website)
                        <a type="button"
                            href="{{ $c->website }}"
                            class="relative ml-3 inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd"
                                    d="M19 10a9 9 0 11-18 0 9 9 0 0118 0zm-9 7a7 7 0 110-14 7 7 0 010 14z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Website</span>
                        </a>
                    @endif
                    @if ($c->linkedin)
                        <a type="button"
                            href="{{ $c->linkedin }}"
                            class="relative ml-3 inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true">
                                <path
                                    d="M17.5 3h-15A1.5 1.5 0 001 4.5v15A1.5 1.5 0 002.5 21h15a1.5 1.5 0 001.5-1.5v-15A1.5 1.5 0 0017.5 3zM7 18H4v-8h3v8zm-1.5-9.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm11.5 9.5h-3v-4.73c0-1.1-.9-2-2-2s-2 .9-2 2V18h-3v-8h3v1.27c.6-.9 1.7-1.5 3-1.5 2.2 0 4 1.8 4 4V18z" />
                            </svg>
                            <span>Linkedin</span>
                        </a>
                    @endif
                    @if ($c->twitter)
                        <a type="button"
                            href="{{ $c->twitter }}"
                            class="relative ml-3 inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true">
                                <path
                                    d="M17.5 3h-15A1.5 1.5 0 001 4.5v15A1.5 1.5 0 002.5 21h15a1.5 1.5 0 001.5-1.5v-15A1.5 1.5 0 0017.5 3zM7 18H4v-8h3v8zm-1.5-9.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm11.5 9.5h-3v-4.73c0-1.1-.9-2-2-2s-2 .9-2 2V18h-3v-8h3v1.27c.6-.9 1.7-1.5 3-1.5 2.2 0 4 1.8 4 4V18z" />
                            </svg>
                            <span>Twitter</span>
                        </a>
                    @endif
                    @if ($c->youtube)
                        <a type="button"
                            href="{{ $c->youtube }}"
                            class="relative ml-3 inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true">
                                <path
                                    d="M17.5 3h-15A1.5 1.5 0 001 4.5v15A1.5 1.5 0 002.5 21h15a1.5 1.5 0 001.5-1.5v-15A1.5 1.5 0 0017.5 3zM7 18H4v-8h3v8zm-1.5-9.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm11.5 9.5h-3v-4.73c0-1.1-.9-2-2-2s-2 .9-2 2V18h-3v-8h3v1.27c.6-.9 1.7-1.5 3-1.5 2.2 0 4 1.8 4 4V18z" />
                            </svg>
                            <span>Youtube</span>
                        </a>
                    @endif
                    <livewire:companies.delete :company="$c" />
                </div>
            </div>

        </div>
    @endforeach

    <livewire:companies.modal :show-modal="$showCompanyForm" />
</div>
