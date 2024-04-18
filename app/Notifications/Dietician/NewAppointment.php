<?php

namespace App\Notifications\Dietician;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class NewAppointment extends Notification
{
    use Queueable;

    public $client;

    /**
     * Create a new notification instance.
     */
    public function __construct($client)
    {
        $this->client=$client;
        Log::debug("from notification");
        Log::debug($this->client);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
    public function toDatabase(object $notifiable): array
    {
        $title ='New Appointment';
        $id = $this->client->id;
        // $url = URL::route('view-user', $this->client->id);
        $url = 'http://127.0.0.1:8000/view-user/'.$this->client->id;

        $body = $this->client->first_name.' has requested for a diet plan.';
        return [
            'title' => $title,
            'body' => $body,
            'url' => $url,
        ];
    }
}

