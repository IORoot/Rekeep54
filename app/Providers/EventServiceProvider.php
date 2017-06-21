<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\NodeGenerated' => [
            'App\Listeners\FillEmptyNodePalette'
        ],
        'App\Events\UsermenuGenerated' => [
            'App\Listeners\GenerateAssociatedPage'
        ],
        'App\Events\DeletingUsermenu' => [
            'App\Listeners\DeleteAssociatedNodes'
        ],
        'App\Events\PageGenerated' => [
            'App\Listeners\GenerateAssociatedNode'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
