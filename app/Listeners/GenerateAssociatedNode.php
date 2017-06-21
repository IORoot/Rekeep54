<?php

namespace App\Listeners;

use App\node;
use App\Events\PageGenerated;

class GenerateAssociatedNode
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UsermenuGenerated  $event
     * @return void
     */
    public function handle(PageGenerated $event)
    {
        $node = node::generate([
            'title'         => 'New Node',
            'description'   => 'This is a dummy node attached to the newly created page.'
        ]);

        $node->page()->attach($event->page);

        return $node;
    }
}
