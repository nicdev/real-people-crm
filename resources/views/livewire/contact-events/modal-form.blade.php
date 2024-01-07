<div>
    <h1>CONTACTS MODAL</h1>
    <form wire:submit="store">
        @if ($contact)
            <label>{{ $contact->first_name }}
                {{ $contact->middle_name ? substr($contact->middle_name, 0, 1) . '.' : '' }}
                {{ $contact->last_name }}</label>
        @else
            <livewire:contacts.select :contacts="auth()->user()->contacts" />
        @endif
        <div class="form-group">
            <h2>{{ $this->title }}<h2>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input wire:model="date"
                            type="date"
                            class="form-control"
                            id="date">
                        @error('date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">

                        <label for="contact_method_id">Contact Method</label>
                        <select wire:model.live="contact_method_id"
                            class="form-control"
                            id="contact_method_id">
                            @foreach ($contact_methods as $cm)
                                <option value="{{ $cm->id }}">{{ $cm->name }}</option>
                            @endforeach
                        </select>
                        @error('preferred_contact_method')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="general_notes">Recap</label>
                        <textarea wire:model="general_notes"
                            class="form-control"
                            id="general_notes"
                            rows="3"></textarea>
                        @error('general_notes')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit"
                        class="btn btn-primary">Submit</button>
    </form>
</div>
