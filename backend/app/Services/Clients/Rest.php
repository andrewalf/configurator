<?php

namespace App\Services\Clients;

use App\Entities\Setting;
use App\Exceptions\HttpTransportException;
use App\Transport\HttpTransportInterface;

class Rest implements RemoteServiceSettingsInterface
{
    private HttpTransportInterface $httpClient;

    public function __construct(HttpTransportInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @throws HttpTransportException
     */
    public function getSettings(): array
    {
        $settings = [];
        $response = $this->httpClient->get('/settings');
        $rawBody = $response->getBody()->getContents();

        if ($response->getStatusCode() !== 200) {
            throw new HttpTransportException('GET settings failed: ' . $rawBody);
        }

        $rawSettings = $this->decodeJsonResponse($rawBody);

        // тк по условию формат везде может отличаться - нет смысла делать фабрику
        // для маппинга данных сервисов на наши энтити. Но если формат один - это необходимо
        foreach ($rawSettings as $rawSetting) {
            $settings[] = new Setting($rawSetting['name'], $rawSetting['type'], $rawSetting['value']);
        }

        return $settings;
    }

    /**
     * @throws HttpTransportException
     */
    public function setSetting(string $name, $value): bool
    {
        $response = $this->httpClient->patch("/settings/${name}", compact('value'));

        if ($response->getStatusCode() !== 200) {
            // логируем ошибку, возвращаем false, возможно надо возвращать
            // не булево начение, а объект с объяснением, чтобы фронт мог
            // сказзать юеру что пошло не так
            return false;
        }

        // стаб имплементация рест сервиса для упрощения возвращает HTTP 200 и пустое тело
        return true;
    }

    public function getServiceName(): string
    {
        return 'rest';
    }

    /**
     * @return mixed
     * @throws HttpTransportException
     */
    private function decodeJsonResponse(string $rawData)
    {
        try {
            return jsonResponseDecode($rawData);
        } catch (\JsonException $e) {
            throw new HttpTransportException('Invalid response body: json expected, received: ' . $rawBody);
        }
    }
}
