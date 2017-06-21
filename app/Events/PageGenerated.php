<?php

namespace App\Events;

use App\Page;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class PageGenerated extends Event
{
    use SerializesModels;

    /**
     * @var Page
     */
    public $page;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Page $page)
    {
        
        $this->page = $page;
    }

}
