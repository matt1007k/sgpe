<?php

namespace App\Notifications;

use App\Mail\SentMessageEmail;
use App\Models\User;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;

class SentMessageNotification extends Notification
{
    use Queueable;

    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
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
        return (new MailMessage)
            ->markdown('emails.sent-message', [
                'message' => $this->message,
                'user' => $notifiable
            ])
            ->subject($this->message->subject);
        //     ->subject($this->message->subject)
        //     ->line("Hola {$notifiable->name}")
        //     ->line("Datos de tu cuenta:")
        //     ->line("Correo Electrónico: {$notifiable->email}")
        //     ->line("DNI: $notifiable->dni")
        //     ->line("Constraseñ: {$this->message->body}")
        //     ->action('Ingresar', route('login'))
        //     ->line('Gracias por usar nuestra aplicación.');
        // return Mail::to($notifiable)
        //     ->send(new SentMessageEmail(
        //         $this->message,
        //         $notifiable
        //     ));
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
