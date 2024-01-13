<div>
    @foreach ($contactEvents as $ce)
        <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
            <div class="-ml-4 -mt-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
                <div class="ml-4 mt-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full"
                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                alt="">
                        </div>
                        <div class="ml-4">
                            <a href="{{ route('contacts.show', $ce) }}">
                                <h3 class="text-base font-semibold leading-6 text-gray-900">{{ $ce->first_name }}
                                    {{ $ce->title }} on {{ $ce->date }}</h3>
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
    @endforeach
</div>
