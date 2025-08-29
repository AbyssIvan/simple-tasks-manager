<?php

namespace App\Providers;

use App\Events\TaskCreatedEvent;
use App\Events\TaskUpdatedEvent;
use App\Listeners\TaskChangedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TaskCreatedEvent::class => [
            TaskChangedListener::class,
        ],
        TaskUpdatedEvent::class => [
            TaskChangedListener::class,
        ],
    ];

    public function boot()
    {
    }

    public function shouldDiscoverEvents()
    {
    }
}
