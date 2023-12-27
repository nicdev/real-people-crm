<div>
    <select wire:model="company_id" name="commpany_id">
        <option value="">Select Company</option>
        @foreach($companies as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select>
</div>