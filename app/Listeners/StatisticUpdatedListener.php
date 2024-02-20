<?php

namespace App\Listeners;

use App\Events\StatisticUpdatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StatisticUpdatedListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StatisticUpdatedEvent $event): void
    {
        info('statistics has updated');
    }
}
