<?php

namespace App\Events;

use App\Comment;
use App\Secondcomment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewComment implements shouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $secondComment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($secondComment)
    {
        $this->secondComment = $secondComment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $comment =Comment::where('id',$this->secondComment->comment_id)->first();

        return [
            new Channel('comments.' . $this->secondComment->comment_id),
            new Channel('comments.' . $comment->group_id_comment),
        ];
    }
}
