<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\Introduction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IntroductionPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Contact $firstContact, Contact $secondContact): bool
    {
        return Auth::check() && $firstContact->user_id === $user->id && $secondContact->user_id === $user->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Introduction $introduction): bool
    {
        return $introduction->user_id === $user->id && $introduction->firstContact->user_id === $user->id && $introduction->secondContact->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Introduction $introduction): bool
    {
        return $introduction->user_id === $user->id;
    }
}
