<?php

namespace App\Transport;

use App\Exceptions\HttpTransportException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface as Response;

class Guzzle implements HttpTransportInterface
{
    private Client $guzzle;

    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function get(string $url, array $options = []): Response
    {
        try {
            return $this->guzzle->get($url, $options);
        } catch (GuzzleException $e) {
            throw new HttpTransportException($e->getMessage());
        }
    }

    public function patch(string $url, array $data, array $options = []): Response
    {
        try {
            return $this->guzzle->patch($url, [
                ...$options,
                'json' => $data,
            ]);
        } catch (GuzzleException $e) {
            throw new HttpTransportException($e->getMessage());
        }
    }
}
