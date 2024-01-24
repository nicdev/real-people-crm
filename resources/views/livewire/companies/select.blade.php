<div>
    <label for="company_id" class="block text-sm font-medium leading-5 text-gray-700">Company</label>
    <select wire:model="company_id" name="commpany_id" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
        <option value="">Select Company</option>
        @foreach(auth()->user()->companies as $c)
            <option value="{{ $c->id }}" wire:key="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select>
     @script
        <script>
            {{-- const segments = window.location.pathname.split("/");
            if (segments[1].toLowerCase() === "companies" && segments[2]) {
                initCompanySelect(segments[2])
            }; --}}

            function initCompanySelect(companyId) {
                $wire.$call('setCompany', companyId)
            }
        </script>
    @endscript
</div>