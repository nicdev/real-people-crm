<?php

namespace App\Actions\Introductions;

use App\Models\Introduction;
use App\Notifications\IntroductionSent;
use Notification;

class CreateIntroduction
{
    public function __invoke($introductionData)
    {
        $introduction = Introduction::create($introductionData);

        Notification::send(auth()->user(), new IntroductionSent($introduction));
    }
}
