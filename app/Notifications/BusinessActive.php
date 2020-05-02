<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BusinessActive extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $email = env('MAIL_USERNAME');
        $baseUrl = env('APP_URL', 'https://consumolocalmxn.com/');

        return (new MailMessage)
            ->from($email, 'Consumo Local')
            ->subject('¡Bienvenido a Consumo Local!')
            ->greeting('Hola: ' . $notifiable->name)
            ->line('Tu negocio ha sido revisado y aprobado con éxito.')
            ->line('En breve podrás visualizarlo a través de todas nuestras plataformas.')
            ->line('Gracias por ser parte de Consumo Local !');
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
