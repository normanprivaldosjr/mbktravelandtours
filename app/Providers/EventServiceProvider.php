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

    //Include email sending as soon as the feature is added
    protected $listen = [
        //ADD THIS FOR THE EMAIL: 'App\Listeners\sendEmailConfirmation'
        //Then run this in the terminal "php artisan event:generate" without the quotation marks
        'App\Events\UserRegistered' => [
            'App\Listeners\AssignRole',
            'App\Listeners\addCookieToCartR',
            'App\Listeners\setSessionForOTherInformationR',
            
        ],
        'App\Events\UserLogin' => [
            'App\Listeners\addCookieToCart',
            'App\Listeners\setSessionForOTherInformation',
            
        ]
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
