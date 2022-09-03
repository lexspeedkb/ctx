<?php

namespace App\Types;

class BaseType
{
    public function __construct(array $payload = [])
    {
        foreach ($payload as $key => $value) {
            if (isset($this->$key) && $value != null) {
                $this->$key = $value;
            }
        }
    }
}