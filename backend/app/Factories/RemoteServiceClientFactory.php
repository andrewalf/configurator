<?php

namespace App\Factories;

use App\Exceptions\InvalidRemoteServiceName;
use App\Services\Clients\Grpc;
use App\Services\Clients\GrpcStub;
use App\Services\Clients\RemoteServiceSettingsInterface;
use App\Services\Clients\Rest;

class RemoteServiceClientFactory {
    /**
     * Тут все захардкожено руками, но при наличии большого количества
     * сервисов+клиентов, я бы использовал кодогенерацию, чтобы
     * при деплое кода генерировалась фабрика.
     *
     * @throws InvalidRemoteServiceName
     */
    public function createFromName(string $name): RemoteServiceSettingsInterface
    {
        switch ($name) {
            case 'grpc':
                return app(Grpc::class);
            case 'rest':
                return app(Rest::class);
            case 'grpc_stub':
                return app(GrpcStub::class);
            default:
                throw new InvalidRemoteServiceName("${name} client not found");
        }
    }
}
