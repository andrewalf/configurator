<?php

namespace App\Services\Clients;

use App\Entities\Setting;

/**
 * Т.к. grpc на практике на проверить из-за бага (см readme), то буде использоваться заглушка.
 * Настоящий grpc-клиент я набросал, но подключать его в DI-контейнер не буду
 */
class GrpcStub implements RemoteServiceSettingsInterface
{
    public function getSettings(): array
    {
        return [
            new Setting('grpc_setting_1', 'string', '')
        ];
    }

    public function setSetting(string $name, $value): bool
    {
        return rand(0,1) < 0.5;
    }

    public function getServiceName(): string
    {
        return 'grpc_stub';
    }
}
