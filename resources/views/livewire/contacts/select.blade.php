<div>
    <select wire:model="contact_id" name="contact_id" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
        <option value="">Select Contact</option>
        @foreach($contacts as $c)
            <option value="{{ $c->id }}" wire:key="{{ $c->id }}">{{ $c->first_name }} {{ $c->middle_name }} {{ $c->last_name }}</option>
        @endforeach
    </select>
</div>