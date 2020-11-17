<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyUserPaymentNotification extends Notification
{
    use Queueable;

    protected $countPayments;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(int $countPayments)
    {
        $this->countPayments = $countPayments;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
            'text' => $this->getTextNotification(),
            'user' => $notifiable
        ];
    }

    public function getTextNotification() : string{
        $text = "";
        if($this->countPayments > 1){
            $text = "Tienes {$this->countPayments} nuevos pagos.";
        }else{
            $text = "Tienes un nuevo pago.";
        }
        request()->session()->flash('message', $text);

        return $text;
    }
}
