<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminResetPassword extends Notification
{
    use Queueable;

    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = route('admin.reset-password', [
            'token' => $this->token,
            'email' => $notifiable->email,
        ]);

        return (new MailMessage)
            ->subject('Reset Password - SuryaPainting18 Admin')
            ->greeting('Halo ' . $notifiable->name . ',')
            ->line('Anda menerima email ini karena kami menerima permintaan reset password untuk akun admin Anda.')
            ->action('Reset Password', $url)
            ->line('Link reset password ini akan kedaluwarsa dalam 60 menit.')
            ->line('Jika Anda tidak meminta reset password, abaikan email ini.')
            ->salutation('Terima kasih, SuryaPainting18');
    }
}
