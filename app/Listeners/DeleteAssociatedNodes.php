<?php

namespace App\Listeners;

use App\node;
use App\Page;
use App\Events\DeletingUsermenu;

class DeleteAssociatedNodes
{

    /**
     * Handle the event.
     *
     * @param  UsermenuDeleted  $event->id
     * @return void
     */
    public function handle(DeletingUsermenu $event)
    {
        $removingPage = Page::find($event->id);
        $removingPage->nodes()->delete();
    }
}
