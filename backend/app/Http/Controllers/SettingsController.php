<?php

namespace App\Http\Controllers;

use App\Factories\RemoteServiceClientFactory;
use App\Services\SettingsService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function list(SettingsService $settingsService)
    {
        try {
            $settings = $settingsService->getList();
        } catch (\Throwable $e) {
            return $this->errorResponse(500, $e->getMessage());
        }

        return $this->successResponse($settings);
    }

    public function set(Request $request, RemoteServiceClientFactory $factory, string $name)
    {
        // я вообще люблю делать отдельные классы реквестов,
        // но люмен из коробки это не умеет, надо это самому прикручивать
        $requestIsValid = $this->validate($request, [
            'service' => 'required|string',
            'value' => 'required|string'
        ]);

        if (!$requestIsValid) {
            return $this->errorResponse(422, 'Invalid input');
        }

        try {
            // вот тут кажется, что это можно спрятать в SettingsService
            // но вроде как логика все равно инкапсулирована в сервисные классы (клиенты)
            // поэтому вроде как пробдем не вижу, если только для единообразия,
            // но слишком много теложвижений с DI получается ради сомнительной выгоды
            $client = $factory->createFromName($request->input('service'));
            $isChanged = $client->setSetting($name, $request->input('value'));
        } catch (\Throwable $e) {
            return $this->errorResponse(500, $e->getMessage());
        }

        return $this->successResponse(compact('isChanged'));
    }
}
