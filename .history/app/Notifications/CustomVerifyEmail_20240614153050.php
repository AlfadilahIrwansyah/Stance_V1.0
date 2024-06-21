<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomVerifyEmail extends Notification
{
    use Queueable;
    protected $token;
    protected $tempPass;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $tempPass)
    {
        $this->token = $token;
        $this->tempPass = $tempPass;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function sendEmail($notifiable)
    {
        return (new MailMessage)
            ->subject('Activate Your Account')
            ->line('Your Temporary Password is : ' . $this->tempPass)
            ->line('Click the button below to activate your account.')
            ->action('Activate Account', url('/activate/' . $this->token))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
