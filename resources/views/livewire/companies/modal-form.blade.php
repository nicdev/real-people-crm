<div>
    <h1>COMPANIES MODAL</h1>
    <form wire:submit="store">
        <div class="form-group">
            <label for="name">Name</label>
            <input wire:model="name" type="text" class="form-control" id="name" placeholder="Enter name">
            @error('name') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input wire:model="phone" type="text" class="form-control" id="phone" placeholder="Enter phone">
            @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input wire:model="email" type="text" class="form-control" id="email" placeholder="Enter email">
            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="linkedin">LinkedIn</label>
            <input wire:model="linkedin" type="text" class="form-control" id="linkedin" placeholder="Enter linkedin">
            @error('linkedin') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="twitter">Twitter/X</label>
            <input wire:model="twitter" type="text" class="form-control" id="twitter" placeholder="Enter twitter">
            @error('twitter') <span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="youtube">YouTube</label>
            <input wire:model="youtube" type="text" class="form-control" id="youtube" placeholder="Enter youtube">
            @error('youtube') <span class="text-danger">{{ $message }}</span>@enderror
        <div class="form-group">
            <label for="website">Website</label>
            <input wire:model="website" type="text" class="form-control" id="website" placeholder="Enter website">
            @error('website') <span class="text-danger">{{ $message }}</span>@enderror
        <div class="form-group">
            <label for="general_notes">General Notes</label>
            <textarea wire:model="general_notes" class="form-control" id="general_notes" rows="3"></textarea>
            @error('general_notes') <span class="text-danger">{{ $message }}</span>@enderror
            </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
