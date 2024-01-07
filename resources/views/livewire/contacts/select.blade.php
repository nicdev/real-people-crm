<div>
    <select wire:model="contact_id" name="contact_id">
        <option value="">Select Contact</option>
        @foreach($contacts as $c)
            <option value="{{ $c->id }}">{{ $c->first_name }} {{ $c->middle_name }} {{ $c->last_name }}</option>
        @endforeach
    </select>
</div>