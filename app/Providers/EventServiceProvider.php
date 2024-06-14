<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'App\Events\WordsChunkDispatched' => [
            'App\Listeners\ProcessWords',
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

        // ここにイベントとリスナーの結びつけを登録します
        // $this->registerListeners();       
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register the listeners for the application.
     *
     * @return void
     */
    protected function registerListeners()
    {
        // ここにイベントとリスナーの登録を行います
        // 例えば：
        // Event::listen(EventName::class, ListenerClass::class);
    }
}
