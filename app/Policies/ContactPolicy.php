<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;
use Auth;

class ContactPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Contact $contact): bool
    {
        return $contact->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Auth::check();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Contact $contact): bool
    {
        return $contact->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Contact $contact): bool
    {
        return $contact->user_id === $user->id;
    }

    /**
     * Determine whether the user can augment the model with LinkedIn data.
     */
    public function augmentWithLinkedIn(User $user, Contact $contact): bool
    {
        return $contact->user_id === $user->id && (! $contact->last_api_update || $contact->last_api_update->diffInDays(now()) > 1);
    }
}
