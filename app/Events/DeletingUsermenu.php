<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class DeletingUsermenu extends Event
{
    use SerializesModels;

    /**
     * @var ID
     */
    public $id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

}
