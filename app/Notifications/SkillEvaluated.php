<?php

namespace App\Notifications;

use App\Http\Controllers\SkillEvaluationController;
use App\Models\SkillEvaluation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SkillEvaluated extends Notification
{
    use Queueable;

    protected $evaluation;

    /**
     * Create a new notification instance.
     */
    public function __construct(SkillEvaluation $evaluation)
    {
        $this->evaluation = $evaluation;
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

    public function toDatabase($notifiable)
    {
         return [
            'teacher' => $this->evaluation->teacher->name,
            'scores'  => [
                'speaking' => $this->evaluation->speaking,
                'listening'=> $this->evaluation->listening,
                'reading'  => $this->evaluation->reading,
                'writing'  => $this->evaluation->writing,
            ],
            'comment' => $this->evaluation->comment,
        ];
    }
}

