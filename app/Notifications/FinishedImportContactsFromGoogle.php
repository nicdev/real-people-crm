<?php

namespace App\Notifications;

use App\Mail\FinishedImportContactsFromGoogle as FinishedImportContactsFromGoogleMailMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class FinishedImportContactsFromGoogle extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
    public function toMail(object $notifiable): FinishedImportContactsFromGoogleMailMessage
    {
        return (new FinishedImportContactsFromGoogleMailMessage)
            ->subject('Finished Importing Contacts From Google')
            ->to($notifiable->email);
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
