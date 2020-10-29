<?php

namespace App\Services\Clients;

use App\Entities\Setting;
use App\Exceptions\RequestToServiceFailedException;

interface RemoteServiceSettingsInterface
{
    /**
     * @return Setting[]
     * @throws RequestToServiceFailedException
     */
    public function getSettings(): array;

    /**
     * @throws RequestToServiceFailedException
     */
    public function setSetting(string $name, $value): bool;

    public function getServiceName(): string;
}
