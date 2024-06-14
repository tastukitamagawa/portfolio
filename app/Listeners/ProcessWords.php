<?php

namespace App\Listeners;

use App\Events\WordsChunkDispatched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class ProcessWords
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
    public function handle(WordsChunkDispatched $event): void
    {
        Log::info('Job dispatched with data: ' . json_encode($event->wordsData));
    }
}
