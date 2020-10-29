<?php

namespace App\Entities;

class Setting
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
}
