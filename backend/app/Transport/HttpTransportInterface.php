<?php

namespace App\Transport;

use App\Exceptions\HttpTransportException;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Если бы запросы были сложнее, я бы, наверное,
 * PSR7-реквест в качестве парамета методов сделал бы
 *
 * Насчет исключения - мне кажется лошгичным, что если у нас
 * хттп-клиенты могут меняться, и мы полагаемся на интерфейс, а не
 * на реализацию, то разные реализации должны маппить свои эксепшены
 * на наш эксепшен, который подразумевается интерфейсом.
 * А оригинальный эксепшн можно сохранять в свойстве локального эксепшена.
 */
interface HttpTransportInterface
{
    /**
     * @throws HttpTransportException
     */
    public function get(string $url, array $options = []): Response;

    /**
     * @throws HttpTransportException
     */
    public function patch(string $url, array $data, array $options = []): Response;
}
