<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body">
                    {{-- Replicate the fields from the create view --}}
                    <div class="form-group">
                        <label for="edit_first_name">Name</label>
                        <input wire:model="first_name" type="text" class="form-control" id="edit_first_name" placeholder="Enter name">
                        @error('first_name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_middle_name">Middle Name</label>
                        <input wire:model="middle_name" type="text" class="form-control" id="edit_middle_name" placeholder="Enter middle name">
                        @error('middle_name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_last_name">Last Name</label>
                        <input wire:model="last_name" type="text" class="form-control" id="edit_last_name" placeholder="Enter last name">
                        @error('last_name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_phone">Phone</label>
                        <input wire:model="phone" type="text" class="form-control" id="edit_phone" placeholder="Enter phone">
                        @error('phone') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_email">Email</label>
                        <input wire:model="email" type="text" class="form-control" id="edit_email" placeholder="Enter email">
                        @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_linkedin">LinkedIn</label>
                        <input wire:model="linkedin" type="text" class="form-control" id="edit_linkedin" placeholder="Enter linkedin">
                        @error('linkedin') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_twitter">Twitter</label>
                        <input wire:model="twitter" type="text" class="form-control" id="edit_twitter" placeholder="Enter twitter">
                        @error('twitter') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_youtube">YouTube</label>
                        <input wire:model="youtube" type="text" class="form-control" id="edit_youtube" placeholder="Enter youtube">
                        @error('youtube') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_website">Website</label>
                        <input wire:model="website" type="text" class="form-control" id="edit_website" placeholder="Enter website">
                        @error('website') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_preferred_contact_method">Preferred Contact Method</label>
                        <select wire:model="preferred_contact_method" class="form-control" id="edit_preferred_contact_method">
                            <option value="email">Email</option>
                            <option value="phone">Phone</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="twitter">Twitter</option>
                            <option value="youtube">YouTube</option>
                            <option value="website">Website</option>
                        </select>
                        @error('preferred_contact_method') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_general_notes">General Notes</label>
                        <textarea wire:model="general_notes" class="form-control" id="edit_general_notes" rows="3"></textarea>
                        @error('general_notes') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
