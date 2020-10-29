<?php

namespace App\Http\Controllers;

use App\Services\SettingsService;

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
}
