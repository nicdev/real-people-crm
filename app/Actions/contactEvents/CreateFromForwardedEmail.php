<?php 

namespace App\Actions\ContactEvents;

use App\Actions\Contacts\CreateOrUpdateContact;
use App\Models\ContactEvent;

class CreateFromForwardedEmail
{
    public function __invoke(array $email): ContactEvent
    {
        
        app(CreateOrUpdateContact::class)([
        'first_name' => $this->first_name,
        'middle_name' => $this->middle_name,
        'last_name' => $this->last_name,
        'phone' => $this->phone,
        'email' => $this->email,
        'linkedin' => $this->linkedin,
        'twitter' => $this->twitter,
        'youtube' => $this->youtube,
        'website' => $this->website,
        'preferred_contact_method_id' => $this->preferred_contact_method,
        'general_notes' => $this->general_notes,
        'user_id' => auth()->id(),
        'company_id' => $this->company_id,
        'follow_up_date' => $this->follow_up_date,
        'frequency' => $this->frequency,]);
    }
}