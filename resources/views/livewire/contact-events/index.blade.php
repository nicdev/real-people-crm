<div class="mb-4">
    {{-- @if ($contactEvents) --}}
    <div class="my-4">
    {{ $contactEvents->links() }}
    </div>
    @forelse ($contactEvents as $ce)
        <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6"
            wire:key="{{ $ce->id }}">
            <div class="-ml-4 -mt-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
                <div class="ml-4 mt-4">
                    <div class="flex items-center">
                        <div class="ml-4">
                            <h3 class="text-base font-semibold leading-6 text-gray-900">
                                @if ($ce->title)
                                    {{ $ce->title }} on {{ $ce->date->format('M d, Y') }}
                                @else
                                    {{ $ce->contactMethod->name }} on {{ $ce->date->format('M d, Y') }}
                                @endif
                            </h3>

                            @if ($ce->recap)
                                <p class="text-sm text-gray-500">
                                    {{ $ce->recap }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p>No recent events</>
    @endforelse
    {{-- @endif --}}

</div>
