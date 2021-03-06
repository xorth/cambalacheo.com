<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'auth.login' => [
            'App\Listeners\AuthLogin',
        ],
        'App\Events\ContactSent' => [
            'App\Listeners\SendContactEmail',
        ],
        'App\Events\OfferStore' => [
            'App\Listeners\SendOfferEmail',
        ],
        'App\Events\UserCreated' => [
            'App\Listeners\SendRegistrationEmail',
        ],
        'App\Events\ArticleCreated' => [
            'App\Listeners\NewArticleAlertFacebook',
            'App\Listeners\NewArticleAlertTwitter',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
    }
}
