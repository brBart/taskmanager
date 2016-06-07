<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;
    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($res,$user_id)
    {
        //$res['sender_user_id'] = $user_id;
        $res1['data'] = $res;
        $res1['sender_user_id'] = $user_id; 
        $this->data = $res1;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['task-channel'];
    }
}
