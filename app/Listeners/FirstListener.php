<?php

namespace App\Listeners;

use App\Events\SendNewsToChanell;
use App\News;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FirstListener
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
     * @param  SendNewsToChanell  $event
     * @return void
     */
    public function handle(SendNewsToChanell $event)
    {
    }
}
