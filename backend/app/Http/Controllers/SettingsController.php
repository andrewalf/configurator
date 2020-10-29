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
        $requestIsValid = $request->validate([
            'service' => 'required|string',
            'value' => 'required|string'
        ]);

        if (!$requestIsValid) {
            return $this->errorResponse(422, 'Invalid input');
        }

        try {
            $client = $factory->createFromName($request->input('service'));
            $isChanged = $client->setSetting($request->input('name'), $request->input('value'));
        } catch (\Throwable $e) {
            return $this->errorResponse(500, $e->getMessage());
        }

        return $this->successResponse(compact('isChanged'));
    }
}
