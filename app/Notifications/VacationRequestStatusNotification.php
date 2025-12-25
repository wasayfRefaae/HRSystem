<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\VacationRequest;
class VacationRequestStatusNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(  public VacationRequest $vacationRequest,
        public string $status, // 'approved' or 'rejected'
        public ?string $notes = null)
    {
        //
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
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');


     $subject = "Your Vacation Request has been {$this->status}";
        
        $mail = (new MailMessage)
            ->subject($subject)
            ->greeting("Hello {$notifiable->name},");
        
        if ($this->status === 'approved') {
            $mail->line("Your vacation request from {$this->vacationRequest->start_date->format('M d, Y')} to {$this->vacationRequest->end_date->format('M d, Y')} has been **approved**.")
                 ->line('Status: ✅ Approved');
        } else {
            $mail->line("Your vacation request from {$this->vacationRequest->start_date->format('M d, Y')} to {$this->vacationRequest->end_date->format('M d, Y')} has been **rejected**.")
                 ->line('Status: ❌ Rejected');
        }
        
        if ($this->notes) {
            $mail->line('**Manager Notes:**')
                 ->line($this->notes);
        }
        
        return $mail->action('View Request', url("/vacation-requests/{$this->vacationRequest->id}"))
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
         'vacation_request_id' => $this->vacationRequest->id,
            'status' => $this->status,
            'message' => "Your vacation request has been {$this->status}",
            'url' => "/vacation-requests/{$this->vacationRequest->id}",
        ];
    }
}