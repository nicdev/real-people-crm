<div>
    <h1>CONTACTS MODAL</h1>
    <form wire:submit="store">
        <div class="form-group">
            <label for="first_name">Name</label>
            <input wire:model="form.first_name" type="text" class="form-control" id="name" placeholder="Enter name">
            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="middle_name">Middle Name</label>
            <input wire:model="form.middle_name" type="text" class="form-control" id="middle_name" placeholder="Enter middle name">
            @error('middle_name') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input wire:model="form.last_name" type="text" class="form-control" id="last_name" placeholder="Enter last name">
            @error('last_name') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input wire:model="form.phone" type="text" class="form-control" id="phone" placeholder="Enter phone">
            @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input wire:model="form.email" type="text" class="form-control" id="email" placeholder="Enter email">
            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="linkedin">LinkedIn</label>
            <input wire:model="form.linkedin" type="text" class="form-control" id="linkedin" placeholder="Enter linkedin">
            @error('linkedin') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="twitter">Twitter/X</label>
            <input wire:model="form.twitter" type="text" class="form-control" id="twitter" placeholder="Enter twitter">
            @error('twitter') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="youtube">YouTube</label>
            <input wire:model="form.youtube" type="text" class="form-control" id="youtube" placeholder="Enter youtube">
            @error('youtube') <span class="text-danger">{{ $message }}</span>@enderror
        <div class="form-group">
            <label for="website">Website</label>
            <input wire:model="form.website" type="text" class="form-control" id="website" placeholder="Enter website">
            @error('website') <span class="text-danger">{{ $message }}</span>@enderror
        
        <div class="form-group">
            <label for="preferred_contact_method">Preferred Contact Method</label>
            <select wire:model="form.preferred_contact_method" class="form-control" id="preferred_contact_method">
                @foreach($contact_methods as $cm)
                    <option value="{{ $cm->id }}">{{ $cm->name }}</option>
                @endforeach
            </select>
            @error('preferred_contact_method') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <livewire:companies.select />
        <div class="form-group">
            <label for="general_notes">General Notes</label>
            <textarea wire:model="form.general_notes" class="form-control" id="general_notes" rows="3"></textarea>
            @error('general_notes') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
