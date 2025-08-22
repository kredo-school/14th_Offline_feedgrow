<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use GuzzleHttp\Psr7\Message;

use function PHPSTORM_META\type;

class CommentReceved extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public User $actor,
        public post $post,
        public Comment $comment
    ) {}
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
            'type' => 'comment',
            'actor_id' => $this->actor->id,
            'actor' => $this->actor->name,
            'actor_avatar_url' => $this->actor->profile_image
            ? Storage::url($this->actor->profile_image)
            : asset('images/User-avatar.png'),
            'post_id' => $this->post->id,
            'comment_id' => $this->comment->id,
            'message' => "{$this->actor->name} commented on your post.",
            'url' => route('posts.show', $this->post->id) . '#comments',
        ];
    }
}
