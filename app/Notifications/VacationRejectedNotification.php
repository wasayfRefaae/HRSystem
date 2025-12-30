<?php

namespace App\Notifications;

use App\Models\VacationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VacationRejectedNotification extends Notification
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
            ->subject('Vacation Request Update')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your vacation request has been rejected.')
            ->line('**Details:**')
            ->line('Start Date: ' . $this->vacationRequest->start_date->format('M d, Y'))
            ->line('End Date: ' . $this->vacationRequest->end_date->format('M d, Y'))
            ->line('Reason: ' . $this->vacationRequest->rejection_reason)
            ->line('**Manager Notes:** ' . ($this->vacationRequest->manager_notes ?? 'No additional notes provided.'))
            ->action('View Details', url('/vacation-requests'))
            ->line('Please contact your manager for more information.');
    }
}