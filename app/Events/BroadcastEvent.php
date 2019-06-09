<?php

namespace App\Events;

use App\Post;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BroadcastEvent extends Event implements ShouldBroadcast
{
  use SerializesModels;

  public $post;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct(Post $post)
  {
    $this->post = $post;
  }

  public function broadcastOn()
  {
    return ['group.'.$this->post->group_id];
  }

  public function broadcastAs()
  {
    return 'group_event';
  }
}
