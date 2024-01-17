<div class="mb-4">
    @forelse ($contactEvents as $ce)
        <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6"
            wire:key="{{ $ce->id }}">
            <div class="-ml-4 -mt-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
                <div class="ml-4 mt-4">
                    <div class="flex items-center">
                        {{-- <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full"
                                src="{{ $ce->contact->photo ?? gravatar($ce->email) }}"
                                alt="">
                        </div> --}}
                        <div class="ml-4">
                            <a href="{{ route('contacts.show', $ce) }}">
                                <h3 class="text-base font-semibold leading-6 text-gray-900">{{ $ce->contactMethod->name }} on {{ $ce->date->format('M d, Y') }}</h3>
                            </a>
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
        <div class="rounded-md bg-yellow-50 p-4 my-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="font-medium text-yellow-700">Looks like it's been a while. May be a good time
                        to reach out 🤔</h3>
                </div>
            </div>
        </div>
    @endforelse

</div>
