<div>
    <livewire:shared.nav />
    <h1 class="text-lg">Upcoming Follow Ups</h1>
     <div class="my-4 sm:w-auto w-full">
        <div class="relative mt-2 rounded-md shadow-sm">
            <input type="text"
                name="search"
                id="search"
                class="block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                placeholder="to filter start typing anything about your contact"
                wire:model.live="search">
        </div>
    </div>
    <div class="my-4">
        {{ $followUpList->links() }}
    </div>
    @forelse ($followUpList as $fu)
        <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6"
            wire:key="{{ $fu->id }}">
            <div class="-ml-4 -mt-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
                <div class="ml-4 mt-4">
                    <div class="flex items-center flex-wrap sm:flex-nowrap">
                        {{-- <div class="flex flex-wrap sm:flex-nowrap"> --}}
                        <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full object-cover"
                                src="{{ $fu->photo ?? gravatar($fu->email) }}"
                                alt="">
                        </div>
                        <div class="ml-4 flex flex-wrap sm:flex-nowrap">
                            <a href="{{ route('contacts.show', $fu) }}">
                                <h3 class="text-base font-semibold leading-6 text-gray-900">{{ $fu->first_name }}
                                    {{ $fu->middle_name ? substr($fu->middle_name, 0, 1) . '.' : '' }}
                                    {{ $fu->last_name }}</h3>
                            </a>
                            {{-- <p class="text-sm text-gray-500">
                                @if ($fu->title)
                                    {{ $fu->title }} at 
                                    @endif @if ($fu->company)
                                        {{ $fu->company->name }}
                                    @endif
                            </p> --}}
                        </div>

                        <div class="ml-4">
                            <p class="text-sm text-gray-500 flex justify-left items-center">
                                Follow up on {{ $fu->follow_up_date->format('M d, Y') }}
                                @if ($fu->follow_up_date <= now()->subDays(1))
                                    <span
                                        class="inline-flex items-center rounded-full bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20 ml-2">overdue</span>
                                    </svg>
                                @elseif ($fu->follow_up_date->format('Y-m-d') === now()->format('Y-m-d'))
                                <span
                                        class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-800 ring-1 ring-inset ring-green-600/20 ml-2">today</span>
                                    </svg>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 ml-4">
                    <button type="button"
                        class="relative inline-flex items-center rounded-md bg-white px-3 py-2 mb-4 sm:mb-0 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 mr-4" wire:click="snooze({{$fu->id }}, 7)">
                        <span>Snooze a Week</span>
                    </button>
                    <button type="button"
                        class="relative inline-flex items-center rounded-md bg-white px-3 py-2 mb-4 sm:mb-0 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 mr-4" wire:click="snooze({{$fu->id }}, 30)">
                        <span>Snooze a Month</span>
                    </button>
                    <input type="date"
                        class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 mr-4"
                        wire:change="updateFollowUp($event.target.value, {{ $fu->id }})" value={{ $fu->follow_up_date }}>
                    <button
                        class="relative inline-flex items-center rounded-md bg-white hover:bg-red-500 hover:text-gray-100 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-red-500"
                        wire:click="cancelFollowUp({{ $fu->id }})"
                        wire:confirm="Are you sure you want to stop following up with {{ $fu->first_name }}?">Never
                        Follow Up</button>
                </div>
            </div>
        </div>
    @empty
        <p>No Follow Ups scheduled for the next 7 days</p>
    @endforelse
    <div class="my-4">
        {{ $followUpList->links() }}
    </div>
</div>
</div>
