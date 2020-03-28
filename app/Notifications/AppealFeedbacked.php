<?php

namespace App\Notifications;

use App\Appeal;
use App\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppealFeedbacked extends Notification
{
    use Queueable;
    protected $appeal;
    protected $feedback;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Appeal $appeal, Feedback $feedback)
    {
        $this->appeal = $appeal;
        $this->feedback = $feedback;
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

    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('mail.appeal_feedbacked', ['appeal' => $this->appeal, 'feedback' =>$this->feedback])
            ->subject('По заявке получен ответ.');
    }
}
