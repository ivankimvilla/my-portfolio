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
            ->subject('Reset Your Admin Password')
            ->view('emails.reset-password', [
                'url' => $url,
                'expiration' => config('auth.passwords.'.env('AUTH_PASSWORD_BROKER', 'users').'.expire'),
            ]);
    }

    /**
     * Get the reset password notification mail message URL.
     *
     * @return string
     */
    public function toMail($notifiable)
    {
        $resetUrl = route('admin.reset-password', $this->token)
            . '?email=' . urlencode($notifiable->getEmailForPasswordReset());

        return $this->buildMailMessage($resetUrl);
    }
}
