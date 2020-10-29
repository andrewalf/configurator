<?php

namespace App\Services\Clients;

use App\Entities\Setting;
use App\Exceptions\RequestToServiceFailedException;
use Grpc\ChannelCredentials;
use Grpcstub\GrpcStubClient;
use \Google\Protobuf\GPBEmpty;
use Grpcstub\SetSettingRequest;

class Grpc implements RemoteServiceSettingsInterface
{
    public function getSettings(): array
    {
        [$response, $status] = $this->getGrpcClient()->GetSettings(new GPBEmpty())->wait();

        if ($status->code !== \Grpc\STATUS_OK) {
            throw new RequestToServiceFailedException($status->details);
        }

        foreach ($response->getMessage()->settings as $setting) {
            // собираем и преобразуем данные к массиву энтити,
            // если бы grpc сервис работал бы (см. readme)
        }

        // возвратим просто заглушку, чтобы на ui хоть что-то было
        return [
            new Setting('grpc_setting_1', 'string', '')
        ];
    }

    public function setSetting(string $name, $value): bool
    {
        $request = new SetSettingRequest();
        $request->setName($name)->setValue($value);

        [$response, $status] = $this->getGrpcClient()->SetSetting($request)->wait();

        if ($status->code !== \Grpc\STATUS_OK) {
            throw new RequestToServiceFailedException($status->details);
        }

        return $response->getMessage()->success;
    }

    public function getServiceName(): string
    {
        return 'grpc';
    }

    private function getGrpcClient(): GrpcStubClient
    {
        return new GrpcStubClient(config('service_grpc.url'), [
            'credentials' => ChannelCredentials::createInsecure(),
        ]);
    }
}
