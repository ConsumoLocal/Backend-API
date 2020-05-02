<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Support\Facades\DB;

class ResetPassword extends Notification
{
    use Queueable;



    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {

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
        $token = DB::table('password_resets')
            ->where('email', '=', $notifiable->email)
            ->select('token')
            ->first();
        return (new MailMessage)
                    ->from($email, 'Consumo Local')
                    ->subject('Recuperación de Contraseña')
                    ->greeting('Hola !')
                    ->line('Haz solicitado reestablecer tu contraseña.')
                    ->line('Si tú no realizaste esta solicitud, omite este mensaje.')
                    ->action('Reestablecer Ahora', url($baseUrl . 'password/reset_token/' . $token->token . '/u/'. $notifiable->email))
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
