<?php

if (!function_exists('json_response_decode')) {
    /**
     * @throws JsonException
     */
    function jsonResponseDecode(string $jsonText) {
        return json_decode($jsonText, true, 512, JSON_THROW_ON_ERROR);
    }
}
