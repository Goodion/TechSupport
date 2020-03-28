<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppealClosed extends AppealEvent
{
    use Queueable;

    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('mail.appeal_closed', ['appeal' => $this->appeal])
            ->subject('Заявка закрыта.');
    }
}
