<?php

namespace App\Events;

use App\node;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class NodeGenerated extends Event
{
    use SerializesModels;

    /**
     * @var Node
     */
    public $node;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(node $node)
    {
        $this->node = $node;
    }

}
