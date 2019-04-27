<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Comment;
use Illuminate\Notifications\Messages\BroadcastMessage;


class NotifyCommentOwner extends Notification
{
    use Queueable;

    protected $comment;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database',/*'broadcast'*/];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'comment'=>$this->comment,
            'name' =>auth()->user()->name ,
            'group'=>Comment::find($this->comment->comment_id)->group_id_comment,
        ];
    }
/*
    public function toBroadcast($notifiable)
    {
        return ([
            'data'=>[
            'comment'=>$this->comment,
            'name' =>auth()->user()->name ,
            'group'=>Comment::find($this->comment->comment_id)->group_id_comment,
        ]]);
    }
*/
}
