<div>
    @if ($contact->no_follow_up)
        <div class="rounded-md bg-red-100 p-4 my-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="font-medium text-red-700">Follow ups are turned off for this contact<button
                            class="font-medium bg-transparent hover:bg-green-500 text-red-700 hover:text-white py-2 px-4 mx-2 border border-red-500 hover:border-transparent rounded"
                            wire:click="enableFollowUp">Turn On</button></h3>
                </div>
            </div>
        </div>
        {{-- @elseif($contact->follow_up_date) --}}
    @elseif($contact->follow_up_date && $contact->follow_up_date >= now())
        <div class="rounded-md bg-green-100 p-4 my-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                </div>
                <div class="ml-3">
                    <h3 class="font-medium text-red-700">Next follow up scheduled for <input type="date"
                            class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 mr-1"
                            wire:change="updateFollowUp($event.target.value, {{ $contact->id }})"
                            value={{ $contact->follow_up_date }}></h3>
                </div>
            </div>
        </div>
    @elseif(($contact->follow_up_date && $contact->follow_up_date < now()) || !$contact->follow_up_date)
        <div class="rounded-md bg-red-100 p-4 my-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="font-medium text-red-700">You are past due to follow up <input type="date"
                            class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 mr-1"
                            wire:change="updateFollowUp($event.target.value)"
                            value={{ $contact->follow_up_date }}></h3>
                </div>
            </div>
        </div>
    @endif
</div>
