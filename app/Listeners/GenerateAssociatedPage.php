<?php

namespace App\Listeners;

use App\Page;
use App\Events\UsermenuGenerated;

class GenerateAssociatedPage
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
     * Create an Associated Page for the Usermenu
     *
     * @param  UsermenuGenerated  $event
     * @return void
     */
    public function handle(UsermenuGenerated $event)
    {

        $page = Page::generate([
            'title' => 'New Page',
            'usermenu_id' => $event->usermenu->id
        ]);

        $page->menu()->associate($event->usermenu);

        return $page;
    }
}
