<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderGroupStatus extends Notification
{
    use Queueable;
    private $details;


    public function __construct($details)
    {
         $this->details = $details;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => $this->details['type'],
            'ordergroup_id' => $this->details['ordergroup_id'],
            'status' => $this->details['status'],
        ];
    }
}
