<?php

namespace App\Providers;

use App\Services\Clients\Grpc;
use App\Services\Clients\GrpcStub;
use App\Services\Clients\Rest;
use App\Services\SettingsService;
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

        $this->app->bind(SettingsService::class, function () {
            return new SettingsService([
                $this->app->get(Rest::class),
                new GrpcStub()
//                new Grpc(),
            ]);
        });
    }
}
