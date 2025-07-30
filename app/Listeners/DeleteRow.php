<?php

namespace App\Listeners;

use App\Events\RowCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Console\Scheduling\Schedule;

class DeleteRow
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
     * @param  \App\Events\RowCreated  $event
     * @return void
     */
    public function handle(RowCreated $event)
    {
        $schedule = app(Schedule::class);
        $schedule->call(function () use ($event) {
            dd('ss');
            $event->order->update(['payment_done' =>10]);
        })->everyMinute();
        //dd('ssss', $schedule);
        
        // $schedule = app(Schedule::class);


    }
}
