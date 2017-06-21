<?php

namespace App\Events;

use App\Usermenu;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class UsermenuGenerated extends Event
{
    use SerializesModels;

    /**
     * @var Usermenu
     */
    public $usermenu;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Usermenu $usermenu)
    {
        $this->usermenu = $usermenu;
    }


}
