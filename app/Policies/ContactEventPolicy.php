<?php

namespace App\Policies;

use App\Models\ContactEvent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ContactEventPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ContactEvent $contactEvent): bool
    {
        return $contactEvent->user_id === $user->id;
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
    public function update(User $user, ContactEvent $contactEvent): bool
    {
        return $contactEvent->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ContactEvent $contactEvent): bool
    {
        return $contactEvent->user_id === $user->id;
    }
}
