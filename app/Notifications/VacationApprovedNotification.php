<?php

namespace App\Notifications;

use App\Models\VacationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VacationApprovedNotification extends Notification
{
     use Queueable;

    public function __construct(
        public VacationRequest $vacationRequest
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Vacation Request Approved')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your vacation request has been approved.')
            ->line('**Details:**')
            ->line('Start Date: ' . $this->vacationRequest->start_date->format('M d, Y'))
            ->line('End Date: ' . $this->vacationRequest->end_date->format('M d, Y'))
            ->line('Reason: ' . $this->vacationRequest->reason)
            ->action('View Details', url('/vacation-requests'))
            ->line('Thank you for using our application!');
    }
}