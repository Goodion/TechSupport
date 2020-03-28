<?php

namespace App\Notifications;

use App\Appeal;
use Illuminate\Bus\Queueable;
use App\Providers\TelegramMessageServiceProvider;
use App\Service\TelegramMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppealCreated extends AppealEvent
{
    use Queueable;

    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('mail.appeal_created', ['appeal' => $this->appeal, 'urlToCreatedAppeal' => $this->urlToCreatedAppeal])
            ->subject('Создана новая заявка.');
    }

    public function toTelegram($notifiable)
    {
        return 'Создана заявка ' . $this->appeal['title'];
    }
}
