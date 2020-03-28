<?php

namespace App\Notifications;

use App\Appeal;
use App\Service\TelegramMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppealEvent extends Notification
{
    use Queueable;

    protected $appeal;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Appeal $appeal)
    {
        $this->appeal = $appeal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }
}
