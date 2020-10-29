<?php

namespace App\Entities;

/**
 * Мы не должны полагаться на формат предоставляемый сторонними сервисами.
 * У нас есть энтити (хотя в этом сервисе это скорее DTO) и сервисы после получения
 * данных конвертиуют их в "местные" энтити, которые уже гуляют по приложению
 */
class Setting implements \JsonSerializable
{
    private string $name;

    private string $type;

    private $value;

    public function __construct(string $name, string $type, $value)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'value' => $this->value
        ];
    }
}
