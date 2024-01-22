<?php

namespace App\Notifications;

use App\Mail\Introduction as IntroductionMail;
use App\Models\Introduction;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class IntroductionSent extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Introduction $introduction)
    {
        ray('in mailable', $introduction);
        $this->introduction = $introduction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): IntroductionMail
    {
        return (new IntroductionMail($this->introduction))
            ->to($this->introduction->firstContact->email)
            ->to($this->introduction->secondContact->email)
            ->bcc($this->introduction->user->email)
            ->markdown('email.introduction', [
                'content' => $this->introduction->content,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
