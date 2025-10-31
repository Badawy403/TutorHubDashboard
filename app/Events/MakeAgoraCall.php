<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MakeAgoraCall implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $appointment_id;
    public $student_id;
    public $channel;
    public $token;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($appointment,$channel,$token)
    {
        $this->student_id = $appointment['student_id'];
        $this->channel = $channel;
        $this->token = $token;
        $this->appointment_id = $appointment['id'];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('make-agora-call.'.$this->appointment_id);
    }
    public function broadcastAs()
    {
        return 'make-agora-call';
    }
}
