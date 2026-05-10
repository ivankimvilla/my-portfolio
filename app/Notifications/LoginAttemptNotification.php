<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class LoginAttemptNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $loginData;
    protected $ipAddress;
    protected $userAgent;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $loginData, string $ipAddress, string $userAgent)
    {
        $this->loginData = $loginData;
        $this->ipAddress = $ipAddress;
        $this->userAgent = $userAgent;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $confirmUrl = URL::temporarySignedRoute(
            'admin.login.confirm',
            now()->addMinutes(15),
            [
                'email' => $this->loginData['email'],
                'token' => encrypt($this->loginData)
            ]
        );

        return (new MailMessage)
            ->subject('🔐 Login Attempt Detected - Confirm Access')
            ->greeting('Security Alert: Login Attempt')
            ->line('We detected a login attempt to your admin account.')
            ->line('**Login Details:**')
            ->line('• Email: ' . $this->loginData['email'])
            ->line('• IP Address: ' . $this->ipAddress)
            ->line('• Time: ' . now()->format('M d, Y \a\t H:i:s'))
            ->line('• Device: ' . $this->getDeviceInfo())
            ->action('✅ Confirm Login', $confirmUrl)
            ->line('If this was you, click the button above to complete your login.')
            ->line('If this wasn\'t you, please secure your account immediately.')
            ->line('This link will expire in 15 minutes.')
            ->salutation('Best regards, Portfolio Security System');
    }

    /**
     * Get device info from user agent
     */
    protected function getDeviceInfo(): string
    {
        $ua = $this->userAgent;

        if (strpos($ua, 'Mobile') !== false) {
            return 'Mobile Device';
        } elseif (strpos($ua, 'Tablet') !== false) {
            return 'Tablet';
        } else {
            return 'Desktop Computer';
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'login_data' => $this->loginData,
            'ip_address' => $this->ipAddress,
            'user_agent' => $this->userAgent,
        ];
    }
}
