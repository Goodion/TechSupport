<?php

namespace App\Notifications;

use App\Appeal;
use Illuminate\Bus\Queueable;
use App\Providers\TelegramMessageServiceProvider;
use App\Service\TelegramMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppealCreated extends Notification
{
    use Queueable;

    protected $urlToCreatedAppeal;
    protected $appeal;

    public function __construct(Appeal $appeal, $urlToCreatedAppeal = '')
    {
        $this->appeal = $appeal;
        $this->urlToCreatedAppeal = $urlToCreatedAppeal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', TelegramMessage::class];
    }

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
