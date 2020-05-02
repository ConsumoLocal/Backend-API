<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Business;

class NewBusiness extends Notification
{
    use Queueable;

    private $idBusiness;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($idBusiness)
    {
        $this->idBusiness = $idBusiness;
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
        $business = Business::find($this->idBusiness);

        return (new MailMessage)
            ->from($email, 'Consumo Local')
            ->subject('Negocio Creado')
            ->greeting('Bienvenido ' . $business->name)
            ->line('Hemos recibido tu solicitud para agregar tu negocio al catálogo.')
            ->line('En breve recibirás un email de confirmación--')
            ->line('De no recibir una respuesta en 24 horas, por favor envíanos un correo electrónico con el numbre de tu negocio y el correo de tu cuenta para darle seguimiento a tu caso:')
            ->line('soporte@consumolocalmxn.com')
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
