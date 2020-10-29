<?php

namespace App\Providers;

use App\Transport\Guzzle;
use App\Transport\HttpTransportInterface;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Guzzle::class, function () {
            return new Guzzle(
                new Client([
                    'base_uri' => config('service_rest.url'),
                    'timeout'  => 5,
                ])
            );
        });

        $this->app->bind(
            HttpTransportInterface::class,
            Guzzle::class
        );
    }
}
