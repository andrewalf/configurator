<?php

namespace App\Services;

use App\Exceptions\RequestToServiceFailedException;
use App\Services\Clients\RemoteServiceSettingsInterface;

class SettingsService
{
    /**
     * @var RemoteServiceSettingsInterface[]
     */
    private array $remoteServices;

    public function __construct(array $remoteServices)
    {
        $this->remoteServices = $remoteServices;
    }

    /**
     * @return array[
     *     'remote_service_name' => App\Entities\Setting[]
     * ]
     * @throws RequestToServiceFailedException
     */
    public function getList(): array
    {
        $result = [];

        foreach ($this->remoteServices as $remoteService) {
            $result[$remoteService->getServiceName()] = $remoteService->getSettings();
        }

        return $result;
    }
}
