<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    /**
     * Get the reset password notification mail message for the given reset password URL.
     *
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject('Reset Password Notification')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $url)
            ->line('This password reset link will expire in '.config('auth.passwords.'.env('AUTH_PASSWORD_BROKER', 'users').'.expire').' minutes.')
            ->line('If you did not request a password reset, no further action is required.')
            ->salutation('Best regards,');
    }

    /**
     * Get the reset password notification mail message URL.
     *
     * @return string
     */
    public function toMail($notifiable)
    {
        $resetUrl = route('admin.reset-password', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        return $this->buildMailMessage($resetUrl);
    }
}
