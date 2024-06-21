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
    public function toMail($notifiable)
    {
        $url = url('/activate?token=' . $this->token);

        return (new MailMessage)
                    ->subject('Verify Email Address')
                    ->line('Please click the button below to verify your email address.')
                    ->action('Verify Email Address', $url)
                    ->line('Your temporary password is: ' . $this->tempPass)
                    ->line('If you did not create an account, no further action is required.');
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
            // Add any necessary data here
        ];
    }
}
