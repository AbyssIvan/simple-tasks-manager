<?php

namespace App\Listeners;

use App\Events\TaskCreatedEvent;
use App\Events\TaskUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskChangedListener implements ShouldQueue
{
    public function __construct()
    {
    }

    public function handle(TaskCreatedEvent|TaskUpdatedEvent $event): void
    {
        //notifications & logs
    }
}
